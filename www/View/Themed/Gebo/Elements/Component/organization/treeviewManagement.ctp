	<div class="tabbable">
		<ul class="nav nav-tabs">
			
			<?php
			$class_active = 'class="active"';
			foreach($OrganizationTypes as $key => $OrganizationType){
			?>
			<li <?php echo $class_active;?>><a href="#tab<?php echo $key;?>" data-toggle="tab" class='changeOrganizationType tab_organization_type_<?php echo $key;?>' value='<?php echo $key;?>' flagload=''><?php echo $OrganizationType;?></a></li>
			<?php 
			$class_active = '';
			} 
			?>
		</ul>
		<div class="tab-content">
			<?php
			$class_active = 'active';
			foreach($OrganizationTypes as $key => $OrganizationType){
			?>
			<div class="tab-pane <?php echo $class_active;?>" id="tab<?php echo $key;?>">
				<div class="row-fluid" id="organization_type_<?php echo $key;?>">

				</div>
			</div>
			<?php 
			$class_active = '';
			} 
			?>	
		</div>
	</div>