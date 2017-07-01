			function screenModalDefault(window_width,window_height){
				  
				  var $window = $(window);
				  if(window_width == '' || window_width == null) window_width = $window.width() - 15;
				  if(window_height == '' || window_height == null) window_height = $window.height() - 180;
				  $("#myModal2").css({
						"width":"560px",
						"top":"6%",
						"left":"50%"
				  });
				  
				  $(".modal-body").css({
						"min-height":"50px",
						"max-height":window_height+"px",
						//"height":window_height+"px"
				  });

			}

			function screenModalMedium(window_width,window_height){
				  
				  var $window = $(window);
				  if(window_width == '' || window_width == null) window_width = $window.width() - 15;
				  if(window_height == '' || window_height == null) window_height = $window.height() - 180;
				  $("#myModal2").css({
						"width":"700px",
						"top":"6%",
						"left":"50%"
				  });
				  
				  $(".modal-body").css({
						"min-height":"200px",
						"max-height":window_height+"px",
						//"height":window_height+"px"
				  });			

			}

			function screenModalFull(window_width,window_height){

				  var $window = $(window);
				  if(window_width == '' || window_width == null) window_width = $window.width() - 15;
				  if(window_height == '' || window_height == null) window_height = $window.height() - 180;
				  $("#myModal2").css({
						//"width":"1248px",
						"width":window_width+"px",
						//"top":"5%",
						"top":"40px",
						"left":"280px"
				  });
				  
				  $(".modal-body").css({
						"min-height":"500px",
						"max-height":window_height+"px",
						//"height":window_height+"px"
				  });

			}