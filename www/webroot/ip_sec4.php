<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.\"model_equipments\" where \"equipment_name\" IS NULL and equipment_code  IS NOT NULL";
//echo $sql3;
$result =pg_query($dbconn, $sql);
while ($row = pg_fetch_array($result)) { 
	$code=$row['equipment_code'];
	echo "$code" . "<br />";
	/*
	$sql3 = "select * from dopns.ranks where id='" . $id . "'";
	$r = pg_query($sql3);
	if(pg_num_rows($r)<=0){
		$name = $row['LCI_LOV_VALUES'];
		$sql2 = "insert into dopns.ranks(id,deleted,name) values('$id','N','$name')";
		echo $sql2;
		pg_query($sql2);
	}
	*/
//	pg_query($dbconn, $sql2);
 }  
?>