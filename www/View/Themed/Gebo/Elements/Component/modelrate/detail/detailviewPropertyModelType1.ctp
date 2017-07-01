<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=10><center>วรรค</center></th>
			<th rowspan='2' width=10><center>ลำดับ</center></th>
			<th rowspan='2'><center>ตำแหน่ง</center></th>
			<th rowspan='2' width=80><center>ชั้นยศ</center></th>
			<th rowspan='2' width=80><center>เหล่า</center></th>
			<th rowspan='2' width=60><center>ชกท.</center></th>
			<th colspan='5'><center>อัตราระดับความพร้อมรบ</center></th>
			<th rowspan='2' width=80><center>อาวุธ</center></th>
			<th rowspan='2' width=145><center>หมายเหตุ</center></th>
		</tr>
		<tr>
			<th width=40><center>เต็ม</center></th>
			<th width=40><center>ลด 1</center></th>
			<th width=40><center>ลด 2</center></th>
			<th width=40><center>ลด 3</center></th>
			<th width=40><center>โครง</center></th>									
		</tr>
	</thead>
	<tbody>
	<?php
		   $key_division = 0;
		   $key_position = 0;
		   $key_property = 0;

		   $sum_rate_full = 0;
		   $rate_decrease_1 = 0;
		   $rate_decrease_2 = 0;
		   $rate_decrease_3 = 0;
		   $rate_structure = 0;
	?>
	<?php if(!empty($ModelDivisions)) { ?>
			<?php 

			foreach($ModelDivisions as $key_division => $ModelDivision) {
			$key_division = $key_division + 1;
			?>
			<tr>
				<td><center><?php echo str_pad($key_division, 2, '0', STR_PAD_LEFT);?></center></td>
				<td></td>
				<td><?php echo $ModelDivision['ModelDivision']['name']; ?></td>
				<td colspan="9">
				</td>
				<td><?php echo $ModelDivision['ModelDivision']['comment']; ?></td>
			</tr>

					<?php
					$ModelPositions = $ModelDivision['ModelPosition'];
					foreach($ModelPositions as $key_position => $ModelPosition) {

					$model_position_id = $ModelPosition['id'];
					$position_id = $ModelPosition['position_id'];
					$key_position = $key_position + 1;
					?>
					<tr id='position_<?php echo $model_position_id;?>'>
						<td></td>
						<td><center><?php echo str_pad($key_position, 2, '0', STR_PAD_LEFT);?></center></td>
						<td><?php echo $ModelPosition['name']; ?></td>
						<td colspan="9"></td>
						<td><?php echo $ModelPosition['comment']; ?></td>
					</tr>
							<?php
							$ModelProperties = $ModelPosition['ModelProperty'];
							foreach($ModelProperties as $key_property => $ModelProperty) {
							$key_property = $key_property + 1;
							?>

							<tr>
								<td></td>
								<td></td>
								<td><center><?php echo str_pad($key_property, 2, '0', STR_PAD_LEFT);?></center></td>
								<td><center><?php echo empty($Ranks[$ModelProperty['rank_id']])? '':$Ranks[$ModelProperty['rank_id']]; ?></center></td>
								<td><center><?php echo empty($Corps[$ModelProperty['corp_id']])? '':$Corps[$ModelProperty['corp_id']]; ?></center></td>
								<td><center><?php echo $ModelProperty['mos']; ?></center></td>
								<td><center><?php echo $ModelProperty['rate_full']; ?></center></td>
								<td><center><?php echo $ModelProperty['rate_decrease_1']; ?></center></td>
								<td><center><?php echo $ModelProperty['rate_decrease_2']; ?></center></td>
								<td><center><?php echo $ModelProperty['rate_decrease_3']; ?></center></td>
								<td><center><?php echo $ModelProperty['rate_structure']; ?></center></td>
								<td><center><?php echo empty($Weapons[$ModelProperty['weapon_id']])? '':$Weapons[$ModelProperty['weapon_id']]; ?></center></td>
								<td><?php echo $ModelProperty['comment']; ?></td>
							</tr>
							
							<?php 
							   $sum_rate_full = $sum_rate_full + $ModelProperty['rate_full'];
							   $rate_decrease_1 = $rate_decrease_1 + $ModelProperty['rate_decrease_1'];
							   $rate_decrease_2 = $rate_decrease_2 + $ModelProperty['rate_decrease_2'];
							   $rate_decrease_3 = $rate_decrease_3 + $ModelProperty['rate_decrease_3'];
							   $rate_structure = $rate_structure + $ModelProperty['rate_structure'];							
							} ?>

					<?php } ?>

			<?php } ?>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><center><b>รวม</b></center></td>
				<td></td>
				<td></td>
				<td><center><b><?php echo $sum_rate_full;?></b><center></td>
				<td><center><b><?php echo $rate_decrease_1;?></b><center></td>
				<td><center><b><?php echo $rate_decrease_2;?></b><center></td>
				<td><center><b><?php echo $rate_decrease_3;?></b><center></td>
				<td><center><b><?php echo $rate_structure;?></b><center></td>
				<td></td>
				<td></td>
			</tr>

	<?php }else{ ?>
			<tr id='division_0'>
				<td colspan="13" style="text-align:center;">
					ไม่พบข้อมูลที่ตรงกัน
				</td>
			</tr>
	<?php } ?>

	</tbody>
</table><br>
<script language='javascript'>
function modalAction2(){
$(".close").trigger( "click" );

}
</script>