							<tr id='position_<?php echo $model_position_id;?>_property_<?php echo $model_property_id;?>'>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<?php
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.id', array(
											'default' => $model_property_id
										));
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_id', array(
											'default' => $model_id
										));
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_division_id', array(
											'default' => $model_division_id
										));
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_position_id', array(
											'default' => $model_position_id
										));
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.order_sort', array(
											'default' => ''
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rank_id', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'options' => $Ranks,
											'empty' => 'ยศ'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.corp_id', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'options' => $Corps,
											'empty' => 'เหล่า'
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.mos', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ชกท.',
											'default' => ''
										));
									?>
								</td>
								<td><center>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_full', array(
											'label' => false,
											'div' => false,
											'class' => 'span3',
											'placeholder' => 'เต็ม',
											'type' => 'text',
											'default' => '',
											'onkeypress' => 'return keyNumberEng(event)'
										));
									?>
									</center>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelSubDivision.'.$model_subdivision_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.comment', array(
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
									<i class="icon-trash" onclick=deleteItem('property','<?php echo (string)$model_property_id;?>','<?php echo (string)$model_position_id;?>');></i>
								</td>
							</tr>