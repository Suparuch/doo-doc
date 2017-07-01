
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

<style type="text/css">
.form-horizontal .controls {
	margin-left:0px;
}
.left1{
	margin-left:20px !important;
}
input{
	margin-right:5px !important;
}
.h3{
	text-decoration: underline;
}
</style>
<script language="JavaScript">
	function toggle_chk(obj){
		
		if($(obj).is(':checked'))
			$("." +  $(obj).attr("class")).prop('checked', true);
		else
			$("." +  $(obj).attr("class")).prop('checked', false);
	}
	
	function toggle_chk(obj,strClass){
		
		if($(obj).is(':checked'))
			$("." +  strClass).prop('checked', true);
		else
			$("." +  strClass).prop('checked', false);
	}
	
</script>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">

<div class="box-content nopadding">

									<form action="" id='form_document' name='form_document' method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<input type="hidden" name="offset" value="0">
										<input type="hidden" name="data[id]" id='id' value="<?php echo $id;?>" />
                              <table width="100%">
                              	
                              <tr valign="top">
                              	
                              	<td width="50%">
                              		 <h3 class="h3"><input type='checkbox' class='' onclick="toggle_chk(this,'left')" />กรมยุทธการทหารบก </h3>
<h4><input type='checkbox' class='left c1_1' onclick="toggle_chk(this,'c1_1')" />สนผ.ยก.ทบ.</h4> 
<br /><input type='checkbox' class='left left1 c1_1'>กนผ.สนผ.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_1'>กกจ.สนผ.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_1'>กวพ.สนผ.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_1'>กปศ.สนผ.ยก.ทบ.
<hr />
<h4><input type='checkbox' class='left c1_2' onclick="toggle_chk(this,'c1_2')"  />สปก.ยก.ทบ.</h4>
<br /><input type='checkbox' class='left left1 c1_2'>กยก.สปก.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_2'>กยกอ.สปก.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_2'>กปพ.สปก.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_2'>กทส.สปก.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_2'>กมส.สปก.ยก.ทบ.
<hr />
<h4><input type='checkbox' class='left c1_3' onclick="toggle_chk(this,'c1_3')" />กศท.ยก.ทบ.</h4>
<br /><input type='checkbox' class='left left1 c1_3'>กกฝ.สฝศ.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_3'>กฝผ.สฝศ.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_3'>กศท.สฝศ.ยก.ทบ.
<hr />
<h4><input type='checkbox' class='left c1_4' onclick="toggle_chk(this,'c1_4')" />นขต.ยก.ทบ. อื่นๆ</h4>
<br /><input type='checkbox' class='left left1 c1_4'>กคง.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_4'>กธก.ยก.ทบ.
<br /><input type='checkbox' class='left left1 c1_4'>ผกง.ยก.ทบ.
                              	</td>
                              	<td>
                              		<h3 class="h3"><input type='checkbox' class='' onclick="toggle_chk(this,'right')" />ฝ่ายยุทธการศูนย์ปฏิบัติการกองทัพบก </h3>
<h4><input type='checkbox' class='right c2_1' onclick="toggle_chk(this,'c2_1')" />ส่วนยุทธการ </h4>
<br /><input type='checkbox' class='right left1 c2_1'>แผนกยุทธการ
<br /><input type='checkbox' class='right left1 c2_1'>แผนกเทคโนโลยีสารสนเทศและการสื่อสาร
<br /><input type='checkbox' class='right left1 c2_1'>แผนกปฏิบัติการทางทหารที่มิใช่สงคราม
<br /><input type='checkbox' class='right left1 c2_1'>แผนกปฏิบัติการพิเศษ 
<br /><input type='checkbox' class='right left1 c2_1'>แผนกยุทธการอากาศและการบิน
<hr />
<h4><input type='checkbox' class='right c2_2' onclick="toggle_chk(this,'c2_2')" />ส่วนควบคุมปฏิบัติการ</h4>
<br /><input type='checkbox' class='right left1 c2_2'>แผนกควบคุมการปฏิบัติการด้าน ทภ.๑
<br /><input type='checkbox' class='right left1 c2_2'>แผนกควบคุมการปฏิบัติการด้าน ทภ.๒
<br /><input type='checkbox' class='right eft1 c2_2'>แผนกควบคุมการปฏิบัติการด้าน ทภ.๓
<br /><input type='checkbox' class='right left1 c2_2'>แผนกควบคุมการปฏิบัติการด้าน ทภ.๔
<hr />
<h4><input type='checkbox' class='right c2_3' onclick="toggle_chk(this,'c2_3')" />ส่วนสื่อสาร</h4>
<br /><input type='checkbox' class='right left1 c2_3'>แผนกศูนย์การสื่อสาร
<br /><input type='checkbox' class='left1 c2_3'>แผนกปฏิบัติการสื่อสารและโทรคมนาคม
<hr />
<h4><input type='checkbox' class='right c2_4' onclick="toggle_chk(this,'c2_4')" />แผนกธุรการ</h4>
<br /><input type='checkbox' class='right left1 c2_4'>ตอนธุรการ
<br /><input type='checkbox' class='right left1 c2_4'>ตอนอารักขายานยนต์
                              	</td>
                              </tr>
                              </table>       
                                    

                                     
                                       <table width="100%" style="display:none;">
                                       <tr valign="top"><td width="50%">
                                       
                                       <div class="span12">
                                       
                                       <div class="control-group">
												
												<div class="controls">
                                                <fieldset>
												<legend>สายปกติ :  </legend>
												<?php
												foreach($unit1 as $u){
													?>
                                                    <table><tr><td>
                                                    <input type='checkbox' name='u[]' id='u_<?php echo $u[0]['id'];?>' value='<?php echo $u[0]['id'];?>' />
                                                    </td><td>
                                                    <label for='u_<?php echo $u[0]['id'];?>'><?php echo $u[0]['short_name'];?></label>
                                                    </td>
                                                    </tr>
                                                    </table>
                                                    <?php
												}
												?>
                                                </fieldset>      
												</div>
											</div>

										     <div class="control-group">
												
												<div class="controls">
												 <fieldset>
												<legend>สายสนาม :  </legend>
												
                                                    <?php
												foreach($unit2 as $u){
													?>
                                                    <table><tr><td>
                                                    <input type='checkbox' name='u[]' id='u_<?php echo $u[0]['id'];?>' value='<?php echo $u[0]['id'];?>' />
                                                    </td><td>
                                                    <label for='u_<?php echo $u[0]['id'];?>'><?php echo $u[0]['short_name'];?></label>
                                                    </td>
                                                    </tr>
                                                    </table>
                                                    <?php
												}
												?>
                                                </fieldset>
												</div>
											</div>

										</div>
                                        </td><td>
                                        <div class="span12">
										 <fieldset>
												<legend>นขต ทบ. :  </legend>
                                      
                                        <div class="control-group">
												
												<div class="controls">
												<?php
												foreach($unit3 as $u){
													?>
                                                    <table><tr><td>
                                                    <input type='checkbox' name='u[]' id='u_<?php echo $u[0]['id'];?>' value='<?php echo $u[0]['id'];?>' />
                                                    </td><td>
                                                    <label for='u_<?php echo $u[0]['id'];?>'><?php echo $u[0]['short_name'];?></label>
                                                    </td>
                                                    </tr>
                                                    </table>
                                                    <?php
												}
												?>
												</div>
											</div>
</fieldset>
										</div>
                                        </td></tr>
                                        </table>

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
					var url = "../../Document/saveboardcast/"+corp_id +"<?php 
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