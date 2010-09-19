mURL
=============

This is a re-write in cakePHP for the original custom mURL.net application.

Setup
-------

* Download the latest from GitHub onto a new directory hierarchy.
* Download the latest [cakePHP1.3](http://github.com/cakephp/cakephp/tree/1.3) and place at same level as this README file as *cake*.
* Create MySQL database with the sctructure defined below.
* Create file config/database.php based on the sample provided.

Database
------------

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

    DROP TABLE IF EXISTS `bans`;
    SET @saved_cs_client     = @@character_set_client;
    SET character_set_client = utf8;
    CREATE TABLE `bans`(
      `id` int(11) NOT NULL auto_increment,
      `type` enum('ip','domain') NOT NULL default 'ip',
      `user_id` int(11) NOT NULL,
      `string` varchar(255) NOT NULL,
      `created` datetime default NULL,
      `modified` datetime default NULL,
      PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
    SET character_set_client = @saved_cs_client;

    DROP TABLE IF EXISTS `users`;
    SET @saved_cs_client     = @@character_set_client;
    SET character_set_client = utf8;
    CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` char(50) DEFAULT NULL,
        `password` char(40) DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
    SET character_set_client = @saved_cs_client;

Contributing
------------

1. Fork it.
2. Create a branch (`git checkout -b my_murl`)
3. Commit your changes (`git commit -am "Added Cool Feature"`)
4. Push to the branch (`git push origin my_murl`)
5. Create an [Issue][1] with a link to your branch

[1]: http://github.com/github/mURL/issues

