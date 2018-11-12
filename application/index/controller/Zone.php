<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24
 * Time: 15:42
 */

namespace app\index\controller;


use app\common\controller\Frontend;
use app\index\model\Photo;
use app\index\model\PhotoAlbum;
use think\Db;

class Zone extends Frontend
{
    protected $layout = 'default';
    protected $noNeedLogin = [];
    protected $noNeedRight = ['index','dynamic','praise'];
    public function _initialize()
    {
        $user_id = input('u');
        $this->loadlang('user');
        $this->loadlang('country');
        $this->loadlang('interest');
        $user_model = new \app\common\model\User();
        $userzone = Db::name('user')->find($user_id);
        if($userzone['group_id']>1){
            $userzone['isvip'] = 1;
        }else{
            $userzone['isvip'] = 0;
        }
        $userzone['age'] = $user_model->birthday($userzone['birthday']);
        $userzone['interest'] = \GuzzleHttp\json_decode($userzone['interest']);
        $this->view->assign('user_id',$user_id);
        $this->view->assign('userzone',$userzone);
        parent::_initialize();
    }
    /*
     * 会员空间
     * */
    public function index(){
        $to = input('u');
        $from = $this->auth->id;
        $where = ['from'=>$from,'to'=>$to];
        $vistor = Db::name('visitor')->where($where)->find();
        if($vistor){
            Db::name('visitor')->where('id',$vistor['id'])->update(['accesstime'=>time()]);
        }else{
            Db::name('visitor')->insert([
                'from'=>$from,
                'to'=>$to,
                'accesstime'=>time()
            ]);
        }
        return $this->view->fetch();
    }

    //会员获取动态
    public function dynamic(){

        if($this->request->isAjax()){
            $page = $this->request->request('page');
            $user_id = $this->request->request('user_id');
            if($page>1){
                $controllername = strtolower($this->request->controller());
                $actionname = strtolower($this->request->action());
                $path = str_replace('.', '/', $controllername) . '/' . $actionname;
                if(!$this->auth->check($path)){
                    $this->error(__('Open a member to see more information'));
                }
            }
            $limit = 10;

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
                    $dynamic[$key]['zannum'] = Db::name('dynamic_praise')->where('dynamic_id',$value['id'])->count();
                    $dynamic[$key]['pinglunnum'] = Db::name('comment_post')->where('article_id',$value['id'])->count();
                }
                $data['dynamic'] = $dynamic;
                $this->success('','',$data);
            }else{
                $this->success();
            }
        }
    }

    /*
     * 给会员动态点赞
     * */
    public function praise(){
        $data['dynamic_id'] = $this->request->param('dynamic_id');
        $data['user_id']  = $this->auth->id;
        $res = Db::name('dynamic_praise')->where($data)->find();
        if($res){
            Db::name('dynamic_praise')->where($data)->delete();
            $this->error(__('Cancel some praise'));
        }else{
            Db::name('dynamic_praise')->insert($data);
            $this->success(__('Point of great success'));
        }
    }

    /*
     * 会员相册
     * */
    public function photo(){
        $user_id = $this->request->request('user_id');
        if($this->request->isAjax()){
            $page = $this->request->request('page');
            $limit = 12;
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

    /*
     * 会员相册展示
     * */
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
}