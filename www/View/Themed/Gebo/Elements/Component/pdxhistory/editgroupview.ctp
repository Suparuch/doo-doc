<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['short_name'] = empty($default['short_name']) ? '' : $default['short_name']; 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
		$default['description'] = empty($default['description']) ? '' : $default['description']; 
	//	$corp_id = empty($_GET['id']) ? '' : $_GET['id']; 
	$id =  $default['id'];
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">
<input type="hidden" name="data[corp_id]" id='data[corp_id]' value="<?php echo $corp_id; ?>"/>
                                                            <input type="hidden" name="data[id]" value="<?php echo $default['id']; ?>"/>
                                                            <?php
                                                                echo $this->Form->input('code', array(
                                                                    'label' => 'รหัสหมวดหมู่หนังสือ รับ - ส่ง :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'รหัสหมวดหมู่หนังสือ รับ - ส่ง',
                                                                    'default' => $default['code']

                                                                ));
                                                            ?>    
		
                                                            <?php
                                                                echo $this->Form->input('name_th', array(
                                                                    'label' => 'ชื่อหมวดหมู่หนังสือ รับ - ส่ง (ภาษาไทย) :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ชื่อหมวดหมู่หนังสือ รับ - ส่ง (ภาษาไทย)',
                                                                    'default' => $default['name_th']

                                                                ));
                                                            ?>   
															<div style='display:none'>
															<?php
                                                                echo $this->Form->input('name_en', array(
                                                                    'label' => 'ชื่อหมวดหมู่หนังสือ รับ - ส่ง (ภาษาอังกฤษ) :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ชื่อหมวดหมู่หนังสือ รับ - ส่ง (ภาษาอังกฤษ)',
                                                                    'default' => $default['name_en']

                                                                ));
                                                            ?> 
															</div>
															<?php
																echo $this->Form->input('description', array(
																'type' => 'textarea',
																	'label' => 'คำอธิบาย',
																	'div' => true,
																	'class' => 'span8',
																	'placeholder' => 'คำอธิบาย',
																	'default' => $default['description'],
																												'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
																));
															?> 
		

						


					</div>
					
                        </div>	
		</div>
	</div>
</div>

<script>
		function modalAction2(){
			
                        var id = $("input[name='id']").val();
						var corp_id = $("input[name='data[corp_id]']").val();
			var code = $("input[name='data[code]']").val();
			var name_en = $("input[name='data[name_en]']").val();
			var name_th = $("input[name='data[name_th]']").val();
			var description = $("textarea[name='data[description]']").val();
				if(code != "")
				  {         
					var url = "../../EDocument/savegroup/<?php echo $corp_id?><?php 
					if(!empty($id))
						echo "/" . $id;
					 ?>";
							$.post(url,{
							code:code,
							name_en:name_en,
							name_th:name_th,
							description:description,
							corp_id:corp_id
		
						},function(data){
                                                        
                                                    if(data.status == "SUCCESS"){
                                                        $(".close").trigger( "click" );					
                                                        window.location="../../EDocument/index/<?php echo $corp_id?>"  ;                                            
                                                    }else{
                                                        alert("การสร้างข้อมูลล้มเหลว");
                                                    }
							
						}, "json"); 
						

						
				  }
				  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}
		}
</script>