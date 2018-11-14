<?php

namespace addons\leescore\controller;

use think\addons\Controller;
use think\Db;

class Order extends Controller
{

    protected $model = null;
    protected $member = null;
    protected $goods = null;
    protected $noNeedLogin = '';
    protected $noNeedRight = '*';
    public function _initialize()
    {
        parent::_initialize();

        if (!$this->auth->isLogin()) {
            $this->redirect("index/user/login");
        }
        $this->goods = model('addons\leescore\model\Goods');
        $this->member = $this->auth->getUserInfo();
        $this->model = model('addons\leescore\model\Order');
    }

    // 订单管理列表
    public function index()
    {

        //当前会员的订单
        $w['order.uid'] = $this->member['id'];
        //正常订单
        $w['order.isdel'] = array('neq', 1);
        $listType = input('?get.listType') ? input('get.listType') : false;

        $listType ? ($w['order.status'] = $listType) : $w['order.status'] = array('neq', -1);
        $keywords = '';
        if ($this->request->isPost()) {
            $keywords = trim(input('post.keywords'));
            $w['order.order_id'] = array('like', "%$keywords%");
        }

        $list = $this->model
            ->with('goodsDetail')
            ->with('giverUser')
            ->where($w)
            ->order('createtime desc')
            ->paginate(10, false, ['param' => $this->request->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('keywords', $keywords);
        return $this->fetch();
    }


    //AJAX分页
    public function getList()
    {
        //排序
        $field = input("get.field");
        $sort = input('get.sort');

        //推荐类型
        (input('?get.flag') && !empty(trim(input('get.flag')))) && $w['flag'] = input('get.flag');

        //商品类型  虚拟商品-实物商品
        (input('?get.type') && !empty(trim(input('get.type')))) && $w['type'] = input('get.type');

        //钻石查询
        $score_start = (input('?get.score-start') && empty(trim(input('get.score-start')))) ? input("get.score-start") : false;
        $score_end = (input('?get.score-end') && empty(trim(input('get.score-end')))) ? input("get.score-end") : false;

        if ($score_start && $score_end) {
            $w['score'] = ['between', [$score_start, $score_end]];
        }

        //上架中的商品  0=删除，2=上架中，1=仓库中
        $w['status'] = 2;

        //仅显示钻石兑换模式下的商品
        $w['paytype'] = 0;

        //所属该用户的订单
        $w['uid'] = $this->auth->id;

        $page = request()->param('page');

        $order = request()->param('field') . " " . request()->param('sort');

        $list = $this->model->where($w)->order("$order")->paginate(15, false,
            [
                'path'     => 'javascript:ajaxPage([PAGE]);',
                'page'     => $page,
                'var_page' => 'page',
            ]
        );

        $html = '';
        foreach ($list as $key => $vo) {
            $html .= "<div class=\"col-xs-6 col-md-4\"><div class=\"thumbnail radius-none\"><a href=\"javascript:;\"><img style=\"width:100%; height:180px;\" class=\"img-responsive\" src=\"{$vo['thumb']}\" alt=\"{$vo['name']}\"></a><div class=\"\"><h4><a class=\"text-danger\" href=\"javascript:;\">{$vo['name']}</a></h4><div class=\"col-xs-6 col-md-6 padding-none\"><h5 class=\"text-muted \">" . __('score') . ": <strong>{$vo['scoreprice']}</strong> " . "</h5><h5 class=\"text-muted\">" . __('stock') . ": {$vo['stock']}</h5></div><div class=\"col-xs-6 col-md-6\"><p class=\"padding-top\"><a class=\"btn btn-warning btn-flat\" href=\"\">" . __('buy') . "</a></p></div></div><div class=\"clearfix\"></div></div></div>";
        }

        $page = $list->render();
        return json(['list' => $html, 'page' => $page]);
    }


    public function Details()
    {
        $id = (input('?get.id') && input('get.id') != '') ? input('get.id') : false;

        if (!$id) {
            $this->error(__('order detail param error'));
        }

        // $this->model = model('order');
        $detail = $this->model
            ->with('giverUser')
            ->where("order.id = $id")
            ->find();
        //dump($detail->addressInfo->address);
        $this->view->assign('vo', $detail);
        return $this->fetch();
    }

    /*
     * 选择地址
     * */
    public function selectaddress(){
        if($this->request->isAjax()){
            $order_id = $this->request->request('order_id');
            $address_id = $this->request->request('address_id');
            $res = $this->model->where('id',$order_id)->update(['address_id'=>$address_id]);
            if($res){
                $this->success();
            }else{
                $this->error();
            }
        }
        $user_id = $this->auth->id;
        $order_id = $this->request->request('id');
        $address = \addons\leescore\model\Address::where('userid',$user_id)->select();
        $this->view->assign('address',$address);
        $this->view->assign('order_id',$order_id);
        return $this->view->fetch();
    }

    public function delete()
    {
        if ($this->request->isPost()) {
            $id = input('post.id');

            try {
                $w['id'] = $id;
                $w['uid'] = $this->member['id'];
                $this->model->where($w)->update(['isdel' => 1]);
                return true;
            } catch (Exception $e) {
                dump($e->getMessage());
            }
        }
    }

    public function orderSign()
    {
        if ($this->request->isPost()) {
            $id = input('post.id');

            try {
                $w['id'] = $id;
                $w['uid'] = $this->member['id'];
                $this->model->where($w)->update(['status' => 3]);
                return true;
            } catch (Exception $e) {
                dump($e->getMessage());
            }
        }
    }

    public function isCheck()
    {

        //登录验证
        if (!$this->auth->isLogin()) {
            $result = ['code' => false, 'msg' => __("no login")];
            return json($result);
        }
        $this->member = $this->auth->getUserInfo();

        //钻石验证
        $id = input('get.id');
        $info = $this->goods->where("id = $id")->find();
        if ($this->member['score'] < $info['scoreprice']) {
            $result = ['code' => false, 'msg' => __("min score")];
            return $result;
        }

        $result = ['code' => true, 'msg' => "Success"];
        return $result;
    }

    //虚拟奖品申请
    public function couponCreate()
    {
        $result = $this->isCheck();
        if ($result['code'] == false) {
            return json($result);
        } else {

            $id = input('post.id');

            //商品信息
            $row = $this->goods->where("id = $id")->find();
            //插件配置
            $add_config = get_addon_config('leescore');
            //用户编号
            $data['uid'] = $this->member['id'];
            $data['address_id'] = 0; //虚拟物品不需要填写收货地址
            //生成订单号  表前缀 + 随机数2位 + 时间戳10位 + 微秒3位 + 用户编号3位
            $sn = ucfirst(trim($add_config['order_prefix'])) . mt_rand(10, 99) . sprintf("%010d", (time() - 946656000)) . sprintf("%03d", (float)microtime() * 1000) . sprintf("%03d", $this->member['id']);
            $data['order_id'] = $sn;

            $data['goods_id'] = $row['id'];//商品ID
            $data['buy_num'] = 1;//购买数量 默认只能换1个
            $data['goods_type'] = 1; //该商品为虚拟物品 goods_type = 1 为虚拟物品  =0是普通实物
            $data['type'] = 0; // 0= 钻石商城， 1=购物商城。
            $data['money'] = $row['money'];
            $data['score'] = $row['scoreprice'];
            $data['pay'] = 1;
            $data['status'] = 1;
            $data['paytime'] = time();
            $data['paytype'] = 'score';
            $data['isdel'] = 0;
            $data['createtime'] = time();

            // 启动事务
            Db::startTrans();
            try {
                //实例化用户模型
                $score_log = new \app\common\model\User();
                //写入钻石日志
                $score_log->score(-$row['scoreprice'], $this->auth->id, '消费钻石兑换商品');
                //操作库存
                $this->goods->where("id = $id")->setDec('stock');
                $this->goods->where("id = $id")->setInc('usenum');
                //写入订单
                $insert = $this->model->insert($data);
                //兑换记录
                $log = ['uid' => $this->auth->id, 'goods_id' => $row['id'], 'order_id' => $this->model->getLastInsID()];
                Db::name('leescore_exchangelog')->insert($log);

                Db::commit();
                $arr = ['code' => true, 'msg' => __('coupon order success')];
                return json($arr);
            } catch (Exception $e) {
                // 回滚事务
                Db::rollback();
                die($e->getMessage());
            }
        }
    }

    //普通商品兑换
    public function pay()
    {
        $gid = input('post.gid');
        $other = trim(input('post.other'));
        $uid = input("post.uid");
        $goods_type = input("post.goods_type");

        $address_id = input("post.address_id",0);
        $is_gift = input("post.is_gift",1);
        $goodsInfo = $this->goods->where("id = $gid")->find();


        //插件配置
        $add_config = get_addon_config('leescore');
        //用户编号
        $data['uid'] = $uid;
        $data['address_id'] = 0; //虚拟物品不需要填写收货地址
        //生成订单号  表前缀 + 随机数2位 + 时间戳10位 + 微秒3位 + 用户编号3位
        $sn = ucfirst(trim($add_config['order_prefix'])) . mt_rand(10, 99) . sprintf("%010d", (time() - 946656000)) . sprintf("%03d", (float)microtime() * 1000) . sprintf("%03d", $this->member['id']);
        $data['order_id'] = $sn;

        $data['goods_id'] = $goodsInfo['id'];//商品ID
        $data['buy_num'] = 1;//购买数量 默认只能换1个
        $data['goods_type'] = $goods_type; //该商品为实物 goods_type = 1 为虚拟物品  = 0是普通实物
        $data['type'] = 0; // 0= 钻石商城， 1=购物商城。
        $data['money'] = $goodsInfo['money'];
        $data['score'] = $goodsInfo['scoreprice'];
        $data['address_id'] = $address_id;
        $data['pay'] = 1;
        $data['status'] = $goods_type ? 2 : 1;//如果是虚拟物品状态直接为已发货
        $data['paytime'] = time();
        $data['paytype'] = 'score';//付款方式，score = 钻石付款, weixin = 微信支付 , alipay = 支付宝 , paypal = paypal
        $data['isdel'] = 0;
        $data['createtime'] = time();
        $data['other'] = $other;
        $data['is_gift'] = $is_gift;
        $data['giver_id'] = $this->auth->id;
        //多表操作，启动事务,确保数据一致性。
        Db::startTrans();
        try {
            //写入钻石日志
            \app\common\model\User::score(-$goodsInfo['scoreprice'], $this->auth->id, __('Buying diamonds for goods'));
            //操作库存
            $this->goods->where("id = $gid")->setDec('stock');
            $this->goods->where("id = $gid")->setInc('usenum');
            //写入订单
            $insert = $this->model->insert($data);
            //兑换记录
            $log = ['uid' => $this->auth->id, 'goods_id' => $goodsInfo['id'], 'order_id' => $this->model->getLastInsID()];
            Db::name('leescore_exchangelog')->insert($log);

            Db::commit();
            $arr = ['code' => true, 'msg' => __('gift order success')];
            return json($arr);
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            die($e->getMessage());
        }

    }

    //搜索会员
    public function searchmember(){
        $keywords = $this->request->request('keywords');
        $user_model = new \app\common\model\User();
        $users = Db::name('user')
            ->field('id,avatar,nickname,birthday,country,bio')
            ->where('nickname','like',"%$keywords%")
            ->whereOr('id',$keywords)
            ->where('status','normal')
            ->select();
        if($users){
            foreach ($users as $key => $user){
                $users[$key]['birthday'] = $user_model->birthday($user['birthday']);
            }
        }else{
            $this->error();
        }
        $this->success('','',$users);
    }

    //拒收订单处理
    public function rejection(){
        $order_id = $this->request->request('order_id');
        $row = $this->model->where("id = $order_id")->find();
        $data = [ 'status' => '6'];
        // 启动事务
        Db::startTrans();
        try {
            Db::name('leescore_order')->where("id",$order_id)->update($data);
            //实例化用户模型
            $score_log = new \app\common\model\User();
            //写入钻石日志
            $score_log->score($row['score'], $row['giver_id'], __('Gifts refused to be returned to diamond'));
            Db::commit();
            $this->success();
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            die($e->getMessage());
        }
    }

}
