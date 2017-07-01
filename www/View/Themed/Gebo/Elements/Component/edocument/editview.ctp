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
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">
<form action="" method='post' id='form_document' enctype="multipart/form-data">					
									
                                                            <input type="hidden" name="data[id]" value="<?php echo $default['id']; ?>"/>
															 <input type="hidden" name="data[corp_id]" value="<?php echo $corp_id; ?>"/>
                                                            <?php
                                                                echo $this->Form->input('code', array(
                                                                    'label' => 'เลขที่หนังสือ รับ - ส่ง :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'เลขที่หนังสือ รับ - ส่ง',
                                                                    'default' => $default['code']

                                                                ));
                                                            ?>    
		
                                                            <?php
                                                                echo $this->Form->input('name_th', array(
                                                                    'label' => 'เรื่องหนังสือ (ภาษาไทย) :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'เรื่องหนังสือ (ภาษาไทย)',
                                                                    'default' => $default['name_th']

                                                                ));
                                                            ?>   
															<div style='display:none'>
															<?php
                                                                echo $this->Form->input('name_en', array(
                                                                    'label' => 'เรื่องหนังสือ (ภาษาอังกฤษ) :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'เรื่องหนังสือ(ภาษาอังกฤษ)',
                                                                    'default' => $default['name_en']

                                                                ));
                                                            ?> 
															</div>
															<?php
                                                                echo $this->Form->input('book_date', array(
                                                                    'label' => 'ลงวันที่ :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ปปปป/ดด/วว',
                                                                    'default' => $default['book_date'],

                                                                ));
                                                            ?> 
															
															<input type="hidden" name="data[document_group_id][id]" value="<?php echo $default['id']; ?>"/>
															<?php
																echo $this->Form->input('document_group', array(
																	'label' => 'ชื่อหมวดหมู่  :',
																	'div' => true,
																	'class' => 'span8',
																	'options' => $DocumentGroup,
																	'placeholder' => 'หมวดหมู่เอกสาร',
																	'default' => $default['document_group'],
						
																));
																//'default' => $default['document_group'],
															
															?>
															<a href='#' onclick='editDocumentGroup()' data-toggle="modal">แก้ไขหมวดหมู่</a> <a href='javascript:;' onclick='del_group()'>ลบหมวดหมู่</a>
															<br /><br />
															<input type="hidden" name="data[secret][id]" value="<?php echo $default['secret']; ?>"/>
															<?php
																echo $this->Form->input('secrete', array(
																	'label' => 'ชั้นความลับ  :',
																	'div' => true,
																	'class' => 'span8',
																	'options' =>$secrete,
																	'placeholder' => 'หมวดหมู่เอกสาร',
																	'default' => $default['secret'],
						
																));
																//'default' => $default['document_group'],
															
															?>
															<input type="hidden" name="data[fast][id]" value="<?php echo $default['fast']; ?>"/>
															<?php
																echo $this->Form->input('fast', array(
																	'label' => 'ชั้นความเร่งด่วน  :',
																	'div' => true,
																	'class' => 'span8',
																	'options' =>$fast,
																	'placeholder' => 'หมวดหมู่เอกสาร',
																	'default' => $default['fast'],
						
																));
																//'default' => $default['document_group'],
															
															?>
															<?php
                                                                echo $this->Form->input('keyword', array(
                                                                    'label' => 'คำสำหรับค้นหา *<br /> เช่น คำสั่งเลขที่ 30/26, กอง พธ.พล., อัตรากำลังพล :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'คำสำหรับค้นหา',
                                                                  'default' => $default['keyword'],

                                                                ));
                                                            ?> 
															<?php
                                                                echo $this->Form->input('file', array(
																'type' => 'file',
                                                                    'label' => 'ไฟล์เอกสาร :  * ขนาดไฟล์ไม่เกิน 50 MB',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ไฟล์เอกสาร',
                                                                   
																	'default' => $default['file'],
                                                                ));
                                                            ?>
															<?php
																echo $this->Form->input('description', array(
																'type' => 'textarea',
																	'label' => 'คำอธิบาย',
																	'div' => true,
																	'class' => 'span8',
																	'placeholder' => 'คำอธิบาย',
																	'default' => $default['description'],
																											
																));
															?>  
															 
</form>		

						


					</div>
					
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