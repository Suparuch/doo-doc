							<tr id='position_<?php echo $model_position_id;?>_property_<?php echo $model_property_id;?>'>
								<td></td>
								<td></td>
								<td>
									<?php
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.id', array(
											'default' => $model_property_id
										));
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_id', array(
											'default' => $model_id
										));
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_division_id', array(
											'default' => $model_division_id
										));
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.model_position_id', array(
											'default' => $model_position_id
										));
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.order_sort', array(
											'default' => ''
										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rank_id', array(
											//'label' => 'ชื่อ (ย่อ) :',
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ยศ',
											'options' => $Ranks
											//'default' => $ModelProperty['rank_id']

										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.corp_id', array(
											//'label' => 'ชื่อ (ย่อ) :',
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'เหล่า',
											'options' => $Corps
											//'default' => $ModelProperty['corp_id']

										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.mos', array(
											//'label' => 'ชื่อ (ย่อ) :',
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ชกท.',
											'default' => ''

										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_full', array(
											//'label' => 'ชื่อ (ย่อ) :',
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'เต็ม',
											'type' => 'text',
											'default' => ''

										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_1', array(
											//'label' => 'ชื่อ (ย่อ) :',
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ลด1',
											'type' => 'text',
											'default' => ''

										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_2', array(
											//'label' => 'ชื่อ (ย่อ) :',
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ลด2',
											'type' => 'text',
											'default' => ''

										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_decrease_3', array(
											//'label' => 'ชื่อ (ย่อ) :',
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ลด3',
											'type' => 'text',
											'default' => ''

										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.rate_structure', array(
											//'label' => 'ชื่อ (ย่อ) :',
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'โครง',
											'type' => 'text',
											'default' => ''

										));
									?>

								</td>
								<td>
									<?php
										echo $this->Form->hidden('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.weapon_id', array(
											//'default' => $ModelProperty['weapon_id']
										));
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.weapon_name', array(
											//'label' => 'ชื่อ (ย่อ) :',
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'อาวุธ',
											'default' => ''

										));
									?>
								</td>
								<td>
									<?php
										echo $this->Form->input('ModelProperties.'.$model_division_id.'.ModelPosition.'.$model_position_id.'.ModelProperty.'.$model_property_id.'.comment', array(
											//'label' => 'ชื่อ (ย่อ) :',
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
									<i class="icon-trash"></i>
								</td>
							</tr>