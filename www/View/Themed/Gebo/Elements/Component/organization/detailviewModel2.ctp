<input type="hidden" name="data[OrganizationNew][model_id]" value="<?php echo $Organizations['OrganizationNew']['model_id'];?>"/>
<table class="table table-bordered">
	<tbody>
	<tr>
		<td colspan=2><center><b><?php echo __('อัตรากำลังพล / อาวุธและยุทโธปกรณ์');?></b></center></td>
	</tr>
	<tr>
		<td width="200"><b><?php echo __('อัตราอนุมัติกำลังพล:');?></b></td>
		<td>
		<a data-toggle="modal" data-backdrop="static" href="#myModal2" class="ttip_b" oldtitle="ดูรายละเอียด" onclick='viewRateProperty("<?php echo $Organizations['OrganizationNew']['model_id'];?>")'><i class="splashy-zoom_in"></i></a> ดูข้อมูล |
		 <a data-toggle="modal" data-backdrop="static" href="#myModal2" class="ttip_b" oldtitle="แก้ไขข้อมูล" onclick='changeRateProperty("<?php echo $Organizations['OrganizationNew']['id'];?>",<?php echo $organization_type;?>)'><i class="icon-pencil"></i></a>
		<span id='RateProperty_<?php echo $organization_type;?>'><?php echo empty($Organizations['OrganizationNew']['rate_property'])? '':$ModelLevels[$Organizations['OrganizationNew']['rate_property']]?></span> ใช้อัตรา | 
		
		
		<a data-toggle="modal" data-backdrop="static" href="#myModal3" class="ttip_b" oldtitle="แก้ไขข้อมูล" onclick='changeRateProperty2("<?php echo $Organizations['OrganizationNew']['model_id'];?>",<?php echo $organization_type;?>)'>
		
		<i class="icon-pencil"></i></a> <span id='RateProperty_<?php echo $organization_type;?>'><?php echo empty($Organizations['Organization']['rate_property'])? '':$ModelLevels[$Organizations['Organization']['rate_property']]?></span> แก้ไขอัตรา 
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('อัตราอนุมัติอาวุธและยุทโธปกรณ์ :');?></b></td>
		<td>
		<a data-toggle="modal" data-backdrop="static" href="#myModal3" class="ttip_b" oldtitle="ดูรายละเอียด" onclick='viewRateEquipment("<?php echo $Organizations['OrganizationNew']['model_id'];?>")'><i class="splashy-zoom_in"></i></a> ดูข้อมูล |
		<span id='RateEquipment_<?php echo $organization_type;?>'><?php echo empty($Organizations['OrganizationNew']['rate_equipment'])? '':$ModelLevels[$Organizations['OrganizationNew']['rate_equipment']]?></span>
		<a data-toggle="modal" data-backdrop="static" href="#myModal2" class="ttip_b" oldtitle="แก้ไขข้อมูล" onclick='changeRateEquipment("<?php echo $Organizations['OrganizationNew']['id'];?>",<?php echo $organization_type;?>)'><i class="icon-pencil"></i></a> ใช้อัตรา
		</td>
	</tr>
	<tr>
		<td colspan=2><center><b><?php echo __('กำลังพล / อาวุธและยุทโธปกรณ์ ที่บรรจุจริง');?></b></center></td>
	</tr>
	<tr>
		<td><b><?php echo __('กำลังพลในหน่วย (กพ.ทบ.) ');?></b></td>
		<td>
			<a data-toggle="modal" data-backdrop="static" href="#myModal2" class="ttip_b" oldtitle="ดูรายละเอียด" onclick='viewAssignProperty(<?php echo $Organizations['OrganizationNew']['id'];?>)'><i class="splashy-zoom_in"></i></a>
			0/305
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('อัตราอนุมัติอาวุธและยุทโธปกรณ์ (กบ.ทบ.): ');?></b></td>
		<td>
			<a data-toggle="modal" data-backdrop="static" href="#myModal2" class="ttip_b" oldtitle="ดูรายละเอียด" onclick='viewAssignEquipment(<?php echo $Organizations['OrganizationNew']['id'];?>)'><i class="splashy-zoom_in"></i></a>
			0/0
		</td>
	</tr>
	<tr>
		<td colspan=2><center><b><?php echo __('อัตราความพร้อมรบในหน่วย');?></b></center></td>
	</tr>
	<tr>
		<td><b><?php echo __('กำลังพลในหน่วย ');?></b></td>
		<td>0.00%</td>
	</tr>
	<tr>
		<td><b><?php echo __('อาวุธและยุทโธปกรณ์ในหน่วย ');?></b></td>
		<td>0.00%</td>
	</tr>
	<tr>
		<td><b><?php echo __('การฝึก ');?></b></td>
		<td>
		<a data-toggle="modal" data-backdrop="static" href="#myModal2" class="ttip_b" oldtitle="New tasks" onclick='viewTraining(<?php echo $Organizations['OrganizationNew']['id'];?>)'><i class="splashy-zoom_in"></i></a>
		</td>
	</tr>
	
	</tbody>
</table>