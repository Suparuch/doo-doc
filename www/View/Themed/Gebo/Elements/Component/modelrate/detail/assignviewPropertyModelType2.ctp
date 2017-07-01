<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=10><center>วรรค</center></th>
			<th rowspan='2' width=60><center>วรรคย่อย</center></th>
			<th rowspan='2' width=10><center>ลำดับ</center></th>
			<th rowspan='2'><center>ตำแหน่ง</center></th>
			<th rowspan='2' width=80><center>ชั้นยศ</center></th>
			<th rowspan='2' width=80><center>เหล่า</center></th>
			<th rowspan='2' width=60><center>ชกท.</center></th>
			<th width=150><center>อัตราระดับความพร้อมรบ</center></th>
			<th rowspan='2' width=145><center>หมายเหตุ</center></th>
		</tr>
		<tr>
			<th><center>เต็ม</center></th>							
		</tr>
	</thead>
	<tbody>
	<?php
		   $key_division = 0;
		   $key_subdivision = 0;
		   $key_position = 0;
		   $key_property = 0;
		   $sum_rate_full = 0;
		   $ModelDivisions = $ModelDivisionSpecialProperties;

		   if(!empty($ModelDivisions)) { 
			
			foreach($ModelDivisions as $key_division => $ModelDivision) {
			$key_division = $key_division + 1;
			?>
			<tr>
				<td><center><?php echo str_pad($key_division, 2, '0', STR_PAD_LEFT);?></center></td>
				<td></td>
				<td></td>
				<td><?php echo $ModelDivision['ModelDivisionSpecialProperty']['name']; ?></td>
				<td colspan="4">
				</td>
				<td><?php echo $ModelDivision['ModelDivisionSpecialProperty']['comment']; ?></td>
			</tr>

					<?php
					$ModelSubDivisions = $ModelDivision['ModelSubDivision'];
					if(!empty($ModelSubDivisions)){
						foreach($ModelSubDivisions as $key_subdivision => $ModelSubDivision) {

						$key_subdivision = $key_subdivision + 1;
					?>
						<tr>
							<td></td>
							<td><center><?php echo str_pad($key_subdivision, 2, '0', STR_PAD_LEFT);?></center></td>
							<td></td>
							<td><?php echo $ModelSubDivision['name']; ?></td>
							<td colspan="4"></td>
							<td><?php echo $ModelSubDivision['comment']; ?></td>
						</tr>

							<?php
							$ModelPositions = empty($ModelSubDivision['ModelPosition'])? '' : $ModelSubDivision['ModelPosition'];
							if(!empty($ModelPositions)){

								foreach($ModelPositions as $key_position => $ModelPosition) {
								$key_position = $key_position + 1;
							?>
								<tr>
									<td></td>
									<td></td>
									<td><center><?php echo str_pad($key_position, 2, '0', STR_PAD_LEFT);?></center></td>
									<td><?php echo $ModelPosition['name']; ?></td>
									<td colspan="4"></td>
									<td><?php echo $ModelPosition['comment']; ?></td>
								</tr>
										<?php
										$ModelProperties = empty($ModelPosition['ModelProperty'])? '' : $ModelPosition['ModelProperty'];
										if(!empty($ModelProperties)){

											foreach($ModelProperties as $key_property => $ModelProperty) {
											$key_property = $key_property + 1;
										?>

											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td><center><?php echo str_pad($key_property, 2, '0', STR_PAD_LEFT);?></center></td>
												<td><center><?php echo empty($Ranks[$ModelProperty['rank_id']])? '':$Ranks[$ModelProperty['rank_id']]; ?></center></td>
												<td><center><?php echo empty($Corps[$ModelProperty['corp_id']])? '':$Corps[$ModelProperty['corp_id']]; ?></center></td>
												<td><center><?php echo $ModelProperty['mos']; ?></center></td>
												<td><center><?php echo $ModelProperty['rate_full']; ?></center></td>
												<td><?php echo $ModelProperty['comment']; ?></td>
											</tr>
										
										<?php 
											$sum_rate_full = $sum_rate_full + $ModelProperty['rate_full'];
											}
										}
										?>

								<?php } ?>
							<?php } ?>

						<?php } ?>
					<?php } ?>

			<?php } ?>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><center><b>รวม</b></center></td>
				<td></td>
				<td></td>
				<td><center><b><?php echo $sum_rate_full;?></b><center></td>
				<td></td>
			</tr>

	<?php }else{ ?>
			<tr id='division_0'>
				<td colspan="9" style="text-align:center;">
					ไม่พบข้อมูลที่ตรงกัน
				</td>
			</tr>
	<?php } ?>

	</tbody>
</table><br>