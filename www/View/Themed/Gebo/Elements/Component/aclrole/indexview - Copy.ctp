<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล สิทธิ์ผู้ใช้งาน
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#myModal2" onclick="addAclRole();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li><a href="#"  class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><input type="checkbox" onclick="toggleAclRole(this);"></th>
							<th style="text-align: center;">ลำดับ</th>
							<th style="text-align: center;">ชื่อสิทธิ์ผู้ใช้งาน</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($AclRoles)) { ?>
						<?php foreach($AclRoles as $AclRole) { ?>
						<tr>
                                                        
							<td style="text-align: center;">
								<input type="checkbox" name="AclRoleID[]" value="<?php echo $AclRole['AclRole']['id']; ?>"></td>  
							<td style="text-align: center;">
								<?php //if(!empty($AclRole['AclRole']['order_sort'])) 
										//echo $AclRole['AclRole']['order_sort']; 
										echo ++$pagination['offset'];
								?>
							</td>
							<td>
								<?php if(!empty($AclRole['AclRole']['name'])) 
										echo $AclRole['AclRole']['name']; 
								?>    
							</td>
							<td>
								<?php if(!empty($AclRole['AclRole']['created'])) 
										echo $this->DateFormat->formatDateThai($AclRole['AclRole']['created']); 
								?>    
							</td>
							<td>
								<?php if(!empty($AclRole['AclRole']['updated'])) 
										echo $this->DateFormat->formatDateThai($AclRole['AclRole']['updated']); 
								?>    
							</td>
							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editAclRole('<?php echo $AclRole['AclRole']['id']; ?>');" ><i class="icon-pencil"></i></a>
							<a href="#" class="delete" value="<?php echo (string)$AclRole['AclRole']['id']; ?>"><i class="icon-trash"></i></a>
							</td>
                                                         
						</tr>
						<?php } ?>
						<?php }else{ ?>
							<tr>
									<td colspan="6" style="text-align:center;">
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

<script type="text/javascript">
    
            function toggleAclRole(source) 
            {

              var checkboxes = document.getElementsByName('AclRoleID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }
            }    
                        
            function addAclRole(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างสิทธิ์ผู้ใช้งานใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../AclRoles/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editAclRole(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลสิทธิ์ผู้ใช้งาน');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../AclRoles/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

				  $("#myModal2").css({
						"width":"800px",
						"top":"6%",
						"left":"680px"
				  });
				  
				  $(".modal-body").css({
						"max-height":"500px"
				  });  

            }               
            
            
            
             function deleteAclRole(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();
                                
                               
                                 
                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../AclRoles/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../AclRoles";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
                     
            
            function getChecks(){

                var checkboxes = $("[name='AclRoleID[]']");
               
                var ids = [];

                $.each( checkboxes, function( key, checkbox ) {
                      if(checkbox.checked===true) {
                        ids.push(checkbox.value); 
                      }
                });                        
                
                return ids;
            }             
</script>



<script>


            $(".delete").click(function(){

                var id = $(this).attr("value");              
                deleteAclRole(id);
            });      
    
   
</script>