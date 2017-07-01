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
  color:#000; font-size:8pt; font-weight:normal; margin-bottom: 0em;

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
//pr($ModelRates);
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
			<b>ตอนที่ 3 อัตรากำลังพล </b>
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
			<th rowspan="2" width=35px>วรรค</th>
			<th rowspan="2" width=35px>ลำดับ</th>
			<th rowspan="2">ตำแหน่ง</th>
			<th rowspan="2" width=47px class="left">ชั้นยศ</th>
			<th rowspan="2" width=40px>เหล่า</th>
			<th rowspan="2" width=60px class="right">ชกท.'.$space_5.'</th>
			<th colspan="5">อัตราระดับความพร้อมรบ</th>
			<th rowspan="2" width=40px>อาวุธ</th>
			<th rowspan="2" width=100px>หมายเหตุ</th>
		</tr>
		<tr class="row_head_body">
			<th width=40px class="center">เต็ม</th>
			<th width=40px class="center">ลด 1</th>
			<th width=40px class="center">ลด 2</th>
			<th width=40px class="center">ลด 3</th>
			<th width=40px class="center">โครง</th>
		</tr>
		<tr class="border_bottom_header">
			<th colspan="13">

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
			<td width=40px></td>
			<td width=40px></td>
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

	$divisions = $ModelDivision['ModelDivision'];
//	$properties = ['ModelProperty'];

	foreach($divisions as $division){

		$sum = array(0,0,0,0,0);
		$positions = $division['ModelPosition'];

		$body .= '
		<tr class="row_body">
			<td class="center"><b>'.str_pad($key_division, 2, '0', STR_PAD_LEFT).'</b></td>
			<td></td>
			<td class="left" colspan="11"><b>'.$division['name'].'</b></td>
		</tr> 
		';

		$key_position=1;
		
		foreach($positions as $position){

			$properties = $position['ModelProperty'];

			$body .= '
			<tr class="row_body">
				<td></td>
				<td class="center">'.str_pad($key_position, 2, '0', STR_PAD_LEFT).'</td>
				<td>'.$position['name'].'</td>
			';

			$chk =0;
			foreach($properties as $property){

				if($chk==0){
					$body .= '
					<td class="left">'.$Ranks[$property['rank_id']].'</td>
					<td class="center">'.$Corps[$property['corp_id']].'</td>
					<td class="right">'.$property['mos'].$space_5.'</td>
					<td class="center">'.$property['rate_full'].'</td>
					<td class="center">'.$property['rate_decrease_1'].'</td>
					<td class="center">'.$property['rate_decrease_2'].'</td>
					<td class="center">'.$property['rate_decrease_3'].'</td>
					<td class="center">'.$property['rate_structure'].'</td>
					<td class="center">'.$property['weapon_name'].'</td>
					<td class="center">'.$property['comment'].'</td>
					';

					$body .= '</tr>';
					$chk++;
				}else{
					$body .= '
					<tr class="row_body">
						<td></td>
						<td></td>
						<td></td>		
						<td class="left">'.$Ranks[$property['rank_id']].'</td>
						<td class="center">'.$Corps[$property['corp_id']].'</td>
						<td class="right">'.$property['mos'].$space_5.'</td>
						<td class="center">'.$property['rate_full'].'</td>
						<td class="center">'.$property['rate_decrease_1'].'</td>
						<td class="center">'.$property['rate_decrease_2'].'</td>
						<td class="center">'.$property['rate_decrease_3'].'</td>
						<td class="center">'.$property['rate_structure'].'</td>
						<td class="center">'.$property['weapon_name'].'</td>
						<td class="center">'.$property['comment'].'</td>
					</tr>
					';
				}

				$sum[0] += $property['rate_full'];
				$sum[1] += $property['rate_decrease_1'];
				$sum[2] += $property['rate_decrease_2'];
				$sum[3] += $property['rate_decrease_3'];
				$sum[4] += $property['rate_structure'];

				$sumRankCorp[$property['rank_id']][$Corps[$property['corp_id']]][$property['mos']][0] += $property['rate_full'];
				$sumRankCorp[$property['rank_id']][$Corps[$property['corp_id']]][$property['mos']][1] += $property['rate_decrease_1'];
				$sumRankCorp[$property['rank_id']][$Corps[$property['corp_id']]][$property['mos']][2] += $property['rate_decrease_2'];
				$sumRankCorp[$property['rank_id']][$Corps[$property['corp_id']]][$property['mos']][3] += $property['rate_decrease_3'];
				$sumRankCorp[$property['rank_id']][$Corps[$property['corp_id']]][$property['mos']][4] += $property['rate_structure'];

				if($property['rank_id']>=1 && $property['rank_id']<=11) {
					$sumRankGroup[0][0] += $property['rate_full'];
					$sumRankGroup[0][1] += $property['rate_decrease_1'];
					$sumRankGroup[0][2] += $property['rate_decrease_2'];
					$sumRankGroup[0][3] += $property['rate_decrease_3'];
					$sumRankGroup[0][4] += $property['rate_structure'];
				}else if($property['rank_id']>=12 && $property['rank_id']<20) {
					$sumRankGroup[1][0] += $property['rate_full'];
					$sumRankGroup[1][1] += $property['rate_decrease_1'];
					$sumRankGroup[1][2] += $property['rate_decrease_2'];
					$sumRankGroup[1][3] += $property['rate_decrease_3'];
					$sumRankGroup[1][4] += $property['rate_structure'];
				}else if($property['rank_id']==21 || $property['rank_id']==20) {
					$sumRankGroup[2][0] += $property['rate_full'];
					$sumRankGroup[2][1] += $property['rate_decrease_1'];
					$sumRankGroup[2][2] += $property['rate_decrease_2'];
					$sumRankGroup[2][3] += $property['rate_decrease_3'];
					$sumRankGroup[2][4] += $property['rate_structure'];
				//}else if($property['rank_id']>22) {
				}else{
					$sumRankGroup[3][0] += $property['rate_full'];
					$sumRankGroup[3][1] += $property['rate_decrease_1'];
					$sumRankGroup[3][2] += $property['rate_decrease_2'];
					$sumRankGroup[3][3] += $property['rate_decrease_3'];
					$sumRankGroup[3][4] += $property['rate_structure'];

				}

			}
			$key_position++;
		}
		$key_division++;

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
			<td class="center"><b>'.number_format($sum[3],0,".",",").'</b></td>
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
	<td class="center"><b>'.number_format($sumTotal[3],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumTotal[4],0,".",",").'</b></td>
	<td></td>
	<td></td>
</tr>
';

}

$body .= '
	</tbody>
</table>
';

if(!empty($model_comment)){
	$body.= '<br /><br /><b><u>หมายเหตุ</u></b><div style="line-height:20px;width:650px">' . str_replace("\t",$space_5, nl2br( str_replace(" ","&nbsp;",$model_comment))) . '</div>' ;
}

$body .= '<p style="page-break-after: always">&nbsp;</p>';

$body .= '<br><u><b>อัตราแยกตามชั้นยศ, เหล่าและ ชกท.</b></u>';

//$sum_mos = array();
$sum_mos_total = array();
$body .= '
<table>
	<tbody>
		<tr class="row_head_body">
			<td width=35px></td>
			<td width=35px></td>
			<td width=198px></td>
			<td width=47px></td>
			<td width=40px></td>
			<td width=60px></td>
			<td width=40px></td>
			<td width=40px></td>
			<td width=40px></td>
			<td width=40px></td>
			<td width=40px></td>
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
				<td class="right">'.$key_mos.$space_5.'</td>
				<td class="center">'.number_format($mos[0],0,".",",").'</td>
				<td class="center">'.number_format($mos[1],0,".",",").'</td>
				<td class="center">'.number_format($mos[2],0,".",",").'</td>
				<td class="center">'.number_format($mos[3],0,".",",").'</td>
				<td class="center">'.number_format($mos[4],0,".",",").'</td>
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
		<td class="center"><b>'.number_format($sum_mos[0],0,".",",").'</b></td>
		<td class="center"><b>'.number_format($sum_mos[1],0,".",",").'</b></td>
		<td class="center"><b>'.number_format($sum_mos[2],0,".",",").'</b></td>
		<td class="center"><b>'.number_format($sum_mos[3],0,".",",").'</b></td>
		<td class="center"><b>'.number_format($sum_mos[4],0,".",",").'</b></td>
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
			<td class="center"><b>'.number_format($sum_mos_total[0],0,".",",").'</b></td>
			<td class="center"><b>'.number_format($sum_mos_total[1],0,".",",").'</b></td>
			<td class="center"><b>'.number_format($sum_mos_total[2],0,".",",").'</b></td>
			<td class="center"><b>'.number_format($sum_mos_total[3],0,".",",").'</b></td>
			<td class="center"><b>'.number_format($sum_mos_total[4],0,".",",").'</b></td>
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
			<td width=168px></td>
			<td width=77px><b>น.สัญญาบัตร</b></td>
			<td width=40px></td>
			<td width=60px><b>รวม</b></td>
			<td width=40px class="center"><b>'.number_format($sumRankGroup[0][0],0,".",",").'</b></td>
			<td width=40px class="center"><b>'.number_format($sumRankGroup[0][1],0,".",",").'</b></td>
			<td width=40px class="center"><b>'.number_format($sumRankGroup[0][2],0,".",",").'</b></td>
			<td width=40px class="center"><b>'.number_format($sumRankGroup[0][3],0,".",",").'</b></td>
			<td width=40px class="center"><b>'.number_format($sumRankGroup[0][4],0,".",",").'</b></td>
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
	<td class="center"><b>'.number_format($sumRankGroup[1][0],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumRankGroup[1][1],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumRankGroup[1][2],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumRankGroup[1][3],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumRankGroup[1][4],0,".",",").'</b></td>
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
	<td class="center"><b>'.number_format($sumRankGroup[2][0],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumRankGroup[2][1],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumRankGroup[2][2],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumRankGroup[2][3],0,".",",").'</b></td>
	<td class="center"><b>'.number_format($sumRankGroup[2][4],0,".",",").'</b></td>
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
			<td class="center"><b>'.number_format($sum_mos_total[0],0,".",",").'</b></td>
			<td class="center"><b>'.number_format($sum_mos_total[1],0,".",",").'</b></td>
			<td class="center"><b>'.number_format($sum_mos_total[2],0,".",",").'</b></td>
			<td class="center"><b>'.number_format($sum_mos_total[3],0,".",",").'</b></td>
			<td class="center"><b>'.number_format($sum_mos_total[4],0,".",",").'</b></td>
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