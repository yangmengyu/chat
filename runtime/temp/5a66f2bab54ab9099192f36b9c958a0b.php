<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:70:"E:\phpstudy\WWW\chat\public/../application/index\view\index\index.html";i:1531808869;s:63:"E:\phpstudy\WWW\chat\application\index\view\layout\default.html";i:1531466924;s:65:"E:\phpstudy\WWW\chat\application\index\view\common\meta_chat.html";i:1531808861;s:69:"E:\phpstudy\WWW\chat\application\index\view\common\sidenav_index.html";i:1531724250;s:67:"E:\phpstudy\WWW\chat\application\index\view\common\script_chat.html";i:1531730320;}*/ ?>
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
            <link rel="stylesheet" href="/assets/home/css/thumbnail-gallery.css">

<div id="content-container" class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="sidenav">
    <ul class="list-group">
        <li class="list-group-heading">
            <div class="media">
                <div class="media-left">
                    <a href="<?php echo url('user/profile'); ?>">
                        <img class="media-object" data-src="<?php echo $user['avatar']; ?>" alt="<?php echo $user['nickname']; ?>" style="width: 64px; height: 64px;border-radius: 5px;" src="<?php echo $user['avatar']; ?>" data-holder-rendered="true">
                    </a>
                </div>
                <div class="media-body">
                    <h3 class="media-heading"><?php echo $user['nickname']; ?></h3>
                    <br>
                    ID:<?php echo $user['id']; ?>
                </div>
            </div>
        </li>
        <li class="list-group-heading">
            <i class="layui-icon layui-icon-diamond" style="font-size: 20px; color: #e60020;"></i>
            <?php echo $user['score']; ?>
        </li>
        <li class="list-group-item <?php echo $config['actionname']=='index'?'active':''; ?>"> <a href="<?php echo url('user/index'); ?>"><i class="fa fa-heart fa-fw"></i> <?php echo __('The person I like'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='profile'?'active':''; ?>"> <a href="<?php echo url('user/profile'); ?>"><i class="fa fa-heart-o fa-fw"></i> <?php echo __('People who like me'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='changepwd'?'active':''; ?>"> <a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-heartbeat fa-fw"></i> <?php echo __('Like each other'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='changepwd'?'active':''; ?>"> <a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-users fa-fw"></i> <?php echo __('Visitor'); ?></a> </li>

    </ul>
</div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="page-header"><?php echo __('Profile'); ?></h2>
                    <div class="tz-gallery">

                        <div class="row">
                            <ul class="flow-default" id="LAY_demo1"></ul>
                            <!--<li class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <a class="lightbox" href="/uploads/images/park.jpg">
                                        <img src="/uploads/images/park.jpg" alt="Park">
                                    </a>
                                    <div class="caption caption_1">
                                        <h3>
                                            <span>yangmengyu</span>
                                            <i class="iconfont">&#xe601;</i>
                                            <i class="layui-icon layui-icon-radio"></i>
                                        </h3>
                                        <p>
                                            27,安道尔
                                        </p>
                                    </div>
                                    <div class="caption caption_2">
                                        <span class="fa-stack fa-2x icon-heart" >
                                              <i class="fa fa-circle fa-stack-2x"></i>
                                              <i class="fa fa-heart-o fa-stack-1x"></i>
                                        </span>
                                        <span class="fa-stack fa-2x icon-email">
                                              <i class="fa fa-circle fa-stack-2x"></i>
                                              <i class="fa fa-envelope-o fa-stack-1x"></i>
                                        </span>

                                    </div>
                                </div>
                            </li>-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    layui.use('flow', function(){
        var flow = layui.flow
            ,param =  location.search;

        flow.load({
            elem: '#LAY_demo1' //流加载容器
            ,done: function(page, next){ //执行下一页的回调
                var url = '<?php echo url("index/index"); ?>';
                $.post(url+param, {page:page}, function(res){
                    if(res.code == 1){
                        var lis = [];
                        for(var i = 0; i < res.data.data.length; i++){
                            var str = '<li class="col-sm-6 col-md-4"> <div class="thumbnail"> <a class="lightbox" href="/uploads/images/park.jpg"> <img src="'+res.data.data[i].avatar+'" alt="Park"> </a> <div class="caption caption_1"> <h3>';
                            if(res.data.data[i].gender == '0'){
                                str += '<span><i class="fa fa-venus text-danger fa-fw"></i>'+res.data.data[i].nickname+'</span>';
                            }else if(res.data.data[i].gender == '1'){
                                str += '<i class="fa fa-mars text-info fa-fw"></i><span>'+res.data.data[i].nickname+'</span>';
                            }else{
                                str += '<i class="fa fa-genderless text-success fa-fw"></i><span>'+res.data.data[i].nickname+'</span>';
                            }

                            //是否为 VIP
                            if(res.data.data[i].isvip == 1){
                                str += '<i class="iconfont">&#xe601;</i>';
                            }
                            //是否在线
                            if(res.data.data[i].online == 'online') {
                                str += '<i class="layui-icon layui-icon-radio"></i>';
                            }
                            str += '</h3> <p>'+res.data.data[i].age+','+res.data.data[i].country+' </p> </div> <div class="caption caption_2"> ';
                            //是否喜欢
                            if(res.data.data[i].like==1){
                                str += '<span data-uid="'+res.data.data[i].id+'" class="fa-stack fa-2x icon-heart active" > <i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-heart fa-stack-1x"></i></span>';
                            }else{
                                str += '<span data-uid="'+res.data.data[i].id+'" class="fa-stack fa-2x icon-heart" > <i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-heart-o fa-stack-1x"></i></span>';
                            }
                            //发送消息
                            str += '<span data-uid="'+res.data.data[i].id+'" data-name="'+res.data.data[i].nickname+'" data-avatar="'+res.data.data[i].avatar+'" data-status="'+res.data.data[i].status+'" class="fa-stack fa-2x icon-email"><i class="fa fa-circle fa-stack-2x"></i>';6
                            str += '<i class="fa fa-envelope-o fa-stack-1x"></i>';
                            str += '</span></div> </div> </li>';
                            lis.push(str);
                        }
                        //执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
                        //pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
                        next(lis.join(''), page < res.data.total);
                    }else{
                        layer.msg(res.msg);
                    }

                });


            }
        });


        //按屏加载图片
        flow.lazyimg({
            elem: '#LAY_demo3 img'
            ,scrollElem: '#LAY_demo3' //一般不用设置，此处只是演示需要。
        });
        $("#LAY_demo1").on("click",'.icon-email',function(){
            var  uid = $(this).data('uid'),
                name = $(this).data('name'),
                avatar =  $(this).data('avatar');
            parent.layui.layim.chat({
                name:  name
                ,type: 'friend'
                ,avatar: avatar
                ,status: status
                ,id: uid
            });
        });
        $("#LAY_demo1").on("click",'.icon-heart',function(){
            var uid = $(this).data('uid');
            $.post('<?php echo url("index/like"); ?>',{to:uid},function (res) {
                if(res.code == 1){
                    layer.msg(res.msg);
                    $('.icon-heart').addClass('active');
                    $(this).find('.fa-stack-1x').addClass('fa-heart');
                    $(this).find('.fa-stack-1x').removeClass('fa-heart-o');
                }else{
                    $('.icon-heart').removeClass('active');
                    layer.msg(res.msg);
                }
            })
        });

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