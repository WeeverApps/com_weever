
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
INSERT IGNORE INTO `#__weever_config` VALUES(11, 'about_app', '');
INSERT IGNORE INTO `#__weever_config` VALUES(12, 'loadspinner', '');
INSERT IGNORE INTO `#__weever_config` VALUES(100, 'theme_params', '{"aLink":null,"spanLogo":"","contentButton":"","border":"","fontType":"","blogIcon":"","pagesIcon":"","contactIcon":"","socialIcon":"","videoIcon":"","photoIcon":"","mapIcon":null,"titlebarHtml":null,"template":"sencha"}');

CREATE TABLE IF NOT EXISTS `#__weever_maps` (
  `id` int(11) NOT NULL auto_increment,
  `component_id` int(11) NOT NULL,
  `component` varchar(24) NOT NULL,
  `altitude` decimal(10,3) NOT NULL,
  `address` mediumtext NOT NULL,
  `label` varchar(16) NOT NULL,
  `kml` tinytext NOT NULL,
  `marker` tinytext NOT NULL,
  `location` point NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;