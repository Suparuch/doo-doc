<div class="row-fluid">
    <div class="span12">
		
		<div class="tabbable tabbable-bordered">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabAction" data-toggle="tab"> <i class="splashy-document_letter_edit"></i> ข้อมูล อจย.</a></li>
				<li><a href="#tabModel" data-toggle="tab"> <i class="splashy-document_letter_edit"></i> ข้อมูล อจย. ย่อย</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabAction">
					<?php
					echo $this->element('Component/modelrate/modelAction');
					?>
				</div>
				<div class="tab-pane" id="tabModel">
					<?php
					echo $this->element('Component/modelrate/modelSubgroup');
					?>
				</div>
			</div>
		</div>

    </div>
</div>