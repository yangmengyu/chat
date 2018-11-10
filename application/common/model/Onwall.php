<?php

namespace app\common\model;

use think\Model;

class Onwall extends Model
{
    // 表名
    protected $name = 'onwall';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'expires_time_text',
        'status_text'
    ];
    

    
    public function getStatusList()
    {
        return ['normal' => __('Status normal'),'hidden' => __('Status hidden')];
    }     


    public function getExpiresTimeTextAttr($value, $data)
    {
        $value = $value ? $value : $data['expires_time'];
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : $data['status'];
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setExpiresTimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
