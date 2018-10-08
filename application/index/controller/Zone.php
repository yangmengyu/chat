<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24
 * Time: 15:42
 */

namespace app\index\controller;


use app\common\controller\Frontend;
use think\Db;

class Zone extends Frontend
{
    protected $layout = 'default';
    protected $noNeedLogin = [];
    protected $noNeedRight = ['index','dynamic'];
    public function _initialize()
    {
        $id = input('id');
        $this->loadlang('user');
        $this->loadlang('country');
        $this->loadlang('interest');
        $user_model = new \app\common\model\User();
        $userzone = Db::name('user')->find($id);
        if($userzone['group_id']>1){
            $userzone['isvip'] = 1;
        }else{
            $userzone['isvip'] = 0;
        }
        $userzone['age'] = $user_model->birthday($userzone['birthday']);
        $userzone['interest'] = \GuzzleHttp\json_decode($userzone['interest']);
        $this->view->assign('user_id',$id);
        $this->view->assign('userzone',$userzone);
        parent::_initialize();
    }
    public function index(){


        return $this->view->fetch();
    }

    //动态页面
    public function dynamic(){

        if($this->request->isAjax()){
            $page = $this->request->request('page');
            $user_id = $this->request->request('user_id');
            $limit = 10;

            $count = Db::name('dynamic')
                ->where(['user_id'=>$user_id,'status'=>'normal'])
                ->count();
            $data['total'] = ceil($count/$limit);
            $dynamic = Db::name('dynamic')
                ->where(['user_id'=>$user_id,'status'=>'normal'])
                ->order('createtime desc')
                ->limit($limit)
                ->page($page)
                ->select();
            if($dynamic){
                foreach ($dynamic as $key=>$value){
                    $images = Db::name('dynamic_image')->where('dynamic_id',$value['id'])->select();
                    if(!empty($images)){
                        $dynamic[$key]['images'] = $images;
                    }
                    $dynamic[$key]['createtime'] = time_tran($value['createtime']);
                }
                $data['dynamic'] = $dynamic;
                $this->success('','',$data);
            }else{
                $this->success();
            }
        }
    }
}