<?php
if(empty($model_type_id)) $model_type_id = empty($ModelRates['ModelRate']['model_type_id']) ? 1 : $ModelRates['ModelRate']['model_type_id'];
$hide = '';
if($model_type_id!=1)
	$hide = " style='display:none' ";
?>
<?php echo $this->Form->create('ModelRates', array('action' => 'saveModelRate/'.$model_id,'div'=>false,'id' => 'saveModelRate'));?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<div class="box-content nopadding">
				
					<div class="row-fluid">

							<input type="hidden" name="data[ModelRate][id]" value="<?php echo empty($ModelRates['ModelRate']['id']) ? '' : $ModelRates['ModelRate']['id']; ?>"/>
							<input type="hidden" name="data[ModelRate][model_type_id]" value="<?php echo $model_type_id;?>"/>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="150"><b>หมายเลย <?php echo $ModelTypeShorts[$model_type_id];?> : </b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.code', array(
													'label' => false,
													'div' => false,
													'class' => 'span6',
													'placeholder' => 'ชื่อ ' . $ModelTypeShorts[$model_type_id],
													'default' => empty($ModelRates['ModelRate']['code']) ? '' : $ModelRates['ModelRate']['code']
												));
											?>
										</td>
									</tr>
									<tr>
										<td><b>ชื่อ (ย่อ) : </b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.short_name', array(
													'label' => false,
													'div' => false,
													'class' => 'span6',
													'placeholder' => 'ชื่อ (ย่อ)',
													'default' => empty($ModelRates['ModelRate']['short_name']) ? '' : $ModelRates['ModelRate']['short_name'],
													//'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
												));
											?>
										</td>
									</tr>
									<tr>
										<td><b>ชื่อ (เต็ม) : </b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.name', array(
													'label' => false,
													'div' => false,
													'class' => 'span6',
													'placeholder' => 'ชื่อ (เต็ม)',
													'default' => empty($ModelRates['ModelRate']['name']) ? '' : $ModelRates['ModelRate']['name'],
													//'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
												));
											?>									
										</td>
									</tr>
									<tr>

										<td><b>วันที่ : </b></td>
										<td>
											<?php echo $this->Form->day('ModelRate.model_date',array('class'=>'input-mini','empty' => 'วัน','default' => empty($ModelRates['ModelRate']['model_date']) ? '' : $this->DateFormat->getDay($ModelRates['ModelRate']['model_date'])));?>
											<?php
												echo $this->Form->input('ModelRate.model_date.month', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaimonth',
													'options' => $Months,
													'empty' => 'เดือน',
													'default' => empty($ModelRates['ModelRate']['model_date']) ? '' : $this->DateFormat->getMonth($ModelRates['ModelRate']['model_date'])
												));
											?>
											<?php
												echo $this->Form->input('ModelRate.model_date.year', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaiyear',
													'options' => $Years,
													'empty' => 'ปี',
													'default' => empty($ModelRates['ModelRate']['model_date']) ? '' : $this->DateFormat->getYear($ModelRates['ModelRate']['model_date'])
												));
											?>
										</td>
									</tr>

									<tr>
										<td><b>คำสั่ง อัตรากำลังพล: </b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.command_user', array(
													'label' => false,
													'div' => false,
													'class' => 'span2',
													'placeholder' => 'คำสั่ง',
													'default' => empty($ModelRates['ModelRate']['command_user']) ? '' : $ModelRates['ModelRate']['command_user'],'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
												));
											?>
											&nbsp;ลงวันที่&nbsp; 
											<?php echo $this->Form->day('ModelRate.command_user_date',array('class'=>'input-mini','empty' => 'วัน','default' => empty($ModelRates['ModelRate']['command_user_date']) ? '' : $this->DateFormat->getDay($ModelRates['ModelRate']['command_user_date'])));?>
											<?php
												echo $this->Form->input('ModelRate.command_user_date.month', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaimonth',
													'options' => $Months,
													'empty' => 'เดือน',
													'default' => empty($ModelRates['ModelRate']['command_user_date']) ? '' : $this->DateFormat->getMonth($ModelRates['ModelRate']['command_user_date'])
												));
											?>
											<?php
												echo $this->Form->input('ModelRate.command_user_date.year', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaiyear',
													'options' => $Years,
													'empty' => 'ปี',
													'default' => empty($ModelRates['ModelRate']['command_user_date']) ? '' : $this->DateFormat->getYear($ModelRates['ModelRate']['command_user_date'])
												));
											?>
										</td>
									</tr>

									<tr <?php echo $hide;?>>
										<td><b>คำสั่ง อัตรายุทโธปกรณ์ :</b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.command_equipment', array(
													'label' => false,
													'div' => false,
													'class' => 'span2',
													'placeholder' => 'คำสั่ง',
													'default' => empty($ModelRates['ModelRate']['command_equipment']) ? '' : $ModelRates['ModelRate']['command_equipment'],'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
												));
											?>
											&nbsp;ลงวันที่&nbsp;
											<?php echo $this->Form->day('ModelRate.command_equipment_date',array('class'=>'input-mini','empty' => 'วัน','default' => empty($ModelRates['ModelRate']['command_equipment_date']) ? '' : $this->DateFormat->getDay($ModelRates['ModelRate']['command_equipment_date'])));?>
											<?php
												echo $this->Form->input('ModelRate.command_equipment_date.month', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaimonth',
													'options' => $Months,
													'empty' => 'เดือน',
													'default' => empty($ModelRates['ModelRate']['command_equipment_date']) ? '' : $this->DateFormat->getMonth($ModelRates['ModelRate']['command_equipment_date'])
												));
											?>
											<?php
												echo $this->Form->input('ModelRate.command_equipment_date.year', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaiyear',
													'options' => $Years,
													'empty' => 'ปี',
													'default' => empty($ModelRates['ModelRate']['command_equipment_date']) ? '' : $this->DateFormat->getYear($ModelRates['ModelRate']['command_equipment_date'])
												));
											?>
										</td>
									</tr>
									<?php if($model_type_id == 2){?>
									<tr style='visibility:hidden;position:absolute'>
										<td><b>หมายเหตุ ท้ายอัตรา : </b></td>
										<td>
											<textarea name="data[ModelRate][comment]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder="หมายเหตุ ท้ายอัตรา..."><?php echo empty($ModelRates['ModelRate']['comment']) ? '' : $ModelRates['ModelRate']['comment'];?></textarea>
										</td>
									</tr>
									<?php }?>
									<tr>
										<td><b>หมายเหตุ ท้ายอัตรา (กำลังพล) : </b></td>
										<td>
											<textarea name="data[ModelRate][comment_user]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder="หมายเหตุ ท้ายอัตรา (กำลังพล)"><?php echo empty($ModelRates['ModelRate']['comment_user']) ? '' : $ModelRates['ModelRate']['comment_user'];?></textarea>
										</td>
									</tr>
<?php  if($model_type_id == 1){?>
									<tr>
										<td><b>หมายเหตุ ท้ายอัตรา (ยุทโธปกรณ์) : </b></td>
										<td>
											<textarea name="data[ModelRate][comment_equipment]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder="หมายเหตุ ท้ายอัตรา (ยุทโธปกรณ์)"><?php echo empty($ModelRates['ModelRate']['comment_equipment']) ? '' : $ModelRates['ModelRate']['comment_equipment'];?></textarea>
										</td>
									</tr>
									<?php }?>

									<tr>
										<td><b>สถานะ ล๊อคแก้ไข</b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.is_locked', array(													
													'label' => false,
													'div' => false,
													'class' => 'input-medium',
													'options' => $StatusLocks,
													'default' => empty($ModelRates['ModelRate']['is_locked']) ? 'N' : $ModelRates['ModelRate']['is_locked']
												));
											?>
										</td>
									</tr>
									
									<tr>
										<td><b>สถานะ ร่าง</b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.model_status_id', array(													
													'label' => false,
													'div' => false,
													'class' => 'input-medium',
													'options' => $ModelStatus,
													'default' => empty($ModelRates['ModelRate']['model_status_id']) ? '1' : $ModelRates['ModelRate']['model_status_id']
												));
											?>
										</td>
									</tr>
<tr>
										<td><b>เป็น อจย. รวม</b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.is_group', array(													
													'label' => false,
													'div' => false,
													'class' => 'input-medium',
													'options' => $StatusGroup,
													'default' => empty($ModelRates['ModelRate']['is_group']) ? 'N' : $ModelRates['ModelRate']['is_group']
												));
											?>										</td>
									</tr>

								</tbody>
							</table>
					</div>

			</div>	
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>