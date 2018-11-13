<?php

namespace addons\leescore\model;

use think\Model;
use think\Collection;
/**
 * 签到模型
 */
class Ads Extends Model
{

    protected $name = "leescore_ads";
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    // 追加属性
    protected $append = [
    ];
    protected static $config = [];

    // 设置返回数据集的对象名
    protected $resultSetType = 'collection';

    //自定义初始化
    protected static function init()
    {
        $config = get_addon_config('leescore');
        self::$config = $config;
    }

    public function getSliderList()
    {
        $w['position'] = ['eq','slider'];
        $w['status'] = ['eq',1];
        $w['starttime'] = ['lt', time()];
        $w['endtime'] = ['gt', time()];
        return Ads::where($w)->cache(1800)->select();
    }

    public function getActivicyList()
    {
        $w['position'] = ['eq','activicy'];
        $w['status'] = ['eq',1];
        $w['starttime'] = ['lt', time()];
        $w['endtime'] = ['gt', time()];
        return Ads::where($w)->cache(1800)->select();
    }

    public function getOtherList()
    {
        $w['position'] = ['eq','other'];
        $w['status'] = ['eq',1];
        $w['starttime'] = ['lt', time()];
        $w['endtime'] = ['gt', time()];
        return Ads::where($w)->cache(1800)->select();
    }
}
