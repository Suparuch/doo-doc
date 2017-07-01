<?php
/*
 * log prefix postfix 
 */
define('LOGPATH',"log");
define('LOGPREFIX', date("Y-m-d H:i:s") . ">");
define('LOGPOSTFIX', "\r\n");

/*
 * dopns directory in data exchange server
 */
$dir_list = array("dopns");
define("DIRIN", "input");
define("DIROUT", "output");
define("DIRBACK", "backup");
/*
 * SFTP CONFIG 
 */
//DATA EXCHANGE SERVER
define("EXCHG_SFTPHOST", "172.13.0.201");
define("EXCHG_SFTPUSER", "mtc");
define("EXCHG_SFTPPASS", "mtc@ssh321");
define("EXCHG_SFTPPORT", 2222);
define("EXCHG_SFTPCONN", "sftp");
