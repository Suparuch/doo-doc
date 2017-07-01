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
                                                <li><a href="#myModal2" onclick="addRole();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li><a href="#" class="delete_rows_simple" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
                                                        <th style="text-align: center;"><input type="checkbox" onclick="toggleRole(this);"></th>
                                                        <th style="text-align: center;">ลำดับ</th>
							<th style="text-align: center;">ชื่อสิทธิ์</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
                                            <?php $i=0; foreach($roles as $role) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="roleID[]" value="<?php echo $role['Role']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php echo ++$i;
                                                        ?>
                                                        </td>
							<td>
                                                        <?php if(!empty($role['Role']['name'])) 
                                                                echo $role['Role']['name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($role['Role']['created'])) 
                                                                echo $this->DateFormat->formatDateThai($role['Role']['created']); 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($role['Role']['updated'])) 
                                                                echo $this->DateFormat->formatDateThai($role['Role']['updated']); 
                                                        ?>    
                                                        </td>
							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editRole();" class="ttip_b" ><i class="icon-pencil"></i></a>
                                                        <a href="#"><i onclick="deleteRole()" class="icon-trash"></i></a>
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
    
            function toggleRole(source) 
            {

              var checkboxes = document.getElementsByName('roleID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addRole(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างสิทธิผู้ใช้งานใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Roles/create",function(data) {
						$('#customModal2').html(data);
				  });

            }      
    
            function editRole(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขสิทธิผู้ใช้งาน');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Roles/create",function(data) {
						$('#customModal2').html(data);
				  });

            }       
    
            function deleteRole(){
                confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?");
            }
</script>