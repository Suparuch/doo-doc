<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูลค่ายทหาร
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#myModal2" onclick="addBarrack();" data-toggle="modal" data-backdrop="static" class="add_rows_simple hideme mm_7_add" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li><a href="#" class="delete  hideme mm_7_delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><input type="checkbox" class="toggle"></th>
							<th>ทัพภาค</th>
							<th>ชื่อค่ายทหาร</th>
							<th>ที่ตั้งค่าย</th>
							<th>วันที่จัดตั้ง</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($Barracks)){ ?>
						<?php foreach($Barracks as $Barrack) { ?>
						<tr>
							<td style="text-align: center;">
								<input type="checkbox" name="BarrackID[]" value="<?php echo $Barrack['Barrack']['id']; ?>"></td>  
							<td style="text-align: center;">
								<?php 
										/*
										if(!empty($Barrack['Barrack']['order_sort'])) 
										echo $Barrack['Barrack']['order_sort'];                                                               
										 */
										  echo ++$pagination['offset'];
								?>
							</td>
							<td>
								<?php if(!empty($Barrack['Barrack']['name'])) 
										echo $Barrack['Barrack']['name'] . "&nbsp;&nbsp;"; 
								?>    
							</td>
							<td>
								<?php if(!empty($Barrack['Barrack']['address'])) 
										echo $Barrack['Barrack']['address'] . "&nbsp;&nbsp;"; 
								?>
								<?php if(!empty($Barrack['Barrack']['district_id'])) 
								{
									//	echo $Barrack['Barrack']['district_id']; 
									echo $Districts[ $Barrack['Barrack']['district_id']] . "&nbsp;&nbsp;";
				
										
										
										
								}
								?>
								<?php if(!empty($Barrack['Barrack']['zone_id'])) 
										echo $Zones[$Barrack['Barrack']['zone_id']] . "&nbsp;&nbsp;"; 
								?>
								<?php if(!empty($Barrack['Barrack']['province_id'])) 
										echo $Provinces[$Barrack['Barrack']['province_id']]  . "&nbsp;&nbsp;"; 
								?>
								<?php if(!empty($Barrack['Barrack']['country_id'])) 
										echo $Barrack['Barrack']['country_id']; 
								?>	
								<?php if(!empty($Barrack['Barrack']['postal_code'])) 
										echo $Barrack['Barrack']['postal_code']; 
								?>									

							</td>
							<td>
								<?php if(!empty($Barrack['Barrack']['command_date'])) 
										echo $this->DateFormat->formatDateThai($Barrack['Barrack']['command_date']); 
								?>    
							</td>
							<td>
								<?php if(!empty($Barrack['Barrack']['created'])) 
										echo $this->DateFormat->formatDateThai($Barrack['Barrack']['created']); 
								?>    
							</td>
							<td>
								<?php if(!empty($Barrack['Barrack']['updated'])) 
										echo $this->DateFormat->formatDateThai($Barrack['Barrack']['updated']); 
								?>    
							</td>
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editBarrack('<?php echo $Barrack['Barrack']['id']; ?>');" class=' hideme mm_7_edit' ><i class="icon-pencil"></i></a>
							<a href="#" class=' hideme mm_7_delete'><i onclick="deleteBarrack('<?php echo $Barrack['Barrack']['id']; ?>')" class="icon-trash"></i></a>
							</td>
						</tr>
						<?php } ?>
						<?php }else {  ?>
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
<script type="text/javascript">
    
            function toggleBarrack(source) 
            {

              var checkboxes = document.getElementsByName('BarrackID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }
            }    
                        
            function addBarrack(){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างค่ายทหารใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Barracks/form",function(data) {
						$('#customModal2').html(data);
				  });

            }      
    
            function editBarrack(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลค่ายทหาร');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Barracks/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }  

            function deleteBarrack(id){

                var ids = [];
                
                if(id != null){
					ids.push(id);
                }
                else
					ids = getChecks();

                    if(ids.length != 0){  

                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
								var url = "../../Barracks/delete";
												$.post(url,{
												ids:ids,

										},function(data){

											if(data.status == "SUCCESS"){

												window.location="../../Barracks/index";                                                       
											}else{
												alert("การลบข้อมูลล้มเหลว");
											}

										}, "json"); 

                            }
                    }
            }
    

            function getChecks(){

                var checkboxes = $("[name='BarrackID[]']");
               
                var ids = [];

                $.each( checkboxes, function( key, checkbox ) {
                      if(checkbox.checked===true) {
                        ids.push(checkbox.value); 
                      }
                });                        
                
                return ids;
            }  
            
            function toggle(source) 
            {

              var checkboxes = document.getElementsByName('BarrackID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source;
                    }

            }              
</script>

<script>
            $( ".toggle" ).click(function() {
                toggle($(this).prop('checked'));                       

            });     
            
            $(".delete").click(function(){

                var id = $(this).attr("value");              
                deleteBarrack(id);
            });              
</script>