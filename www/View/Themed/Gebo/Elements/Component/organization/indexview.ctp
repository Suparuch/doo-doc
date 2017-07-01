<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูลหน่วยทหาร
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li class=' hideme mm_15_add'><a href="#myModal2" onclick="addOrganization();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li class=' hideme mm_15_delete'><a href="#" class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><input type="checkbox" onclick="toggleOrganization(this);"></th>
							<th>รหัสหน่วยงาน</th>
							<th>นามหน่วย</th>
							<th>นามหน่วยย่อ</th>
							<th>ที่ตั้งหน่วย (ปกติ)</th>
							<th>สร้างวันที่</th>
							<th>แก้ไขวันที่</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($Organizations)) { ?>
						<?php foreach($Organizations as $Organization) { ?>
						<tr>
							<td style="text-align: center;">
								<input type="checkbox" name="OrganizationID[]" value="<?php echo $Organization['Organization']['id']; ?>"></td>
							<td>
								<?php if(!empty($Organization['Organization']['code'])) 
										echo $Organization['Organization']['code']; 
								?> 
							</td>
							<?php //if(!empty($Organization['Organization']['order_sort'])) 
									//echo $Organization['Organization']['order_sort']; 
									//echo ++$pagination['offset'];
							?>
							<td>
								<?php if(!empty($Organization['Organization']['name'])) 
										echo $Organization['Organization']['name']; 
								?>
							</td>
							<td>
								<?php if(!empty($Organization['Organization']['short_name'])) 
										echo $Organization['Organization']['short_name']; 
								?>
							</td>
							<td>								
								<?php 
									echo $Organization['Organization']['address'];
									echo ' ';
									echo !empty($Districts[$Organization['Organization']['district_id']])? $Districts[$Organization['Organization']['district_id']]:$Organization['Organization']['district_id'];
									echo ' ';
									echo !empty($Zones[$Organization['Organization']['zone_id']])? $Zones[$Organization['Organization']['zone_id']]:$Organization['Organization']['zone_id'];
									echo ' ';
									echo !empty($Provinces[$Organization['Organization']['province_id']])? $Provinces[$Organization['Organization']['province_id']]:$Organization['Organization']['province_id'];									
								?>
							</td>
							<td>
								<?php if(!empty($Organization['Organization']['created'])) 
										echo $this->DateFormat->formatDateThai($Organization['Organization']['created']); 
								?>    
							</td>
							<td>
								<?php if(!empty($Organization['Organization']['updated'])) 
										echo $this->DateFormat->formatDateThai($Organization['Organization']['updated']); 
								?>    
							</td>
							<td width=40>
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editOrganization('<?php echo $Organization['Organization']['id']; ?>');" class=' hideme mm_15_detail' ><i class="splashy-zoom_in"></i></a>
							<!--<i id="delete" class="icon-trash"></i>-->
							</td>
						</tr>
						<?php } ?>
						<?php }else{ ?>
							<tr>
									<td colspan="8" style="text-align:center;">
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
  
  
            function toggleOrganization(source) 
            {

              var checkboxes = document.getElementsByName('OrganizationID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }
            }    
                        
            function addOrganization(){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างหน่วยทหารใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Organizations/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editOrganization(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลหน่วยทหาร');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Organizations/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }               
            
            function deleteOrganization(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();

                    if(ids.length != 0){  

                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
								var url = "../../Organizations/delete";
												$.post(url,{
												ids:ids,

										},function(data){

											if(data.status == "SUCCESS"){

												window.location="../../Organizations";                                                       
											}else{
												alert("การลบข้อมูลล้มเหลว");
											}

										}, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
            
            function getChecks(){

                var checkboxes = $("[name='OrganizationID[]']");
               
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
                deleteOrganization(id);
            });              
</script>