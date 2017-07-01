<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<!--<th>หมายเลขหน่วย</th>-->
			<th>ชื่อหน่วย</th>
			<th width=140>ดูธรรมเนียบกำลังพล</th>
		</tr>
	</thead>
<?php if(!empty($OrganizationModels)) { ?>
<?php foreach($OrganizationModels as $OrganizationModel) { ?>
	<tbody>
		<tr>
			<!--<td></td>-->
			<td>
				<?php if(!empty($OrganizationModel['OrganizationModel']['organization_id'])) 
						echo $Organizations[$OrganizationModel['OrganizationModel']['organization_id']]; 
				?>
			</td>
			<td>
				<center>
					<i class="splashy-group_grey"></i>
				</center>
			</td>
		</tr>
	</tbody>
<?php } ?>
<?php }else{ ?>
	<tr>
		<td colspan="2" style="text-align:center;">
				ไม่พบข้อมูลที่ตรงกัน
		</td>
	</tr>
<?php } ?>
</table>