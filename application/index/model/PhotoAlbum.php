<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/21
 * Time: 15:43
 */
namespace app\index\model;
use think\Model;

class PhotoAlbum extends Model
{
    // 表名
    protected $name = 'photo_album';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
}