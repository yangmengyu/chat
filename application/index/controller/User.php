<?php

namespace app\index\controller;

use app\api\controller\MDAvatars;
use app\common\controller\Frontend;
use app\index\model\Photo;
use app\index\model\PhotoAlbum;
use think\Config;
use think\Cookie;
use think\Db;
use think\Hook;
use think\Session;
use think\Validate;

/**
 * 会员中心
 */
class User extends Frontend
{

    protected $layout = 'default';
    protected $noNeedLogin = ['login', 'register', 'third','test'];
    protected $noNeedRight = ['logout','dynamic','photo','photolist'];

    public function _initialize()
    {
        parent::_initialize();
        $auth = $this->auth;

        if (!Config::get('fastadmin.usercenter')) {
            $this->error(__('User center already closed'));
        }

        $ucenter = get_addon_info('ucenter');
        if ($ucenter && $ucenter['state']) {
            include ADDON_PATH . 'ucenter' . DS . 'uc.php';
        }

        //监听注册登录注销的事件
        Hook::add('user_login_successed', function ($user) use ($auth) {
            $expire = input('post.keeplogin') ? 30 * 86400 : 0;
            Cookie::set('uid', $user->id, $expire);
            Cookie::set('token', $auth->getToken(), $expire);
        });
        Hook::add('user_register_successed', function ($user) use ($auth) {
            Cookie::set('uid', $user->id);
            Cookie::set('token', $auth->getToken());
        });
        Hook::add('user_delete_successed', function ($user) use ($auth) {
            Cookie::delete('uid');
            Cookie::delete('token');
        });
        Hook::add('user_logout_successed', function ($user) use ($auth) {
            Cookie::delete('uid');
            Cookie::delete('token');
        });
    }

    /**
     * 会员中心
     */
    public function index()
    {
        $step = input('step');
        $this->view->assign('title', __('User center'));
        $this->view->assign('step', $step);
        return $this->view->fetch();
    }

    /**
     * 注册会员
     */
    public function register()
    {
        $this->view->engine->layout(false);
        $url = $this->request->request('url');
        if ($this->auth->id)
            $this->success(__('You\'ve logged in, do not login again'), $url);
        if ($this->request->isPost()) {
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            $email = $this->request->post('email');
            $mobile = $this->request->post('mobile', '');
            $captcha = $this->request->post('captcha');
            $token = $this->request->post('__token__');
            $rule = [
                'username'  => 'require|length:3,30',
                'password'  => 'require|length:6,30',
                'email'     => 'require|email',
                'mobile'    => 'regex:/^1\d{10}$/',
                'captcha'   => 'require|captcha',
                '__token__' => 'token',
            ];

            $msg = [
                'username.require' => 'Username can not be empty',
                'username.length'  => 'Username must be 3 to 30 characters',
                'password.require' => 'Password can not be empty',
                'password.length'  => 'Password must be 6 to 30 characters',
                'captcha.require'  => 'Captcha can not be empty',
                'captcha.captcha'  => 'Captcha is incorrect',
                'email'            => 'Email is incorrect',
                'mobile'           => 'Mobile is incorrect',
            ];
            $data = [
                'username'  => $username,
                'password'  => $password,
                'email'     => $email,
                'mobile'    => $mobile,
                'captcha'   => $captcha,
                '__token__' => $token,
            ];
            $validate = new Validate($rule, $msg);
            $result = $validate->check($data);
            if (!$result) {
                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);
            }
            if ($this->auth->register($username, $password, $email, $mobile)) {
                $synchtml = '';
                ////////////////同步到Ucenter////////////////
                if (defined('UC_STATUS') && UC_STATUS) {
                    $uc = new \addons\ucenter\library\client\Client();
                    $synchtml = $uc->uc_user_synregister($this->auth->id, $password);
                }




                $this->success(__('Sign up successful') . $synchtml, $url ? $url : url('user/index'));
            } else {
                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);
            }
        }
        //判断来源
        $referer = $this->request->server('HTTP_REFERER');
        if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))
            && !preg_match("/(user\/login|user\/register)/i", $referer)) {
            $url = $referer;
        }
        $this->view->assign('url', $url);
        $this->view->assign('title', __('Register'));
        return $this->view->fetch();
    }

    /**
     * 会员登录
     */
    public function login()
    {
        $this->view->engine->layout(false);
        $url = $this->request->request('url');
        if ($this->auth->id)
            $this->success(__('You\'ve logged in, do not login again'), $url);
        if ($this->request->isPost()) {
            $account = $this->request->post('account');
            $password = $this->request->post('password');
            $keeplogin = (int)$this->request->post('keeplogin');
            $token = $this->request->post('__token__');
            $rule = [
                'account'   => 'require|length:3,50',
                'password'  => 'require|length:6,30',
                '__token__' => 'token',
            ];

            $msg = [
                'account.require'  => 'Account can not be empty',
                'account.length'   => 'Account must be 3 to 50 characters',
                'password.require' => 'Password can not be empty',
                'password.length'  => 'Password must be 6 to 30 characters',
            ];
            $data = [
                'account'   => $account,
                'password'  => $password,
                '__token__' => $token,
            ];
            $validate = new Validate($rule, $msg);
            $result = $validate->check($data);
            if (!$result) {
                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);
                return FALSE;
            }

            if ($this->auth->login($account, $password)) {
                $synchtml = '';
                ////////////////同步到Ucenter////////////////
                if (defined('UC_STATUS') && UC_STATUS) {
                    $uc = new \addons\ucenter\library\client\Client();
                    $synchtml = $uc->uc_user_synlogin($this->auth->id);
                }

                $this->success(__('Logged in successful') . $synchtml, $url ? $url : url('user/index'));
            } else {
                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);
            }


        }
        //判断来源
        $referer = $this->request->server('HTTP_REFERER');
        if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))
            && !preg_match("/(user\/login|user\/register)/i", $referer)) {
            $url = $referer;
        }
        $this->view->assign('url', $url);
        $this->view->assign('title', __('Login'));
        return $this->view->fetch();
    }

    /**
     * 注销登录
     */
    function logout()
    {
        //注销本站
        $this->auth->logout();
        $synchtml = '';
        ////////////////同步到Ucenter////////////////
        if (defined('UC_STATUS') && UC_STATUS) {
            $uc = new \addons\ucenter\library\client\Client();
            $synchtml = $uc->uc_user_synlogout();
        }
        $this->success(__('Logout successful') . $synchtml, url('user/index'));
    }

    /**
     * 个人信息
     */
    public function profile()
    {
        $this->loadlang('country');
        $this->loadlang('interest');
        $countrys = Db::name('chat_country')->where('status','normal')->order('shortname1 asc')->select();
        $interests = Db::name('chat_interest')->where('status','normal')->select();
        $user = $this->auth->getUser($this->auth->id);
        $user->interest = \GuzzleHttp\json_decode($user->interest);
        $this->view->assign('title', __('Profile'));
        $this->view->assign('countrys',$countrys);
        $this->view->assign('interests',$interests);
        $this->view->assign('user',$user);
        return $this->view->fetch();
    }

    /**
     * 修改密码
     */
    public function changepwd()
    {
        if ($this->request->isPost()) {
            $oldpassword = $this->request->post("oldpassword");
            $newpassword = $this->request->post("newpassword");
            $renewpassword = $this->request->post("renewpassword");
            $token = $this->request->post('__token__');
            $rule = [
                'oldpassword'   => 'require|length:6,30',
                'newpassword'   => 'require|length:6,30',
                'renewpassword' => 'require|length:6,30|confirm:newpassword',
                '__token__'     => 'token',
            ];

            $msg = [
            ];
            $data = [
                'oldpassword'   => $oldpassword,
                'newpassword'   => $newpassword,
                'renewpassword' => $renewpassword,
                '__token__'     => $token,
            ];
            $field = [
                'oldpassword'   => __('Old password'),
                'newpassword'   => __('New password'),
                'renewpassword' => __('Renew password')
            ];
            $validate = new Validate($rule, $msg, $field);
            $result = $validate->check($data);
            if (!$result) {
                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);
                return FALSE;
            }

            $ret = $this->auth->changepwd($newpassword, $oldpassword);
            if ($ret) {
                $synchtml = '';
                ////////////////同步到Ucenter////////////////
                if (defined('UC_STATUS') && UC_STATUS) {
                    $uc = new \addons\ucenter\library\client\Client();
                    $synchtml = $uc->uc_user_synlogout();
                }
                $this->success(__('Reset password successful') . $synchtml, url('user/login'));
            } else {
                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);
            }
        }
        $this->view->assign('title', __('Change password'));
        return $this->view->fetch();
    }
    //修改邮箱页面
    public function remail(){
        $this->view->engine->layout(false);
        return $this->view->fetch();
    }
    //签到
    public function sign(){
        $this->view->assign('title', __('My sign'));
        return $this->view->fetch();
    }

    //动态页面
    public function dynamic(){

        if($this->request->isAjax()){
            $page = $this->request->request('page');
            $limit = 10;
            $user_id = $this->auth->id;
            $count = Db::name('dynamic')
                ->where(['user_id'=>$user_id,'status'=>'normal'])
                ->count();
            $data['total'] = ceil($count/$limit);
            $dynamic = Db::name('dynamic')
                ->where(['user_id'=>$user_id,'status'=>'normal'])
                ->order('createtime desc')
                ->limit($limit)
                ->page($page)
                ->select();
            if($dynamic){
                foreach ($dynamic as $key=>$value){
                    $images = Db::name('dynamic_image')->where('dynamic_id',$value['id'])->select();
                    if(!empty($images)){
                        $dynamic[$key]['images'] = $images;
                    }
                    $dynamic[$key]['createtime'] = time_tran($value['createtime']);
                }
                $data['dynamic'] = $dynamic;
                $this->success('','',$data);
            }else{
                $this->success();
            }
        }
        $controllername = strtolower($this->request->controller());
        $actionname = strtolower($this->request->action());
        $path = str_replace('.', '/', $controllername) . '/' . $actionname;
        if($this->auth->check($path)){
            $isvip = true;
        }else{
            $isvip = false;
        }
        $this->view->assign('isvip',$isvip);
        return $this->view->fetch();
    }
    //相册页面
    public function photo(){
        if($this->request->isAjax()){
            $page = $this->request->request('page');
            $limit = 12;
            $user_id = $this->auth->id;
            $count = PhotoAlbum::where('user_id',$user_id)->count();
            $photoAlbum = PhotoAlbum::where('user_id',$user_id)->limit($limit)->page($page)->select();
            foreach ($photoAlbum as $key=>$album){
                $photo = Photo::where(['album_id'=>$album->id,'is_cover'=>1])->find();
                if($photo){
                    $photoAlbum[$key]['image'] = $photo['image'];
                }else{
                    $photoAlbum[$key]['image'] = '/assets/home/img/no-album.jpg';
                }
            }
            $data['total'] = ceil($count/$limit);
            $data['photoAlbum'] = $photoAlbum;
            $this->success('','',$data);
        }
        return $this->view->fetch();
    }
    //相册图片
    public function photolist(){

        if($this->request->isAjax()){
            $page = $this->request->request('page');
            $album_id = $this->request->request('album_id');
            $limit = 12;
            $count = Photo::where('album_id',$album_id)->count();
            $photos = Photo::where('album_id',$album_id)->limit($limit)->page($page)->select();
            $data['total'] = ceil($count/$limit);
            $data['photos'] = $photos;
            $this->success('','',$data);
        }
        $id = $this->request->request('id');
        $this->view->assign('album_id',$id);
        return $this->view->fetch();
    }
    //创建相册
    public function createAlbum(){
        $name = $this->request->request('name');
        $res = PhotoAlbum::create([
            'user_id'=>$this->auth->id,
            'name'=>$name
        ]);
        if($res->id){
            $this->success(__('Create successful'));
        }else{
            $this->error(__('Create failed'));
        }
    }
    //添加照片
    public function addPhoto(){
        $album_id = $this->request->request('album_id');
        $image = $this->request->request('image');
        $res = Photo::create([
           'album_id'=>$album_id,
           'image'=>$image
        ]);
        if($res->id){
            $this->success(__('Upload successful'));
        }else{
            $this->error(__('Upload failed'));
        }
    }
    //test测试头像
    public function test(){
        $OutputSize = min(512, empty($_GET['size'])?36:intval($_GET['size']));
        $char = '笑';
        $Avatar = new MDAvatars($char,512);

/*        $Avatar->Output2Browser($OutputSize);*/
        $filename = ROOT_PATH . '/public/uploads/avatar/'.time().'-.png';
        $Avatar->Save($filename, 256);
    }
}
