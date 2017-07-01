<?php 
        $default['name_th'] = empty($dataRequest['name_th']) ? '' : $dataRequest['name_th'];
		$default['code'] = empty($dataRequest['code']) ? '' : $dataRequest['code'];
		$default['status']= empty($dataRequest['status']) ? '' : $dataRequest['status'];
		$default['book_date']= empty($dataRequest['date']) ? '' : $dataRequest['date'];
				$default['fast']= empty($dataRequest['fast']) ? '' : $dataRequest['fast'];
								$default['secret']= empty($dataRequest['secret']) ? '' : $dataRequest['secret'];
?>
<style type='text/css'>
table.tablesorter {

}
table.tablesorter thead tr th, table.tablesorter tfoot tr th {

}
table.tablesorter thead tr .header {
	background-image: url(/img/bg.gif);
	background-repeat: no-repeat;
	background-position: center right;
	cursor: pointer;
}
table.tablesorter tbody td {
	/*color: #3D3D3D;*/
	padding-right: 4px;
	/*background-color: #FFF;*/
	vertical-align: top;
}
table.tablesorter tbody tr.odd td {
	background-color:#F0F0F6;
}
table.tablesorter thead tr .headerSortUp {
	background-image: url(/img/asc.gif);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(/img/desc.gif);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
background-color: #8dbdd8;
}
.table thead th {
vertical-align:middle !important;
}
</style>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ประวัติกำลังพล
					
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span4">
					<div class="dt_actions span4 hideme" >
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
							<!-- remove class hideme for some reason -->
                                                <li class=' mm_13_add'><a href="#myModal2" onclick="addDocumentGroup();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่มหมวดหมู่หนังสือ รับ - ส่ง </a></li>
								 <li class=' mm_13_add'><a href="#myModal2" onclick="addDocument();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่มหนังสือ รับ - ส่ง </a></li>				
												
								<li><a href="#"  class="delete  mm_13_delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>

							</ul>
						</div>
					</div>
					<div class="dt_actions  span4" style='display:none'>
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">เรียงลำดับ <span class="caret"></span></button>
							<ul class="dropdown-menu">
                                                <li class=' mm_13_add'><a href="#myModal2" onclick="addDocumentGroup();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">เลขที่หนังสือ </a></li>
                                                <li class=' mm_13_add'><a href="#myModal2" onclick="addDocument();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"> เรื่อง </a></li>	
								 <li class=' mm_13_add'><a href="#myModal2" onclick="addDocument();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"> ลงวันที่ </a></li>				
												
								<li><a href="#"  class="delete  mm_13_delete" data-tableid="smpl_tbl">สถานะ </a></li>
						</ul>
						</div>
					</div>
					
					<div class="dt_actions  span4"  style='display:none'>
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">เรียงโดย <span class="caret"></span></button>
							<ul class="dropdown-menu">
                                                <li class=' mm_13_add'><a href="#myModal2" onclick="addDocumentGroup();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">น้อยไปหามาก </a></li>
								 <li class='hideme mm_13_add'><a href="#myModal2" onclick="addDocument();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">มากไปหาน้อย</a></li>				
												
								<li><a href="#"  class="delete  mm_13_delete" data-tableid="smpl_tbl">สถานะ </a></li>
						</ul>
						</div>
					</div>
				</div>
				
				
				<div class="span8">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form  action="../../EDocument/index/<?php echo $corp_id;?>" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								ค้นหา
							
								
								<input name="name_th"  style='width:200px;' value='<?php echo $default['name_th'];?>' type="text" placeholder="<?php echo __('ชื่อ - นามสกุล');?>" >
								<input name="name_th"  style='width:50px;' value='<?php echo $default['name_th'];?>' type="text" placeholder="<?php echo __('สังกัด');?>" >
								<input name="name_th"  style='width:50px;' value='<?php echo $default['name_th'];?>' type="text" placeholder="<?php echo __('ยศ');?>" >
								<input name="name_th"  style='width:50px;' value='<?php echo $default['name_th'];?>' type="text" placeholder="<?php echo __('ตำแหน่ง');?>" >
								
							
								<button id="Unit-submit" type="submit" class="btn btn-primary hideme mm_13_list">ค้นหา</button>
								<input type="hidden" name="offset" value="0" />
							</form>
						</label>						
					</div>
				</div>
			</div>

			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered tablesorter">
					<thead>
						<tr>
                                                        <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle"></th>
                            <th class='header ' style="text-align: center;width:50px;">ลำดับ</th>
							<th class='header ' style="text-align: center;width:50px;">รูป</th>
							<th class='header ' style="text-align: center;">ชื่อ นามสกุล</th>
							<th class='header ' style="text-align: center;width:70px;">ยศ</th>
                                                        <th class='header ' style="text-align: center;width:70px;">เพศ</th>
 <th class='header ' style="text-align: center;">สังกัด</th>
							<th class='header ' style="text-align: center;width:200px;">ตำแหน่ง</th>
						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($document)){ ?>
                                            <?php foreach($document as $doc) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="docID[]" value="<?php echo $doc['Document']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php 
                                                                /*
                                                                if(!empty($rank['Rank']['order_sort'])) 
                                                                echo $rank['Rank']['order_sort'];                                                               
                                                                 */
                                                                  echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
                                                        <td><?php echo $doc['Document']['code']; ?></td>
							<td>
                                                      <?php echo $doc['Document']['book_date']; ?>  
                                                        </td>
							<td>
                                                        <?php if(!empty($doc['Document']['name_th'])) 
                                                                echo $doc['Document']['name_th']; 
                                                        ?>    
                                                        </td>
<td>
<?php echo $DocumentGroup[$doc['Document']['document_group']]; ?>
</td>
							<td>
                                                          <?php if(!empty($doc['Document']['file_name'])) 
														  {
                                                                echo "<a href='/files/edocument/" . $doc['Document']['corp_id'] . "/" . $doc['Document']['document_group'] . "/" . $doc['Document']['file_name'] . "' target='_blank'/>" . $doc['Document']['file_name'] .  "</a>";
																
															}
															?>
                                                        </td>
														<td><?php
							if($doc['Document']['fast']!="")
							echo $fast[$doc['Document']['fast']];
							?>
                                                          
                                                        </td>
							<td><?php
							if($doc['Document']['secrete']!="")
							echo $secrete[$doc['Document']['secrete']];
							?>
                                                          
                                                        </td>
							
							<td style="text-align: center;">
							<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editDocument('<?php echo $doc['Document']['id']; ?>');" class=' mm_13_edit' ><i class="icon-pencil"></i></a>
							
							<a href=<?php echo "'/download2.php?path=files/edocument/" . $doc['Document']['corp_id'] . "/" . $doc['Document']['document_group'] . "&file_name=" . $doc['Document']['file_name'] . "'";?> target='_blank'><i class="icon-download-alt"></i></a>
							
							<a href="#" class=' mm_13_delete'><i onclick="deleteRank('<?php echo $doc['Document']['id']; ?>')" class="icon-trash"></i></a>
							</td>
						</tr>
                                            <?php } ?>
                                            <?php }else {  ?>

                                                <tr>
                                                        <td colspan="8" style="text-align:center;">
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
<script type="text/javascript" src="/js/jquery.tablesorter.js"></script>
<script>
	
    $("table").tablesorter({ 
        // sort on the first column and third column, order asc 
        sortList: [[1,0],[2,0]] 
    }); 

</script>
<script type="text/javascript">


            function toggleRank(source) 
            {

              var checkboxes = document.getElementsByName('rankID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addDocumentGroup(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างหมวดหมู่หนังสือ รับ - ส่ง');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../EDocument/formgroup/<?php echo $corp_id;?>",function(data) {
						$('#customModal2').html(data);
				  });

            }   
			
			function addDocument(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างหนังสือ รับ - ส่ง');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../EDocument/form/<?php echo $corp_id;?>",function(data) {
						$('#customModal2').html(data);
				  });

            }  
			
			function editDocument(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างหนังสือ รับ - ส่ง');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../EDocument/form/<?php echo $corp_id;?>/" + id,function(data) {
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
                                                    var url = "../../EDocument/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../EDocument/index/<?php echo $corp_id;?>";                                                       
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