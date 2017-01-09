<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
try {
    $installer->run("
        CREATE TABLE IF NOT EXISTS {$this->getTable('mdlblog/mdlblog')} (
            `post_id` int( 11 ) unsigned NOT NULL AUTO_INCREMENT ,
            `cat_id` smallint( 11 ) NOT NULL default '0',
            `title` varchar( 255 ) NOT NULL default '',
            `post_content` text NOT NULL ,
            `status` smallint( 6 ) NOT NULL default '0',
			`blogimage` varchar( 255 ) NOT NULL,
			`blogthumb` varchar( 255 ) NOT NULL,
            `created_time` datetime default NULL ,
            `update_time` datetime default NULL ,
            `identifier` varchar( 255 ) NOT NULL default '',
            `user` varchar( 255 ) NOT NULL default '',
            `update_user` varchar( 255 ) NOT NULL default '',
            `meta_keywords` text NOT NULL ,
            `meta_description` text NOT NULL ,
            `comments` TINYINT( 11 ) NOT NULL,
			`short_content` text NOT NULL,
            PRIMARY KEY ( `post_id` ) ,
            UNIQUE KEY `identifier` ( `identifier` )
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
		
		
		
INSERT INTO {$this->getTable('mdlblog/mdlblog')} (`post_id`, `cat_id`, `title`, `post_content`, `status`, `blogimage`, `blogthumb`, `created_time`, `update_time`, `identifier`, `user`, `update_user`, `meta_keywords`, `meta_description`, `comments`, `short_content`) VALUES
(1, 0, 'Introducing new theme', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ligula at nunc egestas lacinia. Aliquam sed tristique nisi, sed finibus lectus. Mauris commodo augue nisl, quis tristique diam lobortis a. Morbi in sem felis. Mauris at consectetur orci, aliquet gravida elit. Curabitur ac nibh turpis. Duis auctor consequat est a faucibus. In pretium posuere neque bibendum placerat. Integer eu vestibulum arcu. Curabitur iaculis iaculis orci et eleifend. Sed nec quam hendrerit, tincidunt lectus nec, tincidunt elit. Donec porttitor vitae diam sit amet ultricies. Aliquam tincidunt, sem tincidunt blandit tristique, nibh neque egestas arcu, id rutrum risus leo vehicula quam. Morbi pulvinar porttitor magna ac condimentum. Sed in nibh convallis, volutpat ex eu, euismod elit. Quisque id luctus ex, id tempus neque.</p>', 1, 'blog/images/blog03.jpg', 'blog/thumb/blog03.jpg', '2014-10-17 06:16:10', '2014-11-14 08:07:38', 'Introducing-new-theme', 'John Dev', 'vj sahu', '', '', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ligula at nunc egestas lacinia. Aliquam sed tristique nisi, sed finibus lectus.</p>'),
(2, 0, 'Lorem ipsum dolo', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ligula at nunc egestas lacinia. Aliquam sed tristique nisi, sed finibus lectus. Mauris commodo augue nisl, quis tristique diam lobortis a. Morbi in sem felis. Mauris at consectetur orci, aliquet gravida elit. Curabitur ac nibh turpis. Duis auctor consequat est a faucibus. In pretium posuere neque bibendum placerat. Integer eu vestibulum arcu. Curabitur iaculis iaculis orci et eleifend. Sed nec quam hendrerit, tincidunt lectus nec, tincidunt elit. Donec porttitor vitae diam sit amet ultricies. Aliquam tincidunt, sem tincidunt blandit tristique, nibh neque egestas arcu, id rutrum risus leo vehicula quam. Morbi pulvinar porttitor magna ac condimentum. Sed in nibh convallis, volutpat ex eu, euismod elit. Quisque id luctus ex, id tempus neque.</p>', 1, 'blog/images/blog04.jpg', 'blog/thumb/blog04.jpg', '2014-10-16 06:19:45', '2014-11-14 10:12:04', 'Lorem-ipsum-dolo', 'John Dev', 'vj sahu', '', '', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ligula at nunc egestas lacinia. Aliquam sed tristique nisi, sed finibus lectus.</p>'),
(3, 0, 'Quisque id luctus ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ligula at nunc egestas lacinia. Aliquam sed tristique nisi, sed finibus lectus. Mauris commodo augue nisl, quis tristique diam lobortis a. Morbi in sem felis. Mauris at consectetur orci, aliquet gravida elit. Curabitur ac nibh turpis. Duis auctor consequat est a faucibus. In pretium posuere neque bibendum placerat. Integer eu vestibulum arcu. Curabitur iaculis iaculis orci et eleifend. Sed nec quam hendrerit, tincidunt lectus nec, tincidunt elit. Donec porttitor vitae diam sit amet ultricies. Aliquam tincidunt, sem tincidunt blandit tristique, nibh neque egestas arcu, id rutrum risus leo vehicula quam. Morbi pulvinar porttitor magna ac condimentum. Sed in nibh convallis, volutpat ex eu, euismod elit. Quisque id luctus ex, id tempus neque.</p>', 1, 'blog/images/blog01.jpg', 'blog/thumb/blog01.jpg', '2014-10-16 06:21:18', '2014-11-14 10:11:52', 'quisque-id-luctus', 'John Dev', 'vj sahu', '', '', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ligula at nunc egestas lacinia. Aliquam sed tristique nisi, sed finibus lectus.</p>'),
(4, 0, 'Donec egestas nibh ', '<p>Etiam tempor felis arcu, sed hendrerit lacus laoreet ac. Donec eleifend metus sed nulla tincidunt porttitor. Vivamus enim metus, viverra sed lobortis bibendum, posuere vel nunc. Suspendisse fermentum euismod odio eget efficitur. Vestibulum vel justo dui. Quisque vitae nisl vitae odio volutpat scelerisque. Phasellus id pharetra lorem. Praesent tincidunt lorem non tortor porttitor commodo. Donec egestas nibh vitae metus venenatis accumsan. In consequat ipsum quis condimentum mollis. Etiam malesuada molestie turpis, non interdum lectus scelerisque a. Sed quis pharetra sem. Suspendisse potenti. Aliquam tincidunt dictum dolor, eget lobortis urna. Integer semper ex a est fermentum varius. Aliquam tristique nulla nec imperdiet interdum. Mauris lacinia, arcu vel volutpat sollicitudin, enim risus faucibus justo, at euismod augue nibh quis sem.</p>', 1, 'blog/images/blog06.jpg', 'blog/thumb/blog06.jpg', '2014-10-16 06:22:15', '2014-11-14 10:16:43', 'donec-egestas-nibh', 'John Dev', 'vj sahu', '', '', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ligula at nunc egestas lacinia. Aliquam sed tristique nisi, sed finibus lectus.</p>'),
(5, 0, 'Suspendisse tempor', '<p>Praesent tincidunt lorem non tortor porttitor commodo. Donec egestas nibh vitae metus venenatis accumsan. In consequat ipsum quis condimentum mollis. Etiam malesuada molestie turpis, non interdum lectus scelerisque a. Sed quis pharetra sem. Suspendisse potenti. Aliquam tincidunt dictum dolor, eget lobortis urna. Integer semper ex a est fermentum varius. Aliquam tristique nulla nec imperdiet interdum. Mauris lacinia, arcu vel volutpat sollicitudin, enim risus faucibus justo, at euismod augue nibh quis sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est sed diam rutrum lacinia. In laoreet porta tempus. Sed scelerisque commodo velit sed blandit. Duis eget purus at mauris placerat elementum. Ut vitae tellus id velit molestie ultrices. Cras eget gravida metus. Etiam gravida risus scelerisque ligula vehicula, eget faucibus sapien tempus. Pellentesque vehicula porta consequat. Suspendisse tempor nec urna id laoreet. Quisque ac rutrum felis, et pharetra nulla. Nullam nulla enim, rhoncus sit amet fermentum rutrum, fermentum quis dui. Nullam ac libero quis sapien finibus congue sed ac ipsum. Sed eget convallis dui, nec imperdiet nisi. In nec finibus nulla. Nullam id libero quis leo vestibulum ullamcorper. Nulla dictum pellentesque porta. Aliquam et leo a elit varius finibus eu vel elit. Proin sollicitudin ullamcorper blandit. Donec fringilla posuere velit sit amet aliquam. Curabitur pulvinar, velit nec sagittis porta, eros dui vestibulum elit, et placerat felis tellus vel massa. Sed quis finibus massa, ac iaculis nisi. Nam felis tortor, maximus rhoncus eros vel, molestie interdum nulla. Vestibulum interdum nulla a magna volutpat fringilla vel ut lacus.</p>', 1, 'blog/images/blog02.jpg', 'blog/thumb/blog02.jpg', '2014-10-16 06:23:13', '2014-11-14 10:11:18', 'suspendisse-tempor', 'John Dev', 'vj sahu', '', '', 0, '<p>Etiam tempor felis arcu, sed hendrerit lacus laoreet ac. Donec eleifend metus sed nulla tincidunt porttitor. Vivamus enim metus, viverra sed lobortis bibendum,</p>'),
(6, 0, 'Vestibulum tincidunt', '<p>Praesent tincidunt lorem non tortor porttitor commodo. Donec egestas nibh vitae metus venenatis accumsan. In consequat ipsum quis condimentum mollis. Etiam malesuada molestie turpis, non interdum lectus scelerisque a. Sed quis pharetra sem. Suspendisse potenti. Aliquam tincidunt dictum dolor, eget lobortis urna. Integer semper ex a est fermentum varius. Aliquam tristique nulla nec imperdiet interdum. Mauris lacinia, arcu vel volutpat sollicitudin, enim risus faucibus justo, at euismod augue nibh quis sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est sed diam rutrum lacinia. In laoreet porta tempus. Sed scelerisque commodo velit sed blandit. Duis eget purus at mauris placerat elementum. Ut vitae tellus id velit molestie ultrices. Cras eget gravida metus. Etiam gravida risus scelerisque ligula vehicula, eget faucibus sapien tempus.</p>', 1, 'blog/images/blog08.jpg', 'blog/thumb/blog08.jpg', '2014-10-16 06:24:11', '2014-11-14 10:16:53', 'vestibulum-tincidunt', 'John Dev', 'vj sahu', '', '', 0, '<p>Etiam tempor felis arcu, sed hendrerit lacus laoreet ac. Donec eleifend metus sed nulla tincidunt porttitor. Vivamus enim metus, viverra sed lobortis bibendum,</p>');

		
		
		
		

        CREATE TABLE IF NOT EXISTS {$this->getTable('mdlblog/comment')} (
            `comment_id` int( 11 ) unsigned NOT NULL AUTO_INCREMENT ,
            `post_id` smallint( 11 ) NOT NULL default '0',
            `comment` text NOT NULL ,
            `status` smallint( 6 ) NOT NULL default '0',
            `created_time` datetime default NULL ,
            `user` varchar( 255 ) NOT NULL default '',
            `email` varchar( 255 ) NOT NULL default '',
            PRIMARY KEY ( `comment_id` )
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
		
		

        CREATE TABLE IF NOT EXISTS {$this->getTable('mdlblog/cat')} (
            `cat_id` int( 11 ) unsigned NOT NULL AUTO_INCREMENT ,
            `title` varchar( 255 ) NOT NULL default '',
            `identifier` varchar( 255 ) NOT NULL default '',
            `sort_order` tinyint ( 6 ) NOT NULL ,
            `meta_keywords` text NOT NULL ,
            `meta_description` text NOT NULL ,
            PRIMARY KEY ( `cat_id` )
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
		

INSERT INTO {$this->getTable('mdlblog/cat')} (`cat_id`, `title`, `identifier`, `sort_order`, `meta_keywords`, `meta_description`) VALUES
(1, 'Blog', 'blog', 0, '', '');

        CREATE TABLE IF NOT EXISTS {$this->getTable('mdlblog/store')} (
            `post_id` smallint(6) unsigned,
            `store_id` smallint(6) unsigned
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

INSERT INTO {$this->getTable('mdlblog/store')} (`post_id`, `store_id`) VALUES
(1, 1),
(1, 3),
(1, 2),
(5, 1),
(5, 3),
(5, 2),
(3, 1),
(3, 3),
(3, 2),
(2, 1),
(2, 3),
(2, 2),
(4, 1),
(4, 3),
(4, 2),
(6, 1),
(6, 3),
(6, 2);

        CREATE TABLE IF NOT EXISTS {$this->getTable('mdlblog/cat_store')} (
            `cat_id` smallint(6) unsigned,
            `store_id` smallint(6) unsigned
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
		
		
INSERT INTO {$this->getTable('mdlblog/cat_store')} (`cat_id`, `store_id`) VALUES
(1, 0);
		

        CREATE TABLE IF NOT EXISTS {$this->getTable('mdlblog/post_cat')} (
            `cat_id` smallint(6) unsigned,
            `post_id` smallint(6) unsigned
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
		
		INSERT INTO {$this->getTable('mdlblog/post_cat')} (`cat_id`, `post_id`) VALUES
		(1, 1),
		(1, 5),
		(1, 3),
		(1, 2),
		(1, 4),
		(1, 6);
		
        ALTER TABLE {$this->getTable('mdlblog/mdlblog')} ADD `short_content` TEXT NOT NULL;
    ");
} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();