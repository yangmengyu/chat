<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Token;
use app\common\model\Onwall;
use think\Cache;
use think\Cookie;
use think\Db;

class Index extends Frontend
{

    protected $noNeedLogin = '';
    protected $noNeedRight = 'index,like,onwall,ilike,likeme,likeeach,circle,visitor';
    protected $layout = 'default';

    public function _initialize()
    {
        parent::_initialize();
        $where['onwall.expires_time'] = ['>',time()];
        $where['onwall.status'] = 'normal';
        $onwallModel = new Onwall();
        $onwall = $onwallModel->with(['user'])->where($where)->select();
        foreach ($onwall as $row) {

            $row->getRelation('user')->visible(['id','nickname','avatar','status']);
        }
        $onwall = collection($onwall)->toArray();
        $this->view->assign('onwall',$onwall);
    }

    /*
     * 首页
     * */
    public function index()
    {
        $user_model = new \app\common\model\User();
        $this->loadlang('country');
        //获取会员信息
        if($this->request->isAjax()){
            $page = $this->request->request('page');

            if($page>1){
                $controllername = strtolower($this->request->controller());
                $actionname = strtolower($this->request->action());
                $path = str_replace('.', '/', $controllername) . '/' . $actionname;
                if(!$this->auth->check($path)){
                    $this->error(__('Open a member to see more information'));
                }
            }
            $limit = 12;
            $map['status'] = 'normal' ;
            $map['id'] = ['<>',$this->auth->id];
            $count = Db::name('user')->where($map)->count();
            $data['data'] = Db::name('user')
                ->field('nickname,id,group_id,avatar,birthday,country,gender')
                ->where($map)
                ->limit($limit)
                ->page($page)
                ->select();

            foreach ($data['data'] as $key=>$value){
                if($value['group_id']>1){
                    $data['data'][$key]['isvip'] = 1;
                }
                $data['data'][$key]['online'] = Cache::get('online'.$value['id'],'offline');
                $data['data'][$key]['country'] = __($value['country']);
                $data['data'][$key]['age'] = $user_model->birthday($value['birthday']);
                $res = Db::name('chat_like')->where(['from'=>$this->auth->id,'to'=>$value['id']])->find();
                if($res){
                    $data['data'][$key]['like'] = 1;
                }
            }
            $data['total'] = ceil($count/$limit);
            $this->success('','',$data);
        }

        return $this->view->fetch();
    }

    /*
     * 添加喜欢
     * */
    public function like(){
        $to = $this->request->request('to');
        $from = $this->auth->id;
        $res = Db::name('chat_like')->where(['from'=>$from,'to'=>$to])->find();
        if($res){
            Db::name('chat_like')->where(['from'=>$from,'to'=>$to])->delete();
            $this->error(__('Cancel some praise'));
        }else{
            Db::name('chat_like')->insert(['from'=>$from,'to'=>$to]);
            $this->success(__('Point of great success'));
        }
    }

    /*
     * 上墙
     * */
    public function onwall(){

        $this->view->engine->layout(false);
        return $this->view->fetch();
    }

    /*
     * 我喜欢的人
     * */
    public function ilike(){

        $user_model = new \app\common\model\User();
        $this->loadlang('country');
        if($this->request->isAjax()){
            $page = $this->request->request('page');
            if($page>1){
                $controllername = strtolower($this->request->controller());
                $actionname = strtolower($this->request->action());
                $path = str_replace('.', '/', $controllername) . '/' . $actionname;
                if(!$this->auth->check($path)){
                    $this->error(__('Open a member to see more information'));
                }
            }
            $limit = 12;


            $map['u.status'] = 'normal' ;
            $map['like.from'] = $this->auth->id;
            /*$count = Db::name('user')->where($map)->count();*/
            /*$data['data'] = Db::name('user')
                ->field('nickname,id,group_id,avatar,birthday,country,gender')
                ->where($map)
                ->limit($limit)
                ->page($page)
                ->select();*/
            $count = Db::name('chat_like')
                ->alias('like')
                ->join('__USER__ u','like.to = u.id')
                ->where($map)
                ->count();
            $data['data'] = Db::name('chat_like')
                ->alias('like')
                ->join('__USER__ u','like.to = u.id')
                ->where($map)
                ->limit($limit)
                ->page($page)
                ->select();
            foreach ($data['data'] as $key=>$value){
                if($value['group_id']>1){
                    $data['data'][$key]['isvip'] = 1;
                }
                $data['data'][$key]['online'] = Cache::get('online'.$value['id'],'offline');
                $data['data'][$key]['country'] = __($value['country']);
                $data['data'][$key]['age'] = $user_model->birthday($value['birthday']);
                $res = Db::name('chat_like')->where(['from'=>$this->auth->id,'to'=>$value['id']])->find();
                if($res){
                    $data['data'][$key]['like'] = 1;
                }
            }
            $data['total'] = ceil($count/$limit);
            $this->success('','',$data);
        }
        return $this->view->fetch();
    }

    /*
     * 喜欢我的人
     * */
    public function likeme(){

        $user_model = new \app\common\model\User();
        $this->loadlang('country');
        if($this->request->isAjax()){
            $page = $this->request->request('page');
            if($page>1){
                $controllername = strtolower($this->request->controller());
                $actionname = strtolower($this->request->action());
                $path = str_replace('.', '/', $controllername) . '/' . $actionname;
                if(!$this->auth->check($path)){
                    $this->error(__('Open a member to see more information'));
                }
            }
            $limit = 12;


            $map['u.status'] = 'normal' ;
            $map['like.to'] = $this->auth->id;
            /*$count = Db::name('user')->where($map)->count();*/
            /*$data['data'] = Db::name('user')
                ->field('nickname,id,group_id,avatar,birthday,country,gender')
                ->where($map)
                ->limit($limit)
                ->page($page)
                ->select();*/
            $count = Db::name('chat_like')
                ->alias('like')
                ->join('__USER__ u','like.from = u.id')
                ->where($map)
                ->count();
            $data['data'] = Db::name('chat_like')
                ->alias('like')
                ->join('__USER__ u','like.from = u.id')
                ->where($map)
                ->limit($limit)
                ->page($page)
                ->select();
            foreach ($data['data'] as $key=>$value){
                if($value['group_id']>1){
                    $data['data'][$key]['isvip'] = 1;
                }
                $data['data'][$key]['online'] = Cache::get('online'.$value['id'],'offline');
                $data['data'][$key]['country'] = __($value['country']);
                $data['data'][$key]['age'] = $user_model->birthday($value['birthday']);
                $res = Db::name('chat_like')->where(['from'=>$this->auth->id,'to'=>$value['id']])->find();
                if($res){
                    $data['data'][$key]['like'] = 1;
                }
            }
            $data['total'] = ceil($count/$limit);
            $this->success('','',$data);
        }
        return $this->view->fetch();
    }

    /*
     * 互相喜欢
     * */
    public function likeeach(){
        $user_model = new \app\common\model\User();
        $this->loadlang('country');
        if($this->request->isAjax()){
            $page = $this->request->request('page');
            if($page>1){
                $controllername = strtolower($this->request->controller());
                $actionname = strtolower($this->request->action());
                $path = str_replace('.', '/', $controllername) . '/' . $actionname;
                if(!$this->auth->check($path)){
                    $this->error(__('Open a member to see more information'));
                }
            }
            $limit = 12;
            $map['u.status'] = 'normal' ;
            $map['like.to'] = $this->auth->id;
            $count = Db::name('chat_like')
                ->alias('like')
                ->join('chat_like liketo','like.from=liketo.to and like.to=liketo.from')
                ->join('__USER__ u','like.from = u.id')
                ->where($map)
                ->count();
            $data['data'] = Db::name('chat_like')
                ->alias('like')
                ->join('chat_like liketo','like.from=liketo.to and like.to=liketo.from')
                ->join('__USER__ u','like.from = u.id')
                ->where($map)
                ->limit($limit)
                ->page($page)
                ->select();
            foreach ($data['data'] as $key=>$value){
                if($value['group_id']>1){
                    $data['data'][$key]['isvip'] = 1;
                }
                $data['data'][$key]['online'] = Cache::get('online'.$value['id'],'offline');
                $data['data'][$key]['country'] = __($value['country']);
                $data['data'][$key]['age'] = $user_model->birthday($value['birthday']);
                $res = Db::name('chat_like')->where(['from'=>$this->auth->id,'to'=>$value['id']])->find();
                if($res){
                    $data['data'][$key]['like'] = 1;
                }
            }
            $data['total'] = ceil($count/$limit);
            $this->success('','',$data);
        }
        return $this->view->fetch();
    }

    /*
     * 朋友圈
     * */
    public function circle(){
        if($this->request->isAjax()){
            $page = $this->request->request('page');
            $user_id = $this->auth->id;
            if($page>1){
                $controllername = strtolower($this->request->controller());
                $actionname = strtolower($this->request->action());
                $path = str_replace('.', '/', $controllername) . '/' . $actionname;
                if(!$this->auth->check($path)){
                    $this->error(__('Open a member to see more information'));
                }
            }
            $limit = 10;
            $group_ids = Db::name('mygroup')->where('user_id',$user_id)->column('id');
            $friend_user_ids = Db::name('myfriend')->whereIn('mygroup_id',$group_ids)->column('user_id');

            $DynamicModel = new \app\common\model\Dynamic();
            $where['dynamic.user_id'] = ['in',$friend_user_ids];
            $where['dynamic.status'] = 'normal';
            $count = $DynamicModel
                ->where($where)
                ->with('user')
                ->count();
            $data['total'] = ceil($count/$limit);

            $dynamic = $DynamicModel
                ->where($where)
                ->order('createtime desc')
                ->with('user')
                ->limit($limit)
                ->page($page)
                ->select();

            foreach ($dynamic as $row) {

                $row->getRelation('user')->visible(['id','nickname','avatar','status']);
            }
            $dynamic = collection($dynamic)->toArray();

            if($dynamic){
                foreach ($dynamic as $key=>$value){
                    $images = Db::name('dynamic_image')->where('dynamic_id',$value['id'])->select();
                    if(!empty($images)){
                        $dynamic[$key]['images'] = $images;
                    }
                    $dynamic[$key]['createtime'] = time_tran($value['createtime']);
                    $dynamic[$key]['zannum'] = Db::name('dynamic_praise')->where('dynamic_id',$value['id'])->count();
                    $dynamic[$key]['pinglunnum'] = Db::name('comment_post')->where('article_id',$value['id'])->count();
                }
                $data['dynamic'] = $dynamic;
                $this->success('','',$data);
            }else{
                $this->success();
            }
        }
        return $this->view->fetch();
    }

    /*
     * 访客记录
     * */
    public function visitor(){
        if($this->request->isAjax()){
            $page = $this->request->request('page');
            $user_id = $this->auth->id;
            $this->loadlang('country');
            if($page>1){
                $controllername = strtolower($this->request->controller());
                $actionname = strtolower($this->request->action());
                $path = str_replace('.', '/', $controllername) . '/' . $actionname;
                if(!$this->auth->check($path)){
                    $this->error(__('Open a member to see more information'));
                }
            }
            $limit = 10;
            $where = ['to'=>$user_id];
            $count = Db::name('visitor')->where($where)->count();

            $visitor = Db::name('visitor')->where($where)
                ->field('v.*,u.avatar,u.bio,u.nickname,u.birthday,u.gender,country')
                ->alias('v')
                ->join('__USER__ u','v.from = u.id')
                ->order('accesstime desc')
                ->limit($limit)
                ->page($page)
                ->select();

            $visitor = collection($visitor)->toArray();
            $data['total'] = ceil($count/$limit);
            $user_model = new \app\common\model\User();
            if($visitor){
                foreach ($visitor as $key=>$value){
                    $visitor[$key]['bio'] = $visitor[$key]['bio']?$visitor[$key]['bio']:__('This guy hasn\'t written anything yet');
                    $visitor[$key]['accesstime'] = time_tran($value['accesstime']);
                    $visitor[$key]['age'] = $user_model->birthday($value['birthday']);
                    $visitor[$key]['online'] = Cache::get('online'.$value['from'],'offline');
                    $visitor[$key]['country'] = __($value['country']);
                }
                $data['visitor'] = $visitor;
                $this->success('','',$data);
            }else{
                $this->success();
            }
        }
        return $this->view->fetch();
    }

}
