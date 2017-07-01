<script type="text/javascript">
		
		$('#customModalAction2').show();
		function modalAction2_(){
			
				var id = $("input[name='data[ModelRate][id]']").val();
				var code = $("input[name='data[ModelRate][code]']").val();
				var name = $("input[name='data[ModelRate][name]']").val();
				var short_name = $("input[name='data[ModelRate][short_name]']").val();
				var model_date_year = $("[name='data[ModelRate][model_date][year]'] option:selected").val();
				var model_date_month = $("[name='data[ModelRate][model_date][month]'] option:selected").val();
				var model_date_day = $("[name='data[ModelRate][model_date][day]'] option:selected").val();
				var model_date = model_date_year + '-' + model_date_month + '-' + model_date_day;
				var comment = $("textarea[name='data[ModelRate][comment]']").val();
				var model_type_id = $("input[name='model_type_id']").val();

				if(code != "" && name != "" && short_name != ""){
					
						var url = "../../ModelRates/saveModelRate/"+id;
						$.post(url,{
							code:code,
							name:name,
							short_name:short_name,
							model_date:model_date,
							comment:comment,
							model_type_id:model_type_id
		
						},function(data){
							alert(data.id);
							
							if(data.status == "SUCCESS"){
								var row='<tr><td><input type="checkbox" name="dataID[]" value="1022"></td><td>'+code+'</td><td>'+model_date+'</td><td>'+short_name+'</td><td>-</td><td>-</td><td>-</td></tr>';
								$(row).insertAfter("#mainTable tr:first");
								$('#myModal2').modal('hide');

								return false;
								//$(".close").trigger( "click" );					
								//window.location="../../ModelRates/index";
							}else{
								alert("บันทึกไม่สำเร็จ");
							}
							
						}, "json");
						
						
				  }
				  else { alert('บันทึกไม่สำเร็จ');}
		}

		function modalAction2(){			

			var currentTab = $('#currentTab').val();
			var is_submit = false;
			if(currentTab == 'Model'){
				var formAction = 'saveModelRate';
				var controller = 'ModelRates';
				var action = 'saveModelRate';
				var is_submit = true;
			}

			if(is_submit == true){

				var url = "../../"+controller+"/"+action;
				//alert(url);
								
				$.post(	url,
						$('#'+formAction).serialize(),
						function(data){
							alert(data.message);
							model_id = data.id
							$('#message').text(data.message);
							$(".alert").show();
							
							var model_id = data.id;
							addModel(model_id);
							$(".close").trigger( "click" );
							//$("input[name='data[ModelRate][id]']").val(model_id);
							//$("#model_id").attr("value",model_id);
							
						}
						,"json"
				);
			}

		}

		$(".alert").hide();

		$("#close").click(function(){		   
			$(".alert").hide();
		});

</script>
