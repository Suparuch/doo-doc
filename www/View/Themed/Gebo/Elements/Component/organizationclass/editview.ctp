<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
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
                                                                    'label' => 'ชื่อขนาดหน่วย :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ชื่อขนาดหน่วย',
                                                                    'default' => $default['name'],
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

			
				if(name != "")
				  {         
					var url = "../../OrganizationClass/save/"+id;
							$.post(url,{
							name:name
		
						},function(data){
                                                        
                                                    if(data.status == "SUCCESS"){
                                                        $('#myModal2').modal('hide');					
                                                        window.location="../../OrganizationClass";                                            
                                                    }else{
                                                        alert("การสร้างข้อมูลล้มเหลว");
                                                    }
							
						}, "json"); 
						

						
				  }
				  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}
		}
</script>