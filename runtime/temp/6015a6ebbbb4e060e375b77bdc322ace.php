<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"E:\phpstudy\WWW\chat\public/../application/index\view\index\index.html";i:1530337099;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>M-finder WebIM</title>
    <link rel="stylesheet" href="/assets/home/layui/css/layui.css">
    <link rel="stylesheet" href="/assets/home/css/menu.css">
    <link rel="stylesheet" href="/assets/home/css/contextMenu.css" />
    <link href="favicon.ico" type="image/vnd.microsoft.icon" rel="shortcut icon"/>
</head>

<body data-token="<?php echo $userinfo['token']; ?>" data-rykey="<?php echo $site['ry_key']; ?>">

<p>加我为好友</p>


<script src="/assets/home/layui/layui.js"></script>
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
            ,title: 'WebIM'
            ,copyright:true
            ,isgroup:false
            , initSkin: '3.jpg' //1-5 设置初始背景
            , notice: true //是否开启桌面消息提醒，默认false
            , msgbox: layui.cache.dir + 'css/modules/layim/html/msgbox.html' //消息盒子页面地址，若不开启，剔除该项即可
           /* , find:'<?php echo url("chat/find"); ?>' //发现页面地址，若不开启，剔除该项即可*/
            , chatLog: layui.cache.dir + 'css/modules/layim/html/chatLog.html' //聊天记录页面地址，若不开启，剔除该项即可

            ,information: '<?php echo url("chat/information"); ?>' //获取好友资料页面
            ,addchatlog: '<?php echo url("chat/addchatlog"); ?>' //添加聊天记录接口
        });

    });
</script>
</body>

</html>
