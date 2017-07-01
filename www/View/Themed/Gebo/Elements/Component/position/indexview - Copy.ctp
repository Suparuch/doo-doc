<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล ลำดับ
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
                                                <li><a href="#myModal2" onclick="addPosition();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li><a href="#"  class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><input type="checkbox" onclick="togglePosition(this);"></th>
							<th style="text-align: center;">ลำดับ</th>
							<th style="text-align: center;">ชื่อลำดับ</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($Positions)) { ?>
						<?php foreach($Positions as $Position) { ?>
						<tr>									
							<td style="text-align: center;">
								<input type="checkbox" name="PositionID[]" value="<?php echo $Position['Position']['id']; ?>"></td>  
							<td style="text-align: center;">
							<?php //if(!empty($Position['Position']['order_sort'])) 
									//echo $Position['Position']['order_sort']; 
									echo ++$pagination['offset'];
							?>
							</td>
							<td>
							<?php if(!empty($Position['Position']['name'])) 
									echo $Position['Position']['name']; 
							?>    
							</td>
							<td>
							<?php if(!empty($Position['Position']['created'])) 
									echo $this->DateFormat->formatDateThai($Position['Position']['created']); 
							?>    
							</td>
							<td>
							<?php if(!empty($Position['Position']['updated'])) 
									echo $this->DateFormat->formatDateThai($Position['Position']['updated']); 
							?>    
							</td>							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editPosition('<?php echo $Position['Position']['id']; ?>');" ><i class="icon-pencil"></i></a>
							<a href="#" class="delete" value="<?php echo (string)$Position['Position']['id']; ?>"><i class="icon-trash"></i></a>
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
    
            function togglePosition(source) 
            {

              var checkboxes = document.getElementsByName('PositionID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addPosition(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างลำดับใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Positions/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editPosition(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลลำดับ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Positions/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }               
            
            
            
             function deletePosition(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();
                                
                               
                                 
                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../Positions/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../Positions";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
                     
            
            function getChecks(){

                var checkboxes = $("[name='PositionID[]']");
               
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
                deletePosition(id);
            });      
    
   
</script>