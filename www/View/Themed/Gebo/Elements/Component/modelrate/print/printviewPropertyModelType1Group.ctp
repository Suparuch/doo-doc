<?php

ini_set('memory_limit', '2048M');
set_time_limit(2000);
error_reporting(0); 
$sumTotal[0] = 0;
$sumTotal[1] = 0;
$sumTotal[2] = 0;
$sumTotal[3] = 0;
$style = '
<style type="text/css">


/* Custom CSS code */
table {width:100%;border-spacing:0; border-collapse: collapse;}
ul {list-style-type: none; padding-left:0;}
/*body, input, textarea { font-family:TH SarabunPSK; font-size:12px; }*/
body, input, textarea { font-family: Tahoma, CordiaUPC; font-size: 12px; !important ; }
body { color:#464648; margin:2cm 1.5cm; }
h2 { color:#535255; font-size:16pt; font-weight:normal; line-height:1.2em; border-bottom:1px solid #DB4823; }
h3 { color:#ff0000; font-size:16pt; font-weight:bold; margin-bottom: 0em}
h4 { color:#9A9A9A; font-size:8pt; font-weight:normal; margin-bottom: 0em}

table th.left,
table td.left { text-align:left; }
table th.center,
table td.center { text-align:center; }
table th.right,
table td.right { text-align:right; }

tr.border_top_header th {
  border-top:0.5pt solid black;
  padding-top :6px;
}

tr.border_bottom_header th{
  border-bottom:0.5pt solid black;
  padding-bottom :1px;
  height :0px;
}

tr.row_head_body td{
  height :0px;
}

tr.row_body td{
  padding-top :5px;
  padding-bottom :5px;
}

tr.row_comment td{
	line-height:30px;
}

tr.page_footer td {
  color:#000; font-size:8pt; font-weight:normal; margin-bottom: 0em
}

.section { margin-bottom: 1em; }
.logo { text-align: right; }
.logo-images { weight:90px;height:90px; }
</style>
';

$model_type_id = $ModelRates['ModelRate']['model_type_id'];
$model_code = empty($ModelRates['ModelRate']['code'])? '' : $ModelRates['ModelRate']['code'];
//$model_name = empty($ModelRates['ModelRate']['name'])? '' : $ModelRates['ModelRate']['name'];
$model_name = empty($ModelRates['ModelRate']['short_name'])? '' : $ModelRates['ModelRate']['short_name'];
$model_date = empty($ModelRates['ModelRate']['model_date'])? '' : '('.$this->DateFormat->formatDateThai($ModelRates['ModelRate']['model_date'],array('Y'=>'Short')).')';
$model_comment = empty($ModelRates['ModelRate']['comment_user'])? '' : $ModelRates['ModelRate']['comment_user'];
$command_code = empty($ModelRates['ModelRate']['command_user'])? '' : 'ที่ '. $ModelRates['ModelRate']['command_user'];
$command_date = empty($ModelRates['ModelRate']['command_user_date'])? '' : ' ลง '.$this->DateFormat->formatDateThai($ModelRates['ModelRate']['command_user_date'],array('Y'=>'Short'));

$model_type_name = $ModelTypeShorts[$model_type_id];

$model_name = $model_type_name .' '. $model_code . ' '. $model_name .' ' . $model_date;

$space_5 = str_repeat('&nbsp;', 5);


//pr($ModelDivisions);
//------------------------------------------------------------------------------------------------------------------
$header = '
<table>
	<tr>
		<td width=40px>
			<img src="img/logo/logo_print.jpg">
		</td>
		<td width=322px>
			ใช้ตามคำสั่ง ทบ. (เฉพาะ) ลับ<br><br>
			' . str_replace('(ร่าง)','',$command_code.$command_date).'
		</td>
		<td><h3>ลับ</h3></td>
	</tr>
</table>

<table>
	<tr>
		<td height="25px" width="40%">
			<b>ตอนที่ 3 อัตรากำลังพล </b>
		</td>
		<td><center>
			<b>กองทัพบกไทย</b>
			</center>
		</td>
		<td width="40%" align="right"><b>'.$model_name . '<b></td>
	</tr>
</table>

<table>
	<thead>
		<tr class="border_top_header">
			<th rowspan="2" width=35px>วรรค</th>
			<th rowspan="2" width=35px>ลำดับ</th>
			<th rowspan="2">ตำแหน่ง</th>
			<th rowspan="2" width=47px class="left">ชั้นยศ</th>
			<th rowspan="2" width=40px>เหล่า</th>
			<th rowspan="2" width=60px class="right">ชกท.'.$space_5.'</th>
			<th colspan="4">อัตราระดับความพร้อมรบ</th>
			<th rowspan="2" width=40px>อาวุธ</th>
			<th rowspan="2" width=100px>หมายเหตุ</th>
		</tr>
		<tr class="row_head_body">
			<th width=50px class="center">เต็ม</th>
			<th width=50px class="center">ลด 1</th>
			<th width=50px class="center">ลด 2</th>
			<th width=50px class="center">โครง</th>
		</tr>
		<tr class="border_bottom_header">
			<th colspan="12">

			</th>
		<tr>
	</thead>
</table>
';
//------------------------------------------------------------------------------------------------------------------
$body = '
<table>
	<tbody>
		<tr class="row_head_body">
			<td width=35px></td>
			<td width=35px></td>
			<td></td>
			<td width=47px></td>
			<td width=40px></td>
			<td width=60px></td>
			<td width=50px></td>
			<td width=50px></td>
			<td width=50px></td>
			<td width=50px></td>
			<td width=40px></td>
			<td width=100px></td>
		</tr>
';


$count = 0;
$sumTotal= array(0,0,0,0,0);
$key_group = 1;
foreach($ModelGroups as $i => $modelGroup){

/*
	if( $modelGroup['ModelGroup']['is_group']=="Y"){
		$modelGroup = $this->requestAction('/ModelRates/getChildGroup/' .$modelGroup['ModelGroup']['model_id']);
 		$g = print_r($modelGroup,true);
		$body .= "<tr><td>$g</td></tr>";
	//	$body .= $this->requestAction('/ModelRates/getChildGroup/' .$modelGroup['ModelGroup']['model_id']);
	//	continue;
	}
	*/
	$sum = array(0,0,0,0,0);
	$quantity = $modelGroup['ModelGroup']['quantity'];
	$quantity_decrease1 = $modelGroup['ModelGroup']['quantity_decrease1'];
	$quantity_decrease2 = $modelGroup['ModelGroup']['quantity_decrease2'];
	$quantity_decrease3 = $modelGroup['ModelGroup']['quantity_decrease3'];
	$quantity_struct = $modelGroup['ModelGroup']['quantity_struct'];
	
 	$q = '';
 	if($quantity>1)
		$q = ' ' . $quantity . ' '; 
	$body .= '
	<tr>
		<td class="center">'.str_pad($key_group, 2, '0', STR_PAD_LEFT). ' </td>
		<td >&nbsp;</td>
		<td class="left" colspan="10"><b>' . $q .$modelGroup['ModelGroup']['name'].' (อจย. '.$modelGroup['ModelGroup']['code'].')'.'</b></td>
	</tr> 
	';

	foreach($ModelDivisions[$i] as $ModelDivision){
		$ModelProperty = $ModelDivision['ModelProperty'];
		$ModelDecrease = $ModelDivision[0];
		if($ModelDecrease['rate_full']>0 || $ModelDecrease['rate_decrease_1'] >0 || $ModelDecrease['rate_decrease_2'] >0 || $ModelDecrease['rate_structure']>0){
		$body .= '
		<tr class="row_body">
			<td></td>
			<td></td>
			<td></td>		
			<td class="center">'.$Ranks[$ModelProperty['rank_id']].'</td>
			<td></td>
			<td></td>
			<td class="center">'.number_format(($ModelDecrease['rate_full']*$quantity),0,".",",").'</td>
			<td class="center">'.number_format(($ModelDecrease['rate_decrease_1']*$quantity_decrease1),0,".",",").'</td>
			<td class="center">'.number_format(($ModelDecrease['rate_decrease_2']*$quantity_decrease2),0,".",",").'</td>
			<td class="center">'.number_format(($ModelDecrease['rate_structure']*$quantity_struct),0,".",",").'</td>
			<td></td>
			<td></td>
		</tr>';
	
		$sum[0] = $sum[0]+($ModelDecrease['rate_full']*$quantity);
		$sum[1] = $sum[1]+($ModelDecrease['rate_decrease_1']*$quantity_decrease1);
		$sum[2] = $sum[2]+($ModelDecrease['rate_decrease_2']*$quantity_decrease2);
		$sum[3] = $sum[3]+($ModelDecrease['rate_decrease_3']*$quantity_decrease3);
		$sum[4] = $sum[4]+($ModelDecrease['rate_structure']*$quantity_struct);
		}
	}	
	
	
	$key_group++;

	$body .= '
	<tr class="row_body">
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><b>รวม</b></td>
		<td class="center"><b>'.number_format($sum[0],0,".",",").'</b></td>
		<td class="center"><b>'.number_format($sum[1],0,".",",").'</b></td>
		<td class="center"><b>'.number_format($sum[2],0,".",",").'</b></td>
		<td class="center"><b>'.number_format($sum[4],0,".",",").'</b></td>
		<td></td>
		<td></td>
	</tr>
	';

	$sumTotal[0] += $sum[0];
	$sumTotal[1] += $sum[1];
	$sumTotal[2] += $sum[2];
	$sumTotal[3] += $sum[3];
	$sumTotal[4] += $sum[4];

}



$body .= '
<tr class="row_body">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><b>รวมทั้งสิ้น</b></td>
	<td class="center"><b>'.number_format($sumTotal[0],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumTotal[1],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumTotal[2],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumTotal[4],0,".",",").'</b></td>
	<td></td>
	<td></td>
</tr>
';


$body .= '
	</tbody>
</table>
';

$footer = '
<table>
	<tr class="page_footer">
		<td align="right">
			หน้า  {PAGENO} ของ  {nbpg} หน้า '. str_repeat('&nbsp;', 25) .'
		</td>
	</tr>
	<tr>
		<td><center><h3>ลับ</h3></center></td>
	</tr>
</table>
';

$html = $style . $body;

//echo $header.$html.$footer;
//max 58
/**/
//==============================================================
//==============================================================
//==============================================================

include("libs/mpdf/mpdf.php");

//$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',15, 15, 15, 15, 8, 8); 
$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',15, 10, 45, 25, 10, 10); 
$mpdf->debug=true;
$mpdf->ignore_invalid_utf8 = true;
$mpdf->showWatermarkText = true;
$mpdf->simpleTables = true;
$mpdf->packTableData =  true;
$mpdf->cacheTables = true;
//$mpdf->WriteHTML('<watermarktext content="สำเนา" alpha="0.1" />');

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($html);

//$mpdf->AddPage();

//$mpdf->WriteHTML($html);
//$mpdf->AddPage();
//$mpdf->WriteHTML($html);
//$mpdf->AddPage();
//$mpdf->WriteHTML($html);
//$mpdf->Output('/home/dopns/www/webroot/files/testcake.pdf');
$mpdf->Output();
exit;
/**/
//==============================================================
//==============================================================
//==============================================================


?>