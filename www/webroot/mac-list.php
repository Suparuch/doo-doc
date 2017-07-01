<?php
$filename = "mac-list.txt";
$handle = fopen($filename, "rb");
$contents = fread($handle, filesize($filename));
$contents = strtoupper($contents);
fclose($handle);
$mac = explode(",",$contents);

?>