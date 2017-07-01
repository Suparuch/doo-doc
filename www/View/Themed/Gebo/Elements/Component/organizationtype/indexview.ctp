<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล ชนิดหน่วย
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
                                                <li class='hideme mm_16_add'><a href="#myModal2" onclick="addOrganizationType();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li class='hideme mm_16_delete'><a href="#"  class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
                                                        <th style="text-align: center;"><input type="checkbox" onclick="toggleOrganizationType(this);"></th>
                                                        <th style="text-align: center;">ชนิดหน่วย</th>
							<th style="text-align: center;">ชื่อชนิดหน่วย</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($OrganizationTypes)) { ?>
                                            <?php foreach($OrganizationTypes as $OrganizationType) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="OrganizationTypeID[]" value="<?php echo $OrganizationType['OrganizationType']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php //if(!empty($OrganizationType['OrganizationType']['order_sort'])) 
                                                                //echo $OrganizationType['OrganizationType']['order_sort']; 
                                                                echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
							<td>
                                                        <?php if(!empty($OrganizationType['OrganizationType']['name'])) 
                                                                echo $OrganizationType['OrganizationType']['name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($OrganizationType['OrganizationType']['created'])) 
                                                                echo $this->DateFormat->formatDateThai($OrganizationType['OrganizationType']['created']); 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($OrganizationType['OrganizationType']['updated'])) 
                                                                echo $this->DateFormat->formatDateThai($OrganizationType['OrganizationType']['updated']); 
                                                        ?>    
                                                        </td>
							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editOrganizationType('<?php echo $OrganizationType['OrganizationType']['id']; ?>');" class='hideme mm_16_edit' ><i class="icon-pencil"></i></a>
							<a href="#" class="delete hideme mm_16_delete" value="<?php echo (string)$OrganizationType['OrganizationType']['id']; ?>"><i class="icon-trash"></i></a>
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
    
            function toggleOrganizationType(source) 
            {

              var checkboxes = document.getElementsByName('OrganizationTypeID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addOrganizationType(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างชนิดหน่วยใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../OrganizationTypes/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editOrganizationType(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลชนิดหน่วย');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../OrganizationTypes/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }               
            
            
            
             function deleteOrganizationType(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();
                                
                               
                                 
                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../OrganizationTypes/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../OrganizationTypes";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
                     
            
            function getChecks(){

                var checkboxes = $("[name='OrganizationTypeID[]']");
               
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
                deleteOrganizationType(id);
            });      
    
   
</script>