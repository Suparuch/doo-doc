<?php
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"export.xls\""); 
$conn_string = "host=localhost port=5432 dbname=rta_mis user=rta password=password";
$dbconn = pg_connect($conn_string);
$sql = "select * from dopns.model_properties";
 $result = pg_query($dbconn, $sql);
$i = pg_num_fields($result);
$f = array();
echo "<table><tr>";
for ($j = 0; $j < $i; $j++) {
      $fieldname = pg_field_name($result, $j);
      $f[] = "<td>$fieldname</td>";

  }
  $h = implode(" ",$f);
  
  echo $h;
  echo "</tr>";
 while ($row = pg_fetch_array($result)) {
	$r = null;
	$r = array();
	echo "<tr>";
    for($j=0;$j<$i;$j++){
		$r[] = "<td style='mso-number-format:\"\\@\"' >" . $row[$j] . '</td>' ;
	}
	$rr = implode(" ",$r);
	echo $rr . "</tr>";
 }  
?>