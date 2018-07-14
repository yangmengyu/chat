define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'chat/country/index',
                    add_url: 'chat/country/add',
                    edit_url: 'chat/country/edit',
                    del_url: 'chat/country/del',
                    multi_url: 'chat/country/multi',
                    table: 'chat_country',
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
                        {field: 'id', title: __('Id')},
                        {field: 'country_cn', title: __('Country_cn')},
                        {field: 'continent', title: __('Continent')},
                        {field: 'country_en', title: __('Country_en')},
                        {field: 'shortname1', title: __('Shortname1')},
                        {field: 'shortname2', title: __('Shortname2')},
                        {field: 'num_code', title: __('Num_code')},
                        {field: 'full_name', title: __('Full_name')},
                        {field: 'status', title: __('Status'), searchList: {"normal":__('Normal'),"hidden":__('Hidden')}, formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
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