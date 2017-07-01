<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูลอัตราการจัดและยุทโธปกรณ์
				</h3>
			</div>

			<div class="btn-group sepH_b">
				<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="#myModal2" onclick="addModelRate();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
					<li><a href="#" class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
					<li><a href="#" class="delete_rows_simple" data-tableid="smpl_tbl"> คัดลอก</a></li>
					<li><a href="javascript:void(0)"> ห้ามแก้ไข</a></li>
				</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><input type="checkbox" onclick="toggleModelRate(this);"></th>
							<th>หมายเลข อจย.</th>
							<th>วันที่ตั้ง</th>
							<th>ชื่อ อจย. (ย่อ)</th>
							<th>แก้ไขล่าสุด</th>
							<th>สถานะ</th>
							<th width='100'></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($ModelRates)) { ?>
						<?php foreach($ModelRates as $ModelRate) { ?>
						<tr>
							<td style="text-align: center;">
								<input type="checkbox" name="ModelRateID[]" value="<?php echo $ModelRate['ModelRate']['id']; ?>"></td>						 
							</td>
							<td>
								<?php if(!empty($ModelRate['ModelRate']['code'])) 
									   echo $ModelRate['ModelRate']['code'];
								?>   
							</td>
							<td>
								<?php if(!empty($ModelRate['ModelRate']['model_date']))
									   echo $this->DateFormat->formatDateThai($ModelRate['ModelRate']['model_date']);
								?>   
							</td>
							<td>
								<?php if(!empty($ModelRate['ModelRate']['name']))
									    echo $ModelRate['ModelRate']['name'];
								?>							
							</td>
							<td>
								<?php if(!empty($ModelRate['ModelRate']['updated'])) 
										echo $this->DateFormat->formatDateThai($ModelRate['ModelRate']['updated']); 
								?>    
							</td>
							<td>
								<?php if(!empty($ModelRate['ModelRate']['model_status_id']))
									   echo $ModelStatus[$ModelRate['ModelRate']['model_status_id']];
								?>	
							</td>
							<td>
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editModelRate('<?php echo $ModelRate['ModelRate']['id']; ?>');" ><i class="splashy-zoom_in"></i></a>
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
    
            function toggleModelRate(source) 
            {

              var checkboxes = document.getElementsByName('ModelRateID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }
            }    
                        
            function addModelRate(){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างยุทโธปกรณ์ใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/detailModel",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editModelRate(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('ข้อมูลยุทโธปกรณ์');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/detailModel/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }

            function lockModelRate(id){

				var model_is_lock = $(this).attr("model_is_lock");
				//alert(model_is_lock);

				if(model_is_lock == 'Y'){
					$(this).removeClass('splashy-lock_large_locked');
					$(this).addClass('splashy-lock_large_unlocked');
					$(this).attr("model_is_lock",'N');

				}else if(model_is_lock == 'N'){
					$(this).removeClass('splashy-lock_large_unlocked');
					$(this).addClass('splashy-lock_large_locked');
					$(this).attr("model_is_lock",'Y');
				}

            }
		
			
            
             function deleteModelRate(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();
                                
                               
                                 
                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../ModelRates/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../ModelRates";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
                     
            
            function getChecks(){

                var checkboxes = $("[name='ModelRateID[]']");
               
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
                deleteModelRate(id);
            });      
    
   
</script>

<script type="text/javascript">
$(function () {

	$(".model-detail").click(function(event){

		var model_id = $(this).attr("model_id");
		//alert(model_id);
		$('#customModal').load("/Models/action",function(data) {

		});
		
	});

	$(".action-lock").click(function(event){

		//alert('lock');
		//alert($(this).attr("model_id"));

		var model_is_lock = $(this).attr("model_is_lock");
		//alert(model_is_lock);

		if(model_is_lock == 'Y'){
			$(this).removeClass('splashy-lock_large_locked');
			$(this).addClass('splashy-lock_large_unlocked');
			$(this).attr("model_is_lock",'N');

		}else if(model_is_lock == 'N'){
			$(this).removeClass('splashy-lock_large_unlocked');
			$(this).addClass('splashy-lock_large_locked');
			$(this).attr("model_is_lock",'Y');
		}
		
	});

	

	$("#delete").click(function(event){
		alert('คุณต้องการลบ หรือไม่ ?');		
	});

});
</script>

