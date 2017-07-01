					<div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3 class="heading"><!--<i class="icon-th-list"></i>-->
									<?php echo __('ค้นหา') . ' ' . __('ตำแหน่งของพนักงานราชการ') ;?>
									</h3>
								</div>
								<div class="box-content nopadding">
									<form action="#" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>

										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ชื่อตำแหน่ง');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('name', array(
															'label' => false,
															'div' => false,
															'class' => 'span12',
														))
														?> 
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('กลุ่มงาน');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<?php
															echo $this->Form->input('position_group_id', array(
															'label' => false,
															'div' => false,
															'options' => $PositionGroups, 
															'class' => 'span12',
															'empty' => ''
														))
														?> 
													</div>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-primary  hideme mm_26_list"><?php echo __('ค้นหา');?></button>
										<input  type="hidden" name="offset" value="0" />
										
									</form>
								</div>
							</div>
						</div>
					</div>