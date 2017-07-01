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
					ข้อมูลยุทโธปกรณ์
				</h3>
			</div>
			<div class="btn-group sepH_b">
					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#myModal2" onclick="addEquipment();" data-toggle="modal" data-backdrop="static" class="add_rows_simple hideme mm_3_add" data-tableid="smpl_tbl"><i class="splashy-add"></i></i> เพิ่ม </a></li>
						<li class='add_rows_simple hideme mm_3_delete'><a href="#" class="delete" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
						<!--
						<li><a href="javascript:void(0)">Export PDF</a></li>
						<li><a href="javascript:void(0)">Export Excel</a></li>
						-->
						
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
							<th style="text-align: center;"><input type="checkbox" onclick="toggleEquipment(this);"></th>
							<th class="table-icon hidden-480">ลำดับ</th>
							<th>สายยุทธบริการ</th>
							<th>หมายเลข</th>
							<th>ชื่อยุทโธปกรณ์</th>
							<th>สร้างวันที่</th>
							<th>แก้ไขวันที่</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php if(!empty($Equipments)) { ?>
						<?php foreach($Equipments as $Equipment) { ?>
							<tr>

							<td style="text-align: center;">
								<input type="checkbox" name="EquipmentID[]" value="<?php echo $Equipment['Equipment']['id']; ?>"></td>  
							<td style="text-align: center;">
								<?php //if(!empty($Equipment['Equipment']['order_sort'])) 
										//echo $Equipment['Equipment']['order_sort']; 
										echo ++$pagination['offset'];
								?>
							</td>
							<td>
								<?php if(!empty($Equipment['Equipment']['tech_id'])) 
									   echo $Techs[$Equipment['Equipment']['tech_id']];
								?>    
							</td>
							<td>
								<?php if(!empty($Equipment['Equipment']['code'])) 
										echo $Equipment['Equipment']['code']; 
								?>    
							</td>

							<td>
								<?php if(!empty($Equipment['Equipment']['name'])) 
										echo $Equipment['Equipment']['name']; 
								?>    
							</td>
							<td>
								<?php if(!empty($Equipment['Equipment']['created'])) 
										echo $this->DateFormat->formatDateThai($Equipment['Equipment']['created']); 
								?>    
							</td>
							<td>
								<?php if(!empty($Equipment['Equipment']['updated'])) 
										echo $this->DateFormat->formatDateThai($Equipment['Equipment']['updated']); 
								?>    
							</td>
							
							<td style="text-align: center;">
								<a data-toggle="modal" class='add_rows_simple hideme mm_3_edit' data-backdrop="static" href="#myModal2" onclick="editEquipment('<?php echo $Equipment['Equipment']['id']; ?>');" ><i class="icon-pencil"></i></a>
								<a href="#" class="delete add_rows_simple hideme mm_3_delete" value="<?php echo (string)$Equipment['Equipment']['id']; ?>"><i class="icon-trash"></i></a>
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
        height:600px;
    }    
</style>
<script type="text/javascript">
    
	function toggleEquipment(source) 
	{

	  var checkboxes = document.getElementsByName('EquipmentID[]');
	  for(var i in checkboxes)
	  {
		checkboxes[i].checked = source.checked;
	  }

	}    
				
	function addEquipment(){

		  $('#customModal2').html('');
		  $('#customModalHeader2').html('สร้างยุทโธปกรณ์ใหม่');
		  $('#customModalAction2').html('บันทึก');
		  $('#customModal2').load("../../Equipments/form",function(data) {
		  	$('#customModal2').html(data);
		  });

	}        
	
	function editEquipment(id){

		  $('#customModal2').html('');
		  $('#customModalHeader2').html('แก้ไขข้อมูลยุทโธปกรณ์');
		  $('#customModalAction2').html('บันทึก');
		  $('#customModal2').load("../../Equipments/form/"+id,function(data) {
			$('#customModal2').html(data);
		  });
	}               
	
	function deleteEquipment(id){

		var ids = [];
		
		if(id != null){
		ids.push(id);
		}
		else
		ids = getChecks();                                                               
						 
		if(ids.length != 0){                 
		
				if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
				var url = "../../Equipments/delete";
						$.post(url,{
								ids:ids,
						},function(data){

							if(data.status == "SUCCESS"){
								window.location="../../Equipments";                                                       
							}else{
								alert("การลบข้อมูลล้มเหลว");
							}

						}, "json"); 

				}
		}else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');

	}

	function getChecks(){

		var checkboxes = $("[name='EquipmentID[]']");
	   
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
	var explanation_type = 'equipment';
	upclick(
	{
		element: uploader,
		action: '../../Equipments/upload/'+explanation_type, 
		onstart:
		function(filename)
		{
		  //alert('Start upload: '+filename);
		},
		oncomplete:
		function(response_data) 
		{
		  data = $.parseJSON(response_data);
		  //console.log(data);
		  document_id = data[0].document_id;
		  document_key = data[0].document_key;
		  document_name = data[0].document_name;
		  document_link = '<div id="document'+document_id+'"><a href="/FileProviders/index/'+document_key+'" target="_blank">'+document_name+'</a> <i class="icon-remove" onclick=removeDocument("'+document_id+'");></i></div>';
		  //console.log(document_link);
		  //$('#uploader-explanation').hide();
		  //alert(document_link);
		  $('#document-explanation').append(document_link);
		  $('#uploader-explanation').show();
		  //uploaderHide();
		}
	});

	function removeDocument(document_id){

		var url = "../../Equipments/removeDocument";
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
		deleteEquipment(id);
	});      

   
</script>