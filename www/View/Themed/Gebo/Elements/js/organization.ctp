<?php
$AuthUser = $this->Session->Read('AuthUser');
$allow_add = 0;
$allow_del = 0;
if(isset($AuthUser['menulist']) && count($AuthUser['menulist'])>0){

	foreach($AuthUser['menulist'] as $menu){
	
		if($menu['action_id']=="6" && $menu['add']=="1")
			$allow_add=1;
		if($menu['action_id']=="6" && $menu['delete']=="1")
			$allow_del=1;
			
	}
}
?>
<script type="text/javascript">
	model_id = 0;
	$(".changeOrganizationType").click(function(){	   
		var organization_type = $(this).attr("value");
		changeOrganizationType(organization_type);
	});  

	function changeOrganizationType(organization_type){
		  
		//  var flagload = $('.tab_organization_type_'+organization_type).attr("flagload");
		  
		//  if(flagload != 'Y' || flagload=='undefined'){
			  $('#organization_type_'+organization_type).load("../../Organizations/organizationType/"+organization_type,function(data) {
					$('#organization_type_'+organization_type).html(data);
				//	$('.tab_organization_type_'+organization_type).attr("flagload",'Y');
					organizationTree(organization_type);
			  });
		//  }
	}

	organizationTree(0);
	
	
	changeOrganizationType(1);

	function editData(organization_type,organization_id){
		  $("#detailviewOrganization_"+organization_type).load("../../Organizations/editDetail/"+organization_id+"/"+organization_type);
	}

	//verrify
	/*
	function addData(){
		  //alert('ddd');
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
	*/

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
						//var p = this._get_parent(m.o);
						//if(!p) return false;
						//p = p == -1 ? this.get_container() : p;
						//if(p === m.np) return true;
						//if(p[0] && m.np[0] && p[0] === m.np[0]) return true;
						//return false;
						return true;
					}
				}
			},
			"contextmenu": {
					"items": function ($node) {
						return {
							"Create": {
								"label": "สร้าง หน่วยใหม่",
								"action": function (obj) {
									this.create(obj);
								}
							},
							
						

							//"Rename": {
							//	"label": "Rename an employee",
							//	"action": function (obj) {
							//		this.rename(obj);
							//	}
							//},
							
							/*
							"Copy": {
								"label": "คัดลอก หน่วย",
								"action": function (obj) {
									this.copy(obj);
								}
							},

							"Paste": {
								"label": "วาง หน่วย",
								"action": function (obj) {
									this.paste(obj);
								}
							},
							*/
							<?php
								if($allow_add=="1"){
							?>
							//"Insert": {
							//	"label": "เพิ่ม หน่วย",
							//	"action": function (obj) {
									//this.create(obj);
									//alert(obj.attr("id"));
							//		var organization_id = obj.attr("id");
//									$('#organizationDetail'+organization_type).load("../../Organizations/insertChild/"+organization_id+"/"+organization_type,function(data) {
	//									$('#organizationDetail'+organization_type).html(data);
		//								$('#name-'+organization_type).focus();
			//						});
//
	//							}
	//						},
							<?php
							}
							if($allow_del==1){
							?>
							"Delete": {
								"label": "ลบ หน่วย",
								"action": function (obj) {
									this.remove(obj);
								}
							}
							<?php
							}?>
						};
					}
			},
			"core" : {
				 "initially_open" : [ 1 ],
				 strings : { loading : "กำลังดึงข้อมูล ...", new_node : "หน่วยใหม่" }
			},
			"plugins" : [ "themes", "json_data", "ui", "contextmenu", "crrm", "dnd" ]
		})

		.bind(
			"select_node.jstree", function (e, data) { 
				
				//console.log(data);
				id = data.rslt.obj.attr("id");
				//viewOrganization(id);
				$('#organizationDetail'+organization_type).load("../../Organizations/detail/"+id+"/"+organization_type,function(data) {
					$('#organizationDetail'+organization_type).html(data);
				});

			}
		)
		
		.bind(
			"create.jstree", function (e, data) {
				//alert('create_node');
				//alert(data.rslt.parent.attr("id"));
				//alert(data.rslt.position);
				//alert(data.rslt.name);
				//alert(data.rslt.obj.attr("rel"));
				if(data.rslt.name == 'หน่วยใหม่') {
					$.jstree.rollback(data.rlbk);
					return false;
				}else{
				$.post(
					"create", 
					{ 
						"operation" : "create_node", 
						//"id" : data.rslt.parent.attr("id").replace("node_",""), 
						"parent_id" : data.rslt.parent.attr("id"), 
						"position" : data.rslt.position,
						"short_name" : data.rslt.name,
						"type" : data.rslt.obj.attr("rel"),
						"organization_type" : organization_type
					}, 
					function (r) {
						//alert(r.status);
						//alert(r.organization_id);
						if(r.status) {
							$(data.rslt.obj).attr("id", r.organization_id);
							$('#organizationDetail'+organization_type).load("../../Organizations/editDetail/"+r.organization_id+"/"+organization_type,function(data) {
								$('#organizationDetail'+organization_type).html(data);

							});
						}else{
							$.jstree.rollback(data.rlbk);
						}
					},"json"
				);
organizationTree(organization_type);
}
			}
		)

		.bind(
			"remove.jstree", function (e, data) {
				//alert($(data.rslt.obj).attr("id"));
				
				$.post(
					"remove", 
					{ 
						"id" : $(data.rslt.obj).attr("id"),
						"organization_type" : organization_type
					}, 
					function (r) {
						//alert(r.status);
						if(r.status) {
							$('#organizationDetail'+organization_type).html('');
						}else{
							$.jstree.rollback(data.rlbk);
						}
					},"json"
				);
				
			}
		)

		.bind(
			"move_node.jstree", function (e, data) {
				//alert(data.rslt.o.attr("id"));
				//alert(data.rslt.op.attr("id"));
				//alert(data.rslt.np.attr("id"));
				
				$.post(
					"move", 
					{ 
						"id" : data.rslt.o.attr("id"),
						"parent_id" : data.rslt.np.attr("id"),
						//"position" : data.rslt.position
						"organization_type" : organization_type
					}, 
					function (r) {
						//alert(r.status);
						//alert(r.organization_id);
						if(r.status) {

						}else{
							$.jstree.rollback(data.rlbk);
						}
					},"json"
				);

			}
		)
		
		;

	}
	
	function organizationTree2(organization_type){

		$(".organization_type_tree_9"+organization_type).jstree({ 
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
							//return "/Organizations/getData2/" + nodeId +'/'+organization_type;
							return "/Organizations/getData/" + nodeId +'/'+organization_type;
						}
						else{
							//return "/Organizations/getData2/";
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
						//var p = this._get_parent(m.o);
						//if(!p) return false;
						//p = p == -1 ? this.get_container() : p;
						//if(p === m.np) return true;
						//if(p[0] && m.np[0] && p[0] === m.np[0]) return true;
						//return false;
						return true;
					}
				}
			},
			"contextmenu": {
					"items": function ($node) {
						return {
							"Create": {
								"label": "สร้าง หน่วยใหม่",
								"action": function (obj) {
									this.create(obj);
								}
							},

							//"Rename": {
							//	"label": "Rename an employee",
							//	"action": function (obj) {
							//		this.rename(obj);
							//	}
							//},
							
							/*
							"Copy": {
								"label": "คัดลอก หน่วย",
								"action": function (obj) {
									this.copy(obj);
								}
							},

							"Paste": {
								"label": "วาง หน่วย",
								"action": function (obj) {
									this.paste(obj);
								}
							},
							*/
							"Compare" : {
								"label": "เปรียบเทียบ",
								"action":function(obj){
									compare(obj);
								}
							},
							<?php
								if($allow_add=="1"){
							?>
							//"Insert": {
							//	"label": "เพิ่ม หน่วย",
							//	"action": function (obj) {
									//this.create(obj);
									//alert(obj.attr("id"));
							//		var organization_id = obj.attr("id");
//									$('#organizationDetail'+organization_type).load("../../Organizations/insertChild/"+organization_id+"/"+organization_type,function(data) {
	//									$('#organizationDetail'+organization_type).html(data);
		//								$('#name-'+organization_type).focus();
			//						});
//
	//							}
	//						},
							<?php
							}
							if($allow_del==1){
							?>
							"Delete": {
								"label": "ลบ หน่วย",
								"action": function (obj) {
									this.remove(obj);
								}
							}
							<?php
							}?>
						};
					}
			},
			"core" : {
				 "initially_open" : [ 1 ],
				 strings : { loading : "กำลังดึงข้อมูล ...", new_node : "หน่วยใหม่" }
			},
			"plugins" : [ "themes", "json_data", "ui", "contextmenu", "crrm", "dnd" ]
		})

		.bind(
			"select_node.jstree", function (e, data) { 
				
				//console.log(data);
				id = data.rslt.obj.attr("id");
				//viewOrganization(id);
				$('#organizationDetail'+organization_type).load("../../Organizations/detail2/"+id+"/"+organization_type,function(data) {
					$('#organizationDetail'+organization_type).html(data);
				});

			}
		)
		
		.bind(
			"create.jstree", function (e, data) {
				//alert('create_node');
				//alert(data.rslt.parent.attr("id"));
				//alert(data.rslt.position);
				//alert(data.rslt.name);
				//alert(data.rslt.obj.attr("rel"));
				if(data.rslt.name == 'หน่วยใหม่') {
					$.jstree.rollback(data.rlbk);
					return false;
				}else{
				$.post(
					"create", 
					{ 
						"operation" : "create_node", 
						//"id" : data.rslt.parent.attr("id").replace("node_",""), 
						"parent_id" : data.rslt.parent.attr("id"), 
						"position" : data.rslt.position,
						"short_name" : data.rslt.name,
						"type" : data.rslt.obj.attr("rel"),
						"organization_type" : organization_type
					}, 
					function (r) {
						//alert(r.status);
						//alert(r.organization_id);
						if(r.status) {
							$(data.rslt.obj).attr("id", r.organization_id);
							$('#organizationDetail'+organization_type).load("../../Organizations/editDetail/"+r.organization_id+"/"+organization_type,function(data) {
								$('#organizationDetail'+organization_type).html(data);

							});
						}else{
							$.jstree.rollback(data.rlbk);
						}
					},"json"
				);
			organizationTree(organization_type);
}
			}
		)

		.bind(
			"remove.jstree", function (e, data) {
				//alert($(data.rslt.obj).attr("id"));
				
				$.post(
					"remove", 
					{ 
						"id" : $(data.rslt.obj).attr("id"),
						"organization_type" : organization_type
					}, 
					function (r) {
						//alert(r.status);
						if(r.status) {
							$('#organizationDetail'+organization_type).html('');
						}else{
							$.jstree.rollback(data.rlbk);
						}
					},"json"
				);
				
			}
		)

		.bind(
			"move_node.jstree", function (e, data) {
				//alert(data.rslt.o.attr("id"));
				//alert(data.rslt.op.attr("id"));
				//alert(data.rslt.np.attr("id"));
				
				$.post(
					"move", 
					{ 
						"id" : data.rslt.o.attr("id"),
						"parent_id" : data.rslt.np.attr("id"),
						//"position" : data.rslt.position
						"organization_type" : organization_type
					}, 
					function (r) {
						//alert(r.status);
						//alert(r.organization_id);
						if(r.status) {

						}else{
							$.jstree.rollback(data.rlbk);
						}
					},"json"
				);

			}
		)
		
		;

	}

	function viewRateProperty(model_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด อัตรากำลังพล');
		$('#customModalAction2').html('ปิด');
		$('#customModal2').load("../../ModelRates/detailRateProperty/"+model_id,function(data) {
			$('#customModal2').html(data);
		});
		screenModalFull();

	}

	function viewRateEquipment(model_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด อัตราอาวุธและยุทโธปกรณ์');
		$('#customModalAction2').html('ปิด');
		$('#customModal2').load("../../ModelRates/detailRateEquipment/"+model_id,function(data) {
			//$('modal-body').html(data);
		});
		screenModalFull();
		  
	}

	function changeRateProperty(organization_id,organization_type){

		$('#customModal2').html('');
		$('#customModalHeader2').html('แก้ไข อัตรากำลังพล');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../Organizations/editModelProperty/"+organization_id+'/'+organization_type,function(data) {
			//$('modal-body').html(data);
		});
		screenModalDefault();
	}
	
	function changeRateProperty2(mid){
		model_id = mid;
		$('#customModal3').html('');
		$('#customModalHeader3').html('เปิดปิดอัตรา');
		
		//$('#customModal3').load("../../Organizations/editModelProperty/"+model_id+'/',function(data) {
			//$('modal-body').html(data);
	//	});
		$('#customModal3').load("../../ModelRates/enableRateProperty/"+model_id+'/',function(data) {
				
			$('modal-body').html(data);
		});
		 $("#myModal3").css({
						"width":"1000px",
						"top":"7%",
						"left":"500px"
		  });
		  $('#customModalAction31').html('บันทึกเป็น');	
		  $('#customModalAction31').hide();
		$('#customModalAction32').html('บันทึก');	
		//screenModalDefault3();
	}
	
	function changeRateEquipment(organization_id,organization_type){

		$('#customModal2').html('');
		$('#customModalHeader2').html('แก้ไข อัตราอาวุธและยุทโธปกรณ์');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../Organizations/editModelEquipment/"+organization_id+'/'+organization_type,function(data) {
			//$('modal-body').html(data);
		});
		screenModalDefault();
	}

	function viewAssignProperty(organization_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด กำลังพล ที่บรรจุจริง');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../ModelRates/assignProperty/"+organization_id,function(data) {
			//$('modal-body').html(data);
		});
		screenModalFull();
	}

	function viewAssignEquipment(organization_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด อัตราอาวุธและยุทโธปกรณ์ ที่บรรจุจริง');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../ModelRates/assignEquipment/"+organization_id,function(data) {
			//$('modal-body').html(data);
		});
		screenModalFull();
	}

	function viewTraining(organization_id){

		$('#customModal2').html('');
		$('#customModalHeader2').html('รายละเอียด การฝึก');
		$('#customModalAction2').html('บันทึก');
		$('#customModal2').load("../../Trainings/detail/"+organization_id,function(data) {
			//$('modal-body').html(data);
		});
		screenModalFull();
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
	
	function modalNormalScreen3(){
		$("#myModal3").css({
			"width":"900px",
			"top":"7%",
			"left":"100px"
		});

		$(".modal-body").css({
			"max-height":"450px"
		});
	}
	/*
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
	*/
	$('#myModal').hide();

	function modelOrganizationKeyup(obj,e) {

		//console.log(e.which);	
		//if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 32 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
		if( e.which == 8 || e.which == 13 || e.which == 17 || e.which == 18 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 41){ return false; }		
		
		var triggerMinLength = 3;
		var triggerMaxLength = 20;
		//if($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength){
		if(($(obj).val().length >= triggerMinLength && $(obj).val().length <= triggerMaxLength) || e.which == 32){
			
			var obj_id = $(obj).attr("id");
			var obj_value = $(obj).attr("value");
			var url = "/../../ModelRates/getData/Organization";

			$.post(	url,{
					//field:'short_name',
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

	function addClick(organization_type){

		var value = $("#name-"+organization_type).val();
		var organization_id = "#"+$("#organization_id").val();
		var position = 'last';
		//var parent = "#140420231250568658";
		$(".organization_type_tree_"+organization_type).jstree("create", organization_id, position, value);
		//$(".organization_type_tree_"+organization_type).jstree("create");
		//$(".organization_type_tree_"+organization_type).jstree("create", null, "inside", { "attr" : { "rel" : "parameter" } });

	}

	function updateOrganization(organization_id){
		
		controller = 'Organizations';
		action = 'update';
		formAction = 'editForm';
		var url = "../../"+controller+"/"+action+"/"+organization_id;
						
		$.post(	url,
				$('#'+formAction).serialize(),
				function(data){
					alert(data);
					location.reload();
				}
				,"html"
		);

	}
	function enableDivision(tid,mdid){
		
		controller = 'Organizations';
		action = 'update';
		formAction = 'editForm';
		var url = "../../ModelRates/setModelDivisionStatus/";
					
		$.post(	url,
				{
					model_division_id : mdid,
					type_id : tid
				},
				function(data){
				//	alert(data);
					changeRateProperty2(model_id);
				}
				,"html"
		);

	}

	function enablePosition(tid,mpid){
		
		controller = 'Organizations';
		action = 'update';
		formAction = 'editForm';
		var url = "../../ModelRates/setModelPositionStatus/";
						
		$.post(	url,
				{
					model_position_id : mpid,
					type_id : tid
				},
				function(data){
				//	alert(data);
					changeRateProperty2(model_id);
				}
				,"html"
		);

	}
	
	function enableProperty(tid,mppid){
		
		controller = 'Organizations';
		action = 'update';
		formAction = 'editForm';
		var url = "../../ModelRates/setModelPropertyStatus/";
						
		$.post(	url,
				{
					model_property_id : mppid,
					type_id : tid
				},
				function(data){
					//alert(data);
					changeRateProperty2(model_id);
				}
				,"html"
		);

	}

</script>