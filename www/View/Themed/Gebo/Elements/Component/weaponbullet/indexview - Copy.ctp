<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					คุณลักษณะกระสุนและวัตถุระเบิด
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#myModal2" onclick="addWeaponBullet();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li><a href="#" class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>						
					</ul>
			</div>
			ตอนที่ 1 คำชี้แจง <input type="file" name="">
			
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th rowspan=2 style="text-align: center;"><input type="checkbox" onclick="toggleWeaponBullet(this);"></th>
							<th rowspan=2 class="table-icon hidden-480">ลำดับ</th>
							<th rowspan=2>ประเภทอาวุธ</th>
							<th rowspan=2>ชนิดอาวุธ</th>
							<th rowspan=2>คุณลักษณะ</th>
							<th rowspan=2>หมายเหตุ</th>
							<th rowspan=2>สร้างวันที่</th>
							<th rowspan=2>แก้ไขวันที่</th>
							<th rowspan=2></th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($WeaponBullets)) { ?>
						<?php foreach($WeaponBullets as $WeaponBullet) { ?>
							<tr>

							<td style="text-align: center;">
								<input type="checkbox" name="WeaponBulletID[]" value="<?php echo $WeaponBullet['WeaponBullet']['id']; ?>"></td>  
							<td style="text-align: center;">
								<?php //if(!empty($WeaponBullet['WeaponBullet']['order_sort'])) 
										//echo $WeaponBullet['WeaponBullet']['order_sort']; 
										echo ++$pagination['offset'];
								?>
							</td>
							<td>
								<?php if(!empty($WeaponBullet['WeaponBullet']['weapon_type_id'])) 
									   echo $WeaponTypes[$WeaponBullet['WeaponBullet']['weapon_type_id']];
								?>
							</td>
							<td>
								<?php if(!empty($WeaponBullet['WeaponBullet']['name'])) 
										echo $WeaponBullet['WeaponBullet']['name']; 
								?>    
							</td>
							<td>
								<?php if(!empty($WeaponBullet['WeaponBullet']['attribute'])) 
										echo $WeaponBullet['WeaponBullet']['attribute']; 
								?>    
							</td>
							<td>
								<?php if(!empty($WeaponBullet['WeaponBullet']['capacity'])) 
										echo $WeaponBullet['WeaponBullet']['capacity']; 
								?>    
							</td>
							<td>
								<?php if(!empty($WeaponBullet['WeaponBullet']['created'])) 
										echo $this->DateFormat->formatDateThai($WeaponBullet['WeaponBullet']['created']); 
								?>    
							</td>
							<td>
								<?php if(!empty($WeaponBullet['WeaponBullet']['updated'])) 
										echo $this->DateFormat->formatDateThai($WeaponBullet['WeaponBullet']['updated']); 
								?>    
							</td>
							
							<td style="text-align: center;">
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="detailWeaponBullet('<?php echo $WeaponBullet['WeaponBullet']['id']; ?>');" ><i class="splashy-zoom_in"></i></a>
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editWeaponBullet('<?php echo $WeaponBullet['WeaponBullet']['id']; ?>');" ><i class="icon-pencil"></i></a>
								<a href="#" class="delete" value="<?php echo (string)$WeaponBullet['WeaponBullet']['id']; ?>"><i class="icon-trash"></i></a>
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
        height:250px;
    }    
</style>
<script type="text/javascript">
    
            function toggleWeaponBullet(source) 
            {
				var checkboxes = document.getElementsByName('WeaponBulletID[]');
				for(var i in checkboxes)
				{
					checkboxes[i].checked = source.checked;
				}
            }    
                        
            function addWeaponBullet(){
				
				  $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างคุณลักษณะกระสุนและวัตถุระเบิดใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../WeaponBullets/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editWeaponBullet(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขคุณลักษณะกระสุนและวัตถุระเบิด');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../WeaponBullets/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }

            function detailWeaponBullet(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('รูปภาพ และเอกสารประกอบคุณลักษณะกระสุนและวัตถุระเบิด ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../WeaponBullets/document/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }
			
            function deleteWeaponBullet(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();
   
				if(ids.length != 0){                 
				
						if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
						var url = "../../WeaponBullets/delete";
						$.post(url,{
								ids:ids,

						},function(data){

							if(data.status == "SUCCESS"){

								window.location="../../WeaponBullets";                                                       
							}else{
								alert("การลบข้อมูลล้มเหลว");
							}

						}, "json"); 

						}
				}else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }

            function getChecks(){

                var checkboxes = $("[name='WeaponBulletID[]']");
               
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
                deleteWeaponBullet(id);
            });      
    
   
</script>