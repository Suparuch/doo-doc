<?php
$model_type_id = empty($ModelRates['ModelRate']['model_type_id']) ? 1 : $ModelRates['ModelRate']['model_type_id']
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
													//'label' => 'หมายเลย อจย. :',
													'label' => false,
													'div' => false,
													'class' => 'span6',
													'placeholder' => 'ชื่อ ' . $ModelTypeShorts[$model_type_id],
													'default' => empty($ModelRates['ModelRate']['code']) ? '' : $ModelRates['ModelRate']['code'],'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
												));
											?>
										</td>
									</tr>
									<tr>
										<td><b>ชื่อ (ย่อ) : </b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.short_name', array(
													//'label' => 'ชื่อ (ย่อ) :',
													'label' => false,
													'div' => false,
													'class' => 'span6',
													'placeholder' => 'ชื่อ (ย่อ)',
													'default' => empty($ModelRates['ModelRate']['short_name']) ? '' : $ModelRates['ModelRate']['short_name'],'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
												));
											?>
										</td>
									</tr>
									<tr>
										<td><b>ชื่อ (เต็ม) : </b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.name', array(
													//'label' => 'ชื่อ (เต็ม) :',
													'label' => false,
													'div' => false,
													'class' => 'span6',
													'placeholder' => 'ชื่อ (เต็ม)',
													'default' => empty($ModelRates['ModelRate']['name']) ? '' : $ModelRates['ModelRate']['name'],'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
												));
											?>

											<?php
												/*
												echo $this->Form->input('ModelRate.short_name', array(
													'label' => 'วันที่ :',
													'div' => true,
													'class' => 'span6',
													'placeholder' => 'วันที่',
													'default' => $ModelRates['ModelRate']['short_name']

												));
												*/
											?>											
										</td>
									</tr>
									<tr>
										<td><b>วันที่ : </b></td>
										<td>
											<!--
											<select class="input-mini" name='data[ModelRate][model_date][day]' >
												<option value="" selected="selected">วัน</option>
												<option value="01">01</option>
												<option value="02">02</option>
												<option value="03">03</option>
												<option value="04">04</option>
												<option value="05">05</option>
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
											</select>
											-->
											<?php echo $this->Form->day('ModelRate.model_date',array('class'=>'input-mini','empty' => 'วัน'));?>
											<!--
											<select class="input-thaimonth" name='data[ModelRate][model_date][month]'>
												<option value="" selected="selected">เดือน</option>
												<option value="01">มกราคม</option>
												<option value="02">กุมภาพันธ์</option>
												<option value="03">มีนาคม</option>
												<option value="04">เมษายน</option>
												<option value="05">พฤษภาคม</option>
												<option value="06">มิถุนายน</option>
												<option value="07">กรกฎาคม</option>
												<option value="08">สิงหาคม</option>
												<option value="09">กันยายน</option>
												<option value="10">ตุลาคม</option>
												<option value="11">พฤศจิกายน</option>
												<option value="12">ธันวาคม</option>
											</select>
											-->
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
											<select class="input-thaiyear"  name='data[ModelRate][model_date][year]'>
												<option value="" selected="selected">ปี</option>
												<?php for($i=0;$i<100;$i++){ ?>
												<option value="<?php echo (date("Y"))-100+($i+1); ?>"><?php echo date("Y")+543-100+($i+1); ?></option>   
												<?php } ?>
											</select>
										</td>
									</tr>

									<tr>
										<td><b>คำสั่ง อัตรากำลังพล: </b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.command_user', array(
													//'label' => 'ชื่อ (เต็ม) :',
													'label' => false,
													'div' => false,
													'class' => 'span2',
													'placeholder' => 'คำสั่ง',
													'default' => empty($ModelRates['ModelRate']['command_user']) ? '' : $ModelRates['ModelRate']['command_user'],'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

												));
											?>
											&nbsp;ลงวันที่&nbsp; 
											<select class="input-mini" name='data[ModelRate][command_user_date][day]' >
												<option value="" selected="selected">วัน</option>
												<option value="01">01</option>
												<option value="02">02</option>
												<option value="03">03</option>
												<option value="04">04</option>
												<option value="05">05</option>
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
											</select>
											<select class="input-thaimonth" name='data[ModelRate][command_user_date][month]'>
												<option value="" selected="selected">เดือน</option>
												<option value="01">มกราคม</option>
												<option value="02">กุมภาพันธ์</option>
												<option value="03">มีนาคม</option>
												<option value="04">เมษายน</option>
												<option value="05">พฤษภาคม</option>
												<option value="06">มิถุนายน</option>
												<option value="07">กรกฎาคม</option>
												<option value="08">สิงหาคม</option>
												<option value="09">กันยายน</option>
												<option value="10">ตุลาคม</option>
												<option value="11">พฤศจิกายน</option>
												<option value="12">ธันวาคม</option>
											</select>
											<select class="input-thaiyear"  name='data[ModelRate][command_user_date][year]'>
												<option value="" selected="selected">ปี</option>
												<?php for($i=0;$i<100;$i++){ ?>
												<option value="<?php echo (date("Y"))-100+($i+1); ?>"><?php echo date("Y")+543-100+($i+1); ?></option>   
												<?php } ?>
											</select>
										</td>
									</tr>


									<tr>
										<td><b>คำสั่ง อัตรายุทโธปกรณ์ :</b></td>
										<td>
											<?php
												echo $this->Form->input('ModelRate.command_equipment', array(
													//'label' => 'ชื่อ (เต็ม) :',
													'label' => false,
													'div' => false,
													'class' => 'span2',
													'placeholder' => 'คำสั่ง',
													'default' => empty($ModelRates['ModelRate']['command_equipment']) ? '' : $ModelRates['ModelRate']['command_equipment'],'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

												));
											?>
											&nbsp;ลงวันที่&nbsp; 
											<select class="input-mini" name='data[ModelRate][command_equipment_date][day]' >
												<option value="" selected="selected">วัน</option>
												<option value="01">01</option>
												<option value="02">02</option>
												<option value="03">03</option>
												<option value="04">04</option>
												<option value="05">05</option>
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
											</select>
											<select class="input-thaimonth" name='data[ModelRate][command_equipment_date][month]'>
												<option value="" selected="selected">เดือน</option>
												<option value="01">มกราคม</option>
												<option value="02">กุมภาพันธ์</option>
												<option value="03">มีนาคม</option>
												<option value="04">เมษายน</option>
												<option value="05">พฤษภาคม</option>
												<option value="06">มิถุนายน</option>
												<option value="07">กรกฎาคม</option>
												<option value="08">สิงหาคม</option>
												<option value="09">กันยายน</option>
												<option value="10">ตุลาคม</option>
												<option value="11">พฤศจิกายน</option>
												<option value="12">ธันวาคม</option>
											</select>
											<select class="input-thaiyear"  name='data[ModelRate][command_equipment_date][year]'>
												<option value="" selected="selected">ปี</option>
												<?php for($i=0;$i<100;$i++){ ?>
												<option value="<?php echo (date("Y"))-100+($i+1); ?>"><?php echo date("Y")+543-100+($i+1); ?></option>   
												<?php } ?>
											</select>
										</td>
									</tr>

									<tr>
										<td><b>หมายเหตุ ท้ายอัตรา : </b></td>
										<td>
											<textarea name="data[ModelRate][comment]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder="หมายเหตุ ท้ายอัตรา..."><?php echo empty($ModelRates['ModelRate']['comment']) ? '' : $ModelRates['ModelRate']['comment'];?></textarea>
										</td>
									</tr>
								</tbody>
							</table>
					</div>
					
			</div>	
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>