<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=10><center>วรรค</center></th>
			<th rowspan='2' width=300></th>
			<th rowspan='2'>รหัส - ชื่อยุทโธปกรณ์</th>
			<th width=150><center>อัตราระดับความพร้อมรบ</center></th>
			<th rowspan='2' width=225><center>หมายเหตุ</center></th>
		</tr>
		<tr>
			<th width=40><center>เต็ม<center></th>
		</tr>
	</thead>
	<tbody>
	<?php
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
				<td><?php echo $ModelDivision['ModelDivisionSpecial']['name'];?></td>
				<td></td>
				<td></td>
				<td> <?php echo $ModelDivision['ModelDivisionSpecial']['comment'];?></td>
			</tr>
					<?php
					$ModelEquipments = $ModelDivision['ModelEquipment'];
					foreach($ModelEquipments as $key => $ModelEquipment) {
					?>

					<tr>
						<td></td>
						<td></td>
						<td><center><?php echo !empty($ModelEquipment['ModelEquipment']['equipment_id'])? $Equipments[$ModelEquipment['ModelEquipment']['equipment_id']] : ''; ?><center></td>
						<td><center><?php echo !empty($ModelEquipment['ModelEquipment']['rate_full'])? $ModelEquipment['ModelEquipment']['rate_full'] : 0; ?><center></td>
						<td><?php echo !empty($ModelEquipment['ModelEquipment']['comment'])? $ModelEquipment['ModelEquipment']['comment'] : ''; ?></td>
					</tr>
					
					<?php 
					   $sum_rate_full = $sum_rate_full + $ModelEquipment['rate_full'];
					   $rate_decrease_1 = $rate_decrease_1 + $ModelEquipment['rate_decrease_1'];
					   $rate_decrease_2 = $rate_decrease_2 + $ModelEquipment['rate_decrease_2'];
					   $rate_decrease_3 = $rate_decrease_3 + $ModelEquipment['rate_decrease_3'];
					   $rate_structure = $rate_structure + $ModelEquipment['rate_structure'];											
					} 					
					?>

			<?php } ?>
				
			<tr>
				<td></td>
				<td></td>
				<td><b>รวม</b></td>
				<td><center><b><?php echo $sum_rate_full;?></b><center></td>
				<td></td>
			</tr>

	<?php }else{ ?>
			<tr>
				<td colspan="5" style="text-align:center;">
					ไม่พบข้อมูลที่ตรงกัน
				</td>
			</tr>
	<?php } ?>

	</tbody>
</table>