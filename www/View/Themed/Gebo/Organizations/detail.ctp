<table class="table table-bordered">
	<thead>
	<tr>
		<th colspan="2"><center>รายละเอียดบัญชีการจัดหน่วยทหาร</center></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tabOrganization_<?php echo $organization_type;?>" data-toggle="tab">ข้อมูลหน่วยงาน</a></li>
					<li class=""><a href="#tabModel_<?php echo $organization_type;?>" data-toggle="tab">ข้อมูลอัตราการจัด</a></li>
				</ul>
				<div class="tab-content">
					
					<div class="tab-pane active" id="tabOrganization_<?php echo $organization_type;?>">						
						<p>
							<div id="detailviewOrganization_<?php echo $organization_type;?>">
							<a href="#" id="edit_" data-role="button" class="btn btn-primary" onclick="editData('<?php echo $organization_type;?>','<?php echo $Organizations['Organization']['id'];?>');">แก้ไขหน่วย</a>
							<?php
								echo $this->element('Component/organization/detailviewOrganization');
							?>
							</div>
						</p>
					</div>
					<div class="tab-pane" id="tabModel_<?php echo $organization_type;?>">
						<p>
							<?php
							echo $this->element('Component/organization/detailviewModel');
							?>
						</p>
					</div>
				</div>
			</div>
		</td>
	</tr>
	</tbody>
</table>