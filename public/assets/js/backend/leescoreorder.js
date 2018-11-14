define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'leescoreorder/index',
                    add_url: 'leescoreorder/add',
                   // edit_url: 'scoreorder/edit',
                    del_url: 'leescoreorder/del',
                    faild_url: 'leescoreorder/faild',
                    send_url: 'leescoreorder/send',
                    multi_url: 'leescoreorder/multi',
                    table: 'leescore_order',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'order_id', title: __('order id'), operate: 'LIKE'},
                        {field: 'uid', title: __('Uid'), visible: false, operate:false},
                        {field: 'leescore_goods.name', title: __('goods name'), operate: false},
                        {field: 'user.username', title: __('username'), operate: false},
                        {field: 'goods_type', title: __('Goods type'), visible:true, searchList: {"0":__('Goodstype 0'),"1":__('Goodstype 1')},formatter:Table.api.formatter.label},
                        {field: 'goods_type_text', title: __('Type'), operate:false,visible:false},
                        //{field: 'money', title: __('Money'), operate:'BETWEEN'},
                        {field: 'score', title: __('Score'), operate: 'BETWEEN'},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'status', title: __('Status'), visible:true, searchList: {"-2": __('Status -2'), "-1":__("Status -1"),"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2'),"3":__('Status 3'),"4":__('Status 4'),"5":__('Status 5'),"6":__('Status 6')},formatter:Table.api.formatter.status},
                        {field: 'status_text', title: __('Status'), operate:false,visible:false,formatter:Table.api.formatter.status},
                        {field: 'paytime', title: __('Paytime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, buttons: [
                                {name: 'send', text: __('view'), icon: 'fa fa-eye', classname: 'btn btn-xs btn-warning btn-dialog', url: 'leescoreorder/send'},
                            ],  events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
/*        edit: function () {
            Controller.api.bindevent();
        },*/
        send: function(){
            $("#faild").on('click', function() {
                $("#c-virtual_sn").attr('data-rule',true);
                $("#c-virtual_name").attr('data-rule',true);

            });

            $("#faild").on('click', function() {
                layer.confirm(__('msg tip'), {
                    title: __('action'),
                    btn: [__("yes"),__("no")] //按钮
                }, function(){
                    $("#send-form").attr("action","leescoreorder/faild").submit();
                });
            }); 

            $("#send").on('click', function() {
                var sn = $("#c-virtual_sn").val();
                var name = $("#c-virtual_name").val();
                if(sn == '' || name == '')
                {
                    layer.msg(__('sn name tip'));
                    return false;
                }
                $("#send-form").attr("action","leescoreorder/send").submit();
            });
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});