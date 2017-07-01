<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูลตำแหน่งของพนักงานราชการ
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#myModal2" onclick="addEmployeePosition();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li><a href="#" class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><input type="checkbox" onclick="toggleEmployeePosition(this);"></th>
							<th>ชื่อตำแหน่ง</th>
							<th>กลุ่มงาน</th>
							<th>หน้าที่โดยย่อ</th>
							<th>สร้างวันที่</th>
							<th>แก้ไขวันที่</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($EmployeePositions)) { ?>
						<?php foreach($EmployeePositions as $EmployeePosition) { ?>
						<tr>
						<tr>
							<td style="text-align: center;">
								<input type="checkbox" name="EmployeePositionID[]" value="<?php echo $EmployeePosition['EmployeePosition']['id']; ?>"></td>  
							<td>
								<?php if(!empty($EmployeePosition['EmployeePosition']['name'])) 
										echo $EmployeePosition['EmployeePosition']['name']; 
								?> 
							</td>
							<td>
								<?php if(!empty($EmployeePosition['EmployeePosition']['position_group_id'])) 
										echo $PositionGroups[$EmployeePosition['EmployeePosition']['position_group_id']];
								?>
							</td>
							<td>
								<?php if(!empty($EmployeePosition['EmployeePosition']['description'])) 
										echo $EmployeePosition['EmployeePosition']['description']; 
								?>
							</td>
							<td>
								<?php if(!empty($EmployeePosition['EmployeePosition']['created'])) 
										echo $this->DateFormat->formatDateThai($EmployeePosition['EmployeePosition']['created']); 
								?>    
							</td>
							<td>
								<?php if(!empty($EmployeePosition['EmployeePosition']['updated'])) 
										echo $this->DateFormat->formatDateThai($EmployeePosition['EmployeePosition']['updated']); 
								?>    
							</td>
							<td style="text-align: center;">
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editEmployeePosition('<?php echo $EmployeePosition['EmployeePosition']['id']; ?>');" ><i class="icon-pencil"></i></a>
								<a href="#" class="delete" value="<?php echo (string)$EmployeePosition['EmployeePosition']['id']; ?>"><i class="icon-trash"></i></a>
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

<style>
    #customModal2{
        height:280px;
    }
    
</style>
<script type="text/javascript">
  
  
            function toggleEmployeePosition(source) 
            {

				var checkboxes = document.getElementsByName('EmployeePositionID[]');
				for(var i in checkboxes)
				{
					checkboxes[i].checked = source.checked;
				}

            }    
                        
            function addEmployeePosition(){

				$('#customModal2').html('');
				$('#customModalHeader2').html('สร้าง ตำแหน่งของพนักงานราชการ ใหม่');
				$('#customModalAction2').html('บันทึก');
				$('#customModal2').load("../../EmployeePositions/form",function(data) {
					$('#customModal2').html(data);
				});

            }        
            
            function editEmployeePosition(id){

				$('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไข ตำแหน่งของพนักงานราชการ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../EmployeePositions/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }               
            
            function deleteEmployeePosition(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();

				if(ids.length != 0){  

					if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
					var url = "../../EmployeePositions/delete";
							$.post(url,{
									ids:ids,

							},function(data){

								if(data.status == "SUCCESS"){

									window.location="../../EmployeePositions";                                                       
								}else{
									alert("การลบข้อมูลล้มเหลว");
								}

							}, "json"); 

					}
				}else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
            
            function getChecks(){

                var checkboxes = $("[name='EmployeePositionID[]']");
               
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
                deleteEmployeePosition(id);
            });              
</script>