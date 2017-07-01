<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.MCC_SP1_BLUE_PRINT";
$result = pg_query($dbconn, $sql);

while ($row = pg_fetch_array($result)) {
//print_r($row);
	$id[] = $row["MCC_SP1_PKID"];
}
$in = implode(",",$id);
$sql3 = "delete from dopns.models where id in($in)";
//pg_query($dbconn, $sql3);
$sql = "select * from dopns.MCC_SP1_BLUE_PRINT where \"MCC_SP1_PKID\"='2747' ";
 $result = pg_query($dbconn, $sql);
 while ($row = pg_fetch_array($result)) { 
$id=$row['MCC_SP1_PKID'];
$ref_id=$row['MCC_SP1_REFNO'];
$code=$row['MCC_SP1_NO'];
$model_date=($row['MCC_SP1_ESTABLISH_DATE']!=""?"'" . $row['MCC_SP1_ESTABLISH_DATE'] . "'":"NULL");
$short_name=$row['MCC_SP1_ABBR_NAME'];
$name=$row['MCC_SP1_NAME'];
$command_user=($row['MCC_SP1_BY_ORDER_NO']==""?"0":$row['MCC_SP1_BY_ORDER_NO']);
$command_user_date=($row['MCC_SP1_BY_ORDER_DATE']!=""?"'" . $row['MCC_SP1_BY_ORDER_DATE'] . "'":"NULL");
$comment_user=$row['MCC_SP1_REMARK_PERIOD3'];
$comment_equipment=$row['MCC_SP1_REMARK_PERIOD3'];
$create_by=($row['MCC_SP1_CREATED_BY']==""?"0":$row['MCC_SP1_CREATED_BY']);
$create_date=($row['MCC_SP1_CREATED_DATE']!=""?"'" . $row['MCC_SP1_CREATED_DATE'] . "'":"NULL");
$update_by=($row['MCC_SP1_LAST_UPD_BY']==""?"0":$row['MCC_SP1_LAST_UPD_BY']);
$updated=($row['MCC_SP1_LAST_UPD_DATE']!=""?"'" . $row['MCC_SP1_LAST_UPD_DATE'] . "'":"NULL");
$deleted = "N";
$is_draft = "N";
$is_approved="N";
$is_locked = "N";
$approved_user = "N";
$approved_equipment = "";
$model_type_id="2";
$model_class_id= "";
$is_group = "N";
$is_approved= "N";
$is_approved_user= "N";
$is_approved_equipment = "N";
$sql2 = "insert into dopns.models(id,ref_id,code,model_date,short_name,name,command_user,command_user_date,comment_user,comment_equipment,created_by,created,updated_by,updated,deleted,is_draft,is_approved,is_locked,approved_user,approved_equipment,model_type_id,is_group,is_approved_user,is_approved_equipment)
values('$id','$ref_id','$code',$model_date,'$short_name','$name','$command_user',$command_user_date,'$comment_user','$comment_equipment','$create_by',$create_date,'$update_by',$updated,'$deleted','$is_draft','$is_approved','$is_locked','$approved_user','$approved_equipment','$model_type_id','$is_group','$is_approved_user','$is_approved_equipment')";
$sql2 = str_replace("migrated","0",$sql2);
echo $sql2;
pg_query($dbconn, $sql2);
 }  
?>