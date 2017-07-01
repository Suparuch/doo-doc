<?php

ini_set('memory_limit', '2048M');
error_reporting(0);

$style = '
<style type="text/css">


/* Custom CSS code */
table {width:100%;border-spacing:0; border-collapse: collapse;}
ul {list-style-type: none; padding-left:0;}
body, input, textarea { font-family:TH SarabunPSK; font-size:12px; }
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

$model_name = $model_type_name .' '. $model_code .' '. $model_name;

$space_5 = str_repeat('', 5);
//pr($ModelDivisions);
//pr($ModelRates);
//------------------------------------------------------------------------------------------------------------------
$header = '
<table>
	<tr>
		<td width=40px>
			<img src="/theme/Gebo/img/logo/logo_print.jpg">
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
		<td height="25px" width=210px>
			<b>ตอนที่ 3 อัตรากำลังพล กองทัพบก</b>
		</td>
		<td><center>
			<b>'.$model_name.'</b>
			</center>
		</td>
		<td width=180px align="right">'.$model_date.'</td>
	</tr>
</table>

<table>
	<thead>
		<tr class="border_top_header">
					<th rowspan="2" width=35px>วรรค</th>
					<th rowspan="2" width=80px>วรรคย่อย</th>
					<th rowspan="2" width=35px>ลำดับ</th>
					<th rowspan="2">ตำแหน่ง</th>
					<th rowspan="2" width=47px>ชั้นยศ</th>
					<th rowspan="2" width=40px>เหล่า</th>
					<th rowspan="2" width=60px>ชกท.</th>
					<th >อัตราระดับความพร้อมรบ</th>
					<th rowspan="2" width=100px>หมายเหตุ</th>
		</tr>
		<tr class="row_head_body">
					<th width=40px>เต็ม</th>
		</tr>
		<tr class="border_bottom_header">
			<th colspan="9">

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
			<td width=40px></td>
			<td width=40px></td>
			<td width=300px></td>
			<td width=40px></td>
			<td width=40px></td>
			<td width=40px></td>
			<td width=40px></td>
			<td width=100px></td>
		</tr>
';

$sum = array();
$sumRankCorp= array();
$key_division=1;
$sumTotal= array(0,0,0,0,0);
$sumRankCorpTotal= array();
$sumRankGroup = array();
foreach($ModelDivisions as $ModelDivision){

			$division = $ModelDivision['ModelDivisionSpecialProperty'];

			$body .= '
			<tr class="row_body">
				<td class="center"><b>'.str_pad($key_division, 2, '0', STR_PAD_LEFT).'</b></td>
				<td class="left" colspan="8"><b>'.$division['name'].'</b></td>
			</tr> 
			';

			$sum = array(0,0,0,0,0);
			$subDivisions = $ModelDivision['ModelSubDivision'];

			$key_subdivision=1;
			foreach($subDivisions as $subDivision){

				$positions = $subDivision['ModelPosition'];

				$body .= ' 
				<tr class="row_body">
					<td></td>
					<td class="center">'.str_pad($key_subdivision, 2, '0', STR_PAD_LEFT).'</td>
					<td class="left" colspan="7">'.$subDivision['name'].'</td>
				</tr> 
				';

				$key_position=1;	
				foreach($positions as $position){

					$properties = $position['ModelProperty'];

					$body .= '
					<tr class="row_body">
						<td></td>
						<td></td>
						<td class="center">'.str_pad($key_position, 2, '0', STR_PAD_LEFT).'</td>						
						<td colspan="6">'.$position['name'].'</td>
					</tr>';

					foreach($properties as $property){

						$body .= '
						<tr class="row_body">
							<td></td>
							<td></td>
							<td></td>
							<td></td>	
							<td class="center">'.$Ranks[$property['rank_id']].'</td>
							<td class="center">'.$Corps[$property['corp_id']].'</td>
							<td class="center">'.$property['mos'].'</td>
							<td class="center">'.$property['rate_full'].'</td>
							<td class="center">'.$property['comment'].'</td>
						</tr>';

						$sum[0] += $property['rate_full'];
						$sum[1] += $property['rate_decrease_1'];
						$sum[2] += $property['rate_decrease_2'];
						$sum[3] += $property['rate_decrease_3'];
						$sum[4] += $property['rate_structure'];

					}
					$key_position++;

				}
				$key_subdivision++;

			}			
			$key_division=1;

	$body .= '
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td class="center"><b>รวม</b></td>
		<td class="center"><b>'.$sum[0].'</b></td>
		<td></td>
	</tr> ';

}


$body .= '
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
//echo $html;die;
//echo $header.$html.$footer;
//max 58
/**/
//==============================================================
//==============================================================
//==============================================================

include("libs/mpdf/mpdf.php");

//$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',15, 15, 15, 15, 8, 8); 
$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',5, 5, 40, 18, 5, 5); 

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