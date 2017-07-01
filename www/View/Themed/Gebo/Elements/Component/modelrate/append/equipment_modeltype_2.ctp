					<tr id='section2division_<?php echo $model_division_id;?>_equipment_<?php echo $model_equipment_id;?>'>
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
								//echo $this->Form->hidden($model_division_id.'.ModelEquipment.'.$model_equipment_id.'.order_sort', array(
									//'default' => $ModelEquipment['order_sort']
								//));
							?>
						</td>
						<td>
							<?php
								echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.order_sort', array(
									'label' => false,
									'div' => false,
									'class' => 'span12',
									'placeholder' => 'ลำดับ',
									'default' => $key_equipment,
									'onkeypress' => 'return keyNumberEng(event)'
								));
							?>
						</td>
						<td>
							<?php
								echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.equipment_name', array(
									'label' => false,
									'div' => false,
									'class' => 'span12 model_equipment',
									//'placeholder' => 'รหัส - รายการยุทโธปกรณ์',
									'placeholder' => 'รายการยุทโธปกรณ์',
									'type' => 'text',
									'onkeyup' => 'return modelEquipmentKeyup(this,event)'
								));
							?>
						</td>
						<td>
							<center>
							<?php
								echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.rate_full', array(
									'label' => false,
									'div' => false,
									'class' => 'span3',
									'placeholder' => 'เต็ม',
									'type' => 'text',
									'onkeypress' => 'return keyNumberEng(event)'
								));
							?>
							</center>
						</td>
						<td>
							<?php
								echo $this->Form->input('ModelEquipments.'.$model_division_id.'.ModelEquipment.'.$model_equipment_id.'.comment', array(
									'label' => false,
									'div' => false,
									'class' => 'span12',
									'placeholder' => 'หมายเหตุ',
									'type' => 'text',
								));
							?>
						</td>
						<td>
							<i class="icon-trash" onclick=deleteItem('equipment','<?php echo (string)$model_equipment_id;?>','<?php echo (string)$model_division_id;?>');></i>
						</td>
					</tr>