<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:71:"E:\phpstudy\WWW\chat\public/../application/index\view\user\profile.html";i:1530958195;s:63:"E:\phpstudy\WWW\chat\application\index\view\layout\default.html";i:1531296815;s:65:"E:\phpstudy\WWW\chat\application\index\view\common\meta_chat.html";i:1530958441;s:63:"E:\phpstudy\WWW\chat\application\index\view\common\sidenav.html";i:1531270222;s:67:"E:\phpstudy\WWW\chat\application\index\view\common\script_chat.html";i:1530932684;}*/ ?>
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
<script src="/assets/libs/bootstrap/js/collapse.js"></script>
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
                    <ul class="nav navbar-nav pull-left">
                        <li class="active"><a href="#" >Active</a></li>
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
    .profile-avatar-container {
        position:relative;
        width:100px;
    }
    .profile-avatar-container .profile-user-img{
        width:100px;
        height:100px;
    }
    .profile-avatar-container .profile-avatar-text {
        display:none;
    }
    .profile-avatar-container:hover .profile-avatar-text {
        display:block;
        position:absolute;
        height:100px;
        width:100px;
        background:#444;
        opacity: .6;
        color: #fff;
        top:0;
        left:0;
        line-height: 100px;
        text-align: center;
    }
    .profile-avatar-container button{
        position:absolute;
        top:0;left:0;width:100px;height:100px;opacity: 0;
    }
</style>
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
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="page-header"><?php echo __('Profile'); ?></h2>
                    <form id="profile-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('api/user/profile'); ?>">
                        <?php echo token(); ?>
                        <input type="hidden" name="avatar" id="c-avatar" value="<?php echo $user['avatar']; ?>" />
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"></label>
                            <div class="col-xs-12 col-sm-4">
                                <div class="profile-avatar-container">
                                    <img class="profile-user-img img-responsive img-circle plupload" src="<?php echo $user['avatar']; ?>" alt="">
                                    <div class="profile-avatar-text img-circle"><?php echo __('Click to edit'); ?></div>
                                    <button id="plupload-avatar" type="button" class="plupload" data-mimetype="png,jpg,jpeg,gif" data-input-id="c-avatar"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Username'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" readonly  id="username" name="username" value="<?php echo $user['username']; ?>" data-rule="<?php echo __('Username'); ?>:required;username;remote(<?php echo url('api/validate/check_username_available'); ?>, id=<?php echo $user['id']; ?>)" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c-email" class="control-label col-xs-12 col-sm-2"><?php echo __('Email'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="c-email" name="email" value="<?php echo $user['email']; ?>" disabled placeholder="">
                                    <span class="input-group-btn" style="padding:0;border:none;">
                                        <a href="javascript:;" class="btn btn-info btn-change" data-type="email"><?php echo __('Change'); ?></a>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Nickname'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $user['nickname']; ?>" data-rule="<?php echo __('Nickname'); ?>:required" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c-bio" class="control-label col-xs-12 col-sm-2"><?php echo __('Intro'); ?>:</label>
                            <div class="col-xs-12 col-sm-8">
                                <input id="c-bio" data-rule="" data-tip="一句话介绍一下你自己" class="form-control" name="bio" type="text" value="<?php echo $user['bio']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c-birthday" class="control-label col-xs-12 col-sm-2"><?php echo __('Birthday'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <input id="c-birthday" data-rule="" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" name="birthday" type="text" value="<?php if($user['birthday']!=='0000-00-00'): ?><?php echo $user['birthday']; endif; ?>">
                            </div>
                        </div>
                        <div class="form-group layui-form">
                            <label  class="control-label col-xs-12 col-sm-2"><?php echo __('Gender'); ?>:</label>
                            <div class="col-xs-12 col-sm-6">
                                <input type="radio" name="gender" value="1" title="<?php echo __('Man'); ?>" <?php if($user['gender']==1): ?>checked<?php endif; ?>>
                                <input type="radio" name="gender" value="0" title="<?php echo __('Woman'); ?>" <?php if($user['gender']==0): ?>checked<?php endif; ?>>
                                <input type="radio" name="gender" value="2" title="<?php echo __('Secrecy'); ?>" <?php if($user['gender']==2): ?>checked<?php endif; ?>>
                            </div>
                        </div>
                        <div class="form-group layui-form">
                            <label for="c-country" class="control-label col-xs-12 col-sm-2"><?php echo __('Country'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <select id="c-country" name="country"  style="display: none" data-rule="<?php echo __('Country'); ?>:required" lay-search>
                                    <?php if(is_array($countrys) || $countrys instanceof \think\Collection || $countrys instanceof \think\Paginator): $i = 0; $__LIST__ = $countrys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['nicename']; ?>" <?php if($vo['nicename']==$user['country']): ?>selected<?php endif; ?>><?php echo $vo['iso']; ?>--<?php echo __($vo['nicename'],'country'); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c-bio" class="control-label col-xs-12 col-sm-2"><?php echo __('Height'); ?>(cm):</label>
                            <div class="col-xs-12 col-sm-4">
                                <input id="c-height" data-rule="<?php echo __('Height'); ?>:required:true,digits:true,range[150~220]"  class="form-control" name="height" type="text" value="<?php echo $user['height']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c-bio" class="control-label col-xs-12 col-sm-2"><?php echo __('Weight'); ?>(kg):</label>
                            <div class="col-xs-12 col-sm-4">
                                <input id="c-weight" data-rule="<?php echo __('Weight'); ?>:required:true,digits:true,range[40~200]"  class="form-control" name="weight" type="text" value="<?php echo $user['weight']; ?>">
                            </div>
                        </div>
                        <div class="form-group layui-form">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Interest'); ?>:</label>
                            <div class="col-xs-12 col-sm-10">
                                <?php if(is_array($interests) || $interests instanceof \think\Collection || $interests instanceof \think\Paginator): $i = 0; $__LIST__ = $interests;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <input type="checkbox" name="interest[]" title="<?php echo __($vo['name_en']); ?>" value="<?php echo $vo['name_en']; ?>" <?php if(isset($user['interest'])&&$user['interest']!=='null'): if(in_array($vo['name_en'],json_decode($user['interest']))): ?>checked<?php endif; endif; ?>>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>

                        <div class="form-group normal-footer">
                            <label class="control-label col-xs-12 col-sm-2"></label>
                            <div class="col-xs-12 col-sm-8">
                                <button type="submit" class="btn btn-primary btn-embossed"><?php echo __('Ok'); ?></button>
                                <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/html" id="emailtpl">
    <form id="email-form" class="form-horizontal form-layer" method="POST" action="<?php echo url('api/user/changeemail'); ?>">
        <div class="form-body">
            <input type="hidden" name="action" value="changeemail" />
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3"><?php echo __('New Email'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <input type="text" class="form-control" id="email" name="email" value="" data-rule="required;email;remote(<?php echo url('api/validate/check_email_available'); ?>, event=changeemail, id=<?php echo $user['id']; ?>)" placeholder="<?php echo __('New email'); ?>">
                    <span class="msg-box"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3"><?php echo __('Captcha'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <div class="input-group">
                        <input type="text" name="captcha" id="email-captcha" class="form-control" data-rule="required;length(4);integer[+];remote(<?php echo url('api/validate/check_ems_correct'); ?>, event=changeemail, email:#email)" />
                        <span class="input-group-btn" style="padding:0;border:none;">
                            <a href="javascript:;" class="btn btn-info btn-captcha" data-url="<?php echo url('api/ems/send'); ?>" data-type="email" data-event="changeemail">获取验证码</a>
                        </span>
                    </div>
                    <span class="msg-box"></span>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <div class="form-group" style="margin-bottom:0;">
                <label class="control-label col-xs-12 col-sm-3"></label>
                <div class="col-xs-12 col-sm-8">
                    <button type="submit" class="btn btn-md btn-primary"><?php echo __('Submit'); ?></button>
                </div>
            </div>
        </div>
    </form>
</script>
<style>
    .form-layer {height:100%;min-height:150px;min-width:300px;}
    .form-body {
        width:100%;
        overflow:auto;
        top:0;
        position:absolute;
        z-index:10;
        bottom:50px;
        padding:15px;
    }
    .form-layer .form-footer {
        height:50px;
        line-height:50px;
        background-color: #ecf0f1;
        width:100%;
        position:absolute;
        z-index:200;
        bottom:0;
        margin:0;
    }
    .form-footer .form-group{
        margin-left:0;
        margin-right:0;
    }
</style>

<script>
    layui.use(['laydate','upload','jquery','form'], function(){
        var laydate = layui.laydate,
            upload = layui.upload,
            $ = layui.jquery,
            Form = layui.form;

        //执行一个laydate实例
        laydate.render({
            elem: '#c-birthday' //指定元素
        });
        upload.render({
            elem: '#plupload-avatar'
            ,url: '/api/common/upload'
            ,done: function(res, index, upload){
                if(res.code == 1){
                    layer.msg(res.msg);
                    $('#c-avatar').val(res.data.url);
                    $('.profile-user-img').prop('src',res.data.url);
                }else{
                    layer.msg(res.msg);
                }
            }
        });

        /*layer.open({
            type: 2,
            content: '<?php echo url("user/remail"); ?>' //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
        });
*/

        $(document).on("click", ".btn-change", function () {
            var id = "resetpwdtpl";
            layer.open({
                type: 2,
                title: "<?php echo __('Edit email'); ?>",
                area: ['300px','300px'],
                content: ['<?php echo url("user/remail"); ?>','no'],
                success: function(layero, index){
                    var body = layer.getChildFrame('body', index);
                    body.find('form').submit(function() {
                        setTimeout(function () {
                            var success = body.find('#success').val()
                            if(success == 'success'){
                                $('#c-email').val(body.find('#email').val());
                                layer.close(index);
                            }
                        },500)
                    })
                }
            });
        });

    });
    $.validator.setTheme('bootstrap', {
        validClass: 'has-success',
        invalidClass: 'has-error',
        bindClassTo: '.form-group',
        formClass: 'n-default n-bootstrap',
        msgClass: 'n-right'
    });
    $('#profile-form').on('valid.form', function(){
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;
        function success(res) {
            if (res.code) {
                layer.msg(res.msg,{icon:1})
            } else {
                layer.msg(res.msg, {icon: 5});
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