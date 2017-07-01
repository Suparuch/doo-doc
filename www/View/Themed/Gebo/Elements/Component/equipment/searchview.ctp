<?php 
		$default['tech_id'] = empty($default['tech_id']) ? '' : $default['tech_id']; 
		$default['code'] = empty($default['code']) ? '' : $default['code'];
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
?>					
					<div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3 class="heading"><!--<i class="icon-th-list"></i>-->
									<?php echo __('ค้นหา') . ' ' . __('ข้อมูลยุทโธปกรณ์') ;?>
									</h3>
								</div>
                                                                
								<div class="box-content nopadding">
									<form  action="../../Equipments" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
										<input  type="hidden" name="offset" value="0" />
										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('สายยุทธบริการ');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<select  name="data[tech_id]"  data-placeholder="กรุณาเลือกสายยุทธบริการ" class="chzn_a input-xlarge" >
																<option id="ui_slider3_sel" value=""></option>
																<?php foreach($Techs as $key => $Tech) { ?>
																<option value="<?php echo $key; ?>"><?php echo $Tech; ?></option>
																<?php  } ?>

														</select>        
														<script>
															$('[name="data[tech_id]"]').val(<?php echo $default['tech_id'] ?>);
														</script>
													</div>
												</div>
											</div>

										</div>
										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('หมายเลขรหัส');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<input name="code" type="text" value="<?php echo $default['code']; ?>" 
														class='complexify-me input-block-level' placeholder="<?php echo __('หมายเลขรหัส');?>">
													</div>
												</div>
											</div>
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ชื่อยุทโธปกรณ์');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<input name="name" type="text" value="<?php echo $default['name']; ?>" 
														class='complexify-me input-block-level' placeholder="<?php echo __('ชื่อ');?>">
													</div>
												</div>
											</div>

										</div>
										<input  type="hidden" name="offset" value="0" />
                                                                            
										<!--<button type="submit" class="btn btn-primary"><?php //echo __('Search');?></button>-->
										
										
											<button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary add_rows_simple hideme mm_3_list"><?php echo __('ค้นหา');?></button>
											<!--<button type="button" class="btn">Cancel</button>-->
										
										
									</form>
								</div>
							</div>
						</div>
					</div>