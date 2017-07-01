<table class="table table-bordered">
	<tbody>
	<tr>
		<td width=150><b><?php echo __('หมายเลข อจย.');?> : </b></td>
		<!--<td><?php echo $Organizations['OrganizationNew']['model_id']?></td>-->
		<td><?php 
			if (!empty($ModelRate['ModelRate'])) echo $ModelRate['ModelRate']['code'] . ' [ ' .$ModelRate['ModelRate']['name'] . ' ] ';
		?></td>
	</tr>
	<tr>
		<td><b><?php echo __('วันที่ อจย.');?><b></td>
		<td><?php 
			if (!empty($ModelRate['ModelRate'])) echo empty($ModelRate['ModelRate']['model_date'])? '':$this->DateFormat->formatDateThai($ModelRate['ModelRate']['model_date']);
		?></td>
	</tr>
	<!--
	<tr>
		<td><b><?php echo __('รหัสหน่วย [Unit ID]');?></b></td>
		<td><?php echo $Organizations['OrganizationNew']['code']?></td>
	</tr>
	-->
	<tr>
		<td><b><?php echo __('นามหน่วย');?></b></td>
		<td><?php echo $Organizations['OrganizationNew']['name']?></td>
	</tr>
	<tr>
		<td><b><?php echo __('นามหน่วยย่อ');?></b></td>
		<td><?php echo $Organizations['OrganizationNew']['short_name']?></td>
	</tr>
	<tr>
		<td><b><?php echo __('วันที่จัดตั้ง ');?></b></td>
		<td><?php echo empty($Organizations['OrganizationNew']['establish_date'])? '':$this->DateFormat->formatDateThai($Organizations['OrganizationNew']['establish_date']);?></td>
	</tr>
	<tr>
		<td><b><?php echo __('วันที่แปรสภาพ ');?></b></td>
		<td><?php echo empty($Organizations['OrganizationNew']['reorganize_date'])? '':$this->DateFormat->formatDateThai($Organizations['OrganizationNew']['reorganize_date']);?></td>
	</tr>
	<tr>
		<td><b><?php echo __('คำสั่งที่');?></b></td>
		<td><?php echo $Organizations['OrganizationNew']['command']?></td>
	</tr>
	<tr>
		<td><b><?php echo __('ลงวันที่ ');?></b></td>
		<td><?php echo empty($Organizations['OrganizationNew']['command_date'])? '':$this->DateFormat->formatDateThai($Organizations['OrganizationNew']['command_date']);?></td>
	</tr>
	<tr>
		<td><b><?php echo __('ชนิดหน่วย ');?></b></td>
		<td><?php echo empty($Organizations['OrganizationNew']['organization_type_id'])? '':$OrganizationType['OrganizationType']['name'];?></td>
	</tr>
	<tr>
		<td><b><?php echo __('ที่ตั้งหน่วย (ปกติ)');?></b></td>
		<td>
			<?php 
				if(!empty($District['District']['name'])){
					echo __('ตำบล/แขวง (เพิ่มเติม) : ');
					echo $District['District']['name'];
				}

				if(!empty($Zone['Zone']['name'])){
					echo __('   อำเภอ/เขต ');
					echo $Zone['Zone']['name'];
				}

				if(!empty($Province['Province']['name'])){
					echo __('   จังหวัด ');
					echo $Province['Province']['name'];
				}
			?>
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('ชื่อค่ายที่หน่วยตั้งอยู่ ');?></b></td>
		<td>
		<?php 
			if(!empty($Organizations['OrganizationNew']['barrack_id'])){
				echo $Barrack['Barrack']['name'];
			}
		?>	
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('หน่วยเป้าหมาย ระดับ ');?></b></td>
		<td><?php echo empty($Organizations['OrganizationNew']['organization_target_id'])? '':$OrganizationTarget['OrganizationTarget']['name'];?></td>
	</tr>
	<tr>
		<td><b><?php echo __('หมายเหตุ ');?></b></td>
		<td><?php echo $Organizations['OrganizationNew']['description']?></td>
	</tr>
	<tr>
		<td colspan=2><center><b><?php echo __('หน่วยเหนือ');?></b></center></td>
	</tr>

	<?php
		$max_level = (empty($OrganizationStructures['OrganizationStructure']['max_level'])?"0":$OrganizationStructures['OrganizationStructure']['max_level']);
		$run_level = $max_level - 2;
		//pr($OrganizationStructures['OrganizationStructure']);
		//$max_level = 3;
		for($level=0;$level <= $max_level;$level++){
	?>
	<tr>
		<td><b><?php echo __('หน่วยเหนือระดับที่ '.($level+1).' ');?></b></td>
		<td><?php echo empty($OrganizationStructures['OrganizationStructure']['level_'.$run_level])? '':$OrganizationAlls[$OrganizationStructures['OrganizationStructure']['level_'.$run_level]];?></td>
	</tr>
	<?
		$run_level--;
		}
	?>

	</tbody>
</table>