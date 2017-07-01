<?php 
        $default['unit'] = empty($dataRequest['unit']) ? '' : $dataRequest['unit'];
		$default['code'] = empty($dataRequest['code']) ? '' : $dataRequest['code'];
		$state = array('100'=>'ยังไม่รับ','101'=>'เวียนทราบแล้ว','102'=>'ไม่รับ');
		 $corp_id=0;
function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

$user = array();

foreach($users as $u){
	$user[$u['User']['id']] = $u['Rank']['short_name'] . " " . $u['User']['name'] . ' ' . $u['User']['surname'];
}
?>
<style type='text/css'>
table.tablesorter {
border-collapse:separate;
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
padding-bottom:1px;

}
           
		   
.link-bb:link, .link-bb:visited {
    background-color: #FC6;
    color: #000;
    padding: 5px 8px;
    border: 1px solid #FFF;
    line-height: 30px;
}

.link-bb:hover {}



	
</style>
<script>

    function scrolify(tblAsJQueryObject, height){
        var oTbl = tblAsJQueryObject;

        // for very large tables you can remove the four lines below
        // and wrap the table with <div> in the mark-up and assign
        // height and overflow property  
        var oTblDiv = $("<div/>");
        oTblDiv.css('height', height);
        oTblDiv.css('overflow','scroll');               
        oTbl.wrap(oTblDiv);

        // save original width
        oTbl.attr("data-item-original-width", oTbl.width());
        oTbl.find('thead tr th').each(function(){
            $(this).attr("data-item-original-width",$(this).width());
        }); 
        oTbl.find('tbody tr:eq(0) td').each(function(){
            $(this).attr("data-item-original-width",$(this).width());
        });                 


        // clone the original table
        var newTbl = oTbl.clone();

        // remove table header from original table
        oTbl.find('thead tr').remove();                 
        // remove table body from new table
        newTbl.find('tbody tr').remove();   

        oTbl.parent().parent().prepend(newTbl);
        newTbl.wrap("<div/>");

        // replace ORIGINAL COLUMN width                
        newTbl.width(newTbl.attr('data-item-original-width'));
        newTbl.find('thead tr th').each(function(){
            $(this).width($(this).attr("data-item-original-width"));
        });     
        oTbl.width(oTbl.attr('data-item-original-width'));      
        oTbl.find('tbody tr:eq(0) td').each(function(){
            $(this).width($(this).attr("data-item-original-width"));
        });            
		
    }



    </script>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					รายการหนังสือออก
					
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span4 ">
					<div class="dt_actions span4 hideme" >
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
							<!-- remove class hideme for some reason -->
                                               
								 <li class=' mm_13_add'><a href="#myModal2" onclick="addDocument();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i>รับ </a></li>				
												
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
							<form action="../../Document/index2/?act=viewer" id='form_search' method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                            
                            ค้นหา&nbsp;
                            <input type="textbox" name="follow" id='follow' value="">
                            <select style="width:100px;" name='type' id='type'>
                            <option value="A">ทั้งหมด</option>
                            <option value="R">ทราบแล้ว</option>
                            <option value="P">ยังไม่รับ</option>
                            </select>
								<button id="Unit-submit" type="submit" class="btn btn-primary mm_13_list" style="display: inline-block;">ค้นหา</button>
								<input type="hidden" name="offset" value="0">
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
                                                        <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle"></th>
                            <th style="text-align: center;width:50px;">ลำดับ</th>
                            <th style="text-align: center;width:50px;">ลงวันที่</th>
                            <th style="text-align: center;width:100px;">รหัสติดตาม</th>
                            <th style="text-align: center;width:150px;">ชั้นความลับ / ความเร่งด่วน</th>
                            <th style="text-align: center;width:150px;">เสนอ/นำเรียน</th>
							<th style="text-align: center;">ชื่อเรื่อง</th>
                            <th style="text-align: center;width:100px;">สถานะ</th>
                            <th style="text-align: center;width:250px;">ไฟล์แนบ</th>
                            
						</tr>
					</thead>
					<tbody>
                    <?php
					foreach($document as $docs){
						$doc = $docs['DocumentFlow'];
						
					?>
																			<tr>

							<td style="text-align: center;">
								<input type="checkbox" name="EquipmentID[]" value="<?php echo $doc['id'];?>"></td>  
							<td style="text-align: center;">
								<?php echo ++$pagination['offset'];?>							</td>
							
                            <td><?php echo $doc['book_date'];?></td>
                            <td><?php echo $doc['order_sort'];?>/<?php echo $doc['year'];?></td>
                            
                            
							<td><?php echo $secrete[$doc['secrete']];?>/<?php echo $fast[$doc['fast']];?>
							
							</td>
                             
							<td><?php 
							if(isset( $units[$doc['to_unit']]))
							echo $units[$doc['to_unit']];?>
                            </td>
							<td><?php echo $doc['name_th'];?>
							
							</td>
							<td><?php 
							if(isset($state[$doc['status']]))
							echo $state[$doc['status']];?>
							
							</td>


							
                            <td>                            <?php
 							$docs = $this->requestAction('/Document/showFile/' . $doc['id']);
							$i = 0;
							foreach($docs as $d){
								
								
								$doc = $d['DocumentFile'];
								if($doc['file_name']=="")
									continue;
								$i++;
							 echo "$i . <a href='/Document/download_file/" . $doc['id'] . "' target='_blank'/><i class=\"icon-search\"></i></a> | ";
							}
							 ?>
                            
                             <?php
							?>
                            </td>
						</tr>
                        <?php
					}
						?>
                        

																	</tbody>
				</table>

				</div>
			</div>

		</div>
	</div>

</div>
<script type="text/javascript" src="/js/jquery.tablesorter.js"></script>
<script>
	/*
    $("table").tablesorter({ 
        // sort on the first column and third column, order asc 
        sortList: [[1,0],[2,0]] 
    }); 
*/
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
				  $('#customModal2').load("../../Document/form/<?php echo $corp_id;?>",function(data) {
						$('#customModal2').html(data);
				  });

            }  
			
			function assignDocument(objId){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('รายละเอียดการรับหนังสือ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Document/assignform/<?php echo $corp_id;?>",function(data) {
						$('#customModal2').html(data);
						$("#doc_id").val(objId);
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
			function recievedoc(objId,status){
				 var url = "../../Document/changestatus";
						$.post(url,{
						id:objId,
						status:status
				},function(data){

					if(data.status == "SUCCESS"){

						location.reload();                                                     
					}else{
						alert("การลบข้อมูลล้มเหลว");
					}

				}, "json"); 
			}
  <?php
	 if(isset($type)){
		 
			echo " document.getElementById('type').value = '$type';\n";
	 }
	 
	  if(isset($follow)){
		 
			echo " document.getElementById('follow').value = '$follow';\n";
	 }
	 ?>
      

</script>