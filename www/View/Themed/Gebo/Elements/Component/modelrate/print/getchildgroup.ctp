<?php


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
$body = '
';


$count = 0;
$sumTotal= array(0,0,0,0,0);
$key_group = 1;
foreach($ModelGroups as $i => $modelGroup){

	$sum = array(0,0,0,0,0);
	$quantity = $modelGroup['ModelGroup']['quantity'];
	$quantity_decrease1 = $modelGroup['ModelGroup']['quantity_decrease1'];
	$quantity_decrease2 = $modelGroup['ModelGroup']['quantity_decrease2'];
	$quantity_decrease3 = $modelGroup['ModelGroup']['quantity_decrease3'];
	$quantity_struct = $modelGroup['ModelGroup']['quantity_struct'];
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
			<td class="center">'.($ModelDecrease['rate_full']*$quantity).'</td>
			<td class="center">'.($ModelDecrease['rate_decrease_1']*$quantity_decrease1).'</td>
			<td class="center">'.($ModelDecrease['rate_decrease_2']*$quantity_decrease2).'</td>
			<td class="center">'.($ModelDecrease['rate_structure']*$quantity_struct).'</td>
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
		<td class="center"><b>'.$sum[0].'</b></td>
		<td class="center"><b>'.$sum[1].'</b></td>
		<td class="center"><b>'.$sum[2].'</b></td>
		<td class="center"><b>'.$sum[4].'</b></td>
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
echo $body;

?>