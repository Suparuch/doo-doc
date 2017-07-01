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
			
	function thainumDigit($num){  
    return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),  
    array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),  
    $num);  
}; 
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">

<div class="box-content nopadding">

									<form action="" id='form_document' name='form_document' method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<input type="hidden" name="offset" value="0">
										<input type="hidden" name="data[id]" id='id' value="<?php echo $id;?>" />
                                      <?php
										if($type_id==3){
											?>
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">เลขที่หนังสือ: </label>
												<div class="controls">
												<?php
                                                                echo $this->Form->input('code', array(
                                                                    'label' =>false,
                                                                    'div' => true,
                                                                    'placeholder' => 'เลขที่หนังสือ รับ - ส่ง',
                                                                    'default' => thainumDigit($default['code']),
																	'empty'=>'กห.',
																	'class'=>'preview'

                                                                ));
                                                            ?>   
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ลงวันที่ : </label>
												<div class="controls">
                                                <table><tr><td>
												<select class='preview span12' name='bookdate[day]' id='bookdate_day' class='preview'>
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
                                                <select class='preview span12'  name='bookdate[month]' id='bookdate_month' class='preview'>
                                                <?php
												foreach($month as $k=>$m)
													echo "<option value='$k'>$m</option>\n";
												?>
                                                </select>
                                                </td><td>
                                                /</td><td><select class='preview span12' name='bookdate[year]' id='bookdate_year' class='preview'>
                                                <?php
												for($i=(date("Y")+543)-2;$i<=(date("Y")+543);$i++)
													echo "<option value='$i'>" . thainumDigit(substr($i,-2)) . "</option>\n";
												?>
                                                </select>
                                                </td></tr></table>
												</div>
											</div>

										</div>
                                        <?php
										}
										?>
                                       
                                       <div class="">
												<label for="textfield" class="control-label">'ไฟล์เอกสาร :  </label>
												<div class="controls">
												<?php
                                                                echo $this->Form->input('file.1', array(
																'type' => 'file',
                                                                    'label' => false,
                                                                    'div' => true,
                                                                    'placeholder' => 'ไฟล์เอกสาร',
                                                                   
																	'default' => $default['file'],
                                                                ));
                                                            ?>
                                                            <?php
                                                                echo $this->Form->input('file.2', array(
																'type' => 'file',
                                                                    'label' => false,
                                                                    'div' => true,
                                                                    'placeholder' => 'ไฟล์เอกสาร',
                                                                   
																	'default' => $default['file'],
                                                                ));
                                                            ?>
                                                            <?php
                                                                echo $this->Form->input('file.3', array(
																'type' => 'file',
                                                                    'label' => false,
                                                                    'div' => true,
                                                                    'placeholder' => 'ไฟล์เอกสาร',
                                                                   
																	'default' => $default['file'],
                                                                ));
                                                            ?>
                                                            
                                                            <?php
                                                                echo $this->Form->input('file.4', array(
																'type' => 'file',
                                                                    'label' => false,
                                                                    'div' => true,
                                                                    'placeholder' => 'ไฟล์เอกสาร',
                                                                   
																	'default' => $default['file'],
                                                                ));
                                                            ?>
                                                            <?php
                                                                echo $this->Form->input('file.5', array(
																'type' => 'file',
                                                                    'label' => false,
                                                                    'div' => true,
                                                                    'placeholder' => 'ไฟล์เอกสาร',
                                                                   
																	'default' => $default['file'],
                                                                ));
                                                            ?>
                                                            
                                                            * ขนาดไฟล์ไม่เกิน 50 MB'
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
			var $this = $("#form_document");
   var $input1 = $("#file1").val();
   var $input2 = $("#file2").val();
   var $input3 = $("#file3").val();
   var $input4 = $("#file4").val();
   var $input5 = $("#file5").val();
   if($input1=="" &&$input2=="" &&$input3=="" &&$input4=="" &&$input5=="")
   {
	   if(confirm("คุณยังไม่ได้เลือกไฟล์แนบ \n ยืนยันการดำเนินการ?"))
	   {
		   
	   }else{
		   return false;
	   }
   }
                        var id = $("input[name='id']").val();
			var remark = $("#remark").val();
                      
		
				if(remark != "")
				  {         
					var url = "../../Document/savereturndoc/"+corp_id +"<?php 
					if(!empty($type_id))
						echo "/" . $type_id;
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