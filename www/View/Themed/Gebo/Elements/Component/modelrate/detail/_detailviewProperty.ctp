<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=40><center>วรรค</center></th>
			<th rowspan='2' width=40><center>ลำดับ</center></th>
			<th rowspan='2'><center>ตำแหน่ง</center></th>
			<th rowspan='2' width=80><center>ชั้นยศ</center></th>
			<th rowspan='2' width=80><center>เหล่า</center></th>
			<th rowspan='2' width=60><center>ชกท.</center></th>
			<th colspan='5'><center>อัตราระดับความพร้อมรบ</center></th>
			<th rowspan='2' width=80><center>อาวุธ</center></th>
			<th rowspan='2' width=120><center>หมายเหตุ</center></th>
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
	?>
	<?php if(!empty($ModelDivisions)) { ?>
			<?php 

			foreach($ModelDivisions as $key_division => $ModelDivision) {
			$key_division = $key_division + 1;
			?>
			<tr>
				<td><center>0<?php echo $key_division;?></center></td>
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
						<td><center>0<?php echo $key_position;?></center></td>
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
								<td><center>0<?php echo $key_property;?></center></td>
								<td><?php echo $ModelProperty['rank_id']; ?></td>
								<td><?php echo $ModelProperty['corp_id']; ?></td>
								<td><?php echo $ModelProperty['mos']; ?></td>
								<td><?php echo $ModelProperty['rate_full']; ?></td>
								<td><?php echo $ModelProperty['rate_decrease_1']; ?></td>
								<td><?php echo $ModelProperty['rate_decrease_2']; ?></td>
								<td><?php echo $ModelProperty['rate_decrease_3']; ?></td>
								<td><?php echo $ModelProperty['rate_structure']; ?></td>
								<td><?php echo $ModelProperty['weapon_id']; ?></td>
								<td><?php echo $ModelProperty['comment']; ?></td>
							</tr>
							
							<?php } ?>

					<?php } ?>

			<?php } ?>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><b>รวม</b></td>
				<td><b>1</b></td>
				<td><b>1</b></td>
				<td><b>1</b></td>
				<td><b>1</b></td>
				<td><b>1</b></td>
				<td></td>
				<td></td>
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