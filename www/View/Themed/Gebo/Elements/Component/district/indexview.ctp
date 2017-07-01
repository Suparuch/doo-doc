<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล ตำบล
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
                                                <li class=' hideme mm_24_add'><a href="#myModal2" onclick="addDistrict();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li class=' hideme mm_24_delete'><a href="#" class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
                                                        <th style="text-align: center;"><input type="checkbox" onclick="toggleDistrict(this);"></th>
                                                        <th style="text-align: center;">ลำดับ</th>
							<th style="text-align: center;">ชื่อตำบล</th>
                                                        <th style="text-align: center;">อำเภอ</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($districts)) { ?>
                                            <?php foreach($districts as $district) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="districtID[]" value="<?php echo $district['District']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php //if(!empty($district['District']['order_sort'])) 
                                                                //echo $district['District']['order_sort']; 
                                                                echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
							<td>
                                                        <?php if(!empty($district['District']['name'])) 
                                                                echo $district['District']['name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($zones[$district['District']['zone_id']])) 
                                                                echo $zones[$district['District']['zone_id']];
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($district['District']['created'])) 
                                                                echo $this->DateFormat->formatDateThai($district['District']['created']); 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($district['District']['updated'])) 
                                                                echo $this->DateFormat->formatDateThai($district['District']['updated']); 
                                                        ?>    
                                                        </td>
							
							<td style="text-align: center;">
							<a class=' hideme mm_24_edit' data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editDistrict('<?php echo $district['District']['id']; ?>');" ><i class="icon-pencil"></i></a>
							
                                                        <a href="#" class="delete  hideme mm_24_delete" value="<?php echo (string)$district['District']['id']; ?>"><i class="icon-trash"></i></a>
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
        height:600px;
    }
    
</style>
<script type="text/javascript">
    
            function toggleDistrict(source) 
            {

              var checkboxes = document.getElementsByName('districtID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addDistrict(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างตำบลใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Districts/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editDistrict(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลตำบล');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Districts/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }               
            
             function deleteDistrict(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();
                                
                               
                                 
                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../Districts/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../Districts";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
                     
            
            function getChecks(){

                var checkboxes = $("[name='districtID[]']");
               
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
                deleteDistrict(id);
            });      
    
   
</script>