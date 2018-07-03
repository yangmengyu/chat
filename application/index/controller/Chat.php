<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 15:44
 */

namespace app\index\controller;


use app\common\controller\Frontend;
use think\Config;
use think\Cookie;
use think\Db;

class Chat extends Frontend
{
    protected $noNeedLogin = '';
    protected $noNeedRight = ['addchatlog','information','chatlog','chatLogTotal','find','getRecommend'];
    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }
    //获取用户信息，好友列表
    public function get_user_data(){
        //获取我的信息
        $user_id = $this->auth->id;
        $site = Config::get("site");
        $RY_api = new \app\api\controller\rongyunapi\RongCloud($site['ry_key'],$site['ry_secret']);

        //获取我的好友分组
        $mygroup = Db::name('mygroup')->where('user_id',$user_id)->order('weight asc')->select();
        foreach ($mygroup as $key=>$value){
            $myfriend = Db::name('myfriend')
                ->field('f.mygroup_id,f.user_id,u.id,u.nickname as username,u.avatar,u.bio as sign')
                ->alias('f')
                ->join('user u','f.user_id=u.id')
                ->where('f.mygroup_id',$value['id'])
                ->select();
            /*foreach ($myfriend as $k=>$v){
                $res = $RY_api->User()->checkOnline(1);
                $isOnline = json_decode($res);
                $myfriend['status'] = $isOnline;
            }*/
            $mygroup[$key]['list']=$myfriend;
        }

        $data['mine'] = Db::name('user')->field('nickname as username,id,bio as sign,avatar')->find($user_id);
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
    //添加申请好友信息接口
    public function addMsg(){
        $post = $this->request->post();
        $post['from'] = $this->auth->id;
        $post['sendtime'] = time();
        $post['status'] = 1;
        $res = Db::name('mymsg')->where(['from'=>$post['from'],'to'=>$post['to']])->field('id')->find();
        if($res){
            $success = Db::name('mymsg')->where('id',$res['id'])->update($post);
        }else{
            $success = Db::name('mymsg')->insert($post);
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
}