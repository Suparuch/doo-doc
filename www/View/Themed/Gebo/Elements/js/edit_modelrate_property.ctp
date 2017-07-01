<script type="text/javascript">

		/*
		var cache = {};

		function getDataCache(s)
		{
			if (cache.hasOwnProperty(s))
			{
				return $(cache[s]);
			}
		}

		function setDataCache(s,v)
		{
			cache[s] = v;
		}
		*/

		function modelDivisionKeyup(obj,e) {


			//console.log(e.which);	
			//if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 1;
			var triggerMaxLength = 20;
			//if($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength){
			if(($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength) || e.which == 32){
				
				var obj_id = $(obj).attr("id");
				var obj_value = $(obj).val();
				var url = "/../../ModelRates/getData/Division";


				$.post(	url,{
						value:obj_value,
						field:"name"
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

		function modelSubDivisionKeyup(obj,e) {

			//console.log(e.which);	
			//if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 20;
			//if($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength){
			if(($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength) || e.which == 32){
				
				var obj_id = $(obj).attr("id");
				var obj_value = $(obj).val();
				var url = "/../../ModelRates/getData/SubDivision";

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

		}

		function modelPositionKeyup(obj,e) {

			//console.log(e.which);	
			//if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 20;
			//if($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength){
			if(($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength) || e.which == 32){
				
				var obj_id = $(obj).attr("id");
				var obj_value = $(obj).val();
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

		}

		function modelWeaponKeyup(obj,e) {

			//console.log(e.which);	
			//if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 2;
			var triggerMaxLength = 10;
			//if($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength){
			if(($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength) || e.which == 32){
				
				var obj_id = $(obj).attr("id");
				var obj_value = $(obj).val();
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

		}		

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
					/*$('#customModal2').load("../../ModelRates/editModelRate/"+model_id,function(data) {
						$('#customModal2').html(data);
						http://dopns.pakgon.com/ModelRates/
				  });*/
				  var url = "../../ModelRates/editRateProperty";
				/*  $.post(	url,{
							model_id:model_id
							},
							function(data){
								$('#tabProperty').html(data);
								$('#tabProperty').attr("status","load");
							}
							,"html"
					);
*/
		

		}

		function addSubDivision(model_division_id){

			var model_id = $("input[name='data[ModelRate][id]']").val();
			var model_type_id = $("input[name='data[ModelRate][model_type_id]']").val();
			
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
							model_division_id:model_division_id,
							model_position_id:model_position_id,
							model_subdivision_id:model_subdivision_id,
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
								$(data).insertAfter('#subdivision_'+model_division_id);
				
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
								 var url = "../../ModelRates/editRateProperty";
				 

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
 				 var url = "../../ModelRates/editRateProperty";
/*
				  $.post(	url,{
							model_id:model_id
							},
							function(data){
							
								$('#tabProperty').html(data);
								$('#tabProperty').attr("status","load");
							}
							,"html"
					);
*/

		}

		function addProperty(model_division_id,model_position_id,model_subdivision_id){

			var model_id = $("input[name='data[ModelRate][id]']").val();
			var model_type_id = $("input[name='data[ModelRate][model_type_id]']").val();

			var url = "../../ModelRates/lastModelProperty";								
			$.post(url,{
				model_id:model_id,
				model_type_id:model_type_id,
				model_division_id:model_division_id,
				model_position_id:model_position_id,
				model_subdivision_id:model_subdivision_id,
			},function(model_property_id){
				//alert('model_property_id = ' + model_property_id);

				var model = 'property';
				var url = "../../ModelRates/append";
								
				$.post(url,{
					model_id:model_id,
					model_type_id:model_type_id,
					model_division_id:model_division_id,
					model_position_id:model_position_id,
					model_subdivision_id:model_subdivision_id,
					model:model,
				},function(data){
					if(model_property_id == ''){
						$(data).insertAfter("#position_"+model_position_id);
					}else{
						$(data).insertAfter("#position_"+model_position_id+"_property_"+model_property_id);
					}
				},"html");	

			},"html");
 var url = "../../ModelRates/editRateProperty";
/*
				  $.post(	url,{
							model_id:model_id
							},
							function(data){
								$('#tabProperty').html(data);
								$('#tabProperty').attr("status","load");
							}
							,"html"
					);
*/

		}

</script>