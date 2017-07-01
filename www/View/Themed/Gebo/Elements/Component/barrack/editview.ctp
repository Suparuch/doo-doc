<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				<?php echo $this->Form->create('Barracks', array('action' => 'save','class' => 'form-horizontal form-bordered'));?>
					<div class="row-fluid">
						
						<input type="hidden" name="data[Barracks][id]" value="<?php echo empty($default['id'])? '':$default['id']; ?>"/>
						<table class="table table-bordered">
							<!--
						    <thead>
							<tr>
							    <th colspan=12><center>แก้ไข ข้อมูลค่ายทหาร</center></th>
							</tr>
						    </thead>
							-->
						    <tbody>
							<tr>
							    <td>ทัพภาค </td>
							    <td>
									<?php		
									echo $this->Form->input('area_id', array(
										'label' => false,
										'div' => false,
										'class' => 'span8',
										'options' => $Areas,
										'empty' => '- - - เลือก - - - ',
										'default' => empty($default['area_id'])? '':$default['area_id']
									));		
									?>
							<tr>
							<tr>
							    <td>ชื่อภาค </td>
							    <td>
									<?php
										echo $this->Form->input('name', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',
											'placeholder' => '',
											'default' => empty($default['name'])? '':$default['name'],
                                                                                        'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

										));
									?>    
							    </td>
							</tr>
							<tr>
							    <td>ที่ตั้งปกติ </td> 
							    <td>
									จังหวัด 
									<?php
										echo $this->Form->input('province_id', array(
										'label' => false,
										'div' => false,
										'class' => 'edit-input-province',
										'options' => $Provinces,
										'empty' => '- - - เลือก - - - ',
										'default' => empty($default['province_id'])? '':$default['province_id'],
										'onchange' => "provinceChange(this.value,'edit')"

									))
									?> <br>
									อำเภอ/เขต 
									<?php
										echo $this->Form->input('zone_id', array(
										'label' => false,
										'div' => false,
										'class' => 'edit-input-zone',
										'options' => $Zones,
										'empty' => '- - - เลือก - - - ',
										'default' => empty($default['zone_id'])? '':$default['zone_id'],
										'onchange' => "zoneChange(this.value,'edit')"

									))
									?><br>
									ตำบล/แขวง (เพิ่มเติม) 
									<?php
										echo $this->Form->input('district_id', array(
										'label' => false,
										'div' => false,
										'class' => 'edit-input-district',
										'options' => $Districts,
										'empty' => '- - - เลือก - - - ',
										'default' => empty($default['district_id'])? '':$default['district_id']

									))
									?> 

							    </td>
							</tr>
							<tr>
							    <td>วันที่จัดตั้ง </td> 
							    <td>


								<div class="input-append date" id="edt_dp2" data-date-format="yyyy-mm-dd">
									<input class="span6" type="text" name='data[Barracks][command_date]' value='<?php echo (empty($default['command_date'])? '':substr($default['command_date'],0,10));?>'><span class="add-on">
									<i class="splashy-calendar_day"></i></span>
								</div>

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
			
			var d_id = $("input[name='data[Barracks][id]']").val();
			var d_area_id = $("select[name='data[Barracks][area_id]']").val();
			var d_name = $("input[name='data[Barracks][name]']").val();
			var d_province_id = $("select[name='data[Barracks][province_id]']").val();
			var d_zone_id = $("select[name='data[Barracks][zone_id]']").val();			
			var d_district_id = $("select[name='data[Barracks][district_id]']").val();
			var d_command_date = $("input[name='data[Barracks][command_date]']").val();

			//if(area_id != "" && name != "" && province_id != "" && zone_id != "" && district_id != "" && command_date != "")
			if(d_area_id != "" && d_name != "" && d_province_id != "")
			{         
					var url = "../../Barracks/save/"+d_id;
					$.post(url,{
						area_id:d_area_id,
						name:d_name,
						province_id:d_province_id,
						zone_id:d_zone_id,
						district_id:d_district_id,
						command_date:d_command_date
	
					},function(data){
		
						if(data.status == "SUCCESS"){
							$(".close").trigger( "click" );					
							window.location="../../Barracks/index";                                            
						}else{
							alert("การสร้างข้อมูลล้มเหลว");
						}
						
					}, "json"); 
					

					
			  }
			  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}

		}
</script>
	<script>
	$('#edt_dp2').datepicker();
	</script>