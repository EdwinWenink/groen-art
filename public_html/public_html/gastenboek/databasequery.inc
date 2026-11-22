`ip` varchar( 20 ) NOT NULL default '',
`id` int( 50 ) NOT NULL AUTO_INCREMENT ,
`bericht` text NOT NULL ,
`auteur` varchar( 250 ) NOT NULL default '',
`email` varchar( 250 ) NOT NULL default '',
`datum` varchar( 23 ) NOT NULL default '',
PRIMARY KEY ( `id` )
) TYPE = MYISAM; 