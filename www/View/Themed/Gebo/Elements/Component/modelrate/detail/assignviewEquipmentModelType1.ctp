<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=10>วรรค</th>			
			<th rowspan='2' width=300></th>
			<th rowspan='2' width=10>ลำดับ</th>
			<th rowspan='2'>รหัส - ชื่อยุทโธปกรณ์</th>
			<th colspan='5'><center>อัตราระดับความพร้อมรบ</center></th>
			<th rowspan='2' width=225><center>หมายเหตุ</center></th>
		</tr>
		<tr>
			<th width=40><center>เต็ม<center></th>
			<th width=40><center>ลด 1</center></th>
			<th width=40><center>ลด 2</center></th>
			<th width=40><center>ลด 3</center></th>
			<th width=40><center>โครง</center></th>
		</tr>
	</thead>
	<tbody>
	<?php
		   $sum_rate_full = 0;
		   $rate_decrease_1 = 0;
		   $rate_decrease_2 = 0;
		   $rate_decrease_3 = 0;
		   $rate_structure = 0;
		   $ModelDivisionName = empty($KeyModelDivisionName)? 'ModelDivision':$KeyModelDivisionName;

	?>	
	<?php if(!empty($ModelDivisions)) { ?>
			<?php 
			foreach($ModelDivisions as $key_division => $ModelDivision) {
			$key_division = $key_division + 1;
			?>
			<tr>
				<td><center><?php echo str_pad($key_division, 2, '0', STR_PAD_LEFT);?></center></td>				
				<td> <?php echo $ModelDivision[$ModelDivisionName]['name'];?></td>
				<td></td>
				<td colspan="6"></td>
				<td> <?php echo $ModelDivision[$ModelDivisionName]['comment'];?></td>
			</tr>
					<?php
					$ModelEquipments = $ModelDivision['ModelEquipment'];
					foreach($ModelEquipments as $key_equipment => $ModelEquipment) {
					$key_equipment = $key_equipment + 1;
					?>

					<tr>
						<td></td>
						<td></td>
						<td><center><?php echo str_pad($key_equipment, 2, '0', STR_PAD_LEFT);?></center></td>
						<td><?php echo $ModelEquipment['equipment_code'];?> - <?php echo $ModelEquipment['equipment_name'];?></td>
						<td><center><?php echo !empty($ModelEquipment['rate_full'])? $ModelEquipment['rate_full'] : 0; ?><center></td>
						<td><center><?php echo !empty($ModelEquipment['rate_decrease_1'])? $ModelEquipment['rate_decrease_1'] : 0; ?><center></td>
						<td><center><?php echo !empty($ModelEquipment['rate_decrease_2'])? $ModelEquipment['rate_decrease_2'] : 0; ?><center></td>
						<td><center><?php echo !empty($ModelEquipment['rate_decrease_3'])? $ModelEquipment['rate_decrease_3'] : 0; ?><center></td>
						<td><center><?php echo !empty($ModelEquipment['rate_structure'])? $ModelEquipment['rate_structure'] : 0; ?><center></td>
						<td><?php echo !empty($ModelEquipment['comment'])? $ModelEquipment['comment'] : ''; ?></td>					
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
				<td></td>
				<td><b>รวม</b></td>				
				<td><center><b><?php echo $sum_rate_full;?></b><center></td>
				<td><center><b><?php echo $rate_decrease_1;?></b><center></td>
				<td><center><b><?php echo $rate_decrease_2;?></b><center></td>
				<td><center><b><?php echo $rate_decrease_3;?></b><center></td>
				<td><center><b><?php echo $rate_structure;?></b><center></td>
				<td></td>
			</tr>

	<?php }else{ ?>
			<tr>
				<td colspan="10" style="text-align:center;">
					ไม่พบข้อมูลที่ตรงกัน
				</td>
			</tr>
	<?php } ?>

	</tbody>
</table>