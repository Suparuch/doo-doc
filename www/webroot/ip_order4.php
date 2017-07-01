<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.MCC_ORDER_SEC4";
$result = pg_query($dbconn, $sql);

while ($row = pg_fetch_array($result)) {
//print_r($row);
	$id[] = $row["MCC_OR4_PKID"];
}
$in = implode(",",$id);
$sql3 = "delete from dopns.model_equipments where id in($in)";
pg_query($dbconn, $sql3);
$sql = "select * from dopns.MCC_ORDER_SEC4";
$result = pg_query($dbconn, $sql);
while ($row = pg_fetch_array($result)) { 
	$id=$row['MCC_OR4_PKID'];
	$create_date = ($row['MCC_OR4_CREATED_DATE']!=""?"'" . $row['MCC_OR4_CREATED_DATE'] . "'":"NULL");
	$create_by = ($row['MCC_OR4_CREATED_BY']==""?"0":$row['MCC_OR4_CREATED_BY']);
	$updated = ($row['MCC_OR4_LAST_UPD_DATE']!=""?"'" . $row['MCC_OR4_LAST_UPD_DATE'] . "'":"NULL");
	$update_by = ($row['MCC_OR4_LAST_UPD_BY']==""?"0":$row['MCC_OR4_LAST_UPD_BY']);
	$deleted = 'N';
	
	$model_division_id = $row['MCC_IND_PKID'];
	$equipment_id = $row['MCC_NEW_EQP_PKID'];
	$rate_full = ($row['MCC_OR4_FULL_CAPACITY']==""?"NULL":$row['MCC_OR4_FULL_CAPACITY']);
	$rate_decrease_1 = ($row['MCC_OR4_REDUCE1_CAPACITY']==""?"NULL":$row['MCC_OR4_REDUCE1_CAPACITY']);
	$rate_decrease_2 = ($row['MCC_OR4_REDUCE2_CAPACITY']==""?"NULL":$row['MCC_OR4_REDUCE2_CAPACITY']);
	$rate_decrease_3 = ($row['MCC_OR4_REDUCE3_CAPACITY']==""?"NULL":$row['MCC_OR4_REDUCE3_CAPACITY']);
	$rate_structure = ($row['MCC_OR4_DRAFT_CAPACITY']==""?"NULL":$row['MCC_OR4_DRAFT_CAPACITY']);
	$order_sort=($row['MCC_OR4_NO']?$row['MCC_OR4_NO']:"0");
	$quantity=0;
	$ref_id=$row['MCC_OR4_REFNO'];
	$sql2 = "insert into dopns.model_equipments(id,created,created_by,updated,updated_by,deleted,model_division_id,equipment_id,rate_full,rate_decrease_1,rate_decrease_2,rate_decrease_3,rate_structure,comment,order_sort)
values ('$id',$create_date,'$create_by',$updated,'$update_by','$deleted','$model_division_id','$equipment_id',$rate_full,$rate_decrease_1,$rate_decrease_2,$rate_decrease_3,$rate_structure,'','$order_sort') ";
	$sql2 = str_replace("migrated","0",$sql2);
	echo $sql2;
	pg_query($dbconn, $sql2);
 }  
?>