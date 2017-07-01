<?php
$model_type_id = empty($ModelRates['ModelRate']['model_type_id']) ? 1 : $ModelRates['ModelRate']['model_type_id'];
$hide = '';
if($model_type_id!=1)
	$hide = " style='display:none' ";
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<div class="box-content nopadding">
				
					<div class="row-fluid">

							<table class="table table-bordered">
								<tbody>
									<tr>
										<td width="150"><b>หมายเลข <?php echo $ModelTypeShorts[$model_type_id];?> : </b></td>
										<td><?php echo empty($ModelRates['ModelRate']['code']) ? '' : $ModelRates['ModelRate']['code']?></td>
									</tr>
									<tr>
										<td><b>ชื่อ (ย่อ) : </b></td>
										<td><?php echo empty($ModelRates['ModelRate']['short_name']) ? '' : $ModelRates['ModelRate']['short_name']?></td>
									</tr>
									<tr>
										<td><b>ชื่อ (เต็ม) : </b></td>
										<td><?php echo empty($ModelRates['ModelRate']['name']) ? '' : $ModelRates['ModelRate']['name']?></td>
									</tr>
									<tr >
										<td><b>วันที่ : </b></td>
										<td><?php echo empty($ModelRates['ModelRate']['model_date']) ? '' : $this->DateFormat->formatDateThai($ModelRates['ModelRate']['model_date'])?></td>
									</tr>
									<tr>
										<td><b>คำสั่ง อัตรากำลังพล: </b></td>
										<td>
											<?php echo empty($ModelRates['ModelRate']['command_user']) ? '' : $ModelRates['ModelRate']['command_user']?>
											<?php echo empty($ModelRates['ModelRate']['command_user_date']) ? '' : '&nbsp;ลงวันที่&nbsp;' . $this->DateFormat->formatDateThai($ModelRates['ModelRate']['command_user_date']);?>
										</td>
									</tr>
									<tr <?php echo $hide;?>>
										<td><b>คำสั่ง อัตรายุทโธปกรณ์ :</b></td>
										<td>
											<?php echo empty($ModelRates['ModelRate']['command_equipment']) ? '' : $ModelRates['ModelRate']['command_equipment']?>
											<?php echo empty($ModelRates['ModelRate']['command_equipment_date']) ? '' : '&nbsp;ลงวันที่&nbsp;' . $this->DateFormat->formatDateThai($ModelRates['ModelRate']['command_equipment_date']);?>
										</td>
									</tr>
									<?php if($model_type_id == 2){?>
									<tr style='visibility:hidden;position:absolute'>
										<td><b>หมายเหตุ ท้ายอัตรา : </b></td>
										<td><?php echo empty($ModelRates['ModelRate']['comment']) ? '' : nl2br($ModelRates['ModelRate']['comment'])?></td>
									</tr>
									<?php }?>
									<tr>
										<td><b>หมายเหตุ ท้ายอัตรา (กำลังพล) : </b></td>
										<td><?php echo empty($ModelRates['ModelRate']['comment_user']) ? '' : nl2br($ModelRates['ModelRate']['comment_user'])?></td>
									</tr>
									<?php if($model_type_id == 1){?>
									<tr>
										<td><b>หมายเหตุ ท้ายอัตรา (ยุทโธปกรณ์) : </b></td>
										<td><?php echo empty($ModelRates['ModelRate']['comment_equipment']) ? '' : nl2br($ModelRates['ModelRate']['comment_equipment'])?></td>
									</tr>
									<?php }?>
									<tr>
										<td><b>สถานะ ล๊อคแก้ไข</b></td>
										<td>
										<?php if($ModelRates['ModelRate']['is_locked'] == 'N'){?>
											<i id="lock-1034" class="splashy-lock_large_unlocked"></i>
										<?php }else{?>
											<i id="lock-1034" class="splashy-lock_large_locked"></i>
										<?php }?>
										&nbsp;
										<?php 
										echo $StatusLocks[$ModelRates['ModelRate']['is_locked']];
										?>
										</td>
									</tr>
								</tbody>
							</table>
							
					</div>
					
			</div>	
		</div>
	</div>
</div>