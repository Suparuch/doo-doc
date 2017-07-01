<?php
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.MCC_BLUE_PRINT";
 $result = pg_query($dbconn, $sql);

 while ($row = pg_fetch_array($result)) {
$id=$row['MCC_BLP_PKID'];
$ref_id=$row['MCC_BLP_REFNO'];
$code=$row['MCC_BLP_NO'];
$model_date=$row['MCC_BLP_ESTABLISH_DATE'];
$short_name=$row['MCC_BLP_ABBR_NAME'];
$name=$row['MCC_BLP_NAME'];
$command_user=$row['MCC_BLP_BY_ORDER_NO'];
$command_user_date=$row['MCC_BLP_BY_ORDER_DATE'];
$comment_user=$row['MCC_BLP_REMARK_PERIOD3'];
$comment_equipment=$row['MCC_BLP_REMARK_PERIOD3'];
$create_by=$row['MCC_BLP_CREATED_BY'];
$create_date=$row['MCC_BLP_CREATED_DATE'];
$update_by=$row['MCC_BLP_LAST_UPD_BY'];
$updated=$row['MCC_BLP_LAST_UPD_DATE'];
$deleted = "N";
$is_draft = "";
$is_approved="";
$is_locked = "";
$approved_user = "";
$approved_equipment = "";
$model_type_id="1";
$model_class_id= "";
$is_group = "N";
$is_approved= "N";
$is_approved_equipment = "N";
$sql2 = "insert into models(id,ref_id,code,model_date,short_name,name,command_user,command_user_date,comment_user,comment_equipment,create_by,create_date,update_by,updated,deleted,is_draft,is_approved,is_locked,approved_user,approved_equipment,model_type_id,is_group,is_approved_user,is_approved_equipment)
values('$id','$ref_id','$model_date','$short_name','$name','$command_user','$command_user_date','$comment_user','$comment_equipment','$create_by','$create_date','$update_by','$updated','$deleted','$is_draft','$is_approved','$is_locked','$approved_user','$approved_equipment','$model_type_id','$is_group','$is_approved_user','$is_approved_equipment')";

echo $sql; 
die();
//pg_query($dbconn, $sql2);
 }  
?>