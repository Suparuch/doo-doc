			<tr id='subdivision_<?php echo $model_subdivision_id;?>'>
				<td>
					<?php
						echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.id', array(
							'default' => $model_subdivision_id
						));
						echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.model_id', array(
							'default' => $model_id
						));
						echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.model_division_id', array(
							'default' => $model_division_id
						));
					?>
				</td>
				<td><center>
					<?php
						echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.order_sort', array(
							'label' => false,
							'div' => false,
							'class' => 'span6',
							'placeholder' => 'ลำดับวรรคย่อย',
							'default' => $key_subdivision,
							'onkeypress' => 'return keyNumberEng(event)'
						));
					?>
					</center>
				</td>
				<td></td>
				<td>
					<?php
						echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.name', array(
							'label' => false,
							'div' => false,
							'class' => 'span11 model_sub_division',
							'placeholder' => 'วรรคย่อย',
							'default' => '',
							'onkeyup' => 'return modelSubDivisionKeyup(this,event)'
						));
					?>
					<i class="splashy-add_small add-Position" onclick=addPosition('<?php echo (string)$model_subdivision_id;?>');></i>
				</td>
				<td colspan="4"></td>
				<td>
					<?php
						echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.comment', array(
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
					<i class="icon-trash" onclick=deleteItem('subdivision','<?php echo (string)$model_subdivision_id;?>');></i>
				</td>
			</tr>