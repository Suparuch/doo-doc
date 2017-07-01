<?php
header('Content-type: text/html; charset=utf-8');
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php

$conn_string = "host=180.180.243.84 port=5432 dbname=mis-dopns user=mis-dopns password=M!s-D0pn$";
	$dbconn = pg_connect($conn_string);
	$sql = "select * from dopns.\"units\" where deleted='N'";
	$result =pg_query($dbconn, $sql);
	$unit = array();
while ($row = pg_fetch_array($result)) { 
$unit[$row['id']]= $row["name"];
}

echo $dir = __DIR__ . "/files/edocument" ;
$dirs = array_filter(glob($dir . '/*'), 'is_dir');
print_r( $dirs);
echo "<br />";
foreach($dirs as $d){
	/*
$fi = new FilesystemIterator($d, FilesystemIterator::SKIP_DOTS);
*/
$ff = explode("/",$d);

$c = getFileCount($d);
$all[] = $unit[$ff[count($ff)-1]];
printf("%s มี %d Files<br />",$unit[$ff[count($ff)-1]], $c);
}

$a = implode(",",$all);
echo $a;




function getFileCount($path) {
    $size = 0;
    $ignore = array('.','..','cgi-bin','.DS_Store');
    $files = scandir($path);
    foreach($files as $t) {
        if(in_array($t, $ignore)) continue;
        if (is_dir(rtrim($path, '/') . '/' . $t)) {
            $size += getFileCount(rtrim($path, '/') . '/' . $t);
        } else {
            $size++;
        }   
    }
    return $size;
}
?>