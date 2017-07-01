<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabEquipment_1" data-toggle="tab">แบบที่ 1</a></li>
		<li><a href="#tabEquipment_add" data-toggle="tab">+</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabEquipment_1">

			<?php echo $this->Form->create('ModelEquipments', array('action' => 'saveModelEquipment/'.$model_id,'div'=>false,'id' => 'saveModelEquipment'));?>
			<table id="equipmentTable" class="table table-condensed table-bordered">
				<thead>
					<tr>
						<th rowspan='2' width=40>วรรค</th>
						<th rowspan='2' width=40>ลำดับ</th>
						<th rowspan='2'></th>
						<th rowspan='2' width=200>รหัส - ชื่อยุทโธปกรณ์</th>
						<th colspan='5'><center>อัตราระดับความพร้อมรบ</center></th>
						<th rowspan='2' width=200>หมายเหตุ</th>
						<th rowspan='2' width=5> </th>
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
						foreach($ModelDivisions as $key_division => $ModelDivision) {
						$model_id = $ModelDivision['ModelDivision']['model_id'];
						$model_division_id = $ModelDivision['ModelDivision']['id'];
						$division_id = $ModelDivision['ModelDivision']['division_id'];
						$key_division = $key_division + 1;
						?>
						<tr id='division_<?php echo $model_division_id;?>'>
							<td><center>0<?php echo $key_division;?></center></td>
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
									//	'default' => $ModelDivision['ModelDivision']['order_sort']
									//));
								?>
							</td>
							<td>
									<?php
										echo $ModelDivision['ModelDivision']['name'];
									?>
									<i class="splashy-add_small add-Equipment" onclick=addEquipment('<?php echo (string)$model_division_id;?>');></i>
							</td>
							<td colspan="6">
							</td>
							<td>
									<?php
										echo $ModelDivision['ModelDivision']['comment'];
									?>
							</td>
							<td>
								<i class="icon-trash"></i>
							</td>
						</tr>

								<?php
								$ModelEquipments = $ModelDivision['ModelEquipment'];
								foreach($ModelEquipments as $key_equipment => $ModelEquipment) {
								$model_equipment_id = $ModelEquipment['id'];
								?>


								<tr id='division_<?php echo $model_division_id;?>_equipment_<?php echo $model_equipment_id;?>'>
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
											echo $this->Form->hidden($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.equipment_id', array(
												'default' => $ModelEquipment['equipment_id']
											));
											echo $this->Form->hidden($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.order_sort', array(
												'default' => $ModelEquipment['order_sort']
											));
										?>
									</td>
									<td>
									</td>
									<td>
									</td>
									<td>
											<?php
												
												$model_equipment_key = empty($Equipments[$ModelEquipment['equipment_id']])? '' : key($Equipments[$ModelEquipment['equipment_id']]);
												$model_equipment_value = empty($Equipments[$ModelEquipment['equipment_id']])? '' : $Equipments[$ModelEquipment['equipment_id']][$model_equipment_key];
												$model_equipment_name =  empty($model_equipment_key)? '' : $model_equipment_key . ' - ' . $model_equipment_value;
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.name', array(
													//'label' => 'ชื่อ (ย่อ) :',
													'label' => false,
													'div' => false,
													'class' => 'span12',
													'placeholder' => 'รหัส - รายการยุทโธปกรณ์',
													'type' => 'text',
													//'options' => $Corps
													'default' => $model_equipment_name

												));
											?>
									</td>
									<td>
											<?php
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_full', array(
													//'label' => 'ชื่อ (ย่อ) :',
													'label' => false,
													'div' => false,
													'class' => 'span12',
													'placeholder' => 'เต็ม',
													'type' => 'text',
													'default' => $ModelEquipment['rate_full']

												));
											?>
									</td>
									<td>
											<?php
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_decrease_1', array(
													//'label' => 'ชื่อ (ย่อ) :',
													'label' => false,
													'div' => false,
													'class' => 'span12',
													'placeholder' => 'ลด1',
													'type' => 'text',
													'default' => $ModelEquipment['rate_decrease_1']

												));
											?>
									</td>
									<td>
											<?php
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_decrease_2', array(
													//'label' => 'ชื่อ (ย่อ) :',
													'label' => false,
													'div' => false,
													'class' => 'span12',
													'placeholder' => 'ลด2',
													'type' => 'text',
													'default' => $ModelEquipment['rate_decrease_2']

												));
											?>
									</td>
									<td>
											<?php
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_decrease_3', array(
													//'label' => 'ชื่อ (ย่อ) :',
													'label' => false,
													'div' => false,
													'class' => 'span12',
													'placeholder' => 'ลด3',
													'type' => 'text',
													'default' => $ModelEquipment['rate_decrease_3']

												));
											?>
									</td>
									<td>
											<?php
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_structure', array(
													//'label' => 'ชื่อ (ย่อ) :',
													'label' => false,
													'div' => false,
													'class' => 'span12',
													'placeholder' => 'โครง',
													'type' => 'text',
													'default' => $ModelEquipment['rate_structure']

												));
											?>

									</td>
									<td>
											<?php
												echo $this->Form->input($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.comment', array(
													//'label' => 'ชื่อ (ย่อ) :',
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
										<i class="icon-trash"></i>
									</td>
								</tr>
								
								<?php } ?>

						<?php } ?>

								
						<!--
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
						</tr>
						-->

				<?php }else{ ?>
						<tr>
							<td colspan="12" style="text-align:center;">
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