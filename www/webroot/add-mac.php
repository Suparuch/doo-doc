<?php
$filename = "mac-list.txt";
$handle = fopen($filename, "rb");
$contents = fread($handle, filesize($filename));
fclose($handle);
$mac = explode(",",$contents);
$mac[] = $_GET['mac'];
$mlist = implode(",",$mac);

$fp = fopen('mac-list.txt', 'w');
fwrite($fp, $mlist);
fclose($fp);
?>
Add Mac <?php echo $_GET['mac'];?> Finish
