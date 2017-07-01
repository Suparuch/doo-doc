<?php
//pr($soldierGroups);
//die();
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					บัญชีรายชื่อนายหมานสัญญาบัตรย้ายประเภท หนุน ไป นอก
				</h3>
			</div>
			<div class="btn-group sepH_b">
			<button data-toggle="dropdown" class="btn dropdown-toggle btn-info">Export <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="#" class="delete_rows_simple" data-tableid="smpl_tbl"> Excel</a></li>
				<li><a href="javascript:void(0)">Pdf</a></li>
			</ul>
			</div>
			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>

						<tr>
							<th rowspan=2><center>ลำดับ</center></th>
							<th rowspan=2><center>ยศ - ชื่อ - นามสกุล</center></th>
							<th rowspan=2><center>วัน เดือน ปี เกิด</center></th>
							<th rowspan=2><center>เลขประจำตัว</center></th>
							<th rowspan=2><center>เหล่า</center></th>
							<th rowspan=2><center>ประเภทนายทหารสัญญาบัตร</center></th>
							<th colspan=2><center>ย้ายประเภทเป็น</center></th>
							<th rowspan=2><center>หมายเหตุ</center></th>
						</tr>
						<tr>
							<th><center>นายทหาร<br>นอกราชการ</center></th>
							<th><center>นายทหาร<br>พ้นราชการ</center></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$seq = 0;
						foreach($accounts as $account){
						$seq++;
						?>
						<tr>
							<td>
							<center>
								<?php echo $seq;?>
							</center>
							</th>
							<td>
								<?php echo $ranks[$account['Account']['rank_id']];?>
								<?php echo $account['Account']['name_th'];?>
								<?php echo $account['Account']['surname_th'];?>
							</td>
							<td>
							<center>
								<?php //echo $account['Account']['birthdate'];?>
								<?php //echo $account['Account']['birthdate'];?>
								<?php echo $this->DateFormat->formatDateThai($account['Account']['birthdate'],'D M Y');?>
							</center>
							</td>
							<td>
							<center>
								<?php echo $account['Account']['soldier_number'];?>
							</center>
							</th>
							<td>
							<center>
								<?php echo $soldierGroups[$account['Account']['soldier_group_id']];?>
							</center>
							</th>
							<td>
								นายทหารกองหนุนมีเบี้ยหวัด สังกัด <?php echo $account['Account']['department_id'];?>
							</td>
							<td>
							<center>
								1 ม.ค. 56
							</center>
							</td>
							<td>

							</td>
							<td>

							</td>
						</tr>
						<?php }?>
						

					</tbody>
				</table>

				</div>
			</div>

		</div>
	</div>

</div>