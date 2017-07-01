<script>
	function uploaderHide(){
		$('#uploader-explanation').hide();
	}
</script>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					ข้อมูลอัตรามูลฐานกระสุนและวัตถุระเบิด
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#myModal2"  onclick="addWeapon();" data-toggle="modal" data-backdrop="static" class="add_rows_simple  add_rows_simple hideme mm_4_add" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li><a href="#" class="delete add_rows_simple hideme mm_4_delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>						
					</ul>
			</div>
			ตอนที่ 1 คำชี้แจง 
			<div id="document-explanation">
			<?php
				$document_key = '';
				if(!empty($ExplanationDocuments)){ 
					$document_id = $ExplanationDocuments['ExplanationDocument']['id'];
					$document_key = $ExplanationDocuments['ExplanationDocument']['key'];
					$document_name = $ExplanationDocuments['ExplanationDocument']['name'];
					//echo $Document['ModelDocument']['name'];
				?>	
				<div id="document<?php echo $document_id;?>">
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $document_name;?></a>
				<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>');></i>
				</div>
				<?php } ?>
			</div>
			<input type="button" name="button" id="uploader-explanation" value="แนบไฟล์ ตอนที่ 1 คำชี้แจง" />
			<?php echo empty($document_key)? '' : '<script>uploaderHide();</script>';?>

			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
							<th rowspan=2 style="text-align: center;"><input type="checkbox" onclick="toggleWeapon(this);"></th>
							<th rowspan=2 class="table-icon hidden-480">ลำดับ</th>
							<th rowspan=2>ประเภทอาวุธ</th>
							<th rowspan=2>ชนิดอาวุธ</th>
							<th rowspan=2>จำนวนนัด/อาวุธ</th>
							<th colspan=3><center>แยกประเภท</center></th>
							<th rowspan=2>หมายเหตุ</th>
							<th rowspan=2>สร้างวันที่</th>
							<th rowspan=2>แก้ไขวันที่</th>
							<th rowspan=2></th>
						</tr>
						<tr>
							<th>ประเภทที่</th>
							<th>ชนิดอาวุธ</th>
							<th>จำนวนนัด</th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($Weapons)) { ?>
						<?php foreach($Weapons as $Weapon) { ?>
							<tr>

							<td style="text-align: center;">
								<input type="checkbox" name="WeaponID[]" value="<?php echo $Weapon['Weapon']['id']; ?>"></td>  
							<td style="text-align: center;">
								<?php //if(!empty($Weapon['Weapon']['order_sort'])) 
										//echo $Weapon['Weapon']['order_sort']; 
										echo ++$pagination['offset'];
								?>
							</td>
							<td><?php if(!empty($Weapon['Weapon']['weapon_type_id'])) echo $WeaponTypes[$Weapon['Weapon']['weapon_type_id']];?></td>
							<td><?php if(!empty($Weapon['Weapon']['name'])) echo $Weapon['Weapon']['name'];?></td>
							<td><?php if(!empty($Weapon['Weapon']['number_shot'])) echo $Weapon['Weapon']['number_shot']; ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?php if(!empty($Weapon['Weapon']['description'])) echo $Weapon['Weapon']['description']; ?></td>
							<td><?php if(!empty($Weapon['Weapon']['created'])) echo $this->DateFormat->formatDateThai($Weapon['Weapon']['created']);?></td>
							<td>
								<?php if(!empty($Weapon['Weapon']['updated'])) 
										echo $this->DateFormat->formatDateThai($Weapon['Weapon']['updated']); 
								?>    
							</td>
							
							<td style="text-align: center;">
								<a data-toggle="modal" data-backdrop="static" href="#myModal2" class='add_rows_simple hideme mm_4_edit' onclick="editWeapon('<?php echo $Weapon['Weapon']['id']; ?>');" ><i class="icon-pencil"></i></a>
								<a href="#" class="delete" value="<?php echo (string)$Weapon['Weapon']['id']; ?>" class='add_rows_simple hideme mm_4_delete'><i class="icon-trash"></i></a>
							</td>
						</tr>
						<?php } ?>
						<?php }else{ ?>
							<tr>
									<td colspan="7" style="text-align:center;">
											ไม่พบข้อมูลที่ตรงกัน
									</td>
							</tr>                                                  
						<?php } ?>
					</tbody>					
				</table>

				</div>
			</div>

		</div>
	</div>

</div>
<style>
    #customModal2{
        height:250px;
    }    
</style>
<script type="text/javascript">
    
	function toggleWeapon(source) 
	{

	  var checkboxes = document.getElementsByName('WeaponID[]');
	  for(var i in checkboxes)
	  {
		checkboxes[i].checked = source.checked;
	  }

	}    
				
	function addWeapon(){

		  $('#customModal2').html('');
		  $('#customModalHeader2').html('สร้างอัตรามูลฐานกระสุนและวัตถุระเบิดใหม่');
		  $('#customModalAction2').html('บันทึก');
		  $('#customModal2').load("../../Weapons/form",function(data) {
		  	$('#customModal2').html(data);
			 screenModalFull();
		  });
		  
	}        
	
	function editWeapon(id){

		  $('#customModal2').html('');
		  $('#customModalHeader2').html('แก้ไขข้อมูลอัตรามูลฐานกระสุนและวัตถุระเบิด');
		  $('#customModalAction2').html('บันทึก');
		  $('#customModal2').load("../../Weapons/form/"+id,function(data) {
			$('#customModal2').html(data);
			 screenModalFull();
		  });

	}               
	
	function deleteWeapon(id){

		var ids = [];
		
		if(id != null){
		ids.push(id);
		}
		else
		ids = getChecks();                                                               
						 
		if(ids.length != 0){                 
		
				if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
						var url = "../../Weapons/delete";
						$.post(url,{
								ids:ids,
						},function(data){

							if(data.status == "SUCCESS"){
								window.location="../../Weapons";                                                       
							}else{
								alert("การลบข้อมูลล้มเหลว");
							}

						}, "json"); 

				}
		}else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');

	}

	function getChecks(){

		var checkboxes = $("[name='WeaponID[]']");   
		var ids = [];

		$.each( checkboxes, function( key, checkbox ) {
			  if(checkbox.checked===true) {
				ids.push(checkbox.value); 
			  }
		});                        
		
		return ids;
	} 
</script>

<script>
	
	var uploader = document.getElementById('uploader-explanation');
	var explanation_type = 'weapon';
	upclick(
	{
		element: uploader,
		action: '../../Weapons/upload/'+explanation_type, 
		onstart:
		function(filename)
		{
		  //alert('Start upload: '+filename);
		},
		oncomplete:
		function(response_data) 
		{
		  data = $.parseJSON(response_data);
		  document_id = data[0].document_id;
		  document_key = data[0].document_key;
		  document_name = data[0].document_name;
		  document_link = '<div id="document'+document_id+'"><a href="/FileProviders/index/'+document_key+'" target="_blank">'+document_name+'</a> <i class="icon-remove" onclick=removeDocument("'+document_id+'");></i></div>';
		  $('#document-explanation').append(document_link);
		  $('#uploader-explanation').show();
		}
	});

	function removeDocument(document_id){

		var url = "../../Weapons/removeDocument";
		$.post(url,{
			document_id:document_id,
		},function(data){

			if(data.status == "SUCCESS"){
			   $('#uploader-explanation').show();
			   $('#document-explanation').empty();

			}else{
				alert("การลบข้อมูลล้มเหลว");
			}

		}, "json"); 

	}

	$(".delete").click(function(){
		var id = $(this).attr("value");              
                deleteWeapon(id);
	});      

   
</script>