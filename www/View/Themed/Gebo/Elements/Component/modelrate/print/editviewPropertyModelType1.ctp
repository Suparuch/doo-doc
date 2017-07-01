<?php echo $this->Form->create('ModelProperties', array('action' => 'saveModelProperty/'.$model_id,'div'=>false,'id' => 'saveModelProperty'));?>

<script language='javascript'>
function toggle_sub(obj,model_division_id){
	
	if($("."+obj).length<=1){
		var tr = $("#" + obj);
		$.post("/ModelRates/getEditModelRateDetail/1",{model_division_id:model_division_id},function(data){
			tr.after(data);
			$("#l_" + obj).html("ซ่อน");
		});
	}else{
		$("." + obj).remove();
		$("#l_" + obj).html("แสดง");
	}
	
}
</script>
<table id="propertyTable" class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=10><center>วรรค</center></th>
			<th rowspan='2' width=10><center>ลำดับ</center></th>
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

			foreach($ModelDivisions as $key_division => $ModelDivision) {
			$model_id = $ModelDivision['ModelDivision']['model_id'];
			$model_division_id = $ModelDivision['ModelDivision']['id'];
			$division_id = $ModelDivision['ModelDivision']['division_id'];
			$key_division = $key_division + 1;
			$class = 'division_' . $model_division_id;
			?>
			<tr id='division_<?php echo $model_division_id;?>'>
				<!--<td><center>0<?php echo $key_division;?></center></td>-->
				<td>
					<?php
						echo $this->Form->input($model_division_id.'.ModelDivision.order_sort', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'ลำดับ',
							//'default' => $ModelDivision['ModelDivision']['order_sort'],
							'default' => $key_division,
							'onkeypress' => 'return keyNumberEng(event)'
						));
					?>
				</td>
				<td>
					<?php
						echo $this->Form->hidden($model_division_id.'.ModelDivision.id', array(
							'default' => $model_division_id
						));
						echo $this->Form->hidden($model_division_id.'.ModelDivision.model_id', array(
							'default' => $model_id
						));
						echo $this->Form->hidden($model_division_id.'.ModelDivision.division_id', array(
							'default' => $division_id
						));
					?>
                    
				</td>
				<td>
					<?php
						echo $this->Form->input($model_division_id.'.ModelDivision.name', array(
							'label' => false,
							'div' => false,
							'class' => 'span10 model_division',
							'placeholder' => 'วรรค',
							'default' => $ModelDivision['ModelDivision']['name'],
							'onkeyup' => 'return modelDivisionKeyup(this,event)'
						));
					?>
					<i class="splashy-add_small add-Position" onclick=addPosition('<?php echo (string)$model_division_id;?>');></i>
                    <a href="#" onclick="toggle_sub('<?php echo $class;?>','<?php echo $model_division_id;?>')" id='l_<?php echo $class;?>'>แสดง</a>
				</td>
				<td colspan="9">
				</td>
				<td>
					<?php
						echo $this->Form->input($model_division_id.'.ModelDivision.comment', array(
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
					<i class="icon-trash" onclick=deleteItem('division','<?php echo (string)$model_division_id;?>');></i>
                    
				</td>
			</tr>

					<?php
					continue;
					$ModelPositions = $ModelDivision['ModelPosition'];
					foreach($ModelPositions as $key_position => $ModelPosition) {
					$model_position_id = $ModelPosition['id'];
					$position_id = $ModelPosition['position_id'];
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
						<!--<td><center>0<?php echo $key_position;?></center></td>-->
						<td>
							<?php
								echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.order_sort', array(
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
								echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.name', array(
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
						<td colspan="9">
						</td>
						<td>
							<?php
								echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.comment', array(
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
										echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.corp_id', array(
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
										echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.mos', array(
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
										echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_1', array(
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
										echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_2', array(
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
										echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_3', array(
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
										echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_structure', array(
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
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.weapon_id', array(
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
										echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.comment', array(
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
<?php echo $this->Form->end(); ?>
<?php //echo $this->element('Component/modelrate/edit/blank');?>