<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['short_name'] = empty($default['short_name']) ? '' : $default['short_name']; 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
        $default['organization_id'] = empty($default['organization_id']) ? '' : $default['organization_id']; 
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">

                                                            <input type="hidden" name="id" value="<?php echo$default['id']; ?>"/>
                                                            <?php
                                                                echo $this->Form->input('organization_id', array(
                                                                    'label' => 'รหัสหน่วยผู้ใช้ :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'รหัสย่อหน่วยผู้ใช้',
                                                                    'default' => $default['organization_id']

                                                                ));
                                                            ?>   
                                                            <?php
                                                                echo $this->Form->input('name', array(
                                                                    'label' => 'ชื่อหน่วยผู้ใช้ :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ชื่อหน่วยผู้ใช้',
                                                                    'default' => $default['name']

                                                                ));
                                                            ?>    
		
                                                            <?php
                                                                echo $this->Form->input('short_name', array(
                                                                    'label' => 'ชื่อย่อหน่วยผู้ใช้ :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ชื่อย่อหน่วยผู้ใช้',
                                                                    'default' => $default['short_name']

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
			var organization_id = $("input[name='data[organization_id]']").val();

			
				if(name != "" && shortname != "")
				  {         
					var url = "../../Units/save/"+id;
							$.post(url,{
							name:name,
							short_name:shortname,
							organization_id:organization_id,
		
						},function(data){
                                                        
                                                    if(data.status == "SUCCESS"){
                                                        $(".close").trigger( "click" );					
                                                        window.location="../../Units/index";                                            
                                                    }else{
                                                        alert("การสร้างข้อมูลล้มเหลว");
                                                    }
							
						}, "json"); 
						

						
				  }
				  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}
		}
</script>