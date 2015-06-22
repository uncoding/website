-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 08 月 15 日 15:55
-- 服务器版本: 5.1.44
-- PHP 版本: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
CREATE TABLE IF NOT EXISTS `cms_seoglobal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shw_keyword` varchar(255) DEFAULT NULL COMMENT 'SEO关键词',
  `shw_desc` varchar(200) DEFAULT NULL COMMENT '网站描述',
  `shw_host` varchar(200) DEFAULT NULL COMMENT 'SEO静态站的访问域名',
  `shw_sitename` varchar(200) DEFAULT NULL COMMENT '网站名称',
  `shw_html` varchar(200) DEFAULT NULL COMMENT '静态页后缀名',
  `log_user` varchar(50) DEFAULT NULL COMMENT '最后更新人',
  `log_time` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='SEO全局变量';

INSERT INTO `cms_seoglobal` (`id`, `shw_keyword`, `shw_desc`, `shw_host`, `shw_sitename`, `shw_html`) VALUES
(1, 'SEO关键词', '网站描述', 'SEO静态站的访问域名', '网站名称', 'html');

CREATE TABLE IF NOT EXISTS `cms_seo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shw_url` varchar(255) DEFAULT NULL COMMENT '动态URL',
  `shw_filename` varchar(200) DEFAULT NULL COMMENT 'SEO文件名',
  `shw_title` varchar(200) DEFAULT NULL COMMENT 'SEO文字标题',
  `shw_alt` varchar(200) DEFAULT NULL COMMENT 'SEO专用ALT属性',
  `mgr_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `mgr_die` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否死链',
  `log_user` varchar(50) DEFAULT NULL COMMENT '最后更新人',
  `log_time` datetime DEFAULT NULL COMMENT '最后更新时间',
  `shw_path` varchar(100) NOT NULL COMMENT 'seo路径',
  `mgr_only` varchar(100) NOT NULL COMMENT '内部唯一标识',
  PRIMARY KEY (`id`),
  UNIQUE KEY `only` (`shw_filename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='SEO静态处理';

INSERT INTO `cms_seo` (`id`, `shw_url`, `shw_filename`, `shw_title`, `shw_alt`, `mgr_status`, `mgr_die`, `log_user`, `log_time`) VALUES
(1, 'index.php', 'index', '公司网站首页', '公司网站首页', 1, 0, 'admin', '2014-03-25 16:14:30');


CREATE TABLE IF NOT EXISTS `cms_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shw_title` varchar(255) DEFAULT NULL COMMENT '显示名称',
  `shw_table` varchar(255) DEFAULT NULL COMMENT '表名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='表名' AUTO_INCREMENT=3 ;


--
-- 表的结构 `cms_classify`
--
CREATE TABLE IF NOT EXISTS `cms_classify` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shw_title` varchar(100) NOT NULL COMMENT '分类标题',
  `cid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '所属父分类',
  `mgr_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序值',
  `mgr_table` varchar(100) NOT NULL COMMENT '顶级分类所属数据表',
  `log_user` varchar(50) NOT NULL DEFAULT '' COMMENT '录入人',
  `log_time` datetime NOT NULL COMMENT '添加时间',
  `mgr_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 0:禁用,1:启用',
  `img_up` varchar(100) NOT NULL COMMENT '封面',
  `shw_other` varchar(100) NOT NULL COMMENT '别名',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='分类树' ;
--
-- 转存表中的数据 `cms_classify`
--

INSERT INTO `cms_classify` (`id`, `shw_title`, `cid`, `mgr_sort`, `mgr_table`, `log_user`, `log_time`, `mgr_status`) VALUES
(1, '产品中心', 0, 1, 'cms_photo', 'admin', '2013-08-15 15:26:17', 1),
(2, '首页管理', 0, 2, 'cms_homephoto', 'admin', '2013-09-22 11:49:14', 1),
(3, '首页大图banner', 2, 1, 'cms_homephoto', 'admin', '2013-09-22 11:49:39', 1),
(4, '首页右侧文字', 2, 2, 'cms_homephoto', 'admin', '2013-09-22 11:51:07', 1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_nav`
--

CREATE TABLE IF NOT EXISTS `cms_nav` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shw_title` varchar(100) NOT NULL COMMENT '导航标题',
  `shw_intro` varchar(200) DEFAULT NULL COMMENT '导航简介',
  `img_up` varchar(100) NOT NULL COMMENT '导航图片上传',
  `shw_link` varchar(150) DEFAULT NULL COMMENT '导航链接地址',
  `cid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '所属分类',
  `mgr_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序值',
  `log_user` varchar(50) NOT NULL DEFAULT '' COMMENT '录入人',
  `log_time` datetime NOT NULL COMMENT '添加时间',
  `mgr_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 0:禁用,1:启用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='导航条管理' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `cms_nav`
--

INSERT INTO `cms_nav` (`id`, `shw_title`, `shw_intro`, `img_up`, `shw_link`, `cid`, `mgr_sort`, `log_user`, `log_time`, `mgr_status`) VALUES
(1, '网站首页', '网站首页', '', '/', 0, 0, 'admin', '2013-08-15 15:14:06', 1),
(2, '公司简介', '公司简介', '', '/index.php?act=aboutus.aboutus&cid=1', 0, 1, 'admin', '2013-08-15 15:16:25', 1),
(3, '产品中心', '产品中心', '', '/index.php?act=photo.photo', 0, 3, 'admin', '2013-08-15 15:19:36', 1),
(5, '新闻中心', '新闻中心', '', '/index.php?act=news.news', 0, 5, 'admin', '2013-08-15 15:21:43', 1),
(8, '联系我们', '联系我们', '', '/index.php?act=contact.contact', 0, 8, 'admin', '2013-08-15 15:23:58', 1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_skin`
--

CREATE TABLE IF NOT EXISTS `cms_skin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `shw_skin` varchar(30) NOT NULL COMMENT '皮肤路径',
  `shw_url` varchar(30) NOT NULL COMMENT '前台显示',
  `mgr_status` tinyint(3) unsigned DEFAULT '0' COMMENT '是否启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `cms_skin` (`id`, `shw_skin`, `shw_url`, `mgr_status`) VALUES (1, 'html/skin/default', 'default', 1);
--
-- 转存表中的数据 `cms_skin`
--


-- --------------------------------------------------------

--
-- 表的结构 `logoperate`
--

CREATE TABLE IF NOT EXISTS `logoperate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(200) DEFAULT NULL,
  `auth_id` int(11) DEFAULT NULL,
  `code` varchar(200) NOT NULL,
  `log_content` text NOT NULL,
  `log_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`),
  KEY `staff_name` (`staff_name`),
  KEY `auth_id` (`auth_id`),
  KEY `code` (`code`),
  KEY `log_date` (`log_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `logoperate`
--


-- --------------------------------------------------------

--
-- 表的结构 `staff_auth`
--

CREATE TABLE IF NOT EXISTS `staff_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `code` text NOT NULL,
  `staff_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_id` (`staff_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `staff_auth`
--

INSERT INTO `staff_auth` (`id`, `staff_id`, `code`, `staff_name`) VALUES
(1, 1, '["seoglobalmgr.seoglobal,seoglobalmgr.seoglobaladd,seoglobalmgr.seoglobaldel","seomgr.seo,seomgr.seoadd,seomgr.seodel,seomgr.seohtml,seomgr.seoautoall","tablemgr.table,tablemgr.tableadd,tablemgr.tabledel","classifymgr.classify,classifymgr.classifyadd,classifymgr.classifydel","navmgr.nav,navmgr.navadd,navmgr.navdel","navmgr.navreback,navmgr.navaddback","skinmgr.skin,skinmgr.skinadd,skinmgr.skindel","admin.users,admin.usersinfo,admin.usersadd,admin.edituser,admin.edituserpost,admin.rankuser,admin.rankuserpost","admin.log,admin.loginfo","admin.sysmenu,admin.sysmenuadd,admin.sysmenudel","admin.group,admin.groupadd,admin.groupdel","admin.changepwda","manage.nologin,manage.main"]', 'admin'),
(11, 2, '["seoglobalmgr.seoglobal,seoglobalmgr.seoglobaladd,seoglobalmgr.seoglobaldel","seomgr.seo,seomgr.seoadd,seomgr.seodel,seomgr.seohtml,seomgr.seoautoall","admin.users,admin.usersinfo,admin.usersadd,admin.edituser,admin.edituserpost,admin.rankuser,admin.rankuserpost","admin.log,admin.loginfo","admin.sysmenu,admin.sysmenuadd,admin.sysmenudel","admin.changepwda","manage.nologin,manage.main"]', 'admin');

--
-- 表的结构 `sysMenu`
--

CREATE TABLE IF NOT EXISTS `sysMenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` text NOT NULL COMMENT '模块权限',
  `jstext` text NOT NULL COMMENT '模块JS',
  `nodekey` varchar(100) NOT NULL COMMENT '节点key',
  `modulename` varchar(255) NOT NULL COMMENT '模块名',
  `menulevel` tinyint(1) DEFAULT '0' COMMENT '菜单级别',
  `displayorder` tinyint(3) DEFAULT '0' COMMENT '显示顺序',
  `isenable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统菜单权限' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `sysMenu`
--

INSERT INTO `sysMenu` (`id`, `code`, `jstext`, `nodekey`, `modulename`, `menulevel`, `displayorder`, `isenable`) VALUES
(1, '', '', 'system', '系统管理', 0, 85, 1),
(2, 'admin.users,admin.usersinfo,admin.usersadd,admin.edituser,admin.edituserpost,admin.rankuser,admin.rankuserpost', 'admin.usersinfo', 'system', '系统用户管理', 1, 99, 1),
(3, 'admin.log,admin.loginfo', 'admin.loginfo', 'system', '用户操作记录管理', 1, 100, 1),
(4, 'admin.sysmenu,admin.sysmenuadd,admin.sysmenudel', 'admin.sysmenu', 'system', '系统菜单管理', 1, 96, 1),
(5, 'admin.group,admin.groupadd,admin.groupdel', 'admin.group', 'system', '用户分组管理', 1, 98, 1),
(6, 'manage.nologin', '', 'system', '退出登录', 1, 101, 0),
(7, '', '', 'cms', '超越无限网站管理系统', 0, 1, 1),
(8, 'skinmgr.skin,skinmgr.skinadd,skinmgr.skindel', 'skinmgr.skin', 'system', '皮肤管理', 1, 95, 1),
(11, 'navmgr.navreback,navmgr.navaddback', 'navmgr.navreback', 'system', '导航回收站', 1, 97, 1),
(9, 'navmgr.nav,navmgr.navadd,navmgr.navdel', 'navmgr.nav', 'system', '导航条管理', 1, 89, 1),
(10, 'classifymgr.classify,classifymgr.classifyadd,classifymgr.classifydel', 'classifymgr.classify', 'system', '分类管理', 1, 86, 1),
(12, 'tablemgr.table,tablemgr.tableadd,tablemgr.tabledel', 'tablemgr.table', 'system', '分类对应表管理', 1, 87, 1),
(13, 'seomgr.seo,seomgr.seoadd,seomgr.seodel,seomgr.seohtml,seomgr.seoautoall', 'seomgr.seo', 'system', 'SEO静态处理', 1, 90, 1),
(14, 'seoglobalmgr.seoglobal,seoglobalmgr.seoglobaladd,seoglobalmgr.seoglobaldel', 'seoglobalmgr.seoglobaladd&acttype=1&id=1', 'system', 'SEO全局变量配置', 1, 88, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sysuser`
--

CREATE TABLE IF NOT EXISTS `sysuser` (
  `userId` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `loginId` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deparment` int(11) DEFAULT NULL COMMENT '部门id',
  `telephone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT NULL COMMENT '状态',
  `merchant` int(11) DEFAULT NULL COMMENT '为0时表示不属于任何商户',
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `placeId` bigint(20) DEFAULT NULL COMMENT '用户默认地点',
  `mebId` int(11) DEFAULT NULL COMMENT '会员id',
  `groupId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户分组id',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sysuser`
--

INSERT INTO `sysuser` (`userId`, `loginId`, `username`, `deparment`, `telephone`, `email`, `remark`, `state`, `merchant`, `password`, `placeId`, `mebId`, `groupId`) VALUES
(1, 'admin', 'admin', NULL, NULL, NULL, '管理员', 1, NULL, '52d85bf816c54b961f857492f4a60455', NULL, NULL, 2);


-- --------------------------------------------------------

--
-- 表的结构 `sysUserGroup`
--

CREATE TABLE IF NOT EXISTS `sysUserGroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分组id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '分组名称',
  `code` text COMMENT '权限json',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父类ID',
  `userName` varchar(255) NOT NULL DEFAULT '' COMMENT '创建人名字',
  `createtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理后台用户分组' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `sysUserGroup`
--

INSERT INTO `sysUserGroup` (`id`, `name`, `code`, `pid`, `userName`, `createtime`) VALUES
(2, '超级管理员', '["seoglobalmgr.seoglobal,seoglobalmgr.seoglobaladd,seoglobalmgr.seoglobaldel","seomgr.seo,seomgr.seoadd,seomgr.seodel,seomgr.seohtml,seomgr.seoautoall","tablemgr.table,tablemgr.tableadd,tablemgr.tabledel","classifymgr.classify,classifymgr.classifyadd,classifymgr.classifydel","navmgr.nav,navmgr.navadd,navmgr.navdel","navmgr.navreback,navmgr.navaddback","skinmgr.skin,skinmgr.skinadd,skinmgr.skindel","admin.users,admin.usersinfo,admin.usersadd,admin.edituser,admin.edituserpost,admin.rankuser,admin.rankuserpost","admin.log,admin.loginfo","admin.sysmenu,admin.sysmenuadd,admin.sysmenudel","admin.group,admin.groupadd,admin.groupdel","admin.changepwda","manage.nologin,manage.main"]', 0, 'admin', '2014-04-22 17:25:27');
