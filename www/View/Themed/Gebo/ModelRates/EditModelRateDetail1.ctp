
<?php 
			foreach($ModelDivisions as $key_division => $ModelDivision) {
			$model_id = $ModelDivision['ModelDivision']['model_id'];
			$model_division_id = $ModelDivision['ModelDivision']['id'];
			$division_id = $ModelDivision['ModelDivision']['division_id'];
			$key_division = $key_division + 1;
			$class = 'division_' . $model_division_id;
			?>
			

					<?php
	
					$ModelPositions = $ModelDivision['ModelPosition'];
					foreach($ModelPositions as $key_position => $ModelPosition) {
					$model_position_id = $ModelPosition['id'];
					$position_id = $ModelPosition['position_id'];
					$key_position = $key_position + 1;
					?>
					<tr id='position_<?php echo $model_position_id;?>'>
						<td>
							<?php
								echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.id', array(
									'default' => $model_position_id
								));
								echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.model_id', array(
									'default' => $model_id
								));
								echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.model_division_id', array(
									'default' => $model_division_id
								));
								echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.position_id', array(
									'default' => $position_id
								));
							?>
						</td>
						<!--<td><center>0<?php echo $key_position;?></center></td>-->
						<td>
							<?php
								echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.order_sort', array(
									'label' => false,
									'div' => false,
									'class' => 'span12',
									'placeholder' => 'ลำดับ',
									'default' => $ModelPosition['order_sort'],
									'onkeypress' => 'return keyNumberEng(event)'
								));
							?>
						</td>
						<td>
							<?php
								echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.name', array(
									'label' => false,
									'div' => false,
									'class' => 'span11 model_position',
									'placeholder' => 'ลำดับ',
									'default' => $ModelPosition['name'],
									'onkeyup' => 'return modelPositionKeyup(this,event)'
								));
							?>
							<i class="splashy-add_small add-Property" onclick=addProperty('<?php echo (string)$model_division_id;?>','<?php echo (string)$model_position_id;?>');></i>
						</td>
                        <td>
							
						</td>
						<td colspan="8">
						</td>
						<td>
							<?php
								echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.comment', array(
									'label' => false,
									'div' => false,
									'class' => 'span12',
									'placeholder' => 'หมายเหตุ',
									'type' => 'text',
									'default' => $ModelPosition['comment']
								));
							?>
						</td>
						
						<td>
							<i class="icon-trash" onclick=deleteItem('position','<?php echo (string)$model_position_id;?>');></i>
						</td>
					</tr>
							<?php
							$ModelProperties = $ModelPosition['ModelProperty'];
							foreach($ModelProperties as $key_property => $ModelProperty) {
							$model_property_id = $ModelProperty['id'];
							$key_property = $key_property + 1;
							?>
							<tr id='position_<?php echo $model_position_id;?>_property_<?php echo $model_property_id;?>'>
								<td></td>
								<td></td>
								<td>
									<?php
										echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.id', array(
											'default' => $model_property_id
										));
										echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_id', array(
											'default' => $model_id
										));
										echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_division_id', array(
											'default' => $model_division_id
										));
										echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_position_id', array(
											'default' => $model_position_id
										));
										echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.order_sort', array(
											'default' => $ModelProperty['order_sort']
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rank_id', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'options' => $Ranks,
											'default' => $ModelProperty['rank_id'],
											'empty' => 'ยศ'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.corp_id', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'options' => $Corps,
											'default' => $ModelProperty['corp_id'],
											'empty' => 'เหล่า'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.mos', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ชกท.',
											'default' => $ModelProperty['mos']
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_full', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'เต็ม',
											'type' => 'text',
											'default' => $ModelProperty['rate_full'],
											'onkeypress' => 'return keyNumberEng(event)'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_1', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ลด1',
											'type' => 'text',
											'default' => $ModelProperty['rate_decrease_1'],
											'onkeypress' => 'return keyNumberEng(event)'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_2', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ลด2',
											'type' => 'text',
											'default' => $ModelProperty['rate_decrease_2'],
											'onkeypress' => 'return keyNumberEng(event)'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_3', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ลด3',
											'type' => 'text',
											'default' => $ModelProperty['rate_decrease_3'],
											'onkeypress' => 'return keyNumberEng(event)'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_structure', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'โครง',
											'type' => 'text',
											'default' => $ModelProperty['rate_structure'],
											'onkeypress' => 'return keyNumberEng(event)'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->hidden("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.weapon_id', array(
											'default' => $ModelProperty['weapon_id']
										));
										$weapon_name = empty($Weapons[$ModelProperty['weapon_id']])? '' : $Weapons[$ModelProperty['weapon_id']];
										echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.weapon_name', array(
											'label' => false,
											'div' => false,
											'class' => 'span12 model_weapon',
											'placeholder' => 'อาวุธ',
											'default' => $weapon_name,
											'onkeyup' => 'return modelWeaponKeyup(this,event)'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input("ModelProperties." .$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.comment', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'หมายเหตุ',
											'type' => 'text',
											'default' => $ModelProperty['comment']
										));
									?>
								</td>
								<td>
									<i class="icon-trash" onclick=deleteItem('property','<?php echo (string)$model_property_id;?>','<?php echo (string)$model_position_id;?>')></i>
								</td>
							</tr>
							
							<?php } ?>

					<?php } ?>

			<?php } ?>
