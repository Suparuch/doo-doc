<?php
echo $this->element('Component/breadcrumb');
echo $this->element('Component/report/searchviewModel');
if($setIndex){
echo $this->element('Component/report/indexviewModel');
echo $this->element('Component/pagination');
}
?>