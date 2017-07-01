<?php 
        $default['unit'] = empty($dataRequest['unit']) ? '' : $dataRequest['unit'];
		$default['code'] = empty($dataRequest['code']) ? '' : $dataRequest['code'];
function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
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
}
           padding-bottom:1px;
}
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
					รายงานความพร้อมรบ
					
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
							<form  action="../../Capacity/index/" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
								ค้นหา
							
								
								<input name="unit"  style='width:200px;' value='<?php  echo $default['unit'];?>' type="text" placeholder="<?php echo __('หน่วย');?>" >
								<input name="code"  style='width:50px;' value='<?php echo $default['code'];?>' type="text" placeholder="<?php echo __('อจย.');?>" >
								
							
								<button id="PdxReport-submit" type="submit" class="btn btn-primary hideme mm_13_list">ค้นหา</button>
								<input type="hidden" name="offset" value="0" />
							</form>
						</label>						
					</div>
				</div>
			</div>

			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered " style='white-space:nowrap'>
					<thead>
						<tr>
                                                        <th style="text-align: center;width:50px;" class='' rowspan='3'><input type="checkbox" class="toggle"></th>
                            <th class='header ' style="text-align: center;width:50px;" rowspan='3'>ลำดับ</th>
							<th class='header ' style="text-align: center;width:50px;" rowspan='3'>หน่วย</th>
							<th class='header ' style="text-align: center;min-width:300px" rowspan='3'>อจย.</th>
							<th class='header ' style="text-align: center;width:70px;" colspan='8'>สถานะกำลังพล (นาย)</th>
							
                            <th class='header ' style="text-align: center;width:70px;" colspan='5'>การ ปบ. ภารกิจ นอกหน่วย (นาย)</th>
							<th class='header ' style="text-align: center;" colspan='4' rowspan='2'>คงเหลือ</th>
 							<th class='header ' style="text-align: center;" colspan='4'>ความพร้อมสำหรับการรบป้องกันประเทศ</th>
							<th class='header ' style="text-align: center;width:200px;" rowspan='3'>ความพร้อม<br />
ในการจัด <br />
ร้อย.รส.
</th>
							<th class='header ' style="text-align: center;width:200px;" rowspan='3'>ความพร้อม<br />
ในการจัด <br />
ร้อย.ชป.
</th>
							<th class='header ' style="text-align: center;width:200px;" rowspan='3'>ความพร้อม<br />
ด้านยุทโธปกรณ์<br />
(ร้อยละ)
</th>
							<th class='header ' style="text-align: center;width:200px;" rowspan='3'>หมายเหตุ</th>
						</tr>
						<tr>
							<th colspan='4' class='header' style="text-align: center;">อัตราเต็ม</th>
							<th colspan='4' class='header' style="text-align: center;">บรรจุจริง</th>
							
							
							<th rowspan='2'>ปชด.</th>
							<th rowspan='2'>รส.</th>
							<th rowspan='2'>สสช.</th>
							<th rowspan='2' style='text-align:center'>ช่วยเหลือ<br />ปชช.</th>
							<th rowspan='2'>อื่นๆ</th>
							
							
							<th rowspan='2'>บก.</th>
							<th rowspan='2'>สสก.</th>
							<th rowspan='2'>สสช.</th>
							<th rowspan='2'>หน่วย ปบ. หลัก</th>


						</tr>
						<tr>
							<th >รวม</th>
							<th>น.</th>
							<th>ส.</th>
							<th>พลฯ</th>
							
							<th>รวม</th>
							<th>น.</th>
							<th>ส.</th>
							<th>พลฯ</th>
							
							<th>รวม</th>
							<th>น.</th>
							<th>ส.</th>
							<th>พลฯ</th>

						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($PdxReport)){ ?>
                                            <?php foreach($PdxReport as $row) { ?>
						<tr>
                                                        
                                                        <td style="text-align: center;">
                                                            <input type="checkbox" name="docID[]" value="<?php echo $row['PdxReport']['id']; ?>"></td>  
							<td style="text-align: center;">
                                                        <?php 
                                                                /*
                                                                if(!empty($rank['Rank']['order_sort'])) 
                                                                echo $rank['Rank']['order_sort'];                                                               
                                                                 */
                                                                  echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
                                                        <td class='headcol'><?php 
														$unit = $row['PdxReport']['unit'];
														//$treeline = "<img src='/img/treeline.png' />";
														$treeline='&nbsp;';
														$u = str_lreplace("-",$treeline,$unit); 
														echo str_replace("-","&nbsp;&nbsp;",$u);
														
														
														?></td>
							<td style="white-space:normal">
                                                      <?php echo str_replace ("|"," ลงวันที่ ", $row['PdxReport']['code']); ?>  
                                                        </td>
							<td>
                                                        <?php echo ceil($row['PdxReport']['full_n']) + ceil($row['PdxReport']['full_s']); ?>
                                                        </td>
<td>
<?php echo $row['PdxReport']['full_n']; ?>
</td>
							<td>
                                                          <?php 
														  
                                                                echo $row['PdxReport']['full_s'];
															
															
															?>
                                                        </td>
														<td>0
                                                          
                                                        </td> <td><?php echo ceil($row['PdxReport']['use_n']) + ceil($row['PdxReport']['use_s']); ?>
                                                          
                                                        </td>
							<td><?php
							
							echo $row['PdxReport']['use_n'];
							?>
                                                          
                                                        </td>
                                                        <td><?php
							
							echo $row['PdxReport']['use_s'];
							?>
                                                          
                                                        </td>
							
							<td style="text-align: center;">
						0
							</td>
                            <td>0
                                                          
                                                        </td>
                            <td>0
                                                          
                                                        </td>
                                                       <td>0
                                                          
                                                        </td><td>0
                                                          
                                                        </td><td>0
                                                          
                                                        </td>
                                                        <td>
                                                        <?php 
                                                        echo (ceil( $row['PdxReport']['full_n']) - ceil($row['PdxReport']['use_n'])) + (ceil( $row['PdxReport']['full_s']) - ceil($row['PdxReport']['use_s']));
                                                          ?>
                                                        </td>
                                                        
                                                        <td>
                                                        <?php
														echo ceil( $row['PdxReport']['full_n']) - ceil($row['PdxReport']['use_n']);
														?>
                                                          
                                                        </td>
                                                        <td><?php
														echo ceil( $row['PdxReport']['full_s']) - ceil($row['PdxReport']['use_s']);
														?>
                                                          
                                                        </td>
                                                        <td>0
                                                          
                                                        </td>
                                                        <td>0
                                                          
                                                        </td>
                                                        <td>0
                                                          
                                                        </td>
                                                        <td>0
                                                          
                                                        </td><td>0
                                                          
                                                        </td>
                                                        <td>0
                                                          
                                                        </td>
                                                        <td>0
                                                          
                                                        </td>
                                                        <td>0
                                                          
                                                        </td>
                                                        <td>
                                                          
                                                        </td>
                                                       
						</tr>
                                            <?php } ?>
                                            <?php }else {  ?>

                                                <tr>
                                                        <td colspan="20" style="text-align:center;">
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