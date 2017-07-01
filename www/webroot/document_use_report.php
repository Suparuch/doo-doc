<?php
$start_date = date("Y-m-d");
$end_date = date("Y-m-d");

if($_REQUEST['start_date'] !='')
{
	$start_date = $_REQUEST['start_date'];
	$end_date = $_REQUEST['end_date'];
	$sql = "select u.name,count(document.*) from dopns.document
left join dopns.units u on u.\"id\" = document.corp_id

where document.created >= '$start_date' and document.created <='$end_date' and  u.\"name\"<>''

GROUP BY u.\"name\"";
	$conn_string ="host=180.180.243.84 port=5432 dbname=mis-dopns user=mis-dopns password=M!s-D0pn$";
	

	$dbconn = pg_connect($conn_string);
	$result =pg_query($dbconn, $sql);
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>

<form action='#' method='post'>
ค้นหาจากวันที่ <input type='text' name='start_date' value="<?php echo $start_date;?>" /> ถึงวันที่ <input type='text' name='end_date' value="<?php echo $end_date;?>" />
<br />
* วันที่ใช้รูปแบบ yyyy-mm-dd 
<br />
เช่น <?php echo date("Y-m-d");?><br />
<input type='submit' value='ค้นหา' />
</form>

<?php
if($_REQUEST['start_date'] !='')
{
	$no = 0;
	$sum = 0;
	?>
    <table bgcolor="gray">
    <tr style="color:white;"><td>ลำดับที่</td><td>แผนก</td><td>จำนวน</td>
    </tr>
    <?php
while ($row = pg_fetch_array($result)) { 
$no++;
$sum = $sum+= ceil($row[1]);
?>
<tr style=" background-color:white;"><td><?php echo $no;?></td><td><?php echo $row[0];?></td><td style="text-align:right"><?php echo number_format($row[1],0,".",",");?></td>
    </tr>
<?php
}
?>
<tr style="background-color:white;text-decoration:underline"><td></td><td></td><td style="text-align:right"><?php echo number_format($sum,0,".",",");?></td></tr>
<?php
}
?>

</body>
</html>