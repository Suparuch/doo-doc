
<?php 

	foreach($ModelDivisions as $key_division => $ModelDivision) {
			$model_id = $ModelDivision['ModelDivisionSpecial']['model_id'];
			$model_division_id = $ModelDivision['ModelDivisionSpecial']['id'];
			$division_id = $ModelDivision['ModelDivisionSpecial']['division_id'];
			$key_division = $key_division + 1;
			$class = 'division_' . $model_division_id;
			?>
			
			<?php
		
			$ModelSubDivisions = $ModelDivision['ModelSubDivision'];
			//pr($ModelSubDivisions);
			foreach($ModelSubDivisions as $key_subdivision => $ModelSubDivision) {
			$model_id = $ModelSubDivision['model_id'];
			$model_subdivision_id = $ModelSubDivision['id'];
			$subdivision_id = $ModelSubDivision['subdivision_id'];
			
			$key_subdivision = $key_subdivision + 1;
			$report_piority = $ModelSubDivision['﻿report_piority'];
			?>

			<tr id='subdivision_<?php echo $model_subdivision_id;?>' class='<?php echo $class;?>'>
				<td class='<?php echo $class;?>'>
					<?php
						echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.id', array(
							'default' => $model_subdivision_id
						));
						echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.model_id', array(
							'default' => $model_id
						));
						echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.model_division_id', array(
							'default' => $model_division_id
						));
						echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.subdivision_id', array(
							'default' => $subdivision_id
						));
					?>
				</td>
				<!--<td><center>0<?php echo $key_subdivision;?></center></td>-->
				<td class='<?php echo $class;?>' >
				<center>
					<?php
						echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.order_sort', array(
							'label' => false,
							'div' => false,
							'class' => 'span6',
							'placeholder' => 'ลำดับวรรคย่อย',
							'default' => $ModelSubDivision['order_sort'],
							'onkeypress' => 'return keyNumberEng(event)'
						));
					?>
				</center>
				</td>
				<td></td>
				<td class='<?php echo $class;?>' >
					<?php
						echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.name', array(
							'label' => false,
							'div' => false,
							'class' => 'span11 model_sub_division',
							'placeholder' => 'วรรคย่อย',
							'default' => $ModelSubDivision['name'],
							'onkeyup' => 'return modelSubDivisionKeyup(this,event)'
						));
					?>
					<i class="splashy-add_small add-Position" onclick=addPosition('<?php echo (string)$model_subdivision_id;?>');></i>					
				</td>
                <td class='<?php echo $class;?>'  colspan='4'>
				
					
				</td>
			
				<td class='<?php echo $class;?>'>
					<?php
						echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.comment', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'type' => 'text',
							'placeholder' => 'หมายเหตุ',
							'default' => $ModelSubDivision['comment']
						));
					?>				
				</td>
				<td>
					<i class="icon-trash" onclick=deleteItem('subdivision','<?php echo (string)$model_subdivision_id;?>');></i>
				</td>
			</tr>
						<?php
						
						$ModelPositions = $ModelSubDivision['ModelPosition'];
						foreach($ModelPositions as $key_position => $ModelPosition) {
						$model_position_id = $ModelPosition['id'];
						$position_id = $ModelPosition['position_id'];
						$key_position = $key_position + 1;
						?>
						<tr id='position_<?php echo $model_position_id;?>' class='<?php echo $class;?>'>
							<td class='<?php echo $class;?>' >
								<?php
									echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.id', array(
										'default' => $model_position_id
									));
									echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.model_id', array(
										'default' => $model_id
									));
									echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.model_division_id', array(
										'default' => $model_division_id
									));
									echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.position_id', array(
										'default' => $position_id
									));
								?>
							</td>
							<td>  </td>
							<!--<td><center>0<?php echo $key_position;?></center></td>-->
							<td class='<?php echo $class;?>' >
								<?php
									echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.order_sort', array(
										'label' => false,
										'div' => false,
										'class' => 'span12',
										'placeholder' => 'ลำดับ',
										'default' => $ModelPosition['order_sort'],
										'onkeypress' => 'return keyNumberEng(event)'
									));
								?>
							</td>
							<td class='<?php echo $class;?>' >
								<?php
									echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.name', array(
										'label' => false,
										'div' => false,
										'class' => 'span11 model_position',
										'placeholder' => 'ลำดับ',
										'default' => $ModelPosition['name'],
										'onkeyup' => 'return modelPositionKeyup(this,event)'
									));
								?>
								<i class="splashy-add_small add-Property" onclick=addProperty('<?php echo (string)$model_division_id;?>','<?php echo (string)$model_position_id;?>','<?php echo $model_subdivision_id;?>');></i>
							</td>
							<td colspan="4">
<?php
/*
						echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.report_piority', array(
							'label' => false,
							'div' => false,
							'class' => 'span2',
							'placeholder' => 'จัดเรียง',
							'default' => $ModelSubDivision['report_piority'],
							'onkeypress' => 'return keyNumberEng(event)'
						));
* ลำดับความสำคัญในรายงาน
						*/
					?> 
							</td>
							<td class='<?php echo $class;?>' >
								<?php
									echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.comment', array(
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
								
								//$ModelProperties = $ModelPosition['ModelProperty'];
								$data = $ModelPosition['ModelProperty'];
								
								$ModelProperties = $data;//array_orderby($data, 'rank_id', SORT_ASC);
								foreach($ModelProperties as $key_property => $ModelProperty) {
								$model_property_id = $ModelProperty['id'];
								$key_property = $key_property + 1;
								?>
								<tr id='position_<?php echo $model_position_id;?>_property_<?php echo $model_property_id;?>' class='<?php echo $class;?>'>
									<td></td>
									<td></td>
									<td> <!-- <?php echo print_r($ModelProperty);?> --></td>
									<td class='<?php echo $class;?>' >
										<?php
											echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.id', array(
												'default' => $model_property_id
											));
											echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_id', array(
												'default' => $model_id
											));
											echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_division_id', array(
												'default' => $model_division_id
											));
											echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_position_id', array(
												'default' => $model_position_id
											));
											echo $this->Form->hidden("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.order_sort', array(
												'default' => $ModelProperty['order_sort']
											));
										?>
									</td>
									<td class='<?php echo $class;?>' >
										<?php
											echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rank_id', array(
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'options' => $Ranks,
												'default' => $ModelProperty['rank_id'],
												'empty' => 'ยศ'
											));
										?>
									</td>
									<td class='<?php echo $class;?>'>
										<?php
											echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.corp_id', array(
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'options' => $Corps,
												'default' => $ModelProperty['corp_id'],
												'empty' => 'เหล่า'
											));
										?>
									</td>
									<td class='<?php echo $class;?>'>
										<?php
											echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.mos', array(
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'ชกท.',
												'default' => $ModelProperty['mos']
											));
										?>
									</td>
									<td class='<?php echo $class;?>' >
										<center>
										<?php
											echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_full', array(
												'label' => false,
												'div' => false,
												'class' => 'span3',
												'placeholder' => 'เต็ม',
												'type' => 'text',
												'default' => $ModelProperty['rate_full'],
												'onkeypress' => 'return keyNumberEng(event)'
											));
										?>
										</center>
									</td>
									<td class='<?php echo $class;?>' >
										<?php
											echo $this->Form->input("ModelProperties." . $model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.comment', array(
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
										<i class="icon-trash" onclick=deleteItem('property','<?php echo (string)$model_property_id;?>','<?php echo (string)$model_position_id;?>');></i>
									</td>
								</tr>
								
								<?php } ?>

						<?php } ?>

					<?php } ?>

			<?php } ?>

