
CREATE TABLE IF NOT EXISTS `#__weever_tabs` (
  `name` varchar(255) NOT NULL,
  `component` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL default '1',
  `component_id` int(11) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `icon` varchar(255) NOT NULL default 'icon.png',
  `component_behaviour` varchar(255) NOT NULL,
  `parent_tab_id` int(11) NOT NULL default '0',
  `cloud_tab_id` int(11) NOT NULL,
  `default` tinyint(1) NOT NULL default '0',
  `cms_feed` tinytext NOT NULL,
  `var` tinytext NOT NULL,
  `hash` varchar(64) NOT NULL,
  `ordering` decimal(11,1) NOT NULL default '1.0',
  `type` varchar(63) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__weever_config` (
  `id` int(11) NOT NULL auto_increment,
  `option` varchar(55) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


INSERT IGNORE INTO `#__weever_config` VALUES(1, 'title', 'AppName');
INSERT IGNORE INTO `#__weever_config` VALUES(2, 'titlebar_title', 'Your Weever Web App Title');
INSERT IGNORE INTO `#__weever_config` VALUES(3, 'site_key', '');
INSERT IGNORE INTO `#__weever_config` VALUES(4, 'primary_domain', '');
INSERT IGNORE INTO `#__weever_config` VALUES(5, 'devices', 'DetectTierWeeverSmartphones');
INSERT IGNORE INTO `#__weever_config` VALUES(6, 'app_enabled', '0');
INSERT IGNORE INTO `#__weever_config` VALUES(7, 'staging_mode', '0');
INSERT IGNORE INTO `#__weever_config` VALUES(8, 'ecosystem', '0');
INSERT IGNORE INTO `#__weever_config` VALUES(9, 'google_analytics', '');
INSERT IGNORE INTO `#__weever_config` VALUES(10, 'domain', '');
INSERT IGNORE INTO `#__weever_config` VALUES(100, 'theme_params', '{"aLink":null,"spanLogo":"","contentButton":"","border":"","fontType":"","blogIcon":"","pagesIcon":"","contactIcon":"","socialIcon":"","videoIcon":"","photoIcon":"","mapIcon":null,"titlebarHtml":null,"template":"sencha"}');