<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Token;
use think\Cache;
use think\Cookie;
use think\Db;

class Index extends Frontend
{

    protected $noNeedLogin = '';
    protected $noNeedRight = 'index,like';
    protected $layout = 'default';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {

        $this->loadlang('country');
        //获取会员信息
        if($this->request->isAjax()){
            $page = $this->request->request('page');

            if($page>1){
                $controllername = strtolower($this->request->controller());
                $actionname = strtolower($this->request->action());
                $path = str_replace('.', '/', $controllername) . '/' . $actionname;
                if(!$this->auth->check($path)){
                    $this->error(__('Open a member to see more information'));
                }
            }
            $limit = 12;
            $map['status'] = 'normal' ;
            $map['id'] = ['<>',$this->auth->id];
            $count = Db::name('user')->where($map)->count();
            $data['data'] = Db::name('user')
                ->field('nickname,id,group_id,avatar,birthday,country,gender')
                ->where($map)
                ->limit($limit)
                ->page($page)
                ->select();
            $user_model = new \app\common\model\User();
            foreach ($data['data'] as $key=>$value){
                if($value['group_id']>1){
                    $data['data'][$key]['isvip'] = 1;
                }
                $data['data'][$key]['online'] = Cache::get('online'.$value['id'],'offline');
                $data['data'][$key]['country'] = __($value['country']);
                $data['data'][$key]['age'] = $user_model->birthday($value['birthday']);
                $res = Db::name('chat_like')->where(['from'=>$this->auth->id,'to'=>$value['id']])->find();
                if($res){
                    $data['data'][$key]['like'] = 1;
                }
            }
            $data['total'] = ceil($count/$limit);
            $this->success('','',$data);
        }
        return $this->view->fetch();
    }
    public function like(){
        $to = $this->request->request('to');
        $from = $this->auth->id;
        $res = Db::name('chat_like')->where(['from'=>$from,'to'=>$to])->find();
        if($res){
            Db::name('chat_like')->where(['from'=>$from,'to'=>$to])->delete();
            $this->error(__('Cancel some praise'));
        }else{
            Db::name('chat_like')->insert(['from'=>$from,'to'=>$to]);
            $this->success(__('Point of great success'));
        }
    }


}
