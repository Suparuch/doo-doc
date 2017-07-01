<?php
	set_time_limit(500);
$model_type_id = empty($ModelRates['ModelRate']['model_type_id']) ? 1 : $ModelRates['ModelRate']['model_type_id'];
 function formatDateShortThai($dateTime = null,$option=null) {
		
		if(empty($dateTime)) return '';

		$strYear = date("Y",strtotime($dateTime))+543;
		$strMonth= date("n",strtotime($dateTime));
		$strDay= date("j",strtotime($dateTime));
		$strHour= date("H",strtotime($dateTime));
		$strMinute= date("i",strtotime($dateTime));
		$strSeconds= date("s",strtotime($dateTime));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		//$strMonthCut = $strMonthCut;
		//$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");  
		/*
		$thai_month_arr=array(  
			"0"=>"",  
			"1"=>"มกราคม",  
			"2"=>"กุมภาพันธ์",  
			"3"=>"มีนาคม",  
			"4"=>"เมษายน",  
			"5"=>"พฤษภาคม",  
			"6"=>"มิถุนายน",   
			"7"=>"กรกฎาคม",  
			"8"=>"สิงหาคม",  
			"9"=>"กันยายน",  
			"10"=>"ตุลาคม",  
			"11"=>"พฤศจิกายน",  
			"12"=>"ธันวาคม"                    
		);
		*/
		$strMonthThai=$strMonthCut[$strMonth];
		if(!empty($option)){
			if (array_key_exists('Y', $option)) $strYear = substr($strYear, -2);			
		}

		//return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		//return $strDay .' '. $strMonthThai .' '. $yearThai($strYear);
		//pr($strDay .' '. $strMonthThai .' '. $strYear);
		return $strDay .' '. $strMonthThai .' '. substr($strYear,2,2);
	
	} // END function formatDate
?>
<div class="row-fluid">
	<div class="span12">
		<h3 class="heading">
		
		<?php 
				//pr($ModelRates);
				//ข้อมูล อจย. 10-34 สนง.สก.พล.พัน.สบร.พล.พท. 17 มกราคม 48
				echo empty($ModelRates['ModelRate']['model_type_id'])? ' ' : $ModelTypeShorts[$ModelRates['ModelRate']['model_type_id']] .' ';
				echo empty($ModelRates['ModelRate']['code'])? ' ' : $ModelRates['ModelRate']['code'] .' ';
				
				if($model_type_id == 1)
					echo empty($ModelRates['ModelRate']['model_date'])? ' ' :  '(' .  formatDateShortThai($ModelRates['ModelRate']['model_date']) .') '  ;
				echo empty($ModelRates['ModelRate']['name'])? '' : $ModelRates['ModelRate']['short_name'] .' ';
		?>
		</h3>
		<div class="alert alert-success">
                <a id='close' class="close">×</a>
				<span id='message'></span>
        </div>
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active t_model"><a href="#tabModel" data-toggle="tab" class="changeTab" value='Model'><?php echo $ModelTypeShorts[$model_type_id];?></a></li>
				<li class='t_model' id='t_document'><a href="#tabDocument" data-toggle="tab" class="changeTab" value='Document'>เอกสาร</a></li>
				<?php if($ModelRates['ModelRate']['is_group']=='N'){?>
				<li class='t_model'><a href="#tabProperty" data-toggle="tab" class="changeTab" value='Property' status=''>อัตรากำลังพล</a></li>
				<li class='t_model'><a href="#tabEquipment" data-toggle="tab" class="changeTab" value='Equipment' status=''>อัตรายุทโธปกรณ์</a></li>
				<? } ?>
				<?php if($ModelRates['ModelRate']['is_group']=='Y'){?>
				<li class='t_model'><a href="#tabModelGroup" data-toggle="tab" class="changeTab" value='ModelGroup'><?php echo $ModelTypeShorts[$model_type_id];?> รวม</a></li>
				<? } ?>
				<li class='t_model'><a href="#tabOrganization" data-toggle="tab" class="changeTab" value='Organization'>หน่วยใช้อัตรา</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabModel">
					<?php
					echo $this->element('Component/modelrate/edit/editviewModel');
					?>
				</div>
				<div class="tab-pane" id="tabDocument">
					<?php
					echo $this->element('Component/modelrate/edit/editviewDocument');
					?>
				</div>
				<?php if($ModelRates['ModelRate']['is_group']=='N'){?>
				
				<div class="tab-pane" id="tabProperty">
				
					<?php
					//echo $this->element('Component/modelrate/edit/editviewProperty');
					?>
				</div>
				<div class="tab-pane" id="tabEquipment">

				</div>
				<?php } ?>
				<?php if($ModelRates['ModelRate']['is_group']=='Y'){?>
				
				
				<div class="tab-pane" id="tabModelGroup">
					<?php
					echo $this->element('Component/modelrate/edit/editviewModelGroup');
					?>
				</div>
				<?php } ?>
				<div class="tab-pane" id="tabOrganization">
					<?php
					echo $this->element('Component/modelrate/edit/editviewOrganization');
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="currentTab" value="Model" />