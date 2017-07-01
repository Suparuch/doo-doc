<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.MCC_ORDER_SEC3";
$result = pg_query($dbconn, $sql);

while ($row = pg_fetch_array($result)) {
//print_r($row);
	$id[] = $row["MCC_OR3_PKID"];
}
$in = implode(",",$id);
$sql3 = "delete from dopns.model_positions where id in($in)";
//pg_query($dbconn, $sql3);
$sql = "select * from dopns.MCC_ORDER_SEC3";
$result = pg_query($dbconn, $sql);
while ($row = pg_fetch_array($result)) { 
	$id=$row['MCC_OR3_PKID'];
	$create_date = ($row['MCC_OR3_CREATED_DATE']!=""?"'" . $row['MCC_OR3_CREATED_DATE'] . "'":"NULL");
	$create_by = ($row['MCC_OR3_CREATED_BY']==""?"0":$row['MCC_OR3_CREATED_BY']);
	$updated = ($row['MCC_OR3_LAST_UPD_DATE']!=""?"'" . $row['MCC_OR3_LAST_UPD_DATE'] . "'":"NULL");
	$update_by = ($row['MCC_OR3_LAST_UPD_BY']==""?"0":$row['MCC_OR3_LAST_UPD_BY']);
	$deleted = 'N';
	$model_division_id = $row['MCC_IND_PKID'];
	$position_id = $row['LCI_LOV_PKID_POSITION_NAME'];
	$mission_descriptions=$row['MCC_OR3_REMARK'];
	$order_sort=($row['MCC_OR3_NO']?$row['MCC_OR3_NO']:"0");
	$quantity=0;
	$ref_id=$row['MCC_OR3_REFNO'];
	$sql2 = "insert into dopns.model_positions(id,created,created_by,updated,updated_by,deleted,order_sort,name,model_division_id,position_id,ref_id)
values ('$id',$create_date,'$create_by',$updated,'$update_by','$deleted','$order_sort','','$model_division_id','$position_id','$ref_id') ";
	$sql2 = str_replace("migrated","0",$sql2);
	echo $sql2;
	pg_query($dbconn, $sql2);
 }  
?>