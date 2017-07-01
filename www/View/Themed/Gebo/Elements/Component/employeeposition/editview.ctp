<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id'];		
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
        $default['position_group_id'] = empty($default['position_group_id']) ? '' : $default['position_group_id'];
		$default['description'] = empty($default['description']) ? '' : $default['description'];		
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลยุทโธปกรณ์') ;?></h3>-->
			<div class="box-content nopadding">
				<?php echo $this->Form->create('EmployeePosition', array('action' => 'save','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table class="table table-bordered">
							<!--
						    <thead>
							<tr>
							    <th colspan=12><center>แก้ไข ข้อมูลยุทโธปกรณ์</center></th>
							</tr>
						    </thead>
							-->
						    <tbody>
							<tr>
							    <td>ชื่อตำแหน่ง </td>
							    <td>
									<input type="hidden" name="data[EmployeePosition][id]" value="<?php echo $default['id']; ?>"/>
									<?php
										echo $this->Form->input('name', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',										
											'placeholder' => 'ชื่อตำแหน่ง',
											'default' => $default['name'],
                                                                                        'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

										));
									?>
							    </td>
							</tr>
							<tr>
							    <td>กลุ่มงาน </td>
							    <td>
									<input type="hidden" name="data[EmployeePosition][id]" value="<?php echo $default['id']; ?>"/>
									<?php
										echo $this->Form->input('position_group_id', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',
											'options' => $PositionGroups,
											'placeholder' => 'กลุ่มงาน',
											'default' => $default['position_group_id'],

										));
									?>
							    </td>
							</tr>
							<tr>
							    <td>หน้าที่โดยย่อ </td>
							    <td>
									<?php
										echo $this->Form->input('description', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',
											'placeholder' => 'หน้าที่โดยย่อ',
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
<script>
		function modalAction2(){
			
			var id = $("input[name='data[EmployeePosition][id]']").val();
			var name = $("input[name='data[EmployeePosition][name]']").val();
			var position_group_id = $("select[name='data[EmployeePosition][position_group_id]']").val();
			var description = $("textarea[name='data[EmployeePosition][description]']").val();

			if(name != "" && position_group_id != "")
			{         
					var url = "../../EmployeePositions/save/"+id;
					$.post(url,{
						name:name,
						position_group_id:position_group_id,
						description:description,	
					},function(data){
		
						if(data.status == "SUCCESS"){
							$(".close").trigger( "click" );					
							window.location="../../EmployeePositions/index";                                            
						}else{
							alert("การสร้างข้อมูลล้มเหลว");
						}
						
					}, "json"); 
					

					
			  }
			  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}

		}
</script>