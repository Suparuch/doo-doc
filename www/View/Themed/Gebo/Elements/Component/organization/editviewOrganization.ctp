<form name="editForm" id="editForm" action="update/<?php echo $Organizations['Organization']['id']?>" method="post">
<table class="table table-bordered">
	<tbody>
	<tr>
		<td width=150><b><?php echo __('หมายเลข อจย.');?> : </b></td>
		<td>
			<?php
				echo $this->Form->input('model_id', array(
				'label' => false,
				'div' => false,
				'class' => 'span12',
				'options' => $ModelRates,
				'empty' => '- - - เลือก - - - ',
				'default' => empty($Organizations['Organization']['model_id'])? '':$Organizations['Organization']['model_id'],
			))
			?> 	
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('วันที่ อจย.');?><b></td>
		<td><?php echo empty($ModelRate['ModelRate']['model_date'])? '':$this->DateFormat->formatDateThai($ModelRate['ModelRate']['model_date']);?></td>
	</tr>
	<!--
	<tr>
		<td><b><?php echo __('รหัสหน่วย [Unit ID]');?></b></td>
		<td><?php echo $Organizations['Organization']['code']?></td>
	</tr>
	-->
	<tr>
		<td><b><?php echo __('นามหน่วย');?></b></td>
		<td>
			<?php
				echo $this->Form->input('name', array(
					'label' => false,
					'div' => false,
					'class' => 'span12',
					'placeholder' => 'นามหน่วย',
					'default' => empty($Organizations['Organization']['name']) ? '' : $Organizations['Organization']['name']
				));
			?>
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('นามหน่วยย่อ');?></b></td>
		<td>
			<?php
				echo $this->Form->input('short_name', array(
					'label' => false,
					'div' => false,
					'class' => 'span12',
					'placeholder' => 'นามหน่วยย่อ',
					'default' => empty($Organizations['Organization']['short_name']) ? '' : $Organizations['Organization']['short_name']
				));
			?>
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('วันที่จัดตั้ง ');?></b></td>
		<td>
			<?php echo $this->Form->day('establish_date',array('class'=>'input-mini','empty' => 'วัน','default' => empty($Organizations['Organization']['establish_date']) ? '' : $this->DateFormat->getDay($Organizations['Organization']['establish_date'])));?>
			<?php
				echo $this->Form->input('establish_date.month', array(
					'label' => false,
					'div' => false,
					'class' => 'input-thaimonth',
					'options' => $Months,
					'empty' => '- - - เลือก - - - ',
					'default' => empty($Organizations['Organization']['establish_date']) ? '' : $this->DateFormat->getMonth($Organizations['Organization']['establish_date'])
				));
			?>
			<?php
				echo $this->Form->input('establish_date.year', array(
					'label' => false,
					'div' => false,
					'class' => 'input-thaiyear',
					'options' => $Years,
					'empty' => 'ปี',
					'default' => empty($Organizations['Organization']['establish_date']) ? '' : $this->DateFormat->getYear($Organizations['Organization']['establish_date'])
				));
			?>
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('วันที่แปรสภาพ ');?></b></td>
		<td>
			<?php echo $this->Form->day('reorganize_date',array('class'=>'input-mini','empty' => 'วัน','default' => empty($Organizations['Organization']['reorganize_date']) ? '' : $this->DateFormat->getDay($Organizations['Organization']['reorganize_date'])));?>
			<?php
				echo $this->Form->input('reorganize_date.month', array(
					'label' => false,
					'div' => false,
					'class' => 'input-thaimonth',
					'options' => $Months,
					'empty' => '- - - เลือก - - - ',
					'default' => empty($Organizations['Organization']['reorganize_date']) ? '' : $this->DateFormat->getMonth($Organizations['Organization']['reorganize_date'])
				));
			?>
			<?php
				echo $this->Form->input('reorganize_date.year', array(
					'label' => false,
					'div' => false,
					'class' => 'input-thaiyear',
					'options' => $Years,
					'empty' => 'ปี',
					'default' => empty($Organizations['Organization']['reorganize_date']) ? '' : $this->DateFormat->getYear($Organizations['Organization']['reorganize_date'])
				));
			?>
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('คำสั่งที่');?></b></td>
		<td>
			<?php
				echo $this->Form->input('command', array(
					'label' => false,
					'div' => false,
					'class' => 'span3',
					'placeholder' => 'คำสั่งที่',
					'default' => empty($Organizations['Organization']['command']) ? '' : $Organizations['Organization']['command']
				));
			?>
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('ลงวันที่ ');?></b></td>
		<td>
			<?php echo $this->Form->day('command_date',array('class'=>'input-mini','empty' => 'วัน','default' => empty($Organizations['Organization']['command_date']) ? '' : $this->DateFormat->getDay($Organizations['Organization']['command_date'])));?>
			<?php
				echo $this->Form->input('command_date.month', array(
					'label' => false,
					'div' => false,
					'class' => 'input-thaimonth',
					'options' => $Months,
					'empty' => '- - - เลือก - - - ',
					'default' => empty($Organizations['Organization']['command_date']) ? '' : $this->DateFormat->getMonth($Organizations['Organization']['command_date'])
				));
			?>
			<?php
				echo $this->Form->input('command_date.year', array(
					'label' => false,
					'div' => false,
					'class' => 'input-thaiyear',
					'options' => $Years,
					'empty' => 'ปี',
					'default' => empty($Organizations['Organization']['command_date']) ? '' : $this->DateFormat->getYear($Organizations['Organization']['command_date'])
				));
			?>
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('ชนิดหน่วย ');?></b></td>
		<td>
		<?php
			echo $this->Form->input('organization_type_id', array(
			'label' => false,
			'div' => false,
			'class' => '',
			'options' => $OrganizationTypes,
			'empty' => '- - - เลือก - - - ',
			'default' => empty($Organizations['Organization']['organization_type_id'])? '':$Organizations['Organization']['organization_type_id'],
		))
		?>					
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('ที่ตั้งหน่วย (ปกติ)');?></b></td>
		<td>
			<table>
				<tr>

					<td><?php echo __('จังหวัด');?> :: </td>
					<td>
						<?php
							echo $this->Form->input('province_id', array(
							'label' => false,
							'div' => false,
							'class' => 'input-province',
							'id' => 'province_id',
							'options' => $Province,
							'empty' => '- - - เลือก - - - ',
							'onchange' => "provinceChange(this.value,'')",
							'default' => empty($Organizations['Organization']['province_id'])? '':$Organizations['Organization']['province_id'],
						))
						?>
					</td>
				</tr>
				<tr>
					<td><?php echo __('อำเภอ/เขต');?> :: </td>
					<td>
						<?php
							echo $this->Form->input('zone_id', array(
							'label' => false,
							'div' => false,
							'class' => 'input-zone',
							'id' => 'zone_id',
							'options' => $Zone,
							'empty' => '- - - เลือก - - - ',
							'onchange' => "zoneChange(this.value,'')",
							'default' => empty($Organizations['Organization']['zone_id'])? '':$Organizations['Organization']['zone_id'],
						))
						?>
					</td>
				</tr>
				<tr>
					<td><?php echo __('ตำบล/แขวง (เพิ่มเติม)');?> :: </td>
					<td>
						<?php
							echo $this->Form->input('district_id', array(
							'label' => false,
							'div' => false,
							'class' => 'input-district',
							'id' => 'district_id',
							'options' => $District,
							'empty' => '- - - เลือก - - - ',
							//'onchange' => "zoneChange(this.value,'')",
							'default' => empty($Organizations['Organization']['district_id'])? '':$Organizations['Organization']['district_id'],
						))
						?>
					</td>
				</tr>
<tr>
					<td><?php echo __('ที่อยู่');?> :: </td>
					<td>
						<?php
				echo $this->Form->input('address', array(
					'label' => false,
					'div' => false,
					'placeholder' => 'ที่อยู่',
					'default' => empty($Organizations['Organization']['address']) ? '' : $Organizations['Organization']['address']
				));
			?>
					</td>
				</tr>


			</table>
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('ชื่อค่ายที่หน่วยตั้งอยู่ ');?></b></td>
		<td>
		<?php
			echo $this->Form->input('barrack_id', array(
			'label' => false,
			'div' => false,
			'class' => '',
			'options' => $Barracks,
			'empty' => '- - - เลือก - - - ',
			'default' => empty($Organizations['Organization']['barrack_id'])? '':$Organizations['Organization']['barrack_id'],
		))
		?>			
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('หน่วยเป้าหมาย ระดับ ');?></b></td>
		<td>
		<?php
			echo $this->Form->input('organization_target_id', array(
			'label' => false,
			'div' => false,
			'class' => '',
			'options' => $OrganizationTargets,
			'empty' => '- - - เลือก - - - ',
			'default' => empty($Organizations['Organization']['organization_target_id'])? '':$Organizations['Organization']['organization_target_id'],
		))
		?>	
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('หมายเหตุ ');?></b></td>
		<td>
			<textarea name="data[description]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder="หมายเหตุ"><?php echo empty($Organizations['Organization']['description']) ? '' : $Organizations['Organization']['description'];?></textarea>
		</td>
	</tr>
	<!--
	<tr>
		<td colspan=2><center><b><?php echo __('หน่วยเหนือ');?></b></center></td>
	</tr>
	<?php
		//$max_level = $OrganizationStructures['OrganizationStructure']['max_level'];
		$max_level = 3;
		for($level=0;$level <= $max_level;$level++){
	?>
	<tr>
		<td><b><?php echo __('หน่วยเหนือระดับที่ '.($level+1).' ');?></b></td>
		<td>
		<?php
			echo $this->Form->input('organization_target_id', array(
			'label' => false,
			'div' => false,
			'class' => '',
			'options' => $OrganizationAlls,
			'empty' => '- - - เลือก - - - ',
			'default' => empty($OrganizationStructures['OrganizationStructure']['level_'.$level])? '':$OrganizationStructures['OrganizationStructure']['level_'.$level],
		))
		?>
		</td>
	</tr>
	<?}?>
	-->

	</tbody>
</table>
<br>
</form>

<input type="submit" value="บันทึก" id="submitFrom" class="btn btn-primary" onclick="updateOrganization('<?php echo $Organizations['Organization']['id']?>');">
<!--<input type="button" value="ยกเลิก" class="btn btn-danger">-->