<input type="hidden" name="data[Organization][id]" value="<?php echo $Organizations['Organization']['id'];?>">
<input type="hidden" name="organization_type" value="<?php echo $organization_type;?>">
<div class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabModelEquipment1" data-toggle="tab">แบบที่ 1</a></li>
		<li class=""><a href="#tabModelEquipment2" data-toggle="tab">แบบที่ 2</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabModelEquipment1">
			<p>

				<table class="table table-bordered">
					<tbody>
					<td colspan=2>
						<table class="table table-bordered">
						<thead>
						<tr>
							<th colspan=5><center>อัตราอนุมัติอาวุธและยุทโธปกรณ์ (อจย. ตอนที่ 4)</center>
							</th>
						<tr>
						</thead>
						<tbody>
						<?php foreach($ModelLevels as $key=>$ModelLevel){?>
						<td>
						<input name="data[Organization][rate_equipment]" type="radio" value="<?php echo $key;?>" <?php echo $Organizations['Organization']['rate_equipment'] == $key? 'checked':'';?>> <span id='<?php echo $key;?>_name'> <?php echo $ModelLevel;?></span>
						</td>
						<?}?>
						</tbody>
						</table>
						</td>
					</tr>
					
					</tbody>
				</table>

			</p>
		</div>
		<div class="tab-pane" id="tabModelEquipment2">
			<p>

				<table class="table table-bordered">
					<tbody>
					<td colspan=2>
						<table class="table table-bordered">
						<thead>
						<tr>
							<th colspan=5><center>อัตราอนุมัติอาวุธและยุทโธปกรณ์ (อจย. ตอนที่ 4)</center>
							</th>
						<tr>
						</thead>
						<tbody>
						<tr>
							<td>
							<input name="rate_equipment" type="radio" value="rate_full" checked> เต็ม
							</td>
							<td>
							<input name="rate_equipment" type="radio" value="rate_decrease_1"> ลดระดับ 1
							</td>
							<td>
							<input name="rate_equipment" type="radio" value="rate_decrease_2"> ลดระดับ 2
							</td>
							<td>
							<input name="rate_equipment" type="radio" value="rate_decrease_3"> ลดระดับ 3
							</td>
							<td>
							<input name="rate_equipment" type="radio" value="rate_structure"> โครง
							</td>
						<tr>
						</tbody>
						</table>
						</td>
					</tr>
					
					</tbody>
				</table>

			</p>
		</div>
	</div>
</div>
<script>
		function modalAction2(){
			
			var id = $("input[name='data[Organization][id]']").val();
			var rate_equipment = $("input[name='data[Organization][rate_equipment]']:checked").val();
			var rate_equipment_name = $("#"+rate_equipment+"_name").html();
			var organization_type = $("input[name='organization_type']").val();

			if(id != "" && rate_equipment != "")
			{         
					var url = "../../Organizations/setModelEquipment";
					$.post(url,{
						id:id,
						rate_equipment:rate_equipment,	
					},function(data){
		
						if(data.status == "SUCCESS"){
							$("#RateEquipment_"+organization_type).html(rate_equipment_name);
							$(".close").trigger( "click" );
							alert(data.message);
						}else{
							//alert("การสร้างข้อมูลล้มเหลว");
							alert(data.message);
						}
						
					}, "json"); 
									
		  }
		  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}

		}
</script>						
						