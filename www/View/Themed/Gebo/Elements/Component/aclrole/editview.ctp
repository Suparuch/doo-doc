<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">
			
			<?php echo $this->Form->create('AclRole', array('action' => 'save'));?>
			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">

							<input type="hidden" name="data[id]" value="<?php echo$default['id']; ?>"/>
							<?php
								echo $this->Form->input('name', array(
									'label' => 'ชื่อสิทธิ์ผู้ใช้งาน :',
									'div' => true,
									'class' => 'span6',
									'placeholder' => 'ชื่อสิทธิ์ผู้ใช้งาน',
									'default' => $default['name'],
                                                                        'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

								));
							?>

					</div>
					<?php
					if(!empty($default['id'])){
					$permission = array('No','Yes');

					?>
					<table class="table table-bordered" width=100%>
<tr>
<td colspan='7'>
ระบบงานสารบรรณ
</td>
</tr>

						<tr>
							<th align='left'>ระบบ</th>
							<th width=70><center><input type='checkbox' onclick='checkit(this)' class='access' /> เข้าถึง</center></th>
							<th width=70><center><input type='checkbox' onclick='checkit(this)' class='list' />ค้นหา</center></th>
							<th width=70><center><input type='checkbox' onclick='checkit(this)' class='add' />เพิ่ม</center></th>
							<th width=70><center><input type='checkbox' onclick='checkit(this)' class='detail' />รายละเอียด</center></th>
							<th width=70><center><input type='checkbox' onclick='checkit(this)' class='edit' />แก้ไข</center></th>
							<th width=70><center><input type='checkbox' onclick='checkit(this)' class='delete' />ลบ</center></th>
						</tr>
						<?php
						$i_module = 1;
						
						foreach($AclActions as $key => $AclRole){
						$acl = $AclRole;
						
						?>
						<tr>
							<td><?php echo $acl ;?>
							<?php echo $this->Form->hidden('AclRoleAction.'.$key.'.id', array('hiddenField' => false,'class'=>'id','default' => $key));?>
							</td>
							<td><center><?php echo $this->Form->checkbox('AclRoleAction.'.$key.'.access', array('hiddenField' => false,'class'=>'access'));?></center></td>
							<td><center><?php echo $this->Form->checkbox('AclRoleAction.'.$key.'.list', array('hiddenField' => false,'class'=>'list'));?></center></td>
							<td><center><?php echo $this->Form->checkbox('AclRoleAction.'.$key.'.add', array('hiddenField' => false,'class'=>'add'));?></center></td>
							<td><center><?php echo $this->Form->checkbox('AclRoleAction.'.$key.'.detail', array('hiddenField' => false,'class'=>'detail'));?></center></td>
							<td><center><?php echo $this->Form->checkbox('AclRoleAction.'.$key.'.edit', array('hiddenField' => false,'class'=>'edit'));?></center></td>
							<td><center><?php echo $this->Form->checkbox('AclRoleAction.'.$key.'.delete', array('hiddenField' => false,'class'=>'delete'));?></center></td>
						</tr>
						<?php
						$i_module++;
						} 
						?>

					</table>
					<?php				
					}
					?>
					
			</div>
			<?php  echo $this->Form->end();?>

		</div>
	</div>
</div>

<script>
		<?php
		if(isset($AclRoleActions) && count($AclRoleActions)>0){
		foreach($AclRoleActions as $key=> $AclRoleAction)
		{

			foreach($AclRoleAction as $k =>$v){
		
			if($v['access']=="1")
				echo "$(\"input[name='data[AclRoleAction][" . $v['action_id'] . "][access]']\").attr('checked','checked');";
			if($v['list']=="1")
				echo "$(\"input[name='data[AclRoleAction][" . $v['action_id'] . "][list]']\").attr('checked','checked');";
			if($v['detail']=="1")
				echo "$(\"input[name='data[AclRoleAction][" . $v['action_id'] . "][detail]']\").attr('checked','checked');";
			if($v['add']=="1")
				echo "$(\"input[name='data[AclRoleAction][" . $v['action_id'] . "][add]']\").attr('checked','checked');";
			if($v['edit']=="1")
				echo "$(\"input[name='data[AclRoleAction][" . $v['action_id'] . "][edit]']\").attr('checked','checked');";
			if($v['delete']=="1")
				echo "$(\"input[name='data[AclRoleAction][" . $v['action_id'] . "][delete]']\").attr('checked','checked');";
			?>
			
			<?php
			//	echo $v['id'];
			}
		?>
		
		<?php
		}
		}
		?>
		function modalAction2(){
			
			var formAction = 'AclRoleSaveForm';
			var id = $("input[name='data[id]']").val();
			var name = $("input[name='data[AclRole][name]']").val();
			
				if(name != "")
				  {         
						var url = "../../AclRoles/save/"+id;
						$.post(url,
							//name:name
							$('#'+formAction).serialize(),
		
						function(data){
                                                        
							if(data.status == "SUCCESS"){
								$('#myModal2').modal('hide');					
								window.location="../../AclRoles";                                            
							}else{
								alert("การสร้างข้อมูลล้มเหลว");
							}
							
						}, "json"); 
						

						
				  }
				  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}
		}
		function checkit(obj)
		{
			if($(obj).is(':checked'))
				$("." + $(obj).attr("class")).prop('checked', true);
			else
				$("." + $(obj).attr("class")).prop('checked', false);
		}
</script>