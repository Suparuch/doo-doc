<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
				<?php echo $ModelTypes[$model_type_id];?>
				</h3>
			</div>

			<div class="btn-group sepH_b">
				<button data-toggle="dropdown" class="btn btn-info dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="#myModal2" class="add" onclick='addData()' data-toggle="modal" data-backdrop="static" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
					<li><a style="cursor:pointer" class="delete" onclick='deleteData()' data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
					<li><a style="cursor:pointer" class="copy" onclick='copyData()' data-tableid="smpl_tbl"><i class="splashy-document_copy"></i> คัดลอก</a></li>
					<li><a style="cursor:pointer" class="lock" href="javascript:void(0)"><i class="splashy-lock_large_locked"></i> ห้ามแก้ไข</a></li>
				</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table id="mainTable" class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><input type="checkbox" class="toggle"></th>
							<th>หมายเลข อจย.</th>
							<th>วันที่ตั้ง</th>
							<th>ชื่อ อจย. (ย่อ)</th>
							<th>แก้ไขล่าสุด</th>
							<th>สถานะ</th>
							<th width='80'></th>
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
								<?php echo empty($ModelRate['ModelRate']['name'])? ' ' : $ModelRate['ModelRate']['name'];?>							
							</td>
							<td><center>
								<?php echo empty($ModelRate['ModelRate']['updated'])? ' ' : $this->DateFormat->formatDateThai($ModelRate['ModelRate']['updated']);?>    
							</td></center>
							<td><center>
								<?php echo empty($ModelRate['ModelRate']['model_status_id'])? ' ' : $ModelStatus[$ModelRate['ModelRate']['model_status_id']];?>	
							</td></center>
							<td>
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" class="view" onclick="viewData('<?php echo (string)$ModelRate['ModelRate']['id']; ?>')" value="<?php echo (string)$ModelRate['ModelRate']['id']; ?>" ><i class="splashy-zoom_in"></i></a>
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" class="edit" onclick="editData('<?php echo (string)$ModelRate['ModelRate']['id']; ?>')" value="<?php echo (string)$ModelRate['ModelRate']['id']; ?>" ><i class="icon-pencil"></i></a>
								<a style="cursor:pointer" class="delete" onclick="deleteData('<?php echo (string)$ModelRate['ModelRate']['id']; ?>')" value="<?php echo (string)$ModelRate['ModelRate']['id']; ?>"><i class="icon-trash"></i></a>
								<a data-toggle="modal" data-backdrop="static" href="#" class="lock" onclick="lockData('<?php echo (string)$ModelRate['ModelRate']['id']; ?>')" value="<?php echo $ModelRate['ModelRate']['id']; ?>" ><i is_locked='<?php echo $ModelRate['ModelRate']['is_locked']; ?>' class="splashy-lock_large_<?php echo $ModelRate['ModelRate']['is_locked']=='Y'? '':'un'; ?>locked" id='lock-<?php echo $ModelRate['ModelRate']['id']; ?>'></i></a>
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