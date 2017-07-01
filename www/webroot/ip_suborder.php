<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.MCC_SP5_SUBORDER_SEC3";
$result = pg_query($dbconn, $sql);

while ($row = pg_fetch_array($result)) {
//print_r($row);
	$id[] = $row["MCC_SP5_SU3_PKID"];
}
$in = implode(",",$id);
$sql3 = "delete from dopns.model_properties where id in($in)";
//pg_query($dbconn, $sql3);
$sql = "select * from dopns.MCC_SP5_SUBORDER_SEC3";
//echo $sql3;
$result = pg_query($dbconn, $sql);
while ($row = pg_fetch_array($result)) { 
	$id=$row['MCC_SP5_SU3_PKID'];
	$create_date = ($row['MCC_SP5_SU3_CREATED_DATE']!=""?"'" . $row['MCC_SP5_SU3_CREATED_DATE'] . "'":"NULL");
	$create_by = ($row['MCC_SP5_SU3_CREATED_BY']==""?"0":$row['MCC_SP5_SU3_CREATED_BY']);
	$updated = ($row['MCC_SP5_SU3_LAST_UPD_DATE']!=""?"'" . $row['MCC_SP5_SU3_LAST_UPD_DATE'] . "'":"NULL");
	$update_by = ($row['MCC_SP5_SU3_LAST_UPD_BY']==""?"0":$row['MCC_SP5_SU3_LAST_UPD_BY']);
	$deleted = 'N';
	$model_position_id = $row['MCC_SP4_OR3_PKID'];
	$rate_full = ($row['MCC_SP5_SU3_FULL_CAPACITY']==""?"NULL":$row['MCC_SP5_SU3_FULL_CAPACITY']);
	$rate_decrease_1 = ($row['MCC_SP5_SU3_REDUCE1_CAPACITY']==""?"NULL":$row['MCC_SP5_SU3_REDUCE1_CAPACITY']);
	$rate_decrease_2 = ($row['MCC_SP5_SU3_REDUCE2_CAPACITY']==""?"NULL":$row['MCC_SP5_SU3_REDUCE2_CAPACITY']);
	$rate_decrease_3 = ($row['MCC_SP5_SU3_REDUCE3_CAPACITY']==""?"NULL":$row['MCC_SP5_SU3_REDUCE3_CAPACITY']);
	$rate_structure = ($row['MCC_SP5_SU3_DRAFT_CAPACITY']==""?"NULL":$row['MCC_SP5_SU3_DRAFT_CAPACITY']);
	$comment = $row['MCC_SP5_SU3_REMARK'];
	$weapon_id = ($row['MCC_PRI_WEP_PKID']==""?"NULL":$row['MCC_PRI_WEP_PKID']);
	$weapon_name = '';
	$rank_id = $row['LCI_LOV_PKID_RANK'];
	$corp_id = $row['MPA_CRP_ID'];
	$mos = ($row['MCC_SP5_SU3_CERTIFICATION']==''?"NULL":"'" . $row['MCC_SP5_SU3_CERTIFICATION'] . "'");
	//$model_subdivision_id = $row['MCC_SP3_SUBIND_PKID'];
	$position_id = $row['LCI_LOV_PKID_POSITION_NAME'];
	$mission_descriptions=$row['MCC_SP5_SU3_REMARK'];
	$order_sort=($row['MCC_SP5_SU3_NO']?$row['MCC_SP5_SU3_NO']:"0");
	$quantity=0;
	$ref_id=$row['MCC_SP5_SU3_REFNO'];
	$sql2 = "insert into dopns.model_properties(id,created,created_by,updated,updated_by,deleted,order_sort,name,model_position_id,rate_full,rate_decrease_1,rate_decrease_2,rate_decrease_3,rate_structure,comment,weapon_id,weapon_name,rank_id,corp_id,mos,model_subdivision_id,ref_id)
values('$id',$create_date,'$create_by',$updated,'$update_by','$deleted','$order_sort','','$model_position_id',$rate_full,$rate_decrease_1,$rate_decrease_2,$rate_decrease_3,$rate_structure,'$comment',$weapon_id,'$weapon_name','$rank_id','$corp_id',$mos,NULL,'$ref_id')	";
	$sql2 = str_replace("migrated","0",$sql2);
	$sql2 = str_replace("migrate","0",$sql2);
	echo $sql2;
//	pg_query($dbconn, $sql2);
 }  
?>