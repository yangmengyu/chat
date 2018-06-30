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
    protected $noNeedRight = 'sendmsg,addchatlog';
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
    //获取好友资料
    public function information(){
        $user_id = $this->request->request('id');
        $type = $this->request->request('type');
        switch ($type){
            case 'friend':
                $data = Db::name('user')->field('id,avatar,nickname,gender,birthday,bio')->find($user_id);
                $this->assign('data',$data);
                break;
        }
        return $this->fetch();
    }
    //记录聊天记录,并进行敏感词过滤。
    public function addchatlog(){

        $post = $this->request->post();
        $user_id = $this->auth->id;
        $data['from'] = $user_id;
        $data['to'] = $post['to']['user_id'];
        $data['content'] = $post['mine']['content'] = $this->sendmsg($post['mine']['content']);
        $data['sendtime'] = time();
        $data['type'] = $post['to']['type'];
        Db::name('chatlog')->insert($data);
        $this->success('','',$post);
    }

    //检测聊天记录，发送消息
    public function sendmsg($str){
        return $str.'通过';
    }

}