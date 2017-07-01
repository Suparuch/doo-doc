<input type="hidden" name="data[Organization][id]" value="<?php echo $Organizations['Organization']['id'];?>">
<input type="hidden" name="organization_type" value="<?php echo $organization_type;?>">
<table class="table table-bordered">
	<tbody>
	<tr>
		<td colspan=2>
		<table class="table table-bordered">
		<thead>
		<tr>
			<th colspan=5><center>เปิดปิดอัตรา กำลังพล</center></th>
		<tr>
		</thead>
		<tbody>
		<tr>
			<?php foreach($ModelLevels as $key=>$ModelLevel){?>
			<td>
			<input name="data[Organization][rate_property]" type="radio" value="<?php echo $key;?>" <?php echo $Organizations['Organization']['rate_property'] == $key? 'checked':'';?>> <span id='<?php echo $key;?>_name'> <?php echo $ModelLevel;?></span>
			</td>
			<?}?>
		<tr>
		</tbody>
		</table>
		</td>
	</tr>
	
	</tbody>
</table>	

<script>
		function modalAction2(){
			
			var id = $("input[name='data[Organization][id]']").val();
			var rate_property = $("input[name='data[Organization][rate_property]']:checked").val();
			var rate_property_name = $("#"+rate_property+"_name").html();
			var organization_type = $("input[name='organization_type']").val();

			if(id != "" && rate_property != "")
			{         
					var url = "../../Organizations/setModelProperty";
					$.post(url,{
						id:id,
						rate_property:rate_property,	
					},function(data){
		
						if(data.status == "SUCCESS"){
							$("#RateProperty_"+organization_type).html(rate_property_name);
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