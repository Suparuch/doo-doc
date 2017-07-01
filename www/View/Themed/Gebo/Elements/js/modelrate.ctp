<script type="text/javascript">

			var code = $("input[name='code']");
			code.focus();

            function addData(){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้าง ' + "<?php echo $ModelTypes[$model_type_id];?>" + ' ใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/addModelRate/"+ "<?php echo $model_type_id;?>",function(data) {
						$('#customModal2').html(data);
						alert("ดำเนินการเสร็จสิ้น");
				  });				  
				  screenModalFull();
            }        

            function viewData(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('ดูรายละเอียด ' + "<?php echo $ModelTypes[$model_type_id];?>");
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/detailModelRate/"+id,function(data) {
						$('#customModal2').html(data);
				  });                        
				  screenModalFull();
            }

            function editData(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูล ' + "<?php echo $ModelTypes[$model_type_id];?>");
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/editModelRate/"+id,function(data) {
						$('#customModal2').html(data);
						
				  });
				  screenModalFull();

            }

			function addModel(model_id){

				var model = 'model';

				var url = "../../ModelRates/append";
								
				$.post(url,{
					model_id:model_id,
					model:model,
				},function(data){
					//$(data).insertAfter("#mainTable tr:first");
					
					$("#ModelRate-submit").click();
					///location.reload();
				},"html");

			}

            function deleteData(id){

                var ids = [];
                if(id != null){
					ids.push(id);
                }
                else
                ids = getChecks();
                    
                    if(ids.length != 0){
                    
                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){

								var url = "../../ModelRates/delete";
								$.post(url,{
									ids:ids,
								},function(data){

									if(data.status == "SUCCESS"){
										ids = ids.toString();
										var arr_model_id = ids.split(',');
										$.each( arr_model_id, function( key, model_id ){
											$('#'+model_id).remove();
										});
									}else{
										alert("การลบข้อมูลล้มเหลว");
									}

								}, "json"); 
								
                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }

            function copyData(){

                ids = getChecks();
				if(ids.length != 0){
					
					ids = ids.toString();
					var arr_model_id = ids.split(',');
					$.each( arr_model_id, function( key, model_id ){
					
						var url = "../../ModelRates/copyModelRate";
						$.post(url,{
							model_id:model_id,
						},function(data){

							if(data.status == "SUCCESS"){
								addModel(data.id);
							}else{
								alert("การลบข้อมูลล้มเหลว");
							}

						}, "json"); 
					});
				}

            }

            function lockData(model_id){
			
				var is_locked = $('#lock-'+model_id).attr("is_locked");

				var url = "../../ModelRates/lockModelRate";
				$.post(url,{
					model_id:model_id,
					is_locked:is_locked
				},function(data){

					if(data.status == "SUCCESS"){
						if(is_locked == 'Y'){
							$('#lock-'+model_id).removeClass('splashy-lock_large_locked');
							$('#lock-'+model_id).addClass('splashy-lock_large_unlocked');
							$('#lock-'+model_id).attr("is_locked",'N');

						}else if(is_locked == 'N'){
							$('#lock-'+model_id).removeClass('splashy-lock_large_unlocked');
							$('#lock-'+model_id).addClass('splashy-lock_large_locked');
							$('#lock-'+model_id).attr("is_locked",'Y');
						}
					}else{
						alert("การล๊อคข้อมูลล้มเหลว");
					}

				}, "json");

            }
function show_document(id){
	//alert("test");
	 $('#customModal2').html('');
				  $('#customModalHeader2').html('พิมพ์ ' + "<?php echo $ModelTypes[$model_type_id];?>");
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/detailModelRate/"+id,function(data) {
						$('#customModal2').html(data);
						 $('a[href="#tabDocument"]').tab('show');
						 $(".t_model").hide();
				  });                        
				  screenModalFull();
				
}
            
</script>