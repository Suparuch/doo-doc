<?php 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล ชนิดหน่วย
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span6">
					<div class="dt_actions">
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li class='hideme mm_17_add'><a href="#myModal2" onclick="addCorp();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
								<li class='hideme mm_17_delete'><a href="#"  class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>

							</ul>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form  action="../../Corps" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								<input name="name" type="text" value="<?php echo $default['name']; ?>" placeholder="<?php echo __('ชื่อชนิดหน่วย');?>" onkeypress="keyTextThai()">
								<button id="Unit-submit" type="submit" class="btn btn-primary hideme mm_17_list">ค้นหา</button>
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
							<th style="text-align: center;"><input type="checkbox" onclick="toggleCorp(this);"></th>
							<th style="text-align: center;">รหัสชนิดหน่วย</th>
							<th style="text-align: center;">ชื่อชนิดหน่วย</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
							<?php if(!empty($Corps)) { ?>
							<?php foreach($Corps as $Corp) { ?>
						<tr>
										
						<td style="text-align: center;">
							<input type="checkbox" name="CorpID[]" value="<?php echo $Corp['Corp']['id']; ?>"></td>  
						<td style="text-align: center;">
							<?php //if(!empty($Corp['Corp']['order_sort'])) 
									//echo $Corp['Corp']['order_sort']; 
									echo ++$pagination['offset'];
							?>
						</td>
						<td>
							<?php if(!empty($Corp['Corp']['name'])) 
									echo $Corp['Corp']['name']; 
							?>    
						</td>
						<td>
							<?php if(!empty($Corp['Corp']['created'])) 
									echo $this->DateFormat->formatDateThai($Corp['Corp']['created']); 
							?>    
						</td>
						<td>
							<?php if(!empty($Corp['Corp']['updated'])) 
									echo $this->DateFormat->formatDateThai($Corp['Corp']['updated']); 
							?>    
						</td>							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editCorp('<?php echo $Corp['Corp']['id']; ?>');" class='hideme mm_17_edit'><i class="icon-pencil"></i></a>
							<a href="#" class="delete hideme mm_17_delete" value="<?php echo (string)$Corp['Corp']['id']; ?>"><i class="icon-trash"></i></a>
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
    
            function toggleCorp(source) 
            {
				var checkboxes = document.getElementsByName('CorpID[]');
				for(var i in checkboxes)
				{
				checkboxes[i].checked = source.checked;
				}
            }    

            function addCorp(){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างชนิดหน่วยใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Corps/form",function(data) {
						$('#customModal2').html(data);
				  });

            }
            
            function editCorp(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลชนิดหน่วย');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Corps/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }

            function deleteCorp(id){

                var ids = [];
                
                if(id != null) ids.push(id);
                else ids = getChecks();

                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
								var url = "../../Corps/delete";
								$.post(url,{
									ids:ids,
								},function(data){
									if(data.status == "SUCCESS"){
										window.location="../../Corps";                                                       
									}else{
										alert("การลบข้อมูลล้มเหลว");
									}
								}, "json");
                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }

            function getChecks(){

                var checkboxes = $("[name='CorpID[]']");
               
                var ids = [];

                $.each( checkboxes, function( key, checkbox ) {
                      if(checkbox.checked===true) {
                        ids.push(checkbox.value); 
                      }
                });                        
                
                return ids;
            }             

            $(".delete").click(function(){

                var id = $(this).attr("value");              
                deleteCorp(id);
            });      
    
   
</script>