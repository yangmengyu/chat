<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"E:\phpstudy\WWW\chat\public/../application/index\view\chat\information.html";i:1530336363;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>好友/群资料</title>
    <link rel="stylesheet" href="/assets/home/layui/css/layui.css">
    <link rel="stylesheet" href="/assets/home/layui/css/layui.demo.css">
    <style type="text/css">
        .layim-msgbox{margin: 15px;}
        .layim-msgbox li{position: relative; margin-bottom: 10px; padding: 0 110px 10px 60px; padding-bottom: 10px; line-height: 22px; border-bottom: 1px dotted #e2e2e2;width: 200px;}
        .layim-msgbox .layim-msgbox-tips{margin: 0; padding: 10px 0; border: none; text-align: center; color: #999;}
        .layim-msgbox .layim-msgbox-system{padding: 0 10px 10px 10px;}
        .layim-msgbox li p span{padding-left: 5px; color: #999;}
        .layim-msgbox li p em{font-style: normal; color: #FF5722;}
        .layim-msgbox-avatar{position: absolute; left: 0; top: 0; width: 50px; height: 50px;}
        .layim-msgbox-user{padding-top: 5px;}
        .layim-msgbox-content{margin-top: 3px;}
        .layim-msgbox .layui-btn-small{padding: 0 15px; margin-left: 5px;}
        .layim-msgbox-btn{position: absolute; right: 0; top: 12px; color: #999;}
        .pt15{padding-top: 15px;}
        .pt10{padding-top: 10px;}
        .pt30{padding-top: 30px;}
        .pd0{padding: 0px;}
        .chat{
            float: right;
            margin-top: -45px;
            margin-right: -110px;
            z-index: 999999;
        }
        .label{
            float: left;
            display: block;
            padding: 9px 5px 9px 20px;
            width: 40px;
            font-weight: 400;
            text-align: right;
        }
        .label_key{
            float: left;
            display: block;
            padding: 9px 5px;
            font-weight: 400;
        }
        .block {
            margin-left: 55px;
            min-height: 36px;
        }
        .layui-input, .layui-textarea {
            display: block;
            width: 90%;
            padding-left: 10px;
        }
        .noresize{
            resize:none;
        }
        .select{
            height: 38px;
            line-height: 38px;
            border: 1px solid #e6e6e6;
            background-color: #fff;
            border-radius: 2px;
        }
    </style>
</head>
<body>
<div class="layui-form" id="LAY_view">

</div>
    <div class="layui-form-item pt15">
        <div class="layim-msgbox">
            <li>
                <a href="javascript:void(0);" target="_blank">
                    <img src="<?php echo $data['avatar']; ?>" class="layui-circle layim-msgbox-avatar" >
                </a>
                <p class="layim-msgbox-user">
                    <span style="letter-spacing: 5px;">昵 称</span> <?php echo $data['nickname']; ?>
                </p>
                <p class="layim-msgbox-user">
                    <span>会员号</span> <?php echo $data['id']; ?>
                </p>
                <button class="layui-btn layui-btn layui-btn-primary chat" data-avatar="<?php echo $data['avatar']; ?>" data-name="<?php echo $data['nickname']; ?>" data-chattype="friend" data-type="chat" data-uid="<?php echo $data['id']; ?>">发送消息</button>
            </li>
        </div>

    </div>
    <div class="layui-col-xs12 pt10">
        <label class="label">性&nbsp;&nbsp;别</label>
        <div class="block">
            <label class="label_key">
                <?php if($data['gender']==1): ?>
                男
                <?php elseif($data['gender']==0): ?>
                女
                <?php else: ?>
                保密
                <?php endif; ?>
            </label>
        </div>
    </div>
    <!--<div class="layui-col-xs12 pt10">
        <div class="layui-col-xs6 ">
            <label class="label">生&nbsp;&nbsp;日</label>
            <div class="block">
                <div class="label_key"><?php echo $data['birthday']; ?></div>
            </div>
        </div>
        <div class="layui-col-xs6">
            <label class="label">血&nbsp;&nbsp;型</label>
            <div class="block">
                <label class="label_key">
                    b
                </label>
            </div>
        </div>
    </div>
    <div class="layui-col-xs11 pt10">
        <label class="label">职&nbsp;&nbsp;业</label>
        <div class="block">
            <label class="label_key">
                b
            </label>
        </div>
    </div>
    <div class="layui-col-xs12 pt10">
        <label class="label">Q&nbsp;&nbsp;&nbsp;&nbsp;Q</label>
        <div class="block">
            <div class="label_key">{{d.data.qq || []}}</div>
        </div>
    </div>
    <div class="layui-col-xs12 pt10">
        <label class="label">微&nbsp;&nbsp;信</label>
        <div class="block">
            <div class="label_key">{{d.data.wechat || []}}</div>
        </div>
    </div>
    <div class="layui-col-xs12 pt10">
        <label class="label">手&nbsp;&nbsp;机</label>
        <div class="block">
            <div class="label_key">{{d.data.phoneNumber || []}}</div>
        </div>
    </div>
    <div class="layui-col-xs12 pt10">
        <label class="label">邮&nbsp;&nbsp;箱</label>
        <div class="block">
            <div class="label_key">{{d.data.emailAddress || []}}</div>
        </div>
    </div>-->
    <div class="layui-col-xs12 pt10">
        <label class="label">签&nbsp;&nbsp;名</label>
        <div class="block">
            <div class="label_key"><?php echo $data['bio']; ?></div>
        </div>
    </div>

</body>
<script src="/assets/home/layui/layui.js"></script>
<script>
    layui.use(['layim'], function(layim){
        var $ = layui.jquery;

        $('.chat').click(function () {
            var othis = $(this);
            var  uid = othis.data('uid'), avatar = othis.data('avatar');
            parent.layui.layim.chat({
                name: othis.data('name')
                ,type: othis.data('chattype')
                ,avatar: avatar
                ,id: uid
            });
        });
        $("#close").click(function(){
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        });
    });

</script>
</html>
