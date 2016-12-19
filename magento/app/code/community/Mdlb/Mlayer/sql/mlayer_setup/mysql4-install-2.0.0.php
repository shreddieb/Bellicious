<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('mlayer')};
CREATE TABLE {$this->getTable('mlayer')} (
  `mlayer_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `position` varchar(255) NULL,
  `filename` varchar(255) NOT NULL default '',
  `content` text NULL,
  `status` smallint(6) NOT NULL default '0',
  `contentpos` smallint(6) NOT NULL default '0',
  `weblink` varchar(255) NULL,
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  `stores` text default '',
  `is_home` tinyint(1) NOT NULL default '0',
  `categories` text default '',
  PRIMARY KEY (`mlayer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO {$this->getTable('mlayer')} (`mlayer_id`, `title`, `position`, `filename`, `content`, `status`, `contentpos`, `weblink`, `created_time`, `update_time`, `stores`, `is_home`, `categories`) VALUES
(7, 'Fashion season', 'cms-page-menu-bottom', 'banner1.jpg', 'Dolor sit amet consectetur adipiscing elit. Aliquam neque est gravida vel sagittis vel accumsan eu nunliquam quis porttitor orci.Dolor sit amet consectetur.', 1, 2, 'https://www.google.co.uk/', '2014-03-04 19:01:03', '2014-03-04 19:01:03', '0', 0, NULL),
(8, 'Summer Trends',  'cms-page-menu-bottom', 'banner3.jpg', 'Dolor sit amet consectetur adipiscing elit. Aliquam neque est gravida vel sagittis vel accumsan eu nunliquam quis porttitor orci.Dolor sit amet consectetur.', 1, 1, 'https://www.google.co.uk/', '2014-03-04 19:01:12', '2014-03-04 19:01:12', '0', 0, NULL),
(9, 'U&Me Collection',  'cms-page-menu-bottom', 'banner2.jpg', 'Dolor sit amet consectetur adipiscing elit. Aliquam neque est gravida vel sagittis vel accumsan eu nunliquam quis porttitor orci.Dolor sit amet consectetur.', 1, 1, 'https://www.google.co.uk/', '2014-03-04 19:01:22', '2014-03-04 19:01:22', '0', 0, NULL);

");

$installer->endSetup();