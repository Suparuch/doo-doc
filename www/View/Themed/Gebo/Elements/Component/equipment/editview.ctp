<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['code'] = empty($default['code']) ? '' : $default['code']; 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
		$default['image_key'] = empty($default['image_key']) ? '' : $default['image_key'];
		$default['description'] = empty($default['description']) ? '' : $default['description'];
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลยุทโธปกรณ์') ;?></h3>-->
			<div class="box-content nopadding">
				<?php echo $this->Form->create('Equipments', array('action' => 'save','class' => 'form-horizontal form-bordered'));?>
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
							    <td>หมายเลขยุทโธปกรณ์ </td>
							    <td>
									<input type="hidden" name="data[Equipments][id]" value="<?php echo $default['id']; ?>"/>
									<?php
										echo $this->Form->input('code', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',
											'placeholder' => 'หมายเลขยุทโธปกรณ์',
											'default' => $default['code'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

										));
									?>
							    </td>
							</tr>
							<tr>
							    <td>ชื่อยุทโธปกรณ์ </td>
							    <td>
									<?php
										echo $this->Form->input('name', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',
											'placeholder' => 'ชื่อยุทโธปกรณ์',
											'default' => $default['name'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
										));
									?>    
							    </td>
							</tr>
							<tr>
							    <td>รูปยุทโธปกรณ์ </td> 
							    <td>
								<div data-provides="fileupload" class="fileupload fileupload-new">
									<input type="hidden">
									<div id="equipment-image" style="width: 200px; height: 150px;" class="fileupload-new thumbnail">									
									<a href='<?php echo $this->Html->url('/FileProviders/index/', true);?><?php echo $default['image_key'];?>' target='_blank'>
									<img src="<?php echo $this->Html->url('/FileProviders/index/', true);?><?php echo $default['image_key'];?>" alt="">
									</a>
									</div>									
									<!--<div style="max-width: 200px; max-height: 150px; line-height: 0px;" class="fileupload-preview fileupload-exists thumbnail"></div>-->
									<div>
										<!--<span class="btn btn-file"><span class="fileupload-new">เลือกรูป</span><span class="fileupload-exists">เปลี่ยนรูป</span><input type="file"></span>-->
										<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">ลบ</a>
									</div>
									<input type="button" name="button" id="uploader-explanation" value="เลือกรูป" />
								</div>
							    </td>
							</tr>
							<tr>
							    <td>ข้อมูลเฉพาะ</td>
							    <td>
									<?php
										echo $this->Form->input('description', array(
											'label' => false,
											'div' => false,
											'class' => 'span8',
											'placeholder' => 'ข้อมูลเฉพาะ',
											'default' => $default['description'],
											'onkeypress' => 'return keyNumberArabicAndTextThai(event)'

										));
									?>    
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
			
			var id = $("input[name='data[Equipments][id]']").val();
			var code = $("input[name='data[Equipments][code]']").val();
			var name = $("input[name='data[Equipments][name]']").val();

			var description = $("input[name='data[Equipments][description]']").val();
			
			if(code != "" && name != "")
			{         
					var url = "../../Equipments/save/"+id;
					$.post(url,{
						code:code,
						name:name,

						description:description
	
					},function(data){
		
						if(data.status == "SUCCESS"){
							$(".close").trigger( "click" );					
							window.location="../../Equipments/index";                                            
						}else{
							alert("การสร้างข้อมูลล้มเหลว");
						}
						
					}, "json"); 
					

					
			  }
			  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}

		}
		
		var id = $("input[name='data[Equipments][id]']").val();
		var uploader = document.getElementById('uploader-explanation');
		upclick(
		{
			element: uploader,
			action: '../../Equipments/uploadPhoto/'+id, 
			onstart:
			function(filename)
			{
			  //alert('Start upload: '+filename);
			},
			oncomplete:
			function(response_data) 
			{
			  
			  data = $.parseJSON(response_data);
			  console.log(data);
			  document_id = data[0].document_id;
			  document_key = data[0].document_key;
			  document_name = data[0].document_name;
			  document_link = '<a href="/FileProviders/index/'+document_key+'" target=_blank>';
			  document_link += '<img src="/FileProviders/index/'+document_key+'" alt="">';
			  document_link += '</a>';
			  $('#equipment-image').empty();
			  $('#equipment-image').append(document_link);

			}
		});
</script>