<table class="table table-bordered">
	<thead>
	<tr>
		<th><center>ข้อมูลหน่วยทหาร</center></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>
			<?php
				echo $this->Form->hidden('organization_id', array(
					'id' => 'organization_id-'.$organization_type,
					'label' => false,
					'div' => false,
					'default' => $organization_id
				));
			?>
			<?php
				echo $this->Form->input('name', array(
					'id' => 'name-'.$organization_type,
					'label' => false,
					'div' => false,
					'class' => 'span12',
					//'placeholder' => 'ชื่อ ' . $ModelTypeShorts[$model_type_id],
					//'default' => empty($ModelRates['ModelRate']['code']) ? '' : $ModelRates['ModelRate']['code']
					'onkeyup' => 'return modelOrganizationKeyup(this,event)'
				));
			?>
		</td>
	</tr>
	</tbody>
</table>
<br>
<button id="submit" type="submit" class="btn btn-primary" onclick="addClick(<?php echo $organization_type?>);">เพิ่ม</button>