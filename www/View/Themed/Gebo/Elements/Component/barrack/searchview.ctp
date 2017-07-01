					<div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3 class="heading"><!--<i class="icon-th-list"></i>-->
									<?php echo __('ค้นหา') . ' ' . __('ค่ายทหาร') ;?>
									</h3>
								</div>
								<div class="box-content nopadding">
									<form action="#" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>

										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ทัพภาค');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('area_id', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'options' => $Areas,
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['area_id'])? '':$default['area_id']
														))
														?> 
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ที่ตั้งค่าย');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														จังหวัด
														<?php
														echo $this->Form->input('province_id', array(
															'label' => false,
															'div' => false,
															'class' => 'span12 search-input-province',
															'options' => $Provinces,
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['province_id'])? '':$default['province_id'],
															'onchange' => "provinceChange(this.value,'search')"
														))
														?>
														อำเภอ/เขต
														<?php
														echo $this->Form->input('zone_id', array(
															'label' => false,
															'div' => false,
															'class' => 'span12 search-input-zone',
															'options' => array(),
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['zone_id'])? '':$default['zone_id'],
															'onchange' => "zoneChange(this.value,'search')"
														))
														?>
														ตำบล/แขวง (เพิ่มเติม)
														<?php
														echo $this->Form->input('district_id', array(
															'label' => false,
															'div' => false,
															'class' => 'span12 search-input-district',
															'options' => array(),
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['district_id'])? '':$default['district_id']
														))
														?> 														
													</div>
												</div>
											</div>

										</div>

										<div class="control-group">

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ชื่อค่าย');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('name', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'default' => empty($default['name'])? '':$default['name']
														))
														?> 
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"></label>
												<div class="controls">
													<div class="input-xlarge">

													</div>
												</div>
											</div>
										</div>

										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('วันที่จัดตั้ง');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<div class="input-append date" id="dp2" data-date-format="dd/mm/yyyy">
															<input class="span6" type="text" readonly="" name='start_command_date'><span class="add-on"><i class="splashy-calendar_day"></i></span>
														</div>
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ถึง');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<div class="input-append date" id="dp2" data-date-format="dd/mm/yyyy">
															<input class="span6" type="text" readonly="" name='end_command_date'><span class="add-on"><i class="splashy-calendar_day"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>

										<!--<button type="submit" class="btn btn-primary"><?php echo __('Search');?></button>-->
										
										<div class="form-actions">
											<button type="submit" class="btn btn-primary hideme mm_7_list"><?php echo __('ค้นหา');?></button>
											<!--<button type="button" class="btn">Cancel</button>-->
										</div>
										<input  type="hidden" name="offset" value="0" />
										
									</form>
								</div>
							</div>
						</div>
					</div>