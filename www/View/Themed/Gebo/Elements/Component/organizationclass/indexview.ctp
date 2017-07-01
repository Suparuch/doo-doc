<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล ขนาดหน่วย
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
                                                <li class='hideme mm_18_add'><a href="#myModal2" onclick="addOrganizationClass();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li><a href="#"  class="delete hideme mm_18_delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
                                                        <th style="text-align: center;"><input type="checkbox" onclick="toggleOrganizationClass(this);"></th>
                                                        <th style="text-align: center;">ขนาดหน่วย</th>
							<th style="text-align: center;">ชื่อขนาดหน่วย</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($OrganizationClasss)) { ?>
                                            <?php foreach($OrganizationClasss as $OrganizationClass) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="OrganizationClassID[]" value="<?php echo $OrganizationClass['OrganizationClass']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php //if(!empty($OrganizationClass['OrganizationClass']['order_sort'])) 
                                                                //echo $OrganizationClass['OrganizationClass']['order_sort']; 
                                                                echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
							<td>
                                                        <?php if(!empty($OrganizationClass['OrganizationClass']['name'])) 
                                                                echo $OrganizationClass['OrganizationClass']['name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($OrganizationClass['OrganizationClass']['created'])) 
                                                                echo $this->DateFormat->formatDateThai($OrganizationClass['OrganizationClass']['created']); 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($OrganizationClass['OrganizationClass']['updated'])) 
                                                                echo $this->DateFormat->formatDateThai($OrganizationClass['OrganizationClass']['updated']); 
                                                        ?>    
                                                        </td>
							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editOrganizationClass('<?php echo $OrganizationClass['OrganizationClass']['id']; ?>');" class='hideme mm_18_edit'><i class="icon-pencil"></i></a>
							<a href="#" class="delete hideme mm_18_delete" value="<?php echo (string)$OrganizationClass['OrganizationClass']['id']; ?>"><i class="icon-trash"></i></a>
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
    
            function toggleOrganizationClass(source) 
            {

              var checkboxes = document.getElementsByName('OrganizationClassID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addOrganizationClass(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างขนาดหน่วยใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../OrganizationClass/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editOrganizationClass(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลขนาดหน่วย');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../OrganizationClass/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }               
            
            
            
             function deleteOrganizationClass(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();
                                
                               
                                 
                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../OrganizationClass/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../OrganizationClass";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
                     
            
            function getChecks(){

                var checkboxes = $("[name='OrganizationClassID[]']");
               
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
                deleteOrganizationClass(id);
            });      
    
   
</script>