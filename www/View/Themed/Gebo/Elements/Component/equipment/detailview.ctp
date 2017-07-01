<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('รายละเอียด  ข้อมูลยุทโธปกรณ์') ;?></h3>-->
			<div class="box-content nopadding">
				<?php //echo $this->Form->create('Accounts', array('action' => 'saveAccount','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table class="table table-bordered">
						    <thead>
							<tr>
							    <th colspan=12><center>รายละเอียด  ข้อมูลยุทโธปกรณ์</center></th>
							</tr>
						    </thead>
						    <tbody>
							<tr>
							    <td>หมายเลข </td>
							    <td>กข455048</td>
							</tr>
							<tr>
							    <td>ชื่อยุทโธปกรณ์ </td>
							    <td>ไม้พายเรือยาง</td>
							</tr>
							<tr>
							    <td>รูปยุทโธปกรณ์ </td> 
							    <td>
								<div data-provides="fileupload" class="fileupload fileupload-new">
									<input type="hidden">
									<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
									<a href='<?php echo $this->Html->url('/FileProviders/index/', true);?><?php echo $default['image_key'];?>' target='_blank'>
									<img src="<?php echo $this->Html->url('/FileProviders/index/', true);?><?php echo $default['image_key'];?>" alt="">
									</a>
									</div>
									<div style="max-width: 200px; max-height: 150px; line-height: 0px;" class="fileupload-preview fileupload-exists thumbnail"></div>
								</div>
							    </td>
							</tr>
							<tr>
							    <td>ข้อมูลเฉพาะ </td>
							    <td></td>
							</tr>

						    </tbody>
						</table>	

						


					</div>
					
				<?php  //echo $this->Form->end(' รายละเอียด  '); ?>
		</div>
	</div>
</div>