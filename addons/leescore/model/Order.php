<?php

namespace addons\leescore\model;

use think\Model;

/**
 * 订单模型
 */
class Order Extends Model
{

    protected $name = "leescore_order";
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

    public function goodsDetail()
    {
        return $this->belongsTo('Goods','goods_id');
    }

    public function addressInfo()
    {
        return $this->belongsTo('Address','address_id');
    }
    public function giverUser()
    {
        return $this->belongsTo('User', 'giver_id')->setEagerlyType(0);
    }
}
