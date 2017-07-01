<?php
echo $this->element('Component/breadcrumb');
?>
<script language='javascript'>
function gototree(){
	window.location.href='/ModelRates/index/1';
}
</script>

<style type='text/css'>
    #group_1{
        width:100%;
    }
    #group_1 div.span4{
        width:15%;
    }
    #group_1 div.span8{
        width:80%
    }
    .row-fluid .span11
    {
        min-width: 150px !important;
    }
    </style>

<div class="row-fluid">
	<div class="box-title">
		<h3 class="heading">
			อัตราการจัดและยุทโธปกรณ์  <button id="ModelRate-submit" onclick='gototree()' type="button" class="btn btn-primary hideme mm_1_list" style="display: inline-block;">แสดงผลรูปแบบตาราง</button>
		</h3>
	</div>
</div>
	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_group_1" data-toggle="tab" class='tab_group_1'>อจย.</a></li>
			</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_group_1">
				<div class="row-fluid" id="group_1">
					<?php echo $this->element('Component/organization/treeviewCommand');?>
				</div>
			</div>
			<div class="tab-pane" id="tab_group_2">
				<?php echo $this->element('Component/organization/treeviewManagement');?>
			</div>
			<div class="tab-pane" id="tab_group_9">
				<?php echo $this->element('Component/organization/treeviewCommand2');?>
			</div>
		</div>
	</div>
<?php
echo $this->element('js/modelratetree');
echo $this->element('js/modelrate');
?>
<style>
.jstree a {
    color: #000000;
    display: inline-block;
    height: 23px;
    line-height: 16px;
    margin: 0;
    padding: 1px 2px;
    text-decoration: none;
    white-space: nowrap;
}

#vakata-contextmenu li a {
    display: block;
    line-height: 27px;
    /*margin: 1px 1px 0;*/
    padding: 1px 6px;
    text-decoration: none;
}

</style>