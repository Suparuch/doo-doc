<?php 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล หน่วยผู้ใช้
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span6">
					<div class="dt_actions">
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li class=' hideme mm_11_add'><a href="#myModal2" onclick="addUnit();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
                                
                                <li class=' hideme mm_11_add'><a href="#" onclick="edit_user();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> จัดการผู้ใช้งาน </a></li>
                                
								<li class=' hideme mm_11_delete'><a href="#"  class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>

							</ul>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form  action="../../Units" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								<input name="name" type="text" value="<?php echo $default['name']; ?>" placeholder="<?php echo __('ชื่อ')." / ".__('ชื่อย่อ');?>" onkeypress="keyTextThai()">
								<button id="Unit-submit" type="submit" class="btn btn-primary hideme mm_11_list">ค้นหา</button>
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
                                                        <th style="text-align: center;"><input type="checkbox" class="toggle"></th>
                                                        <th style="text-align: center;">ลำดับ</th>
							<th style="text-align: center;">ชื่อสังกัด</th>
                                                        <th style="text-align: center;">ชื่อย่อ</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($ranks)){ ?>
                                            <?php foreach($ranks as $rank) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="rankID[]" value="<?php echo $rank['Unit']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php 
                                                                /*
                                                                if(!empty($rank['Unit']['order_sort'])) 
                                                                echo $rank['Unit']['order_sort'];                                                               
                                                                 */
                                                                  echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
							<td>
                                                        <?php if(!empty($rank['Unit']['name'])) 
                                                                echo $rank['Unit']['name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($rank['Unit']['short_name'])) 
                                                                echo $rank['Unit']['short_name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($rank['Unit']['created'])) 
                                                                echo $this->DateFormat->formatDateThai($rank['Unit']['created']); 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($rank['Unit']['updated'])) 
                                                                echo $this->DateFormat->formatDateThai($rank['Unit']['updated']); 
                                                        ?>    
                                                        </td>
							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editUnit('<?php echo $rank['Unit']['id']; ?>');" class='hideme mm_11_edit' ><i class="icon-pencil"></i></a>
							<a href="#" class='hideme mm_11_delete'><i onclick="deleteUnit('<?php echo $rank['Unit']['id']; ?>')" class="icon-trash"></i></a>
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
    function edit_user(){
	window.location="../../Users/index/";   
}
    
            function toggleUnit(source) 
            {

              var checkboxes = document.getElementsByName('rankID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addUnit(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างหน่วยผู้ใช้ใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Units/form",function(data) {
						$('#customModal2').html(data);
				  });

            }      
    
            function editUnit(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลหน่วยผู้ใช้');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Units/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }  

            function deleteUnit(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();

                    if(ids.length != 0){  

                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../Units/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../Units/index";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }
            }
    

            function getChecks(){

                var checkboxes = $("[name='rankID[]']");
               
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

              var checkboxes = document.getElementsByName('rankID[]');
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
                deleteUnit(id);
            });              
</script>