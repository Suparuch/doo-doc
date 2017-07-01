<table class="table table-bordered">
	<tbody>
	<tr>
		<td width=150><b><?php echo __('หมายเลข อจย./อฉก.');?> : </b></td>
		<!--<td><?php echo $Organizations['Organization']['model_id']?></td>-->
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
		<td><?php echo $Organizations['Organization']['code']?></td>
	</tr>
	-->
	<tr>
		<td><b><?php echo __('นามหน่วย');?></b></td>
		<td><?php echo $Organizations['Organization']['name']?></td>
	</tr>
	<tr>
		<td><b><?php echo __('นามหน่วยย่อ');?></b></td>
		<td><?php echo $Organizations['Organization']['short_name']?></td>
	</tr>
	<tr>
		<td><b><?php echo __('วันที่จัดตั้ง ');?></b></td>
		<td><?php echo empty($Organizations['Organization']['establish_date'])? '':$this->DateFormat->formatDateThai($Organizations['Organization']['establish_date']);?></td>
	</tr>
	<tr>
		<td><b><?php echo __('วันที่แปรสภาพ ');?></b></td>
		<td><?php echo empty($Organizations['Organization']['reorganize_date'])? '':$this->DateFormat->formatDateThai($Organizations['Organization']['reorganize_date']);?></td>
	</tr>
	<tr>
		<td><b><?php echo __('คำสั่งที่');?></b></td>
		<td><?php echo $Organizations['Organization']['command']?></td>
	</tr>
	<tr>
		<td><b><?php echo __('ลงวันที่ ');?></b></td>
		<td><?php echo empty($Organizations['Organization']['command_date'])? '':$this->DateFormat->formatDateThai($Organizations['Organization']['command_date']);?></td>
	</tr>
	<tr>
		<td><b><?php echo __('ชนิดหน่วย ');?></b></td>
		<td><?php echo empty($Organizations['Organization']['organization_type_id'])? '':$OrganizationType['OrganizationType']['name'];?></td>
	</tr>
	<tr>
		<td><b><?php echo __('ที่ตั้งหน่วย (ปกติ)');?></b></td>
		<td>
			<?php 
				echo $Organizations['Organization']['address'];
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
			if(!empty($Organizations['Organization']['barrack_id'])){
				echo $Barrack['Barrack']['name'];
			}
		?>	
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('หน่วยเป้าหมาย ระดับ ');?></b></td>
		<td><?php echo empty($Organizations['Organization']['organization_target_id'])? '':$OrganizationTarget['OrganizationTarget']['name'];?></td>
	</tr>
	<tr>
		<td><b><?php echo __('หมายเหตุ ');?></b></td>
		<td><?php echo $Organizations['Organization']['description']?></td>
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
if(! empty($OrganizationStructures['OrganizationStructure']['level_'.$run_level])){
	?>
	<tr>
		<td><b><?php echo __('หน่วยเหนือระดับที่ '.($level+1).' ');?></b></td>
		<td><?php echo empty($OrganizationStructures['OrganizationStructure']['level_'.$run_level])? '':$OrganizationAlls[$OrganizationStructures['OrganizationStructure']['level_'.$run_level]];?></td>
	</tr>
	<?
		$run_level--;
}
		}
	?>

	</tbody>
</table>