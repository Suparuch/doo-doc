<style type="text/css">
    .page_menu_active{
     color:#90D93F !important;   
     font-weight: bold;
     text-decoration:underline;
    }
</style>
<div class="sub-menu-list">
    <ul>
        <li><?php echo $this->Html->link(__("จดหมายเหตุ"), "/Memorandums/index",array('class'=>($this->params->params['controller'] == 'Memorandums')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("ประวัติศาสตร์เฉพาะเรื่อง"), "/HistoryMilitaryUnits/index", array('class'=>($this->params->params['controller'] == 'HistoryMilitaryUnits')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("ภาพประวัติศาสตร์"), "/HistoryPhotos/index",array('class'=>($this->params->params['controller'] == 'HistoryPhotos')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("เหตุการณ์วันนี้ในอดีต"), "/PastEvents/index", array('class'=>($this->params->params['controller'] == 'PastEvents')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("ต้นฉบับเอกสารประวัติศาสตร์"), "/OriginalHistoryDocuments/index", array('class'=>($this->params->params['controller'] == 'OriginalHistoryDocuments')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("บทเรียนจากการรบ"), "/Wars/index", array('class'=>($this->params->params['controller'] == 'Wars')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("วัตถุพิพิธภัณฑ์"), "/MuseumCollections/index", array('class'=>($this->params->params['controller'] == 'MuseumCollections')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("ระบบจัดเก็บเอกสารและหนังสือประวัติศาสตร์"), "/HMHistoryBooks/index", array('class'=>($this->params->params['controller'] == 'HMHistoryBooks')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("คำสั่ง/คู่มือการปฏิบัติงาน"), "/HMCommands/index", array('class'=>($this->params->params['controller'] == 'HMCommands')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("นโยบาย"), "/HMPolicies/index", array('class'=>($this->params->params['controller'] == 'HMPolicies')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("แบบฟอร์มต่างๆ"), "/HMForms/index", array('class'=>($this->params->params['controller'] == 'HMForms')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("การรายงานผล"), "/HMReports/index", array('class'=>($this->params->params['controller'] == 'HMReports')?'page_menu_active':'')); ?></li>
    </ul>
</div>

<?php if ($this->params->params['controller'] == 'HistoryMilitaryUnits' || 
        $this->params->params['controller'] == 'HistorySoldiers' ||
        $this->params->params['controller'] == 'HistoryBarracks' ||
        $this->params->params['controller'] == 'HistoryMonuments' ||
        $this->params->params['controller'] == 'HistoryOthers' ||
        $this->params->params['controller'] == 'HistoryDeceases') { ?>
<div class="subnav-menu-list">
    <ul>
        <li><?php echo $this->Html->link(__("ประวัติหน่วย"), "/HistoryMilitaryUnits/index",array('class'=>($this->params->params['controller'] == 'HistoryMilitaryUnits')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("ประวัติบุคคล"), "/HistorySoldiers/index",array('class'=>($this->params->params['controller'] == 'HistorySoldiers')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("ประวัติค่ายทหาร"), "/HistoryBarracks/index",array('class'=>($this->params->params['controller'] == 'HistoryBarracks')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("ประวัติอนุสารีย์"), "/HistoryMonuments/index",array('class'=>($this->params->params['controller'] == 'HistoryMonuments')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("ข้อมูลประวัติศาสตร์อื่นๆ"), "/HistoryOthers/index",array('class'=>($this->params->params['controller'] == 'HistoryOthers')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("สมุดประวัติข้าราชการถึงแก่กรรม"), "/HistoryDeceases/index",array('class'=>($this->params->params['controller'] == 'HistoryDeceases')?'page_menu_active':'')); ?></li>
    </ul>
</div>
<?php } ?>

<?php if ($this->params->params['controller'] == 'Wars' || 
        $this->params->params['controller'] == 'MissionCriticals') { ?>
<div class="subnav-menu-list">
    <ul>
        <li><?php echo $this->Html->link(__("การรบ"), "/Wars/index",array('class'=>($this->params->params['controller'] == 'Wars')?'page_menu_active':'')); ?></li>
        <li><?php echo $this->Html->link(__("การปฎิบัติภารกิจที่สำคัญ"), "/MissionCriticals/index",array('class'=>($this->params->params['controller'] == 'MissionCriticals')?'page_menu_active':'')); ?></li>
    </ul>
</div>
<?php } ?>