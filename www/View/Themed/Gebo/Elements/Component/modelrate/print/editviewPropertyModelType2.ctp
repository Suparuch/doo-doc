<?php echo $this->Form->create('ModelProperties', array('action' => 'saveModelProperty/'.$model_id,'div'=>false,'id' => 'saveModelProperty'));?>
<?php
function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}
?>
<script language='javascript'>
function toggle_sub(obj,model_division_id){
	
	if($("."+obj).length<=1){
		var tr = $("#" + obj);
		$.post("/ModelRates/getEditModelRateDetail/2",{model_division_id:model_division_id},function(data){
			tr.after(data);
			$("#l_" + obj).html("ซ่อน");
		});
	}else{
		$("." + obj).remove();
		$("#l_" + obj).html("แสดง");
	}
	
}
</script>
<style type='text/css'>
.hideme{
	display:none;
}
</style>
<table id="propertyTable" class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=10><center>วรรค</center></th>
			<th rowspan='2' width=60><center>วรรคย่อย</center></th>
			<th rowspan='2' width=10><center>ลำดับ</center></th>			
			<th rowspan='2'><center>ตำแหน่ง</center></th>
			<th rowspan='2' width=80><center>ชั้นยศ</center></th>
			<th rowspan='2' width=80><center>เหล่า</center></th>
			<th rowspan='2' width=60><center>ชกท.</center></th>
			<th width=150><center>อัตราระดับความพร้อมรบ</center></th>
			<th rowspan='2' width=120><center>หมายเหตุ</center></th>
			<th rowspan='2' width=5> </th>
		</tr>
		<tr>
			<th width=40><center>เต็ม</center></th>								
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
			$model_id = $ModelDivision['ModelDivisionSpecial']['model_id'];
			$model_division_id = $ModelDivision['ModelDivisionSpecial']['id'];
			$division_id = $ModelDivision['ModelDivisionSpecial']['division_id'];
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
								//'default' => $ModelDivision['ModelDivisionSpecial']['order_sort'],
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
				<td></td>
				<td>
					<?php
						echo $this->Form->input($model_division_id.'.ModelDivision.name', array(
							'label' => false,
							'div' => false,
							'class' => 'span10 model_division',
							'placeholder' => 'วรรค',
							'default' => $ModelDivision['ModelDivisionSpecial']['name'],
							'onkeyup' => 'return modelDivisionKeyup(this,event)'
						));
					?>
					<i class="splashy-add_small add-SubDivision" onclick=addSubDivision('<?php echo (string)$model_division_id;?>');></i>	
                    <a href="#" onclick="toggle_sub('<?php echo $class;?>','<?php echo $model_division_id;?>')" id='l_<?php echo $class;?>'>แสดง</a>
				</td>
				<td colspan="4"></td>
				<td>
					<?php
						echo $this->Form->input($model_division_id.'.ModelDivision.comment', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'type' => 'text',
							'placeholder' => 'หมายเหตุ',
							'default' => $ModelDivision['ModelDivisionSpecial']['comment']
						));
					?>
				</td>
				<td>
					<i class="icon-trash" onclick=deleteItem('division','<?php echo (string)$model_division_id;?>');></i>
					
				</td>
			</tr>

			<?php
			continue;
			$ModelSubDivisions = $ModelDivision['ModelSubDivision'];
			//pr($ModelSubDivisions);
			foreach($ModelSubDivisions as $key_subdivision => $ModelSubDivision) {
			$model_id = $ModelSubDivision['model_id'];
			$model_subdivision_id = $ModelSubDivision['id'];
			$subdivision_id = $ModelSubDivision['subdivision_id'];
			$key_subdivision = $key_subdivision + 1;
			?>

			<tr id='subdivision_<?php echo $model_subdivision_id;?>' class='<?php echo $class;?>'>
				<td class='<?php echo $class;?>'>
					<?php
						echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.id', array(
							'default' => $model_subdivision_id
						));
						echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.model_id', array(
							'default' => $model_id
						));
						echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.model_division_id', array(
							'default' => $model_division_id
						));
						echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.subdivision_id', array(
							'default' => $subdivision_id
						));
					?>
				</td>
				<!--<td><center>0<?php echo $key_subdivision;?></center></td>-->
				<td class='<?php echo $class;?>' >
				<center>
					<?php
						echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.order_sort', array(
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
						echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.name', array(
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
				<td colspan='4'></td>
				<td class='<?php echo $class;?>'>
					<?php
						echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.comment', array(
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
									echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.id', array(
										'default' => $model_position_id
									));
									echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.model_id', array(
										'default' => $model_id
									));
									echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.model_division_id', array(
										'default' => $model_division_id
									));
									echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.position_id', array(
										'default' => $position_id
									));
								?>
							</td>
							<td>  </td>
							<!--<td><center>0<?php echo $key_position;?></center></td>-->
							<td class='<?php echo $class;?>' >
								<?php
									echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.order_sort', array(
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
									echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.name', array(
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
							</td>
							<td class='<?php echo $class;?>' >
								<?php
									echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.comment', array(
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
											echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.id', array(
												'default' => $model_property_id
											));
											echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_id', array(
												'default' => $model_id
											));
											echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_division_id', array(
												'default' => $model_division_id
											));
											echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_position_id', array(
												'default' => $model_position_id
											));
											echo $this->Form->hidden($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.order_sort', array(
												'default' => $ModelProperty['order_sort']
											));
										?>
									</td>
									<td class='<?php echo $class;?>' >
										<?php
											echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rank_id', array(
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
											echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.corp_id', array(
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
											echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.mos', array(
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
											echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_full', array(
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
											echo $this->Form->input($model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.comment', array(
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