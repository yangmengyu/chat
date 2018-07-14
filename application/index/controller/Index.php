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
    protected $noNeedRight = 'index';
    protected $layout = 'default';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {

        //获取会员信息
        if($this->request->isAjax()){

            $this->loadlang('country');
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
            $count = Db::name('user')->where('status','normal')->count();
            $data['data'] = Db::name('user')->where('status','normal')->limit($limit)->page($page)->select();
            $user_model = new \app\common\model\User();
            foreach ($data['data'] as $key=>$value){
                if($value['group_id']>1){
                    $data['data'][$key]['isvip'] = 1;
                }
                $data['data'][$key]['online'] = Cache::get('online'.$value['id'],'offline');
                $data['data'][$key]['country'] = __($value['country']);
                $data['data'][$key]['age'] = $user_model->birthday($value['birthday']);
            }
            $data['total'] = ceil($count/$limit);
            $this->success('','',$data);
        }
        return $this->view->fetch();
    }


}
