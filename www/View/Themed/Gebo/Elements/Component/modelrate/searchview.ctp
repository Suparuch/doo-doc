<?php 
        $default['code'] = empty($default['code']) ? '' : $default['code'];
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3 class="heading"><!--<i class="icon-th-list"></i>-->
					<?php echo $ModelTypes[$model_type_id];?>
				</h3>
			</div>
			<div class="box-content nopadding">

				<form  action="../../ModelRates" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>

					<div class="control-group">
						<div class="span5">
							<label for="textfield" class="control-label"><?php echo __('หมายเลข');?> <?php echo $ModelTypeShorts[$model_type_id];?> : </label>
							<div class="controls">
								<div class="input-xlarge">
									<input name="code" type="text" value="<?php echo $default['code']; ?>" class='complexify-me input-block-level' onkeypress="keyNumberArabicAndTextThai(event);" placeholder="<?php echo __('หมายเลข');?> <?php echo $ModelTypeShorts[$model_type_id];?>">
								</div>
							</div>
						</div>
						<div class="span1">
						<button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary"><?php echo __('ค้นหา');?></button>
						</div>  
					</div>
					<input type="hidden" name="offset" value="0" />
					<input type="hidden" name="model_type_id" value="<?php echo $model_type_id; ?>" />
					  
				</form>
			</div>
		</div>
	</div>
</div>