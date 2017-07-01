
<script type="text/javascript">
		
		function modelEquipmentKeyup(obj,e) {

			//console.log(e.which);	
			if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
			
			var triggerMinLength = 3;
			var triggerMaxLength = 20;
			if(($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength) || e.which == 32){
				
				var obj_id = $(obj).attr("id");
				var obj_value = $(obj).val();
				var url = "/../../ModelRates/getData/Equipment";

				$.post(	url,{
						value:obj_value
						},
						function(data){

							var json = $.parseJSON(data);
							//autocomplete.data('typeahead').source = json;
							var autocomplete = $("#"+obj_id).typeahead();
							autocomplete.data('typeahead').source = json;

						}
						,"html"
				);

			}

		}
		
		function modelEquipmentFocus(obj,e) {
			var obj_id = $(obj).attr("id");
				var obj_value = $(obj).val();
				if (obj_value.indexOf(" - ") >= 0){
					var array = obj_value.split(' - ');
						$("#" + obj_id).val(array[1]);
						$("#" + obj_id.replace("Name","Code")).val(array[0]);
					}
				
		}
		
		function modelEquipmentCodeFocus(obj,e) {
				var obj_id = $(obj).attr("id");
				var obj_value = $(obj).val();
				if (obj_value.indexOf(" - ") >= 0){
					var array = obj_value.split(' - ');
						$("#" + obj_id).val(array[0]);
						$("#" + obj_id.replace("Code","Name")).val(array[1]);
					}
				
		}
		
		
		function removeCode(obj,e){
		}
		
		//editviewEquipment
		//---------------------------------------------------------------------------------------
		function addDivisionEquipment(){

			var model_id = $("input[name='data[ModelRate][id]']").val();
			var model_type_id = $("input[name='data[ModelRate][model_type_id]']").val();

			var key_division = $("#addDivision").attr("key_division");
			if(key_division == 0) $('#division_'+key_division).remove();

			var model = 'division_equipment';	 
			var url = "../../ModelRates/append";
							
			$.post(url,{
				model_id:model_id,
				model_type_id:model_type_id,
				model:model,
			},function(data){
				$(data).insertAfter("#equipmentTable tr:last");
			},"html");
$('#customModal2').load("../../ModelRates/editModelRate/"+model_id,function(data) {
						$('#customModal2').html(data);
				  });
				m=setTimeout("$('a[href=\"#tabEquipment\"]').trigger('click')",2000);

		}

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
$('#customModal2').load("../../ModelRates/editModelRate/"+model_id,function(data) {
						$('#customModal2').html(data);
				  });
				m=setTimeout("$('a[href=\"#tabEquipment\"]').trigger('click')",2000);

		}
		
</script>