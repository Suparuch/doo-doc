					<div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3 class="heading"><!--<i class="icon-th-list"></i>-->
									<?php echo __('ค้นหา') . ' ' . __('หน่วยทหาร') ;?>
									</h3>
								</div>
								<div class="box-content nopadding">
									<form action="#" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>

										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ชนิดหน่วย');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('corp_id', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'options' => $Corps,
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['corp_id'])? '':$default['corp_id'],
														))
														?> 
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ประเภทหน่วยเป้าหมาย');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('organization_target_id', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'options' => $OrganizationTargets,
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['organization_target_id'])? '':$default['organization_target_id'],
														))
														?> 
													</div>
												</div>
											</div>
										</div>

										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ประเภทหน่วย');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('organization_type_id', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'options' => $OrganizationTypes,
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['organization_type_id'])? '':$default['organization_type_id'],
														))
														?> 
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ขนาดหน่วย');?> : </label>
												<div class="controls">
													<div class="input-xlarge">														
														<?php
															echo $this->Form->input('organization_class_id', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'options' => $OrganizationClasss,
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['organization_class_id'])? '':$default['organization_class_id'],
														))
														?> 
													</div>
												</div>
											</div>
										</div>

										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('นามหน่วย');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('name', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['name'])? '':$default['name'],
														))
														?> 
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('นามหน่วยย่อ');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('short_name', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['short_name'])? '':$default['short_name'],
														))
														?> 
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
															<input class="span6" type="text" readonly=""><span class="add-on"><i class="splashy-calendar_day"></i></span>
														</div>
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ชื่อค่าย');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('barrack_id', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'options' => $Barracks,
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['barrack_id'])? '':$default['barrack_id'],
														))
														?> 
													</div>
												</div>
											</div>
										</div>

										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('นามหน่วยเหนือ');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('up_organization_name', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['up_organization_name'])? '':$default['up_organization_name'],
														))
														?> 
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('นามหน่วยรอง');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('under_organization_name', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
															'empty' => '- - - เลือก - - - ',
															'default' => empty($default['under_organization_name'])? '':$default['under_organization_name'],
														))
														?> 
													</div>
												</div>
											</div>
										</div>

										<div class="control-group">
											<div class="span6">
												
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

										<!--<button type="submit" class="btn btn-primary"><?php echo __('Search');?></button>-->
										
										<div class="form-actions">
											<input  type="hidden" name="offset" value="0" />
											<button type="submit" class="btn btn-primary hideme mm_15_list"><?php echo __('ค้นหา');?></button>
											<!--<button type="button" class="btn">Cancel</button>-->
										</div>
										
									</form>
								</div>
							</div>
						</div>
					</div>