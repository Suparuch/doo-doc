<?php 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
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
					ระบบเชื่อมต่อข้อมูลระหว่างสายงาน
					
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
				<div class="span6">
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
			
<center>
	<table cellpadding='5'><tr valign='middle'><td>
<input type='checkbox' id='show_age' style='margin:0px;' checked='checked' onclick='ttoggle("age")' /></td><td><label for='show_age' style='margin:0px'>แสดงอายุ</label></td><td>|</td><td><input type='checkbox' id='show_corp'   onclick='ttoggle("corp")' style='margin:0px'  checked='checked'/></td><td><label for='show_corp' style='margin:0px'>แสดงเหล่า</label></td></tr></table></center>
				<table class="table table-bordered">
					<thead>
						<tr>
                            <th style="text-align: center;" rowspan='2'><input type="checkbox" class="toggle"></th>
                            <th style="text-align: center;" rowspan='2'>ลำดับ</th>
							<th style="text-align: center;" rowspan='2'>ชื่อหน่วย</th>
							<th style="text-align: center;" rowspan='2'>หมายเลข อจย. </th>
							<th style="text-align: center;" colspan='4'>อัตราเต็ม</th>
							<th style="text-align: center;" colspan='5'>อัตราบรรจุจริง</th>
                           	<th style="text-align: center;" colspan='6' class='age'>อายุ</th>
							<th style="text-align: center;" colspan='6' class='corp'>เหล่า</th>
							<th style="text-align: center;" rowspan='2'>วันที่แก้ไข</th>
							<th style="text-align: center;" rowspan='2'>แก้ไข/ลบ</th>
						</tr>
						<tr>
                            <th style="text-align: center;">รวม</th>
							<th style="text-align: center;">น.</th>
							<th style="text-align: center;">ส. </th>
							<th style="text-align: center;">อื่นๆ</th>
							 <th style="text-align: center;">รวม</th>
							<th style="text-align: center;">น.</th>
							<th style="text-align: center;">ส. </th>
							<th style="text-align: center;">ประจำ</th>
							<th style="text-align: center;">อื่นๆ</th>
								
							 <th style="text-align: center;"  class='age'>ต่ำกว่า 21 ปี</th>
							<th style="text-align: center;" class='age'>21-30</th>
							<th style="text-align: center;" class='age'>31-40</th>
							<th style="text-align: center;" class='age'>41-50</th>
							<th style="text-align: center;" class='age'>51-60</th>
							<th style="text-align: center;" class='age'>60 ปีขึ้นไป</th>

							<th style="text-align: center;" class='corp'>ร.</th>
							<th style="text-align: center;" class='corp'>ม.</th>
							<th style="text-align: center;" class='corp'>ป.</th>
							<th style="text-align: center;" class='corp'>ช.</th>
							<th style="text-align: center;" class='corp'>ส.</th>
							<th style="text-align: center;" class='corp'>ขส.</th>
					</thead>
					<tbody>
                                           <?php
                                           $path = $_SERVER['DOCUMENT_ROOT'] . '/Upload/input';
                                           $f = fopen($path . "/" . $_GET['file_name'], "r");
                                            while (($line = fgetcsv($f)) !== false) {
                                                    $row = $line[0];    // We need to get the actual row (it is the first element in a 1-element array)
                                                    $cells = explode(";",$row);
                                                    echo "<tr>";
                                                    foreach ($cells as $cell) {
                                                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                                                    }
                                                    echo "</tr>\n";
                                            }
                                            fclose($f);
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