<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">
		ข้อมูล
		<?php 
				//pr($ModelRates);
				//ข้อมูล อจย. 10-34 สนง.สก.พล.พัน.สบร.พล.พท. 17 มกราคม 48
				echo empty($ModelRates['ModelRate']['model_type_id'])? ' ' : $ModelTypeShorts[$ModelRates['ModelRate']['model_type_id']] .' ';
				echo empty($ModelRates['ModelRate']['code'])? ' ' : $ModelRates['ModelRate']['code'] .' ';
				echo empty($ModelRates['ModelRate']['name'])? '' : $ModelRates['ModelRate']['name'] .' ';
				echo empty($ModelRates['ModelRate']['model_date'])? ' ' : $this->DateFormat->formatDateThai($ModelRates['ModelRate']['model_date']);
		?>
		</h3>
		<div class="alert alert-success">
                <a id='close' class="close">×</a>
				<span id='message'></span>
        </div>
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabModel" data-toggle="tab">ข้อมูล  <?php echo $ModelTypeShorts[$model_type_id];?>.</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabModel">
					<?php
					echo $this->element('Component/modelrate/edit/editviewModel');
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="currentTab" value="Model" />