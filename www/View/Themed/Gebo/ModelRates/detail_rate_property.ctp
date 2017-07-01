<h3 class="heading">
ข้อมูล 
<?php 
		//pr($ModelRates);
		//ข้อมูล อจย. 10-34 สนง.สก.พล.พัน.สบร.พล.พท. 17 มกราคม 48
		$model_type_id = (empty($ModelRates['ModelRate']['model_type_id'])?"1":$ModelRates['ModelRate']['model_type_id']);
		echo empty($ModelRates['ModelRate']['model_type_id'])? ' ' : $ModelTypeShorts[$ModelRates['ModelRate']['model_type_id']] .' ';
		echo empty($ModelRates['ModelRate']['code'])? ' ' : $ModelRates['ModelRate']['code'] .' ';
		echo empty($ModelRates['ModelRate']['name'])? '' : $ModelRates['ModelRate']['name'] .' ';
		echo empty($ModelRates['ModelRate']['model_date'])? ' ' : $this->DateFormat->formatDateThai($ModelRates['ModelRate']['model_date']);
?>
</h3>
<?php
//echo $this->element('Component/modelrate/detail/detailviewProperty');
echo $this->element('Component/modelrate/detail/detailviewPropertyModelType'.$model_type_id);
?>