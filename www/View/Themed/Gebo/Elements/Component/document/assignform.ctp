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
		  	$id =  $default['id'];
				$corp_id = isset($corp_id)?$corp_id:"";
			
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">

<div class="box-content nopadding">
									<form action="/Document/assignit" id='form_document' method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<input type="hidden" name="offset" value="0">
										<input type='hidden' name='doc_id' id='doc_id' />
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">มอบหมายผู้ปฏิบัติ : </label>
												<div class="controls">
                                                <select name='assign_to' id='assign_to'>
                                                <?php
												foreach($users as $user){
													?>
                                                    <option value='<?php echo $user['User']['id'];?>'><?php echo $user['Rank']['short_name'];?> <?php echo $user['User']['name'];?> <?php echo $user['User']['surname'];?></option>
                                                    <?php
												}
												?>
                                                </select> 

												</div>
											</div>

										</div>
                                       
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">หมายเหตุ : </label>
												<div class="controls">
												<textarea name="assign_remark" id='assign_remark' cols="" rows="5"></textarea>
												</div>
											</div>

										</div>
                                        
                                        
                                        

									</form>
								</div>
                                
			
			

		</div>
	</div>
</div>

<script>

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
			
                        var id = $("#doc_id").val();
			
				  
					var url = "../../Document/assign/<?php echo $corp_id;?>";
					var data = new FormData($("#form_document")[0]);
					
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
									window.location.reload();
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
</script>