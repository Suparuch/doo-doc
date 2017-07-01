<?php

ini_set('memory_limit', '2048M');
error_reporting(0);

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
  padding-top :11px;
  padding-bottom :11px;
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
$model_comment = empty($ModelRates['ModelRate']['comment_equipment'])? '' : $ModelRates['ModelRate']['comment_equipment'];
$command_code = empty($ModelRates['ModelRate']['command_equipment'])? '' : 'ที่ '. $ModelRates['ModelRate']['command_equipment'];
$command_date = empty($ModelRates['ModelRate']['command_equipment_date'])? '' : ' ลง '.$this->DateFormat->formatDateThai($ModelRates['ModelRate']['command_equipment_date'],array('Y'=>'Short'));

$model_type_name = $ModelTypeShorts[$model_type_id];

$model_name = $model_type_name .' '. $model_code . ' '. $model_name .' ' . $model_date;

$space_5 = str_repeat('&nbsp;', 5);
//pr($ModelRates);die;
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
			'.$command_code.$command_date.'
		</td>
		<td><h3>ลับ</h3></td>
	</tr>
</table>

<table>
	<tr>
		<td height="25px" width="30%">
			<b>ตอนที่ 5 อัตรายุทโธปกรณ์ </b>
		</td>
		<td><center>
			<b>กองทัพบกไทย</b>
			</center>
		</td>
		<td width="30%" align="right">'.$model_name . '</td>
	</tr>
</table>

<table>
	<thead>
		<tr class="border_top_header">
			<th width=35px>วรรค</th>
			<th width=35px>ลำดับ</th>
			<th width=70px>รหัส</th>
			<th>รายการยุทโธปกรณ์</th>					
			<th width=160px>จำนวน</th>
			<th width=40px></th>
			<th width=100px>หมายเหตุ</th>
		</tr>
		<tr class="border_bottom_header">
			<th colspan="7">

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
			<td width=70px></td>
			<td></td>
			<td width=60px></td>
			<td width=160px></td>
			<td width=40px></td>
			<td width=100px></td>
		</tr>
		<tr class="row_body">
			<td></td>
			<td></td>
			<td class="left" colspan="6"><b>รายการจ่ายแจกยุทโธปกรณ์</b></td>
		</tr>
';

$sumTotal= array(0,0,0,0,0);
$sumTechEquipment= array(0,0,0,0,0);
$sumTechEquipmentTotal= array(0,0,0,0,0);

$Equipments = array(0,0,0,0,0);

$key_division=1;
foreach($ModelDivisions as $ModelDivision){

		$division = $ModelDivision['ModelDivisionSpecialEquipment'];	
		$equipments = $ModelDivision['ModelEquipment'];

		$body .= '
		<tr class="row_body">
			<td class="center"><b>'.str_pad($key_division, 2, '0', STR_PAD_LEFT).'</b></td>
			<td></td>
			<td class="left" colspan="6"><b>'.$division['name'].'</b></td>
		</tr> 
		';

		$sum = array(0,0,0,0,0);
		$key_equipment=1;
		foreach($equipments as $equipment){
			
			$body .= '
			<tr class="row_body">
				<td></td>
				<td class="center">'.str_pad($key_equipment, 2, '0', STR_PAD_LEFT).'</td>
				<td class="left">'.$equipment['equipment_code'].'</td>
				<td class="left">'.$equipment['equipment_name'].'</td>
				<td></td>
				<td class="center">'.$equipment['rate_full'].'</td>
				<td></td>
				<td class="center">'.$equipment['comment'].'</td>
			</tr>
			';

			$sum[0] += $equipment['rate_full'];

			$ListEquipments[$equipment['equipment_code']] = $equipment['equipment_name'];
			
			$sumTechEquipment[$equipment['id'.'tech_id']][$equipment['equipment_code']][0] += $equipment['rate_full'];

			$key_equipment++;

		}

		$body .= '
		<tr class="row_body">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><b>รวม</b></td>
			<td class="center"><b>'.number_format($sum[0],0,".",",").'</b></td>
			<td></td>
		</tr>
		';

		$sumTotal[0] += $sum[0];

		$key_division++;

}

$body .= '
<tr class="row_body">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><b>รวมทั้งสิ้น</b></td>
	<td class="center"><b>'.number_format($sumTotal[0],0,".",",").'</b></td>
	<td></td>
	<td></td>
</tr>
';

$body .= '
	</tbody>
</table>
';

if(!empty($model_comment)){
	$body .= '
	<br>
	<table>
		<tbody>
			<tr class="row_body"><td class="center" width=40px>&nbsp;</td><td colspan="12"><b><u>หมายเหตุ</u></b></td></tr>
			<tr class="row_comment">
			<td></td>
			<td colspan="12">'.nl2br($model_comment).'</td>
			</tr>
		</tbody>
	</table>
	';
}

$body .= '<p style="page-break-after: always">&nbsp;</p>';

$body .= '<table><tr class="row_body"><td width=35px></td><td width=35px></td><td><b>ยอดสรุปยุทโธปกรณ์</b></td></tr></table>';

$sum_equipment_total = array(0,0,0,0,0);
$body .= '
<table>
	<tbody>
		<tr class="row_head_body">
			<td width=35px></td>
			<td width=35px></td>
			<td width=70px></td>
			<td width=345px></td>
			<td width=60px></td>
			<td width=70px></td>
			<td width=40px></td>
			<td width=100px></td>
		</tr>
';

$seq_tech = 1;
//foreach($sumTechEquipment as $key_tech=> $sumEquipment){
foreach($Techs as $key_tech => $Tech){

	$sumEquipment = $sumTechEquipment['id'.$key_tech];
	$body .= '
	<tr class="row_body">
		<td class="center">'.str_pad($seq_tech, 2, '0', STR_PAD_LEFT).'</td>
		<td></td>
		<td colspan="9"><b>'.$Techs[$key_tech].'</b></td>
	</tr>
	';
	
	$sum_equipment = array(0,0,0,0,0);
	ksort($sumEquipment);
	$seq_equipment = 1;
	foreach($sumEquipment as $key_equipment=> $equipment){
		
		$body .= '
		<tr class="row_body">
			<td></td>
			<td class="center">'.str_pad($seq_equipment, 2, '0', STR_PAD_LEFT).'</td>
			<td>'.$key_equipment.'</td>
			<td colspan="2">'.$ListEquipments[$key_equipment].'</td>
			<td class="center">'.$equipment[0].'</td>
			<td></td>
			<td></td>
		</tr>
		';
		
		$sum_equipment[0] += $equipment[0];
		
		$seq_equipment++;

	}
	
	if(!empty($sumEquipment)){
		$body .= '
		<tr class="row_body">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><b>รวม</b></td>
			<td class="center"><b>'.number_format($sum_equipment[0],0,".",",").'</b></td>
			<td></td>
			<td></td>
		</tr>
		';
	}else{
		$body .= '
		<tr class="row_body">
			<td></td>
			<td>01</td>
			<td></td>
			<td colspan=5>(ไม่กำหนดรายการยุทโธปกรณ์)</td>
		</tr>
		';	
	}

	$sum_equipment_total[0] += $sum_equipment[0];

	$seq_tech++;

}

$body .= '
		<tr class="row_body">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><b>รวมทั้งสิ้น</b></td>
			<td class="center"><b>'.number_format($sum_equipment_total[0],0,".",",").'</b></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
';

//------------------------------------------------------------------------------------------------------------------
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

$mpdf->showWatermarkText = true;
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
//$mpdf->Output('D:\xampp\htdocs\afkair.local\office\app\webroot\files\Quotations/testcake.pdf');
$mpdf->Output();
exit;
/**/
//==============================================================
//==============================================================
//==============================================================


?>