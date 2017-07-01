<?php
$today = date("Y-m-d");
$sql = "select request_data from \"dopns\".\"trackers\" where created between '$today 00:00:01' and '$today 23:59:59' and action='authenticate' and request_data <> '' group by request_data";
$conn_string = "host=180.180.244.163 port=5432 dbname=doo-toe-bk user=mis-dopns password=M!s-D0pn$";
$dbconn = pg_connect($conn_string);
//echo $sql3;
$result =pg_query($dbconn, $sql);
$i = 1;

while ($row = pg_fetch_array($result)) { 
	echo "No. $i, Data = $row[0]";
	echo "<br />\n";
	$i++;
//	pg_query($dbconn, $sql2);
} 

?>