<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id'];
		$default['organization_id'] = empty($default['organization_id']) ? '' : $default['organization_id'];
        $default['organization_code'] = empty($default['organization_code']) ? '' : $default['organization_code']; 
        $default['organization_name'] = empty($default['organization_name']) ? '' : $default['organization_name'];
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลหน่วยบรรจุอัตราพนักงานราชการ') ;?></h3>-->
			<div class="box-content nopadding">
				<?php echo $this->Form->create('EmployeeOrganization', array('action' => 'save','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table class="table table-bordered">
							<!--
						    <thead>
							<tr>
							    <th colspan=12><center>แก้ไข ข้อมูลหน่วยบรรจุอัตราพนักงานราชการ</center></th>
							</tr>
						    </thead>
							-->
						    <tbody>
							<tr>
							    <td>รหัสหน่วย </td>
							    <td>
									<input type="hidden" name="data[EmployeeOrganization][id]" value="<?php echo $default['id']; ?>"/>
									<?php
										echo $this->Form->input('organization_id', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',
											'options' => array(),
											'placeholder' => 'รหัสหน่วย',
											'default' => $default['organization_id']

										));
									?>
							    </td>
							</tr>
							<tr>
							    <td>รหัสหน่วย </td>
							    <td>
									<input type="hidden" name="data[EmployeeOrganization][id]" value="<?php echo $default['id']; ?>"/>
									<?php
										echo $this->Form->input('organization_code', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',
											'placeholder' => 'รหัสหน่วย',
											'default' => $default['organization_code'],
                                                                                        'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

										));
									?>
							    </td>
							</tr>
							<tr>
							    <td>นามหน่วยย่อ </td>
							    <td>
									<?php
										echo $this->Form->input('organization_name', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',
											'placeholder' => 'นามหน่วยย่อ',
											'default' => $default['organization_name'],
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
			
			var id = $("input[name='data[EmployeeOrganization][id]']").val();
			var organization_id = $("select[name='data[EmployeeOrganization][organization_id]']").val();
			var organization_code = $("input[name='data[EmployeeOrganization][organization_code]']").val();
			var organization_name = $("input[name='data[EmployeeOrganization][organization_name]']").val();

			if(organization_code != "" && organization_name != "")
			{         
					var url = "../../EmployeeOrganizations/save/"+id;
					$.post(url,{
						organization_id:organization_id,
						organization_code:organization_code,
						organization_name:organization_name,	
					},function(data){
		
						if(data.status == "SUCCESS"){
							$(".close").trigger( "click" );					
							window.location="../../EmployeeOrganizations/index";                                            
						}else{
							alert("การสร้างข้อมูลล้มเหลว");
						}
						
					}, "json"); 
					

					
			  }
			  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}

		}
</script>