<?php

namespace addons\leescore\model;

use think\Model;
use think\Db;
/**
 * 签到模型
 */
class Goods Extends Model
{

    protected $name = "leescore_goods";
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    // 追加属性
    protected $append = [
    ];
    protected static $config = [];

    //自定义初始化
    protected static function init()
    {
        $config = get_addon_config('leescore');
        self::$config = $config;
    }


    //热门商品
    public function getHotGoods()
    {
        //上架中的商品  0=删除，2=上架中，1=仓库中 
        $w['status'] = 2;

        //开始展示时间
        $w['firsttime'] = ['elt',time()];

        //结束展示时间
        $w['lasttime'] = ['egt',time()];
        $w[] = array('exp',Db::raw("FIND_IN_SET('hot',flag)"));
        //仅显示积分兑换模式下的商品
        $w['paytype'] = 0;

        return collection(Goods::where($w)->order('weigh desc')->cache(300)->limit(15)->select())->toArray();
    }

    //推荐商品
    public function getRecommendGoods()
    {
        //上架中的商品  0=删除，2=上架中，1=仓库中 
        $w['status'] = 2;
        //开始展示时间
        $w['firsttime'] = ['elt',time()];
        //结束展示时间
        $w['lasttime'] = ['egt',time()];
        //仅显示积分兑换模式下的商品
        $w['paytype'] = 0;
        //推荐
        $w[] = array('exp',Db::raw("FIND_IN_SET('hot',flag)"));

        return collection(Goods::where($w)->order('weigh desc')->cache(300)->limit(8)->select())->toArray();
    }


    public function getIndexGoods()
    {
        //上架中的商品  0=删除，2=上架中，1=仓库中 
        $w['status'] = 2;

        //开始展示时间
        $w['firsttime'] = ['elt',time()];

        //结束展示时间
        $w['lasttime'] = ['egt',time()];

        //仅显示积分兑换模式下的商品
        $w['paytype'] = 0;

        //首页推荐
        $w[] = array('exp',Db::raw("FIND_IN_SET('hot',flag)"));

        return collection(Goods::where($w)->order('weigh desc')->cache(300)->limit(15)->select())->toArray(); 
    }

    public function getNewGoods()
    {
        //上架中的商品  0=删除，2=上架中，1=仓库中 
        $w['status'] = 2;

        //开始展示时间
        $w['firsttime'] = ['elt',time()];

        //结束展示时间
        $w['lasttime'] = ['egt',time()];

        //仅显示积分兑换模式下的商品
        $w['paytype'] = 0;

        //最新商品
        $w[] = array('exp',Db::raw("FIND_IN_SET('hot',flag)"));

        return collection(Goods::where($w)->order('weigh desc')->cache(300)->limit(15)->select())->toArray(); 
    }


    public function getAllGoods()
    {
        //上架中的商品  0=删除，2=上架中，1=仓库中 
        $w['status'] = 2;

        //开始展示时间
        $w['firsttime'] = ['elt',time()];
        //结束展示时间
        $w['lasttime'] = ['egt',time()];

        //仅显示积分兑换模式下的商品
        $w['paytype'] = 0;

        return collection(Goods::where($w)->order('weigh desc')->cache(300)->limit(15)->select())->toArray(); 
    }

}
