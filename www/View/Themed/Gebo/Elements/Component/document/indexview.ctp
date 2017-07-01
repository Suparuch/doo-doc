<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['code'] = empty($default['code']) ? 'กห ' : $default['code']; 
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
/*
    return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),  
    array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),  
    $num);  
*/
return $num;
}; 

$hide = "";
if($users['User']['unit_id']=="27")
	$hide = "style='visibility:hidden;position:absolute'";
?>
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
<script language="javascript">
function gotolist()
{
	location.href='/Document/index2/?act=staff';
}
function gotosearch()
{
	location.href='/Document/indexsearch/';
}
</script>
<table width="100%" cellpadding="5"><tr><td>
<button class='main_menu' onclick='javascript:;' disabled><br />บันทึกหนังสือเข้า<br /><br /></button>
</td>
<td <?php
App::uses('CakeSession', 'Model/Datasource');
	  $session = new CakeSession();

	  $users = $session->read('AuthUser');
if($users['User']['unit_id']=="160325151318423870")
	echo "style='visibility:hidden;position:absolute'";

?>>
<button class='main_menu' onclick='gotolist()'><br />รายการหนังสือเข้า <br /><br /></button>
</td>
<td <?php
if($users['User']['unit_id']=="160325151318423870")
	echo "style='visibility:hidden;position:absolute'";

?>>
<button class='main_menu' onclick='gotosearch()'><br />ค้นหารายการหนังสือเข้า <br /><br /></button>
</td>
</tr>
</table>
<div class="row-fluid">
	<div class="span6">
		<div class="box box-bordered box-color">

<div class="box-content nopadding">
									<form action="/Document/save" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<input type="hidden" name="offset" value="0">
										<div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">เลขที่หนังสือ: </label>
												<div class="controls">
												<?php
                                                                echo $this->Form->input('code', array(
                                                                    'label' =>false,
                                                                    'div' => true,
                                                                    'placeholder' => 'เลขที่หนังสือ รับ - ส่ง',
                                                                    'default' => $default['code'],
																	'empty'=>'กห.'

                                                                ));
                                                            ?>   
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ลงวันที่ : </label>
												<div class="controls">
                                                <table><tr><td style='width:30px'>
                                                	<input type='text'  name='bookdate[day]' id='bookdate_day' style='width:30px' />
												
                                                </td><td>
                                                /
                                                </td><td>
                                                <select class='span12'  name='bookdate[month]' id='bookdate_month'>
                                                <?php
												foreach($month as $k=>$m)
													echo "<option value='$k'>$m</option>\n";
												?>
                                                </select>
                                                </td><td>
                                                /</td><td>
                                                	<input type='text' class='span4' name='bookdate[year]' id='bookdate_year'>
                                                	
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
												<?php
																echo $this->Form->input('secrete', array(
																	'label' => false,
																	'div' => true,
																	'options' =>$secrete,
																	'placeholder' => 'หมวดหมู่เอกสาร',
																	'default' => $default['secret'],
						
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
																	'onchange'=>'change_fast(this)'
						
																));
																//'default' => $default['document_group'],
															
															?>
												</div>
                                                <div class="controls hideme period">
                                                <table><tr><td>วันที่</td><td>
												<select class='span12' name='bookdate2[day]' id='bookdate_day2'>
                                                <?php
												for($i=1;$i<=31;$i++)
													echo "<option value='$i'>" . thainumDigit($i) . "</option>\n";
												?>
                                                </select>
                                                </td><td>
                                                /
                                                </td><td>
                                                <select class='span12'  name='bookdate2[month]' id='bookdate_month2'>
                                                <?php
												foreach($month as $k=>$m)
													echo "<option value='$k'>$m</option>\n";
												?>
                                                </select>
                                                </td><td>
                                                /</td><td><select class='span12' name='bookdate2[year]' id='bookdate_year2'>
                                                <?php
												for($i=(date("Y")+543)-2;$i<=(date("Y")+543);$i++)
													echo "<option value='$i'>" . thainumDigit(substr($i,-2)) . "</option>\n";
												?>
                                                </select>
                                                </td></tr></table>
                                                
                                                </div>
                                                 <div class="controls hideme period">
                                                 เวลา : <input type='text' class='span2' name='time' placeholder="hh:mm" />
                                                 </div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">ชื่อเรื่อง : </label>
												<div class="controls">
												<?php
                                                                echo $this->Form->textArea('name_th', array(
                                                                    'label' =>false,
                                                                    'div' => true,
                                                                    'placeholder' => 'เรื่องหนังสือ (ภาษาไทย)',
                                                                    'default' => $default['name_th'],
																	"class" => "span12",
																	

                                                                ));
                                                            ?>   
												</div>
											</div>

										</div>
                                        
                                        <div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">เสนอ : </label>
												<div class="controls">
													<input type="textbox" name="unit" id='unit' placeholder="หน่วยงาน"  style=";" class=''
                            		 onkeyup="return unitKeyUp('unit',event)" onblur="selectbyunit(this)"
                            		 >
												<?php
                                                                echo $this->Form->input('to_unit', array(
									'style'=>'position:absolute;top:-1000px;',
                                                                    'label' => false,
                                                                    'div' => true,
                                                                    'placeholder' => 'ถึง',
																	'options' => $units,
								'empty' => ' - - - หน่วย - - - ',
                                                                    'default' => $default['to']

                                                                ));
                                                            ?>   
<label id='to_unit_name' style='visibility: hidden'></label>
										
<a href="#myModal2" data-toggle="modal" data-backdrop="static" class="link-bb display" data-tableid="smpl_tbl" style='visibility: hidden' onclick="showunit()">หน่วย</a>

		</div>
											</div>

										</div>



                                        
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
                                                            
                                                            * ขนาดไฟล์ไม่เกิน 50 MB'
												</div>
											</div>

										</div>
                                        
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
																	'rows'=>2
																	
																											
																));
															?>  
												</div>
											</div>

										</div>
                                      
                                        <div class="control-group">
											<div class="">
												
												<div class="controls">
												<input type='submit' value='บันทึก' />
												</div>
											</div>

										</div>

									</form>
								</div>
                                
			
			

		</div>
	</div>
    <div class="span6">
    <div class="box-content nopadding" <?php echo $hide;?>>
				<div class="tab-content tab-content-inline">
รายการเอกสารที่บันทึกล่าสุด
<br /><br />

				<table class="table table-bordered" id="mainTable">
					<thead>
						<tr>
							<th>รหัสติดตาม</th>
							<th width='150'>เลขที่หนังสือ</th>
							<th>ชื่อเอกสาร </th>
							
						</tr>
					</thead>
					<tbody>
                    <?php
					foreach($document as $doc){
						?>
						<tr>	
							<td><?php echo $doc['DocumentFlow']['running'];?></td>
							<td >
								<?php echo $doc['DocumentFlow']['code'];?>
                                
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
            <br /><br />
            <div class="box-content nopadding">
				<div class="tab-content tab-content-inline">
รายการเอกสารส่งคืน
<br /><br />

				<table class="table table-bordered" id="mainTable">
					<thead>
						<tr>
							<th width='150'>เลขที่หนังสือ</th>
							<th>ชื่อเอกสาร </th>
							<th>หมายเหตุ</th>
                            <th>เสนอ</th>
						</tr>
					</thead>
					<tbody>
                    <?php
					foreach($document_return as $doc){
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
								<a href="#myModal2" onclick="changeUnits('<?php echo $doc['DocumentFlow']['id'];?>');" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">หน่วย</a>
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

<script>

$("#bookdate_day2").val('<?php echo date("j");?>');
$("#bookdate_day").val('<?php echo date("j");?>');

$("#bookdate_month2").val('<?php echo date("n");?>');
$("#bookdate_month").val('<?php echo date("n");?>');

$("#bookdate_year2").val('<?php echo date("Y") + 543;?>');
$("#bookdate_year").val('<?php echo date("Y") + 543;?>');

function selectit(objId){
//alert(objId);
$("#to_unit").val(objId);
var txt = $("#to_unit option:selected").text();
$("#to_unit_name").html(txt);
$('#myModal2').modal('hide');
}

function selectbyunit(objUnit){
	//alert($(objUnit).val());
	$('select[id="to_unit"] > option:contains("' + $(objUnit).val() + '")').attr("selected", "selected");
	//alert($('select[id="to_unit"] > option:contains("' + $(objUnit).val() + '")').val());
	$("#to_unit option[text='" + $(objUnit).val() + "']").attr("selected", "selected");
}

function showunit(){
				 $('#customModal2').html('');
				  $('#customModalHeader2').html('เสนอ');
				  $('#customModalAction2').hide();
				  $('#customModal2').load("../../Document/showunit/",function(data) {
						$('#customModal2').html(data);
				  });
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

 		function changeUnits(objId){
		
var category_id = $("select[name='data[document_group]']").val();
		 $('#customModal2').html('');
				  $('#customModalHeader2').html('เปลี่ยนหน่วยงาน');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Document/changeUnits/" + objId,function(data) {
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
		function unitKeyUp(obj,e) {

			//console.log(e.which);	
			//console.log(obj);
			//if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 8;
			//if($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength){
			if(($("#" + obj).val().length >= triggerMinLength && $("#" + obj).val().length <= triggerMaxLength) || e.which == 32){
				
				var obj_id = $("#" + obj).attr("id");
				//console.log(obj_id);
				var obj_value = $("#" + obj).val();
				var url = "/../../Units/getDataUnit";

				$.post(	url,{
						value:obj_value,
						field:'title'
						},
						function(data){

							var json = $.parseJSON(data);
							var autocomplete = $("#"+obj_id).typeahead();
							autocomplete.data('typeahead').source = json;

						}
						,"html"
				);

			}

		}
</script>