<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id'];
		$default['organization_id'] = empty($default['organization_id']) ? '' : $default['organization_id'];
        $default['organization_code'] = empty($default['organization_code']) ? '' : $default['organization_code']; 
        $default['organization_name'] = empty($default['organization_name']) ? '' : $default['organization_name'];
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลยุทโธปกรณ์') ;?></h3>-->
			<div class="box-content nopadding">
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
							    <td width=100>รหัสหน่วย </td>
							    <td>									
									<?php echo $default['organization_id'];?>
							    </td>
							</tr>
							<tr>
							    <td>รหัสหน่วย </td>
							    <td>
									<?php echo $default['organization_code'];?>
							    </td>
							</tr>
							<tr>
							    <td>นามหน่วยย่อ </td>
							    <td>
									<?php echo $default['organization_name'];?>
							    </td>
							</tr>							
						    </tbody>
						</table>				

					</div>
					
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลยุทโธปกรณ์') ;?></h3>-->
			<div class="box-content nopadding">
				<?php echo $this->Form->create('EmployeePosition', array('action' => 'save','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">

						<table class="table table-bordered">
							
						    <thead>
							<tr>
							    <th colspan=5><center>ตำแหน่งพนักงานราชการในหน่วย</center></th>
							</tr>
						    </thead>
						    <thead>
							<tr>
								<th width=5><input type="checkbox" onclick="toggleEmployeePosition(this);"></th>
							    <th><center>ชื่อกลุ่มงาน</center></th>
								<th><center>ชื่อตำแหน่ง</center></th>
								<th><center>จำนวน</center></th>
								<th width=40></th>
							</tr>
						    </thead>
							
						    <tbody>
							<?php foreach($EmployeeRates as $EmployeeRate){?>
							<tr>
							    <td><input type="checkbox" name="EmployeePositionID[]" value="<?php echo $EmployeeRate['EmployeeRate']['id']; ?>"></td>
							    <td>									
									<?php echo $EmployeeRate['EmployeeRate']['employee_position_id'];?>
							    </td>
							    <td>
									<?php echo $EmployeeRate['EmployeeRate']['employee_position_id'];?>
							    </td>
							    <td>
									<?php echo $EmployeeRate['EmployeeRate']['number_employee'];?>
							    </td>
								<td style="text-align: center;">								
									<a data-toggle="modal" data-backdrop="static" href="#myModal2" onclick="editEmployeePosition('<?php echo $EmployeeRate['EmployeeRate']['id']; ?>');" ><i class="icon-pencil"></i></a>
									<a href="#" class="delete" value="<?php echo (string)$EmployeeRate['EmployeeRate']['id']; ?>"><i class="icon-trash"></i></a>
								</td>
							<?php }?>

							</tr>							
						    </tbody>
						</table>
						<button data-toggle="dropdown" class="btn btn-danger">ดำเนินการ</button>

					</div>
					
				<?php  echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<script>
		function modalAction2(){
			$(".close").trigger( "click" );
		}
</script>