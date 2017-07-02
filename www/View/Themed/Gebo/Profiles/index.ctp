<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">
		
                                                            <?php
                                                                echo $this->Form->input('password', array(
                                                                    'label' => 'รหัสผ่าน :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'รหัสผ่าน'

                                                                ));
                                                            ?>

                                                            <?php
                                                                echo $this->Form->input('new_password', array(
                                                                    'label' => 'รหัสผ่านใหม่ :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
								    'type' => 'password',
                                                                    'placeholder' => 'รหัสผ่านใหม่'

                                                                ));
                                                            ?>


                                                            <?php
                                                                echo $this->Form->input('confirm_password', array(
                                                                    'label' => 'ยืนยัน รหัสผ่านใหม่ :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
								    'type' => 'password',
                                                                    'placeholder' => 'รหัสผ่านใหม่'

                                                                ));
                                                            ?>    

					</div>
                        </div>
				
		</div>
	</div>
</div>

<script>
		function modalAction2(){
			//alert('ddd');
			var username = 'admin';
                        var password = $("input[name='data[password]']").val();
			var new_password = $("input[name='data[new_password]']").val();
                        var confirm_password = $("input[name='data[confirm_password]']").val();
			//var username = '';
			//alert(password);
			//alert(new_password);
			//alert(confirm_password);

			if(password != "" && new_password != "" && confirm_password != "")
			  {

					if(new_password != confirm_password){ 
						alert('ยืนยัน รหัสผ่านใหม่ ไม่ถูกต้อง');
						return false;
					}

					var url = "../../Profiles/checkProfile/";
					$.post(url,{
						username:username,
						password:password,
					},function(data){
					    if(data.status == "SUCCESS"){
						url = "../../Profiles/changePassword/";
						$.post(url,{
							username:username,
							password:password,
							new_password:new_password,
						},function(data){
						    if(data.status == "SUCCESS"){
							alert('เปลี่ยน รหัสผ่าน เรียบร้อย');
							$('#myModal2').modal('hide');
						    }else{
							alert('เปลี่ยน รหัสผ่าน ล้มเหลว');
						    }
							
						}, "json");

						//alert('เปลี่ยน รหัสผ่าน เรียบร้อย');
					    }else{
						alert('รหัสผ่าน ไม่ถูกต้อง');
					    }
						
					}, "json"); 
					
					
			  } else { 
				alert('กรุณาใส่ข้อมูลให้ครบถ้วน');
			  }
				
		}

</script>