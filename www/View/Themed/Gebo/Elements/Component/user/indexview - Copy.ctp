<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล ผู้ใช้งาน
				</h3>
			</div>
			<div class="btn-group sepH_b">
				<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="#myModal2" onclick="addUser();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
					<li><a href="#" class="delete_rows_simple" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
				</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><input type="checkbox" onclick="toggleUser(this);"></th>
							<th style="text-align: center;">ลำดับ</th>
							<th style="text-align: center;">ชื่อผู้ใช้งานในระบบ</th>
							<th style="text-align: center;">ชื่อ - สกุล</th>
							<th style="text-align: center;">สิทธิ์</th>
							<th style="text-align: center;">หน่วยงาน</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach($users as $user) { ?>
						<tr>
                                                        
							<td style="text-align: center;">
								<input type="checkbox" name="userID[]" value="<?php echo $user['User']['id']; ?>"></td>  
							<td style="text-align: center;">
							<?php 
									echo ++$i; 
							?>
							</td>
							<td>
							<?php if(!empty($user['User']['username'])) 
									echo $user['User']['username']; 
							?>    
							</td>
							<td>
							<?php if(!empty($user['UserProfile']['name']) && !empty($user['UserProfile']['surname'])) 
									echo $user['UserProfile']['name']." ".$user['UserProfile']['surname']; 
							?>    
							</td>
							<td>
							<?php if(!empty($user['AclRole']['name'])) 
									echo $user['AclRole']['name']; 
							?>    
							</td>						
							<td>
							<?php if(!empty($user['User']['unit_id'])) 
									echo $Units[$user['User']['unit_id']]; 
							?>    
							</td>
							<td>
							<?php if(!empty($user['User']['created'])) 
									echo $this->DateFormat->formatDateThai($user['User']['created']); 
							?>    
							</td>
							<td>
							<?php if(!empty($user['User']['updated'])) 
									echo $this->DateFormat->formatDateThai($user['User']['updated']); 
							?>    
							</td>
							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editUser('<?php echo $user['User']['id']; ?>');" class="ttip_b" ><i class="icon-pencil"></i></a>
							<a href="#"><i onclick="deleteUser()" class="icon-trash"></i></a>
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

<script type="text/javascript">
    
            function toggleUser(source) 
            {

              var checkboxes = document.getElementsByName('userID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }

            }    
                        
            function addUser(){

		$('#customModal2').html('');
		$('#customModalHeader2').html('สร้างผู้ใช้งานใหม่');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../Users/create",function(data) {
			$('#customModal2').html(data);
		});

            }      
            
            function editUser(id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('แก้ไขข้อมูลผู้ใช้งาน');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../Users/edit/"+id,function(data) {
			$('#customModal2').html(data);
		});

            }                
    
            function deleteUser(){
                confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?");
            }
</script>