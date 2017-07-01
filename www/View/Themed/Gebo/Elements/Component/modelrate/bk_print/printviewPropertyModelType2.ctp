<?php

ini_set('memory_limit', '2048M');
error_reporting(0);
$body = '';
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

$space_8 = str_repeat('&nbsp;', 8);
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
			กองทัพบกไทย
			</center>
		</td>
		<td width=180px align="right"><b>'.$model_name.'</b></td>
	</tr>
</table>

<table>
	<thead>
		<tr class="border_top_header">
			<th width=35px>วรรค</th>
			<th width=35px>วรรค<br>ย่อย</th>
			<th width=35px>ลำดับ</th>
			<th rowspan="2">ตำแหน่ง</th>
			<th width=47px>ชั้นยศ</th>
			<th width=40px>เหล่า</th>
			<th width=60px>ชกท.</th>
			<th width=160px>อัตรา</th>
			<th width=40px></th>
			<th width=100px>หมายเหตุ</th>
		</tr>
		<tr class="border_bottom_header">
			<th colspan="10">

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
			<td width=35px></td>
			<td></td>
			<td width=47px></td>
			<td width=40px></td>
			<td width=60px></td>
			<td width=160px></td>
			<td width=40px></td>
			<td width=100px></td>
		</tr>
';

$sum = array();
$sumRankCorp= array();

$sumTotal= array(0,0,0,0,0);
$sumRankCorpTotal= array();
$sumRankGroup = array();
$key_division=1;
foreach($ModelDivisions as $ModelDivision){

	$division = $ModelDivision['ModelDivisionSpecialProperty'];
	$subDivisions = $ModelDivision['ModelSubDivision'];

	$body .= '
	<tr class="row_body">
		<td class="center"><b>'.str_pad($key_division, 2, '0', STR_PAD_LEFT).'</b></td>
		<td class="left" colspan="9"><b>'.$division['name'].'</b></td>
	</tr> 
	';

	$sum = array(0,0,0,0,0);
			
	$key_subdivision=1;
	foreach($subDivisions as $subDivision){

		$sumSubdivision = array();
		$positions = $subDivision['ModelPosition'];

		$body .= ' 
		<tr class="row_body">
			<td></td>
			<td class="center">'.str_pad($key_subdivision, 2, '0', STR_PAD_LEFT).'</td>
			<td class="left" colspan="8">'.$subDivision['name'].'</td>
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
				<td>'.$position['name'].'</td>
			';
			$chk = 0;
			foreach($properties as $property){

				if($chk==0){
					$body .= '
						<td class="left">'.$Ranks[$property['rank_id']].'</td>
						<td class="center">'.$Corps[$property['corp_id']].'</td>
						<td class="right">'.$property['mos'].$space_8.'</td>
						<td class="center">'.$property['rate_full'].'</td>
						<td></td>
						<td class="center">'.$property['comment'].'</td>
					</tr>
					';
					$chk++;
				}else{
					$body .= '
					<tr class="row_body">
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td class="left">'.$Ranks[$property['rank_id']].'</td>
						<td class="center">'.$Corps[$property['corp_id']].'</td>
						<td class="right">'.$property['mos'].$space_8.'</td>
						<td class="center">'.$property['rate_full'].'</td>
						<td></td>
						<td class="center">'.$property['comment'].'</td>
					</tr>
					';
				}

				$sum[0] += $property['rate_full'];
				$orderPositionRankCorp[$property['rank_id']][$position['name']] = $position['name'];
				$sumPositionRankCorp[$position['name']][$property['rank_id']][$Corps[$property['corp_id']]][$property['mos']][0] += $property['rate_full'];
				//$sumPositionRankCorp[$position['position_id']][$property['rank_id']][$Corps[$property['corp_id']]][$property['mos']][0] += $property['rate_full'];
				$sumRankCorp[$property['rank_id']][$Corps[$property['corp_id']]][$property['mos']][0] += $property['rate_full'];

				if($property['rank_id']>=1 && $property['rank_id']<=11) {
					$sumRankGroup[0][0] += $property['rate_full'];
				}else if($property['rank_id']>=12 && $property['rank_id']<=20) {
					$sumRankGroup[1][0] += $property['rate_full'];
				}else if($property['rank_id']==21) {
					$sumRankGroup[2][0] += $property['rate_full'];
				}else{
					$sumRankGroup[3][0] += $property['rate_full'];
				}

				$sumSubdivision[0] += $property['rate_full'];

			}
			$key_position++;

		}
		$key_subdivision++;

		$body .= '
		<tr class="row_body">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>'.$subDivision['name'].'</td>
			<td class="center"><b>รวม</b></td>
			<td class="center"><b>'.$sumSubdivision[0].'</b></td>
			<td></td>
			<td></td>
		</tr>
		';

	}			
	$key_division++;

	$body .= '
	<tr class="row_body">
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>' . $division['name'] . '</td>
		<td class="center"><b>รวม</b></td>
		<td class="center"><b>'.$sum[0].'</b></td>
		<td></td>
		<td></td>
	</tr>
	';

	$sumTotal[0] += $sum[0];
	
}

$body .= '
<tr class="row_body">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><b>รวมทั้งสิ้น</b></td>
	<td class="center"><b>'.$sumTotal[0].'</b></td>
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

//------------------------------------------------------------------------
$body .= '<p style="page-break-after: always">&nbsp;</p>';
$body .= '
<table>
	<tr class="row_head_body">
		<td width=35px></td>
		<td><u><b>สรุปอัตรากำลังพล แยกตาม ตำแหน่ง ชั้นยศ เหล่า และ ชกท.</b></u></td>
	</tr>
</table>
';
//$body .= '<br><u><b>สรุปอัตรากำลังพล แยกตาม ตำแหน่ง ชั้นยศ เหล่า และ ชกท.</b></u>';

//$sum_mos = array();
$sum_mos_total = array();
$body .= '
<table>
	<tbody>
		<tr class="row_head_body">
			<td width=35px></td>
			<td width=35px></td>
			<td width=238px></td>
			<td width=47px></td>
			<td width=40px></td>
			<td width=60px></td>
			<td width=160px></td>
			<td width=40px></td>
			<td width=100px></td>
		</tr>
';

ksort($orderPositionRankCorp);
foreach($orderPositionRankCorp as $key_order=> $PositionRankCorp){
	foreach($PositionRankCorp as $key_position=> $RankCorp){
		$orderPositions[$RankCorp]++;
	}
}

//foreach($sumPositionRankCorp as $key_position=> $RankCorp){
foreach($orderPositions as $key_position=> $orderPosition){

	$RankCorp = $sumPositionRankCorp[$key_position];
			
	$seq_position++;
	$body .= '
	<tr class="row_body">
		<td></td>
		<td class="center">'.$seq_position.'</td>
		<td>'.$key_position.'</td>		
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	';

	foreach($RankCorp as $key_rank=> $sumCorp){

		$body .= '
		<tr class="row_body">
			<td></td>
			<td></td>
			<td></td>		
			<td>'.$Ranks[$key_rank].'</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		';
		
		ksort($sumCorp);
		foreach($sumCorp as $key_corp=> $sumMos){
			
			ksort($sumMos);
			foreach($sumMos as $key_mos=> $mos){

				$body .= '
				<tr class="row_body">
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center">'.$key_corp.'</td>
					<td class="right">'.$key_mos.$space_8.'</td>
					<td class="center">'.$mos[0].'</td>
					<td></td>
					<td></td>
				</tr>
				';
				
				$sum_position_mos[0] += $mos[0];

			}

		}

	}

}

$body .= '
		<tr class="row_body">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><b>รวมทั้งสิ้น</b></td>
			<td class="center"><b>'.$sum_position_mos[0].'</b></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
';

//------------------------------------------------------------------------
$body .= '<p style="page-break-after: always">&nbsp;</p>';
$body .= '
<table>
	<tr class="row_head_body">
		<td width=35px></td>
		<td><u><b>สรุปอัตราแยกตามชั้นยศ, เหล่า และ ชกท.</b></u></td>
	</tr>
</table>
';
//$body .= '<br><u><b>อัตราแยกตามชั้นยศ, เหล่าและ ชกท.</b></u>';

//$sum_mos = array();
$sum_mos_total = array();
$body .= '
<table>
	<tbody>
		<tr class="row_head_body">
			<td width=35px></td>
			<td width=35px></td>
			<td width=238px></td>
			<td width=47px></td>
			<td width=40px></td>
			<td width=60px></td>
			<td width=160px></td>
			<td width=40px></td>
			<td width=100px></td>
		</tr>
';

foreach($sumRankCorp as $key_rank=> $sumCorp){

	$body .= '
	<tr class="row_body">
		<td></td>
		<td></td>
		<td></td>		
		<td>'.$Ranks[$key_rank].'</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	';
	
	$sum_mos = array();
	ksort($sumCorp);
	foreach($sumCorp as $key_corp=> $sumMos){
		
		ksort($sumMos);
		foreach($sumMos as $key_mos=> $mos){

			$body .= '
			<tr class="row_body">
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="center">'.$key_corp.'</td>
				<td class="right">'.$key_mos.$space_8.'</td>
				<td class="center">'.$mos[0].'</td>
				<td></td>
				<td></td>
			</tr>
			';
			
			$sum_mos[0] += $mos[0];
			$sum_mos[1] += $mos[1];
			$sum_mos[2] += $mos[2];
			$sum_mos[3] += $mos[3];
			$sum_mos[4] += $mos[4];

		}

	}

	$body .= '
	<tr class="row_body">
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><b>รวม</b></td>
		<td class="center"><b>'.$sum_mos[0].'</b></td>
		<td></td>
		<td></td>
	</tr>
	';

	$sum_mos_total[0] += $sum_mos[0];
	$sum_mos_total[1] += $sum_mos[1];
	$sum_mos_total[2] += $sum_mos[2];
	$sum_mos_total[3] += $sum_mos[3];
	$sum_mos_total[4] += $sum_mos[4];

}

$body .= '
		<tr class="row_body">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><b>รวมทั้งสิ้น</b></td>
			<td class="center"><b>'.$sum_mos_total[0].'</b></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
';

$body .= '
<table>
	<tbody>
		<tr class="row_body">
			<td width=35px></td>
			<td width=35px></td>
			<td width=208px></td>
			<td width=77px><b>น.สัญญาบัตร</b></td>
			<td width=40px></td>
			<td width=60px><b>รวม</b></td>
			<td width=160px class="center"><b>'.$sumRankGroup[0][0].'</b></td>
			<td width=40px></td>
			<td width=100px></td>
		</tr>
';

$body .= '
<tr class="row_body">
	<td></td>
	<td></td>
	<td></td>
	<td><b>น.ประทวน</b></td>
	<td></td>
	<td><b>รวม</b></td>
	<td class="center"><b>'.$sumRankGroup[1][0].'</b></td>
	<td></td>
	<td></td>
</tr>
';

$body .= '
<tr class="row_body">
	<td></td>
	<td></td>
	<td></td>
	<td><b>พลทหาร</b></td>
	<td></td>
	<td><b>รวม</b></td>
	<td class="center"><b>'.$sumRankGroup[2][0].'</b></td>
	<td></td>
	<td></td>
</tr>
';

/*
$body .= '
<tr class="row_body">
	<td></td>
	<td></td>
	<td></td>
	<td><b>อื่นๆ</b></td>
	<td></td>
	<td><b>รวม</b></td>
	<td class="center"><b>'.$sumRankGroup[3][0].'</b></td>
	<td class="center"><b>'.$sumRankGroup[3][1].'</b></td>
	<td class="center"><b>'.$sumRankGroup[3][2].'</b></td>
	<td class="center"><b>'.$sumRankGroup[3][4].'</b></td>
	<td></td>
	<td></td>
</tr>
';
*/

$body .= '
		<tr class="row_body">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><b>รวมทั้งสิ้น</b></td>
			<td class="center"><b>'.$sum_mos_total[0].'</b></td>
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