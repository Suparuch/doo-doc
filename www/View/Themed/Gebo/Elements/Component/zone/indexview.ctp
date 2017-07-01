<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูล อำเภอ
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
                                                <li class=' hideme mm_23_add'><a href="#myModal2" onclick="addZone();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li class=' hideme mm_23_delete'><a href="#" class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
						
					</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
                                                        <th style="text-align: center;"><input type="checkbox" onclick="toggleZone(this);"></th>
                                                        <th style="text-align: center;">ลำดับ</th>
							<th style="text-align: center;">ชื่ออำเภอ</th>
                                                        <th style="text-align: center;">จังหวัด</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">วันที่แก้ไข</th>
							<th style="text-align: center;">แก้ไข/ลบ</th>
						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($zones)) { ?>
                                            <?php foreach($zones as $zone) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="zoneID[]" value="<?php echo $zone['Zone']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php //if(!empty($zone['Zone']['order_sort'])) 
                                                                //echo $zone['Zone']['order_sort']; 
                                                                echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
							<td>
                                                        <?php if(!empty($zone['Zone']['name'])) 
                                                                echo $zone['Zone']['name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($provinces[$zone['Zone']['province_id']])) 
                                                                echo $provinces[$zone['Zone']['province_id']];
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($zone['Zone']['created'])) 
                                                                echo $this->DateFormat->formatDateThai($zone['Zone']['created']); 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($zone['Zone']['updated'])) 
                                                                echo $this->DateFormat->formatDateThai($zone['Zone']['updated']); 
                                                        ?>    
                                                        </td>
							
							<td style="text-align: center;">
							<a class=' hideme mm_23_edit' data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editZone('<?php echo $zone['Zone']['id']; ?>');" ><i class="icon-pencil"></i></a>
						
							<a href="#" class="delete  hideme mm_23_delete" value="<?php echo (string)$zone['Zone']['id']; ?>"><i class="icon-trash"></i></a>

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
    
            function toggleZone(source) 
            {

              var checkboxes = document.getElementsByName('zoneID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }
            }    
                        
            function addZone(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างอำเภอใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Zones/form",function(data) {
						$('#customModal2').html(data);
				  });

            }        
            
            function editZone(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลอำเภอ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Zones/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }               
            
             function deleteZone(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();

                    if(ids.length != 0){                 
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
								var url = "../../Zones/delete";
										$.post(url,{
										ids:ids,

								},function(data){

									if(data.status == "SUCCESS"){

										window.location="../../Zones";                                                       
									}else{
										alert("การลบข้อมูลล้มเหลว");
									}

								}, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }

            function getChecks(){

                var checkboxes = $("[name='zoneID[]']");
               
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
                deleteZone(id);
            });      
    
   
</script>