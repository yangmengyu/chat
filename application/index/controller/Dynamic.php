<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17
 * Time: 10:37
 */

namespace app\index\controller;


use app\common\controller\Frontend;
use think\Db;

class Dynamic extends Frontend
{
    protected $layout = 'default';
    protected $noNeedLogin = [];
    protected $noNeedRight = [];
    public function index(){

    }
    public function add(){
        $content = $this->request->request('content');
        if(empty($content)){
            $this->error(__('Don\'t you say anything'));
        }
        $data['user_id'] = $this->auth->id;
        $data['content'] = $content;
        $data['createtime'] = $data['updatetime'] = time();

        $dynamic_id = Db::name('dynamic')->insertGetId($data);
        if(isset($dynamic_id)){
            $case_images = $this->request->request('case_images/a');
            if(isset($case_images)){
                foreach ($case_images as $img){
                    Db::name('dynamic_image')->insert(['dynamic_id'=>$dynamic_id,'url'=>$img]);
                }
            }
            $this->success(__('Published successfully'));
        }else{
            $this->error(__('Published failure'));
        }
    }
}