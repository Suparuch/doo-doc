<?php
error_reporting(E_ALL);
ini_set('display_errors', 1) ;
$file = $_SERVER['DOCUMENT_ROOT'] . '/webroot/' . $_GET['path'] . '/' . $_GET['file_name'];
//echo $file;
$file = str_replace(" ","",$file);

//echo $_SERVER['DOCUMENT_ROOT'] . '/webroot/' . $_GET['path'] . '/' . $_GET['file_name'];
//echo " ED" . file_exists($_SERVER['DOCUMENT_ROOT'] . '/webroot/' . $_GET['path'] . '/' . $_GET['file_name']);
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($file).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);
exit; // do the double-download-dance (dirty but worky)
//https://doo-mis.zicure.com/download2.php?path=files/edocument/150120103629101691/150716155127337002/&file_name=580723_0403-11391_การเตรียมการแต่งตั้งคณะจัดทำร่างแผนแม่บทไซเบอร์เพื่อการป้องกันประเทศกระทรวงกลาโหม.pdf
?>
