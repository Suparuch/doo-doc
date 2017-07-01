<script type="text/javascript">

		//--------------------------------------------
		//$('#buttomAction2').html('<a id="buttomAction1" href="javascript:void(0)" class="btn">Print</a>');
		$('#customModalAction2').show();
		$(".alert").hide();
		$(".changeTab").click(function(){
		   
			var currentTab = $(this).attr("value");
			$('#currentTab').val(currentTab);
			
			$(".alert").hide();
			if(currentTab == 'Document' || currentTab == 'Organization'){
				$('#customModalAction2').hide();
			}else{
				$('#customModalAction2').show();
				var model_id = $("input[name='data[ModelRate][id]']").val();
				changeTab(currentTab,model_id)
			}
			
		});

		function changeTab(currentTab,model_id){
			
			var controller = '';
			var action = '';
			if(currentTab == 'Property'){
				controller = 'ModelRates';
				action = 'editRateProperty';
			}else if(currentTab == 'Equipment'){
				controller = 'ModelRates';
				action = 'editRateEquipment';
			}
			
			if(controller != ''){

				var statusTab = $('#tab'+currentTab).attr("status");
				if(statusTab != 'load'){

					var url = "../../"+controller+"/"+action;
									
					$.post(	url,{
							model_id:model_id
							},
							function(data){
								$('#tab'+currentTab).html(data);
								$('#tab'+currentTab).attr("status","load");
							}
							,"html"
					);
				}
			}
	
		}

		$("#close").click(function(){		   
			$(".alert").hide();
		});

		function modalAction2(){			

			var currentTab = $('#currentTab').val();
			var is_submit = false;
			if(currentTab == 'Model'){
				//$('#saveModelRate').submit();
				var formAction = 'saveModelRate';
				var controller = 'ModelRates';
				var action = 'saveModelRate';
				var is_submit = true;

			}else if(currentTab == 'Property'){
				//$('#saveModelProperty').submit();
				var model_type_id = $("input[name='model_type_id']").val();
				var formAction = 'saveModelProperty';
				var controller = 'ModelProperties';
				var is_submit = true;
				if(model_type_id == 1){
					var action = 'saveModelProperty';
				}else if(model_type_id == 2){
					var action = 'saveModelSpecialProperty';			
				}
			}else if(currentTab == 'Equipment'){
				//$('#saveModelEquipment').submit();
				var formAction = 'saveModelEquipment';
				var controller = 'ModelEquipments';
				var action = 'saveModelEquipment';
				var is_submit = true;

			}else if(currentTab == 'ModelGroup'){
				//$('#saveModelGroup').submit();
				var formAction = 'saveModelGroup';
				var controller = 'ModelGroups';
				var action = 'saveModelGroup';
				var is_submit = true;
			}

			if(is_submit == true){

				var url = "../../"+controller+"/"+action;
								
				$.post(	url,
						$('#'+formAction).serialize(),
						function(data){
							alert(data);
							$('#message').text(data);
							$(".alert").show();
						}
						,"html"
				);
			}

		}

		//---------------------------------------------------------------------------------------
		function deleteItem(model,id,reference_id){

			//alert(model + ' - ' + reference_id + ' - ' + id);
			var model_type_id = $("input[name='data[ModelRate][model_type_id]']").val();
			var url = "../../ModelRates/deleteItem";

			$.post(url,{
				id:id,
				model:model,
			},function(data){
				//alert(data);
				if(model == 'division'){	
					$('#division_'+id).remove();
				}else if(model == 'subdivision'){
					$('#subdivision_'+id).remove();
				}else if(model == 'position'){
					$('#position_'+id).remove();
				}else if(model == 'property'){			
					$('#position_'+reference_id+'_property_'+id).remove();			
				}else if(model == 'equipment'){
					$('#section2division_'+ reference_id +'_equipment_'+id).remove();			
				}else if(model == 'modelgroup'){
					$('#modelgroup_'+ id).remove();			
				}
			},"html");	
						
		}

		//editviewModelGroup
		//---------------------------------------------------------------------------------------
		function addModelGroup(){

			var model_id = $("input[name='data[ModelRate][id]']").val();

			var model = 'modelgroup';
			var url = "../../ModelRates/append";
							
			$.post(url,{
				model_parent_id:model_id,
				model:model,
			},function(data){
				$(data).insertAfter("#modelGroupTable tr:last");
			},"html");	

		}

		function modelOnChange(obj,e) {

			var menu = $("#" + obj).next(".typeahead");
			if(menu!="undefined")
			{
				objId = $(menu).find(".active").attr("data-value");
				$("#" + obj).prev().val(objId);
				$("#" + obj).prev().attr("value",objId);
				//objId = "1";
			}
			
			var obj_id = $("#" + obj).attr("id");

			var obj_value = $("#" + obj).val();
			var obj_arr = obj_value.split(" (");
			
			code = obj_arr[0];
			
			model_date = obj_arr[1].replace(")", "");

			$("#"+obj_id).attr("value",code);
			
			var url = "/../../ModelRates/getDataModelDetail";
			
			$.post(	url,{
					model_id:objId,
					code:code,
					model_date:model_date
					},
					function(data){

						var json = $.parseJSON(data);
						id   = json['id'];
						code = json['code'];
						name = json['name'];
						
						obj_model_id = obj_id.replace("Code", "ModelId");
						$("#"+obj_model_id).attr("value",id);

						obj_name = obj_id.replace("Code", "Name");
						$("#"+obj_name).attr("value",name);

						obj_quantity = obj_id.replace("Code", "Quantity");
						$("#"+obj_quantity).focus();

					}
					,"html"
			);

		}

		//on
		function modelOnBlur(obj,e) {

				var obj_id = $(obj).attr("id");
				var obj_value = $(obj).attr("value");
				var url = "/../../ModelRates/getData/ModelRate";

				$.post(	url,{
						value:obj_value,
						field:'code'
						},
						function(data){
							var json = $.parseJSON(data);
							code = json['0']['code'];
							//code = json['0']['code'];
							//alert(json['0']['code']);
							obj_id = obj_id.replace("Code", "Name");
							$("#"+obj_id).attr("value",code);
							obj_id = obj_id.replace("Name", "Quantity");
							$("#"+obj_id).focus();
						}
						,"html"
				);
		}

		function modelKeyup(obj,e) {

			//console.log(e.which);	
			//if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 8;
			//if($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength){
			if(($("#" + obj).val().length >= triggerMinLength && $("#" + obj).val().length <= triggerMaxLength) || e.which == 32){
				
				var obj_id = $("#" + obj).attr("id");
				var obj_value = $("#" + obj).val();
				var url = "/../../ModelRates/getDataModel";

				$.post(	url,{
						value:obj_value,
						field:'code'
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
		


</script>