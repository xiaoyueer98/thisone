SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ekucms`
--

-- --------------------------------------------------------

--
-- 表的结构 `eku_adsense`
--

CREATE TABLE IF NOT EXISTS `eku_adsense` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 导出表中的数据 `eku_adsense`
--

INSERT INTO `eku_adsense` (`id`, `title`, `content`) VALUES
(6, 'list_250_250', '<a href="http://www.ekucms.com/" target="_blank"><img src="/images/250.jpg" width="250" height="250" /></a>'),
(7, 'video_info_right_250_250', '<a href="http://www.ekucms.com/" target="_blank"><img src="/images/250.jpg" width="250" height="250" /></a>'),
(8, 'video_info_right_250_250_2', '<a href="http://www.ekucms.com/" target="_blank"><img src="/images/250.jpg" width="250" height="250" /></a>'),
(9, 'play_700_90', '<a href="http://www.ekucms.com/" target="_blank"><img src="/images/700.jpg" width="700" height="90" /></a>'),
(10, 'play_250_250', '<a href="http://www.ekucms.com/" target="_blank"><img src="/images/250.jpg" width="250" height="250" /></a>'),
(11, 'inde_960_90', '<a href="http://www.ekucms.com/" target="_blank"><img src="/images/960_90.jpg" width="960" height="90" /></a>'),
(12, 'inde_960_90_2', '<a href="http://www.ekucms.com/" target="_blank"><img src="/images/960_90.jpg" width="960" height="90" /></a>'),
(13, 'fumeiti_quanzhan', '<script language="javascript">\r\nvar v_dianxin_said = 27943;\r\nvar v_dianxin_width = 300;\r\nvar v_dianxin_height = 300\r\nvar v_dianxin_type = 0;\r\n</script>\r\n<script language="javascript" src="/js/cpv.js" charset="utf-8"></script>'),
(14, 'duilian_quanzhan', '<script language="javascript">\r\nvar c_dianxin_said = 21223;\r\nvar c_dianxin_width = 120;\r\nvar c_dianxin_height = 300;\r\nvar c_dianxin_type_b = 1;\r\nvar c_dianxin_type_s = 0;\r\n</script>\r\n<script language="javascript" src="/js/cpc.js" charset="utf-8"></script>');
-- --------------------------------------------------------

--
-- 表的结构 `eku_channel`
--

CREATE TABLE IF NOT EXISTS `eku_channel` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) NOT NULL,
  `oid` smallint(5) NOT NULL,
  `mid` tinyint(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `cname` char(20) NOT NULL,
  `cfile` varchar(20) NOT NULL,
  `ctpl` char(20) NOT NULL,
  `cwebsite` varchar(255) NOT NULL,
  `ctitle` varchar(50) NOT NULL,
  `ckeywords` varchar(255) NOT NULL,
  `cdescription` varchar(255) NOT NULL,
  `ctype`  varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 导出表中的数据 `eku_channel`
--

INSERT INTO `eku_channel` (`id`, `pid`, `oid`, `mid`, `status`, `cname`, `cfile`, `ctpl`, `cwebsite`, `ctitle`, `ckeywords`, `cdescription`, `ctype`) VALUES
(1, 0, 1, 1, 1, '视频直播', 'dianying', 'video_channel', 'http://', '', '', '', 'live'),
(2, 0, 2, 1, 1, '视频点播', 'dianshiju', 'video_channel', 'http://', '', '', 'vod'),
(3, 0, 3, 1, 1, '网络电视', 'dongman', 'video_channel', 'http://', '', '', 'tv'),
(5, 0, 25, 1, 1, '网络电台', 'netradio', 'video_channel', 'http://', '', '', 'live'),
(6, 0, 6, 1, 1, '网络监控', 'netmonitor', 'video_channel', 'http://', '', '', 'live')，
(6, 0, 6, 1, 1, '归档视频', 'filelive', 'video_channel', 'http://', '', '', 'vod');

-- --------------------------------------------------------

--
-- 表的结构 `eku_comment`
--

CREATE TABLE IF NOT EXISTS `eku_comment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `did` mediumint(8) NOT NULL,
  `mid` tinyint(2) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `content` varchar(255) NOT NULL,
  `up` mediumint(8) NOT NULL DEFAULT '0',
  `down` mediumint(8) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `did` (`did`),
  KEY `uid` (`uid`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `eku_comment`
--

INSERT INTO `eku_comment` (`id`, `did`, `mid`, `uid`, `content`, `up`, `down`, `ip`, `addtime`, `status`) VALUES
(1, 2, 1, 1, '我的青表', 0, 0, '127.0.0.1', 1364811117, 0),
(2, 100, 1, 1, '原来如此', 0, 0, '127.0.0.1', 1364811224, 0),
(3, 1426, 1, 1, '好的', 0, 0, '127.0.0.1', 1364826426, 0);

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `eku_linkkeys` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  `count` int(10) NOT NULL,
  `target` varchar(20) NOT NULL DEFAULT '_blank',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='内链表' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `eku_replacekeys` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstkey` varchar(100) NOT NULL,
  `endkey` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='伪原创替换关键字表' AUTO_INCREMENT=1 ;

--
-- 表的结构 `eku_co_channel`
--

CREATE TABLE IF NOT EXISTS `eku_co_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL DEFAULT '',
  `reid` smallint(6) NOT NULL DEFAULT '0',
  `nid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `eku_co_channel`
--

INSERT INTO `eku_co_channel` (`id`, `cname`, `reid`, `nid`) VALUES
(1, '动画卡通', 3, 0);

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `eku_slide_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='幻灯片分类' AUTO_INCREMENT=5 ;

INSERT INTO `eku_slide_type` (`id`, `name`) VALUES
(1, '首页');

--
-- 表的结构 `eku_co_content`
--

CREATE TABLE IF NOT EXISTS `eku_co_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` tinyint(2) NOT NULL DEFAULT '0',
  `nid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL,
  `title` char(100) NOT NULL,
  `data` text NOT NULL,
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `nid` (`nid`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 导出表中的数据 `eku_co_content`
--

-- --------------------------------------------------------

--
-- 表的结构 `eku_co_node`
--

CREATE TABLE IF NOT EXISTS `eku_co_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `class` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL,
  `lastdate` int(10) unsigned NOT NULL DEFAULT '0',
  `menutype` tinyint(3) unsigned DEFAULT '2',
  `cid` smallint(5) unsigned DEFAULT '0',
  `colmode` varchar(50) DEFAULT NULL,
  `direct` tinyint(1) NOT NULL DEFAULT '0',
  `sourcecharset` varchar(8) NOT NULL,
  `sourcetype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `urlpage` text NOT NULL,
  `pagesize_start` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pagesize_end` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `par_num` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `url_contain` char(100) NOT NULL,
  `url_except` char(100) NOT NULL,
  `picmode` tinyint(3) NOT NULL DEFAULT '2',
  `pic_start` char(100) NOT NULL DEFAULT '',
  `pic_end` char(100) NOT NULL DEFAULT '',
  `url_start` char(100) NOT NULL DEFAULT '',
  `url_end` char(100) NOT NULL DEFAULT '',
  `fields` varchar(255) DEFAULT NULL,
  `title_rule` char(100) NOT NULL,
  `title_filter` text NOT NULL,
  `cname_rule` char(100) NOT NULL DEFAULT '',
  `cname_filter` text NOT NULL,
  `intro_rule` char(100) NOT NULL DEFAULT '',
  `intro_filter` text NOT NULL,
  `time_rule` char(100) NOT NULL DEFAULT '',
  `time_filter` text NOT NULL,
  `director_rule` char(100) NOT NULL DEFAULT '',
  `director_filter` text NOT NULL,
  `actor_rule` char(100) NOT NULL DEFAULT '',
  `actor_filter` text NOT NULL,
  `content_rule` char(100) NOT NULL,
  `content_filter` text NOT NULL,
  `picurl_rule` char(100) NOT NULL DEFAULT '',
  `picurl_filter` text NOT NULL,
  `range` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `playmode` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `playlist_start` char(100) NOT NULL DEFAULT '',
  `playlist_end` char(100) NOT NULL DEFAULT '',
  `purl_range` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `playurl_start` char(100) NOT NULL DEFAULT '',
  `playurl_end` char(100) NOT NULL DEFAULT '',
  `playlink_rule` char(100) NOT NULL DEFAULT '',
  `playlink_filter` text NOT NULL,
  `playurl_rule` char(100) NOT NULL DEFAULT '',
  `playurl_filter` text NOT NULL,
  `area_rule` char(100) NOT NULL DEFAULT '',
  `area_filter` text NOT NULL,
  `language_rule` char(100) NOT NULL DEFAULT '',
  `language_filter` text NOT NULL,
  `year_rule` char(100) NOT NULL DEFAULT '',
  `year_filter` text NOT NULL,
  `serial_rule` char(100) NOT NULL DEFAULT '',
  `serial_filter` text NOT NULL,
  `vname_rule` char(100) NOT NULL DEFAULT '',
  `vname_filter` text NOT NULL,
  `vnamemode` tinyint(3) NOT NULL DEFAULT '2',
  `playlists` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `eku_co_node`
--

-- --------------------------------------------------------

--
-- 表的结构 `eku_co_urls`
--

CREATE TABLE IF NOT EXISTS `eku_co_urls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `md5` varchar(32) NOT NULL DEFAULT '',
  `nid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `md5` (`md5`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 导出表中的数据 `eku_co_urls`
--
-- --------------------------------------------------------

--
-- 表的结构 `eku_gbook`
--

CREATE TABLE IF NOT EXISTS `eku_gbook` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `errid` mediumint(8) NOT NULL DEFAULT '0',
  `uid` mediumint(8) NOT NULL,
  `content` varchar(255) NOT NULL,
  `recontent` text NOT NULL,
  `ip` varchar(20) NOT NULL,
  `top` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `eku_gbook`
--

-- --------------------------------------------------------

--
-- 表的结构 `eku_info`
--

CREATE TABLE IF NOT EXISTS `eku_info` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cid` smallint(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `color` char(8) NOT NULL,
  `picurl` varchar(255) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `reurl` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `content` text NOT NULL,
  `hits` mediumint(8) NOT NULL,
  `monthhits` int(8) NOT NULL,
  `weekhits` int(8) NOT NULL,
  `dayhits` int(8) NOT NULL,
  `hitstime` int(11) NOT NULL,
  `stars` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `up` mediumint(8) NOT NULL,
  `down` mediumint(8) NOT NULL,
  `jumpurl` varchar(255) NOT NULL,
  `letter` char(2) NOT NULL,
  `addtime` int(11) NOT NULL,
  `score` decimal(3,1) NOT NULL,
  `scoreer` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `addtime` (`addtime`,`cid`),
  KEY `hits` (`hits`,`cid`),
  KEY `up` (`up`),
  KEY `down` (`down`),
  KEY `score` (`score`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `eku_info`
--

-- --------------------------------------------------------

--
-- 表的结构 `eku_link`
--

CREATE TABLE IF NOT EXISTS `eku_link` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `oid` tinyint(3) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `eku_link`
--

INSERT INTO `eku_link` (`id`, `title`, `logo`, `url`, `oid`, `type`) VALUES
(1, '方讯影视系统', 'http://', 'http://www.ekucms.com', 1, 1),
(2, '方讯网', 'http://', 'http://www.keatv.com', 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `eku_master`
--

CREATE TABLE IF NOT EXISTS `eku_master` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pwd` char(32) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `logincount` smallint(5) NOT NULL,
  `loginip` varchar(40) NOT NULL,
  `logintime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `eku_master`
--

INSERT INTO `eku_master` (`id`, `user`, `pwd`, `usertype`, `logincount`, `loginip`, `logintime`) VALUES
(1, 'admin', '7fef6171469e80d32c0559f88b377245', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 12, '127.0.0.1', 1364806213);

-- --------------------------------------------------------

--
-- 表的结构 `eku_self`
--

CREATE TABLE IF NOT EXISTS `eku_self` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(200) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `content` text,
  `picurl` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `actiontime` int(10) NOT NULL DEFAULT '0',
  `orders` int(11) NOT NULL DEFAULT '0',
  `douser` int(11) NOT NULL DEFAULT '0',
  `content1` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 导出表中的数据 `eku_self`
--

-- --------------------------------------------------------

--
-- 表的结构 `eku_self_type`
--

CREATE TABLE IF NOT EXISTS `eku_self_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 导出表中的数据 `eku_self_type`
--

INSERT INTO `eku_self_type` (`id`, `fid`, `name`) VALUES
(1, 0, '首页1'),
(2, 1, '首页幻灯片'),
(5, 1, '首页最近热播'),
(6, 1, '首页电影右下角位置'),
(7, 1, '首页电视剧右下角位置'),
(8, 0, '通用导航'),
(9, 8, '通用导航右边手工');

-- --------------------------------------------------------

--
-- 表的结构 `eku_slide`
--

CREATE TABLE IF NOT EXISTS `eku_slide` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `oid` tinyint(2) NOT NULL,
  `title` varchar(50) NOT NULL,
  `picurl` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `picurls` VARCHAR( 100 ) NULL,
  `fid` int(10) NOT NULL DEFAULT 0,
  `mid` int(10) NOT NULL DEFAULT 0,
  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `eku_slide`
--
-- --------------------------------------------------------

--
-- 表的结构 `eku_special`
--

CREATE TABLE IF NOT EXISTS `eku_special` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `banner` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `tpl` varchar(50) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `aids` text NOT NULL COMMENT '专题文章',
  `mids` text NOT NULL COMMENT '专题影片',
  `addtime` int(11) NOT NULL,
  `hits` mediumint(8) NOT NULL,
  `monthhits` int(8) NOT NULL,
  `weekhits` int(8) NOT NULL,
  `dayhits` int(8) NOT NULL,
  `hitstime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `eku_special`
--


-- --------------------------------------------------------

--
-- 表的结构 `eku_stype`
--

CREATE TABLE IF NOT EXISTS `eku_stype` (
  `m_cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_list_id` int(10) unsigned NOT NULL DEFAULT '0',
  `m_name` varchar(30) NOT NULL DEFAULT '',
  `m_order` int(11) NOT NULL,
  PRIMARY KEY (`m_cid`),
  KEY `m_list_id` (`m_list_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 导出表中的数据 `eku_stype`
--

-- --------------------------------------------------------

--
-- 表的结构 `eku_user`
--

CREATE TABLE IF NOT EXISTS `eku_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `userpwd` char(32) NOT NULL,
  `money` mediumint(9) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `pay` tinyint(1) NOT NULL,
  `question` varchar(50) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `logip` varchar(16) NOT NULL,
  `lognum` smallint(5) NOT NULL DEFAULT '0',
  `logtime` int(10) NOT NULL,
  `joinip` varchar(16) NOT NULL,
  `jointime` int(10) NOT NULL,
  `duetime` int(10) NOT NULL,
  `qq` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `face` varchar(50) NOT NULL,
  `level` smallint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `eku_user`
--

INSERT INTO `eku_user` (`id`, `username`, `userpwd`, `money`, `status`, `pay`, `question`, `answer`, `logip`, `lognum`, `logtime`, `joinip`, `jointime`, `duetime`, `qq`, `email`, `face`, `level`) VALUES
(1, '游客', '74b87337454200d4d33f80c4663dc5e5', 120, 1, 0, '123456', '123456', '127.0.0.1', 21, 1299233747, '127.0.0.1', 1298433430, 1300852630, '', '123@qq.com', '', 1);
-- --------------------------------------------------------

--
-- 表的结构 `eku_userview`
--

CREATE TABLE IF NOT EXISTS `eku_userview` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `did` mediumint(8) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `viewtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `viewtime` (`viewtime`),
  KEY `did` (`did`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `eku_userview`
--


-- --------------------------------------------------------

--
-- 表的结构 `eku_video`
--

CREATE TABLE IF NOT EXISTS `eku_video` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cid` smallint(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `color` char(8) NOT NULL default '#FF0000',
  `actor` varchar(255) NOT NULL default '',
  `director` varchar(255) NOT NULL default '',
  `content` text NOT NULL default '',
  `picurl` varchar(255) NOT NULL,
  `area` char(10) NOT NULL default '',
  `language` char(10) NOT NULL default '中国',
  `year` smallint(4) NOT NULL default '2000',
  `serial` varchar(50) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL,
  `hits` mediumint(8) NOT NULL DEFAULT '0',
  `monthhits` int(8) NOT NULL,
  `weekhits` int(8) NOT NULL,
  `dayhits` int(8) NOT NULL,
  `hitstime` int(11) NOT NULL,
  `stars` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `up` mediumint(8) NOT NULL DEFAULT '0',
  `down` mediumint(8) NOT NULL DEFAULT '0',
  `playurl` longtext NOT NULL,
  `downurl` longtext NOT NULL,
  `inputer` varchar(30) NOT NULL,
  `reurl` varchar(255) NOT NULL,
  `letter` char(2) NOT NULL,
  `score` decimal(3,1) NOT NULL,
  `scoreer` smallint(6) NOT NULL,
  `genuine` int(11) NOT NULL,
  `vodplay` varchar(100) DEFAULT NULL,
  `stype_mcid` varchar(400) DEFAULT NULL,
  `selftitle` varchar(200) DEFAULT NULL,
  `selfkeywords` varchar(400) DEFAULT NULL,
  `selfdescription` varchar(1000) DEFAULT NULL,
  `starttime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `ctype`  varchar(6) NOT NULL,
  `auth`  smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `addtime` (`addtime`,`cid`),
  KEY `hits` (`hits`,`cid`),
  KEY `up` (`up`),
  KEY `down` (`down`),
  KEY `score` (`score`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1573 ;

--
-- 导出表中的数据 `eku_video`
--

-- --------------------------------------------------------

--
-- 表的结构 `eku_sources`
--

CREATE TABLE IF NOT EXISTS `eku_sources` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `source_id` varchar(255),
  `size` float(20,2) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `upload_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- 表的结构 `eku_streams`
--

CREATE TABLE IF NOT EXISTS `eku_streams` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cfile` varchar(255) NOT NULL,
  `channel` varchar(255) NOT NULL,
  `active_time` varchar(20) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `play` varchar(32),
  `status` smallint(2),
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- 表的结构 `eku_ms_channel`
--

CREATE TABLE IF NOT EXISTS `eku_ms_channel` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `live` char(5) NOT NULL,
  `republish` char(5) NOT NULL,
  `play` char(5) NOT NULL,
  `audio_only` char(5) NOT NULL,
  `publish` varchar(255),
  `vod_path` varchar(255),
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
-- --------------------------------------------------------

--
-- 表的结构 `eku_transcode_info`
--

CREATE TABLE IF NOT EXISTS `eku_transcode_info` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(20) NOT NULL,
  `name` varchar(64) NOT NULL,
  `video_bitrate` int(10) NOT NULL,
  `width` smallint(5),
  `height` smallint(5),
  `fps`  smallint(2),
  `audio_bitrate` int(6) NOT NULL,
  `samplerate` int(6) NOT NULL,
  `channel`  smallint(2),
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `eku_transcode_info`
--

INSERT INTO `eku_transcode_info` (`id`, `short_name`, `name`, `video_bitrate`, `width`, `height`, `fps`, `audio_bitrate`, `samplerate`, `channel`) VALUES
(1, `高清`, `高清 720P 1.5M`, 150000, 1280, 720, 25, 64000, 44100, 2),
(2, `高清`, `高清 720P 1.2M`, 1200000, 1280, 720, 25, 64000, 44100, 2),
(3, `高清`, `高清 720P 1M`, 1000000, 1280, 720, 25, 64000, 44100, 2),
(4, `标清`, `标清 800x600 800K`, 800000, 800, 600, 25, 64000, 44100, 2),
(5, `标清`, `标清 640x480 500K`, 500000, 640, 480, 25, 32000, 44100, 2),
(6, `低码率`, `低码率 640x480 300K`, 300000, 640, 480, 25, 32000, 44100, 2),
(7, `低码率`, `低码率 320x240 300K`, 300000, 320, 240, 25, 32000, 44100, 2),
(8, `低码率`, `超低码率 320x240 200K`, 200000, 320, 240, 25, 16000, 44100, 2);
-- --------------------------------------------------------

--
-- 表的结构 `eku_videoauth`
--

CREATE TABLE IF NOT EXISTS `eku_videoauth` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `vid` varchar(255) NOT NULL,
  `gid` dmallint(5),
  `type` smallint(1) NOT NULL,
  `duetime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `eku_level`
--

CREATE TABLE IF NOT EXISTS `eku_level` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `eku_level`
--
INSERT INTO `eku_level` (`id`, `name`, `desc`) VALUES
(1, '初级权限', '初级权限'),
(2, '一级权限', '一级权限'),
(3, '二级权限', '二级权限'),
(4, '三级权限', '三级权限'),
(5, '四级权限', '三级权限');

-- --------------------------------------------------------

--
-- 表的结构 `eku_dvrconfig`
--

CREATE TABLE IF NOT EXISTS `eku_dvrconfig` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cfile` varchar(20) NOT NULL,
  `is_dvr` smallint(8) NOT NULL,
  `media_root` varchar(255),
  `formats`  varchar(32),
  `tv_streams` varchar(255),
  `keep_time` smallint(10),
  `analyze_duration` smallint(8),
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- 表的结构 `eku_group`
--

CREATE TABLE IF NOT EXISTS `eku_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `describe` varchar(255),
  `buildtime`  int(10),
  `face` varchar(255),
  `uid` mediumint(10),
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- 表的结构 `eku_groupmember`
--

CREATE TABLE IF NOT EXISTS `eku_groupmember` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `gid` mediumint(8) NOT NULL,
  `jointime` int(10) NOT NULL,
  `status` tinyint(255),
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- 表的结构 `eku_video_play_white_list`
--

CREATE TABLE IF NOT EXISTS `eku_video_play_white_list` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `vid` varchar(20) NOT NULL,
  `gid` mediumint(8) NOT NULL,
  `jointime` int(10) NOT NULL,
  `status` int(1),
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- 表的结构 `eku_video_push_white_list`
--

CREATE TABLE IF NOT EXISTS `eku_video_push_white_list` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `vid` varchar(20) NOT NULL,
  `uid` mediumint(8) NOT NULL,
  `jointime` int(10) NOT NULL,
  `status` int(1),
  PRIMARY KEY (`id`)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
