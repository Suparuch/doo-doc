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
		  $default['doc_ref'] = empty($default['doc_ref']) ? '' : $default['doc_ref'];
		  	$id =  $default['id'];
			$corp_id = isset($corp_id)?$corp_id:"";
			
function thainumDigit($num){  
   /* return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),  
    array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),  
    $num);
*/
return $num;  
}; 
?>

<script language="javascript">
function gotolist()
{
	location.href='/Document/indexwaiting/<?php echo $type;?>';
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

<?php
if($type!=1){
?>

<table width="100%" cellpadding="5"><tr><td>
<button class='main_menu' onclick='javascript:;'><br />บันทึกข้อมูล<br /><br /></button>
</td>
<td>
<button class='main_menu' onclick='gotolist()'><br />รอหนังสือกลับ <br /><br /></button>
</td>
</tr>
</table>
<?php
}
?>
<hr />
<form action="/Document/saveoutbox/<?php echo $type; ;?>" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data" id='frm_outbox'>
<div class="row-fluid">
	<div class="span6">
		<div class="box box-bordered box-color">

<div class="box-content nopadding">
									
										<input type="hidden" name="offset" value="0">
                                        <?php
										if($type==3){
											?>
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ระดับหนังสือ : </label>
												<div class="controls">
                                                <table><tr valign="middle"><td>
												<input type='radio' name='doc_level' value='1' id='level_1' onclick='hide_doc_level()' /></td><td><label for='level_1' style='margin:5px'>หนังสือกรม</label></td>
                                                </tr><tr valign="middle">
                                                <td>
                                                <input type='radio' name='doc_level' value='2' id='level_2' onclick='show_doc_level()' /></td><td><label for='level_2' style='margin:5px'>หนังสือสำนัก</label></td>
                                                </tr>
                                                </table>
												</div>
											</div>

										</div>
                                        <?php
										}
										?>
                                        
                                        <?php
										if($type==1){
											?>
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ระดับหนังสือ : </label>
												<div class="controls">
                                                <table><tr valign="middle"><td>
												<input type='radio' name='doc_level' value='1' id='level_1' checked="checked" onclick='hide_doc_level()' /></td><td><label for='level_1' style='margin:5px'>หนังสือกอง</label></td>
                                                </tr>
                                                </table>
												</div>
											</div>

										</div>
                                        <?php
										}
										?>
                                        <?php
										if($type==4){
											?>
                                            
                                       <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ระดับหนังสือ : </label>
												<div class="controls">
                                                <table><tr valign="middle"><td>
												<input type='radio' name='doc_level' value='1' id='level_1' checked="checked" onclick='hide_doc_level()' /></td><td><label for='level_1' style='margin:5px'>นำเรียนผู้บังคับบัญชา</label></td>
                                                </tr>
                                                </table>
												</div>
											</div>

										</div>
                                        <?php
										}
										?>
                                        <?php
										if($type==1 || $type==2){
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
                                        <?php
										}
										?>
										<div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ชั้นความลับ : </label>
												<div class="controls">
												<?php
																echo $this->Form->input('secrete', array(
																	'label' => false,
																	'div' => true,
																	'options' =>$secrete,
																	'placeholder' => 'หมวดหมู่เอกสาร',
																	'default' => $default['secret'],
																	'class'=>'preview'
						
																));
																//'default' => $default['document_group'],
															
															?>
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ชั้นความเร่งด่วน : </label>
												<div class="controls">
												<?php
																echo $this->Form->input('fast', array(
																	'label' => false,
																	'div' => true,
																	'options' =>$fast,
																	'placeholder' => 'หมวดหมู่เอกสาร',
																	'default' => $default['fast'],
																	'onchange'=>'change_fast(this)',
																	'class'=>'preview'
						
																));
																//'default' => $default['document_group'],
															
															?>
												</div>
                                                <div class="controls hideme period">
                                                <table><tr><td>วันที่</td><td>
												<select class='preview span12' name='bookdate2[day]' class='preview' id='bookdate_day2'>
                                                <?php
											
												for($i=1;$i<=31;$i++){
													$selected = '';
													if($i==date("d"))
														$selected=' selected="selected" ';
													echo "<option value='$i' $selected>" . thainumDigit($i) . "</option>\n";
												}
												?>
                                                </select>
                                                </td><td>
                                                /
                                                </td><td>
                                                <select class='preview span12'  name='bookdate2[month]' class='preview' id='bookdate_month2'>
                                                <?php
												foreach($month as $k=>$m)
													echo "<option value='$k'>$m</option>\n";
												?>
                                                </select>
                                                </td><td>
                                                /</td><td><select class='preview span12' name='bookdate2[year]' class='preview' id='bookdate_year2'>
                                                <?php
												for($i=(date("Y")+543)-2;$i<=(date("Y")+543);$i++)
													echo "<option value='$i'>" . thainumDigit(substr($i,-2)) . "</option>\n";
												?>
                                                </select>
                                                </td></tr></table>
                                                
                                                </div>
                                                 <div class="controls hideme period">
                                                 เวลา : <input type='text' class='preview span2' name='time' class='preview' placeholder="hh:mm" />
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
                                        
                                        <div class="control-group">
											<div class="" style='display:none'>
												<label for="textfield" class="control-label">อ้างถึง(หนังสือ) : </label>
												<div class="controls">
												<input name="" value="" type="text" placeholder="" class='preview'>
												
												</div>
											</div>

										</div>
                                        
                                        
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ชื่อเรื่อง : </label>
												<div class="controls">
												<?php
                                                                echo $this->Form->input('name_th', array(
                                                                    'label' =>false,
                                                                    'div' => true,
                                                                    'placeholder' => 'เรื่องหนังสือ (ภาษาไทย)',
                                                                    'default' => $default['name_th'],
																	"class" => "preview span12 ",
																	

                                                                ));
                                                            ?>   
												</div>
											</div>

										</div>
                                        
                                         <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">เอกสารต้นเรื่อง : </label>
												<input type='hidden' name='data["doc_ref"]' id='doc_ref' />
												<div class="controls">
												<?php
                                                                echo $this->Form->input('doc_ref_name', array(
                                                                    'label' =>false,
                                                                    'div' => true,
                                                                    'placeholder' => 'อ้างอิง',
                                                                    'default' => $default['doc_ref'],
																	"class" => "preview span6",
																	

                                                                ));
                                                            ?>  
                                                            
                                                            <a href="#myModal2" onclick="ref();" data-toggle="modal" data-backdrop="static" class="link-bb display add_rows_simple" data-tableid="smpl_tbl">เลือกเอกสารต้นเรื่อง</a>
												</div>
											</div>

										</div>
                                        <?php
										if($type!=1){
											?>
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">เสนอ/นำเรียน : </label>
												<div class="controls">
												<select id='to_unit' name='data[to_unit]' class='preview'>
                                                <option value=""> - - - กรุณาเลือกหน่วยงาน - - - </option>
                                                <?php
												foreach($units  as $key=>$val){
													echo "<option value='$key'>$val</option>\n";
												}
												?>
                                                </select>  
												</div>
											</div>

										</div>
                                       <?php
										}
										?>
                                        
                                        

								
								</div>
                                
			
			

		</div>
	</div>
    
    <div class='span6'>
    <?php
										if($type==1){
											?>
    <div class="control-group">
    
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
                                        <?php
										}
										?>
                                      <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">หมายเหตุ</label>
												<div class="controls">
												<?php
																echo $this->Form->input('description', array(
																'type' => 'textarea',
																	'label' => false,
																	'div' => true,
																	'placeholder' => 'คำอธิบาย',
																	'default' => $default['description'],
																	'class'=>'preview'
																											
																));
															?>  
												</div>
											</div>

										</div>
                                      
                                        <div class="control-group">
											<div class="">
												
												<div class="controls">
												<input type='submit' value='บันทึก' id='btn_submit' />
                                                <input type='button' value='แก้ไข' onclick='editme()' id='btn_edit' />
                                                <input type='button' value='Preview' onclick='previewme()' id='btn_preview' />
												</div>
											</div>

										</div>
    </div>
    <div class="span12">
    <div class="box-content nopadding">
				<div class="tab-content tab-content-inline">
รายการเอกสารออกล่าสุด
<br /><br />
	
				<table class="table table-bordered" id="mainTable">
					<thead>
						<tr>
							<th width='250'>เลขที่หนังสือ</th>
                            <th width='250'>รหัสติดตาม</th>
                            <th width='150'>วันที่หนังสือ </th>
							<th>ชื่อเอกสาร </th>
							
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
							<td ><?php echo $doc['DocumentFlow']['order_sort'];?>/
								<?php echo $doc['DocumentFlow']['year'];?>
                                
                                </td>	
                                <td>
								<?php echo $doc['DocumentFlow']['book_date'];?>
							</td>
							<td>
								<?php echo $doc['DocumentFlow']['name_th'];?>
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
</form>
<script language="javascript">
$("#bookdate_day2").val('<?php echo date("j");?>');
$("#bookdate_day").val('<?php echo date("j");?>');

$("#bookdate_month2").val('<?php echo date("n");?>');
$("#bookdate_month").val('<?php echo date("n");?>');

$("#bookdate_year2").val('<?php echo date("Y") + 543;?>');
$("#bookdate_year").val('<?php echo date("Y") + 543;?>');

$("#doc_code").hide();
$("#btn_submit").hide();
$("#btn_edit").hide();

$('#frm_outbox').submit(function(e) {

	var $this = $(this);
   var $input1 = $("#file1").val();
   var $input2 = $("#file2").val();
   var $input3 = $("#file3").val();
   var $input4 = $("#file4").val();
   var $input5 = $("#file5").val();
   if($input1=="" &&$input2=="" &&$input3=="" &&$input4=="" &&$input5=="")
   {
	   if(confirm("คุณยังไม่ได้เลือกไฟล์แนบ \n ยืนยันการดำเนินการ?"))
	   {
		   $(".preview").show();
			$(".show_preview").remove();
			return true;
	   }else{
		   return false;
	   }
   }
	
	//return false;
  // your code here
});

function previewme(){
	$('.preview').replaceWith(function(){
		
		if($(this).is("select")){
			//$("#" + $(this).attr("id") + ":selected").attr("selected","selected");
			$('option:selected', this).attr('selected','selected');
			var old = $(this).parent().html();
			return '<span class="show_'+this.className+'" >'+$("#" + this.id + " option:selected").text() +'</span>' + old;
		}else{
			$(this).attr("value",$(this).val());
			var old = $(this).parent().html();
	   		return '<span class="show_'+this.className+'" >'+$(this).val()+'</span>' + old;
		}
	})
	$(".preview").hide();
	$("#btn_preview").hide();
	$("#btn_submit").show();
	$("#btn_edit").show();
}

function editme(){
	
	$(".preview").hide();
	$("#btn_preview").show();
	$("#btn_submit").hide();
	$("#btn_edit").hide();
	
	$(".preview").show();
	$(".show_preview").remove();
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


function ref(){
		
var category_id = $("select[name='data[document_group]']").val();
		 $('#customModal2').html('');
				  $('#customModalHeader2').html('เลือกเอกสารต้นเรื่อง');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Document/getdocref/",function(data) {
						$('#customModal2').html(data);
				  });

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