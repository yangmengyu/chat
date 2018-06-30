<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/30
 * Time: 14:09
 */

namespace app\api\controller;


use app\common\controller\Api;

class Chat extends Api
{
    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = [''];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['*'];



}