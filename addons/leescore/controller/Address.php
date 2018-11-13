<?php

namespace addons\leescore\controller;

use think\addons\Controller;
use think\Exception;
class Address extends Controller
{

	protected $model = null;
	protected $member = null;

	public function _initialize()
	{
		parent::_initialize();
		if(!$this->auth->isLogin())
		{
			$this->redirect("index/user/login");
		}

		$this->member = $this->auth->getUserInfo();
		$this->model = model('addons\leescore\model\Address');
	}

	// 收货地址管理
	public function index()
	{
		$w['userid'] = $this->auth->id;
		$w['isdel'] = array('<>',1);
		$list = $this->model->where($w)->order('status desc')->select();

		$this->view->assign('list',$list);
		return $this->view->fetch();
	}

	//新增收货地址
	public function add()
	{
		$c = $this->check();
		$code = ($c >= 10) ? false : true;

		if(!$code)
		{
			//$arr = ['status' => false, 'msg' => __('address number max')];
			echo __('address number max');
			exit();
		}
		
		if($this->request->isPost())
		{
			$arr = explode("/", $this->request->param('region'));
			//省
			$data['region'] = $arr[0];
			//市
			$data['city'] = $arr[1];
			//县
			$data['xian'] = $arr[2];
			$data = $this->request->post();
			$data['createtime'] = time();
			$data['userid'] = $this->auth->id;
			$result = $this->model->insert($data);

			if($result)
			{
				$arr = ['status' => true, 'msg' => __('action success')];
			}
			else
			{
				$arr = ['status' => false, 'msg' => __('action error')];
			}

			return json($arr);
		}

		return $this->view->fetch();
	}

	public function check()
	{
		$w['userid'] = $this->auth->id;
		$w['isdel'] = array('neq',1);
		$total = $this->model->where($w)->count();
		return $total;
	}



	public function edit()
	{
		$id = input('get.id');
		if($this->request->isPost())
		{	
			$arr = explode("/", $this->request->param('region'));
			//省
			$data['region'] = $arr[0];
			//市
			$data['city'] = $arr[1];
			//县
			$data['xian'] = $arr[2];
			$data = $this->request->post();
			$data['createtime'] = time();
			$data['userid'] = $this->auth->id;
			unset($data['address_id']);
			$w['isdel'] = 0;
			$w['userid'] = $this->auth->id;

			if(intval(input('post.status')) == 1)
			{
				//重置其它默认选项
				$this->model->where($w)->update(['status' => 0]);
			}
			$id = $w['id'] = input('post.address_id');
			$result = $this->model->where($w)->update($data);
			if($result)
			{
				$arr = ['status' => true, 'msg' => __('action success')];
			}
			else
			{
				$arr = ['status' => false, 'msg' => __('action error')];
			}

			return json($arr);
		}

		$info = $this->model->where("id = $id")->find();
		$this->view->assign('vo',$info);
		return $this->view->fetch();
	}


	public function delete()
	{
		if($this->request->isPost())
		{
			$id = input('post.id');
			$w['id'] = $id;
			$w['userid'] = $this->auth->id;
			try{
				$this->model->where($w)->update(['isdel' => 1]);
				return true;
			}catch(\Exception $e){
				$this->error(__('error tips'));
			}
		}
	}

	public function setDefaultAddress()
	{
		if($this->request->isPost())
		{
			$id = input('post.id');
			$w['id'] = $id;
			$w['userid'] = $this->auth->id;
			$ww['userid'] = $this->auth->id;
			$ww['isdel'] = 0;
			try{
				//重置默认地址
				$this->model->where($ww)->update(['status' => 0]);

				//设置默认地址
				$this->model->where($w)->update(['status' => 1]);
				return true;
			}catch(\Exception $e){
				$this->error(__('error tips'));
			}

		}
	}

}
