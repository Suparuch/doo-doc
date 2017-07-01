<?php
$filename = date("YmdHis") . 'dopns_transfer.csv';
$now = gmdate("D, d M Y H:i:s");

header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
header("Last-Modified: {$now} GMT");
/*
// force download  
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// disposition / encoding on response body
header("Content-Disposition: attachment;filename={$filename}");


header("Content-Transfer-Encoding: binary");
*/
header('Content-Type: text/html; charset=tis-620');

ini_set('memory_limit', '1024M');
set_time_limit(3000);
error_reporting(0); 
//error_reporting(E_ALL & ~E_NOTICE);
try{
$sumTotal[0] = 0;
$sumTotal[1] = 0;
$sumTotal[2] = 0;
$sumTotal[3] = 0;
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

$space_5 = str_repeat('&nbsp;', 5);
//pr($ModelDivisions);
//pr($ModelRates);
unset($ModelRates);
//------------------------------------------------------------------------------------------------------------------
$header = "\"หมายเลข อจย./อฉก.\",\" " . $model_code .'"';
$header .= "\n\"ชื่อ อจย./อฉก. \",\"" . $model_name.'"';
$header .= "\n\"วันที่ อจย./อฉก. \",\"" . $model_date.'"';
$header .= "\n\n" . '"วรรค","ลำดับ","ตำแหน่ง","ชั้นยศ","เหล่า","ชกท.'.$space_5.'","อัตราเต็ม","อัตราลด 1","อัตราลด 2","อัตราโครง","อาวุธ","หมายเหตุ"';

//------------------------------------------------------------------------------------------------------------------
$body = "";

$sum = array();
$sumRankCorp= array();

$sumTotal= array(0,0,0,0,0);
$sumRankCorpTotal= array();
$sumRankGroup = array();
$key_division=1;
foreach($ModelDivisions as $ModelDivision){

	$divisions = $ModelDivision['ModelDivision'];

	foreach($divisions as $division){

		$sum = array(0,0,0,0,0);
		$positions = $division['ModelPosition'];

		$body .= '"'.str_pad($key_division, 2, '0', STR_PAD_LEFT).'",,"'.$division['name']."\"\n";

		$key_position=1;	
		foreach($positions as $position){

			$properties = $position['ModelProperty'];

			$body .= '"","'.str_pad($key_position, 2, '0', STR_PAD_LEFT).'","'.$position['name'].'"';

			$chk =0;
			foreach($properties as $property){
				$var = print_r($property, true);
				if($chk==0){
					$body .= ',"'.$Ranks[$property['rank_id']].'","'.$Corps[$property['corp_id']].'","'.$property['mos'].$space_5.'","'.$property['rate_full'].'","'.$property['rate_decrease_1'].'","'.$property['rate_decrease_2'].'","'.$property['rate_structure'].'","'.$property['weapon_name'].'","'.$property['comment'].'"';

					$body .= "\n";
					$chk++;
				}else{
					$body .= ',"","","'.$Ranks[$property['rank_id']].'","'.$Corps[$property['corp_id']].'","'.$property['mos'].$space_5.'","'.$property['rate_full'].'","'.$property['rate_decrease_1'].'","'.$property['rate_decrease_2'].'","'.$property['rate_structure'].'","'.$property['weapon_name'].'","'.$property['comment'].'"' . "\n";
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
				}else if($property['rank_id']>=12 && $property['rank_id']<=20) {
					$sumRankGroup[1][0] += $property['rate_full'];
					$sumRankGroup[1][1] += $property['rate_decrease_1'];
					$sumRankGroup[1][2] += $property['rate_decrease_2'];
					$sumRankGroup[1][3] += $property['rate_decrease_3'];
					$sumRankGroup[1][4] += $property['rate_structure'];
				}else if($property['rank_id']==21) {
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

		$body .= '"","","","","' . $division['name'] . '","รวม","'.$sum[0].'","'.$sum[1].'","'.$sum[2].'","'.$sum[4].'",""' . "\n" ;

		$sumTotal[0] += $sum[0];
		$sumTotal[1] += $sum[1];
		$sumTotal[2] += $sum[2];
		$sumTotal[3] += $sum[3];
		$sumTotal[4] += $sum[4];

	}
unset($ModelDivisions);
$body .= '"","","","","","รวมทั้งสิ้น","'.$sumTotal[0].'","'.$sumTotal[1].'","'.$sumTotal[2].'","'.$sumTotal[4].'",""' . "\n" ;

}
if(!empty($model_comment)){
	$body .= "\n" . '"","หมายเหตุ"' . "\n" . ''. $model_comment.'' ."\n";
}

$body .= "\n" . 'อัตราแยกตามชั้นยศ เหล่าและ ชกท.';

//$sum_mos = array();
$sum_mos_total = array();
$body .= "\n";
ksort($sumRankCorp);
foreach($sumRankCorp as $key_rank=> $sumCorp){

	$body .= "\n" . '"","","","'.$Ranks[$key_rank].'"';
	
	$sum_mos = array();
	ksort($sumCorp);
	foreach($sumCorp as $key_corp=> $sumMos){
		
		ksort($sumMos);
		foreach($sumMos as $key_mos=> $mos){

			$body .= "\n" .'"","","","","'.$key_corp.'","'.$key_mos.$space_5.'","'.$mos[0].'","'.$mos[1].'","'.$mos[2].'","'.$mos[4].'"';
			
			$sum_mos[0] += $mos[0];
			$sum_mos[1] += $mos[1];
			$sum_mos[2] += $mos[2];
			$sum_mos[3] += $mos[3];
			$sum_mos[4] += $mos[4];

		}

	}

	$body .= "\n" . '"","","","","","รวม","'.$sum_mos[0].'","'.$sum_mos[1].'","'.$sum_mos[2].'","'.$sum_mos[4].'"';

	$sum_mos_total[0] += $sum_mos[0];
	$sum_mos_total[1] += $sum_mos[1];
	$sum_mos_total[2] += $sum_mos[2];
	$sum_mos_total[3] += $sum_mos[3];
	$sum_mos_total[4] += $sum_mos[4];

}

$body .= "\n".'"","","","","","รวมทั้งสิ้น","'.$sum_mos_total[0].'","'.$sum_mos_total[1].'","'.$sum_mos_total[2].'","'.$sum_mos_total[4].'"';

$body .= "\n\n\n".'"","","","น.สัญญาบัตร","","รวม","'.$sumRankGroup[0][0].'","'.$sumRankGroup[0][1].'","'.$sumRankGroup[0][2].'","'.$sumRankGroup[0][4].'"';

$body .= "\n" . '"","","","น.ประทวน","","รวม","'.$sumRankGroup[1][0].'","'.$sumRankGroup[1][1].'","'.$sumRankGroup[1][2].'","'.$sumRankGroup[1][4].'"';

$body .= "\n" . '"","","","พลทหาร","","รวม","'.$sumRankGroup[2][0].'","'.$sumRankGroup[2][1].'","'.$sumRankGroup[2][2].'","'.$sumRankGroup[2][4].'"';

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

$body .= "\n" . '"","","","","","รวมทั้งสิ้น","'.$sum_mos_total[0].'","'.$sum_mos_total[1].'","'.$sum_mos_total[2].'","'.$sum_mos_total[4].'"';



unset($sum_mos_total);
unset($sumRankGroup);
unset($Ranks);
unset($sumRankCorp);
unset($sumTotal);
//------------------------------------------------------------------------------------------------------------------
$footer = "\n----------------------------------------------------------------------------------------------------------------------------\n";

$html =  $header . "\n" . $body . "\n" . $footer;
$html = str_replace("&nbsp;"," ",$html);
//die($html);
//$table = $header.$html;
echo $html;
/*
$fp = fopen($_SERVER['DOCUMENT_ROOT']  . '/Upload/output/' . $filename, 'w');
		fwrite($fp, iconv("utf-8", "tis-620",$html));
		fclose($fp);
*/
//max 58
/**/
//==============================================================
//==============================================================
//==============================================================


}catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>