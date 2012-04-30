CREATE TABLE `emilios` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `ubication_id` int(11) NOT NULL,
  `body_data` text,
  `to` varchar(255) NOT NULL,
  `send_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
);


CREATE TABLE `ubications` (
  `id` int(11) NOT NULL auto_increment,
  `route` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
);
