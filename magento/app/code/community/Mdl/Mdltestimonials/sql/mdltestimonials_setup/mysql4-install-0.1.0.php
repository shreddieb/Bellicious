<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('mdltestimonials')};
CREATE TABLE {$this->getTable('mdltestimonials')} (
  `mdltestimonials_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `store_id` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mdltestimonials_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mdltestimonials`
--

INSERT INTO {$this->getTable('mdltestimonials')} (`mdltestimonials_id`, `title`, `author`, `filename`, `content`, `store_id`, `status`) VALUES
(1, 'Testimonial 01', 'John Dev', 'a1.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ', '0', 1),
(2, 'Testimonial 02', 'Jennifer Smith', 'a3.jpg', ' Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait', '0', 1),
(4, 'Testimonial 03', 'Juan', 'a4_1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nisl orci, condimentum ultrices consequat eu. Aenean nisl orci, cosequat eu.', NULL, 1);
");

$installer->endSetup(); 
