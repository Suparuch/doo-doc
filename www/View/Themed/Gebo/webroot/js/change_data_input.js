		$('#province_id_').change(function()
		{
			var province_id = $('#province_id').val();
			$('.input-zone').load("getZone/"+province_id,function(data) {
					$('.input-zone').html(data);
			 });  
		 
			 //$('.input-district').load("getDistrict/",function(data) {
			 //		$('.input-district').html(data);
			 //});  
        
		});


		$('#zone_id_').change(function()
		{
			var zone_id = $('#zone_id').val();
			$('.input-district').load("getDistrict/"+zone_id,function(data) {
					$('.input-district').html(data);
			 });                        
        
		});

		function provinceChange(province_id,view){
		
			if(view != '') view = view +'-';
			$('.'+view+'input-zone').load("../../Zones/getZone/"+province_id,function(data) {
					$('.'+view+'input-zone').html(data);
			});  
		 
			//$('.'+view+'input-district').load("../../District/getDistrict/",function(data) {
			//		$('.'+view+'input-district').html(data);
			//});
		
		}

		function zoneChange(zone_id,view){
			
			if(view != '') view = view +'-';
			$('.'+view+'input-district').load("../../Districts/getDistrict/"+zone_id,function(data) {
					$('.'+view+'input-district').html(data);
			});    		
		
		}