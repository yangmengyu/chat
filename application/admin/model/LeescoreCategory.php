<?php

namespace app\admin\model;

use think\Model;

class LeescoreCategory extends Model
{
    // 表名
    protected $name = 'leescore_category';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [

    ];

    protected static function init()
    {
        self::afterInsert(function ($row) {
            $pk = $row->getPk();
            $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
        });
    }

    public function getLeescoreCategory()
    {
        $this->model = model('leescore_category');
        $row = $this->model->with("getCateName")->order("weigh,id asc")->select();

        $data = collection($row)->toArray();
        //dump($data);
        return $data;
    }

    public function getCateName()
    {
        return $this->hasOne('LeescoreCategory','id','category_id')->field("name as scName,id,category_id as pcid");
    }
}
