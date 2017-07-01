<?php 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
	$default['position_group_id'] = empty($default['position_group_id']) ? '' : $default['position_group_id'];	
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูลตำแหน่งของพนักงานราชการ
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span6">
					<div class="dt_actions">
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li class=' hideme mm_26_add'><a href="#myModal2" onclick="addEmployeePosition();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
								<li class=' hideme mm_26_delete'><a href="#"  class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>

							</ul>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form  action="../../EmployeePositions" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								<input name="name" type="text" value="<?php echo $default['name']; ?>" placeholder="<?php echo __('ชื่อตำแหน่ง');?>" onkeypress="keyTextThai()">
								<?php
									echo $this->Form->input('position_group_id', array(
									'label' => false,
									'div' => false,
									'options' => $PositionGroups, 
									'class' => 'span3',
									'default' => $default['position_group_id'],
									'empty' => __('ประเภทอาวุธ')
								))
								?> 
								<button id="Unit-submit" type="submit" class="btn btn-primary  hideme mm_26_list">ค้นหา</button>
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
								<a class=' hideme mm_26_edit' data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editEmployeePosition('<?php echo $EmployeePosition['EmployeePosition']['id']; ?>');" ><i class="icon-pencil"></i></a>
								<a href="#" class="delete  hideme mm_26_delete" value="<?php echo (string)$EmployeePosition['EmployeePosition']['id']; ?>"><i class="icon-trash"></i></a>
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