/*
MySQL Data Transfer
Source Host: 192.168.1.55
Source Database: shop
Target Host: 192.168.1.55
Target Database: shop
Date: 2015/11/8 17:27:51
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '' COMMENT '标题',
  `article_category_id` tinyint(3) unsigned NOT NULL default '0' COMMENT '文章分类',
  `content` text COMMENT '内容@text',
  `times` int(10) unsigned NOT NULL default '0' COMMENT '浏览次数',
  `inputtime` int(10) unsigned NOT NULL default '0' COMMENT '录入时间',
  `intro` text COMMENT '摘要@text',
  `status` tinyint(4) NOT NULL default '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL default '20' COMMENT '排序',
  PRIMARY KEY  (`id`),
  KEY `article_category_id` (`article_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
-- Table structure for article_category
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '' COMMENT '分类名称',
  `is_help` tinyint(4) NOT NULL default '1' COMMENT '是否帮助@radio|1=是&0=否',
  `intro` text COMMENT '简介@text',
  `status` tinyint(4) NOT NULL default '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL default '20' COMMENT '排序',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '' COMMENT '品牌名称',
  `url` varchar(50) NOT NULL default '' COMMENT '品牌网址',
  `logo` varchar(50) NOT NULL default '' COMMENT '品牌LOGO@file',
  `intro` text COMMENT '品牌描述@text',
  `status` tinyint(4) NOT NULL default '1' COMMENT '状态@radio|1=是&0=否',
  `sort` smallint(6) NOT NULL default '20' COMMENT '排序',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='品牌';

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '名称',
  `sn` varchar(50) NOT NULL default '' COMMENT '货号',
  `goods_category_id` tinyint(3) unsigned NOT NULL default '0' COMMENT '父分类',
  `brand_id` smallint(5) unsigned NOT NULL default '0' COMMENT '品牌',
  `supplier_id` smallint(5) unsigned NOT NULL default '0' COMMENT '供货商',
  `shop_price` decimal(9,2) NOT NULL default '0.00' COMMENT '本店价格',
  `market_price` decimal(9,2) NOT NULL default '0.00' COMMENT '市场价格',
  `stock` int(11) NOT NULL default '0' COMMENT '库存',
  `is_on_sale` tinyint(4) NOT NULL default '0' COMMENT '是否上架',
  `goods_status` int(10) unsigned NOT NULL default '0' COMMENT '商品状态',
  `keyword` varchar(20) NOT NULL default '' COMMENT '关键字',
  `logo` varchar(100) NOT NULL default '' COMMENT 'LOGO',
  `status` tinyint(4) NOT NULL default '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL default '20' COMMENT '排序',
  PRIMARY KEY  (`id`),
  KEY `goods_category_id` (`goods_category_id`),
  KEY `brand_id` (`brand_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `name` (`name`),
  KEY `sn` (`sn`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='商品';

-- ----------------------------
-- Table structure for goods_article
-- ----------------------------
DROP TABLE IF EXISTS `goods_article`;
CREATE TABLE `goods_article` (
  `goods_id` int(10) unsigned NOT NULL default '0' COMMENT '商品ID',
  `article_id` int(10) unsigned NOT NULL default '0' COMMENT '文章ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关联文章';

-- ----------------------------
-- Table structure for goods_category
-- ----------------------------
DROP TABLE IF EXISTS `goods_category`;
CREATE TABLE `goods_category` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '名称',
  `parent_id` tinyint(3) unsigned NOT NULL default '0' COMMENT '父分类',
  `lft` smallint(5) unsigned NOT NULL default '0' COMMENT '左边界',
  `rght` smallint(5) unsigned NOT NULL default '0' COMMENT '右边界',
  `level` tinyint(3) unsigned NOT NULL default '0' COMMENT '级别',
  `intro` text COMMENT '简介@textarea',
  `status` tinyint(4) NOT NULL default '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL default '20' COMMENT '排序',
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `lft` (`lft`,`rght`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='商品分类';

-- ----------------------------
-- Table structure for goods_gallery
-- ----------------------------
DROP TABLE IF EXISTS `goods_gallery`;
CREATE TABLE `goods_gallery` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `goods_id` int(10) unsigned NOT NULL default '0' COMMENT '商品ID',
  `path` varchar(100) NOT NULL default '' COMMENT '图片路径',
  PRIMARY KEY  (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品相册';

-- ----------------------------
-- Table structure for goods_intro
-- ----------------------------
DROP TABLE IF EXISTS `goods_intro`;
CREATE TABLE `goods_intro` (
  `goods_id` int(10) unsigned NOT NULL default '0' COMMENT '商品ID',
  `intro` text COMMENT '商品描述',
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品描述';

-- ----------------------------
-- Table structure for goods_type
-- ----------------------------
DROP TABLE IF EXISTS `goods_type`;
CREATE TABLE `goods_type` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '' COMMENT '类型名称',
  `intro` text COMMENT '类型描述@text',
  `status` tinyint(4) NOT NULL default '1' COMMENT '状态@radio|1=是&0=否',
  `sort` smallint(6) NOT NULL default '20' COMMENT '排序',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品类型';

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '' COMMENT '名称',
  `intro` text COMMENT '简介',
  `status` tinyint(4) NOT NULL default '1' COMMENT '状态',
  `sort` smallint(6) NOT NULL default '20' COMMENT '排序',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `article` VALUES ('1', '123', '2', '<p><strong>123123123123</strong></p>', '0', '0', '1231231', '1', '127');
INSERT INTO `article` VALUES ('2', '双十一', '7', '<p>双十一</p>', '0', '1446968725', '双十一', '1', '20');
INSERT INTO `article` VALUES ('3', '双十二', '7', '<p>双十二</p>', '0', '1446968795', '双十二', '1', '20');
INSERT INTO `article` VALUES ('4', '双11', '7', '<p>双11</p>', '0', '1446968808', '双11', '1', '20');
INSERT INTO `article` VALUES ('5', '双老大', '7', '<p>双老大</p>', '0', '1446968821', '双老大', '1', '20');
INSERT INTO `article_category` VALUES ('1', '购物指南', '1', '购物指南', '1', '20');
INSERT INTO `article_category` VALUES ('2', '配送方式', '1', '配送方式', '1', '20');
INSERT INTO `article_category` VALUES ('3', '支付方式', '1', '支付方式', '1', '20');
INSERT INTO `article_category` VALUES ('4', '售后服务', '1', '售后服务', '1', '20');
INSERT INTO `article_category` VALUES ('5', '特色服务', '1', '特色服务', '1', '20');
INSERT INTO `article_category` VALUES ('6', '网站快报', '0', '网站快报', '1', '20');
INSERT INTO `article_category` VALUES ('7', '商品新闻', '0', '商品新闻', '1', '20');
INSERT INTO `brand` VALUES ('1', '小米', '123123', '2015-11-05/563abf0ce759f.jpg', '12322', '1', '20');
INSERT INTO `brand` VALUES ('2', '华为', '', '', null, '1', '20');
INSERT INTO `brand` VALUES ('3', '魅族', '', '', null, '1', '20');
INSERT INTO `brand` VALUES ('4', '中兴', '', '', null, '1', '20');
INSERT INTO `brand` VALUES ('5', '苹果', '', '', null, '1', '20');
INSERT INTO `goods` VALUES ('1', '123123', '', '3', '3', '7', '233.00', '444.00', '444', '1', '0', '444', '2015-11-07/563db1573', '1', '20');
INSERT INTO `goods` VALUES ('2', '123123', '2015110700000002', '1', '2', '7', '22.00', '222.00', '222', '1', '3', '23323', '2015-11-07/563dba597', '1', '20');
INSERT INTO `goods` VALUES ('3', '4444444', '2015110700000003', '13', '1', '10', '777.00', '777.00', '7777', '1', '6', '88777', '2015-11-08/563ea632cdac8.png', '0', '20');
INSERT INTO `goods` VALUES ('5', '123123123', '2015110800000005', '1', '1', '10', '123.00', '123.00', '123123', '1', '1', '123123', '', '1', '20');
INSERT INTO `goods` VALUES ('6', '', '2015110800000006', '13', '1', '10', '0.00', '0.00', '0', '1', '0', '', '', '1', '20');
INSERT INTO `goods` VALUES ('7', '', '2015110800000007', '13', '1', '10', '0.00', '0.00', '0', '1', '0', '', '', '1', '20');
INSERT INTO `goods` VALUES ('9', '', '2015110800000009', '13', '1', '10', '0.00', '0.00', '0', '1', '0', '', '', '1', '20');
INSERT INTO `goods` VALUES ('10', '', '2015110800000010', '0', '0', '0', '0.00', '0.00', '0', '1', '0', '双', '', '1', '20');
INSERT INTO `goods` VALUES ('11', '123123', '2015110800000011', '2', '1', '7', '111.00', '111.00', '11', '1', '3', '', '', '1', '20');
INSERT INTO `goods_article` VALUES ('11', '3');
INSERT INTO `goods_article` VALUES ('11', '2');
INSERT INTO `goods_category` VALUES ('1', '平板电视', '9', '3', '4', '3', '', '1', '20');
INSERT INTO `goods_category` VALUES ('2', '空调', '9', '5', '6', '3', '', '1', '20');
INSERT INTO `goods_category` VALUES ('3', '冰箱', '9', '7', '8', '3', '', '1', '20');
INSERT INTO `goods_category` VALUES ('4', '取暖器_del', '8', '11', '16', '3', '', '-1', '20');
INSERT INTO `goods_category` VALUES ('5', '净化器_del', '8', '17', '18', '3', '', '-1', '20');
INSERT INTO `goods_category` VALUES ('6', '加湿器_del', '8', '19', '20', '3', '', '-1', '20');
INSERT INTO `goods_category` VALUES ('7', '小太阳_del', '4', '12', '15', '4', '', '-1', '20');
INSERT INTO `goods_category` VALUES ('8', '生活电器_del', '10', '10', '21', '2', '', '-1', '20');
INSERT INTO `goods_category` VALUES ('9', '大家电', '10', '2', '9', '2', '', '1', '20');
INSERT INTO `goods_category` VALUES ('10', '家用电器', '0', '1', '22', '1', '', '1', '20');
INSERT INTO `goods_category` VALUES ('11', '洗衣机11_del', '7', '13', '14', '5', '洗衣机111', '-1', '20');
INSERT INTO `goods_category` VALUES ('12', '电脑电话', '0', '23', '28', '1', '电脑电话', '1', '20');
INSERT INTO `goods_category` VALUES ('13', '电脑', '12', '24', '25', '2', '电脑', '1', '20');
INSERT INTO `goods_category` VALUES ('14', '电话', '12', '26', '27', '2', '', '1', '20');
INSERT INTO `goods_gallery` VALUES ('1', '9', '2015-11-08/563ee9041e4c2.png');
INSERT INTO `goods_gallery` VALUES ('3', '9', '2015-11-08/563eecaa6b2eb.jpg');
INSERT INTO `goods_intro` VALUES ('5', '&lt;p&gt;&lt;strong&gt;dasdfasdfasdfadfasdfa&lt;/strong&gt;&lt;/p&gt;');
INSERT INTO `goods_intro` VALUES ('6', '<p>666666666666666666666</p>');
INSERT INTO `goods_intro` VALUES ('7', '');
INSERT INTO `goods_intro` VALUES ('9', '');
INSERT INTO `goods_intro` VALUES ('10', '');
INSERT INTO `goods_intro` VALUES ('11', '');
INSERT INTO `supplier` VALUES ('1', '北京供应商_del', '北京供应商', '-1', '20');
INSERT INTO `supplier` VALUES ('2', '天津供应商_del', '天津供应商', '-1', '20');
INSERT INTO `supplier` VALUES ('3', '重庆供应商', '重庆供应商', '1', '20');
INSERT INTO `supplier` VALUES ('6', '成都供货商_del', '成都供货商', '-1', '20');
INSERT INTO `supplier` VALUES ('7', '武汉供货商', '武汉供货商', '1', '20');
INSERT INTO `supplier` VALUES ('8', '西安供货商_del', '西安供货商', '-1', '20');
INSERT INTO `supplier` VALUES ('10', '西安供货商', '西安供货商', '1', '20');
INSERT INTO `supplier` VALUES ('11', '4444_del', '444', '-1', '20');
INSERT INTO `supplier` VALUES ('12', '2342_del', '34234234', '-1', '20');
INSERT INTO `supplier` VALUES ('13', '234234', '234234234', '1', '20');
INSERT INTO `supplier` VALUES ('14', 'aef_del', 'asdfasdf', '-1', '20');
