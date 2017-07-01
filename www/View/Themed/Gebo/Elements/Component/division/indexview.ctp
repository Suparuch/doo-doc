<?php 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล วรรค
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span6">
					<div class="dt_actions">
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li class=' hideme mm_19_add'><a href="#myModal2" onclick="addDivision();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
								<li class='hideme mm_19_delete'><a href="#"  class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>

							</ul>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form  action="../../Divisions" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								<input name="name" type="text" value="<?php echo $default['name']; ?>" placeholder="<?php echo __('ชื่อวรรค');?>" onkeypress="keyTextThai()">
								<button id="Unit-submit" type="submit" class="btn btn-primary hideme mm_19_list">ค้นหา</button>
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
                                                        <th style="text-align: center;"><input type="checkbox" onclick="toggleDivision(this);"></th>
                                                        <th style="text-align: center;">ลำดับ</th>
							<th style="text-align: center;">ชื่อวรรค</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($Divisions)) { ?>
                                            <?php foreach($Divisions as $Division) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="DivisionID[]" value="<?php echo $Division['Division']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php //if(!empty($Division['Division']['order_sort'])) 
                                                                //echo $Division['Division']['order_sort']; 
                                                                echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
							<td>
                                                        <?php if(!empty($Division['Division']['name'])) 
                                                                echo $Division['Division']['name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($Division['Division']['created'])) 
                                                                echo $this->DateFormat->formatDateThai($Division['Division']['created']); 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($Division['Division']['updated'])) 
                                                                echo $this->DateFormat->formatDateThai($Division['Division']['updated']); 
                                                        ?>    
                                                        </td>
							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editDivision('<?php echo $Division['Division']['id']; ?>');" class='hideme mm_19_edit'><i class="icon-pencil"></i></a>
							<a href="#" class="delete hideme mm_19_delete" value="<?php echo (string)$Division['Division']['id']; ?>"><i class="icon-trash"></i></a>
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
    
            function toggleDivision(source) 
            {

              var checkboxes = document.getElementsByName('DivisionID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addDivision(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างวรรคใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Divisions/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editDivision(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลวรรค');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Divisions/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }               
            
            
            
             function deleteDivision(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();
                                
                               
                                 
                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../Divisions/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../Divisions";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }
                     
            
            function getChecks(){

                var checkboxes = $("[name='DivisionID[]']");
               
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
                deleteDivision(id);
            });      
    
   
</script>