<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['short_name'] = empty($default['short_name']) ? '' : $default['short_name']; 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
		 $default['document_category'] = empty($default['document_category']) ? '' : $default['document_category']; 
		 $default['book_date'] = empty($default['book_date']) ? '' : $default['book_date'];
		 $default['keyword'] =empty($default['keyword']) ? '' : $default['keyword'];
		 $default['document_group'] =empty($default['document_group']) ? '' : $default['document_group'];
		 $default['file'] = empty($default['file']) ? '' : $default['file'];
		 $default['fast'] = empty($default['fast']) ? '' : $default['fast'];
		  $default['secret'] = empty($default['secrete']) ? '' : $default['secrete'];
		//  	$id =  $default['id'];
			
			
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">

<div class="box-content nopadding">
									<form action="" id='form_document' name='form_document' method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<input type="hidden" name="offset" value="0">
										<input type="hidden" name="data[id]" id='id' value="<?php echo $id;?>" />
                                      
                                       
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">หมายเหตุ : </label>
												<div class="controls">
												<textarea name="remark" id='remark' cols="" rows="5"></textarea>
												</div>
											</div>

										</div>
                                        
                                        
                                        

									</form>
								</div>
                                
			
			

		</div>
	</div>
</div>

<script>
var corp_id = "<?php echo (isset($corp_id) ? $corp_id : "") ?>";
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
			var remark = $("#remark").val();
                      
		
				if(remark != "")
				  {         
					var url = "../../Document/savereturn/"+corp_id +"<?php 
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
			 $(".close").trigger( "click" );					
			window.location.reload();
        }
    } );
					

						
				  }
				  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}
		}
</script>