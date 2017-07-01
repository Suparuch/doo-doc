<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล ทัพภาค
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
                                                <li><a href="#myModal2" onclick="addArea();" data-toggle="modal" data-backdrop="static" class="add_rows_simple hideme mm_14_add" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li><a href="#"  class="delete hideme mm_14_delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
                                                        <th style="text-align: center;"><input type="checkbox" onclick="toggleArea(this);"></th>
                                                        <th style="text-align: center;">ทัพภาค</th>
							<th style="text-align: center;">ชื่อทัพภาค</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($Areas)) { ?>
                                            <?php foreach($Areas as $Area) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="AreaID[]" value="<?php echo $Area['Area']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php //if(!empty($Area['Area']['order_sort'])) 
                                                                //echo $Area['Area']['order_sort']; 
                                                                echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
							<td>
                                                        <?php if(!empty($Area['Area']['name'])) 
                                                                echo $Area['Area']['name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($Area['Area']['created'])) 
                                                                echo $this->DateFormat->formatDateThai($Area['Area']['created']); 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($Area['Area']['updated'])) 
                                                                echo $this->DateFormat->formatDateThai($Area['Area']['updated']); 
                                                        ?>    
                                                        </td>
							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editArea('<?php echo $Area['Area']['id']; ?>');" class=' hideme mm_14_edit' ><i class="icon-pencil"></i></a>
							<a href="#" class="delete  hideme mm_14_delete" value="<?php echo (string)$Area['Area']['id']; ?>"><i class="icon-trash"></i></a>
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
    
            function toggleArea(source) 
            {

              var checkboxes = document.getElementsByName('AreaID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addArea(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างทัพภาคใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Areas/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editArea(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลทัพภาค');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Areas/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }               
            
            
            
             function deleteArea(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();
                                
                               
                                 
                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../Areas/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../Areas";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
                     
            
            function getChecks(){

                var checkboxes = $("[name='AreaID[]']");
               
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
                deleteArea(id);
            });      
    
   
</script>