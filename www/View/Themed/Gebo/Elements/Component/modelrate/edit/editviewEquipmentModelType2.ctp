<div class="tabbable" id="tabEquipment">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabEquipment_1" data-toggle="tab">แบบที่ 1</a></li>
		<li><a href="#tabEquipment_add" data-toggle="tab" id="addGroupEquipment">+</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabEquipment_1">

			<?php echo $this->Form->create('ModelEquipments', array('action' => 'saveModelEquipment/'.$model_id,'div'=>false,'id' => 'saveModelEquipment'));?>
			<table id="equipmentTable" class="table table-condensed table-bordered">
				<thead>
					<tr>
						<th rowspan='2' width=10>วรรค</th>
						<th rowspan='2' width=300></th>
						<th rowspan='2' width=10>ลำดับ</th>
						<th rowspan='2'>รหัส - ชื่อยุทโธปกรณ์</th>
						<th width=150><center>อัตราระดับความพร้อมรบ</center></th>
						<th rowspan='2' width=200><center>หมายเหตุ</center></th>
						<th rowspan='2' width=5> </th>
					</tr>
					<tr>
						<th><center>เต็ม<center></th>
					</tr>
				</thead>
				<tbody>
				<?php $key_division = 0;?>
				<?php if(!empty($ModelDivisionEquipments)) { ?>
						<?php						
						foreach($ModelDivisionEquipments as $key_division => $ModelDivisionEquipment) {
						$model_id = $ModelDivisionEquipment['ModelDivisionEquipment']['model_id'];
						$model_division_id = $ModelDivisionEquipment['ModelDivisionEquipment']['id'];
						$division_id = $ModelDivisionEquipment['ModelDivisionEquipment']['division_id'];
						$key_division = $key_division + 1;
						?>
						<tr id='section2division_<?php echo $model_division_id;?>'>
							<td><center><?php echo str_pad($key_division, 2, '0', STR_PAD_LEFT);?></center></td>
							<td>
									<?php
										echo $this->Form->hidden($model_division_id.'.ModelDivision.id', array(
											'default' => $model_division_id
										));
										echo $this->Form->hidden($model_division_id.'.ModelDivision.division_id', array(
											'default' => $division_id
										));
										//echo $this->Form->hidden($model_division_id.'.ModelDivision.model_id', array(
										//	'default' => $model_id
										//));
										//echo $this->Form->hidden($model_division_id.'.ModelDivision.order_sort', array(
										//	'default' => $ModelDivisionEquipment['ModelDivisionEquipment']['order_sort']
										//));
									?>
									<?php
										echo $this->Form->input($model_division_id.'.ModelDivision.name', array(
											'label' => false,
											'div' => false,
											'class' => 'span11 model_division',
											'placeholder' => 'วรรค',
											'default' => $ModelDivisionEquipment['ModelDivisionEquipment']['name'],
											'onkeyup' => 'return modelDivisionKeyup(this,event)'
										));
									?>
									<i class="splashy-add_small add-Equipment" onclick=addEquipment('<?php echo (string)$model_division_id;?>');></i>
							</td>
							<td></td>
							<td colspan="2"></td>
							<td>
									<?php
										echo $this->Form->input($model_division_id.'.ModelDivision.comment', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'type' => 'text',
											'placeholder' => 'หมายเหตุ',
											'default' => $ModelDivisionEquipment['ModelDivisionEquipment']['comment']
										));
									?>
							</td>
							<td>
								<i class="icon-trash"></i>
							</td>
						</tr>

								<?php
								$ModelEquipments = $ModelDivisionEquipment['ModelEquipment'];
								foreach($ModelEquipments as $key_equipment => $ModelEquipment) {
								$model_equipment_id = $ModelEquipment['id'];
								$key_equipment++;
								?>

								<tr id='section2division_<?php echo $model_division_id;?>_equipment_<?php echo $model_equipment_id;?>'>
									<td></td>
									<td>
										<?php
											echo $this->Form->hidden($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.id', array(
												'default' => $model_equipment_id
											));
											echo $this->Form->hidden($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.model_id', array(
												'default' => $model_id
											));
											echo $this->Form->hidden($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.model_division_id', array(
												'default' => $model_division_id
											));
											echo $this->Form->hidden($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.model_equipment_id', array(
												'default' => $model_equipment_id
											));
											//echo $this->Form->hidden($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.order_sort', array(
											//	'default' => $ModelEquipment['order_sort']
											//));
											echo $this->Form->hidden($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.equipment_id', array(
												'default' => $ModelEquipment['equipment_id']
											));
										?>
									</td>
									<td>
											<?php
												
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.order_sort', array(
													'label' => false,
													'div' => false,
													'class' => 'span12',
													'placeholder' => 'ลำดับ',
													'type' => 'text',
													//'default' => $ModelEquipment['order_sort'],
													'default' => $key_equipment,
													'onkeypress' => 'return keyNumberEng(event)'
												));
											?>
									</td>
									<td>
											<?php
												
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.equipment_code', array(
													'label' => false,
													'div' => false,
													'class' => ' model_equipment',
													//'placeholder' => 'รหัส - รายการยุทโธปกรณ์',
													'placeholder' => 'รหัสยุทโธปกรณ์',
													'type' => 'text',
													'default' => $ModelEquipment['equipment_code'],
													'onkeyup' => 'return modelEquipmentKeyup(this,event)',
													'onfocus' => 'return modelEquipmentCodeFocus(this,event)',
													'onchange' => 'return modelEquipmentCodeFocus(this,event)',
													'onblur' => 'return modelEquipmentCodeFocus(this,event)'
												));
											?>
                                            
                                            -
                                            
											<?php
												
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.equipment_name', array(
													'label' => false,
													'div' => false,
													'class' => ' model_equipment',
													//'placeholder' => 'รหัส - รายการยุทโธปกรณ์',
													'placeholder' => 'รายการยุทโธปกรณ์',
													'type' => 'text',
													'default' => $ModelEquipment['equipment_name'],
													'onkeyup' => 'return modelEquipmentKeyup(this,event)',
													'onfocus' => 'return modelEquipmentFocus(this,event)',
													'onchange' => 'return modelEquipmentFocus(this,event)',
													'onblur' => 'return modelEquipmentFocus(this,event)'
												));
											?>
									</td>
									<td>	<center>
											<?php
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_full', array(
													'label' => false,
													'div' => false,
													'class' => 'span3',
													'placeholder' => 'เต็ม',
													'type' => 'text',
													'default' => $ModelEquipment['rate_full'],
													'onkeypress' => 'return keyNumberEng(event)'
												));
											?>
											</center>

									</td>
									<td>
										<?php
											echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.comment', array(
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'หมายเหตุ',
												'type' => 'text',
												'default' => $ModelEquipment['comment']
											));
										?>
									</td>
									<td>
										<i class="icon-trash" onclick=deleteItem('equipment','<?php echo (string)$model_equipment_id;?>','<?php echo (string)$model_division_id;?>');></i>
									</td>
								</tr>
								
								<?php } ?>

						<?php } ?>
								
				<?php }else{ ?>
						<tr>
							<td colspan="7" style="text-align:center;">
								ไม่พบข้อมูลที่ตรงกัน
							</td>
						</tr>
				<?php } ?>

				</tbody>
			</table>
			<?php echo $this->Form->end(); ?>

		</div>
		<div class="tab-pane" id="tabEquipment_add">

		</div>
	</div>
</div>
<a id='addDivision' class="btn btn-small" onclick=addDivisionEquipment(); key_division=<?php echo $key_division ?>>เพิ่มวรรค</a>
<?php echo $this->element('Component/modelrate/edit/blank');?>