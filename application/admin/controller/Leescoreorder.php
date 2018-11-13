<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Leescoreorder extends Backend
{
    
    /**
     * ScoreOrder模型对象
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('LeescoreOrder');
        $this->view->assign("typeList", $this->model->getTypeList());
        $this->view->assign("payList", $this->model->getPayList());
        $this->view->assign("statusList", $this->model->getStatusList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

    //驳回订单
    
    public function faild()
    {
        $id = input('post.ids');
        $other = input('post.result_other');
        $row = $this->model->where("id = $id")->find();

        $data = ['result_other' => $other, 'status' => '-2'];

        // 启动事务
        Db::startTrans(); 
        try {
            Db::name('leescore_order')->where("id",$id)->update($data);
            //实例化用户模型
            $score_log = new \app\common\model\User();
            //写入钻石日志
            $score_log->score($row['score'], $row['uid'], '订单驳回返还钻石');
            Db::commit();
            $this->success(__('order faild tip success'));
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            die($e->getMessage());
        }
    }


    /*发货*/
    public function send()
    {
        if($this->request->isPost())
        {
            $id = input('post.ids');
            $row = $this->model->get($id);
            $status = 2;
            if($row['goods_type'] == 1) $status = 3;

            $data['status'] = $status;
            $data['result_other'] = input('post.virtual_other');
            $data['virtual_go_time'] = time();

            if($status == 3) $data['virtual_sign_time'] = time();
            $data['virtual_sn'] = input('post.virtual_sn');
            $data['virtual_name'] = input('post.virtual_name');
            
            $this->model->where("id = $id")->update($data);
            $this->success();
        }

        $param = $this->request->param();
        $row = $this->model->get($param['ids']);
        $this->view->assign('vo', $row);
        return $this->view->fetch();

    }

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                    ->with('user,leescore_goods')
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->with('user,leescore_goods')
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }


    /**
     * 编辑
     */
    public function edit($ids = NULL)
    {
        $w['id'] = $ids;
        $row = $this->model->get($ids);
        //$row->user->username;
        if (!$row)
            $this->error(__('No Results were found'));
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds))
        {
            if (!in_array($row[$this->dataLimitField], $adminIds))
            {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost())
        {
            $params = $this->request->post("row/a");
            if ($params)
            {
                try
                {
                    //是否采用模型验证
                    if ($this->modelValidate)
                    {
                        $name = basename(str_replace('\\', '/', get_class($this->model)));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : true) : $this->modelValidate;
                        $row->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    if ($result !== false)
                    {
                        $this->success();
                    }
                    else
                    {
                        $this->error($row->getError());
                    }
                }
                catch (\think\exception\PDOException $e)
                {
                    $this->error($e->getMessage());
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

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
