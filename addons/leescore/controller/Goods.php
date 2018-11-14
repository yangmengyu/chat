<?php

namespace addons\leescore\controller;

use think\addons\Controller;
use think\Db;

class Goods extends Controller
{

	protected $model = null;
	protected $member = null;

	public function _initialize()
	{
		parent::_initialize();
		$this->model = model('addons\leescore\model\Goods');
		//开始展示时间
        $w['firsttime'] = ['elt',time()];
        //结束展示时间
        $w['lasttime'] = ['egt',time()];
        $w['status'] = 2;
		$usenumdesc = $this->model->where($w)->order('usenum desc')->limit(10)->select();
		$this->view->assign('usenumdesc',$usenumdesc);
	}

	// 兑换列表
	public function index()
	{
		return $this->fetch();
	}


	//AJAX分页
	public function getList()
	{
		//排序
		$field = input("get.field");
		$sort = input('get.sort');

		//推荐类型
		(input('?get.flag') && !empty(trim(input('get.flag')))) && $w[] = array('exp',Db::raw("FIND_IN_SET('". input('get.flag') ."',flag)"));
		//商品类型  虚拟商品-实物商品
		(input('?get.type') && input('get.type') != '') && $w['type'] = input('get.type');

		//钻石查询
		$score_start = (input('?get.start') && !empty(input('get.start'))) ? abs((int)input("get.start")) : 1;
		$score_end = (input('?get.end') && !empty(input('get.end'))) ? abs((int)input("get.end")) : false;

		if($score_start && $score_end)
		{
			$w['scoreprice'] = ['between',[$score_start,$score_end]];
		}
		
		//上架中的商品  0=删除，2=上架中，1=仓库中
		$w['status'] = 2;
        //开始展示时间
        $w['firsttime'] = ['elt',time()];
        //结束展示时间
        $w['lasttime'] = ['egt',time()];
		//仅显示钻石兑换模式下的商品
		$w['paytype'] = 0;

		//dump($score_start && $score_end);
		$page = request()->param('page');
		$order = request()->param('field')." ".request()->param('sort');
		$list = $this->model->where($w)->order("$order")->paginate(12, false,
			[
				'path' => 'javascript:ajaxPage([PAGE]);',
				'page' => $page,
				'var_page' => 'page',
			]
		);

		$html = count($list,true) < 1 ? "<div class='col-xs-12'><small>No goods</small></div>" : '';
		foreach($list as $key => $vo)
		{
			$html .= "<div class=\"col-xs-6 col-md-4 padding-min\"><div class=\"thumbnail radius-none\"><a href=\"". addon_url('leescore/goods/details',array('gid' => $vo['id'])) ."\"><img style=\"width:100%; height:180px;\" class=\"img-responsive hidden-xs\" src=\"{$vo['thumb']}\" alt=\"{$vo['name']}\"><img style=\"width:100%; height:120px;\" class=\"img-responsive visible-xs\" src=\"{$vo['thumb']}\" alt=\"{$vo['name']}\"></a><div class=\"\"><h4><a class=\"text-danger\" href=\"javascript:;\">{$vo['name']}</a></h4><div class=\"col-xs-12 col-md-6 padding-none\"><h5 class=\"text-muted \">". __('score') .": <strong>{$vo['scoreprice']}</strong> ". "</h5><h5 class=\"text-muted\">" . __('stock') .": {$vo['stock']}</h5></div><div class=\"col-xs-12 col-md-6\"><div class=\"padding-top\"><a class=\"btn btn-warning btn-flat btn-block\" href=\"". addon_url('leescore/goods/details', array('gid' => $vo['id'])) ."\">". __('buy') ."</a></div></div></div><div class=\"clearfix\"></div></div></div>";
		}

		$page = $list->render();
		return json(['list' => $html, 'page' => $page]);
	}

	//商品详情
	public function details()
	{
		$id = input('get.gid');
		$w['id'] = $id;
		$detail = $this->model->where($w)->find();
		$sn = mt_rand(10,99). sprintf("%010d",(time() - 946656000)) . sprintf("%03d",(float) microtime() * 1000) . sprintf("%03d", $this->auth->id);
		$this->view->assign('item',$detail);
		return $this->view->fetch();
	}


	public function isCheck()
	{

		//登录验证
		if(!$this->auth->isLogin())
		{
			$result = ['code' => false, 'msg' => __("no login")];
			return json($result);
		}

		//钻石验证
		$id = input('get.id');
		$info = $this->model->where("id = $id")->find();
		if($this->auth->score < $info['scoreprice'])
		{
			$result = ['code' => false, 'msg' => __("min score")];
			return json($result);
		}

		$result = ['code' => true, 'msg' => "Success"];
		return json($result);
	}

	//订单生成
	public function createOrder()
	{
		$id = input('get.id');
		$info = $this->model->where("id = $id")->find($id);
		$w['userid'] = $this->auth->id;
		$w['isdel'] = 0;
		$addressList = Db::name('leescore_address')->where($w)->order('status desc')->select();

		$this->view->assign('add', $addressList);
		$this->view->assign('item', $info);

		return $this->view->fetch();
	}
}
