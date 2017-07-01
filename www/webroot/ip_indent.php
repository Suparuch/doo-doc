<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.mcc_sp3_subindent";
$result = pg_query($dbconn, $sql);

while ($row = pg_fetch_array($result)) {
//print_r($row);
	$id[] = $row["MCC_SP3_SUBIND_PKID"];
}
$in = implode(",",$id);
$sql3 = "delete from dopns.model_divisions where id in($in)";
pg_query($dbconn, $sql3);
$sql = "select * from dopns.mcc_sp3_subindent";
$result = pg_query($dbconn, $sql);
while ($row = pg_fetch_array($result)) { 
	$id=$row['MCC_SP3_SUBIND_PKID'];
	$create_date = ($row['MCC_SP3_SUBIND_CREATED_DATE']!=""?"'" . $row['MCC_SP3_SUBIND_CREATED_DATE'] . "'":"NULL");
	$create_by = ($row['MCC_SP3_SUBIND_CREATED_BY']==""?"0":$row['MCC_SP3_SUBIND_CREATED_BY']);
	$updated = ($row['MCC_SP3_SUBIND_LAST_UPD_DATE']!=""?"'" . $row['MCC_SP3_SUBIND_LAST_UPD_DATE'] . "'":"NULL");
	$update_by = ($row['MCC_SP3_SUBIND_LAST_UPD_BY']==""?"0":$row['MCC_SP3_SUBIND_LAST_UPD_BY']);
	$deleted = 'N';
	$model_division_id=$row['MCC_SP2_IND_PKID'];
	$subdivision_id = $row['LCI_LOV_PKID_SECTION_NAME'];
	$mission_descriptions=$row['MCC_SP3_SUBIND_REMARK'];
	$model_division_type='equipment';
	$order_sort=($row['MCC_SP3_SUBIND_NO']?$row['MCC_SP3_SUBIND_NO']:"0");
	$quantity=0;
	$ref_id=$row['MCC_SP3_SUBIND_REFNO'];
	$sql2 = "insert into dopns.model_subdivisions(id,created,created_by,updated,updated_by,deleted,order_sort,comment,model_division_id,subdivision_id)
values ('$id',$create_date,'$create_by',$updated,'$update_by','$deleted','$order_sort','','$model_division_id','$subdivision_id') ";
	$sql2 = str_replace("migrate","0",$sql2);
	echo $sql2;
	//pg_query($dbconn, $sql2);
 }  
?>