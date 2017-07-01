<script type="text/javascript">
               
            $(".lock").click(function(){
                var id = $(this).attr("value"); 
                lockData(id);
            }); 

            function addData(){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้าง ' + "<?php echo $ModelTypes[$model_type_id];?>" + ' ใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/addModelRate",function(data) {
						$('#customModal2').html(data);
				  });

				  $("#myModal2").css({
						"width":"1200px",
						"top":"6%",
						"left":"300px"
				  });
				  
				  $(".modal-body").css({
						"max-height":"500px"
				  });  
            }        

            function viewData(id){
				  alert(id);

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('ดูรายละเอียด ' + "<?php echo $ModelTypes[$model_type_id];?>");
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/detailModelRate/"+id,function(data) {
						$('#customModal2').html(data);
				  });                        
        
				  $("#myModal2").css({
						"width":"1200px",
						"top":"6%",
						"left":"300px"
				  });
				  
				  $(".modal-body").css({
						"max-height":"500px"
				  });   	
        
            }

            function editData(id){
				  alert(id);

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูล ' + "<?php echo $ModelTypes[$model_type_id];?>");
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../ModelRates/editModelRate/"+id,function(data) {
						$('#customModal2').html(data);
				  });

				  $("#myModal2").css({
						"width":"1200px",
						"top":"6%",
						"left":"300px"
				  });
				  
				  $(".modal-body").css({
						"max-height":"500px"
				  });

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
												//window.location="../../ModelRates";
											}else{
												alert("การลบข้อมูลล้มเหลว");
											}

										}, "json"); 

                            }
                    }else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
            }

            function lockData(id){

				/*
				var model_is_lock = $(this).attr("model_is_lock");
				//alert(model_is_lock);

				if(model_is_lock == 'Y'){
					$(this).removeClass('splashy-lock_large_locked');
					$(this).addClass('splashy-lock_large_unlocked');
					$(this).attr("model_is_lock",'N');

				}else if(model_is_lock == 'N'){
					$(this).removeClass('splashy-lock_large_unlocked');
					$(this).addClass('splashy-lock_large_locked');
					$(this).attr("model_is_lock",'Y');
				}
				*/

				  $("#myModal2").css({
								"width":"500px",
								"top":"30%",
								"left":"800px"
				  });
				  
				  $(".modal-body").css({
								"max-height":"500px"
				  }); 

            }                    
            
</script>