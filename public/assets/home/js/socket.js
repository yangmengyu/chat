layui.define(['jquery', 'layer', 'rmlib', 'protobuf','contextMenu','form'], function (exports) {
    var lib = layui.rmlib;
    var $ = layui.jquery;
    var layer = layui.layer;
    var contextMenu = layui.contextMenu;
    var cachedata =  layui.layim.cache();
    var conf = {
        uid: 0, //连接的用户id，必须传
        key: '', //融云key
        layim: null,
        token: null,
    };

    var socket = {
        config: function (options) {
            conf = $.extend(conf, options); //把layim继承出去，方便在register中使用
            console.log('当前用户配置 ：' + options);
            this.register();
            im.init(options.key);
            im.connectWithToken(options.token);
        },
        register: function () {
            var layim = conf.layim;
            if (layim) {
                //监听在线状态的切换事件
                layim.on('online', function (data) {
                    console.log('在线状态'+data);
                });
                //监听签名修改
                layim.on('sign', function (value) {
                    console.log(value);
                    $.post('class/doAction.php?action=change_sign', {sign: value}, function (data) {
                        console.log('签名修改'+data);
                    });
                });
                //监听自定义工具栏点击，以添加代码为例
                layim.on('tool(code)', function (insert) {
                    layer.prompt({
                        title: '插入代码'
                        , formType: 2
                        , shade: 0
                    }, function (text, index) {
                        layer.close(index);
                        insert('[pre class=layui-code]' + text + '[/pre]'); //将内容插入到编辑器
                    });
                });
                //监听layim建立就绪
                layim.on('ready', function (res) {
                    //console.log(res.mine);
                    /*layim.msgbox(5);*/ //模拟消息盒子有新消息，实际使用时，一般是动态获得
                    //添加好友（如果检测到该socket）
                     layui.ext.init(); //更新右键点击事件
                    layim.addList({
                        type: 'group'
                        , avatar: "static/img/tel.jpg"
                        , groupname: '海贼世界'
                        , id: "1"
                        , members: 0
                    });
                    im.joinGroup('1', '海贼世界');  //加入融云群组*/
                });

                //监听查看群员
                layim.on('members', function (data) {
                    console.log('群成员'+data);
                });

                //监听聊天窗口的切换
                layim.on('chatChange', function (res) {
                    var type = res.data.type;
                    /*console.log(res.data.id)*/
                    if (type === 'friend') {
                        //模拟标注好友状态
                        //layim.setChatStatus('<span style="color:#FF5722;">在线</span>');
                    } else if (type === 'group') {
                        //模拟系统消息
//                        layim.getMessage({
//                            system: true
//                            , id: res.data.id
//                            , type: "group"
//                            , content: '模拟群员' + (Math.random() * 100 | 0) + '加入群聊'
//                        });
                    }
                });
                //监听发送消息
                layim.on('sendMessage', function (data) {

                    /*console.log(data);*/
                    im.sendMsg(data);
                });
            }
        },
    };

    var im = {
        init: function (key) { //初始化融云key
            lib.RongIMClient.init(key);
            console.log('key');
            this.initListener();    //初始化事件监听
            this.defineMessage();   //初始化自定义消息类型
        },
        initListener: function () { //初始化监听
            console.log('注册服务连接监听事件');
            RongIMClient.setConnectionStatusListener({//连接监听事件
                onChanged: function (status) {
                    switch (status) {
                        case lib.ConnectionStatus.CONNECTED: //链接成功
                            console.log('链接成功');
                            break;
                        case lib.ConnectionStatus.CONNECTING: //正在链接
                            console.log('正在链接');
                            break;
                        case lib.ConnectionStatus.DISCONNECTED: //重新链接
                            console.log('断开连接');
                            break;
                        case lib.ConnectionStatus.KICKED_OFFLINE_BY_OTHER_CLIENT://其他设备登录
                            console.log('其他设备登录');
                            break;
                        case lib.ConnectionStatus.ConnectionStatus.NETWORK_UNAVAILABLE: //网络不可用
                            console.log('网络不可用');
                            break;
                    }
                }});

            RongIMClient.setOnReceiveMessageListener({// 消息监听器
                onReceived: function (message) { // 接收到的消息
                    /*console.log(message);*/
                    switch (message.objectName) { // 判断消息类型
                        case 'LAYIM:CHAT':
                            conf.layim.getMessage(message.content);
                            break;
                        case 'LAYIM:SYS':
                            var num = $('.layim-tool-msgbox').find('span').text() | 0;
                            conf.layim.msgbox(parseInt(num)+1);
                            break;
                        case 'LAYIM:FRIENDADD':
                            if(message.content.message.content == 'SUCCESS'){
                                $.post(cachedata.base.subscribed, {from: message.targetId,}, function (res) {
                                    var default_avatar = '/assets/img/avatar.png';
                                    layui.layim.addList({
                                        type:'friend',
                                        avatar:res.data.avatar?res.data.avatar:default_avatar,
                                        username:res.data.username,
                                        sign:res.data.sign,
                                        groupid:res.data.groupid,
                                        id:res.data.id
                                    });
                                    ext.init();
                                })
                            }
                            break;
                    }
                }
            });
        },
        connectWithToken: function (token) {    //连接事件
            RongIMClient.connect(token, {
                onSuccess: function (userId) {
                    console.log("Login successfully." + userId);
                },
                onTokenIncorrect: function () {
                    console.log('token无效');
                },
                onError: function (errorCode) {
                    console.log('发送失败:' + errorCode);
                }
            });
        },
        //融云自定义消息，把消息格式定义为layim的消息类型
        defineMessage: function () {
            var defineMsg = function (obj) {
                RongIMClient.registerMessageType(obj.msgName, obj.objName, obj.msgTag, obj.msgProperties);
            }
            //注册普通消息
            var textMsg = {
                msgName: 'LAYIM_TEXT_MESSAGE',
                objName: 'LAYIM:CHAT',
                msgTag: new lib.MessageTag(false, false),
                msgProperties: ["username", "avatar", "id", "type", "content"]
            };
            //注册
            console.log('注册用户自定义消息类型：LAYIM_TEXT_MESSAGE');
            defineMsg(textMsg);

        },
        sendMsg: function (data) {  //根据layim提供的data数据，进行解析

            var mine = data.mine;
            var to = data.to;
            var id = mine.id;   //当前用户id
            var type = to.type;
            if (type == 'group') {
                id = to.id;     //如果是group类型，id就是当前groupid，切记不可写成 mine.id否则会出现一些问题。
            }
            //构造消息
            var msg = {
                username: mine.username
                , avatar: mine.avatar
                , id: id
                , type: to.type
                , content: mine.content
            };
            //这里要判断消息类型
            if(type == 'friend'){
                var conversationType = lib.ConversationType.PRIVATE; //私聊,其他会话选择相应的消息类型即可。
            }else if(type == 'group'){
                var conversationType = lib.ConversationType.GROUP;
            }else{
                var conversationType = lib.ConversationType.SYSTEM;
            }
            /*var conversationType = group ? lib.ConversationType.GROUP : lib.ConversationType.PRIVATE; //私聊,其他会话选择相应的消息类型即可。*/
            var targetId = to.id.toString();        //这里的targetId必须是string类型，否则会报错
            //构造消息体，这里就是我们刚才已经注册过的自定义消息
            console.log(msg);
            var detail = new RongIMClient.RegisterMessage.LAYIM_TEXT_MESSAGE(msg);
            //发送消息
            RongIMClient.getInstance().sendMessage(conversationType, targetId, detail, {
                onSuccess: function (message) {
                    console.log(message)
                    var sendData = {from:message.senderUserId,to:targetId,content:message.content.content,sendtime:message.sentTime,type:message.content.type}
                    $.post(cachedata.base.addchatlog, sendData, function (res) {
                        if (data.code !== 0) {
                            console.log('发送消息成功');
                        }else{
                            console.log('message record fail');
                        }
                    });

                },
                onError: function (errorCode, message) {
                    console.log('发送失败:' + errorCode);
                }
            });
        },
        joinGroup: function (gid, gname) {
            var groupId = (gid || '0').toString();  // 群 Id 。
            var groupName = gname;                  // 群名称 。
            RongIMClient.getInstance().joinGroup(groupId, groupName, {
                onSuccess: function () {
                    console.log('加入群成功');
                },
                onError: function (error) {
                    console.log(error);
                }
            });
        },
        getInformation: function(data){
            if(!cachedata.base.information){
                return layer.msg('未开启查看好友资料',{icon:4});
            }
            var id = data.id || {},type = data.type || {};
            var index = layer.open({
                type: 2
                ,title: type  == 'friend'?(cachedata.mine.id == id?'我的资料':'好友资料') :'群资料'
                ,shade: false
                ,maxmin: false
                // ,closeBtn: 0
                ,area: ['400px', '670px']
                ,skin: 'layui-box layui-layer-border'
                ,resize: true
                ,content: cachedata.base.information+'?id='+id+'&type='+type
            });
        },
        getChatLog: function (data){
            if(!cachedata.base.chatLog){
                return layer.msg('未开启更多聊天记录',{icon:4});
            }
            var index = layer.open({
                type: 2
                ,maxmin: true
                ,title: '与 '+ data.name +' 的聊天记录'
                ,area: ['450px', '600px']
                ,shade: false
                ,skin: 'layui-box'
                ,anim: 2
                ,id: 'layui-layim-chatlog'
                ,content: cachedata.base.chatLog + '?id=' + data.id + '&type=' + data.type
            });
        },
        addMyGroup:function (data) {
            $.get(cachedata.base.addMyGroup, {}, function (res) {
                if (res.code !== 0) {
                    $('.layim-list-friend').append('<li><h5 layim-event="spread" lay-type="undefined" data-groupid="'+res.data.id+'"><i class="layui-icon">&#xe602;</i><span>'+res.data.name+'</span><em>(<cite class="layim-count"> 0</cite>)</em></h5><ul class="layui-layim-list"><li class="layim-null">该分组下暂无好友</li></ul></li>');
                    layer.msg(res.msg,{icon:1});
                    ext.init();
                }else{
                    layer.msg(res.msg,{icon:2});
                }
            });
        },
        reMyGroupNmae:function (data) {
            layer.prompt({title: '请输入分组名，并确认', formType: 0,value: data.groupName}, function(mygroupName, index){
                if (mygroupName) {
                    $.post(cachedata.base.editMyGroup,{groupname:mygroupName,groupid:data.groupid},function(res){
                        if (res.code !== 0) {
                            var friend_group = $(".layim-list-friend li h5");
                            for(var j = 0; j < friend_group.length; j++){
                                var groupid = friend_group.eq(j).data('groupid');
                                if(groupid == data.groupid){//当前选择的分组
                                    friend_group.eq(j).find('span').html(mygroupName);
                                }
                            }
                            layer.msg(res.msg,{icon:1});
                            ext.init();
                            layer.close(index);
                        }else{
                            layer.msg(res.msg,{icon:2});
                        }
                    });
                }

            });
        },
        delMyGroup:function (data) {
            $.post(cachedata.base.delMyGroup, {groupid:data.groupid}, function (res) {
                if (res.code !== 0) {
                    var group = $('.layim-list-friend li') || [];
                    for(var j = 0; j < group.length; j++){//遍历每一个分组
                        groupList = group.eq(j).find('h5').data('groupid');
                        if(groupList === data.groupid){//要删除的分组
                            if (group.eq(j).find('ul li').hasClass('layim-null')) {//删除的分组下没有好友
                                group.eq(j).remove();
                            }else{
                                // var html = group.eq(j).find('ul').html();//被删除分组的好友
                                var friend = group.eq(j).find('ul li');
                                var number = friend.length;//被删除分组的好友个数
                                for (var i = 0; i < number; i++) {
                                    var friend_id = friend.eq(i).attr('id').replace(/^layim-friend/g, '');//好友id
                                    var friend_name = friend.eq(i).find('span').html();//好友id
                                    var signature = friend.eq(i).find('p').html();//好友id
                                    var avatar = friend.eq(i).find('img').attr('src');
                                    var default_avatar = './uploads/person/empty2.jpg';
                                    conf.layim.removeList({//将好友从之前分组除去
                                        type: 'friend'
                                        ,id: friend_id //好友ID
                                    });
                                    conf.layim.addList({//将好友移动到新分组
                                        type: 'friend'
                                        , avatar: avatar?avatar:default_avatar //好友头像
                                        , username: friend_name //好友昵称
                                        , groupid: res.data //将好友添加到默认分组
                                        , id: friend_id //好友ID
                                        , sign: signature //好友签名
                                    });
                                };
                            }
                            group.eq(j).remove();
                        }
                    }
                    ext.init();
                    layer.close(layer.index);
                }else{
                    layer.msg(res.msg,{icon:2});
                }
            });
        },

    };

    var ext = {
        init : function(){//定义右键操作
            //定义右键移动好友html
            var movehtml = '<ul>';
            var my_spread = $('.layim-list-friend >li');
            for(var i = 0;i<my_spread.length;i++){
                var groupid = my_spread.eq(i).find('h5').data('groupid');
                var groupname = my_spread.eq(i).find('h5').data('groupname');
                movehtml += '<li class="ui-move-menu-item" data-groupid="'+groupid+'" data-groupname="'+groupname+'"><a href="javascript:void(0);"><span>'+groupname+'</span></a></li>'
            }
            movehtml += '</ul>';

            //好友右键操作
            $(".layim-list-friend >li > ul > li:not([class])").contextMenu({
                width: 140, // width
                itemHeight: 30, // 菜单项height
                bgColor: "#fff", // 背景颜色
                color: "#333", // 字体颜色
                fontSize: 15, // 字体大小
                hoverBgColor: "#009bdd", // hover背景颜色
                hoverColor: "#fff", // hover背景颜色
                target: function(ele) { // 当前元素
                    $(".ul-context-menu").attr("data-id",ele[0].id);
                    $(".ul-context-menu").attr("data-name",ele.find("span").html());
                    $(".ul-context-menu").attr("data-img",ele.find("img").attr('src'));
                },
                menu: [
                    { // 菜单项
                        text: "发送消息",
                        icon: "",
                        callback: function(ele) {
                            var othis = ele.parent(),
                                friend_id = othis[0].dataset.id.replace(/^layim-friend/g, ''),
                                friend_name = othis[0].dataset.name,
                                friend_avatar = othis[0].dataset.img;
                            conf.layim.chat({
                                name: friend_name
                                ,type: 'friend'
                                ,avatar: friend_avatar
                                ,id: friend_id
                            });
                        }
                    },
                    {
                        text: "查看资料",
                        icon: "",
                        callback: function(ele) {
                            var othis = ele.parent(),friend_id = othis[0].dataset.id.replace(/^layim-friend/g, '');
                            im.getInformation({
                                id: friend_id,
                                type:'friend'
                            });
                        }
                    },
                    {
                        text: "移动联系人",
                        icon: "&#xe630;",
                        nav: "move",//子导航的样式
                        navIcon: "&#xe602;",//子导航的图标
                        navBody: movehtml,//子导航html
                        callback: function(ele) {
                            var friend_id = ele.parent().data('id').replace(/^layim-friend/g, '');//要移动的好友id
                            var friend_name = ele.parent().data('name');
                            var avatar = ele.parent().data('img');
                            var default_avatar = './uploads/person/empty2.jpg';
                            var signature = $('.layim-list-friend').find('#layim-friend'+friend_id).find('p').html();//获取签名
                            var item = ele.find("ul li");
                            item.hover(function() {
                                var _this = item.index(this);
                                var groupid = item.eq(_this).data('groupid');//将好友移动到分组的id

                                $.post(cachedata.base.moveFriend,{friend_id:friend_id,groupid:groupid},function(res){
                                    if (res.code !== 0) {
                                        conf.layim.removeList({//将好友从之前分组除去
                                            type: 'friend'
                                            ,id: friend_id //好友ID
                                        });
                                        conf.layim.addList({//将好友移动到新分组
                                            type: 'friend'
                                            , avatar: avatar?avatar:default_avatar //好友头像
                                            , username: friend_name //好友昵称
                                            , groupid: groupid //所在的分组id
                                            , id: friend_id //好友ID
                                            , sign: signature //好友签名
                                        });
                                        ext.init();
                                        layer.msg(res.msg,{icon:1});
                                    }else{
                                        ext.init();
                                        layer.msg(res.msg,{icon:2});
                                    }

                                });
                            });
                        }
                    },
                    {
                        text: "聊天记录",
                        icon: "",
                        callback: function(ele) {
                            var othis = ele.parent(),
                                friend_id = othis[0].dataset.id.replace(/^layim-friend/g, ''),
                                friend_name = othis[0].dataset.name;
                            im.getChatLog({
                                name: friend_name,
                                id: friend_id,
                                type:'friend'
                            });
                        }
                    },

                ]
            });

            //好友分组右键操作
            $(".layim-list-friend >li>h5 ").contextMenu({
                width: 140, // width
                contextItem: "context-mygroup", // 添加class
                itemHeight: 30, // 菜单项height
                bgColor: "#fff", // 背景颜色
                color: "#333", // 字体颜色
                fontSize: 15, // 字体大小
                hoverBgColor: "#009bdd", // hover背景颜色
                hoverColor: "#fff", // hover背景颜色
                target: function(ele) { // 当前元素
                    $(".context-mygroup").attr("data-groupid",ele.data('groupid')).attr("data-groupname",ele.find('span').html());
                },
                menu: [
                    { // 菜单项
                        text: "添加分组",
                        icon: "&#xe654",
                        callback: function(ele) {
                            im.addMyGroup();
                        }
                    },
                    {
                        text: "重命名",
                        icon: "&#xe642",
                        callback: function(ele) {
                            var othis = ele.parent(),
                                mygroupId = othis.data('groupid'),
                                groupName = othis.data('groupname');
                            //console.log(othis);
                            im.reMyGroupNmae({
                                othis :ele.parent(),
                                groupid: mygroupId,
                                groupName:groupName
                            });
                        }
                    },
                    {
                        text: "删除该组",
                        icon: "&#x1006",
                        callback: function(ele) {
                            var othis = ele.parent(),
                                mygroupId = othis.data('groupid');
                            layer.confirm('<div style="float: left;width: 17%;margin-top: 14px;"><i class="layui-icon" style="font-size: 48px;color:#cc4a4a">&#xe607;</i></div><div style="width: 83%;float: left;"> 选定的分组将被删除，组内联系人将会移至默认分组。</div>', {
                                btn: ['确定','取消'], //按钮
                                title:['删除分组','background:#b4bdb8'],
                                shade: 0
                            }, function(){
                                im.delMyGroup({groupid: mygroupId});
                            }, function(){
                                var index = layer.open();
                                layer.close(index);
                            });

                        }
                    }
                ]
            });
        }
    }
    exports('ext', ext);
    exports('socket', socket);
});