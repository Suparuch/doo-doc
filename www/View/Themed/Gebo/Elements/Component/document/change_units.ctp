<form action="#" id='form_document' method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
<div class="control-group">
											<div class="">
												<label for="textfield" class="control-label">เสนอ : </label>
												<div class="controls">
													<input type="textbox" name="unit" id='unit' placeholder="หน่วยงาน"  style=";" class=''
                            		 onkeyup="return unitKeyUp('unit',event)" onblur="selectbyunit(this)"
                            		 >
												<?php
                                                                echo $this->Form->input('to_unit', array(
                                                                'style'=>'position:absolute;top:-1000px;',
                                                                    'label' => false,
                                                                    'div' => true,
                                                                    'placeholder' => 'ถึง',
																	'options' => $units,
								'empty' => ' - - - หน่วย - - - ',
                                                                    

                                                                ));
                                                            ?>   
												</div>
											</div>
											</form>
<script language='javascript'>
function modalAction2(){
			
                        var id = $("#doc_id").val();
			
				  
					var url = "../../Document/save_unit/<?php echo $id;?>";
					var data = new FormData($("#form_document")[0]);
					
						 $.ajax( {
							  url: url,
							  type: 'POST',
							  data: data,
							  processData: false,
							  contentType: false,
							  success: function(response) {
								   
									result = response;
									// return response; // <- tried that one as well
									  $(".close").trigger( "click" );					
									window.location.reload();
								}
							} );
					

						
				  
				 
		}
		function unitKeyUp(obj,e) {

			//console.log(e.which);	
			//console.log(obj);
			//if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 8;
			//if($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength){
			if(($("#" + obj).val().length >= triggerMinLength && $("#" + obj).val().length <= triggerMaxLength) || e.which == 32){
				
				var obj_id = $("#" + obj).attr("id");
				//console.log(obj_id);
				var obj_value = $("#" + obj).val();
				var url = "/../../Units/getDataUnit";

				$.post(	url,{
						value:obj_value,
						field:'title'
						},
						function(data){

							var json = $.parseJSON(data);
							var autocomplete = $("#"+obj_id).typeahead();
							autocomplete.data('typeahead').source = json;

						}
						,"html"
				);

			}

		}
		function selectbyunit(objUnit){
	//alert($(objUnit).val());
	$('select[id="to_unit"] > option:contains("' + $(objUnit).val() + '")').attr("selected", "selected");
	//alert($('select[id="to_unit"] > option:contains("' + $(objUnit).val() + '")').val());
	$("#to_unit option[text='" + $(objUnit).val() + "']").attr("selected", "selected");
}
</script>