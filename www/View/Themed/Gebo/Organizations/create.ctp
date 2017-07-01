<?php
echo $this->element('Component/breadcrumb');
?>
<div class="row-fluid">
	<div class="box-title">
		<h3 class="heading">
			บัญชีการจัดหน่วยงานกองทัพบก
		</h3>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		<b><?php echo __('กองทัพบก'); ?></b>
		<div id="organizations"></div>
	</div>
	<div id="organizationDetail" class="span9">
		<?php
		echo $this->element('Component/organization/editview');
		?>
	</div>
</div>

<scr>
<script type="text/javascript">
$(function () {
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
		"plugins" : [ "themes", "json_data", "ui" ]
	}).bind("select_node.jstree", function (e, data) { alert(data.rslt.obj.data("id")); });

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

});
</script>
<style type="text/css">

.modal {
    background-clip: padding-box;
    background-color: #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 6px 6px 6px 6px;
    box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
    left: 50%;
    margin-left: -480px;
    outline: 0 none;
    position: fixed;
    top: 10%;
    width: 900px;
    z-index: 1050;
}

</style>