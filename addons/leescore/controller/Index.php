<?php

namespace addons\leescore\controller;

use think\addons\Controller;

class Index extends Controller
{

	protected $model = null;

	public function _initialize()
	{
		parent::_initialize();
		$this->model = model('addons\leescore\model\Goods');
		$adsModel = model('addons\leescore\model\Ads');
		$slider = $adsModel->getSliderList();
		$activicy = $adsModel->getActivicyList();

		$other = $adsModel->getOtherList();
		$this->assign('activicy',$activicy);
		$this->assign('slider',$slider);
		$this->assign('other',$other);
	}

	// 兑换列表
	public function index()
	{
		//热门商品
		$hotList = $this->model->getHotGoods();

		//推荐商品
		$recomm = $this->model->getRecommendGoods();

		//首页推荐商品
		$index = $this->model->getIndexGoods();

		//最新推荐商品
		$new = $this->model->getNewGoods();

		//全部商品
		$all = $this->model->getAllGoods();

		$this->view->assign('index',$index);
		$this->view->assign('new',$new);
		$this->view->assign('all',$all);
		$this->assign('recomm',$recomm);
		$this->assign('hotList',$hotList);
		return $this->fetch("index");
	}

}
