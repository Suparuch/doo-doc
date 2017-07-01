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
							'class' => 'span12',
							'placeholder' => 'หมายเลข อจย.',
							'type' => 'text',
							'default' => '',
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
							'default' => '',
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
						'default' => '',
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
						'default' => '',
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
						'default' => '',
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
						'default' => '',
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
						'default' => '',
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
						'default' => '',
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
							'default' => ''
						));
					?>
				</td>
				<td>
					<i class="icon-trash" onclick=deleteItem('modelgroup','<?php echo (string)$model_group_id;?>');></i>
				</td>
			</tr>