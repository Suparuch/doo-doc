<?php
$file_url = $_SERVER['DOCUMENT_ROOT'] . '/Upload/' . $_GET['path'] . '/' . $_GET['file_name'];
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile($file_url); // do the double-download-dance (dirty but worky)
?>