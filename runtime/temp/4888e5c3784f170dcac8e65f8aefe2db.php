<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:71:"E:\phpstudy\WWW\chat\public/../application/index\view\user\dynamic.html";i:1531821294;s:63:"E:\phpstudy\WWW\chat\application\index\view\layout\default.html";i:1531466924;s:65:"E:\phpstudy\WWW\chat\application\index\view\common\meta_chat.html";i:1531808861;s:63:"E:\phpstudy\WWW\chat\application\index\view\common\sidenav.html";i:1531270222;s:67:"E:\phpstudy\WWW\chat\application\index\view\common\script_chat.html";i:1531730320;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?><?php echo __('The fastest framework based on ThinkPHP5 and Bootstrap'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<?php if(isset($keywords)): ?>
<meta name="keywords" content="<?php echo $keywords; ?>">
<?php endif; if(isset($description)): ?>
<meta name="description" content="<?php echo $description; ?>">
<?php endif; ?>
<meta name="author" content="FastAdmin">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
<link rel="stylesheet" href="/assets/home/layui/css/layui.css">
<link rel="stylesheet" href="/assets/home/css/menu.css">
<link rel="stylesheet" href="/assets/home/css/contextMenu.css" />
<link rel="stylesheet" href="/assets/home/css/jquery.validator.css" />
<link rel="stylesheet" href="/assets/home/css/baguetteBox.min.css">
<link rel="stylesheet" href="/assets/home/iconfont/iconfont.css">


<script src="/assets/home/layui/layui.js"></script>
<script src="/assets/home/js/jquery-3.1.1.min.js"></script>
<script src="/assets/libs/bootstrap/js/collapse.js"></script>
<script src="/assets/libs/nice-validator/dist/jquery.validator.js?local=<?php echo $config['language']; ?>"></script>
<script src="/assets/home/js/baguetteBox.min.js"></script>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
<script src="/assets/js/html5shiv.js"></script>
<script src="/assets/js/respond.min.js"></script>

<![endif]-->
<script type="text/javascript">
    var require = {
        config: <?php echo json_encode($config); ?>
    };
</script>

        <link href="/assets/css/user.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

    </head>

    <body data-token="<?php echo $userinfo['token']; ?>" data-rykey="<?php echo $site['ry_key']; ?>">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header" >
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo url('/'); ?>"><img src="/assets/img/logo.png"  alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav pull-left">
                        <li class="active"><a href="<?php echo url('index/index'); ?>" ><?php echo __('Member'); ?></a></li>
                        <li><a href="#">Link</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right" >
                        <li class="dropdown">
                            <?php if($user): ?>
                            <a href="<?php echo url('user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="avatar-img"><img src="<?php echo $user['avatar']; ?>" alt=""></span>
                            </a>
                            <?php else: ?>
                            <a href="<?php echo url('user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('User center'); ?> <b class="caret"></b></a>
                            <?php endif; ?>
                            <ul class="dropdown-menu">
                                <?php if($user): ?>
                                <li><a href="<?php echo url('user/index'); ?>"><i class="fa fa-user-circle fa-fw"></i><?php echo __('Go to Member center'); ?></a></li>
                                <li><a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i><?php echo __('Profile'); ?></a></li>
                                <li><a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i><?php echo __('Reset password'); ?></a></li>
                                <li><a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i><?php echo __('Sign out'); ?></a></li>
                                <?php else: ?>
                                <li><a href="<?php echo url('user/login'); ?>"><i class="fa fa-sign-in fa-fw"></i> <?php echo __('Sign in'); ?></a></li>
                                <li><a href="<?php echo url('user/register'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Sign up'); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php if(\think\Config::get('lang_switch_on')): ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language fa-fw"></i><span><?php echo __('Languages'); ?></span> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="?lang=zh-cn"> 简体中文</a></li>
                                <li><a href="?lang=en"> English</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="content">
            <style>
    .basicinfo {
        margin: 15px 0;
    }

    .basicinfo .row > .col-xs-4 {
        padding-right: 0;
    }

    .basicinfo .row > div {
        margin: 5px 0;
    }
    .box{
        margin-top: 10%;
        margin-bottom: 10px;
        color: #FF5722;
        font-size: 18px;
        margin-left: 45%;
    }
    .box1{
        width: 900px;
        height: 500px;
        margin-left: auto;
        border:solid  1px;
        margin-right:auto;
    }
    .box1 .controls{

    }
    .upload-icon-img{
        height: 100%;
    }
    .upload-pre-item{
        position: relative;
    }
    .upload-pre-item .img{
        margin-top: 5px;
        width:100px;
        height: 100px;
    }
    .upload-pre-item i {
        position: absolute;
        cursor: pointer;
        top: 5px;
        background: #2F4056;
        padding: 2px;
        line-height: 15px;
        text-align: center;
        color: #fff;
        margin-left: 1px;
        /* float: left; */
        filter: alpha(opacity=80);
        -moz-opacity: .8;
        -khtml-opacity: .8;
        opacity: .8;
        transition: 1s;
    }
    .upload-pre-item i:hover{transform:rotate(360deg);}
    .upload-pre-item,.upload-icon-img{
        width:120px;
        float: left;
        margin-left: 8px;
    }
    .qqFace { margin-top: 4px; background: #fff; padding: 2px; border: 1px #dfe6f6 solid; }
    .qqFace table td { padding: 0px; }
    .qqFace table td img { cursor: pointer; border: 1px #fff solid; }
    .qqFace table td img:hover { border: 1px #0066cc solid; }
</style>
<link rel="stylesheet" href="/assets/home/css/gallery-grid.css">
<div id="content-container" class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="sidenav">
    <ul class="list-group">
        <li class="list-group-heading"><?php echo __('User center'); ?></li>
        <li class="list-group-item <?php echo $config['actionname']=='index'?'active':''; ?>"> <a href="<?php echo url('user/index'); ?>"><i class="fa fa-user-circle fa-fw"></i> <?php echo __('User center'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='profile'?'active':''; ?>"> <a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Profile'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='changepwd'?'active':''; ?>"> <a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i> <?php echo __('Change password'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='sign'?'active':''; ?>"> <a href="<?php echo url('user/sign'); ?>"><i class="fa fa-map-signs fa-fw"></i> <?php echo __('My sign'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='logout'?'active':''; ?>"> <a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo __('Sign out'); ?></a> </li>
    </ul>
</div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default ">
                <div class="panel-body">
                    <h2 class="page-header">
                        <?php echo __('User center'); ?>
                        <a href="<?php echo url('user/profile'); ?>" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i>
                            <?php echo __('Profile'); ?></a>
                    </h2>
                    <div class="row user-baseinfo">
                        <div class="col-md-3 col-sm-3 col-xs-2 text-center user-center">
                            <a href="<?php echo url('user/profile'); ?>" title="<?php echo __('Click to edit'); ?>">
                                <span class="avatar-img"><img src="<?php echo $user['avatar']; ?>" alt=""></span>
                            </a>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-10">
                            <!-- Content -->
                            <div class="ui-content">
                                <!-- Heading -->
                                <h4><a href="<?php echo url('user/profile'); ?>"><?php echo $user['nickname']; ?></a></h4>
                                <!-- Paragraph -->
                                <p>
                                    <a href="<?php echo url('user/profile'); ?>">
                                        <?php echo (isset($user['bio']) && ($user['bio'] !== '')?$user['bio']:__("This guy hasn't written anything yet")); ?>
                                    </a>
                                </p>
                                <!-- Success -->
                                <div class="basicinfo">
                                    <div class="row">
                                        <div class="col-xs-4 col-md-2"><?php echo __('Lv'); ?></div>
                                        <div class="col-xs-8 col-md-4"><a href="javascript:;" class="viewlv"><?php echo $user['level']; ?></a>
                                        </div>
                                        <div class="col-xs-4 col-md-2"><?php echo __('Score'); ?></div>
                                        <div class="col-xs-8 col-md-4"><a href="javascript:;" class="viewscore"><?php echo $user['score']; ?></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 col-md-2"><?php echo __('Successions'); ?></div>
                                        <div class="col-xs-8 col-md-4"><?php echo $user['successions']; ?> <?php echo __('Day'); ?></div>
                                        <div class="col-xs-4 col-md-2"><?php echo __('Maxsuccessions'); ?></div>
                                        <div class="col-xs-8 col-md-4"><?php echo $user['maxsuccessions']; ?> <?php echo __('Day'); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 col-md-2"><?php echo __('Logintime'); ?></div>
                                        <div class="col-xs-8 col-md-4"><?php echo date("Y-m-d H:i:s",$user['logintime']); ?></div>
                                        <div class="col-xs-4 col-md-2"><?php echo __('Prevtime'); ?></div>
                                        <div class="col-xs-8 col-md-4"><?php echo date("Y-m-d H:i:s",$user['prevtime']); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="layui-tab layui-tab-brief" lay-filter="demo">
                        <ul class="layui-tab-title">
                            <li data-url="<?php echo url('user/index'); ?>" ><?php echo __('Home page'); ?></li>
                            <li data-url="<?php echo url('user/dynamic'); ?>" class="layui-this"><?php echo __('Dynamic state'); ?></li>
                            <li data-url="<?php echo url('user/photo'); ?>"><?php echo __('Photo album'); ?></li>
                            <li data-url="<?php echo url('user/video'); ?>"><?php echo __('Video'); ?></li>
                        </ul>
                        <div class="layui-tab-content ">
                            <div class="layui-tab-item "><?php echo __('Home page'); ?></div>
                            <div class="layui-tab-item layui-show">
                                <div class="com_form " >
                                    <form id="dynamic-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('dynamic/add'); ?>">
                                        <div class="layui-form-item layui-form-text">
                                            <div>
                                                <textarea  placeholder="和大家分享点什么吧" class="layui-textarea form-control" id="saytext" name="content" data-rule="require"></textarea>
                                            </div>
                                            <i  class="layui-icon layui-icon-face-smile emotion" style="font-size: 20px; color: #e60020;"></i>
                                        </div>
                                        <div class="upload-img-box layui-form-item">
                                            <dd class="upload-icon-img " >
                                                <div class="upload-pre-item">
                                                    <img src="/assets/home/img/upload.png" class="img" id="upload_img_icon" style="cursor: pointer;border: 3px #ccc dashed;" alt="上传图片">
                                                </div>
                                            </dd>
                                        </div>
                                        <div class="layui-form-item">
                                            <div >
                                                <button class=" btn btn-primary" lay-submit="" lay-filter="formDemo"><?php echo __('Publish'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <ul class="layui-timeline" id="LAY-FLOW">

                                </ul>
                            </div>
                            <div class="layui-tab-item"><?php echo __('Photo album'); ?></div>
                            <div class="layui-tab-item"><?php echo __('Video'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/home/js/jquery.qqFace.js"></script>
<script type="text/javascript" src="/assets/home/js/dynamic.js"></script>
<script type="text/javascript">
    baguetteBox.run('.tz-gallery');
</script>
<script>

    layui.use(['layer','upload','element','flow'], function(){
        var element = layui.element,flow = layui.flow;
        //一些事件监听
        element.on('tab(demo)', function(data){
            var url = $(this).data('url');
            window.location.href = url;
        });
        var layer = layui.layer;
        var upload = layui.upload;
        upload.render({ //上传图片
            elem: '#upload_img_icon',
            url: '/api/common/upload',
            multiple: true, //是否允许多文件上传。设置 true即可开启。不支持ie8/9
            auto:true,//自动上传
            before: function(obj) {
                layer.msg('图片上传中...', {
                    icon: 16,
                    shade: 0.01,
                    time: 0
                })
            },
            done: function(res) {
                console.log(res);
                layer.close(layer.msg('上传成功！'));
                $('.upload-img-box').append('<dd class="upload-icon-img " ><div class="upload-pre-item"><i onclick="deleteImg($(this))"   class="layui-icon"></i><img src="' + res.data.url + '" class="img" ><input type="hidden" name="case_images[]" value="' + res.data.url + '" /></div></dd>');
            }
            ,error: function(){
                layer.msg('上传错误！');
            }
        });

        flow.load({
            elem: '#LAY-FLOW' //流加载容器
            ,done: function(page, next){ //执行下一页的回调
                var url = '<?php echo url("user/dynamic"); ?>';
                $.post(url, {page:page}, function(res){
                    if(res.code == 1){
                        var lis = [];
                        for(var i = 0; i < res.data.dynamic.length; i++){
                            var str = '<li class="layui-timeline-item">\n' +
                                '<i class="layui-icon layui-timeline-axis"></i>\n' +
                                '<div class="layui-timeline-content layui-text">\n' +
                                '<h3 class="layui-timeline-title">'+res.data.dynamic[i].createtime+'</h3>\n' +
                                '<p style="margin-bottom: 10px;"> '+replace_em(res.data.dynamic[i].content)+'</p>\n' +
                                '<div class="tz-gallery container" style="width: 100%;padding-left: 0;">';
                            if(res.data.dynamic[i].images){
                                for(var j = 0;j < res.data.dynamic[i].images.length;j++){
                                    str += '<div class="tz-img">\n' +
                                        '<a class="lightbox" href="'+res.data.dynamic[i].images[j].url+'">\n' +
                                        '<img src="'+res.data.dynamic[i].images[j].url+'" alt="Park">\n' +
                                        '</a>\n' +
                                        '</div>';
                                }
                            }
                            str += '</div>\n' +
                                '</div>\n' +
                                '</li>';
                            lis.push(str);
                        }
                        //执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
                        //pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
                        next(lis.join(''), page < res.data.total);
                    }else{
                        layer.msg(res.msg);
                    }
                    baguetteBox.run('.tz-gallery');
                });


            }
        });
    });
    function deleteImg(obj){
        //删除页面信息
        obj.parent().parent('.upload-icon-img').remove();
        //删除本地图片（ajax)
        //删除数据库图片
    }


    $(function(){
        $('.emotion').qqFace({
            id : 'facebox',
            assign:'saytext',
            path:'/assets/home/arclist/'	//表情存放的路径
        });
        $(".sub_btn").click(function(){
            var str = $("#saytext").val();
            $("#show").html(replace_em(str));
        });
    });

    //查看结果

    function replace_em(str){
        str = str.replace(/\</g,'&lt;');
        str = str.replace(/\>/g,'&gt;');
        str = str.replace(/\n/g,'<br/>');
        str = str.replace(/\[em_([0-9]*)\]/g,'<img src="/assets/home/arclist/$1.gif" border="0" />');
        return str;
    }
    //发布动态

    $('#dynamic-form').on('valid.form', function(){
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;
        function success(res) {
            if (res.code) {
                layer.msg(res.msg);
                setTimeout(function(){
                    window.location.reload();
                },2000);
            } else {
                layer.msg(res.msg);
            }
        }
    });
</script>

        </main>

        <footer class="footer" style="clear:both">
            <!-- FastAdmin是开源程序，建议在您的网站底部保留一个FastAdmin的链接 -->
            <p class="copyright">Copyright&nbsp;©&nbsp;2017-2018 Powered by <a href="https://www.fastadmin.net" target="_blank">FastAdmin</a> All Rights Reserved <?php echo $site['name']; ?> <?php echo __('Copyrights'); ?> <!--<a href="https://www.miibeian.gov.cn" target="_blank"><?php echo $site['beian']; ?></a>--></p>
        </footer>

        <script>
    //layui绑定扩展
    layui.config({
        base: '/assets/home/js/'
    }).extend({
        rmlib: 'rmlib',
        protobuf: 'protobuf',
        socket: 'socket',
    });


    layui.use(['layim', 'jquery', 'socket'], function (layim, socket) {
        var $ = layui.jquery;
        var socket = layui.socket;
        var token = $('body').data('token');
        var rykey = $('body').data('rykey');

        // socket初始化。
        socket.config({
            key: rykey,
            token: token,
            layim: layim,
        });

        layim.config({

            init: {
                url: '<?php echo url("chat/get_user_data"); ?>', data: {}
            }/*,
            //获取群成员
            members: {
                url: 'json/getMembers.json', data: {}
            }*/
            //上传图片接口
            /*, uploadImage: {
                url: '/upload/image' //（返回的数据格式见下文）
                , type: '' //默认post
            }*/
            //上传文件接口
            /*, uploadFile: {
                url: '/upload/file' //（返回的数据格式见下文）
                , type: '' //默认post
            }*/

            //, isAudio: false //开启聊天工具栏音频
            //, isVideo: false //开启聊天工具栏视频
            //扩展工具栏
            /*  , tool: [{
                  alias: 'code'
                  , title: '代码'
                  , icon: '&#xe64e;'
              }]*/
            ,title: 'HTIM'
            ,copyright:true
            ,isgroup:false
            , initSkin: '3.jpg' //1-5 设置初始背景
            , notice: true //是否开启桌面消息提醒，默认false
            ,min:true //默认最小化
            , msgbox: '<?php echo url("chat/getmsgbox"); ?>' //消息盒子页面地址，若不开启，剔除该项即可
            , find:'<?php echo url("chat/find"); ?>' //发现页面地址，若不开启，剔除该项即可
            , chatLog: '<?php echo url("chat/chatlog"); ?>' //聊天记录页面地址，若不开启，剔除该项即可
            ,information: '<?php echo url("chat/information"); ?>' //获取好友资料页面
            ,addchatlog: '<?php echo url("chat/addchatlog"); ?>' //添加聊天记录接口
            ,msgreplace: '<?php echo url("chat/msgreplace"); ?>' //敏感词屏蔽接口
            ,addMyGroup: '<?php echo url("chat/addMyGroup"); ?>' //添加分组接口
            ,editMyGroup: '<?php echo url("chat/editMyGroup"); ?>' //修改分组名称接口
            ,delMyGroup: '<?php echo url("chat/delMyGroup"); ?>' //删除分组接口
            ,moveFriend: '<?php echo url("chat/moveFriend"); ?>' //移动好友接口
            ,subscribed: '<?php echo url("chat/subscribed"); ?>' //好友请求通过返回接口
            ,getmsgboxnum: '<?php echo url("chat/getmsgboxnum"); ?>' //获取盒子数量
            ,changeSign: '<?php echo url("chat/changeSign"); ?>' //修改签名接口
            ,changeOnline: '<?php echo url("chat/changeOnline"); ?>' //修改在线状态接口
            ,removeFriends:'<?php echo url("chat/removeFriends"); ?>' //删除好友接口
            ,logout: '<?php echo url("user/logout"); ?>' //退出登录
        });

    });
</script>
    </body>

</html>