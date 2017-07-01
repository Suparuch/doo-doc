<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">

						<input type="hidden" name="data[id]" value="<?php echo empty($default['id'])? '':$default['id'];; ?>"/>
                        <?php
							echo $this->Form->input('rank_id', array(
								'label' => 'ยศ :',
								//'div' => true,
								'class' => 'span6',
								//'options' => array( 0 => 'ผู้ดูแลระบบ' , 1 => 'ผู้ดูแลระบบ2' , 3 => 'ผู้ดูแลระบบ3'),
								'options' => $Ranks,
								'empty' => ' - - - กรุณาเลือกยศ - - - ',
								'default' => empty($default['rank_id'])? '':$default['rank_id']

							));
						?> 	
						<?php
							echo $this->Form->input('username', array(
								'label' => 'ชื่อผู้ใช้งานในระบบ :',
								'div' => true,
								'class' => 'span6',
								'placeholder' => 'ชื่อผู้ใช้งาน',
								'default' => empty($default['username'])? '':$default['username']
							));
						?>    

						<?php
							echo $this->Form->input('password', array(
								'label' => 'รหัสผ่าน :',
								'div' => true,
								'class' => 'span6',
								'placeholder' => 'รหัสผ่าน',
								'default' => $default['password']
                                                               

							));
						?>    
						<?php
							echo $this->Form->input('name', array(
								'label' => 'ชื่อ :',
								'div' => true,
								'class' => 'span6',
								'placeholder' => 'ชื่อ',
								'default' => empty($default['name'])? '':$default['name']

							));
						?>  		
						<?php
							echo $this->Form->input('surname', array(
								'label' => 'นามสกุล :',
								'div' => true,
								'class' => 'span6',
								'placeholder' => 'นามสกุล',
								'default' => empty($default['surname'])? '':$default['surname'],
                                                                'onkeypress' => 'return keyTextThai(event)'
							));
						?>  
						<?php
							echo $this->Form->input('role_id', array(
								'label' => 'สิทธิ์ :',
								//'div' => true,
								'class' => 'span6',
								//'options' => array( 0 => 'ผู้ดูแลระบบ' , 1 => 'ผู้ดูแลระบบ2' , 3 => 'ผู้ดูแลระบบ3'),
								'options' => $AclRoles,
								'empty' => ' - - - กรุณาเลือกสิทธิ์ - - - ',
								'default' => empty($default['role_id'])? '':$default['role_id']

							));
						?> 		
						<?php
							echo $this->Form->input('unit_id', array(
								'label' => 'หน่วยงาน :',
								//'div' => true,
								'class' => 'span6',
								//'options' => array( 0 => 'ผู้ดูแลระบบ' , 1 => 'ผู้ดูแลระบบ2' , 3 => 'ผู้ดูแลระบบ3'),
								'options' => $Units,
								'empty' => ' - - - กรุณาเลือกหน่วยงาน - - - ',
								'default' => empty($default['unit_id'])? '':$default['unit_id']

							));
						?> 		
                        <?php
							echo $this->Form->input('doc_level', array(
								'label' => 'ระดับการใช้งาน :',
								//'div' => true,
								'class' => 'span6',
								'options' => array( 'U' => 'จัดการผู้ใช้งาน' , 'R' => 'กรอกเอกสารเข้า' , 'S' => 'เจ้าหน้าที่รับเอกสาร','D'=>'ผู้อำนวยการ','A'=>'ผู้รับมอบหมาย','O'=>'เอกสารออก','V'=>'Viewer','C'=>'ผอ.สำนัก/จก.ยก.','X'=>'รับ-ส่งกรม'),
								//'options' => $Units,
								'empty' => ' - - - กรุณาเลือกระดับ - - - ',
								'default' => empty($default['doc_level'])? '':$default['doc_level']

							));
						?> 

 <?php
							echo $this->Form->input('doc_secrete', array(
								'label' => 'ชั้นความลับ :',
								//'div' => true,
								'class' => 'span6',
								'options' => array( 'N' => 'ปกติ' , 'S' => 'ลับ' , 'SV' => 'ลับมาก','HS'=>'ลับที่สุด'),
								//'options' => $Units,
								'empty' => ' - - - กรุณาเลือกระดับ - - - ',
								'default' => empty($default['doc_secrete'])? '':$default['doc_secrete']

							));
						?> 							


					</div>
			</div>
				
		</div>
	</div>
</div>

<script>
		function modalAction2(){
			
			var id = $("input[name='data[id]']").val();
			var username = $("input[name='data[username]']").val();
			var password = $("input[name='data[password]']").val();
			var name = $("input[name='data[name]']").val();
			var surname = $("input[name='data[surname]']").val();
			var role_id = $("select[name='data[role_id]']").val();
			var unit_id = $("select[name='data[unit_id]']").val();
			var rank_id = $("select[name='data[rank_id]']").val();
			var doc_level = $("select[name='data[doc_level]']").val();
			var doc_secrete = $("select[name='data[doc_secrete]']").val();
				if(username != "" && password != "" && name != "" && surname != "" && role_id != "" && unit_id != "")
				  {         
					var url = "../../Users/save/"+id;
							$.post(url,{
							username:username,
							password:password,
							name:name,
							surname:surname,
							role_id:role_id,
							unit_id:unit_id,
							rank_id:rank_id,
							doc_level:doc_level,
							doc_secrete:doc_secrete

						},function(data){
                                                        
							if(data.status == "SUCCESS"){
								$(".close").trigger( "click" );					
								window.location="../../Users/index";                                            
							}else{
								alert("การสร้างข้อมูลล้มเหลว");
							}
							
						}, "json"); 
						

						
				  }
				  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}
		}
</script>
