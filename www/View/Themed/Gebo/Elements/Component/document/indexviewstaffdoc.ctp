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
    background-color: #f44336;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
   border-radius:5px;
width:30%;
}


.link-bb:hover, a:active {
    background-color: red;
}


</style>
    <script language="javascript">
function gotoinput()
{
	location.href='/Document/index3/';
}
function gotosearch()
{
	location.href='/Document/indexsearch/';
}
function gotolist()
{
	location.href='/Document/index2/?act=staffdoc&secrete=N';
}
function gotolist_s()
{
	location.href='/Document/index2/?act=staffdoc';
}
</script>
<table width="100%" cellpadding="5">
<tr><td <?php
App::uses('CakeSession', 'Model/Datasource');
	  $session = new CakeSession();

	  $users = $session->read('AuthUser');
if($users['User']['unit_id']=="150120103629101691")
	echo "style='visibility:hidden;position:absolute'";

?>>
<button  class='main_menu' onclick='gotoinput()'><br />บันทึกหนังสือเข้า<br /><br /></button>
</td>
<td>
<button class='main_menu' <?php echo (isset($_GET['secrete']) && $_GET['secrete']=='N'?"onclick='javascript:;' disabled":"onclick='gotolist()'")?>><br />รายการหนังสือเข้า <br /><br /></button>
</td>
<td <?php 
if($users['User']['doc_secrete']=='N')
echo "style='visibility:hidden;position:absolute'";
 ?>>
<button class='main_menu' <?php echo (!isset($_GET['secrete']) || $_GET['secrete']!='N'?"onclick='javascript:;' disabled":"onclick='gotolist_s()'")?>><br />รายการหนังสือ (ลับ) <br /><br /></button>
</td>
</tr>
</table>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					รายการหนังสือเข้า
					
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
				
				
				<div class="span8">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form action="../../Document/index2/?act=staffdoc" id='form_search' method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                            
                            ค้นหา&nbsp;
                            
                            <select style="width:100px;" name='type' id='type'>
                            <option value="A">ทั้งหมด</option>
                            <option value="R">รับแล้ว</option>
                            <option value="P">ยังไม่รับ</option>
                             <option value="C">ส่งคืน</option>
<option value="D">ยกเลิก</option>
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
                                                       
                            <th style="text-align: center;width:50px;" rowspan='2'>ลำดับ</th>
                          <th style="text-align:center" colspan='4'>หนังสือรับ-ส่ง</th>
                            <th style="text-align: center;width:100px;" rowspan='2'>จาก</th>
                            <th style="text-align: center;width:100px;" rowspan='2'>ถึง</th>
			    <th style="text-align: center;" rowspan='2'>ชื่อเรื่อง</th>
                            <th style="text-align: center;width:150px;" rowspan='2'>การปฏิบัติ</th>
			    <th style="text-align: center;width:100px;" rowspan='2'>หมายเหตุ</th>
                                                        <th style="text-align: center;width:150px;" rowspan='2'>การกระทำ</th>
                                                       
						</tr>
<tr>
 <th style="text-align: center;width:50px;">ลำดับ หนังสือรับ</th>
                           <th style="text-align: center;width:50px;">ลำดับ หนังสือออก</th>
                           <th style="text-align: center;width:50px;">เลขที่</th>

                            <th style="text-align: center;width:50px;">ลงวันที่</th>
</tr>
					</thead>
					<tbody>
                    <?php
					foreach($document as $docs){
						$doc = $docs['DocumentFlow'];
						
					?>
																			<tr>

							
							<td style="text-align: center;">
								<?php echo $doc['running'];?>						</td>
							<td>
<?php
if($doc['book_type']=="1")
	echo $doc['sub_running'];
?>
</td><td>
<?php
if($doc['book_type']=="2")
	echo $doc['sub_running'];
?>
</td><td>
<?php
if($doc['book_type']=="1")
{
	echo $doc['code'];
}else{
if($doc['book_send_type']=="1")
	echo "น.ออก";
else
	echo "ว.ออก";
}
?>
</td>
                            <td><?php echo $doc['book_date'];?></td>
                            
                            
                            
							<td>	
						<?php echo $doc['from'];?>
							</td>
                                                        
                            <td>
							<?php echo $doc['to'];?>
							</td>

							<td><?php echo $doc['name_th'];?>
							
							</td>

<td><?php echo $doc['worker'];?>
							
						
                            </td>

<td>
<?php echo $doc['description'];?>
							
							</td>							
							<td style="text-align: center;">
                        <?
	if($doc['status']=="0" && $doc['status']!="9"  && $doc['status']!="9999"){
	?>
    			
    <?php
}else if($doc['status']=="9999"){
echo "ยกเลิก";

	}else{
		echo "รับแล้ว";
	}

if($doc['status']!="9"  && $doc['status']!="9999"){
?>

<a href="#myModal2" onclick="remark('<?php echo $doc['id'] ;?>','<?php echo $doc['description'];?>');" data-toggle="modal" data-backdrop="static" class="link-bb display btn-primary" data-tableid="smpl_tbl">แก้ไข</a>
<a class="link-bb" href="#" onclick='recievedoc("<?php echo $doc['id'];?>","9999")'>ยกเลิก</a> 
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
function remark(id, remark){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('หมายเหตุ');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Document/remarkform/" + id + "/<?php echo $corp_id;?>/" + remark,function(data) {
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
	 if(isset($type)){
		 
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
if(confirm("ต้องการลบรายการนี้ใช่หรือไม่ ")){
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
			}
 

      

</script>