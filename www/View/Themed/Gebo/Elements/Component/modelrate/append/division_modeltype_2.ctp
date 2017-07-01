			<tr id='division_<?php echo $model_division_id;?>'>
				<td>
					<?php
						echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelDivision.order_sort', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'placeholder' => 'ลำดับ',
							'default' => $key_division,
							'onkeypress' => 'return keyNumberEng(event)'
						));
					?>
				</td>
				<td>
					<?php
						echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelDivision.id', array(
							'default' => $model_division_id
						));
					?>
				</td>
				<td></td>
				<td>
					<?php
						echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelDivision.name', array(
							'label' => false,
							'div' => false,
							'class' => 'span11 model_division',
							'placeholder' => 'วรรค',
							'default' => '',
							'onkeyup' => 'return modelDivisionKeyup(this,event)'
						));
					?>
					<i class="splashy-add_small add-SubDivision" onclick=addSubDivision('<?php echo (string)$model_division_id;?>');></i>
				</td>
				<td colspan="4">
				</td>
				<td>
					<?php
						echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelDivision.comment', array(
							'label' => false,
							'div' => false,
							'class' => 'span12',
							'type' => 'text',
							'placeholder' => 'หมายเหตุ',
							'default' => ''
						));
					?>
				</td>
				<td>
					<i class="icon-trash" onclick=deleteItem('division','<?php echo (string)$model_division_id;?>');></i>
				</td>
			</tr>