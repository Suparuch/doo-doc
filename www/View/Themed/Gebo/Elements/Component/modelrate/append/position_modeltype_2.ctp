					<?php
					$position_id = '';
					?>
					<tr id='position_<?php echo $model_position_id;?>'>
						<td>
							<?php
								echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.id', array(
									'default' => $model_position_id
								));
								echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.model_id', array(
									'default' => $model_id
								));
								echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.model_division_id', array(
									'default' => $model_division_id
								));
								//echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.position_id', array(
								//	'default' => $position_id
								//));
							?>
						</td>
						<td></td>
						<!--<td><center>0<?php echo $key_position;?></center></td>-->
						<td>
							<?php
								echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.order_sort', array(
									'label' => false,
									'div' => false,
									'class' => 'span12',
									'placeholder' => 'ลำดับ',
									'default' => $key_position,
									'onkeypress' => 'return keyNumberEng(event)'
								));
							?>
						</td>
						<td>
							<?php
								echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.name', array(
									'label' => false,
									'div' => false,
									'class' => 'span11 model_position',
									'placeholder' => 'ลำดับ',
									'default' => '',
									'onkeyup' => 'return modelPositionKeyup(this,event)'
								));
							?>
							<i class="splashy-add_small add-Property" onclick=addProperty('<?php echo (string)$model_division_id;?>','<?php echo $model_position_id;?>','<?php echo $model_subdivision_id;?>');></i>
						</td>
						<td colspan="4">
						</td>
						<td>
							<?php
								echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.comment', array(
									'label' => false,
									'div' => false,
									'class' => 'span12',
									'placeholder' => 'หมายเหตุ',
									'type' => 'text',
									'default' => ''
								));
							?>
						</td>
						
						<td>
							<i class="icon-trash" onclick=deleteItem('position','<?php echo (string)$model_position_id;?>');></i>
						</td>
					</tr>