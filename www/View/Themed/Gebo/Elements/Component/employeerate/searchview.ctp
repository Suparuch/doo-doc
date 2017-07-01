					<div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3 class="heading"><!--<i class="icon-th-list"></i>-->
									<?php echo __('ค้นหา') . ' ' . __('อัตราพนักงานราชการ') ;?>
									</h3>
								</div>
								<div class="box-content nopadding">
									<form action="#" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>

										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('รหัสหน่วย');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('organization_code', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
                                                                                                                        'onkeypress' => 'return keyNumberEng(event)'
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
															echo $this->Form->input('organization_name', array(
															'label' => false,
															'div' => false,
															'class' => 'span12'
														))
														?> 
													</div>
												</div>
											</div>
										</div>
										<input type="submit" class="btn btn-primary hideme mm_5_list" value="<?php echo __('ค้นหา');?>" />
										<input  type="hidden" name="offset" value="0" />
										
									</form>
								</div>
							</div>
						</div>
					</div>