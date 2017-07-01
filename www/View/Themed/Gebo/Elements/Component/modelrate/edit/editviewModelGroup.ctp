<?php echo $this->Form->create('ModelGroups', array('action' => 'saveModelGroup/'.$model_id,'div'=>false,'id' => 'saveModelGroup'));
$key_group=0;
?>
<table id="modelGroupTable" class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th width=80>หมายเลข อจย.</th>
			<th>ชื่อ อจย. (ย่อ)</th>
			<th width=60><center>จัดเรียง</center></th>
			<th width=60><center>จำนวน (เต็ม)</center></th>
            <th width=60><center>จำนวน (ลด&nbsp;1)</center></th>
            <th width=60><center>จำนวน (ลด&nbsp;2)</center></th>
            <th width=60><center>จำนวน (ลด&nbsp;3)</center></th>
            <th width=60><center>จำนวน (โครง)</center></th>
			<th width=200>หมายเหตุ</th>
			<th width=5></th>
		</tr>
	</thead>
	<tbody>

	<?php if(!empty($ModelGroups)) { ?>
	<?php 
	
		foreach($ModelGroups as $key_group => $ModelGroup) { 
		$model_group_id = $ModelGroup['ModelGroup']['id'];
	?>

		<tr id='modelgroup_<?php echo $model_group_id;?>'>
			<td>
				<?php
					echo $this->Form->hidden('ModelGroup.'.$model_group_id.'.id', array(
						'default' => $model_group_id
					));
					echo $this->Form->hidden('ModelGroup.'.$model_group_id.'.model_id', array(
						'default' => $ModelGroup['ModelGroup']['model_id']
					));
				?>
				<?php
					echo $this->Form->input('ModelGroup.'.$model_group_id.'.code', array(
						'label' => false,
						'div' => false,
						'class' => 'span12 model_code',
						'placeholder' => 'หมายเลข อจย.',
						'type' => 'text',
						'default' => $ModelGroup['ModelGroup']['code'],
						'onkeyup' => 'return modelKeyup("' . 'ModelGroup'.$model_group_id.'Code'  . '",event)',
						//'onblur' => 'return modelOnBlur(this,event)'
						'onchange' => 'return modelOnChange("' . 'ModelGroup'.$model_group_id.'Code'  . '",event)',
					));
				?>
			</td>
			<td>
				<?php
					echo $this->Form->input('ModelGroup.'.$model_group_id.'.name', array(
						'label' => false,
						'div' => false,
						'class' => 'span12',
						'placeholder' => 'ชื่อ อจย. (ย่อ)',
						'type' => 'text',
						'default' => $ModelGroup['ModelGroup']['name'],
						'readonly'
					));
				?>
			</td>
			<td><center>
				<?php
					echo $this->Form->input('ModelGroup.'.$model_group_id.'.order_sort', array(
						'label' => false,
						'div' => false,
						'class' => 'span10',
						'placeholder' => 'จัดเรียง',
						'type' => 'text',
						'default' => $ModelGroup['ModelGroup']['order_sort'],
						'onkeypress' => 'return keyNumberEng(event)'
					));
				?>
				</center>
			</td>
			<td><center>
				<?php
					echo $this->Form->input('ModelGroup.'.$model_group_id.'.quantity', array(
						'label' => false,
						'div' => false,
						'class' => 'span10',
						'placeholder' => 'จำนวน (เต็ม)',
						'type' => 'text',
						'default' => $ModelGroup['ModelGroup']['quantity'],
						'onkeypress' => 'return keyNumberEng(event)'
					));
				?>
				</center>
			</td>
            <td><center>
				<?php
					echo $this->Form->input('ModelGroup.'.$model_group_id.'.quantity_decrease1', array(
						'label' => false,
						'div' => false,
						'class' => 'span10',
						'placeholder' => 'จำนวน (ลด 1)',
						'type' => 'text',
						'default' => $ModelGroup['ModelGroup']['quantity_decrease1'],
						'onkeypress' => 'return keyNumberEng(event)'
					));
				?>
				</center>
			</td>
            <td><center>
				<?php
					echo $this->Form->input('ModelGroup.'.$model_group_id.'.quantity_decrease2', array(
						'label' => false,
						'div' => false,
						'class' => 'span10',
						'placeholder' => 'จำนวน (ลด 2)',
						'type' => 'text',
						'default' => $ModelGroup['ModelGroup']['quantity_decrease2'],
						'onkeypress' => 'return keyNumberEng(event)'
					));
				?>
				</center>
			</td>
            <td><center>
				<?php
					echo $this->Form->input('ModelGroup.'.$model_group_id.'.quantity_decrease3', array(
						'label' => false,
						'div' => false,
						'class' => 'span10',
						'placeholder' => 'จำนวน (ลด 3)',
						'type' => 'text',
						'default' => $ModelGroup['ModelGroup']['quantity_decrease3'],
						'onkeypress' => 'return keyNumberEng(event)'
					));
				?>
				</center>
			</td>
            <td><center>
				<?php
					echo $this->Form->input('ModelGroup.'.$model_group_id.'.quantity_struct', array(
						'label' => false,
						'div' => false,
						'class' => 'span10',
						'placeholder' => 'จำนวน (โครง)',
						'type' => 'text',
						'default' => $ModelGroup['ModelGroup']['quantity_struct'],
						'onkeypress' => 'return keyNumberEng(event)'
					));
				?>
				</center>
			</td>
            
			<td>
				<?php
					echo $this->Form->input('ModelGroup.'.$model_group_id.'.comment', array(
						'label' => false,
						'div' => false,
						'class' => 'span12',
						'placeholder' => 'หมายเหตุ',
						'type' => 'text',
						'default' => $ModelGroup['ModelGroup']['comment']
					));
				?>
			</td>
			<td>
				<i class="icon-trash" onclick=deleteItem('modelgroup','<?php echo (string)$model_group_id;?>');></i>
			</td>
		</tr>
		
	<?php } ?>
	<?php }else{ ?>
		<tr>
			<td colspan="5" style="text-align:center;">
					ไม่พบข้อมูลที่ตรงกัน
			</td>
		</tr>                                                  
	<?php } ?>

	</tbody>
</table><br>

<a id='addModelGroup' class="btn btn-small" onclick=addModelGroup(); key_group=<?php echo $key_group ?>> เพิ่ม อจย.</a>
<?php echo $this->Form->end(); ?>