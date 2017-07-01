<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.model_equipments where (equipment_name='' or equipment_name is null) and equipment_code is not null";
//echo $sql3;
$result =pg_query($dbconn, $sql);
while ($row = pg_fetch_array($result)) { 
	$id=$row['id'];
	$code=$row['equipment_code'];
	$id2 = $row['equipment_id'];
	$sql3 = "select * from dopns.equipments where code='" . $code . "'";
	$r = pg_query($sql3);
	if(pg_num_rows($r)>=0){
		$row2 = pg_fetch_array($r);
		$name = $row2['name'];
		$code = $row2['code'];
		$tech_id = $row2['tech_id'];
		$equip_id = $row2['id'];
		$sql2 = "update dopns.model_equipments set equipment_name='$name',equipment_id='$equip_id',tech_id='$tech_id' where id='$id'";
		echo "<br />\n";
		echo $sql2;
		pg_query($sql2);
	}else{
		echo $id2;
	}
//	pg_query($dbconn, $sql2);
 }  
?>