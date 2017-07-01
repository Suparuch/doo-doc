<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('ข้อมูลแฟ้มประวัติ') ;?></h3>-->
			<div class="box-content nopadding">
				<?php //echo $this->Form->create('Folders', array('action' => 'saveFolder','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table id='modelSubGroup' class="table table-bordered">
						    <thead>
							<!--
							<tr>
							    <th colspan="5"><center>รายละเอียดบัญชีการจัดหน่วยทหาร</center></th>
							</tr>						    
							-->
							<tr>
							    <th width='110'><b><?php echo __('หมายเลข อจย.');?>   </b></th>
							    <th width='200'><b><?php echo __('ชื่อ(ย่อ)อจย.');?>   </b></th>
							    <th width='100'><b><?php echo __('วันที่');?>   </b></th>
							    <th width='50'><b><?php echo __('จำนวน');?>   </b></th>
							    <th><b><?php echo __('หมายเหตุ');?>   </b></th>
							    <th></th>
							</tr>
						    </thead>
						    
						    <tbody>
							<tr>
							    <td><input type="text" class="input-block-level" name=""></td>
							    <td></td>
							    <td></td>
							    <td><input type="text" class="input-block-level" name=""></td>
							    <td><input type="text" class="complexify-me " name=""></td>
							    <td><i class="icon-trash" id="delete"></i></td>
							</tr>
							
						    </tbody>
						</table><br>
						<i id='add-model'class="splashy-document_a4_add"></i>เพิ่ม อจย.
						<br><br><br><br>
						<a class="btn" href="#">
						<i class="splashy-error_small"></i>
						เพิ่ม อจย.
						</a>
						<button type="submit" class="btn"><?php echo __('เพิ่ม อจย.');?></button>
						<button type="submit" class="btn btn-primary"><?php echo __('บันทึก');?></button>

						<!--
						<div class="form-actions">
							<button type="submit" class="btn btn-primary"><?php echo __('แก้ไข');?></button>
							<button type="submit" class="btn btn-primary"><?php echo __('ลบหน่วย');?></button>
						</div>
						-->

					</div>
					
				<?php //echo $this->Form->end();?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function () {

	$("#add-model").click(function(event){

		//alert('ok');
		$('#modelSubGroup').append('<tr><td><input type="text" class="input-block-level" name=""></td><td></td><td></td><td><input type="text" class="input-block-level" name=""></td><td><input type="text" class="complexify-me " name=""></td><td><i class="icon-trash" id="delete"></i></td></tr>');
		//var model_id = $(this).attr("model_id");
		//alert(model_id);
		//$('#customModal').load("/Models/action",function(data) {

		//});
		
	});

});
</script>