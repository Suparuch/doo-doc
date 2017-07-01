<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['short_name'] = empty($default['short_name']) ? '' : $default['short_name']; 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
		$default['description'] = empty($default['description']) ? '' : $default['description']; 
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">

                                                            <input type="hidden" name="id" value="<?php echo$default['id']; ?>"/>
                                                            <?php
                                                                echo $this->Form->input('name', array(
                                                                    'label' => 'รหัสหมวดหมู่เอกสาร :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'รหัสหมวดหมู่เอกสาร',
                                                                    'default' => $default['name']

                                                                ));
                                                            ?>    
		
                                                            <?php
                                                                echo $this->Form->input('short_name', array(
                                                                    'label' => 'ชื่อหมวดหมู่ (ภาษาไทย) :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ชื่อหมวดหมู่ (ภาษาไทย)',
                                                                    'default' => $default['short_name']

                                                                ));
                                                            ?>   
															<?php
                                                                echo $this->Form->input('short_name', array(
                                                                    'label' => 'ชื่อหมวดหมู่ (ภาษาอังกฤษ) :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ชื่อหมวดหมู่ (ภาษาอังกฤษ)',
                                                                    'default' => $default['short_name']

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
			var name = $("input[name='data[name]']").val();
                        var shortname = $("input[name='data[short_name]']").val();

			
				if(name != "" && shortname != "")
				  {         
					var url = "../../Ranks/save/"+id;
							$.post(url,{
							name:name,
							short_name:shortname,
		
						},function(data){
                                                        
                                                    if(data.status == "SUCCESS"){
                                                        $(".close").trigger( "click" );					
                                                        window.location="../../Ranks/index";                                            
                                                    }else{
                                                        alert("การสร้างข้อมูลล้มเหลว");
                                                    }
							
						}, "json"); 
						

						
				  }
				  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}
		}
</script>