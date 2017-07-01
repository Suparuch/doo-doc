<?php
echo $this->element('Component/breadcrumb');
echo $this->element('Component/report/searchviewOrganization');
if($setIndex){
echo $this->element('Component/report/indexviewOrganization');
echo $this->element('Component/pagination');
}
?>