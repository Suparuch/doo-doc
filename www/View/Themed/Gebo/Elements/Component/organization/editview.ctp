<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('ข้อมูลแฟ้มประวัติ') ;?></h3>-->
			<div class="box-content nopadding">
				<?php //echo $this->Form->create('Folders', array('action' => 'saveFolder','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table class="table table-bordered">
						    <thead>
							<tr>
							    <th colspan="2"><center>รายละเอียดบัญชีการจัดหน่วยทหาร</center></th>
							</tr>
						    </thead>
						    <tbody>
							<tr>
							    <td width=250><b><?php echo __('หมายเลข อจย.');?> : </b></td>
							    <td>
 								<?php
								    echo $this->Form->input('model', array(
								    'label' => false,
								    'div' => false,
								    'class' => '',
								    'options' => $ModelRates,
								    'empty' => '- - - เลือก - - - ',
									'default' => empty($default['model'])? '':$default['model'],

								))
								?> 	
							    </td>
							</tr>
							<tr>
							    <td><b><?php echo __('วันที่ อจย.');?><b></td>
							    <td></td>
							</tr>
							<tr>
							    <td><b><?php echo __('รหัสหน่วย [Unit ID]');?></b></td>
							    <td>
								<?php
									echo $this->Form->input('code', array(
										'label' => false,
										'div' => false,
										'class' => 'span8',
										'placeholder' => '',
										'onkeypress' => 'return keyNumberEng(event)',
										'default' => empty($default['code'])? '':$default['code'],

									));
								?>								
								</td>
							</tr>
							<tr>
							    <td><b><?php echo __('นามหน่วย');?></b></td>
							    <td>
								<?php
									echo $this->Form->input('name', array(
										'label' => false,
										'div' => false,
										'class' => 'span8',
										'placeholder' => '',
										'onkeypress' => 'return keyNumberArabicAndTextThai(event)',
										'default' => empty($default['name'])? '':$default['name'],

									));
								?>
							    </td>
							</tr>
							<tr>
							    <td><b><?php echo __('นามหน่วยย่อ');?></b></td>
							    <td>
								<?php
									echo $this->Form->input('short_name', array(
										'label' => false,
										'div' => false,
										'class' => 'span8',
										'placeholder' => '',
										'onkeypress' => 'return keyNumberArabicAndTextThai(event)',
										'default' => empty($default['short_name'])? '':$default['short_name'],

									));
								?>							    
							    </td>
							</tr>
							<tr>
							    <td><b><?php echo __('วันที่จัดตั้ง ');?></b></td>
							    <td>
								<div class="input-append date" id="dp2" data-date-format="dd/mm/yyyy">
									<input class="span6" type="text" readonly=""><span class="add-on"><i class="splashy-calendar_day"></i></span>
								</div>							    
							    </td>
							</tr>
							<tr>
							    <td><b><?php echo __('วันที่แปรสภาพ ');?></b></td>
							    <td>
								<div class="input-append date" id="dp2" data-date-format="dd/mm/yyyy">
									<input class="span6" type="text" readonly="" name="command_date"><span class="add-on"><i class="splashy-calendar_day"></i></span>
								</div>	
							    </td>
							</tr>
							<tr>
							    <td><b><?php echo __('คำสั่งที่');?></b></td>
							    <td>
								<?php
									echo $this->Form->input('command', array(
										'label' => false,
										'div' => false,
										'class' => 'span8',
										'placeholder' => '',
										'onkeypress' => 'return keyNumberArabicAndTextThai(event)',
										'default' => empty($default['command'])? '':$default['command'],
									));
								?>							    
							    </td>
							</tr>
							<tr>
							    <td><b><?php echo __('ลงวันที่ ');?></b></td>
							    <td></td>
							</tr>
							<tr>
							    <td><b><?php echo __('ชนิดหน่วย');?></b></td>
							    <td>
 								<?php
								    echo $this->Form->input('corp_id', array(
								    'label' => false,
								    'div' => false,
								    'class' => '',
								    'options' => array(),
								    'empty' => '- - - เลือก - - - ',
									'options' => $Corps,
									'default' => empty($default['corp_id'])? '':$default['organization_target_id'],
								))
								?> 							    
							    </td>
							</tr>
							<tr>
							    <td><b><?php echo __('ที่ตั้งหน่วย (ปกติ)');?></b></td>
							    <td></td>
							</tr>
							<tr>
							    <td><b><?php echo __('ชื่อค่ายที่หน่วยตั้งอยู่ ');?></b></td>
							    <td>
 								<?php
								    echo $this->Form->input('barrack_id', array(
								    'label' => false,
								    'div' => false,
								    'class' => '',
								    'options' => array(),
								    'empty' => '- - - เลือก - - - ',
								    'options' => $Barracks,
									'default' => empty($default['barrack_id'])? '':$default['barrack_id'],
								))
								?> 							    
							    </td>
							</tr>
							<tr>
							    <td><b><?php echo __('หน่วยเป้าหมาย ระดับ ');?></b></td>
							    <td>
 								<?php
								echo $this->Form->input('organization_target_id', array(
								    'label' => false,
								    'div' => false,
								    'class' => '',
								    'options' => array(),
								    'empty' => '- - - เลือก - - - ',
									'options' => $OrganizationTargets,
									'default' => empty($default['organization_target_id'])? '':$default['organization_target_id'],
								))
								?> 								    
							    </td>
							</tr>
							<tr>
							    <td><b><?php echo __('หมายเหตุ ');?></b></td>
							    <td>
								<?php
								echo $this->Form->input('descriptions', array(
								    'label' => false,
								    'div' => false,
								    'class' => 'span8',
								    'placeholder' => '',
								    'onkeypress' => 'return keyNumberArabicAndTextThai(event)',
								));
								?>
							    </td>
							</tr>
							<!--
							<tr>
							    <td colspan=2><center><b><?php echo __('หน่วยเหนือ');?></b></center></td>
							</tr>
							<tr>
							    <td><b><?php echo __('หน่วยเหนือระดับที่ 1 ');?></b></td>
							    <td></td>
							</tr>
							<tr>
							    <td><b><?php echo __('หน่วยเหนือระดับที่ 2 ');?></b></td>
							    <td></td>
							</tr>
							<tr>
							    <td><b><?php echo __('หน่วยเหนือระดับที่ 3 ');?></b></td>
							    <td></td>
							</tr>
							<tr>
							    <td><b><?php echo __('หน่วยเหนือระดับที่ 4 ');?></b></td>
							    <td></td>
							</tr>
							<tr>
							    <td colspan=2><center><b><?php echo __('อัตรากำลังพล / อาวุธและยุทโธปกรณ์');?></b></center></td>
							</tr>
							<tr>
							    <td><b><?php echo __('อัตราอนุมัติกำลังพล:');?></b></td>
							    <td></td>
							</tr>
							-->
							<tr>
							    <td colspan=2>
								<table class="table table-bordered">
								<thead>
								<tr>
								    <th colspan=5><center>อัตราอนุมัติกำลังพล (อจย. ตอนที่ 3)</center>
								    </th>
								<tr>
								</thead>
								<tbody>
								<tr>
								    <td>
									<input name='data[rate_user]' type="radio" value="rate_full" checked> เต็ม
								    </td>
								    <td>
									<input name='data[rate_user]' type="radio" value="rate_decrease_1"> ลดระดับ 1
								    </td>
								    <td>
									<input name='data[rate_user]' type="radio" value="rate_decrease_2"> ลดระดับ 2
								    </td>
								    <td>
									<input name='data[rate_user]' type="radio" value="rate_decrease_3"> ลดระดับ 3
								    </td>
								    <td>
									<input name='data[rate_user]' type="radio" value="rate_structure"> โครง
								    </td>
								<tr>
								</tbody>
								</table>
							    </td>
							</tr>

							<td colspan=2>
								<table class="table table-bordered">
								<thead>
								<tr>
								    <th colspan=5><center>อัตราอนุมัติอาวุธและยุทโธปกรณ์ (อจย. ตอนที่ 4)</center>
								    </th>
								<tr>
								</thead>
								<tbody>
								<tr>
								    <td>
									<input name='data[rate_equipment]' type="radio" value="rate_full" checked> เต็ม
								    </td>
								    <td>
									<input name='data[rate_equipment]' type="radio" value="rate_decrease_1"> ลดระดับ 1
								    </td>
								    <td>
									<input name='data[rate_equipment]' type="radio" value="rate_decrease_2"> ลดระดับ 2
								    </td>
								    <td>
									<input name='data[rate_equipment]' type="radio" value="rate_decrease_3"> ลดระดับ 3
								    </td>
								    <td>
									<input name='data[rate_equipment]' type="radio" value="rate_structure"> โครง
								    </td>
								<tr>
								</tbody>
								</table>
							    </td>
							</tr>
							
						    </tbody>
						</table>	

						<div class="form-actions">
							<button type="submit" class="btn btn-primary"><?php echo __('แก้ไข');?></button>
							<button type="submit" class="btn btn-primary"><?php echo __('ลบหน่วย');?></button>
						</div>

					</div>
					
				<?php //echo $this->Form->end();?>
			</div>
		</div>
	</div>
</div>