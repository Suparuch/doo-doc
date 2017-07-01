<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.mcc_order_sec3";
//echo $sql3;
$result =pg_query($dbconn, $sql);
while ($row = pg_fetch_array($result)) { 
	$id=$row['MCC_OR3_PKID'];
	$id2 = $row['MCC_IND_PKID'];

	$sql2 = "update dopns.model_positions set model_division_id='$id2' where id='$id'";
	echo $sql2;
	pg_query($sql2);
//	pg_query($dbconn, $sql2);
 }  
?>