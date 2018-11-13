/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : fastadmin_tp51

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-22 16:31:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for __PREFIX__leescore_address
-- ----------------------------
DROP TABLE IF EXISTS `__PREFIX__leescore_address`;
CREATE TABLE `__PREFIX__leescore_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `userid` int(11) DEFAULT NULL COMMENT '用户ID',
  `zip` varchar(60) DEFAULT NULL COMMENT '邮编',
  `mobile` varchar(20) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `region` varchar(200) DEFAULT NULL COMMENT '省 / 区',
  `city` varchar(200) DEFAULT NULL COMMENT '城市',
  `xian` varchar(200) DEFAULT NULL COMMENT '县 / 区',
  `address` text,
  `status` int(11) DEFAULT NULL COMMENT '默认收货地址',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `firstname` varchar(255) DEFAULT NULL COMMENT '姓氏',
  `lastname` varchar(255) DEFAULT NULL COMMENT '名字',
  `isdel` int(11) DEFAULT '0' COMMENT '逻辑删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of __PREFIX__leescore_address
-- ----------------------------
INSERT INTO `__PREFIX__leescore_address` VALUES ('1', '2', '531000', '123123123', '中国', '广西壮族自治区/南宁市/兴宁区', null, null, '123231', '0', '1527133237', '123123', '123123', '0');
INSERT INTO `__PREFIX__leescore_address` VALUES ('2', '3', '12323', '12345678912', '中国', '广西壮族自治区/南宁市/西乡塘区', null, null, '123', '1', '1527727978', '123', '123', '0');

-- ----------------------------
-- Table structure for __PREFIX__leescore_ads
-- ----------------------------
DROP TABLE IF EXISTS `__PREFIX__leescore_ads`;
CREATE TABLE `__PREFIX__leescore_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '广告标题',
  `thumb` char(255) DEFAULT NULL COMMENT '广告图片',
  `open_mode` enum('0','1') DEFAULT '0' COMMENT '打开方式:0=原网页,1=新开页面',
  `path_url` varchar(255) DEFAULT '#' COMMENT '跳转地址',
  `position` enum('slider','activicy','other') DEFAULT 'other' COMMENT '广告位:slider=轮播处,activicy=热门活动,other=其它位置',
  `starttime` int(11) DEFAULT NULL COMMENT '起始时间',
  `endtime` int(11) DEFAULT NULL COMMENT '截止时间',
  `weigh` int(11) DEFAULT '50' COMMENT '排序',
  `status` enum('0','1') DEFAULT '0' COMMENT '状态:0=未启用,1=启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='广告位管理';

-- ----------------------------
-- Records of __PREFIX__leescore_ads
-- ----------------------------
INSERT INTO `__PREFIX__leescore_ads` VALUES ('1', 'SkyStar Revvo Kit', '/uploads/20180424/f76f6f24a9df95c7510a7fd4972a8382.jpg', '0', '', 'slider', '1524538292', '1546311092', '50', '1');
INSERT INTO `__PREFIX__leescore_ads` VALUES ('2', 'Typhon', '/uploads/20180424/a1d07457eefaddb191f7060760901164.jpg', '1', '', 'slider', '1524538372', '1546311172', '50', '1');
INSERT INTO `__PREFIX__leescore_ads` VALUES ('3', 'Sign', '/uploads/20180423/908ff9adc1f336d0307089b002e8e89b.png', '0', '', 'activicy', '1524538991', '1546311791', '50', '1');
INSERT INTO `__PREFIX__leescore_ads` VALUES ('4', 'This is a demo.', '/uploads/20181022/cbb6379cdb801ff104c91c5dc1f7e210.jpg', '1', 'https://www.aipaikee.com/', 'slider', '1540194154', '1540194154', '50', '1');
INSERT INTO `__PREFIX__leescore_ads` VALUES ('5', '广告位2', '/uploads/20181022/178ca4936e6b303f7257c2f504aa12f9.jpg', '1', 'https://www.aipaikee.com/', 'activicy', '1540194779', '1577778779', '50', '1');
INSERT INTO `__PREFIX__leescore_ads` VALUES ('6', '精彩活动3', '/uploads/20181022/2065ed66c1b78922febe2c276ae8deba.jpg', '1', 'https://www.aipaikee.com/', 'activicy', '1540194816', '1575186816', '50', '1');
INSERT INTO `__PREFIX__leescore_ads` VALUES ('7', '精彩活动4', '/uploads/20181022/2065ed66c1b78922febe2c276ae8deba.jpg', '0', 'https://www.aipaikee.com/', 'activicy', '1540194938', '1701417338', '50', '1');
INSERT INTO `__PREFIX__leescore_ads` VALUES ('8', '精彩活动5', '/uploads/20181022/178ca4936e6b303f7257c2f504aa12f9.jpg', '1', '', 'activicy', '1540194974', '1704009374', '50', '1');

-- ----------------------------
-- Table structure for __PREFIX__leescore_category
-- ----------------------------
DROP TABLE IF EXISTS `__PREFIX__leescore_category`;
CREATE TABLE `__PREFIX__leescore_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(255) DEFAULT NULL COMMENT '菜单名',
  `category_id` int(11) DEFAULT '0' COMMENT '上级菜单',
  `path` varchar(255) DEFAULT NULL COMMENT '完整路径',
  `weigh` int(11) DEFAULT '50' COMMENT '权重排序',
  `status` varchar(30) DEFAULT 'normal' COMMENT '状态',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品分类';

-- ----------------------------
-- Records of __PREFIX__leescore_category
-- ----------------------------
INSERT INTO `__PREFIX__leescore_category` VALUES ('1', '套装', '0', null, '1', 'normal', '1524537568');
INSERT INTO `__PREFIX__leescore_category` VALUES ('2', '雾化器', '0', null, '2', 'normal', '1524537586');
INSERT INTO `__PREFIX__leescore_category` VALUES ('3', '电池', '0', null, '3', 'normal', '1524537619');

-- ----------------------------
-- Table structure for __PREFIX__leescore_exchangelog
-- ----------------------------
DROP TABLE IF EXISTS `__PREFIX__leescore_exchangelog`;
CREATE TABLE `__PREFIX__leescore_exchangelog` (
  `uid` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of __PREFIX__leescore_exchangelog
-- ----------------------------
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('3', '1', '8');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('3', '1', '9');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('3', '1', '10');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('3', '3', '11');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('3', '3', '12');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('3', '3', '13');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('3', '3', '14');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('4', '10', '2');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('4', '10', '3');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('5', '10', '4');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('10', '6', '1');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('2', '4', '2');
INSERT INTO `__PREFIX__leescore_exchangelog` VALUES ('3', '6', '3');

-- ----------------------------
-- Table structure for __PREFIX__leescore_goods
-- ----------------------------
DROP TABLE IF EXISTS `__PREFIX__leescore_goods`;
CREATE TABLE `__PREFIX__leescore_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `category_id` int(11) DEFAULT NULL COMMENT '分类ID',
  `name` varchar(255) DEFAULT NULL COMMENT '商品标题',
  `paytype` enum('0','1','2') DEFAULT '0' COMMENT '出售模式:0=积分模式,1=货币模式,2=金钱+货币模式',
  `type` enum('0','1') DEFAULT '0' COMMENT '商品类型: 0=普通商品,1=虚拟商品',
  `status` enum('0','1','2') DEFAULT '2' COMMENT '商品状态:0=删除,1=仓库,2=上架',
  `createtime` int(11) DEFAULT NULL COMMENT '商品发布时间',
  `body` text COMMENT '商品详情',
  `rule` text COMMENT '兑换规则',
  `thumb` varchar(255) DEFAULT NULL COMMENT '图片缩略图',
  `pics` text COMMENT '商品图集',
  `weigh` int(11) DEFAULT '50' COMMENT '权重排序',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  `stock` int(11) DEFAULT '0' COMMENT '商品库存',
  `scoreprice` int(11) DEFAULT '0' COMMENT '所需积分',
  `firsttime` int(11) DEFAULT NULL COMMENT '开放时间',
  `lasttime` int(11) DEFAULT NULL COMMENT '结束时间',
  `money` float(11,2) DEFAULT '0.00' COMMENT '价格',
  `usenum` int(11) DEFAULT '0' COMMENT '已兑换',
  `flag` set('index','hot','recommend','new') DEFAULT '' COMMENT '推荐:index=首页,hot=热门,recommend=推荐,new=最新',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='推广类型';

-- ----------------------------
-- Records of __PREFIX__leescore_goods
-- ----------------------------
INSERT INTO `__PREFIX__leescore_goods` VALUES ('1', '1', 'Aspire Skystar Kit', '0', '0', '2', '1524537773', '', '兑换规则', '/uploads/20180424/6d3b6f0ba9f15d0745b7e78af3e749ad.jpg', '', '1', '1540194600', '9999', '66', '1524537663', '1546310463', '0.00', '0', 'index');
INSERT INTO `__PREFIX__leescore_goods` VALUES ('2', '1', 'Typhon', '0', '0', '2', '1524537830', '', '', '/uploads/20180424/136705ff1c507a00cc75c0bc58dbada5.jpg', '', '2', '1524625923', '0', '99999', '1524537776', '1546310576', '0.00', '0', 'index,recommend');
INSERT INTO `__PREFIX__leescore_goods` VALUES ('3', '1', 'Revvo Tank', '0', '0', '2', '1524537898', '这只是一条测试数据', '兑换需要1积分', '/uploads/20180424/a58ef81083e57a1973c7f46011725b5e.jpg', '', '3', '1540195178', '9999', '1', '1524537834', '1546310634', '0.00', '0', 'index,recommend,new');
INSERT INTO `__PREFIX__leescore_goods` VALUES ('4', '1', 'Speeder Revvo Kit', '0', '0', '2', '1524537976', '这仅仅是一条测试数据', '每次兑换需要1点积分，积分可以通过签到插件获取', '/uploads/20180424/72d71dec04b1503db2cdb50e3f587a57.jpg', '', '4', '1540195138', '9999', '1', '1524537915', '1546310715', '0.00', '1', 'index,hot,recommend,new');
INSERT INTO `__PREFIX__leescore_goods` VALUES ('6', '1', '测试商品请勿兑换', '0', '0', '2', '1524561477', '这只是一条测试数据', '活动有效期为5年', '/uploads/20180423/908ff9adc1f336d0307089b002e8e89b.png', '', '6', '1540194539', '9999', '99', '1524561438', '1704014238', '0.00', '2', 'index,hot,recommend,new');
INSERT INTO `__PREFIX__leescore_goods` VALUES ('7', '1', '这只是一条测试数据', '0', '0', '2', '1540194739', '不限制兑换次数，活动有效期1年，结束后不可兑换', '不限制兑换次数，活动有效期1年，结束后不可兑换', '/uploads/20181022/2065ed66c1b78922febe2c276ae8deba.jpg', '/uploads/20181022/2065ed66c1b78922febe2c276ae8deba.jpg,/uploads/20181022/908ff9adc1f336d0307089b002e8e89b.png,/uploads/20181022/178ca4936e6b303f7257c2f504aa12f9.jpg', '7', '1540194739', '99999', '1', '1540194622', '1571730622', '0.00', '0', 'index,hot,recommend,new');

-- ----------------------------
-- Table structure for __PREFIX__leescore_order
-- ----------------------------
DROP TABLE IF EXISTS `__PREFIX__leescore_order`;
CREATE TABLE `__PREFIX__leescore_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `uid` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `address_id` int(11) DEFAULT NULL COMMENT '收货地址',
  `order_id` varchar(255) NOT NULL COMMENT '订单号',
  `trade_id` varchar(255) DEFAULT NULL COMMENT '回执单号',
  `goods_id` varchar(11) DEFAULT '' COMMENT '商品ID',
  `buy_num` int(11) DEFAULT NULL COMMENT '购买数量',
  `goods_type` enum('0','1') DEFAULT '0' COMMENT '商品类型: 0=普通商品, 1=虚拟商品',
  `type` enum('0','1') DEFAULT '0' COMMENT '订单来源:0=积分商城,1=购物商城',
  `money` float(20,0) DEFAULT '0' COMMENT '价格',
  `score` int(11) DEFAULT '0' COMMENT '积分',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `pay` enum('0','1','2') DEFAULT '0' COMMENT '付款状态:0=未付款,1=已付款,2=已退款',
  `status` enum('-2','-1','0','1','2','3','4','5') DEFAULT '0' COMMENT '订单状态:-2=驳回, -1=取消订单,0=未支付,1=已支付,2=已发货,3=已签收,4=退货中,5=已退款',
  `paytime` int(11) DEFAULT NULL COMMENT '付款时间',
  `paytype` enum('score','paypal','alipay','weixin') DEFAULT 'score' COMMENT '支付方式',
  `isdel` int(11) DEFAULT '0' COMMENT '1',
  `other` text COMMENT '备注',
  `virtual_sn` varchar(255) DEFAULT NULL COMMENT '虚拟券序列号/快递单号',
  `virtual_name` varchar(255) DEFAULT NULL COMMENT '虚拟券名称/物流公司',
  `virtual_go_time` int(11) DEFAULT NULL COMMENT '发货时间',
  `virtual_sign_time` int(11) DEFAULT NULL COMMENT '签收时间',
  `result_other` varchar(255) DEFAULT NULL COMMENT '回馈备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of __PREFIX__leescore_order
-- ----------------------------
INSERT INTO `__PREFIX__leescore_order` VALUES ('1', '10', '1', 'SN260577905753149010', '', '6', '1', '0', '0', '0', '0', '1524561753', '1', '-2', '1524561753', 'score', '1', '测', null, null, null, null, null);
INSERT INTO `__PREFIX__leescore_order` VALUES ('2', '2', '1', 'SN410580477493410002', '', '4', '1', '0', '0', '0', '0', '1527133493', '1', '1', '1527133493', 'score', '0', '测试', null, null, null, null, null);
INSERT INTO `__PREFIX__leescore_order` VALUES ('3', '3', '2', 'SN180581071981360003', '', '6', '1', '0', '0', '0', '0', '1527727981', '1', '1', '1527727981', 'score', '0', '13', null, null, null, null, null);
