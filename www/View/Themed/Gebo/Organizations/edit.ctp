<?php
echo $this->element('Component/breadcrumb');
?>
<div class="row-fluid">
	<div class="span2">
		<div id="organizations"><?php echo __('Load tree'); ?></div>
	</div>
	<div id="organizationsInfo" class="span10">
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
					"data" : "A node", 
					"metadata" : { id : 23 },
					"children" : [ "Child 1", "A Child 2" ]
				},
				{ 
					"attr" : { "id" : "li.node.id1" }, 
					"data" : { 
						"title" : "Long format demo", 
						"attr" : { "href" : "#" } 
					} 
				}
			]
		},
		"plugins" : [ "themes", "json_data", "ui" ]
	}).bind("select_node.jstree", function (e, data) { alert(data.rslt.obj.data("id")); });
});
</script>