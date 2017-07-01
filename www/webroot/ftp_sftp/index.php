<?php
require_once("class/class.ftp_sftp.php");
//$sftphost = "110.170.149.35";
$sftphost = "203.113.25.92";
//$sftpuser = "exchange-data";
//$sftppass = "exchange-data#password";
$sftpuser = "dopns";
$sftppass = "dopns#pwd";
//$sftpport = 2222;
$sftpport = 2222;
$sftp = new ftp_sftp($sftphost, $sftpuser, $sftppass, "sftp", $sftpport);
$sftp->pwd();
?>