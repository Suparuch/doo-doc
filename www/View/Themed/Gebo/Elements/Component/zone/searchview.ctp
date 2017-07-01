<?php 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
        $default['province_id'] = empty($default['province_id']) ? '' : $default['province_id']; 
?>					
                                        <div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3 class="heading"><!--<i class="icon-th-list"></i>-->
									<?php echo __('ค้นหา') . ' ' . __('ข้อมูลอำเภอ') ;?>
									</h3>
								</div>
                                                                
								<div class="box-content nopadding">
									<form  action="../../Zones" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
                                                                                <input  type="hidden" name="offset" value="0" />
										<div class="control-group">
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('ชื่อ');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
														<input name="name" type="text" value="<?php echo $default['name']; ?>" 
                                                                                                                class='complexify-me input-block-level' placeholder="<?php echo __('ชื่อ');?>">
													</div>
												</div>
											</div>
											<div class="span6">
												<label for="textfield" class="control-label"><?php echo __('จังหวัด');?> : </label>
												<div class="controls">
													<div class="input-xlarge">
                                                                                                         
                                                                                                            <select  name="data[province_id]"  data-placeholder="กรุณาเลือกจังหวัด" class="chzn_a input-xlarge" >				
                                                                                                                    <option id="ui_slider3_sel" value=""></option>
                                                                                                                    <?php foreach($provinces as $key => $province) { ?>
                                                                                                                    <option value="<?php echo $key; ?>"><?php echo $province; ?></option>                       
                                                                                                                    <?php  } ?>

                                                                                                            </select>        
                                                                                                            <script>
                                                                                                                $('[name="data[province_id]"]').val(<?php echo $default['province_id'] ?>);
                                                                                                            </script>                                                                               
													</div>
												</div>
											</div>

										</div>
                                                                                <input  type="hidden" name="offset" value="0" />
                                                                            
										<!--<button type="submit" class="btn btn-primary"><?php //echo __('Search');?></button>-->
										
										
											<button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary  hideme mm_23_list"><?php echo __('ค้นหา');?></button>
											<!--<button type="button" class="btn">Cancel</button>-->
										
										
									</form>
								</div>
							</div>
						</div>
					</div>