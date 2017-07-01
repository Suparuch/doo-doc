<table id="propertyTable" class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan='2' width=40><center>วรรค</center></th>
			<th rowspan='2' width=40><center>ลำดับ</center></th>
			<th rowspan='2'><center>ตำแหน่ง</center></th>
			<th rowspan='2' width=60><center>ชั้นยศ</center></th>
			<th rowspan='2' width=60><center>เหล่า</center></th>
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
<?php if(!empty($ModelProperties)) { ?>
		<?php 
		foreach($ModelDivisions as $key => $ModelDivision) { 
		?>
		<tr>
			<td><center>01</center></td>
			<td></td>
			<td>
					<?php
						echo $this->Form->input('ModelDivision.'.$ModelProperty['ModelProperty']['model_division_id'].'.name', array(
							'label' => false,
							'div' => false,
							'class' => 'span12 model_division',
							'placeholder' => 'วรรค',
							//'default' => $ModelDivisions[$ModelProperty['ModelProperty']['model_division_id']]['id']
							//'default' => $ModelProperty['ModelProperty']['model_division_id']
						));
					?>
					<i class="splashy-add_small add-Position" onclick=addPosition();></i>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelDivision.'.$ModelProperty['ModelProperty']['model_division_id'].'.comment_', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'หมายเหตุ',
							//'default' => $ModelDivisions[$ModelProperty['ModelProperty']['model_division_id']]['comment']
						));
					?>
			</td>
			<td>
				<i class="icon-trash"></i>
			</td>

		</tr>
		<tr>
			<td></td>
			<td><center>01</center></td>
			<td>
					<?php
						echo $this->Form->input('ModelPosition.'.$ModelProperty['ModelProperty']['model_position_id'].'.model_position', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'ลำดับ',
							//'default' => $ModelPositions[$ModelProperty['ModelProperty']['model_position_id']]
							//'default' => $ModelProperty['ModelProperty']['model_position_id']
						));
					?>
					<i class="splashy-add_small add-Property" onclick=addProperty();></i>
			</td>
			<td>
				<i class="icon-trash"></i>
			</td>

		</tr>
		<?php 
		$temp_model_division_id = '';
		$temp_model_position_id = '';
		foreach($ModelProperties as $key => $ModelProperty) { 
		?>

		<tr>
			<td></td>
			<td></td>
			<td>
				<input type="hidden" id="currentTab" name="data[ModelProperty][<?php echo $ModelProperty['ModelProperty']['model_division_id'];?>][<?php echo $key;?>][id]" value="<?php echo $ModelProperty['ModelProperty']['id']?>" />
				<input type="hidden" id="currentTab" name="data[ModelProperty][<?php echo $ModelProperty['ModelProperty']['model_division_id'];?>][<?php echo $key;?>][order_sort]" value="<?php echo $ModelProperty['ModelProperty']['order_sort']?>" />
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.rank_id', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'ลด3',
							'default' => $ModelProperty['ModelProperty']['rank_id']
						));
					?>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.rank_id', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'ลด3',
							'default' => $ModelProperty['ModelProperty']['corp_id']
						));
					?>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.mos', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => '',
							'default' => $ModelProperty['ModelProperty']['mos']
						));
					?>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.rate_full', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'เต็ม',
							'default' => $ModelProperty['ModelProperty']['rate_full']
						));
					?>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.rate_decrease_1', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'ลด1',
							'default' => $ModelProperty['ModelProperty']['rate_decrease_1']
						));
					?>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.rate_decrease_2', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'ลด2',
							'default' => $ModelProperty['ModelProperty']['rate_decrease_2']
						));
					?>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.rate_decrease_3', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'ลด3',
							'default' => $ModelProperty['ModelProperty']['rate_decrease_3']
						));
					?>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.rate_structure', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'โครง',
							'default' => $ModelProperty['ModelProperty']['rate_structure']
						));
					?>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.weapon_id', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'ลด3',
							'default' => $ModelProperty['ModelProperty']['weapon_id']
						));
					?>
			</td>
			<td>
					<?php
						echo $this->Form->input('ModelProperty.'.$ModelProperty['ModelProperty']['model_division_id'].'.'.$key.'.comment_', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'หมายเหตุ',
							'default' => $ModelProperty['ModelProperty']['comment']
						));
					?>
			</td>
			<td>
				<i class="icon-trash"></i>
			</td>
		</tr>

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
		<?php } ?>
		<?php }else{ ?>
		<tr>
			<td colspan="14" style="text-align:center;">
				ไม่พบข้อมูลที่ตรงกัน
			</td>
		</tr>                                                  
		<?php } ?>

	</tbody>
</table>
<button class="btn add-Division" onclick=addDivision();>เพิ่มวรรค</button>
<input type="hidden" id="Division_current_no" value="" />