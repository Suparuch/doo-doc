<?php 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล ผู้ใช้งาน
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span6">
					<div class="dt_actions">
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
							<li class='hideme mm_10_add'><a href="#myModal2" onclick="addUser();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
                            
                            <li class='hideme mm_10_add'><a href="#" onclick="edit_unit();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> จัดการหน่วยผู้ใช้งาน </a></li>
<li class='hideme mm_11_add'><a href="#" onclick="edit_premission();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> สิทธิ์การใช้งาน </a></li>

								<li class='hideme mm_10_delete'><a href="#"  class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>

							</ul>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form  action="../../Users" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								<input name="name" type="text" value="<?php echo $default['name']; ?>" placeholder="<?php echo __('ชื่อผู้ใช้งาน');?>" onkeypress="keyTextThai()">
								<button id="Unit-submit" type="submit" class="btn btn-primary hideme mm_10_list">ค้นหา</button>
								<input type="hidden" name="offset" value="0" />
							</form>
						</label>						
					</div>
				</div>
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
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editUser('<?php echo $user['User']['id']; ?>');" class="ttip_b hideme mm_10_edit" ><i class="icon-pencil"></i></a>
							<a href="#" class=' hideme mm_10_delete'><i onclick="deleteUser('<?php echo $user['User']['id']; ?>')" class="icon-trash"></i></a>
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
function edit_unit(){
	window.location="../../Units/index/";   
}

function edit_premission(){
	window.location="../../AclRoles/";   
}
    
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
    
			
			function deleteUser(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();

                    if(ids.length != 0){  

                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../Users/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../Users/index/";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }
            }
    

            function getChecks(){

                var checkboxes = $("[name='userID[]']");
               
                var ids = [];

                $.each( checkboxes, function( key, checkbox ) {
                      if(checkbox.checked===true) {
                        ids.push(checkbox.value); 
                      }
                });                        
                
                return ids;
            }  
			  $(".delete").click(function(){

                var id = $(this).attr("value");              
                deleteUser(id);
            });
</script>