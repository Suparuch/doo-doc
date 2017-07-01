<?php

ini_set('memory_limit', '1024M');
set_time_limit(3000);
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
  border-top:1pt solid black;
}

tr.border_bottom_header th{
  border-bottom:1pt solid black;
}

tr.page_footer td {
  color:#9A9A9A; font-size:8pt; font-weight:normal; margin-bottom: 0em
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
$model_comment = empty($ModelRates['ModelRate']['comment'])? '' : $ModelRates['ModelRate']['comment'];
$command_code = empty($ModelRates['ModelRate']['command_equipment'])? '' : 'ที่ '. $ModelRates['ModelRate']['command_equipment'];
$command_date = empty($ModelRates['ModelRate']['command_equipment_date'])? '' : ' ลง '.$this->DateFormat->formatDateThai($ModelRates['ModelRate']['command_equipment_date'],array('Y'=>'Short'));

unset($ModelRates);

$model_type_name = $ModelTypeShorts[$model_type_id];

$model_name = $model_type_name .' '. $model_code . ' '. $model_name .' ' . $model_date;

$header = '
		<table>
		<tr>
			<td width=40px>
				<img src="img/logo/logo_print.jpg">
			</td>
			<td width=327px>
				ใช้ตามคำสั่ง ทบ. (เฉพาะ) ลับ<br><br>
				'.$command_code.$command_date.'
			</td>
			<td><h3>ลับ</h3></td>
		</tr>
		</table>

		<table>
		<tr>
			<td height="25px" width="30%">
				ตอนที่ 4 อัตรายุทโธปกรณ์
			</td>
			<td><center>
			<b>กองทัพบกไทย</b>
			</center>
		</td>
		<td width="30%" align="right">'.$model_name . '</td>
		</tr>
		</table>

		<table border ="0">
			<thead>
				<tr class="border_top_header">
					<th rowspan="2" width=35px>วรรค</th>
					<th rowspan="2" width=35px>ลำดับ</th>
					<th rowspan="2" width=70px>รหัส</th>
					<th rowspan="2" width=490px>รายการยุทโธปกรณ์</th>
					<th colspan="4">อัตราระดับความพร้อมรบ</th>
					<th rowspan="2" width=152px>หมายเหตุ</th>
				</tr>
				<tr>
					<th width=40px class="center">เต็ม</th>
					<th width=40px class="center">ลด 1</th>
					<th width=40px class="center">ลด 2</th>
					<th width=40px class="center">โครง</th>
				</tr>
				<tr class="border_bottom_header">
					<th colspan="10">

					</th>
				<tr>
			</thead>
			</table>
';


$body =  '
<table>
	<tbody>
		<tr class="row_head_body">
				<tr>
					<td width=35px></td>
					<td width=35px></td>
					<td width=70px></td>
					<td width=263px></td>
					<td width=40px></td>
					<td width=40px></td>
					<td width=40px></td>
					<td width=40px></td>
					<td width=100px></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td class="left" colspan="7"><b>รายการจ่ายแจกยุทโธปกรณ์</b></td>
				</tr> 
				';


$sum = array(0,0,0,0);
$i=0;
$j = 0;



foreach($Techs as $Tech){
 $sum = array(0,0,0,0,0);

  if($i<10){ $j= "0".($i+1);}else{$j=$i; }
	$body .= ' 
	<tr>
		<td class="center">'.$j.'</td>
		<td >&nbsp;</td>
		<td class="left" colspan="7">'.$Tech.'</td>
	</tr> 
	';

	$m=1;
	foreach($ModelDivisions[$i] as $ModelDivision){

		
		$ModelEquipment = $ModelDivision['ModelEquipment'];
		$ModelDecrease = $ModelDivision['0'];
		$quantity = 1;// $ModelDivision['ModelGroup']['quantity'];


		$body .= '<tr>
			<td></td>
			<td class="center">'.$m.'</td>
			';
			$body .= '			
				<td class="center">'.$ModelEquipment['equipment_code'].'</td>
				<td class="left">'.$ModelEquipment['equipment_name'].'</td>
				<td class="center">'.number_format(($ModelDecrease['rate_full']*$quantity),0,".",",").'</td>
				<td class="center">'.number_format(($ModelDecrease['rate_decrease_1']*$quantity),0,".",",").'</td>
				<td class="center">'.number_format(($ModelDecrease['rate_decrease_2']*$quantity),0,".",",").'</td>
				<td class="center">'.number_format(($ModelDecrease['rate_structure']*$quantity),0,".",",").'</td>
				<td></td>';			
		$body .= '</tr>';

		$sum[0] = $sum[0]+($ModelDecrease['rate_full']*$quantity);
		$sum[1] = $sum[1]+($ModelDecrease['rate_decrease_1']*$quantity);
		$sum[2] = $sum[2]+($ModelDecrease['rate_decrease_2']*$quantity);
		$sum[4] = $sum[4]+($ModelDecrease['rate_structure']*$quantity);


		$m++;
	}//- End Foreach Models Division -//

  $i++;

if($m !=1){
	$body .= '<tr>
		<td></td>
		<td></td>
		<td></td>
		<td class="center"><b>รวม</b></td>
		<td class="center"><b>'.number_format($sum[0]).'</b></td>
		<td class="center"><b>'.number_format($sum[1]).'</b></td>
		<td class="center"><b>'.number_format($sum[2]).'</b></td>
		<td class="center"><b>'.number_format($sum[4]).'</b></td>
		<td></td>
	</tr> ';
}else{
		$body .= '<tr>
		<td></td>
		<td></td>
		<td class="left" colspan="7">(ไม่กำหนดยุทโธปกรณ์)</td>
	</tr> ';

}


		$sumTotal[0] = $sumTotal[0]+$sum[0];
		$sumTotal[1] = $sumTotal[1]+$sum[1];
		$sumTotal[2] = $sumTotal[2]+$sum[2];
		$sumTotal[3] = $sumTotal[3]+$sum[3];
		$sumTotal[4] = $sumTotal[4]+$sum[4];

}

 //- End foreach Models Group -//

	
	$body .= '
	<tr><td colspan="9">&nbsp;</td></tr>
	<tr>
	<td></td>
	<td></td>
	<td class="center" colspan="2"><b>รวมทั้งสิ้น</b></td>
	<td class="center"><b>'.number_format($sumTotal[0]).'</b></td>
	<td class="center"><b>'.number_format($sumTotal[1]).'</b></td>
	<td class="center"><b>'.number_format($sumTotal[2]).'</b></td>
	<td class="center"><b>'.number_format($sumTotal[4]).'</b></td>
	<td></td>
</tr> ';


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

//die( $header . $html);

//max 58

//==============================================================
//==============================================================
//==============================================================
/**/
include("libs/mpdf/mpdf.php");

//$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',15, 15, 15, 15, 8, 8); 
$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',15, 10, 45, 25, 10, 10); 
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
//$mpdf->Output('D:\xampp\htdocs\afkair.local\office\app\webroot\files\Quotations/testcake.pdf');

$mpdf->Output();
exit;
/**/
//==============================================================
//==============================================================
//==============================================================


?>