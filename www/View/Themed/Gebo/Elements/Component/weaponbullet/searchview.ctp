<?php 
		$default['weapon_type_id'] = empty($default['weapon_type_id']) ? '' : $default['weapon_type_id']; 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
?>					
					<div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3 class="heading"><!--<i class="icon-th-list"></i>-->
									<?php echo __('ค้นหา') . ' ' . __('คุณลักษณะกระสุนและวัตถุระเบิด') ;?>
									</h3>
								</div>
                                                                
								<div class="box-content nopadding">
									<form  action="../../WeaponBullets" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
										<input  type="hidden" name="offset" value="0" />
										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ประเภทอาวุธ');?> : </label>
												<div class="controls">
													<div class="input-xlarge">                                                                                                        
														<select  name="data[weapon_type_id]"  data-placeholder="กรุณาเลือกประเภทอาวุธ" class="chzn_a input-xlarge" >				
																<option id="ui_slider3_sel" value=""></option>
																<?php foreach($WeaponTypes as $key => $WeaponType) { ?>
																<option value="<?php echo $key; ?>"><?php echo $WeaponType; ?></option>                       
																<?php  } ?>
														</select>        
														<script>
															$('[name="data[weapon_type_id]"]').val(<?php echo $default['weapon_type_id'] ?>);
														</script>                                                                               
													</div>
												</div>
											</div>

											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ชนิดอาวุธ');?> : </label>
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
										
										
											<button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary  hideme mm_27_list"><?php echo __('ค้นหา');?></button>
											<!--<button type="button" class="btn">Cancel</button>-->
										
										
									</form>
								</div>
							</div>
						</div>
					</div>