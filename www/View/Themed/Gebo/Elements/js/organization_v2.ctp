<script type="text/javascript">

	
	$(".changeOrganizationType").click(function(){	   
		var organization_type = $(this).attr("value");
		changeOrganizationType(organization_type);
	});  

	function changeOrganizationType(organization_type){
		  
		  var flagload = $('.tab_organization_type_'+organization_type).attr("flagload");
		  if(flagload != 'Y'){
			  $('#organization_type_'+organization_type).load("../../Organizations/organizationType/"+organization_type,function(data) {
					$('#organization_type_'+organization_type).html(data);
					$('.tab_organization_type_'+organization_type).attr("flagload",'Y');
					organizationTree(organization_type);
			  });
		  }
	}

	changeOrganizationType(1);

	function editData(organization_type,organization_id){
		  $("#detailviewOrganization_"+organization_type).load("../../Organizations/editDetail/"+organization_id+"/"+organization_type);
	}

	//verrify
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

	function organizationTree(organization_type){

		$(".organization_type_tree_"+organization_type).jstree({ 
				"json_data": {
				"data" : [
					{
						"data" : {
							"title":'กองทัพบก',
							'attr':{
								"id":1,
								"href" : "#",
								'level':-1
							  
							}
						},
						"metadata" : { id : 0 },
						"state" : "closed",
						"attr":{
							"id":1,
							'level':1,
							'parent_id':-1
						}
					}
				],
				"ajax": {

					url: function (node) { 
					
						var nodeId = node.attr('id'); 
						if(node!=-1){
							return "/Organizations/getData/" + nodeId +'/'+organization_type;
						}
						else{
							return "/Organizations/getData/";
						}
					},
					type: "POST",
					contentType: "application/json;charset=utf-8",
					dataType: "json",
					data: function (n) {
						return { id: n.attr ? n.attr("id") : "0",level:n.attr('level') };
					},
					success: function (data, textstatus, xhr) {
						// alert(data)
					},
					error: function (xhr, textstatus, errorThrown) {
						// alert(textstatus);
					}
				}
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
			"core" : {
				 "initially_open" : [ 1 ]
			},
			"plugins" : [ "themes", "json_data", "ui", "contextmenu", "crrm", "dnd" ]
		}).bind(
			"select_node.jstree", function (e, data) { 
				
				//console.log(data);
				id = data.rslt.obj.attr("id");
				//viewOrganization(id);
				$('#organizationDetail'+organization_type).load("../../Organizations/detail/"+id+"/"+organization_type,function(data) {
					$('#organizationDetail'+organization_type).html(data);
				});

			}
		);

	}

	function viewRateProperty(model_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด อัตรากำลังพล');
		$('#customModalAction2').html('ปิด');
		$('#customModal2').load("../../ModelRates/detailRateProperty/"+model_id,function(data) {
			$('#customModal2').html(data);
		});                        
		modalFullScreen();   	

	}

	function viewRateEquipment(model_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด อัตราอาวุธและยุทโธปกรณ์');
		$('#customModalAction2').html('ปิด');
		$('#customModal2').load("../../ModelRates/detailRateEquipment/"+model_id,function(data) {
			//$('modal-body').html(data);
		});
		modalFullScreen();
		  
	}

	function changeRateProperty(organization_id,organization_type){

		$('#customModal2').html('');
		$('#customModalHeader2').html('แก้ไข อัตรากำลังพล');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../Organizations/editModelProperty/"+organization_id+'/'+organization_type,function(data) {
			//$('modal-body').html(data);
		});
		modalNormalScreen();
	}
	
	function changeRateEquipment(organization_id,organization_type){

		$('#customModal2').html('');
		$('#customModalHeader2').html('แก้ไข อัตราอาวุธและยุทโธปกรณ์');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../Organizations/editModelEquipment/"+organization_id+'/'+organization_type,function(data) {
			//$('modal-body').html(data);
		});
		modalNormalScreen();
	}

	function viewAssignProperty(organization_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด กำลังพล ที่บรรจุจริง');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../ModelRates/assignProperty/"+organization_id,function(data) {
			//$('modal-body').html(data);
		});
		modalFullScreen();
	}

	function viewAssignEquipment(organization_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด อัตราอาวุธและยุทโธปกรณ์ ที่บรรจุจริง');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../ModelRates/assignEquipment/"+organization_id,function(data) {
			//$('modal-body').html(data);
		});
		modalFullScreen();
	}

	function viewTraining(organization_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด การฝึก');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../Trainings/detail/"+organization_id,function(data) {
			//$('modal-body').html(data);
		});
		modalFullScreen();
	}

	function modalNormalScreen(){
		$("#myModal2").css({
			"width":"500px",
			"top":"7%",
			"left":"300px"
		});

		$(".modal-body").css({
			"max-height":"500px"
		});
	}

	function modalFullScreen(){
		$("#myModal2").css({
			"width":"1200px",
			"top":"7%",
			"left":"300px"
		});

		$(".modal-body").css({
			"max-height":"500px"
		});	
	}

</script>