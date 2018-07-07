<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:73:"E:\phpstudy\WWW\chat\public/../application/index\view\user\changepwd.html";i:1530955644;s:63:"E:\phpstudy\WWW\chat\application\index\view\layout\default.html";i:1530925848;s:65:"E:\phpstudy\WWW\chat\application\index\view\common\meta_chat.html";i:1530937395;s:63:"E:\phpstudy\WWW\chat\application\index\view\common\sidenav.html";i:1530232546;s:67:"E:\phpstudy\WWW\chat\application\index\view\common\script_chat.html";i:1530932684;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?> – <?php echo __('The fastest framework based on ThinkPHP5 and Bootstrap'); ?></title>
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
<script src="/assets/home/layui/layui.js"></script>
<script src="/assets/home/js/jquery-3.1.1.min.js"></script>
<script src="/assets/libs/nice-validator/dist/jquery.validator.js?local=<?php echo $config['language']; ?>"></script>
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
                    <ul class="nav navbar-nav navbar-right" >
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
                                <li><a href="<?php echo url('user/index'); ?>"><i class="fa fa-user-circle fa-fw"></i><?php echo __('User center'); ?></a></li>
                                <li><a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i><?php echo __('Profile'); ?></a></li>
                                <li><a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i><?php echo __('Change password'); ?></a></li>
                                <li><a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i><?php echo __('Sign out'); ?></a></li>
                                <?php else: ?>
                                <li><a href="<?php echo url('user/login'); ?>"><i class="fa fa-sign-in fa-fw"></i> <?php echo __('Sign in'); ?></a></li>
                                <li><a href="<?php echo url('user/register'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Sign up'); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php if(\think\Config::get('lang_switch_on')): ?>
                        <li class="dropdown">
                            <a href="<?php echo url('user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language fa-fw"></i><span>语言</span> <b class="caret"></b></a>
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
            <div id="content-container" class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="sidenav">
    <ul class="list-group">
        <li class="list-group-heading"><?php echo __('User center'); ?></li>
        <li class="list-group-item <?php echo $config['actionname']=='index'?'active':''; ?>"> <a href="<?php echo url('user/index'); ?>"><i class="fa fa-user-circle fa-fw"></i> <?php echo __('User center'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='profile'?'active':''; ?>"> <a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Profile'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='changepwd'?'active':''; ?>"> <a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i> <?php echo __('Change password'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='logout'?'active':''; ?>"> <a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo __('Sign out'); ?></a> </li>
    </ul>
</div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="page-header"><?php echo __('Change password'); ?></h2>
                    <form id="changepwd-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
                        <?php echo token(); ?>
                        <div class="form-group">
                            <label for="oldpassword" class="control-label col-xs-12 col-sm-2"><?php echo __('Old password'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="password" class="form-control" id="oldpassword" name="oldpassword" value="" data-rule="<?php echo __('Old password'); ?>:required;password" placeholder="<?php echo __('Old password'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newpassword" class="control-label col-xs-12 col-sm-2"><?php echo __('New password'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="password" class="form-control" id="newpassword" name="newpassword" value="" data-rule="<?php echo __('New password'); ?>:required;password" placeholder="<?php echo __('New password'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="renewpassword" class="control-label col-xs-12 col-sm-2"><?php echo __('Renew password'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="password" class="form-control" id="renewpassword" name="renewpassword" value=""  data-rule="<?php echo __('Renew password'); ?>required;password;match(newpassword)" placeholder="<?php echo __('Renew password'); ?>" />
                            </div>
                        </div>

                        <div class="form-group normal-footer">
                            <label class="control-label col-xs-12 col-sm-2"></label>
                            <div class="col-xs-12 col-sm-8">
                                <button type="submit" class="btn btn-primary btn-embossed"><?php echo __('Submit'); ?></button>
                                <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#changepwd-form').on('valid.form', function(){
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;
        function success(res) {
            if (res.code) {
                layer.msg(res.msg,{icon:1})
            } else {
                layer.msg(res.msg, {icon: 5});
                setTimeout(function () {
                    location.reload();
                },1000);

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
            , uploadImage: {
                url: '/upload/image' //（返回的数据格式见下文）
                , type: '' //默认post
            }
            //上传文件接口
            , uploadFile: {
                url: '/upload/file' //（返回的数据格式见下文）
                , type: '' //默认post
            }

            , isAudio: false //开启聊天工具栏音频
            , isVideo: false //开启聊天工具栏视频
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