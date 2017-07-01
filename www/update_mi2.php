<?php

/*
 * PHP Excel - Read a simple 2007 XLSX Excel file
 */

/** Set default timezone (will throw a notice otherwise) */
date_default_timezone_set('America/Los_Angeles');
ini_set('max_execution_time', 3000);
include 'PHPExcel/Classes/PHPExcel/IOFactory.php';

	$conn_string = "host=180.180.243.84 port=5432 dbname=mis-dopns user=mis-dopns password=M!s-D0pn$";
	$dbconn = pg_connect($conn_string);
	$sql = "select * from dopns.\"ranks\" where deleted='N'";
	$result =pg_query($dbconn, $sql);
	$rank = array();
while ($row = pg_fetch_array($result)) { 
$rank[trim($row["short_name"])]= $row["id"];
}

$sql = "select * from dopns.\"corps\" where deleted='N'";
	$result =pg_query($dbconn, $sql);
	$corp = array();
while ($row = pg_fetch_array($result)) { 
$corp[trim($row["short_name"])]= $row["id"];
}

//  Read your Excel workbook
function insert($inputFileName,$model_id){
	
	$conn_string = "host=dopns.pakgon.com port=5432 dbname=rta_mis user=rta password=password";
	$dbconn = pg_connect($conn_string);
	global $rank;
	global $corp;

	try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	} catch (Exception $e) {
		die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
		. '": ' . $e->getMessage());
	}

	//  Get worksheet dimensions
	$sheet = $objPHPExcel->getSheet(1);
	$highestRow = $sheet->getHighestRow();
	$highestColumn = $sheet->getHighestColumn();
	/*
	Row: 1- Col: 1 = หมายเลข 
	Row: 1- Col: 2 = ชื่อย่อ
	Row: 1- Col: 3 = ชื่อเต็ม
	Row: 1- Col: 4 = วันที่
	Row: 1- Col: 5 = คำสั่งอัตรากำลังพล
	Row: 1- Col: 6 = ลงวันที่
	Row: 1- Col: 7 = หมายเหตุท้ายอัตรา

	Array ( [0] => หมายเลข , [1] => ชื่อย่อ,  [2] => ชื่อเต็ม,  [3] => วันที่  ,[4] => คำสั่งอัตรากำลังพล , [5] => ลงวันที่ , [6] => หมายเหตุท้ายอัตรา )
	/*/
	//  Loop through each row of the worksheet in turn
//	$model_id = "80000001";
	for ($row = 2; $row <= $highestRow; $row++) {
		//  Read a row of data into an array
		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
		NULL, TRUE, FALSE);
		$rowx = $rowData[0];
		$comment_user = $rowx[6] ;
		$model_date= $rowx[3] ;
		$code= $rowx[0] ;
		$model_name= $rowx[2] ;
		$command_user= $rowx[4] ;
		$command_user_date = $rowx[5];
		$short_name= $rowx[1] ;
		$full_name= $rowx[2] ;
	//	print_r($rowx);

		$sql = "insert into dopns.\"models_copy\"(id,is_draft,is_approved,is_locked,comment_user,command_user_date,approved_user,model_date,code,name,command_user,short_name,full_name,model_type_id,is_group,is_approved_user) values($model_id,'N','N','N','$comment_user',(DATE '$command_user_date'),'1',(DATE '$model_date'),'$code','$model_name','$command_user','$short_name','$full_name','2','N','N')";
		pg_query($sql) or die($sql);
		/*foreach($rowData[0] as $k=>$v)
			echo "Row: ".$row."- Col: ".($k+1)." = ".$v."<br />";
			*/
	}

	$sheet = $objPHPExcel->getSheet(0);
	$highestRow = $sheet->getHighestRow();
	$highestColumn = $sheet->getHighestColumn();
	$property_id = 0;
	for ($row = 2; $row <= $highestRow; $row++) {
		//  Read a row of data into an array
		/*
		Array ( [0] => วรรค [1] => วรรคย่อย [2] => ลำดับ [3] => ตำแหน่ง [4] => ชั้นยศ [5] => เหล่า [6] => ชกท [7] => เต็ม [8] => หมายเหตุ )
		Array ( [0] => 01 [1] => [2] => [3] => สำนักงานผู้บังคับบัญชา [4] => [5] => [6] => [7] => [8] => )
		*/
		
		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
		NULL, TRUE, FALSE);
		$rowx = $rowData[0];
	///	print_r($rowx);
	//	echo "<br />";
		$order_sort = $rowx[0];
		$name = $rowx[3];
		$comment = $rowx[8];
		if($rowx[0]!="")
		{
			$model_division_id = $model_id . sprintf("%02d", $rowx[0]);
			$sql_division = "insert into dopns.\"model_divisions_copy\"(id,order_sort,name,comment,model_id,model_division_type) values($model_division_id,'$order_sort','$name','$comment','$model_id','property')";
			pg_query($sql_division) or die($sql_division);
		//	echo "Division <br /> $sql_division ";
		}
		if($rowx[0]=="" && $rowx[1] != ""){
			$model_subdivision_id = $model_division_id . sprintf("%02d", $rowx[1]);
			$order_sort=$rowx[1];
			$sql_sub_division = "insert into dopns.\"model_subdivisions_copy\"(id,order_sort,name,comment,model_id,model_division_id) values($model_subdivision_id,'$order_sort','$name','$comment','$model_id','$model_division_id')";
			pg_query($sql_sub_division) or die($sql_sub_division);
		//	echo "sub <br /> $sql_sub_division ";
		}
		if($rowx[0]=="" && $rowx[1] == "" && $rowx[2]!="" ){
			$model_position_id = $model_subdivision_id .sprintf("%02d", $rowx[2]); 
			$order_sort=$rowx[2];
			$sql_positions = "insert into dopns.\"model_positions_copy\"(id,order_sort,name,comment,model_id,model_division_id,model_subdivision_id) values($model_position_id,'$order_sort','$name','$comment','$model_id','$model_division_id','$model_subdivision_id')";
			pg_query($sql_positions) or die($sql_positions);
		//	echo "position <br /> $sql_positions ";
			$property_id = 0;
		}
		if($rowx[0]=="" && $rowx[1] == ""  && $rowx[4]!="" ){
			$property_id++;
			$model_property_id = $model_position_id .sprintf("%02d", $property_id);
			$order_sort=$property_id;
			$full = $rowx[7];
			if($full=="")
				$full = 0;
			
			
			if(!isset($corp[trim($rowx[5])]))
				echo $rowx[5];
			if(!isset($rank[trim($rowx[4])]))
				echo $rowx[4];
			
			$rank_id = $rank[trim($rowx[4])];
			if($rank_id=="")
				$rank_id = 0;
			$corp_id = $corp[trim($rowx[5])];
			if($corp_id=="")
				$corp_id = 0;

			$mos = $rowx[6];
			$sql_property = "insert into dopns.\"model_properties_copy\"(id,order_sort,name,comment,model_id,model_division_id,model_position_id,rate_full,rank_id,corp_id,mos,model_subdivision_id) values($model_property_id,'$order_sort','$name','$comment','$model_id','$model_division_id','$model_position_id','$full','$rank_id','$corp_id','$mos','$model_subdivision_id')";
			pg_query($sql_property) or die($sql_property);
		//	echo "property <br /> $sql_property ";
		}
		
	}
	
	echo " $model_id done!! <hr />";
}
/*
insert('1200-1.xlsx',"80000001");
insert('1200-2.xlsx',"80000002");
insert('1300.xlsx',"80000003");
insert('1400-1.xlsx',"80000004");
insert('1400-2.xlsx',"80000005");
insert('1700-1.xlsx',"80000006");
insert('1700-2.xlsx',"80000007");
insert('2700.xlsx',"80000008");
insert('3110.xlsx',"80000009");
insert('3620.xlsx',"80000010");
insert('4100.xlsx',"80000011");
insert('4150.xlsx',"80000012");
insert('4800.xlsx',"80000014");
insert('6120.xlsx',"80000015");
insert('6130.xlsx',"80000016");
insert('6140.xlsx',"80000017");
insert('7215.xlsx',"80000018");
insert('1100.xlsx',"80000019");
insert('4400_1.xlsx',"80000020");
insert('4400_2.xlsx',"80000021");
insert('4400_3.xlsx',"80000022");
insert('4400_4.xlsx',"80000023");
insert('4400_5.xlsx',"80000024");
*/
insert('2100.xlsx',"82000001");
echo "All Done";
?>















