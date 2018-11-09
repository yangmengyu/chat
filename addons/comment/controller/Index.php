<?php

namespace addons\comment\controller;

use think\addons\Controller;
use think\Db;

class Index extends Controller
{

    protected $layout = 'default';

    protected $config = [];

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $dynamic_id = $this->request->param('dynamic_id');
        $dynamic = Db::name('dynamic')->find($dynamic_id);
        $this->view->assign('dynamic',$dynamic);
        return $this->view->fetch();
    }

}
