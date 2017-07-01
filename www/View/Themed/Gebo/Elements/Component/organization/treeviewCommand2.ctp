		<?php $organization_type_id = 0?>
		<table><tr valign='top'><td>
		<div class="span4">
        	(กองแผน)
			<div class="organization_type_tree_9<?php echo $organization_type_id;?>"></div>
		</div>
		</td>
        <td>
		<div class="span4">
        	(กพ)
			<div class="organization_type_tree_9<?php echo $organization_type_id;?>"></div>
		</div>
		</td>
        
        <td>
	
		</td></tr></table>
        <a href="#myModal2" id='tk' onclick="compare2(2);" data-toggle="modal" data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl" style='visibility:hidden'></a>
        <script language="javascript">
		function compare2(obj){
			$('#customModal2').html('');
				  $('#customModalHeader2').html('ดูรายละเอียด');
				  $('#customModalAction2').html('ปิด');
				  $('#customModal2').load("../../Organizations/compare/"+id,function(data) {
				
						$('#customModal2').html(data);
				  });                 
				        
				  screenModalFull();
		}
		function compare(obj){
		id=1;
	//	screenModalDefault();
	/*
				  $('#customModal2').html('');
				  $('#customModalHeader2').html('ดูรายละเอียด');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Organizations/compare/"+id,function(data) {
				
						$('#customModal2').html(data);
				  });                 
				        
				  screenModalFull();
				  */
				  $("#tk").trigger("click");
				  //$(".fade").css('opacity', '1');
		}
        </script>