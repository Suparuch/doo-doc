<?php
//echo $this->element('Component/breadcrumb');
?>
<div class="row-fluid">
	<div class="box-title">
		<h3 class="heading">
			บัญชีการจัดหน่วยงานกองทัพบก
		</h3>
	</div>
</div>
	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_group_1" data-toggle="tab" class='tab_group_1'>สายบังคับบัญชา</a></li>
			<li><a href="#tab_group_2" data-toggle="tab" class='tab_group_2'>แบบ 7 ส่วนราชการ</a></li>
            <li><a href="#tab_group_90" data-toggle="tab" onclick='organizationTree2(0)' class='tab_group_90'>เปรียบเทียบสาย</a></li>
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
			<div class="tab-pane" id="tab_group_90">
				<?php echo $this->element('Component/organization/treeviewCommand2');?>
			</div>
		</div>
	</div>
<?php
echo $this->element('js/organization');
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