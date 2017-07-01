<script type="text/javascript">

		//var cache = {};

		//function getDataCache(s)
		//{
		//	if (cache.hasOwnProperty(s))
		//	{
		//		return $(cache[s]);
		//	}
		//}

		//function setDataCache(s,v)
		//{
		//	cache[s] = v;
		//}

		$(".model_code").keyup(function(e) {

			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 5;
			if($(this).val().length >= triggerMinLength && $(this).val().length <= triggerMaxLength){
				
				var obj_id = $(this).attr("id");
				var obj_value = $(this).attr("value");
				var url = "/../../ModelRates/getData/ModelRate";

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

		});

		//$("#ModelProperties131223171057981003ModelDivisionName").keyup(function(e) {
		$(".model_division").keyup(function(e) {

			//console.log(e.which);	
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 5;
			if($(this).val().length >= triggerMinLength && $(this).val().length <= triggerMaxLength){
				
				var obj_id = $(this).attr("id");
				var obj_value = $(this).attr("value");
				var url = "/../../ModelRates/getData/Division";

				$.post(	url,{
						value:obj_value
						},
						function(data){

							var json = $.parseJSON(data);
							var autocomplete = $("#"+obj_id).typeahead();
							autocomplete.data('typeahead').source = json;

						}
						,"html"
				);

			}

		});

		$(".model_position").keyup(function(e) {

			//console.log(e.which);	
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 5;
			if($(this).val().length >= triggerMinLength && $(this).val().length <= triggerMaxLength){
				
				var obj_id = $(this).attr("id");
				var obj_value = $(this).attr("value");
				var url = "/../../ModelRates/getData/Position";

				$.post(	url,{
						value:obj_value
						},
						function(data){

							var json = $.parseJSON(data);
							var autocomplete = $("#"+obj_id).typeahead();
							autocomplete.data('typeahead').source = json;

						}
						,"html"
				);

			}

		});

		$(".model_weapon").keyup(function(e) {

			//console.log(e.which);	
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 5;
			if($(this).val().length >= triggerMinLength && $(this).val().length <= triggerMaxLength){
				
				var obj_id = $(this).attr("id");
				var obj_value = $(this).attr("value");
				var url = "/../../ModelRates/getData/Weapon";

				$.post(	url,{
						value:obj_value
						},
						function(data){

							var json = $.parseJSON(data);
							var autocomplete = $("#"+obj_id).typeahead();
							autocomplete.data('typeahead').source = json;

						}
						,"html"
				);

			}

		});

		$(".model_equipment").keyup(function(e) {

			//console.log(e.which);	
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 5;
			if($(this).val().length >= triggerMinLength && $(this).val().length <= triggerMaxLength){
				
				var obj_id = $(this).attr("id");
				var obj_value = $(this).attr("value");
				var url = "/../../ModelRates/getData/Equipment";

				$.post(	url,{
						value:obj_value
						},
						function(data){

							var json = $.parseJSON(data);
							var autocomplete = $("#"+obj_id).typeahead();
							autocomplete.data('typeahead').source = json;

						}
						,"html"
				);

			}

		});
		
		//var typeaheadSource = [{ id: 1, name: 'John'}, { id: 2, name: 'Alex'}, { id: 3, name: 'Terry'}];
		//$('#ModelRateShortName').typeahead({
		//	source: typeaheadSource
		//});

		//--------------------------------------------		

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
				$('#saveModelProperty').submit();
				var formAction = 'saveModelProperty';
				var controller = 'ModelProperties';
				var action = 'saveModelProperty';
				var is_submit = true;
			
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
							$('#message').text(data.message);
							$(".alert").show();
						}
						,"html"
				);
			}

		}

		$("#close").click(function(){		   
			$(".alert").hide();
		});
		
		//editviewDocument
		//---------------------------------------------------------------------------------------



		//editviewProperty
		//---------------------------------------------------------------------------------------
		function addDivision(){

			var model_id = $("input[name='data[ModelRate][id]']").val();
			var model_type_id = $("input[name='data[ModelRate][model_type_id]']").val();

			var key_division = $("#addDivision").attr("key_division");
			if(key_division == 0) $('#division_'+key_division).remove();

			var model = 'division';		 
			var url = "../../ModelRates/append";
							
			$.post(url,{
				model_id:model_id,
				model_type_id:model_type_id,
				model:model,
			},function(data){
				$(data).insertAfter("#propertyTable tr:last");
				//$('#'+short_model+'_current_no').val(index);
			},"html");

		}

		function addSubDivision(model_division_id){

			var model_id = $("input[name='data[ModelRate][id]']").val();
			var model_type_id = $("input[name='data[ModelRate][model_type_id]']").val();

			//var key_division = $("#addDivision").attr("key_division");
			//if(key_division == 0) $('#division_'+key_division).remove();
			//alert(model_division_id);
			
			var url = "../../ModelRates/lastModelSubDivision";								
			$.post(url,{
				model_id:model_id,
				model_division_id:model_division_id,
			},function(model_subdivision_id){
					//alert('model_subdivision_id = ' + model_subdivision_id);

					var url = "../../ModelRates/lastModelPosition";
					$.post(url,{
						model_id:model_id,
						model_type_id:model_type_id,
						model_division_id:model_subdivision_id,
					},function(model_position_id){
						//alert('model_position_id = ' + model_position_id);

						var url = "../../ModelRates/lastModelProperty";
						$.post(url,{
							model_id:model_id,
							model_type_id:model_type_id,
							model_division_id:model_subdivision_id,
							model_position_id:model_position_id,
						},function(model_property_id){
							//alert('model_property_id = ' + model_property_id);
												
							var model = 'subdivision';		 
							var url = "../../ModelRates/append";
										
							$.post(url,{
								model_id:model_id,
								model_type_id:model_type_id,
								model_division_id:model_division_id,
								model:model,
							},function(data){
								//$(data).insertAfter('#subdivision_'+model_division_id);
				
								if(model_subdivision_id != ''){
									if(model_position_id != ''){
										if(model_property_id != ''){
											//$(data).insertAfter("#position_"+model_position_id);
											$(data).insertAfter("#position_"+model_position_id+"_property_"+model_property_id);
										}else{
											$(data).insertAfter("#position_"+model_position_id);
										}
									}else{
										$(data).insertAfter("#subdivision_"+model_subdivision_id);
									}
								}else{
									$(data).insertAfter("#division_"+model_division_id);
								}

							},"html");

						},"html");
	
					},"html");

			},"html");

		}

		function addPosition(model_division_id){
			
			var model_id = $("input[name='data[ModelRate][id]']").val();
			var model_type_id = $("input[name='data[ModelRate][model_type_id]']").val();
			
			var url = "../../ModelRates/lastModelPosition";
			$.post(url,{
				model_id:model_id,
				model_type_id:model_type_id,
				model_division_id:model_division_id,
			},function(model_position_id){

				var url = "../../ModelRates/lastModelProperty";
				$.post(url,{
					model_id:model_id,
					model_type_id:model_type_id,
					model_division_id:model_division_id,
					model_position_id:model_position_id,
				},function(model_property_id){
						
					var model = 'position';
					var url = "../../ModelRates/append";

					$.post(url,{
						model_id:model_id,
						model_type_id:model_type_id,
						model_division_id:model_division_id,
						model:model,
					},function(data){
						if(model_property_id == ''){
							if(model_position_id == ''){
								if(model_type_id==1){
									$(data).insertAfter("#division_"+model_division_id);
								}else if(model_type_id==2){
									$(data).insertAfter("#subdivision_"+model_division_id);
								}
							}else{
								$(data).insertAfter("#position_"+model_position_id);
							}
						}else{
							$(data).insertAfter("#position_"+model_position_id+"_property_"+model_property_id);
						}
					},"html");

				},"html");

			},"html");

		}

		function addProperty(model_division_id,model_position_id){

			var model_id = $("input[name='data[ModelRate][id]']").val();
			var model_type_id = $("input[name='data[ModelRate][model_type_id]']").val();

			var url = "../../ModelRates/lastModelProperty";								
			$.post(url,{
				model_id:model_id,
				model_division_id:model_division_id,
				model_position_id:model_position_id,				
			},function(model_property_id){

				var model = 'property';
				var url = "../../ModelRates/append";
								
				$.post(url,{
					model_id:model_id,
					model_type_id:model_type_id,
					model_division_id:model_division_id,
					model_position_id:model_position_id,
					model:model,
				},function(data){
					if(model_property_id == ''){
						$(data).insertAfter("#position_"+model_position_id);
					}else{
						$(data).insertAfter("#position_"+model_position_id+"_property_"+model_property_id);
					}
				},"html");	

			},"html");

		}


									
		//$(".deleteRow").click(function(){ 
		//	$(this).parent().parent().remove()
		//});                                                           

		function deleteRowRank(source){
		   source.parentNode.parentNode.remove();
		}

		$('.model_division').typeahead({                                
		  name: 'division',                                                          
		  prefetch: '../../ModelRates/getData/ModelDivision',                                         
		  limit: 10                                                                   
		});

		$(".model_division-").autocomplete('../../ModelRates/getData/ModelDivision', {
			minChars: 3
		});
		

		//editviewEquipment
		//---------------------------------------------------------------------------------------
		function addEquipment(model_division_id){

			var model_id = $("input[name='data[ModelRate][id]']").val();
			var model_type_id = $("input[name='data[ModelRate][model_type_id]']").val();

			var url = "../../ModelRates/lastModelEquipment";								
			$.post(url,{
				model_id:model_id,
				model_division_id:model_division_id,
			},function(model_equipment_id){

				var model = 'equipment';
				var url = "../../ModelRates/append";
								
				$.post(url,{
					model_id:model_id,
					model_type_id:model_type_id,
					model_division_id:model_division_id,
					model:model,
				},function(data){
					if(model_equipment_id == ''){
						$(data).insertAfter("#section2division_"+model_division_id);
					}else{
						$(data).insertAfter("#section2division_"+model_division_id+"_equipment_"+model_equipment_id);
					}
				},"html");	

			},"html");

			/*
			var model = 'equipment';		 
			var url = "../../ModelRates/append";
							
			$.post(url,{
				model_id:model_id,
				model:model,
			},function(data){
				//$('#'+short_model).append(data);
				$(data).insertAfter("#equipmentTable tr:last");
			},"html");
			*/

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
				}
			},"html");	
						
		}

</script>