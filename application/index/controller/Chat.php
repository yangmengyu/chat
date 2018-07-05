<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 15:44
 */

namespace app\index\controller;


use app\api\controller\Rongcloud;
use app\common\controller\Frontend;
use think\Cache;
use think\Config;
use think\Cookie;
use think\Db;
use think\Request;

class Chat extends Frontend
{
    protected $noNeedLogin = '';
    protected $noNeedRight = ['addchatlog','information','chatlog','chatLogTotal','find','getRecommend','getMsgBox','modifyMsg','subscribed','getFindFriend','getmsgboxnum','setAllRead','changeSign','changeOnline','removeFriends'];
    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }
    //获取用户信息，好友列表
    public function get_user_data(){
        //获取我的信息
        $user_id = $this->auth->id;


        //获取我的好友分组
        $mygroup = Db::name('mygroup')->where('user_id',$user_id)->order('weight asc')->select();
        foreach ($mygroup as $key=>$value){
            $myfriend = Db::name('myfriend')
                ->field('f.mygroup_id,f.user_id,u.id,u.nickname as username,u.avatar,u.bio as sign')
                ->alias('f')
                ->join('user u','f.user_id=u.id')
                ->where('f.mygroup_id',$value['id'])
                ->select();
            foreach ($myfriend as $k=>$v){
                $myfriend[$k]['status'] = Cache::get('online'.$v['id'],'offline');
            }
            $mygroup[$key]['list']=$myfriend;
        }
        $data['mine'] = Db::name('user')->field('nickname as username,id,bio as sign,avatar,online as status')->find($user_id);
        $data['friend'] = $mygroup;
        return $this->result($data,0);
    }
    //查找好友页面
    public function find(){
        return $this->fetch();
    }
    //推荐好友接口
    public function getRecommend(){
        $data = Db::name('user')->field('id,nickname,bio,avatar')->select();
        $this->success('','',$data);
    }
    //获取查找好友总数
    public function friendtotal(){
        $post = $this->request->post();
        $keyword = $post['value'];
        $type = $post['type'];
        $limit = 16;//每页显示数量
        if($type == 'friend'){
            $count = Db::name('user')
                ->where('id|nickname|mobile|email','like',$keyword)
                ->where('status','normal')->count();
            if($count){
                $data['count'] = $count;
                $data['limit'] = $limit;
                $this->success('','',$data);
            }else{
                $this->error(__('No relevant member was found'));
            }
        }else{
            $this->error(__('An unexpected error occurred'));
        }

    }
    //获取查找好友信息
    public function getFindFriend(){
        $post = $this->request->post();
        $keyword = $post['value'];
        $type = $post['type'];
        $limit = 16;//每页显示数量
        $page = $post['page'];
        if($type == 'friend'){
            $data = Db::name('user')
                ->field('avatar,bio,id,nickname')
                ->where('id|nickname|mobile|email','like',$keyword)
                ->where('status','normal')->select();
            $this->success('','',$data);
        }else{
            $this->error(__('An unexpected error occurred'));
        }
    }
    //添加申请好友信息接口
    public function addMsg(){
        $post = $this->request->post();
        $post['from'] = $this->auth->id;
        $post['sendtime'] = time();
        $post['status'] = 1;
        $site = Config::get("site");

        $post['remark'] = $post['remark']?$post['remark']:' ';
        $res = Db::name('mymsg')->where(['from'=>$post['from'],'to'=>$post['to']])->field('id')->find();
        if($res){
            $success = Db::name('mymsg')->where('id',$res['id'])->update($post);
        }else{
            $success = Db::name('mymsg')->insert($post);
            $RY_api  = new Rongcloud($site['ry_key'],$site['ry_secret']);
            $Message = $RY_api->message();
            $Message->PublishSystem($post['from'],$post['to'],'LAYIM:SYS',$post['remark'],'','',1,1);
        }

        if($success){
            $this->success(__('send add friend success'));
        }else{
            $this->error(__('send add friend error'));
        }
    }

    //获取好友资料页面
    public function information(){

        return $this->fetch();
    }
    //获取好友资料接口
    public function getinformation(){
        $user_id = $this->request->request('id');
        $type = $this->request->request('type');
        switch ($type){
            case 'friend':
                $data = Db::name('user')->field('id,avatar,nickname,gender,birthday,bio')->find($user_id);
                $this->success('','',$data);
                break;
        }
    }
    //移动好友接口
    public function moveFriend(){
        $friend_id = $this->request->post('friend_id');
        $groupid = $this->request->post('groupid');
        $user_id = $this->auth->id;
        $myfriend_id = Db::name('mygroup')->field('f.id as friend_id')->alias('g')->join('myfriend f','g.id=f.mygroup_id')->where(['g.user_id'=>$user_id,'f.user_id'=>$friend_id])->find();
        if($myfriend_id){
            Db::name('myfriend')->where('id',$myfriend_id['friend_id'])->update(['mygroup_id'=>$groupid]);
            $this->success(__('Mobile friends succeed'),'',$groupid);
        }else{
            $this->error(__('An unexpected error occurred'));
        }
    }
    //获取好友记录页面
    public function chatlog(){
        return $this->fetch();
    }
    //获取聊天记录总数
    public function chatLogTotal(){
        $get = $this->request->get();
        $id = $get['id'];  //  好友/群 id
        $type = $get['type']; // 好友/群 类别
        $user_id = $this->auth->id;//当前用户id
        $count = Db::name('chatlog')->where(function ($query) use ($id,$user_id) {
            $query->where('to', $id)->where('from', $user_id) ->where('status',1);
        })->whereOr(function ($query) use ($id,$user_id) {
            $query->where('to',$user_id)->where('from',$id) ->where('status',1);
        })
        ->count();
        $data['count'] = $count;
        $data['limit'] = 20;
        if($data['count']){
            $this->result($data);
        }else{
            $this->result($data,'-1',__('chat records are empty'));
        }

    }
    //获取好友记录接口
    public function getChatLog(){
        $request = $this->request->request();
        $id = $request['id'];  //  好友/群 id
        $type = $request['type']; // 好友/群 类别
        $page = $request['page']; //页码
        $limit = $request['limit']; //每页条数

        $user_id = $this->auth->id;//当前用户id
        switch ($type){
            case 'friend':
                $subQuery = Db::name('chatlog')->where(function ($query) use ($id,$user_id) {
                    $query->where('to', $id)->where('from', $user_id) ->where('status',1);
                })->whereOr(function ($query) use ($id,$user_id) {
                    $query->where('to',$user_id)->where('from',$id) ->where('status',1);
                })->order('sendtime desc')->limit($limit)->page($page)->buildSql();
                $data = Db::table($subQuery.' c')
                    ->join('user u','c.from=u.id')
                    ->field('u.nickname as username,u.id,u.avatar,c.sendtime as timestamp,c.content')
                    ->select();
                break;
            case 'group':
                break;
        }
        if($data){
            $this->success('','',$data);
        }else{
            $this->error(__('An unexpected error occurred'));
        }

    }
    //记录聊天记录
    public function addchatlog(){

        $post = $this->request->post();
        $res = Db::name('chatlog')->insert($post);
        if($res){
            $this->success();
        }else{
            $this->error();
        }
    }

    //检测聊天记录，发送消息
    public function msgreplace($str){
        $post = $this->request->post();
        $data = str_replace('傻逼','**',$str);
        $this->success('','',$data);
    }
    //添加好友分组
    public function addMyGroup(){
        $user_id = $this->auth->id;
        $count = Db::name('mygroup')->where('user_id',$user_id)->count();
        $max_num = 20;
        if($count>=$max_num){
            $this->error(__('Create %s groups at most',$max_num));
        }else{
            $data['user_id'] = $user_id;
            $res['name'] = $data['groupname'] = __('Unnaming');
            $data['weight'] = ++$count;
            $res['id'] = Db::name('mygroup')->insertGetId($data);
            $this->success(__('Create success'),'',$res);
        }
    }
    //修改好友分组名称
    public function editMyGroup(){
        $post = $this->request->post();
        $groupid = $post['groupid'];
        $groupname = $post['groupname'];
        $user_id = $this->auth->id;
        $data = Db::name('mygroup')->field('id')->where(['user_id'=>$user_id,'groupname'=>$groupname])->find();
        if(isset($data['id'])&&$data['id'] == $groupid){
            $this->error(__('The group name has already existed'));
        }else{
            $res = Db::name('mygroup')->where('id',$groupid)->update(['groupname'=>$groupname]);
            if($res){
                $this->success(__('Modifying group success'));
            }else{
                $this->error(__('An unexpected error occurred'));
            }
        }
    }
    //删除好友分组
    public function delMyGroup(){
        $post = $this->request->post();
        $groupid = $post['groupid'];
        $user_id = $this->auth->id;
        $count = Db::name('mygroup')->where(['user_id'=>$user_id,'id'=>$groupid])->count();
        if($count){
            $default_group = Db::name('mygroup')->where('user_id',$user_id)->order('weight asc')->field('id')->find();
            $default_groupid = $default_group['id'];
            if($groupid == $default_groupid){
                $this->error(__('The default group cannot be deleted'));
            }
            $friends = Db::name('myfriend')->field('id')->where('mygroup_id',$groupid)->select();
            $friendids = [];
            foreach ($friends as $key => $value){
                $friendids[] = $value['id'];
            }
            Db::name('myfriend')->whereIn('id',$friendids)->update(['mygroup_id'=>$default_groupid]);
            Db::name('mygroup')->where('id',$groupid)->delete();
            $this->success(__('The group was successfully deleted'),'',$default_groupid);
        }else{
            $this->error(__('An unexpected error occurred'));
        }
    }
    //获取消息盒子数量
    public function getmsgboxnum(){
        $user_id = $this->auth->id;
        $count = Db::name('mymsg')->where(function ($query) use ($user_id){
            $query->where('to',$user_id)->where('status',UNREAD);
        })->whereOr(function ($query) use ($user_id){
            $query->where('from',$user_id)->whereIn('status',[AGREE_BY_TO,DISAGREE_BY_TO]);
        })->count();
        if($count){
            $this->success('','',$count);
        }else{
            $this->error();
        }
    }
    //获取消息盒子
    public function getmsgbox(){
        if($this->request->isAjax()){
            $post = $this->request->post();
            $user_id = $this->auth->id;
            $limit = $post['limit'];
            $page = $post['page'];
            $msgBox = Db::name('mymsg')->where(function ($query) use ($user_id){
                $query->where('from',$user_id)->whereOr('to',$user_id);
            })->order('sendtime desc')->limit($limit)->page($page)->select();
            foreach ($msgBox as $key=>$value){
                if ($value['msgType'] == ADD_USER_MSG || $value['msgType'] == ADD_USER_SYS) {
                    if ($value['to'] == $user_id) {
                        $userId = $value['from'];//收到加好友消息（被添加者接收消息）
                    } elseif ($value['from'] == $user_id) {
                        $userId = $value['to'];//收到系统消息(申请是否通过) 加好友消息（添加者接收消息）
                    }
                }
                if($userId){
                    $user = Db::name('user')->where('id',$userId)->field('nickname,bio,avatar')->find();
                    $msgBox[$key]['sign'] = $user['bio'];
                    $msgBox[$key]['username'] = $user['nickname'];
                    $msgBox[$key]['avatar'] = $user['avatar'];
                }else{
                    $msgBox[$key]['username'] = __('Platform to inform');
                }
            }
            $count = Db::name('mymsg')->where(function ($query) use ($user_id){
                $query->where('from',$user_id)->whereOr('to',$user_id);
            })->count();
            $data['userid'] = $user_id;
            $data['msgbox'] = $msgBox;
            $data['pages'] = ceil($count/$limit);
            $this->success('','',$data);
        }
        return $this->fetch();
    }
    //修改添加状态
    public function modifyMsg(){
        $post = $this->request->post();
        $data['msgType'] = $post['msgType'];
        $msgId = $post['msgId'];
        $status = $post['status'];
        $data['status'] = $status == AGREE_BY_TO?AGREE_BY_TO:DISAGREE_BY_TO;
        $user_id = $this->auth->id;
        //添加好友
        if($data['msgType'] == 2){
            $friendid = $post['friendid'];
            $groupid = $post['mygroup_id'];
            $from = Db::name('mymsg')->field('from,mygroupid')->find($msgId);
            if ($from['from'] != $friendid){
                $this->error(__('An unexpected error occurred'));
            }
            $res = Db::name('mymsg')->where(['to'=>$user_id,'id'=>$msgId])->update($data);
            if($res){
                $isfriend = Db::name('myfriend')->where(['mygroup_id'=>$groupid,'user_id'=>$friendid])->find();
                if(!$isfriend){
                    Db::name('myfriend')->insert(['mygroup_id'=>$groupid,'user_id'=>$friendid]);
                }
            }

            $site = Config::get("site");
            $RY_api  = new Rongcloud($site['ry_key'],$site['ry_secret']);
            $Message = $RY_api->message();
            $Message->PublishSystem($user_id,$from['from'],'LAYIM:FRIENDADD','SUCCESS','','',1,1);
            $this->success();
        }else{
            $this->error(__('An unexpected error occurred'));
        }
    }
    //好友请求已通过
    public function subscribed(){
        $to = $this->request->post('from');
        $from = $this->auth->id;
        $data = Db::name('user')
            ->alias('u')
            ->field('u.id,u.nickname as username,u.bio as sign,u.avatar,m.mygroupid as groupid')
            ->join('mymsg m','m.to=u.id')
            ->where(['m.to'=>$to,'m.from'=>$from])
            ->find();
        if($data) {
            Db::name('myfriend')->insert(['mygroup_id' => $data['groupid'], 'user_id' => $data['id']]);
        }
        $this->success('','',$data);
    }
    //全部设为已读
    public function setAllRead(){
        $user_id = $this->auth->id;
        $agree_by_to = AGREE_BY_TO;
        $disagree_by_to = DISAGREE_BY_TO;
        $data = Db::name('mymsg')->where(function ($query) use ($agree_by_to,$disagree_by_to){
            $query->where('status',$agree_by_to)->whereOr('status',$disagree_by_to);
        })->where('from',$user_id)->select();
        foreach ($data as $key=>$value){
            $status['status'] = $value['status']+2;
            Db::name('mymsg')->where('id',$value['id'])->update($status);
        }
    }
    public function changeSign(){
        $user_id = $this->auth->id;
        $sign['bio'] = $this->request->post('sign');
        Db::name('user')->where('id',$user_id)->update($sign);
        $this->success();
    }
    public function changeOnline(){
        $user_id = $this->auth->id;
        $online['online'] = $this->request->post('online');
        Db::name('user')->where('id',$user_id)->update($online);
        if($online['online'] == 'online'){
            Cache::set('online'.$user_id,'online',600);
        }else{
            Cache::rm('online'.$user_id);
        }
        $this->success();
    }
    //删除好友，并删除消息和聊天记录
    public function removeFriends(){
        $friend_id = $this->request->post('friend_id');
        $user_id = $this->auth->id;
        $res1 = Db::name('myfriend')->alias('f')
            ->field('f.id')
            ->join('mygroup g','f.mygroup_id=g.id')
            ->where(['f.user_id'=>$friend_id,'g.user_id'=>$user_id])
            ->find();
        $res2 = Db::name('myfriend')->alias('f')
            ->field('f.id')
            ->join('mygroup g','f.mygroup_id=g.id')
            ->where(['f.user_id'=>$user_id,'g.user_id'=>$friend_id])
            ->find();
        if($res1&&$res2){
            Db::name('myfriend')->delete([$res1['id'],$res2['id']]);
            Db::name('mymsg')
                ->where(['from'=>$friend_id,'to'=>$user_id])
                ->whereOr(['from'=>$user_id,'to'=>$friend_id])
                ->delete();
            Db::name('chatlog')
                ->where(['from'=>$friend_id,'to'=>$user_id])
                ->whereOr(['from'=>$user_id,'to'=>$friend_id])
                ->delete();
            $site = Config::get("site");
            $RY_api  = new Rongcloud($site['ry_key'],$site['ry_secret']);
            $Message = $RY_api->message();
            $Message->PublishSystem($user_id,$friend_id,'LAYIM:FRIENDDEL','SUCCESS','','',1,1);
            $this->success(__('Delete friend successfully'));
        }else{
            $this->error(__('An unexpected error occurred'));
        }
    }
}