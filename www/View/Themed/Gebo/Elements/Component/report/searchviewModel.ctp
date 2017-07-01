<?php 
		$default['code'] = empty($default['code']) ? '' : $default['code'];		//เลข อจย./อฉก.
		$default['name'] = empty($default['name']) ? '' : $default['name'];		//ชื่อ อจย./อฉก.		
		$default['organization_id'] = empty($default['organization_id']) ? '' : $default['organization_id'];		//หน่วยงาน
		$default['organization_science_id'] = empty($default['organization_science_id']) ? '' : $default['organization_science_id'];		//สาย-หน่วย วิทยาการ
		$default['model_position_id'] = empty($default['model_position_id']) ? '' : $default['model_position_id'];				//ตำแหน่ง
		//$default['model_type_id'] = empty($default['model_type_id']) ? '' : $default['model_type_id'];			//
		$default['model_status_id'] = empty($default['model_status_id']) ? '' : $default['model_status_id'];	//สถานะ
		$default['mos'] = empty($default['mos']) ? '' : $default['mos'];	//ชกท
		$default['corp_id'] = empty($default['corp_id']) ? '' : $default['corp_id'];
		$default['rank_id'] = empty($default['rank_id']) ? '' : $default['rank_id'];
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3 class="heading"><!--<i class="icon-th-list"></i>-->
				<?php echo __('ค้นหา') . ' ' . __('อัตราการจัด ตามแบบ') ;?>
				</h3>
			</div>
			<div class="box-content nopadding">

				<form  action="../../Reports/byModel" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>

					<div class="control-group">
						<div class="span6">
							<label for="textfield" class="control-label"><?php echo __('หมายเลข อจย.');?> : </label>
							<div class="controls">
								<div class="input-xlarge">
									<input name="code" type="text" value="<?php echo $default['code']; ?>" 
									class='complexify-me input-block-level' placeholder="<?php echo __('หมายเลข อจย.');?>">
								</div>
							</div>
						</div>
						<div class="span6">
							<label for="textfield" class="control-label"><?php echo __('ชื่อ อจย.');?> : </label>
							<div class="controls">
								<div class="input-xlarge">
									<input name="name" type="text" value="<?php echo $default['name']; ?>" 
									class='complexify-me input-block-level' placeholder="<?php echo __('ชื่อ  อจย.');?>">
								</div>
							</div>
						</div>
					</div>

					<div class="control-group">
						<div class="span6">
							<label for="textfield" class="control-label"><?php echo __('หน่วยงาน');?> : </label>
							<div class="controls">
								<div class="input-xlarge">                                                                                                        
									<select  name="data[organization_id]"  data-placeholder="กรุณาเลือก หน่วยงาน" class="chzn_a input-xlarge" >				
											<option id="ui_slider3_sel" value=""></option>
											<?php foreach($Organizations as $key => $Organization) { ?>
											<option value="<?php echo $key; ?>"><?php echo $Organization; ?></option>                       
											<?php  } ?>

									</select>        
									<script>
										$('[name="data[organization_id]"]').val(<?php echo $default['organization_id'] ?>);
									</script>                                                                               
								</div>
							</div>
						</div>

						<div class="span6">
							<label for="textfield" class="control-label"><?php echo __('สาย/หน่วย วิทยาการ');?> : </label>
							<div class="controls">
								<div class="input-xlarge">                                                                                                        
									<select  name="data[organization_science_id]"  data-placeholder="กรุณาเลือก สาย/หน่วย วิทยาการ" class="chzn_a input-xlarge" >				
											<option id="ui_slider3_sel" value=""></option>
											<?php foreach($OrganizationSciences as $key => $OrganizationScience) { ?>
											<option value="<?php echo $key; ?>"><?php echo $OrganizationScience; ?></option>                       
											<?php  } ?>

									</select>        
									<script>
										$('[name="data[organization_science_id]"]').val(<?php echo $default['organization_science_id'] ?>);
									</script>                                                                               
								</div>
							</div>
						</div>
					</div>

					<div class="control-group">
						<div class="span6">
							<label for="textfield" class="control-label"><?php echo __('เหล่า');?> : </label>
							<div class="controls">
								<div class="input-xlarge">                                                                                                        
									<select  name="data[corp_id]"  data-placeholder="กรุณาเลือกเหล่า" class="chzn_a input-xlarge" >				
											<option id="ui_slider3_sel" value=""></option>
											<?php foreach($Corps as $key => $Corp) { ?>
											<option value="<?php echo $key; ?>"><?php echo $Corp; ?></option>                       
											<?php  } ?>

									</select>        
									<script>
										$('[name="data[corp_id]"]').val(<?php echo $default['corp_id'] ?>);
									</script>                                                                               
								</div>
							</div>
						</div>

						<div class="span6">
							<label for="textfield" class="control-label"><?php echo __('ยศ');?> : </label>
							<div class="controls">
								<div class="input-xlarge">                                                                                                        
									<select  name="data[rank_id]"  data-placeholder="กรุณาเลือกยศ" class="chzn_a input-xlarge" >				
											<option id="ui_slider3_sel" value=""></option>
											<?php foreach($Ranks as $key => $Rank) { ?>
											<option value="<?php echo $key; ?>"><?php echo $Rank; ?></option>                       
											<?php  } ?>

									</select>        
									<script>
										$('[name="data[rank_id]"]').val(<?php echo $default['rank_id'] ?>);
									</script>                                                                               
								</div>
							</div>
						</div>
					</div>

					<div class="control-group">
						<div class="span6">
							<label for="textfield" class="control-label"><?php echo __('หมายเลข  ชกท.');?> : </label>
							<div class="controls">
								<div class="input-xlarge">
									<input name="mos" type="text" value="<?php echo $default['mos']; ?>" 
									class='complexify-me input-block-level' placeholder="<?php echo __('หมายเลข ชกท.');?>">
								</div>
							</div>
						</div>

						<div class="span6">
							<label for="textfield" class="control-label"><?php echo __('ตำแหน่ง');?> : </label>
							<div class="controls">
								<div class="input-xlarge">                                                                                                        
									<select  name="data[model_position_id]"  data-placeholder="กรุณาเลือก ตำแหน่ง" class="chzn_a input-xlarge" >				
											<option id="ui_slider3_sel" value=""></option>
											<?php foreach($ModelPositions as $key => $Position) { ?>
											<option value="<?php echo $key; ?>"><?php echo $ModelPosition; ?></option>                       
											<?php  } ?>

									</select>        
									<script>
										$('[name="data[model_position_id]"]').val(<?php echo $default['model_position_id'] ?>);
									</script>                                                                               
								</div>
							</div>
						</div>

					</div>

					<div class="control-group">

						<div class="span6">
							<label for="textfield" class="control-label"><?php echo __('สถานะ');?> : </label>
							<div class="controls">
								<div class="input-xlarge">                                                                                                        
									<select  name="data[model_status_id]"  data-placeholder="กรุณาเลือก สถานะ" class="chzn_a input-xlarge" >				
											<option id="ui_slider3_sel" value=""></option>
											<?php foreach($ModelStatuss as $key => $ModelStatus) { ?>
											<option value="<?php echo $key; ?>"><?php echo $ModelStatus; ?></option>                       
											<?php  } ?>

									</select>        
									<script>
										$('[name="data[model_status_id]"]').val(<?php echo $default['model_status_id'] ?>);
									</script>                                                                               
								</div>
							</div>
						</div>

					</div>


					<div class="control-group">
						<div class="span1">
							<button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary hideme mm_8_list"><?php echo __('ค้นหา');?></button>
						</div>  
					</div>
					<input type="hidden" name="offset" value="0" />
					  
				</form>
			</div>
		</div>
	</div>
</div>