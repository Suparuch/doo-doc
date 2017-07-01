<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['weapon_type_id'] = empty($default['weapon_type_id']) ? '' : $default['weapon_type_id']; 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
		$default['attribute'] = empty($default['attribute']) ? '' : $default['attribute'];
		$default['capacity'] = empty($default['capacity']) ? '' : $default['capacity'];
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข คุณลักษณะกระสุนและวัตถุระเบิด') ;?></h3>-->
			<div class="box-content nopadding">
				<?php echo $this->Form->create('WeaponBullets', array('action' => 'save','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table class="table table-bordered">
							<!--
						    <thead>
							<tr>
							    <th colspan=12><center>แก้ไข คุณลักษณะกระสุนและวัตถุระเบิด</center></th>
							</tr>
						    </thead>
							-->
						    <tbody>
							<tr>
							    <td width=100>ประเภทอาวุธ </td>
							    <td>
									<input type="hidden" name="data[WeaponBullets][id]" value="<?php echo $default['id']; ?>"/>
									<?php
										echo $this->Form->input('weapon_type_id', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'options' => $WeaponTypes,
											'placeholder' => 'ประเภทอาวุธ',
											'default' => $default['weapon_type_id']

										));
									?>
							    </td>
							</tr>
							<tr>
							    <td>ชนิดอาวุธ </td>
							    <td>									
									<?php
										echo $this->Form->input('name', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ชนิดอาวุธ',
											'default' => $default['name'],
                                                                                        'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

										));
									?>
							    </td>
							</tr>
							<tr>
							    <td>คุณลักษณะ </td>
							    <td>
									<?php
										echo $this->Form->input('attribute', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'คุณลักษณะ',
											'default' => $default['attribute'],
                                                                                        'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
										));
									?>    
							    </td>
							</tr>
							<tr>
							    <td>ขีดความสามารถ</td>
							    <td>
									<?php
										echo $this->Form->input('capacity', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ขีดความสามารถ',
											'default' => $default['capacity'],
                                                                                        'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

										));
									?>    
							    </td>
							</tr>

						    </tbody>
						</table>	

					</div>
					
				<?php  echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<script>
		function modalAction2(){
			
			var id = $("input[name='data[WeaponBullets][id]']").val();			
			var weapon_type_id = $("select[name='data[WeaponBullets][weapon_type_id]']").val();
			var name = $("input[name='data[WeaponBullets][name]']").val();
			var attribute = $("input[name='data[WeaponBullets][attribute]']").val();
			var capacity = $("input[name='data[WeaponBullets][capacity]']").val();
			
			if(weapon_type_id != "" && name != "")
			{         
					var url = "../../WeaponBullets/save/"+id;
					$.post(url,{
						weapon_type_id:weapon_type_id,
						name:name,
						attribute:attribute,
						capacity:capacity
	
					},function(data){
		
						if(data.status == "SUCCESS"){
							$(".close").trigger( "click" );					
							window.location="../../WeaponBullets/index";                                            
						}else{
							alert("การสร้างข้อมูลล้มเหลว");
						}
						
					}, "json"); 					
					
			  }
			  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}

		}
</script>