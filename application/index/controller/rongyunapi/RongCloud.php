<?php

namespace app\index\controller\rongyunapi;
/**
 * 融云 Server API PHP 客户端
 * create by kitName
 * create datetime : 2016-09-05 
 * 
 * v2.0.1
 */
use app\index\controller\rongyunapi\SendRequest;
use app\index\controller\rongyunapi\User;
use app\index\controller\rongyunapi\Message;
use app\index\controller\rongyunapi\Wordfilter;
use app\index\controller\rongyunapi\Group;
use app\index\controller\rongyunapi\Chatroom;
use app\index\controller\rongyunapi\Push;
use app\index\controller\rongyunapi\SMS;

class RongCloud {

    /**
     * 参数初始化
     * @param $appKey
     * @param $appSecret
     * @param string $format
     */
    public function __construct($appKey, $appSecret, $format = 'json') {
        $this->SendRequest = new SendRequest($appKey, $appSecret, $format);
    }

    public function User() {
        $User = new User($this->SendRequest);
        return $User;
    }

    public function Message() {
        $Message = new Message($this->SendRequest);
        return $Message;
    }

    public function Wordfilter() {
        $Wordfilter = new Wordfilter($this->SendRequest);
        return $Wordfilter;
    }

    public function Group() {
        $Group = new Group($this->SendRequest);
        return $Group;
    }

    public function Chatroom() {
        $Chatroom = new Chatroom($this->SendRequest);
        return $Chatroom;
    }

    public function Push() {
        $Push = new Push($this->SendRequest);
        return $Push;
    }

    public function SMS() {
        $SMS = new SMS($this->SendRequest);
        return $SMS;
    }

}
