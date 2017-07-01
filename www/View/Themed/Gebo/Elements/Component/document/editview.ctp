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
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">

<div class="box-content nopadding">
									<form action="p04.html" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<input type="hidden" name="offset" value="0">
										<div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">เลขที่หนังสือรับ - ส่ง : </label>
												<div class="controls">
												<input name="" value="" type="text" placeholder="">
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ลงวันที่ : </label>
												<div class="controls">
                                                <table><tr><td>
												<select class='span12'>
                                                <?php
												for($i=1;$i<=31;$i++)
													echo "<option>$i</option>\n";
												?>
                                                </select>
                                                </td><td>
                                                /
                                                </td><td>
                                                <select class='span12' >
                                                <?php
												for($i=1;$i<=12;$i++)
													echo "<option>$i</option>\n";
												?>
                                                </select>
                                                </td><td>
                                                /</td><td><select class='span12'>
                                                <?php
												for($i=date("Y")-2;$i<=date("Y");$i++)
													echo "<option>$i</option>\n";
												?>
                                                </select>
                                                </td></tr></table>
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="" style='display:none'>
												<label for="textfield" class="control-label">อ้างถึง(หนังสือ) : </label>
												<div class="controls">
												<input name="" value="" type="text" placeholder="">
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ชั้นความลับ : </label>
												<div class="controls">
												<select>
                                                <option>ไม่ระบุ</option>
                                                </select>
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ชั้นความเร่งด่วน : </label>
												<div class="controls">
												<select>
                                                <option>ไม่ระบุ</option>
                                                </select>
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ชื่อเรื่อง : </label>
												<div class="controls">
												<input name="" value="" type="text" placeholder="">
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ถึง : </label>
												<div class="controls">
												<input name="" value="" type="text" placeholder="">
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">&nbsp;</label>
												<div class="controls">
												<input type="file"><br /><input type="file"><br /><input type="file">
												</div>
											</div>

										</div>
                                        
                                      <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">หมายเหตุ</label>
												<div class="controls">
												<textarea></textarea>
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