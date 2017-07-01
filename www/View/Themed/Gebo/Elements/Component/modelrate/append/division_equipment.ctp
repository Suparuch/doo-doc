			<tr id='division_<?php echo $model_division_id;?>'>
				<td><center><?php echo str_pad($key_division, 2, '0', STR_PAD_LEFT);?></center></td>
				<td>
						<?php
							echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelDivision.id', array(
								'default' => $model_division_id
							));
							echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelDivision.name', array(
								'label' => false,
								'div' => false,
								'class' => 'span11 model_division',
								'placeholder' => 'วรรค',
								'default' => '',
								'onkeyup' => 'return modelDivisionKeyup(this,event)'
							));
						?>
						<i class="splashy-add_small add-Equipment" onclick=addEquipment('<?php echo (string)$model_division_id;?>');></i>
				</td>
				<td colspan="2"></td>
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
					<i class="icon-trash"></i>
				</td>
			</tr>