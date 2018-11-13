define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'scoreorder/index',
                    add_url: 'scoreorder/add',
                   // edit_url: 'scoreorder/edit',
                    del_url: 'scoreorder/del',
                    faild_url: 'scoreorder/faild',
                    send_url: 'scoreorder/send',
                    multi_url: 'scoreorder/multi',
                    table: 'score_order',
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
                        {field: 'score_goods.name', title: __('goods name'), operate: false},
                        {field: 'user.username', title: __('username'), operate: false},
                        {field: 'type', title: __('Type'), visible:false, searchList: {"0":__('Type 0'),"1":__('Type 1')}},
                        {field: 'type_text', title: __('Type'), operate:false},
                        {field: 'money', title: __('Money'), operate:'BETWEEN'},
                        {field: 'score', title: __('Score'), operate: 'BETWEEN'},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'status', title: __('Status'), visible:false, searchList: {"-2": __('Status -2'), "-1":__("Status -1"),"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2'),"3":__('Status 3'),"4":__('Status 4'),"5":__('Status 5')}},
                        {field: 'status_text', title: __('Status'), operate:false},
                        {field: 'paytime', title: __('Paytime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, buttons: [
                                {name: 'send', text: __('view'), icon: 'fa fa-eye', classname: 'btn btn-xs btn-warning btn-dialog', url: 'Scoreorder/send'},
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
                    $("#send-form").attr("action","scoreorder/faild").submit();
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
                $("#send-form").submit();
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