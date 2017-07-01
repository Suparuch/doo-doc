<?php 
        $default['unit'] = empty($dataRequest['unit']) ? '' : $dataRequest['unit'];
		$default['code'] = empty($dataRequest['code']) ? '' : $dataRequest['code'];
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


function thainumDigit($num){  
/*
    return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),  
    array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),  
    $num);  
*/
return $num;
}
/*
 * Array ( 
 * [sd] => Array ( [day] => 28 [month] => 1 [year] => 2557 )
 *  [ed] => Array ( [day] => 28 [month] => 1 [year] => 2557 )
 *  [follow] => 
 * [code] => 
 * [name] => 
 * [unit] => 
 * [type] => A 
 * [offset] => 0 )
 * */
//print_r($_REQUEST);
$sd = (isset($_REQUEST['sd'])?$_REQUEST['sd']:"");
$ed = (isset($_REQUEST['ed'])?$_REQUEST['ed']:"");
$follow= (isset($_REQUEST['follow'])?$_REQUEST['follow']:"");
$code = (isset($_REQUEST['code'])?$_REQUEST['code']:"");
$name =(isset($_REQUEST['name'])?$_REQUEST['name']:"");
$unit = (isset($_REQUEST['unit'])?$_REQUEST['unit']:"");
$type = (isset($_REQUEST['type'])?$_REQUEST['type']:"");
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
    <style type="text/css">
.show_preview{
	margin-top:10px;
}
.main_menu{
	font-size:20px;
	line-height:10px;
	/*padding:50px !important;*/
	width:100%;
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
    <script language="javascript">
function gotolist()
{
	location.href='/Document/index/';
}
function gotoedit()
{
	location.href='/Document/index2/?act=staff';
}
</script>
<table width="100%" cellpadding="5"><tr><td <?php
App::uses('CakeSession', 'Model/Datasource');
	  $session = new CakeSession();

	  $users = $session->read('AuthUser');
if($users['User']['unit_id']=="150120103629101691")
	echo "style='visibility:hidden;position:absolute'";

?>>
<button class='main_menu' onclick='gotolist()'><br />บันทึกหนังสือเข้า<br /><br /></button>
</td>
<td>
<button class='main_menu' onclick='gotoedit() '><br />รายการหนังสือเข้า <br /><br /></button>
</td>
<td>
<button class='main_menu' onclick='javascript:;' disabled><br /> ค้นหารายการหนังสือเข้า <br /><br /></button>
</td>
</tr>
</table>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ค้นหารายการหนังสือ
					
				</h3>
			</div>

			<div class="row-fluid">
				<div class="span4">
					<div class="dt_actions span4 " >
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn hideme btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
							<ul class="dropdown-menu">
							<!-- remove class hideme for some reason -->
                                               
								 <li class=' mm_13_add'><a href="#myModal2" onclick="addDocument();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่มหนังสือ รับ - ส่ง </a></li>				
													 <li class=' mm_13_add'><a href="#myModal2" onclick="addDocument();" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> รับ </a></li>	
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
				
				
				<div class="span16">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form action="../../Document/indexsearch" id='form_search' method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                            
                           
                            
                            <div class="control-group" style='text-align:right'>
                            	
                            	<table>
                            		
                            		<tr>
                            		
                            		
                            		<td>
                            		<label for="textfield" >ลงวันที่ : </label>
                            		</td>
                            		<td>
												 <table><tr><td>
												<select style="width:50px;" name='sd[day]' id='sd_day' >
													<option value='01'></option>
                                                <?php
												for($i=1;$i<=31;$i++){
													
													echo "<option value='$i' >" . thainumDigit($i) . "</option>\n";
												}
												?>
                                                </select>
                                                </td><td>
                                                /
                                                </td><td>
                                                <select  style="width:50px;"  name='sd[month]' id='sd_month' >
                                                	<option value='01'></option>
                                                <?php
												foreach($month as $k=>$m)
													echo "<option value='$k'>$m</option>\n";
												?>
                                                </select>
                                                </td><td>
                                                /</td><td><select  style="width:50px;" name='sd[year]' id='sd_year' >
                                                	<option value='0001'></option>
                                                <?php
												for($i=(date("Y")+543)-2;$i<=(date("Y")+543);$i++)
													echo "<option value='$i'>" . thainumDigit(substr($i,-2)) . "</option>\n";
												?>
                                                </select>
                                                </td></tr></table>
                            	</td>
                            	<td>
                            		<label for="textfield" >ถึง : </label>
                            	</td>
                            	<td>
                            		
												
                                                <table><tr><td>
												<select style="width:50px;" name='ed[day]' id='ed_day' >
                                                <?php
												for($i=1;$i<=31;$i++){
													$selected = '';
													if($i==date("d"))
														$selected=' selected';
													echo "<option value='$i' $selected>" . thainumDigit($i) . "</option>\n";
												}
												?>
                                                </select>
                                                </td><td>
                                                /
                                                </td><td>
                                                <select  style="width:50px;"  name='ed[month]' id='ed_month' >
                                                <?php
												foreach($month as $k=>$m)
												{
													$selected = '';
													if($k==date("m"))
														$selected=' selected';
													echo "<option value='$k' $selected>$m</option>\n";
												}
												?>
                                                </select>
                                                </td><td>
                                                /</td><td><select  style="width:50px;" name='ed[year]' id='ed_year' >
                                                <?php
												for($i=(date("Y")+543)-2;$i<=(date("Y")+543);$i++){
													$selected = '';
													if($i==date("Y")+543)
														$selected=' selected';
													echo "<option value='$i' $selected>" . thainumDigit(substr($i,-2)) . "</option>\n";
												}
												?>
                                                </select>
                                                </td></tr></table>
												
                            	</td>
                            	
                            		<td>รหัสติดตาม :</td>
                            	<td>
                            		
                            		 <input type="textbox" name="follow" id='follow' placeholder="รหัสติดตาม" value="<?php echo $follow;?>" style=";" class=''>
                            	</td>
                            	<td>เลขที่หนังสือ :</td>
                            	<td>
                            		
                            		 <input type="textbox" name="code" id='code' placeholder="เลขที่หนังสือ" value="<?php echo $code;?>"  style=";" class=''>
                            	</td>
                            	</tr>
                            	<tr>
                            		<td>ชื่อเรื่อง :</td>
                            	<td>
                            		
                            		 <input type="textbox" name="name" id='name' placeholder="ชื่อเรื่อง" value="<?php echo $name;?>" style=";" class=''>
                            	</td>
                            	<td>หน่วยงาน :</td>
                            	<td>
                            		
                            		 <input type="textbox" name="unit" id='unit' placeholder="หน่วยงาน" value="<?php echo $unit;?>" style=";" class=''
                            		 onkeyup="return unitKeyUp('unit',event)"
                            		 >
                            	</td>
                            	<td>สถาน :</td>
                            	<td>
                            		<select style="" name='type' id='type'>
                            <option value="A">ทั้งหมด</option>
                            <option value="R">รับแล้ว</option>
                            <option value="P">ยังไม่รับ</option>
                             <option value="C">ส่งคืน</option>
 <option value="D">ยกเลิก</option>
                            </select>
                            	</td>
                            	<td>
                            		<button id="Unit-submit" type="submit" class="btn btn-primary mm_13_list" style="display: inline-block;">ค้นหา</button>
                            	</td>
                            	</tr></table>
											

										</div>
                            
                           
                            
								
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
                                                       
                            <th style="text-align: center;width:50px;">ลำดับ</th>
                            <th style="text-align: center;width:50px;">ลงวันที่</th>
                            <th style="text-align: center;width:100px;">ชั้นความลับ</th>
                            <th style="text-align: center;width:100px;">ความเร่งด่วน</th>
                            <th style="text-align: center;width:100px;">เลขที่หนังสือ</th>
							<th style="text-align: center;">ชื่อเรื่อง</th>
                            <th style="text-align: center;width:150px;">วันที่รับ</th>
                            <th style="text-align: center;width:150px;">ผู้รับ</th>
                                                        <th style="text-align: center;width:150px;">การกระทำ</th>
                                                        <th style="text-align: center;width:100px;">เอกสารแนบ</th>
						</tr>
					</thead>
					<tbody>
                    <?php
					foreach($document as $docs){
						$doc = $docs['DocumentFlow'];
						
					?>
																			<tr>

							
							<td style="text-align: center;">
								<?php echo ++$pagination['offset'];?>							</td>
							
                            <td><?php echo $doc['book_date'];?></td>
                            
                            
                            
							<td><?php echo $secrete[$doc['secrete']];?>
							
							</td>
                                                        
                            <td><?php echo $fast[$doc['fast']];?>
							
							</td>
<td><?php echo $doc['code'];?>
							<td><?php echo $doc['name_th'];?>
							
							</td>

<td><?php echo $doc['recieve_date'];?>
							
						
                            </td>

<td><?php 
if(isset($user[$doc['recieve_by']]))
				echo  " [ " . $user[$doc['recieve_by']] . " ] ";
?>
							
							</td>							
							<td style="text-align: center;">
                        <?
	if($doc['status']=="0" && $doc['status']!="9"  && $doc['status']!="9999"){
	?>
    								<a class="link-bb" href="#" onclick='recievedoc("<?php echo $doc['id'];?>","1")'>รับ</a> 
    <?php
}else if($doc['status']=="9999"){
echo "ยกเลิก";

	}else{
		echo "รับแล้ว";
	}

if($doc['status']!="9"  && $doc['status']!="9999"){
?>
<a href="#myModal2" onclick="returnDocument('<?php echo $doc['id'] ;?>');" data-toggle="modal" data-backdrop="static" class="link-bb display" data-tableid="smpl_tbl">ส่งคืน</a>
<a class="link-bb" href="#" onclick='recievedoc("<?php echo $doc['id'];?>","9999")'>ยกเลิก</a> 
<?php 
}
?>


							</td>
                            <td>
                            
                            <?php
 							$docs = $this->requestAction('/Document/showFile/' . $doc['id']);
							$i = 0;
							foreach($docs as $d){
								
								
								$ddoc = $d['DocumentFile'];
								if($ddoc['file_name']=="")
									continue;
								$i++;
							 echo "$i . <a href='/Document/download_file/" . $ddoc['id'] . "' target='_blank'/>" . $ddoc['file_name'] .  "</a>";
							  ?>
                             <a href=<?php echo "'/download2.php?path=files/documentflow/1/" . $doc['id']   . "&file_name=" . $ddoc['file_name'] . "'";?> target='_blank'><i class="icon-download-alt"></i></a><br />
                             <?php
							}
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
			
			function assignDocument(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('รายละเอียดการรับหนังสือ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Document/assignform/<?php echo $corp_id;?>",function(data) {
						$('#customModal2').html(data);
				  });

            } 
			
			function returnDocument(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('รายละเอียดการคืนหนังสือ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Document/returnform/" + id + "/<?php echo $corp_id;?>",function(data) {
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

																	$("#form_search").submit();
                                                                   // window.location="../../EDocument/index/<?php echo $corp_id;?>";                                                       				
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
		
	 
	 <?php
	 if(isset($type) && trim($type)!=""){
		 
			echo " document.getElementById('type').value = '$type';\n";
	 }
	 ?>
   
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
 function unitKeyUp(obj,e) {

			//console.log(e.which);	
			//console.log(obj);
			//if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 8;
			//if($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength){
			if(($("#" + obj).val().length >= triggerMinLength && $("#" + obj).val().length <= triggerMaxLength) || e.which == 32){
				
				var obj_id = $("#" + obj).attr("id");
				//console.log(obj_id);
				var obj_value = $("#" + obj).val();
				var url = "/../../Units/getDataUnit";

				$.post(	url,{
						value:obj_value,
						field:'title'
						},
						function(data){

							var json = $.parseJSON(data);
							var autocomplete = $("#"+obj_id).typeahead();
							autocomplete.data('typeahead').source = json;

						}
						,"html"
				);

			}

		}

      

</script>