-- MySQL dump 10.11

--
-- Table structure for table `hits`
--

DROP TABLE IF EXISTS `hits`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `hits` (
  `id` int(11) NOT NULL auto_increment,
  `murl_id` int(11) NOT NULL,
  `remote` varchar(20) default NULL,
  `referer` varchar(255) default NULL,
  `agent` varchar(255) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `murls`
--

DROP TABLE IF EXISTS `murls`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `murls` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(255) NOT NULL default '',
  `protect` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `destruct` tinyint(1) NOT NULL default '0',
  `private` tinyint(1) NOT NULL default '0',
  `hits` int(11) NOT NULL default '0',
  `remote` varchar(20) NOT NULL default '0.0.0.0',
  `referer` varchar(255) NOT NULL,
  `agent` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nick` (`code`),
  KEY `nick_index` (`code`(10))
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;
