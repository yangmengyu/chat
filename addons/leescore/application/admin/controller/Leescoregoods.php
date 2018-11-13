<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use fast\Tree;

/**
 * 商品
 *
 * @icon fa fa-circle-o
 */
class Leescoregoods extends Backend
{
    
    /**
     * ScoreGoods模型对象
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
		$this->model = model('leescore_category');
		$cate = $this->model->getLeescoreCategory();
		
		$tree = Tree::instance()->init($cate, 'category_id');
		$this->categorylist = $tree->getTreeList($tree->getTreeArray(0), 'name');
        $categorydata = [];
        $options_val[] = [];
		foreach ($this->categorylist as $k => $v)
		{
			$categorydata[$v['id']] = $v;
			$options_val[$v['id']] = $v['name'];
		}
		$this->assign('options',$categorydata);
        $this->model = model('LeescoreGoods');
        $this->view->assign("typeList", $this->model->getTypeList());
        $this->view->assign("payTypeList", $this->model->getPayTypeList());
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign("flagList", $this->model->getFlagList());
        $this->assignconfig('options_val', $options_val);
    }
    

	public function index()
	{

		//设置过滤方法
		if ($this->request->isAjax())
		{
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('pkey_name'))
            {
                return $this->selectpage();
            }

			//构造父类select列表选项数据
			$list = [];

            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
            		->with('getLeescoreGoods')
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
            		->with('getLeescoreGoods')
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

			$total = count($list);
			$result = array("total" => $total, "rows" => $list);
			return json($result);
		}
		return $this->view->fetch();
	}

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
    /**
     * Selectpage搜索
     * 
     * @internal
     */
    public function selectpage()
    {
        return parent::selectpage();
    }
}
