<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/29
 * Time: 15:44
 */

namespace app\index\controller;


use app\common\controller\Frontend;
use think\Cookie;
use think\Db;

class Chat extends Frontend
{
    protected $noNeedLogin = '';
    protected $noNeedRight = ['addchatlog','information','chatlog','chatLogTotal'];
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
            $this->result($data);
        }else{
            $this->result('','-1',__('An unexpected error occurred'));
        }

    }
    //记录聊天记录,并进行敏感词过滤。
    public function addchatlog(){

        $post = $this->request->post();
        $res = Db::name('chatlog')->insert($post);
        if($res){
            $this->result('',0);
        }else{
            $this->result('','-1');
        }

    }

    //检测聊天记录，发送消息
    public function msgreplace($str){
        $post = $this->request->post();
        $data = str_replace('傻逼','**',$str);
        $this->success('','',$data);
    }

}