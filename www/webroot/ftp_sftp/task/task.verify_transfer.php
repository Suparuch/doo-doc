<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../lib.cfg.php");
$sftp = new ftp_sftp(EXCHG_SFTPHOST, EXCHG_SFTPUSER, EXCHG_SFTPPASS, EXCHG_SFTPCONN, EXCHG_SFTPPORT);
$log = new log();
$source_root = ROOTPATH;
$dir = "";
$nowdate = date("YmdHis");

$source_output = $source_root."../../Upload/output";
$dest_now = "";
$source_log = "";
$source_log = "www/Upload/log";

$logname = "transfer" . $nowdate . ".txt";
$log->setpath($source_log . "/", $logname);
$log->writelog(LOGPREFIX . " Start verifying to transfer at : " . $source_output . LOGPOSTFIX);
$list = filenameList($source_output);
$count = 0;
if(!empty($list)){
	foreach($list as $idx_list => $filename) {
		$local_source = $source_output . "/" .$filename ;
		$server_destination = "exchg/dopns/input/" . $filename ;
		$server_destination_source = $server_destination . "/" .$filename;
		if($sftp->put($server_destination, $local_source)){
			$log->writelog(LOGPREFIX . "Transfer file ". $filename ." to exchange server (" .$server_destination. ") was success." . LOGPOSTFIX);
		}
		else{
			$log->writelog(LOGPREFIX . "Transfer file ". $filename ." to exchange server was fail." . LOGPOSTFIX);
		}
		$count++;
	}
	$log->writelog(LOGPREFIX . "Total files transfer :". $count . LOGPOSTFIX);
}
exit();
