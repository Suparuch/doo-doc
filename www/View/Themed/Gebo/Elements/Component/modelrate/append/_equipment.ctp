					<tr id='division_<?php echo $model_division_id;?>_equipment_<?php echo $model_equipment_id;?>'>
						<td></td>
						<td>
							<?php
								echo $this->Form->hidden('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.id', array(
									'default' => $model_equipment_id
								));
								echo $this->Form->hidden('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.model_id', array(
									'default' => $model_id
								));
								echo $this->Form->hidden('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.model_division_id', array(
									'default' => $model_division_id
								));
								echo $this->Form->hidden('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.model_equipment_id', array(
									'default' => $model_equipment_id
								));
								echo $this->Form->hidden('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.equipment_id', array(
									//'default' => $ModelEquipment['order_sort']
								));
								echo $this->Form->hidden('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.order_sort', array(
									//'default' => $ModelEquipment['order_sort']
								));
							?>
						</td>
						<td></td>
						<td></td>
						<td>
								<?php
									echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.name', array(
										//'label' => 'ชื่อ (ย่อ) :',
										'label' => false,
										'div' => false,
										'class' => 'span12',
										'placeholder' => 'รหัส - รายการยุทโธปกรณ์',
										'type' => 'text',
										//'options' => $Corps
										//'default' => $ModelEquipment['equipment_id']

									));
								?>
						</td>
						<td>
								<?php
									echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_full', array(
										//'label' => 'ชื่อ (ย่อ) :',
										'label' => false,
										'div' => false,
										'class' => 'span12',
										'placeholder' => 'เต็ม',
										'type' => 'text',
										//'default' => $ModelEquipment['rate_full']

									));
								?>
						</td>
						<td>
								<?php
									echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_decrease_1', array(
										//'label' => 'ชื่อ (ย่อ) :',
										'label' => false,
										'div' => false,
										'class' => 'span12',
										'placeholder' => 'ลด1',
										'type' => 'text',
										//'default' => $ModelEquipment['rate_decrease_1']

									));
								?>
						</td>
						<td>
								<?php
									echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_decrease_2', array(
										//'label' => 'ชื่อ (ย่อ) :',
										'label' => false,
										'div' => false,
										'class' => 'span12',
										'placeholder' => 'ลด2',
										'type' => 'text',
										//'default' => $ModelEquipment['rate_decrease_2']

									));
								?>
						</td>
						<td>
								<?php
									echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_decrease_3', array(
										//'label' => 'ชื่อ (ย่อ) :',
										'label' => false,
										'div' => false,
										'class' => 'span12',
										'placeholder' => 'ลด3',
										'type' => 'text',
										//'default' => $ModelEquipment['rate_decrease_3']

									));
								?>
						</td>
						<td>
								<?php
									echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_structure', array(
										//'label' => 'ชื่อ (ย่อ) :',
										'label' => false,
										'div' => false,
										'class' => 'span12',
										'placeholder' => 'โครง',
										'type' => 'text',
										//'default' => $ModelEquipment['rate_structure']

									));
								?>

						</td>
						<td>
								<?php
									echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.comment', array(
										//'label' => 'ชื่อ (ย่อ) :',
										'label' => false,
										'div' => false,
										'class' => 'span12',
										'placeholder' => 'หมายเหตุ',
										'type' => 'text',
										//'default' => $ModelEquipment['comment']

									));
								?>
						</td>
						<td>
							<i class="icon-trash"></i>
						</td>
					</tr>