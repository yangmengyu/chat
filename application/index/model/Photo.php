<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/21
 * Time: 16:34
 */

namespace app\index\model;


use think\Model;

class Photo extends Model
{
    // 表名
    protected $name = 'photo';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
}