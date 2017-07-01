					<?php
					//$model_division_id = 'xxx';
					//$model_position_id = 'xxx';
					$position_id = '';
					//$ModelProperties = $ModelPosition['ModelProperty']
					?>
					<tr id='position_<?php echo $model_position_id;?>'>
						<td>
							<?php
								echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.id', array(
									'default' => $model_position_id
								));
								echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.model_id', array(
									'default' => $model_id
								));
								echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.model_division_id', array(
									'default' => $model_division_id
								));
								echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.position_id', array(
									'default' => $position_id
								));
							?>
						</td>
						<td><center>0<?php echo $key_position;?></center></td>
						<td>
								<?php
									echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.name', array(
										//'label' => 'ชื่อ (ย่อ) :',
										'label' => false,
										'div' => false,
										'class' => 'span11 model_position',
										'placeholder' => 'ลำดับ',
										'default' => ''
									));
								?>
								<i class="splashy-add_small add-Property" onclick=addProperty('<?php echo (string)$model_division_id;?>','<?php echo $model_position_id;?>');></i>
						</td>
						<td colspan="9">
						</td>
						<td>
								<?php
									echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.comment', array(
										//'label' => 'ชื่อ (ย่อ) :',
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
							<i class="icon-trash"></i>
						</td>
					</tr>