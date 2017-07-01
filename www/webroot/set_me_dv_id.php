<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.model_equipments where (model_id is null) and model_division_id is not null";
//echo $sql3;
$result =pg_query($dbconn, $sql);
while ($row = pg_fetch_array($result)) { 
	$id=$row['id'];
	$id2 = $row['model_division_id'];
	$sql3 = "select * from dopns.model_divisions where id='" . $id2 . "'";
	$r = pg_query($sql3);
	if(pg_num_rows($r)>=0){
		$row2 = pg_fetch_array($r);
		$model_id = $row2['model_id'];
		$sql2 = "update dopns.model_equipments set model_id='$model_id' where id='$id'";
		echo $sql2;
		pg_query($sql2);
	}else{
		echo $id2;
	}
//	pg_query($dbconn, $sql2);
 }  
?>