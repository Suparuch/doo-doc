<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['weapon_type_id'] = empty($default['weapon_type_id']) ? '' : $default['weapon_type_id']; 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
		$default['number_shot'] = empty($default['number_shot']) ? '' : $default['number_shot'];
		$default['description'] = empty($default['description']) ? '' : $default['description'];
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลอัตรามูลฐานกระสุนและวัตถุระเบิด') ;?></h3>-->
			<div class="box-content nopadding">
				<?php echo $this->Form->create('Weapons', array('action' => 'save','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table class="table table-bordered">
							<!--
						    <thead>
							<tr>
							    <th colspan=12><center>แก้ไข ข้อมูลอัตรามูลฐานกระสุนและวัตถุระเบิด</center></th>
							</tr>
						    </thead>
							-->
						    <tbody>
							<tr>
							    <td width=100>ประเภทอาวุธ </td>
							    <td>
									<input type="hidden" name="data[Weapons][id]" value="<?php echo $default['id']; ?>"/>
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
							    <td>จำนวนนัด </td>
							    <td>
									<?php
										echo $this->Form->input('number_shot', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'จำนวนนัด',
											'default' => $default['number_shot'],
											'onkeypress' => 'return keyNumberEng(event)'
										));
									?>    
							    </td>
							</tr>
							<tr>
							    <td>หมายเหตุ</td>
							    <td>
									<?php
										echo $this->Form->input('description', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'หมายเหตุ',
											'default' => $default['description'],
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

<?php if(!empty($default)){?>
<button class="btn btn-danger" onclick='addBulletType();'>เพิ่มชนิดกระสุน</button>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข คุณลักษณะกระสุนและวัตถุระเบิด') ;?></h3>-->
			<div class="box-content nopadding">
				<?php echo $this->Form->create('BulletTypes', array('action' => 'saveBulletType','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table class="table table-bordered" id="BulletTypeTable">
						    <thead>
							<tr>
							    <th><center>ลำดับ</center></th>
								<th><center>ประเภทที่</center></th>
								<th><center>ชนิดกระสุน</center></th>
								<th><center>จำนวนนัด</center></th>
								<th><center>หมายเหตุ</center></th>
								<th></th>
							</tr>
						    </thead>
						    <tbody>
							<?php 
								$seq = 0;
								foreach($BulletTypes as $BulletType){
								$seq++;
							?>
							<tr>
							    <td width=10><center><?php echo $seq;?></center></td>
								<td>
									<?php
										echo $this->Form->input('bullet_type', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ประเภทที่',
											'default' => $BulletType['BulletType']['bullet_type'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
										));
									?> 
								</td>
								<td>
									<?php
										echo $this->Form->input('name', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ชนิดกระสุน',
											'default' => $BulletType['BulletType']['name'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
										));
									?>  
								</td> 
								<td>
									<?php
										echo $this->Form->input('capacity', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'จำนวนนัด',
											'default' => $BulletType['BulletType']['capacity'],
											'onkeypress' => 'return keyNumberEng(event)'
										));
									?>  									
								</td> 
								<td>
									<?php
										echo $this->Form->input('description', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'หมายเหตุ',
											'default' => $BulletType['BulletType']['description'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
										));
									?>  
								</td> 
								<td width=5>
									<a href="#" class="delete" value="<?php echo $BulletType['BulletType']['id'];?>"><i class="icon-trash"></i></a>
								</td>
							</tr>
							<?php }?>
						    </tbody>
						</table>	

					</div>
					
				<?php  echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<?}?>

<?php if(!empty($default)){?>
<button class="btn btn-danger" onclick='addWeaponRelations();'>เพิ่มอาวุธประกอบ</button>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข คุณลักษณะกระสุนและวัตถุระเบิด') ;?></h3>-->
			<div class="box-content nopadding">
				<?php echo $this->Form->create('WeaponRelations', array('action' => 'saveWeaponRelation','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table class="table table-bordered" id="WeaponRelationTable">
						    <thead>
							<tr>
							    <th><center>ลำดับ</center></th>
								<th><center>ชนิดอาวุธ</center></th>
								<th><center>จำนวนนัด</center></th>
								<th><center>ชนิดกระสุน</center></th>
								<th><center>จำนวนนัด</center></th>
								<th><center>หมายเหตุ</center></th>
								<th></th>
							</tr>
						    </thead>
						    <tbody>
							<?php 
								$seq = 0;
								foreach($WeaponRelations as $WeaponRelation){
								$seq++;
							?>
							<tr>
							    <td width=10><center><?php echo $seq;?></center></td>
								<td>
									<?php
										echo $this->Form->input('bullet_type', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ชนิดอาวุธ',
											'default' => $WeaponRelation['WeaponRelation']['name'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
										));
									?> 
								</td>
								<td>
									<?php
										echo $this->Form->input('bullet_type', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'จำนวนนัด',
											'default' => $WeaponRelation['WeaponRelation']['name'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
										));
									?> 
								</td>
								<td>
									<?php
										echo $this->Form->input('name', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'ชนิดกระสุน',
											'default' => $WeaponRelation['WeaponRelation']['name'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
										));
									?>  
								</td> 
								<td>
									<?php
										echo $this->Form->input('capacity', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'จำนวนนัด',
											'default' => $WeaponRelation['WeaponRelation']['capacity'],
											'onkeypress' => 'return keyNumberEng(event)'
										));
									?>  									
								</td> 
								<td>
									<?php
										echo $this->Form->input('description', array(
											'label' => false,
											'div' => false,
											'class' => 'span12',
											'placeholder' => 'หมายเหตุ',
											'default' => $WeaponRelation['WeaponRelation']['description'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
										));
									?>  
								</td> 
								<td width=5>
									<a href="#" class="delete" value="<?php echo $WeaponRelation['WeaponRelation']['id'];?>"><i class="icon-trash"></i></a>
								</td>
							</tr>
							<?php }?>
						    </tbody>
						</table>	

					</div>
					
				<?php  echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<?}?>


<script>
		function modalAction2(){
			
			var id = $("input[name='data[Weapons][id]']").val();			
			var weapon_type_id = $("select[name='data[Weapons][weapon_type_id]']").val();
			var name = $("input[name='data[Weapons][name]']").val();
			var number_shot = $("input[name='data[Weapons][number_shot]']").val();
			var description = $("input[name='data[Weapons][description]']").val();
			
			if(weapon_type_id != "" && name != "")
			{         
					var url = "../../Weapons/save/"+id;
					$.post(url,{
						weapon_type_id:weapon_type_id,
						name:name,
						number_shot:number_shot,
						description:description
	
					},function(data){
		
						if(data.status == "SUCCESS"){
							$(".close").trigger( "click" );					
							window.location="../../Weapons/index";                                            
						}else{
							alert("การสร้างข้อมูลล้มเหลว");
						}
						
					}, "json"); 					
					
			  }
			  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}

		}

		function addBulletType(){
			var weapon_id = $("input[name='data[Weapons][id]']").val();
			 
			var url = "../../BulletTypes/append";
							
			$.post(url,{
				weapon_id:weapon_id
			},function(data){
				$(data).insertAfter("#BulletTypeTable tr:last");
				//$('#'+short_model+'_current_no').val(index);
			},"html");

		}

		function addWeaponRelations(){
			var weapon_id = $("input[name='data[Weapons][id]']").val();
 
			var url = "../../WeaponRelations/append";
							
			$.post(url,{
				weapon_id:weapon_id,
			},function(data){
				$(data).insertAfter("#WeaponRelationTable tr:last");
				//$('#'+short_model+'_current_no').val(index);
			},"html");

		}
</script>
