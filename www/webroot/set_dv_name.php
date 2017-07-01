<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.model_positions where (name='' or name is null) and position_id is not null";
//echo $sql3;
$result =pg_query($dbconn, $sql);
while ($row = pg_fetch_array($result)) { 
	$id=$row['id'];
	$id2 = $row['position_id'];
	$sql3 = "select * from dopns.positions where id='" . $id2 . "'";
	$r = pg_query($sql3);
	if(pg_num_rows($r)>=0){
		$row2 = pg_fetch_array($r);
		$name = $row2['name'];
		$sql2 = "update dopns.model_positions set name='$name' where id='$id'";
		echo $sql2;
		pg_query($sql2);
	}else{
		echo $id2;
	}
//	pg_query($dbconn, $sql2);
 }  
?>