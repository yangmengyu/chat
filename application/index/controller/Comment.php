<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9 0009
 * Time: 下午 3:00
 */

namespace app\index\controller;


use app\common\controller\Frontend;
use think\Db;

class Comment extends Frontend
{
    protected $noNeedLogin = [];
    protected $noNeedRight = ['index','dynamic','praise'];

    public function _initialize()
    {
        parent::_initialize();
    }
    /*
     * 评论列表
     * */
    public function index(){
        $dynamic_id = $this->request->param('dynamic_id');
        $dynamic = Db::name('dynamic')->find($dynamic_id);
        $this->view->assign('dynamic',$dynamic);
        return $this->view->fetch();
    }
}