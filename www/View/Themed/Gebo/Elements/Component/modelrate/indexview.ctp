<?php 
        $default['code'] = empty($default['code']) ? '' : $default['code'];
?>
<script language='javascript'>
function gototree(){
	window.location.href='/ModelRates/indextree/1';
}
</script>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
				<?php echo $ModelTypes[$model_type_id];?>  <button id="ModelRate-submit-tree" onclick='gototree()' type="button" class="btn btn-primary hideme mm_1_list" style="display: inline-block;">แสดงผลรูปแบบ Tree</button>
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span6">
					<div class="dt_actions">
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li class='hideme mm_1_add'><a href="#myModal2" class="add" onclick='addData()' data-toggle="modal" data-backdrop="static" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
								<li class='hideme mm_1_delete delete'><a style="cursor:pointer" onclick='deleteData()' data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
								<li class='hideme mm_1_edit copy'><a style="cursor:pointer" onclick='copyData()' data-tableid="smpl_tbl"><i class="splashy-document_copy"></i> คัดลอก</a></li>
								<li><a style="cursor:pointer" class="lock" href="javascript:void(0)"><i class="splashy-lock_large_locked"></i> ห้ามแก้ไข</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form  action="../../ModelRates/index/<?php echo $model_type_id; ?>" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								<input name="code" type="text" aria-controls="dt_gal" value="<?php echo $default['code']; ?>" onkeypress="keyNumberArabicAndTextThai(event);" placeholder="<?php echo __('หมายเลข / ชื่อ');?> <?php echo $ModelTypeShorts[$model_type_id];?>">
								<button id="ModelRate-submit" type="submit" class="btn btn-primary hideme mm_1_list">ค้นหา</button>
								<input type="hidden" name="offset" value="0" />
								<input type="hidden" name="model_type_id" value="<?php echo $model_type_id; ?>" />
							</form>
						</label>						
					</div>
				</div>
			</div>

			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table id="mainTable" class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><input type="checkbox" class="toggle"></th>
							<th>หมายเลข <?php echo ($model_type_id==1?"อจย.":"อฉก."); ?> </th>
							<th>วันที่ตั้ง</th>
							<th>ชื่อ <?php echo ($model_type_id==1?"อจย.":"อฉก."); ?> (ย่อ)</th>
							<th width='150'>คำสั่ง ทบ. ที่ใช้</th>
							<th>สถานะ</th>
							<th width='100'></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($ModelRates)) { ?>
						<?php foreach($ModelRates as $ModelRate) { ?>
						<tr id='<?php echo (string)$ModelRate['ModelRate']['id']; ?>'>
							<td style="text-align: center;">
								<input type="checkbox" name="dataID[]" value="<?php echo $ModelRate['ModelRate']['id']; ?>"></td>						 
							</td>
							<td>
								<?php echo empty($ModelRate['ModelRate']['code'])? ' ' : $ModelRate['ModelRate']['code'];?>   
							</td>
							<td>
								<?php echo empty($ModelRate['ModelRate']['model_date'])? ' ' :$this->DateFormat->formatDateThai($ModelRate['ModelRate']['model_date']);?>   
							</td>
							<td>
								<?php echo empty($ModelRate['ModelRate']['short_name'])? ' ' : $ModelRate['ModelRate']['short_name'];?>							
							</td>
							<td><center>
								<?php echo empty($ModelRate['ModelRate']['command_user'])? ' ' :$ModelRate['ModelRate']['command_user'];?>    
							</td></center>
							<td><center>
								<?php echo empty($ModelRate['ModelRate']['model_status_id'])? ' ' : $ModelStatus[$ModelRate['ModelRate']['model_status_id']];?>	
							</td></center>
							<td>
                           	 <a onclick="show_document('<?php echo (string)$ModelRate['ModelRate']['id']; ?>')" data-toggle="modal" data-backdrop="static" href="#myModal2" class="view hideme mm_1_detail" value="<?php echo (string)$ModelRate['ModelRate']['id']; ?>" ><i class="icon-print"></i></a>
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" class="view hideme mm_1_detail" onclick="viewData('<?php echo (string)$ModelRate['ModelRate']['id']; ?>')" value="<?php echo (string)$ModelRate['ModelRate']['id']; ?>" ><i class="splashy-zoom_in"></i></a>
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" class="edit hideme mm_1_edit" onclick="editData('<?php echo (string)$ModelRate['ModelRate']['id']; ?>')" value="<?php echo (string)$ModelRate['ModelRate']['id']; ?>" ><i class="icon-pencil"></i></a>
								<a style="cursor:pointer" class="delete hideme mm_1_delete" onclick="deleteData('<?php echo (string)$ModelRate['ModelRate']['id']; ?>')" value="<?php echo (string)$ModelRate['ModelRate']['id']; ?>"><i class="icon-trash"></i></a>
								<a data-toggle="modal" data-backdrop="static" href="#" class="lock hideme mm_1_edit" onclick="lockData('<?php echo (string)$ModelRate['ModelRate']['id']; ?>')" value="<?php echo $ModelRate['ModelRate']['id']; ?>" ><i is_locked='<?php echo $ModelRate['ModelRate']['is_locked']; ?>' class="splashy-lock_large_<?php echo $ModelRate['ModelRate']['is_locked']=='Y'? '':'un'; ?>locked" id='lock-<?php echo $ModelRate['ModelRate']['id']; ?>'></i></a>
								<!--<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="lockModelRate('<?php echo $ModelRate['ModelRate']['id']; ?>');" ><i is_locked='Y' class="splashy-lock_large_locked action-lock"></i></a>-->
							</td>
						</tr>
						<?php } ?>
						<?php }else{ ?>
						<tr>
							<td colspan="7" style="text-align:center;">
									ไม่พบข้อมูลที่ตรงกัน
							</td>
						</tr>                                                  
						<?php } ?>

					</tbody>
				</table>

				</div>
			</div>

		</div>
	</div>
</div>
<script language="javascript">
function reloaddocument(id){
	$('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูล ' + "<?php echo $ModelTypes[$model_type_id];?>");
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/editModelRate/"+id,function(data) {
						$('#customModal2').html(data);
						 $('a[href="#tabDocument"]').tab('show');
						 
				  });                        
				  screenModalFull();
}
</script>