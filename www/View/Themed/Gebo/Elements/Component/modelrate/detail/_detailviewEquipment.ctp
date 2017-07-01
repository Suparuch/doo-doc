<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=40>วรรค</th>			
			<th rowspan='2' width=40>ลำดับ</th>
			<th rowspan='2'></th>
			<th rowspan='2' width=200>รหัส - ชื่อยุทโธปกรณ์</th>
			<th colspan='5'><center>อัตราระดับความพร้อมรบ</center></th>
			<th rowspan='2' width=200>หมายเหตุ</th>
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

	<?php if(!empty($ModelDivisions)) { ?>
			<?php 
			foreach($ModelDivisions as $key => $ModelDivision) {
			//$model_id = $ModelDivision['ModelDivision']['model_id'];
			//$model_division_id = $ModelDivision['ModelDivision']['id'];
			//$division_id = $ModelDivision['ModelDivision']['division_id'];
			?>
			<tr>
				<td><center><?php echo $key;?></center></td>
				<td></td>
				<td><?php echo $ModelDivision['ModelDivision']['name'];?></td>
				<td colspan="6"></td>
				<td><?php echo $ModelDivision['ModelDivision']['comment'];?></td>
			</tr>
					<?php
					$ModelEquipments = $ModelDivision['ModelEquipment'];
					foreach($ModelEquipments as $key => $ModelEquipment) {
					?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
								<?php 
										echo !empty($ModelEquipment['ModelEquipment']['equipment_id'])? $Equipments[$ModelEquipment['ModelEquipment']['equipment_id']] : ''; 
								?>
						</td>
						<td>
								<?php 
										echo !empty($ModelEquipment['ModelEquipment']['rate_full'])? $ModelEquipment['ModelEquipment']['rate_full'] : 0; 
								?>
						</td>
						<td>
								<?php 
										echo !empty($ModelEquipment['ModelEquipment']['rate_decrease_1'])? $ModelEquipment['ModelEquipment']['rate_decrease_1'] : 0; 
								?>
						</td>
						<td>
								<?php 
										echo !empty($ModelEquipment['ModelEquipment']['rate_decrease_2'])? $ModelEquipment['ModelEquipment']['rate_decrease_2'] : 0; 
								?>
						</td>
						<td>
								<?php 
										echo !empty($ModelEquipment['ModelEquipment']['rate_decrease_3'])? $ModelEquipment['ModelEquipment']['rate_decrease_3'] : 0; 
								?>
						</td>
						<td>
								<?php 
										echo !empty($ModelEquipment['ModelEquipment']['rate_structure'])? $ModelEquipment['ModelEquipment']['rate_structure'] : 0; 
								?>
						</td>
						<td>
								<?php 
										echo !empty($ModelEquipment['ModelEquipment']['comment'])? $ModelEquipment['ModelEquipment']['comment'] : ''; 
								?>
						</td>
						<td></td>
					</tr>
					
					<?php } ?>

			<?php } ?>

			<tr>
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
			</tr>

	<?php }else{ ?>
			<tr>
				<td colspan="11" style="text-align:center;">
					ไม่พบข้อมูลที่ตรงกัน
				</td>
			</tr>
	<?php } ?>

	</tbody>
</table>