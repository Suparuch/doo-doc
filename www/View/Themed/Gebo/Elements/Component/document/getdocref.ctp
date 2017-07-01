<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['code'] = empty($default['code']) ? 'กห' : $default['code']; 
        $default['name_th'] = empty($default['name_th']) ? '' : $default['name_th']; 
		 $default['to'] = empty($default['to']) ? '' : $default['to']; 
		 $default['book_date'] = empty($default['book_date']) ? '' : $default['book_date'];
		 $default['description'] =empty($default['description']) ? '' : $default['description'];
		 $default['document_group'] =empty($default['document_group']) ? '' : $default['document_group'];
		 $default['file'] = empty($default['file']) ? '' : $default['file'];
		 $default['fast'] = empty($default['fast']) ? '' : $default['fast'];
		  $default['secret'] = empty($default['secrete']) ? '' : $default['secrete'];
		  	$id =  $default['id'];
			$corp_id = isset($corp_id)?$corp_id:"";
			
function thainumDigit($num){  
    return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),  
    array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),  
    $num);  
}; 
?>

<table class="table table-bordered" id="mainTable">
					<thead>
						<tr>
							<th>เลขที่หนังสือ</th>
							<th>ชื่อเอกสาร </th>
							<th>หมายเหตุ</th>
                            <th>ส่งคืน</th>
						</tr>
					</thead>
					<tbody>
                    <?php
					foreach($document as $doc){
						?>
						<tr>
							<td >
								<?php echo $doc['DocumentFlow']['code'];?>
                                
                                </td>						 
							
							<td>
								<?php echo $doc['DocumentFlow']['name_th'];?>
							</td>
                            <td>
								<?php echo $doc['DocumentFlow']['return_remark'];?>
							</td>
                            <td>
								<a href="#" onclick="refthis('<?php echo $doc['DocumentFlow']['id'];?>','<?php echo $doc['DocumentFlow']['name_th'];?>');" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">เลือกเอกสาร</a>
							</td>
							
						</tr>
																		
						<?php
					}
					?>
					</tbody>
				</table>
<script language="javascript">
$("#bookdate_day2").val('<?php echo date("j");?>');
$("#bookdate_day").val('<?php echo date("j");?>');

$("#bookdate_month2").val('<?php echo date("n");?>');
$("#bookdate_month").val('<?php echo date("n");?>');

$("#bookdate_year2").val('<?php echo date("Y") + 543;?>');
$("#bookdate_year").val('<?php echo date("Y") + 543;?>');

$("#doc_code").hide();

function refthis(objId,objName){
	$("#doc_ref").val(objId);
	$("#doc_ref_name").val(objName);
	 $(".close").trigger( "click" );	
}

function goto(objMenu)
{
	location.href="../../Document/outbox/" + objMenu;
}

function show_doc_level(){
	$("#doc_code").show('fade');
}

function hide_doc_level(){
	$("#doc_code").hide('fade');
}

function change_fast(obj){
	//alert($(obj).val());
	var fast = $(obj).val();
	if(fast==4){
		$(".period").show();
	}else{
		$(".period").hide();
	}
}


 		function editDocumentGroup(){
		
var category_id = $("select[name='data[document_group]']").val();
		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขหมวดหมู่หนังสือ รับ - ส่ง');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../EDocument/formgroup/<?php echo $corp_id;?>/" + category_id,function(data) {
						$('#customModal2').html(data);
				  });

            }   
			
		function del_group(){
			var category_id = $("select[name='data[document_group]']").val();
			if(confirm("ต้องการลบหมวดหมู่ที่เลือกนี้ใช่หรือไม่?")){
				var url = "../../EDocument/delete_group/"+category_id;
				$.post(url,{id:category_id},function(data){
					if(data.status == "SUCCESS"){
                                                        $(".close").trigger( "click" );					
                                                        window.location="../../EDocument/index/" + corp_id;                                            
                                                    }else{
                                                        alert("การลบข้อมูลล้มเหลว");
                                                    }
				},'json');
			
					history.go(-1);
				}
		}
		function modalAction2(){
			
                        var id = $("input[name='id']").val();
			var name = $("input[name='data[name]']").val();
                        var shortname = $("input[name='data[short_name]']").val();
var corp_id = $("input[name='data[corp_id]']").val();
			var code = $("input[name='data[code]']").val();
			var name_en = $("input[name='data[name_en]']").val();
			var name_th = $("input[name='data[name_th]']").val();
			var description = $("textarea[name='data[description]']").val();
			var category_id = $("select[name='data[document_group]']").val();
			var book_date = $("input[name='data[book_date]']").val();
			var keyword = $("input[name='data[keyword]']").val();
			
				if(code != "")
				  {         
					var url = "../../EDocument/save/"+corp_id +"<?php 
					if(!empty($id))
						echo "/" . $id;
					 ?>";
					data = new FormData($("#form_document")[0]);
					
						 $.ajax( {
      url: url,
      type: 'POST',
      data: data,
      processData: false,
      contentType: false,
	  success: function(response) {
           
		    result = response;
            // return response; // <- tried that one as well
			  $(".close").trigger( "click" );					
            window.location="../../EDocument/index/" + corp_id; 
        }
    } );
						/*
							$.post(url,{
							code:code,
							name_en:name_en,
							name_th:name_th,
							description:description,
							corp_id:corp_id,
							category_id:category_id,
							book_date:book_date,
							keyword:keyword
		
						},function(data){
                                                        
                                                    if(data.status == "SUCCESS"){
                                                        $(".close").trigger( "click" );					
                                                        window.location="../../EDocument/index/" + corp_id;                                            
                                                    }else{
                                                        alert("การสร้างข้อมูลล้มเหลว");
                                                    }
							
						}, "json"); 
						*/

						
				  }
				  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}
		}
</script>