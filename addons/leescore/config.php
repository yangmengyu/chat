<?php

return array (
	0 => 
		array (
		'name' => 'enterimg',
		'title' => '入口图片',
		'type' => 'image',
		'content' => 
		array (
		),
		'value' => '',
		'rule' => 'required',
		'msg' => '',
		'tip' => '',
		'ok' => '',
		'extend' => '',
	),
	1 => 
		array (
		'name' => 'scorestatus',
		'title' => '开启积分商城',
		'type' => 'radio',
		'content' => 
		array (
			1 => '启用',
			0 => '关闭',
		),
		'value' => '1',
		'rule' => 'required',
		'msg' => '',
		'tip' => '',
		'ok' => '',
		'extend' => '',
	),
	2 =>
		array(
		'name' => 'order_prefix',
		'title' => '订单前缀',
		'type' => 'string',
		'content' => '',
		'value' => 'SN',
		'rule' => 'required',
		'msg' => '',
		'tip' => '',
		'ok' => '',
		'extend' => '',
	),
	3 => 
	array (
		'name' => 'domain',
		'title' => '绑定二级域名前缀',
		'type' => 'string',
		'content' => 
		array (
		),
		'value' => '',
		'rule' => 'required',
		'msg' => '',
		'tip' => '',
		'ok' => '',
		'extend' => '',
	),
	4 => 
	array (
		'name' => 'rewrite',
		'title' => '伪静态',
		'type' => 'array',
		'content' => 
		array (
		),
		'value' => 
		array (
			'goods/index' => '/leescoregoods$',
			'order/index' => '/leescoreorder$',
			'index/index' => '/score$',
			'address/index' => '/address$',
		),
		'rule' => 'required',
		'msg' => '',
		'tip' => '',
		'ok' => '',
		'extend' => '',
	),
);
