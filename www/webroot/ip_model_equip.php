<?php
$id = $_GET['id'];
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);

$sql = "select * from dopns.toewpn where \"TSEQ\"='$id' ";
 $result = pg_query($dbconn, $sql);
 while ($row = pg_fetch_array($result)) { 
$id=$row['WSEQ'];
$model_group_id=$row['WGROUP'];
$model_id=$row['TSEQ'];
$model_division_id=$row['PSEQ'];
$equipment_code=$row['WID'];
$rate_full=$row['WSTR_FULL'];
$rate_decrease_1=$row['WSTR_RED1'];
$rate_decrease_2=$row['WSTR_RED2'];
$rate_structure=$row['WSTR_CAD'];
$order_sort=$row['WNo'];
$rate_div_9=$row['WSTR_DIV9'];


$sql2 = "insert into dopns.model_equipments(id,model_group_id,model_id,model_division_id,equipment_code,rate_full,rate_decrease_1,rate_decrease_2,rate_structure,order_sort,rate_div_9)
values('$id','$model_group_id','$model_id',$model_division_id,'$equipment_code','$rate_full','$rate_decrease_1',$rate_decrease_2,'$rate_structure','$order_sort','$rate_div_9')";
echo $sql2;
pg_query($dbconn, $sql2);
 }  
?>