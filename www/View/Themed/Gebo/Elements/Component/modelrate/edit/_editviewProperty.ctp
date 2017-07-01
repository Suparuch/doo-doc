<?php echo $this->Form->create('ModelProperties', array('action' => 'saveModelProperty/'.$model_id,'div'=>false,'id' => 'saveModelProperty'));?>
<table id="propertyTable" class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=40><center>วรรค</center></th>
			<th rowspan='2' width=40><center>ลำดับ</center></th>
			<th rowspan='2'><center>ตำแหน่ง</center></th>
			<th rowspan='2' width=80><center>ชั้นยศ</center></th>
			<th rowspan='2' width=80><center>เหล่า</center></th>
			<th rowspan='2' width=60><center>ชกท.</center></th>
			<th colspan='5'><center>อัตราระดับความพร้อมรบ</center></th>
			<th rowspan='2' width=80><center>อาวุธ</center></th>
			<th rowspan='2' width=120><center>หมายเหตุ</center></th>
			<th rowspan='2' width=5> </th>
		</tr>
		<tr>
			<th width=40><center>เต็ม</center></th>
			<th width=40><center>ลด 1</center></th>
			<th width=40><center>ลด 2</center></th>
			<th width=40><center>ลด 3</center></th>
			<th width=40><center>โครง</center></th>									
		</tr>
	</thead>
	<tbody>
	<?php
		   $key_division = 0;
		   $key_position = 0;
		   $key_property = 0;	
	?>
	<?php if(!empty($ModelDivisions)) { ?>
			<?php 
			//pr($ModelDivisions);
			//pr($ModelPositions);
			//die();


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
							echo $this->Form->input($model_division_id.'.ModelDivision.name', array(
								
								//'label' => 'ชื่อ (ย่อ) :',
								'label' => false,
								'div' => false,
								'class' => 'span11 model_division',
								'placeholder' => 'วรรค',
								//'default' => $Divisions[$model_division_id]
								'default' => $ModelDivision['ModelDivision']['name']
							));
						?>
						<i class="splashy-add_small add-Position" onclick=addPosition('<?php echo (string)$model_division_id;?>');></i>
				</td>
				<td colspan="9">
				</td>
				<td>
						<?php
							echo $this->Form->input($model_division_id.'.ModelDivision.comment', array(
								//'label' => 'ชื่อ (ย่อ) :',
								'label' => false,
								'div' => false,
								'class' => 'span12',
								'type' => 'text',
								'placeholder' => 'หมายเหตุ',
								'default' => $ModelDivision['ModelDivision']['comment']

							));
						?>
				</td>
				<td>
					<i class="icon-trash"></i>
				</td>
			</tr>

					<?php
					$ModelPositions = $ModelDivision['ModelPosition'];
					foreach($ModelPositions as $key_position => $ModelPosition) {
					//pr($ModelPosition);
					//die();
					$model_position_id = $ModelPosition['id'];
					$position_id = $ModelPosition['position_id'];
					//$ModelProperties = $ModelPosition['ModelProperty']
					$key_position = $key_position + 1;
					?>
					<tr id='position_<?php echo $model_position_id;?>'>
						<td>
							<?php
								echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.id', array(
									'default' => $model_position_id
								));
								echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.model_id', array(
									'default' => $model_id
								));
								echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.model_division_id', array(
									'default' => $model_division_id
								));
								echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.position_id', array(
									'default' => $position_id
								));
							?>
						</td>
						<td><center>0<?php echo $key_position;?></center></td>
						<td>
								<?php
									echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.name', array(
										//'label' => 'ชื่อ (ย่อ) :',
										'label' => false,
										'div' => false,
										'class' => 'span11 model_position',
										'placeholder' => 'ลำดับ',
										'default' => $ModelPosition['name']
									));
								?>
								<i class="splashy-add_small add-Property" onclick=addProperty('<?php echo (string)$model_division_id;?>','<?php echo (string)$model_position_id;?>');></i>
						</td>
						<td colspan="9">
						</td>
						<td>
								<?php
									echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.comment', array(
										//'label' => 'ชื่อ (ย่อ) :',
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
							<i class="icon-trash"></i>
						</td>
					</tr>
							<?php
							$ModelProperties = $ModelPosition['ModelProperty'];
							//pr($ModelProperties);
							//die();
							foreach($ModelProperties as $key_property => $ModelProperty) {
							//pr($ModelProperty);
							//die();
							$model_property_id = $ModelProperty['id'];
							$key_property = $key_property + 1;
							?>

							<tr id='position_<?php echo $model_position_id;?>_property_<?php echo $model_property_id;?>'>
								<td></td>
								<td></td>
								<td>
									<?php
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.id', array(
											'default' => $model_property_id
										));
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_id', array(
											'default' => $model_id
										));
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_division_id', array(
											'default' => $model_division_id
										));
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_position_id', array(
											'default' => $model_position_id
										));
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.order_sort', array(
											'default' => $ModelProperty['order_sort']
										));
									?>
								</td>
								<td>
										<?php
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rank_id', array(
												//'label' => 'ชื่อ (ย่อ) :',
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'ยศ',
												'options' => $Ranks,
												'default' => $ModelProperty['rank_id']

											));
										?>
								</td>
								<td>
										<?php
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.corp_id', array(
												//'label' => 'ชื่อ (ย่อ) :',
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'เหล่า',
												'options' => $Corps,
												'default' => $ModelProperty['corp_id']

											));
										?>
								</td>
								<td>
										<?php
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.mos', array(
												//'label' => 'ชื่อ (ย่อ) :',
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
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_full', array(
												//'label' => 'ชื่อ (ย่อ) :',
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'เต็ม',
												'type' => 'text',
												'default' => $ModelProperty['rate_full']

											));
										?>
								</td>
								<td>
										<?php
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_1', array(
												//'label' => 'ชื่อ (ย่อ) :',
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'ลด1',
												'type' => 'text',
												'default' => $ModelProperty['rate_decrease_1']

											));
										?>
								</td>
								<td>
										<?php
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_2', array(
												//'label' => 'ชื่อ (ย่อ) :',
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'ลด2',
												'type' => 'text',
												'default' => $ModelProperty['rate_decrease_2']

											));
										?>
								</td>
								<td>
										<?php
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_3', array(
												//'label' => 'ชื่อ (ย่อ) :',
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'ลด3',
												'type' => 'text',
												'default' => $ModelProperty['rate_decrease_3']

											));
										?>
								</td>
								<td>
										<?php
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_structure', array(
												//'label' => 'ชื่อ (ย่อ) :',
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'โครง',
												'type' => 'text',
												'default' => $ModelProperty['rate_structure']

											));
										?>

								</td>
								<td>
										<?php
											echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.weapon_id', array(
												'default' => $ModelProperty['weapon_id']
											));
											$weapon_name = empty($Weapons[$ModelProperty['weapon_id']])? '' : $Weapons[$ModelProperty['weapon_id']];
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.weapon_name', array(
												//'label' => 'ชื่อ (ย่อ) :',
												'label' => false,
												'div' => false,
												'class' => 'span12',
												'placeholder' => 'อาวุธ',
												'default' => $weapon_name

											));
										?>
								</td>
								<td>
										<?php
											echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.comment', array(
												//'label' => 'ชื่อ (ย่อ) :',
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
									<i class="icon-trash"></i>
								</td>
							</tr>
							
							<?php } ?>

					<?php } ?>

			<?php } ?>

					
			<!--
			<tr>
				<td></td>
				<td></td>
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
				<td></td>
			</tr>
			-->

	<?php }else{ ?>
			<tr id='division_0'>
				<td colspan="14" style="text-align:center;">
					ไม่พบข้อมูลที่ตรงกัน
				</td>
			</tr>
	<?php } ?>

	</tbody>
</table><br>

<a id='addDivision' class="btn btn-small" onclick=addDivision(); key_division=<?php echo $key_division ?>>เพิ่มวรรค</a>
<a id='addPosition' class="btn btn-small" onclick=addPosition();>เพิ่มลำดับ</a>
<a id='addProperty' class="btn btn-small" onclick=addProperty('','');>เพิ่มลำดับย่อย</a>
<?php echo $this->Form->end(); ?>