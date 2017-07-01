<style type='text/css'>
input.span122{
	width:50px !important;
}
input.span121{
	width:50px !important;
}
input.span12{
	width:50px !important;
}
input.span11
{
width:200px !important;
}
.span12
{
width:100px !important;
}
.disabled{
	background-color:#e0e0e0;
}
input.disabled{
	disabled: true; 
	readonly:true;
}
i.disabled{
display:none;
}
.disable td i{
	display:none;
}
</style>
<?php
 $model_type_id = 1;
?>
<?php echo $this->Form->create('ModelProperties', array('action' => 'saveModelProperty/'.$model_id,'div'=>false,'id' => 'saveModelProperty'));?>
<input type='hidden' name='data[ModelRate][id]' value='<?php echo $model_id;?>' id='model_id'/>
<input type='hidden' name='data[ModelRate][model_type_id]' value='<?php echo $model_type_id;?>' id='model_type_id'/>

<input type='hidden' name='model_id' value='<?php echo $model_id;?>' />
<input type='hidden' name='model_type_id' value='<?php echo $model_type_id;?>' />
<table id="propertyTable" class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='1' width=10><center>วรรค</center></th>
			<th rowspan='1' width=10><center>ลำดับ</center></th>
			<th rowspan='1'><center>ตำแหน่ง</center></th>
			<th rowspan='1' width=60><center>ชั้นยศ</center></th>
			<th rowspan='1' width=60><center>เหล่า</center></th>
			<th rowspan='1' width=60><center>ชกท.</center></th>
	
			<th rowspan='1' width=70><center>อาวุธ</center></th>
			<th rowspan='1' width=70><center>หมายเหตุ</center></th>
			<th rowspan='1'> </th>
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
			$class='';
			$c = '';
			
			if($ModelDivision['ModelDivision']['enable']!="1"){
				$class=' class="disabled" ';
				$c = 'disabled';
			}else{
				$class ='';
				$c = '';
			}
			
			?>
			<tr id='division_<?php echo $model_division_id;?>' <?php echo $class;?> >
				<!--<td><center>0<?php echo $key_division;?></center></td>-->
				<td>
					<?php 
						echo $this->Form->input($model_division_id.'.ModelDivision.order_sort', array(
							'label' => false,
							'div' => false,
							'class' => 'span122' . ' ' . $c,
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
							'default' => $model_division_id,'class'=>$c
						));
						echo $this->Form->hidden($model_division_id.'.ModelDivision.model_id', array(
							'default' => $model_id,'class'=>$c
						));
						echo $this->Form->hidden($model_division_id.'.ModelDivision.division_id', array(
							'default' => $division_id,'class'=>$c
						));
					?>
				</td>
				<td>
					<?php
						echo $this->Form->input($model_division_id.'.ModelDivision.name', array(
							'label' => false,
							'div' => false,
							'class' => 'span11 model_division' . ' ' . $c,
							'placeholder' => 'วรรค',
							'default' => $ModelDivision['ModelDivision']['name'],
							'onkeyup' => 'return modelDivisionKeyup(this,event)'
						));
					?>
					<i class="splashy-add_small add-Position <?php echo $c;?>" onclick=addPosition('<?php echo (string)$model_division_id;?>');></i>
				</td>
				<td colspan="4">
				</td>
				<td>
					<?php
						echo $this->Form->input($model_division_id.'.ModelDivision.comment', array(
							'label' => false,
							'div' => false,
							'class' => 'span12 ' . $c,
							'type' => 'text',
							'placeholder' => 'หมายเหตุ',
							'default' => $ModelDivision['ModelDivision']['comment']
						));
					?>
				</td>
				<td>
				<?php 
	
				if($ModelDivision['ModelDivision']['enable']=="1"){?>
				<a class='btn' onclick='enableDivision(0,"<?php echo $model_division_id;?>")' href="javascript:void(0)">ปิดอัตรา</a>
					
				<?php }else{
				?>
				<a class='btn' onclick='enableDivision(1,"<?php echo $model_division_id;?>")' href="javascript:void(0)">เปิดอัตรา</a>
				<?php }?>
					
				</td>
			</tr>

					<?php
					$ModelPositions = $ModelDivision['ModelPosition'];
					foreach($ModelPositions as $key_position => $ModelPosition) {
					$model_position_id = $ModelPosition['id'];
					$position_id = $ModelPosition['position_id'];
					$key_position = $key_position + 1;
					$c = '';
					if($ModelPosition['enable']!="1"){
						$class=' class="disabled" ';
						$c = 'disabled';
					}else{
						$class ='';
						$c = '';
					}
					?>
					<tr id='position_<?php echo $model_position_id;?>' <?php echo $class;?>>
						<td>
							<?php
								echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.id', array(
									'default' => $model_position_id,'class'=>$c
								));
								echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.model_id', array(
									'default' => $model_id,'class'=>$c
								));
								echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.model_division_id', array(
									'default' => $model_division_id,'class'=>$c
								));
								echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.position_id', array(
									'default' => $position_id,'class'=>$c
								));
							?>
						</td>
						<!--<td><center>0<?php echo $key_position;?></center></td>-->
						<td>
							<?php
								echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.order_sort', array(
									'label' => false,
									'div' => false,
									'class' => 'span122' . ' ' . $c,
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
									'class' => 'span11 model_position ' . $c,
									'placeholder' => 'ลำดับ',
									'default' => $ModelPosition['name'],
									'onkeyup' => 'return modelPositionKeyup(this,event)'
								));
							?>
							<i class="splashy-add_small add-Property <?php echo $c;?>" onclick=addProperty('<?php echo (string)$model_division_id;?>','<?php echo (string)$model_position_id;?>');></i>
						</td>
						<td colspan="4">
						</td>
						<td>
							<?php
								echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.comment', array(
									'label' => false,
									'div' => false,
									'class' => 'span12 ' . $c,
									'placeholder' => 'หมายเหตุ',
									'type' => 'text',
									'default' => $ModelPosition['comment']
								));
							?>
						</td>
						
						<td>
							<?php 
	
				if($ModelPosition['enable']=="1"){?>
				<a class='btn' onclick='enablePosition(0,"<?php echo $model_position_id;?>")' href="javascript:void(0)">ปิดอัตรา</a>
					
				<?php }else{
				?>
				<a class='btn' onclick='enablePosition(1,"<?php echo $model_position_id;?>")' href="javascript:void(0)">เปิดอัตรา</a>
				<?php }?>
						</td>
					</tr>
							<?php
							$ModelProperties = $ModelPosition['ModelProperty'];
							foreach($ModelProperties as $key_property => $ModelProperty) {
							$model_property_id = $ModelProperty['id'];
							$key_property = $key_property + 1;
							$c = '';
							if($ModelProperty['enable']!="1"){
								$class=' class="disabled" ';
								$c = 'disabled';
							}else{
								$class ='';
								$c = '';
							}
							?>
							<tr id='position_<?php echo $model_position_id;?>_property_<?php echo $model_property_id;?>' <?php echo $class;?>>
								<td></td>
								<td></td>
								<td>
									<?php
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.id', array(
											'default' => $model_property_id,'class'=>$c
										));
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_id', array(
											'default' => $model_id,'class'=>$c
										));
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_division_id', array(
											'default' => $model_division_id,'class'=>$c
										));
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_position_id', array(
											'default' => $model_position_id,'class'=>$c
										));
										echo $this->Form->hidden($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.order_sort', array(
											'default' => $ModelProperty['order_sort'],'class'=>$c
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input($model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rank_id', array(
											'label' => false,
											'div' => false,
											'class' => 'span12'. ' ' . $c,
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
											'class' => 'span12 ' . $c,
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
											'class' => 'span121 ' . $c,
											'placeholder' => 'ชกท.',
											'default' => $ModelProperty['mos']
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
											'class' => 'span121 model_weapon ' .  $c,
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
											'class' => 'span12 ' . $c,
											'placeholder' => 'หมายเหตุ',
											'type' => 'text',
											'default' => $ModelProperty['comment']
										));
									?>
								</td>
								<td>
									<?php 
	
				if($ModelProperty['enable']=="1"){?>
				<a class='btn' onclick='enableProperty(0,"<?php echo $model_property_id;?>")' href="javascript:void(0)">ปิดอัตรา</a>
					
				<?php }else{
				?>
				<a class='btn' onclick='enableProperty(1,"<?php echo $model_property_id;?>")' href="javascript:void(0)">เปิดอัตรา</a>
				<?php }?>
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
<?php echo $this->element('Component/modelrate/edit/blank');?>
<script language='javascript'>
	$(".disabled").attr("disabled",true);
	function modalAction3(){			

			//var currentTab = $('#currentTab').val();
			var is_submit = false;
			var currentTab = "Property";
			if(currentTab == 'Model'){
				//$('#saveModelRate').submit();
				var formAction = 'saveModelRate';
				var controller = 'ModelRates';
				var action = 'saveModelRate';
				var is_submit = true;

			}else if(currentTab == 'Property'){
				//$('#saveModelProperty').submit();
				var model_type_id = $("input[name='model_type_id']").val();
				var formAction = 'saveModelProperty';
				var controller = 'ModelProperties';
				var is_submit = true;
				if(model_type_id == 1){
					var action = 'saveModelProperty';
				}else if(model_type_id == 2){
					var action = 'saveModelSpecialProperty';			
				}
			}else if(currentTab == 'Equipment'){
				//$('#saveModelEquipment').submit();
				var formAction = 'saveModelEquipment';
				var controller = 'ModelEquipments';
				var action = 'saveModelEquipment';
				var is_submit = true;

			}else if(currentTab == 'ModelGroup'){
				//$('#saveModelGroup').submit();
				var formAction = 'saveModelGroup';
				var controller = 'ModelGroups';
				var action = 'saveModelGroup';
				var is_submit = true;
			}

			if(is_submit == true){

				var url = "../../"+controller+"/"+action;	
				$.post(	url,
						$('#'+formAction).serialize(),
						function(data){
							alert(data);
							$('#message').text(data);
							$(".alert").show();
							location.reload();
						}
						,"html"
				);
			}

		}

</script>