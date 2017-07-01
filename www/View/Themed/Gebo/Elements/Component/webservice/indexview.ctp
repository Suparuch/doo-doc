<?php 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
?>
<script language='javascript'>
function ttoggle(objType)
{
	if($("#show_" + objType).is(':checked'))
		$("." + objType).show();
	else
		$("." + objType).hide();
}

		
</script>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ระบบเชื่อมต่อข้อมูลระหว่างสายงาน (ขาออก)
					
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span6">
					<div class="dt_actions">
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
							 <li class='hideme mm_13_add'><a href="#myModal2" onclick="generate_webservice();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i> สร้างข้อมูลส่งให้สายงานอื่นๆ </a></li>
			
                                                <li class='hideme '><a href="/data_transfer.xls" onclick="addDocumentGroup();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-document_copy"></i> รายงานการได้รับข้อมูล </a></li>
								
							</ul>
						</div>
					</div>
				</div>
				<div class="span6" style='display:none;'>
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form  action="../../Ranks" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								<input name="name" type="text" value="<?php echo $default['name']; ?>" placeholder="<?php echo __('ชื่อหน่วยงาน/หมายเลขอจย.');?>" onkeypress="keyTextThai()">
								<button id="Unit-submit" type="submit" class="btn btn-primary hideme mm_13_list">ค้นหา</button>
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
                            <th style="text-align: center;" >ลำดับ</th>
							<th style="text-align: center;" >ชื่อไฟล์</th>
							<th style="text-align: center;" >ขนาดไฟล์</th>
							<th style="text-align: center;" >วันที่</th>
							<th style="text-align: center;" >ดูรายละเอียด</th>
						</tr>
						
					<tbody>      
					       <?php
			$i =0;
			$path = $_SERVER['DOCUMENT_ROOT'] . '/Upload/output';
					if ($handle = opendir($path)) {
						
						
						/* This is the correct way to loop over the directory. */
						while (false !== ($entry = readdir($handle))) {
							$file_name = $entry;
							if($file_name != "." && $file_name!=".."){
							$full_path = $path . "/" . $file_name;
							$i++;
							?>
								<tr>
								<td><?php echo $i;?>.</td>
								<td><?php echo $file_name;?></td>
								<td><?php echo formatSizeUnits(filesize($full_path));?> </td>
								<td><?php echo date ("d/m/Y H:i:s", filemtime($full_path));?></td>
								<td><a href='/download.php?file_name=<?php echo $file_name;?>&path=output'>Download</a></td>
								
								</tr>
							<?php
							}
						}
					
						closedir($handle);
					}
					?>                      
				
					</tbody>
				</table>
       
				</div>
			</div>

		</div>
	</div>

</div>

<script type="text/javascript">
    
            function toggleRank(source) 
            {

              var checkboxes = document.getElementsByName('rankID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function generate_webservice(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างไฟล์เอกสาร');
				  $('#customModalAction2').html('บันทึก');

$('#customModalAction2').hide();
				  $('#customModal2').load("../../WebService/form",function(data) {
						$('#customModal2').html(data);
				  });

            } 
			
			function addDocument(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างเอกสาร');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../form",function(data) {
						$('#customModal2').html(data);
				  });

            }    
    
            function editRank(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลยศ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Ranks/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }  

            function deleteRank(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();

                    if(ids.length != 0){  

                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../Ranks/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../Ranks/index";                                                       
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
                deleteRank(id);
            });              
</script>