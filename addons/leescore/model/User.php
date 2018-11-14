<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/14 0014
 * Time: 下午 3:06
 */

namespace addons\leescore\model;


use think\Model;

class User extends Model
{
    // 表名
    protected $name = 'user';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
}