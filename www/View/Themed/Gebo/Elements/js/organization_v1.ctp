<script type="text/javascript">

            $(".add").click(function(){

                var id = $(this).attr("value");
                addData(id);
            });

            $(".viewProperty").click(function(){

                var id = $(this).attr("value"); 
                viewProperty(id);
            });
			    
            $(".viewEquipment").click(function(){

                var id = $(this).attr("value");              
                viewEquipment(id);
            });                      

            $(".viewTraing").click(function(){

                var id = $(this).attr("value"); 
                viewTraing(id);
            }); 
     
			//
            function addData(){
				  alert('ddd');
				  $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างยุทโธปกรณ์ใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Organizations/form",function(data) {
						$('#customModal2').html(data);
				  });                        
        
				  $("#myModal2").css({
								"width":"1200px",
								"top":"7%",
								"left":"300px"
				  });
				  
				  $("#customModal2").css({
								"max-height":"500px"
				  });   	
        
            }    

            function viewProperty(){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างยุทโธปกรณ์ใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Organizations/viewProperty/"+id,function(data) {
						$('#customModal2').html(data);
				  });                        
        
				  $("#myModal2").css({
								"width":"1200px",
								"top":"7%",
								"left":"300px"
				  });
				  
				  $("#customModal2").css({
								"max-height":"500px"
				  });   	
        
            }        

            function viewEquipment(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลยุทโธปกรณ์');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Organizations/viewEquipment/"+id,function(data) {
						$('#customModal2').html(data);
				  });
                                  
				  $("#myModal2").css({
								"width":"1200px",
								"top":"7%",
								"left":"300px"
				  });
				  
				  $("#customModal2").css({
								"max-height":"500px"
				  });                                     

            }

            function viewTraing(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลยุทโธปกรณ์');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Organizations/html/"+id,function(data) {
						$('#customModal2').html(data);
				  });
                                  
				  $("#myModal2").css({
								"width":"1200px",
								"top":"7%",
								"left":"300px"
				  });
				  
				  $("#customModal2").css({
								"max-height":"500px"
				  });                                     

            }

            function viewOrganization(id){

				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลยุทโธปกรณ์');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Organizations/html/"+id,function(data) {
						$('#customModal2').html(data);
				  });
                                  
				  $("#myModal2").css({
								"width":"1200px",
								"top":"7%",
								"left":"300px"
				  });
				  
				  $("#customModal2").css({
								"max-height":"500px"
				  });                                   

            }

	$("#create_1").click(function () { 
		$("#demo1").jstree("create"); 
	});


	$("#organizations").jstree({ 
		"json_data" : {
			"data" : [
				{ 
					"data" : "กองทัพภาค ที่ 1", 
					"metadata" : { id : 23 },
					"children" : [ "มทบ. 11", "มทบ. 12", "มทบ. 13", "มทบ. 14"  ]
				},
				{ 
					"attr" : { "id" : "li.node.id1" }, 
					"data" : { 
						"title" : "กองทัพภาค ที่ 2", 
						"attr" : { "href" : "#" } 
					},"children" : [ "มทบ. 21", "มทบ. 22", "มทบ. 23", "มทบ. 24"  ] 
				},
				{ 
					"attr" : { "id" : "li.node.id2" }, 
					"data" : { 
						"title" : "กองทัพภาค ที่ 3", 
						"attr" : { "href" : "#" } 
					},"children" : [ "มทบ. 31", "มทบ. 32", "มทบ. 33"  ] 
				},
				{ 
					"attr" : { "id" : "li.node.id3" }, 
					"data" : { 
						"title" : "กองทัพภาค ที่ 4", 
						"attr" : { "href" : "#" } 
					},"children" : [ "มทบ. 41", "มทบ. 42"  ] 
				},
				{ 
					"attr" : { "id" : "li.node.id4" }, 
					"data" : { 
						"title" : "กองทัพภาค ที่ 5", 
						"attr" : { "href" : "#" } 
					},"children" : [ "มทบ. 51", "มทบ. 52" ] 
				}
			]
		},
		"dnd" : {
			"drop_finish" : function () { 
				alert("DROP"); 
			},
			"drag_check" : function (data) {
				if(data.r.attr("id") == "phtml_1") {
					return false;
				}
				return { 
					after : false, 
					before : false, 
					inside : true 
				};
			},
			"drag_finish" : function (data) { 
				alert("DRAG OK"); 
			}
		},
		"crrm" : { 
			"move" : {
				"check_move" : function (m) { 
					var p = this._get_parent(m.o);
					if(!p) return false;
					p = p == -1 ? this.get_container() : p;
					if(p === m.np) return true;
					if(p[0] && m.np[0] && p[0] === m.np[0]) return true;
					return false;
				}
			}
		},
		"plugins" : [ "themes", "json_data", "ui", "contextmenu", "crrm", "dnd" ]
	}).bind(
		"select_node.jstree", function (e, data) { 
				
			//alert(data.rslt.obj.data("id"));
			id = data.rslt.obj.data("id");
			//viewOrganization(id);
			$('#organizationDetail').load("../../Organizations/detail/"+id,function(data) {
				$('#organizationDetail').html(data);
			});

		}
	);

	$("#modelp1").click(function(event){

		$('.modal-body').load("/Models/detailInfo",function(data) {

		});
		
	});

	$("#modelp2").click(function(event){

		$('.modal-body').load("/Models/detailInfo",function(data) {

		});
		
	});

	$("#modelp3").click(function(event){

		$('.modal-body').load("/Trainings",function(data) {

		});
		
	});

</script>