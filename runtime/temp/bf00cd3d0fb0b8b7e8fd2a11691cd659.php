<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\phpstudy\WWW\chat\public/../application/index\view\chat\find.html";i:1530756296;}*/ ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>发现</title>
    <link rel="stylesheet" href="/assets/home/layui/css/layui.css">
    <style type="text/css">
        .layui-find-list li img {
            position: absolute;
            left: 15px;
            top: 8px;
            width: 36px;
            height: 36px;
            border-radius: 100%;
        }
        .layui-find-list li {
            position: relative;
            height: 90px;;
            padding: 5px 15px 5px 60px;
            font-size: 0;
            cursor: pointer;
        }
        .layui-find-list li * {
            display: inline-block;
            vertical-align: top;
            font-size: 14px;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
        }
        .layui-find-list li span {
            margin-top: 4px;
            max-width: 155px;
        }

        .layui-find-list li p {
            display: block;
            line-height: 18px;
            font-size: 12px;
            color: #999;
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
        }
        .back{
            cursor:pointer;
        }
        .lay_page{position: fixed;bottom: 0;margin-left: -15px;margin-bottom: 20px;background: #fff;width: 100%;}
        .layui-laypage{width: 105px;margin:0 auto;display: block}
    </style>
    <!-- <script src="../../../../layui.2.1.7.js"></script> -->
    <script src="/assets/home/layui/layui.js"></script>
</head>
<body>
<div class="layui-form">
    <div class="layui-container" style="padding:0">
        <div class="layui-row layui-col-space3">
            <div class="layui-col-xs7 mt15">
                <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入会员号/昵称/手机号/邮箱" class="layui-input">
            </div>
            <div class="layui-col-xs1 mt15" >
                <button class="layui-btn btncolor find">查找</button>
            </div>

            <div class="layui-col-xs3 mt15" style="display: none">
                <input type="radio" name="add" value="friend" title="找人" checked="">
                <input type="radio" name="add" value="group" title="找群">
                <button class="layui-btn layui-btn-mini btncolor createGroup" >我要建群</button>
            </div>
        </div>
        <div id="LAY_view"></div>
        <textarea title="消息模版" id="LAY_tpl" style="display:none;">
			<fieldset class="layui-elem-field layui-field-title">
			  <legend>{{ d.legend}}</legend>
			</fieldset>
			<div class="layui-row ">
				{{# if(d.type == 'friend'){ }}
					{{#  layui.each(d.data, function(index, item){ }}
					<div class="layui-col-xs3 layui-find-list">
						<li layim-event="add" data-type="friend" data-index="0" data-uid="{{ item.id }}" data-name="{{item.nickname}}" data-avatar="{{item.avatar}}">
							<img src="{{item.avatar}}">
							<span>{{item.nickname}}({{item.id}})</span>
							<p>{{item.bio}}  {{#  if(item.bio == ''){ }}我很懒，懒得写签名{{#  } }} </p>
							<button class="layui-btn layui-btn-mini btncolor add" data-type="friend" data-uid="{{ item.id }}" data-name="{{item.nickname}}" data-avatar="{{item.avatar}}><i class="layui-icon">&#xe654;</i>加好友</button>
						</li>
					</div>
					{{#  }); }}
				{{# }else{ }}
					{{#  layui.each(d.data, function(index, item){ }}
					<div class="layui-col-xs3 layui-find-list">
						<li layim-event="add" data-type="group" data-approval="{{ item.approval }}" data-index="0" data-uid="{{ item.groupIdx }}" data-name="{{item.groupName}}">
							<img src="{{item.groupIdx}}.jpg">
							<span>{{item.groupName}}({{item.groupIdx}})</span>
							<p>{{item.des}}  {{#  if(item.des == ''){ }}无{{#  } }} </p>
							<button class="layui-btn layui-btn-mini btncolor add" data-type="group"><i class="layui-icon">&#xe654;</i>加群</button>
						</li>
					</div>
					{{#  }); }}
				{{# } }}
			</div>
        </textarea>

        <div class="lay_page" id="LAY_page" ></div>
    </div>
</div>

<script>
    //layui绑定扩展
    layui.config({
        base: '/assets/home/js/'
    }).extend({
        rmlib: 'rmlib',
        protobuf: 'protobuf',
        socket: 'socket',
    });
    layui.use(['layim','laytpl','socket','laypage'], function(){
        var layim = layui.layim
            , layer = layui.layer
            ,laytpl = layui.laytpl
            ,$ = layui.jquery
            ,form = layui.form
            ,cache = parent.layui.layim.cache()
            ,socket = layui.socket
            ,param =  location.search
            ,laypage = layui.laypage;
        $(function(){getRecommend(); });
		function getRecommend() {
            var url = '<?php echo url("chat/getRecommend"); ?>';
            $.get(url+param, {}, function(res){
                /*console.log(res);*/
                if(res.code !== 0){
                    var html = laytpl(LAY_tpl.value).render({
                        data: res.data,
                        legend:'推荐好友',
                        type:'friend'
                    });
                    $('#LAY_view').html(html);
                }else{
                    return layer.msg(res.msg);
                }
            });
        }


        $('body').on('click', '.add', function () {
            var othis = $(this), type = othis.data('type');
            var li = othis.parent()
                , uid = li.data('uid') || othis.data('id')
                , name = li.data('name')
                , approval = li.data('approval')
				,avatar = li.data('avatar')
			;
            if (uid == 'undifine' || !uid) {
                var uid = othis.parent().data('id'), name = othis.parent().data('name');
            }
            var isAdd = false;
            if (type == 'friend') {
                var default_avatar = "/assets/home/img/default_avatar.jpg";
                if(cache.mine.id == uid){  /*是否添加的自己*/
                    layer.msg('<?php echo __("You can't add yourself"); ?>');
                    return false;
				}
				layui.each(cache.friend,function (index1,item1) {
					layui.each(item1.list,function (index,item) {   /*是否已有该好友*/
						if(item.id == uid) {isAdd = true;}
                    })
				})
            }else{
                var default_avatar = "/assets/home/img/default_group.jpg";
                for (i in cache.group)   /*是否已经加群*/
                {
                    if (cache.group[i].id == uid) {isAdd = true;break;}
                }
            }
            if(isAdd === true){
                layer.msg('<?php echo __("This user is already your friend"); ?>');
                return false;
			}
            layui.layim.add({  /*弹出添加好友对话框*/
				approval:approval
				,username:name || []
				,uid:uid
				,avatar:avatar?avatar:default_avatar
				,group:cache.friend || []
				,type:type
				,submit:function (group,remark,index) {  /*确认发送添加请求*/
					if(type == 'friend'){
                        $.post('<?php echo url("chat/addMsg"); ?>', {to: uid,msgType:1,remark:remark,mygroupid:group}, function (res) {
                            if (res.code !== 0) {
                                layer.msg(res.msg);
                            }else{
                                layer.msg(res.msg);
                            }
                        });

					}else{
                        layer.msg(res.msg);
					}
                   layer.close(index);
                }
			})
        });
        //下一篇分享创建群的html
        // $('body').on('click', '.createGroup', function () );
        //返回推荐好友
        $('body').on('click', '.back', function () {
            getRecommend();
            $("#LAY_page").css("display","none");
        });

        $("body").keydown(function(event){
            if(event.keyCode==13){
                $(".find").click();
            }
        });

        $('body').on('click', '.find', function () {
            $("#LAY_page").css("display","block");
            var othis = $(this),input = othis.parents('.layui-col-space3').find('input').val();
            var addType = $('input:radio:checked').val();
            console.log(input);
            // if (input) {
            //这里需要从服务器获取数据然后进行填充
            //以下为示例

             $.post('<?php echo url("chat/friendtotal"); ?>',{type:addType,value:input}, function(res){
             	if(res.code !== 0){
                    laypage.render({
                        elem: 'LAY_page'
                        ,count: res.data.count
                        ,limit: res.data.limit
                        ,prev: '<i class="layui-icon">&#58970;</i>'
                        ,next: '<i class="layui-icon">&#xe65b;</i>'
                        ,layout: ['prev', 'next']
                        ,curr: res.data.limit,jump: function(obj, first){
                            // obj包含了当前分页的所有参数，比如：
                            $.post('<?php echo url("chat/getFindFriend"); ?>',{type:addType,value:input,page: obj.curr || 1},function(res){
                                if(res.code !== 0){
                                    var html = laytpl(LAY_tpl.value).render({
                                        data: res.data,
                                        legend:'<a class="back"><i class="layui-icon">&#xe65c;</i>返回</a> 查找结果',
                                        type:addType
                                    });
                                    $('#LAY_view').html(html);
								}else{
                                    return layer.msg(res.msg);
								}
                            });
                        }
                    });
             	}else{
                    return layer.msg(res.msg);
				}

            });
        });
    });
</script>
</body>
</html>
