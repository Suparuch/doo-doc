<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('��� �����Ť��·���') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">
		
                                                            <?php
                                                                echo $this->Form->input('password', array(
                                                                    'label' => '���ʼ�ҹ :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => '���ʼ�ҹ'

                                                                ));
                                                            ?>

                                                            <?php
                                                                echo $this->Form->input('new_password', array(
                                                                    'label' => '���ʼ�ҹ���� :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
								    'type' => 'password',
                                                                    'placeholder' => '���ʼ�ҹ����'

                                                                ));
                                                            ?>


                                                            <?php
                                                                echo $this->Form->input('confirm_password', array(
                                                                    'label' => '�׹�ѹ ���ʼ�ҹ���� :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
								    'type' => 'password',
                                                                    'placeholder' => '���ʼ�ҹ����'

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
						alert('�׹�ѹ ���ʼ�ҹ���� ���١��ͧ');
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
							alert('����¹ ���ʼ�ҹ ���º����');
							$('#myModal2').modal('hide');
						    }else{
							alert('����¹ ���ʼ�ҹ �������');
						    }
							
						}, "json");

						//alert('����¹ ���ʼ�ҹ ���º����');
					    }else{
						alert('���ʼ�ҹ ���١��ͧ');
					    }
						
					}, "json"); 
					
					
			  } else { 
				alert('��س������������ú��ǹ');
			  }
				
		}

</script>