<?php 
		$default['code'] = empty($default['code']) ? '' : $default['code'];		//เลข อจย./อฉก.
		$default['name'] = empty($default['name']) ? '' : $default['name'];		//ชื่อ อจย./อฉก.		
		$default['organization_id'] = empty($default['organization_id']) ? '' : $default['organization_id'];		//หน่วยงาน
		$default['organization_science_id'] = empty($default['organization_science_id']) ? '' : $default['organization_science_id'];		//สาย-หน่วย วิทยาการ
		$default['position_id'] = empty($default['position_id']) ? '' : $default['position_id'];				//ตำแหน่ง
		//$default['model_type_id'] = empty($default['model_type_id']) ? '' : $default['model_type_id'];			//
		$default['model_status_id'] = empty($default['model_status_id']) ? '' : $default['model_status_id'];	//สถานะ
		$default['mos'] = empty($default['mos']) ? '' : $default['mos'];	//ชกท
		//$default['corp_id'] = empty($default['corp_id']) ? '' : $default['corp_id'];
		//$default['rank_id'] = empty($default['rank_id']) ? '' : $default['rank_id'];
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3 class="heading"><!--<i class="icon-th-list"></i>-->
				<?php echo __('ค้นหา') . ' ' . __(' อัตราการจัด ตามหน่วยงาน') ;?>
				</h3>
			</div>
			<div class="box-content nopadding">

				<form  action="../../Reports/byOrganization" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>

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


					</div>


					<div class="control-group">
						<div class="span1">
							<button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary hideme mm_9_list"><?php echo __('ค้นหา');?></button>
						</div>  
					</div>
					<input type="hidden" name="offset" value="0" />
					  
				</form>
			</div>
		</div>
	</div>
</div>