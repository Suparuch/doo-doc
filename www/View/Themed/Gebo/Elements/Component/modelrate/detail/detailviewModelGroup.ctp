<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th width=100>หมายเลข อจย.</th>
			<th>ชื่อ อจย. (ย่อ)</th>
			<th width=150><center>วันที่แก้ไข</center></th>
			<th width=60><center>จัดเรียง</center></th>
			<th width=60><center>จำนวน (เต็ม)</center></th>
            <th width=60><center>จำนวน (ลด&nbsp;1)</center></th>
            <th width=60><center>จำนวน (ลด&nbsp;2)</center></th>
            <th width=60><center>จำนวน (ลด&nbsp;3)</center></th>
            <th width=60><center>จำนวน (โครง)</center></th>
			<th width=225>หมายเหตุ</th>
		</tr>
	</thead>
	<tbody>

	<?php if(!empty($ModelGroups)) { ?>
	<?php foreach($ModelGroups as $ModelGroup) { ?>
		<tr>
			<td><center><?php echo $ModelGroup['ModelGroup']['code'];?><center></td>
			<td><?php echo $ModelGroup['ModelGroup']['name'];?></td>
			<td><center><?php echo $this->DateFormat->formatDateThai($ModelGroup['ModelGroup']['updated']);?></center></td>
            <td><center><?php echo $ModelGroup['ModelGroup']['order_sort'];?></center></td>
			<td><center><?php echo $ModelGroup['ModelGroup']['quantity'];?></center></td>
            <td><center><?php echo $ModelGroup['ModelGroup']['quantity_decrease1'];?></center></td>
            <td><center><?php echo $ModelGroup['ModelGroup']['quantity_decrease2'];?></center></td>
            <td><center><?php echo $ModelGroup['ModelGroup']['quantity_decrease3'];?></center></td>
            <td><center><?php echo $ModelGroup['ModelGroup']['quantity_struct'];?></center></td>
			<td><?php echo $ModelGroup['ModelGroup']['comment'];?></td>
		</tr>								
	<?php } ?>
	<?php }else{ ?>
		<tr>
			<td colspan="5" style="text-align:center;">
					ไม่พบข้อมูลที่ตรงกัน
			</td>
		</tr>                                                  
	<?php } ?>

	</tbody>
</table>