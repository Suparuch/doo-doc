<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* real path */
define('ROOTPATH', str_replace('\\', '/', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '/') . '/'));
require_once("config/config.app.php");
require_once("common/common.function.php");
require_once("class/class.ftp_sftp.php");
require_once("class/class.log.php");