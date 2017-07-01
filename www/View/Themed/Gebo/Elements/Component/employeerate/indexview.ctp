<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูลอัตราพนักงานราชการ
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#myModal2" onclick="addEmployeeOrganization();" data-toggle="modal" data-backdrop="static" class="add_rows_simple add_rows_simple hideme mm_5_add" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li class=' hideme mm_5_delete'><a href="#" class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;" width=5><input type="checkbox" onclick="toggleEmployeeOrganization(this);"></th>
							<th>รหัสหน่วย</th>
							<th>นามหน่วยย่อ</th>
							<th>สร้างวันที่</th>
							<th>แก้ไขวันที่</th>
							<th width=40></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($EmployeeOrganizations)) { ?>
						<?php foreach($EmployeeOrganizations as $EmployeeOrganization) { ?>
						<tr>
						<tr>
							<td style="text-align: center;">
								<input type="checkbox" name="EmployeeOrganizationID[]" value="<?php echo $EmployeeOrganization['EmployeeOrganization']['id']; ?>"></td>  
							<td>
								<?php if(!empty($EmployeeOrganization['EmployeeOrganization']['organization_code'])) 
										echo $EmployeeOrganization['EmployeeOrganization']['organization_code']; 
								?> 
							</td>
							<td>
								<?php if(!empty($EmployeeOrganization['EmployeeOrganization']['organization_name'])) 
										echo $EmployeeOrganization['EmployeeOrganization']['organization_name']; 
								?>
							</td>
							<td>
								<?php if(!empty($EmployeeOrganization['EmployeeOrganization']['created'])) 
										echo $this->DateFormat->formatDateThai($EmployeeOrganization['EmployeeOrganization']['created']); 
								?>    
							</td>
							<td>
								<?php if(!empty($EmployeeOrganization['EmployeeOrganization']['updated'])) 
										echo $this->DateFormat->formatDateThai($EmployeeOrganization['EmployeeOrganization']['updated']); 
								?>    
							</td>
							<td style="text-align: center;">								
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editEmployeeRate('<?php echo $EmployeeOrganization['EmployeeOrganization']['id']; ?>');" class=' hideme mm_5_detail' ><i class="icon-user"></i></a>
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editEmployeeOrganization('<?php echo $EmployeeOrganization['EmployeeOrganization']['id']; ?>');" class=' hideme mm_5_delete' ><i class="icon-pencil"></i></a>
								<!--<a href="#" class="delete" value="<?php echo (string)$EmployeeOrganization['EmployeeOrganization']['id']; ?>"><i class="icon-trash"></i></a>-->
							</td>
						</tr>
						<?php } ?>
						<?php }else{ ?>
							<tr>
									<td colspan="5" style="text-align:center;">
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

<style>
    #customModal2{
        height:600px;
    }
    
</style>
<script type="text/javascript">
  
  
            function toggleEmployeeOrganization(source) 
            {

				var checkboxes = document.getElementsByName('EmployeeOrganizationID[]');
				for(var i in checkboxes)
				{
					checkboxes[i].checked = source.checked;
				}

            }    
                        
            function addEmployeeOrganization(){

				$('#customModal2').html('');
				$('#customModalHeader2').html('สร้าง อัตราพนักงานราชการ ใหม่');
				$('#customModalAction2').html('บันทึก');
				$('#customModal2').load("../../EmployeeRates/form",function(data) {
					$('#customModal2').html(data);
				});

            }        
            
            function editEmployeeOrganization(id){

				$('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไข ข้อมูลอัตราพนักงานราชการ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../EmployeeRates/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }

            function editEmployeeRate(id){

				$('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไข อัตราพนักงานราชการ');
				  $('#customModalAction2').html('ปิด');
				  $('#customModal2').load("../../EmployeeRates/formRate/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }         
            
            function deleteEmployeeOrganization(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();

				if(ids.length != 0){  

					if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
					var url = "../../EmployeeOrganizations/delete";
							$.post(url,{
									ids:ids,

							},function(data){

								if(data.status == "SUCCESS"){

									window.location="../../EmployeeOrganizations";                                                       
								}else{
									alert("การลบข้อมูลล้มเหลว");
								}

							}, "json"); 

					}
				}else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
            
            function getChecks(){

                var checkboxes = $("[name='EmployeeOrganizationID[]']");
               
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
                deleteEmployeeOrganization(id);
            });              
</script>