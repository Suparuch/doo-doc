<?php
$AuthUser = $this->Session->Read('AuthUser');

//pr($this->params->params);
//die;
?>

<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
<div class="sidebar">
	
	<div class="antiScroll">
		<div class="antiscroll-inner">
			<div class="antiscroll-content">
		
				<div class="sidebar_inner">
					<!--
					<form action="" class="input-append" method="post" >
						<input autocomplete="off" name="query" class="search_query input-medium" size="16" type="text" placeholder="<?php echo __('ค้นหา');?>..." /><button type="submit" class="btn"><i class="icon-search"></i></button>
					</form>
					-->
					<div id="side_accordion" class="accordion">
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collapseOne" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> <?php echo __('ระบบงานการจัดหน่วยทหาร ');?>
								</a>
							</div>
							<?php if($this->params->params['controller'] == 'ModelRates' ||
									 $this->params->params['controller'] == 'Equipments' ||
									 $this->params->params['controller'] == 'Weapons' ||
									 $this->params->params['controller'] == 'EmployeeRates'
									) { 
							?>
								<div class="accordion-body collapse in" id="collapseOne">
							<?php }else{ ?>
								<div class="accordion-body collapse" id="collapseOne">
							<?php } ?>
								<div class="accordion-inner">
									<ul class="nav nav-list">
										<li class='hideme mm_1_access' <?php if($this->params->params['controller'] == 'ModelRates' && $this->params->params['pass'][0] == 1) echo 'class="active"';?>><?php echo $this->Html->link(__('ระบบงานอัตราการจัดและยุทโธปกรณ์'), '/ModelRates/index/1');?></li>
										<li class='hideme mm_2_access' <?php if($this->params->params['controller'] == 'ModelRates' && $this->params->params['pass'][0] == 2) echo 'class="active"';?>><?php echo $this->Html->link(__('ระบบงานอัตราเฉพาะกิจ'), '/ModelRates/index/2');?></li>
										<li class='hideme mm_3_access' <?php if($this->params->params['controller'] == 'Equipments') echo 'class="active"';?>><?php echo $this->Html->link(__('ระบบงานบัญชีรายชื่อยุทโธปกรณ์'), '/Equipments');?></li>
										<li class='hideme mm_4_access' <?php if($this->params->params['controller'] == 'Weapons') echo 'class="active"';?>><?php echo $this->Html->link(__('ระบบงานอัตรามูลฐานกระสุนและวัตถุระเบิด'), '/Weapons');?></li>
										<li class='hideme mm_5_access' <?php if($this->params->params['controller'] == 'EmployeeRates') echo 'class="active"';?>><?php echo $this->Html->link(__('ระบบงานอัตราพนักงานราชการ'), '/EmployeeRates');?></li>
										
										<!--<li><?php echo $this->Html->link(__('ระบบงานการจัดการ'), '/Folders/detail');?></li>-->
<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collapseTwo" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> <?php echo __('ระบบงานนโยบายและแผน  ');?>
								</a>
							</div>
							<?php if($this->params->params['controller'] == 'Organizations' ||
									 $this->params->params['controller'] == 'Barracks'
									) { 
							?>
								<div class="accordion-body collapse in" id="collapseTwo">
							<?php }else{ ?>
								<div class="accordion-body collapse" id="collapseTwo">
							<?php } ?>
								<div class="accordion-inner">
									<ul class="nav nav-list">
										<li class='hideme mm_6_access' <?php if($this->params->params['controller'] == 'Organizations' && $this->params->params['action'] == 'control') echo 'class="active"';?>><?php echo $this->Html->link(__('ระบบการปฎิบัตการทางด้านยุทธการ'), '/Organizations/control');?></li>
										<li class='hideme mm_7_access' <?php if($this->params->params['controller'] == 'Barracks') echo 'class="active"';?>><?php echo $this->Html->link(__('ระบบจัดการค่ายทหาร'), '/Barracks');?></li>
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</ul>
								</div>
							</div>
						</div>
                                    <div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap15" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานยุทธการ
								</a>
							</div>
							<div class="accordion-body collapse" id="collap15">
								<div class="accordion-inner">
								
									<ul class="nav nav-list">
										<li class='hideme mm_1_access' <?php if($this->params->params['controller'] == 'ModelRates' && $this->params->params['pass'][0] == 1) echo 'class="active"';?>><?php echo $this->Html->link(__('ระบบงานอัตราการจัดและยุทโธปกรณ์'), '/ModelRates/index/1');?></li>
										<li class='hideme mm_2_access' <?php if($this->params->params['controller'] == 'ModelRates' && $this->params->params['pass'][0] == 2) echo 'class="active"';?>><?php echo $this->Html->link(__('ระบบงานอัตราเฉพาะกิจ'), '/ModelRates/index/2');?></li>
									
										
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument/index/150120132353162372');?></li>

									</ul>
														
								</div>
							</div>
						</div>                
                                                    <!--- สายงานอื่น -->
                                                    <div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap8" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานการศึกษาทางทหาร
								</a>
							</div>
							<div class="accordion-body collapse" id="collap8">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument/');?></li>
									</div>								
								</div>
							</div>
						</div>
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap9" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานปฏิบัติการทางทหารที่มิใช่สงคราม
								</a>
							</div>
							<div class="accordion-body collapse" id="collap9">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</div>								
								</div>
							</div>
						</div>
                                                    <div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap10" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานการฝึก
								</a>
							</div>
							<div class="accordion-body collapse" id="collap10">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</div>								
								</div>
							</div>
						</div>
                                                   <div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap11" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานการฝึกร่วม/ผสม
								</a>
							</div>
							<div class="accordion-body collapse" id="collap11">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</div>								
								</div>
							</div>
						</div>
                                                    <div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap12" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานการวิจัยและพัฒนาการรบ
								</a>
							</div>
							<div class="accordion-body collapse" id="collap12">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</div>								
								</div>
							</div>
						</div>
                                                <div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap13" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานประวัติศาสตร์ทหาร
								</a>
							</div>
							<div class="accordion-body collapse" id="collap13">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</div>								
								</div>
							</div>
						</div>
                                                    <div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap14" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานเทคโนโลยีสารสนเทศและการสื่อสาร
								</a>
							</div>
							<div class="accordion-body collapse" id="collap14">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</div>								
								</div>
							</div>
						</div>
                        
                                                <div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap16" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานยุทธการฝ่ายอากาศ
								</a>
							</div>
							<div class="accordion-body collapse" id="collap16">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</div>								
								</div>
							</div>
						</div>
                                                 <div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collap17" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานปฏิบัติการพิเศษ
								</a>
							</div>
							<div class="accordion-body collapse" id="collap17">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบงานรับ - ส่ง'), '/EDocument');?></li>
									</div>								
								</div>
							</div>
						</div>
                                                    <!--------------->

						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collapseTree" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> <?php echo __('รายงาน');?>
								</a>
							</div>
							<?php if($this->params->params['controller'] == 'Reports') { ?>
								<div class="accordion-body collapse in" id="collapseTree">
							<?php }else{ ?>
								<div class="accordion-body collapse" id="collapseTree">
							<?php } ?>
								<div class="accordion-inner">
									<ul class="nav nav-list">
										<li class='hideme mm_8_access' <?php if($this->params->params['controller'] == 'Reports' && $this->params->params['action'] == 'byModel') echo 'class="active"';?>><?php echo $this->Html->link(__('อัตราการจัด ตามแบบ'), '/Reports/byModel');?></li>
										<li class='hideme mm_9_access' <?php if($this->params->params['controller'] == 'Reports' && $this->params->params['action'] == 'byOrganization') echo 'class="active"';?>><?php echo $this->Html->link(__('อัตราการจัด ตามหน่วยงาน'), '/Reports/byOrganization');?></li>
										<li class='hideme mm_1_access' <?php if($this->params->params['controller'] == 'Reports' && $this->params->params['action'] == 'byScience') echo 'class="active"';?>><?php //echo $this->Html->link(__('อจย/อฉก ตาม สายวิทยาการ'), '/Reports/byScience');?></li>
										<li class='hideme mm_1_access' ><?php //echo $this->Html->link(__('เปรียบเทียบ อจย/อฉก'), '/Reports/compareModel');?></li>


									</ul>
								</div>

							</div>
						</div>

						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> <?php echo __('จัดการผู้ใช้งาน');?>
								</a>
							</div>
							<?php if($this->params->params['controller'] == 'Users' ||
									 $this->params->params['controller'] == 'AclRoles' ||
									 $this->params->params['controller'] == 'Units'
									) { ?>
								<div class="accordion-body collapse in" id="collapseFour">
							<?php }else{ ?>
								<div class="accordion-body collapse" id="collapseFour">
							<?php } ?>
								<div class="accordion-inner">
									<ul class="nav nav-list">
										<li class='hideme mm_10_access' <?php if($this->params->params['controller'] == 'Users') echo 'class="active"';?>><?php echo $this->Html->link(__('ผู้ใช้งาน'), '/Users');?></li>
										<li class='hideme mm_11_access' <?php if($this->params->params['controller'] == 'Units') echo 'class="active"';?>><?php echo $this->Html->link(__('หน่วยงานผู้ใช้'), '/Units');?></li>
										<li class='hideme mm_12_access' <?php if($this->params->params['controller'] == 'AclRoles') echo 'class="active"';?>><?php echo $this->Html->link(__('สิทธิ์การใช้งาน'), '/AclRoles');?></li>
										<li class='hideme mm_10_access' <?php if($this->params->params['controller'] == 'Log') echo 'class="active"';?>><?php echo $this->Html->link(__('Action Log'), '/Log');?></li>
									</ul>
									
								</div>
							</div>
						</div>

						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collapseFive" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> <?php echo __('จัดการระบบ');?>
								</a>
							</div>
							<?php if(
									 $this->params->params['controller'] == 'Ranks' ||
									 $this->params->params['controller'] == 'Areas' ||
									 $this->params->params['controller'] == 'Organizations' ||
									 $this->params->params['controller'] == 'OrganizationTypes' ||
									 $this->params->params['controller'] == 'Corps' ||
									 $this->params->params['controller'] == 'OrganizationClass' ||
									 $this->params->params['controller'] == 'Divisions' ||
									 $this->params->params['controller'] == 'SubDivisions' ||
									 $this->params->params['controller'] == 'Positions' ||
									 $this->params->params['controller'] == 'Provinces' ||
									 $this->params->params['controller'] == 'Zones' ||
									 $this->params->params['controller'] == 'Districts' ||
									 $this->params->params['controller'] == 'EmployeeOrganizations' ||
									 $this->params->params['controller'] == 'EmployeePositions' ||
									 $this->params->params['controller'] == 'WeaponBullets'									 
									) { ?>
								<div class="accordion-body collapse in" id="collapseFive">
							<?php }else{ ?>
								<div class="accordion-body collapse" id="collapseFive">
							<?php } ?>
								<div class="accordion-inner">
									<ul class="nav nav-list">

										<li class="nav-header">ข้อมูลพื้นฐาน</li>
										<li class='hideme mm_13_access' <?php if($this->params->params['controller'] == 'Ranks') echo 'class="active"';?>><?php echo $this->Html->link(__('ยศ'), '/Ranks');?></li>
										<li class="divider"></li>


										<li class="nav-header">หน่วย</li>
										<li class='hideme mm_14_access' <?php if($this->params->params['controller'] == 'Areas') echo 'class="active"';?>><?php echo $this->Html->link(__('ทัพภาค'), '/Areas');?></li>
										<li class='hideme mm_15_access' <?php if($this->params->params['controller'] == 'Organizations' && $this->params->params['action'] == 'index') echo 'class="active"';?>><?php echo $this->Html->link(__('หน่วยงาน'), '/Organizations');?></li>
										<li class='hideme mm_16_access' <?php if($this->params->params['controller'] == 'OrganizationTypes') echo 'class="active"';?>><?php echo $this->Html->link(__('ประเภทหน่วย'), '/OrganizationTypes');?></li>
										<li class='hideme mm_17_access' <?php if($this->params->params['controller'] == 'Corps') echo 'class="active"';?>><?php echo $this->Html->link(__('ชนิดหน่วย'), '/Corps');?></li>
										<li class='hideme mm_18_access' <?php if($this->params->params['controller'] == 'OrganizationClass') echo 'class="active"';?>><?php echo $this->Html->link(__('ขนาดหน่วย'), '/OrganizationClass');?></li>
										<!--<li><?php echo $this->Html->link(__('Category'), '/Categories');?></li>-->
										<li class="divider"></li>

										<li class="nav-header">อจย./อฉก.</li>
										<li class='hideme mm_19_access' <?php if($this->params->params['controller'] == 'Divisions') echo 'class="active"';?>><?php echo $this->Html->link(__('วรรค'), '/Divisions');?></li>
										<li class='hideme mm_20_access' <?php if($this->params->params['controller'] == 'SubDivisions') echo 'class="active"';?>><?php echo $this->Html->link(__('วรรคย่อย'), '/SubDivisions');?></li
										<li class='hideme mm_21_access' <?php if($this->params->params['controller'] == 'Positions') echo 'class="active"';?>><?php echo $this->Html->link(__('ลำดับ'), '/Positions');?></li>
										<!--<li <?php if($this->params->params['controller'] == 'Organizations') echo 'class="active"';?>><?php echo $this->Html->link(__('ลำดับย่อย'), '/Organizations');?></li>-->
										<li class="divider"></li>

										<li class="nav-header">ที่อยู่</li>
										<li class='hideme mm_22_access' <?php if($this->params->params['controller'] == 'Provinces') echo 'class="active"';?>><?php echo $this->Html->link(__('จังหวัด'), '/Provinces');?></li>
										<li class='hideme mm_23_access' <?php if($this->params->params['controller'] == 'Zones') echo 'class="active"';?>><?php echo $this->Html->link(__('อำเภอ/เขต'), '/Zones');?></li>
										<li class='hideme mm_24_access' <?php if($this->params->params['controller'] == 'Districts') echo 'class="active"';?>><?php echo $this->Html->link(__('ตำบล/แขวง'), '/Districts');?></li>

										<li class="nav-header">อัตราพนักงานข้าราชการ</li>
										<li class='hideme mm_25_access' <?php if($this->params->params['controller'] == 'EmployeeOrganizations') echo 'class="active"';?>><?php echo $this->Html->link(__('หน่วยบรรจุอัตราพนักงานราชการ'), '/EmployeeOrganizations');?></li>
										<li class='hideme mm_26_access' <?php if($this->params->params['controller'] == 'EmployeePositions') echo 'class="active"';?>><?php echo $this->Html->link(__('ตำแหน่งของพนักงานราชการ'), '/EmployeePositions');?></li>

										<li class="nav-header">อัตรามูลฐานกระสุนและวัตถุระเบิด</li>
										<li  class='hideme mm_27_access' <?php if($this->params->params['controller'] == 'WeaponBullets') echo 'class="active"';?>><?php echo $this->Html->link(__('คุณลักษณะกระสุนและวัตถุระเบิด'), '/WeaponBullets');?></li>

									</ul>
								</div>									 

							</div>
						</div>
						
						<!--- E-Doc  <?php echo (!isset($_GET['debug'])?" style='display:none;' ":"")?> --->
                                                    <div class="accordion-group" style="display:none;" >
							<div class="accordion-heading">
								<a href="#collapseSix" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบงานรับ - ส่ง
								</a>
							</div>
							<div class="accordion-body collapse" id="collapseSix">
								<div class="accordion-inner">
								
								
								<?php $organization_type_id = 0?>
									<div class="span4">
										<div class="doc_tree_<?php echo $organization_type_id;?>"></div>
									</div>								
								</div>
							</div>
						</div>
						
						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collapseSeven" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle in">
									<i class="icon-folder-close"></i> ระบบเชื่อมต่อข้อมูลระหว่างสายงาน
								</a>
							</div>
							<div class="accordion-body collapse" id="collapseSeven">
								<div class="accordion-inner">
									<div class="span4">
										<li ><?php echo $this->Html->link(__('ระบบเชื่อมต่อข้อมูล (ขาออก)'), '/WebService');?></li>
										<li ><?php echo $this->Html->link(__('ระบบเชื่อมต่อข้อมูล (ขาเข้า)'), '/WebServiceInbox');?></li>
									</div>								
								</div>
							</div>
						</div>
						
						<!--
						<div class="accordion-group">
							<div class="accordion-heading">
								<a href="#collapse7" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
								   <i class="icon-th"></i> Calculator
								</a>
							</div>
							<div class="accordion-body collapse" id="collapse7">
								<div class="accordion-inner">
									<form name="Calc" id="calc">
										<div class="formSep control-group input-append">
											<input type="text" style="width:130px" name="Input" /><button type="button" class="btn" name="clear" value="c" OnClick="Calc.Input.value = ''"><i class="icon-remove"></i></button>
										</div>
										<div class="control-group">
											<input type="button" class="btn btn-large" name="seven" value="7" OnClick="Calc.Input.value += '7'" />
											<input type="button" class="btn btn-large" name="eight" value="8" OnCLick="Calc.Input.value += '8'" />
											<input type="button" class="btn btn-large" name="nine" value="9" OnClick="Calc.Input.value += '9'" />
											<input type="button" class="btn btn-large" name="div" value="/" OnClick="Calc.Input.value += ' / '">
										</div>
										<div class="control-group">
											<input type="button" class="btn btn-large" name="four" value="4" OnClick="Calc.Input.value += '4'" />
											<input type="button" class="btn btn-large" name="five" value="5" OnCLick="Calc.Input.value += '5'" />
											<input type="button" class="btn btn-large" name="six" value="6" OnClick="Calc.Input.value += '6'" />
											<input type="button" class="btn btn-large" name="times" value="x" OnClick="Calc.Input.value += ' * '" />
										</div>
										<div class="control-group">
											<input type="button" class="btn btn-large" name="one" value="1" OnClick="Calc.Input.value += '1'" />
											<input type="button" class="btn btn-large" name="two" value="2" OnCLick="Calc.Input.value += '2'" />
											<input type="button" class="btn btn-large" name="three" value="3" OnClick="Calc.Input.value += '3'" />
											<input type="button" class="btn btn-large" name="minus" value="-" OnClick="Calc.Input.value += ' - '" />
										</div>
										<div class="formSep control-group">
											<input type="button" class="btn btn-large" name="dot" value="." OnClick="Calc.Input.value += '.'" />
											<input type="button" class="btn btn-large" name="zero" value="0" OnClick="Calc.Input.value += '0'" />
											<input type="button" class="btn btn-large" name="DoIt" value="=" OnClick="Calc.Input.value = Math.round( eval(Calc.Input.value) * 1000)/1000" />
											<input type="button" class="btn btn-large" name="plus" value="+" OnClick="Calc.Input.value += ' + '" />
										</div>
										
									</form>
								</div>
							 </div>
						</div>
						-->

					</div>
					
					<div class="push"></div>
				</div>
				
				<!--
				<div class="sidebar_info">
					<ul class="unstyled">
						<li>
							<span class="act act-warning">65</span>
							<strong>New comments</strong>
						</li>
						
						<li>
							<span class="act act-success">10</span>
							<strong>New articles</strong>
						</li>
						<li>
							<span class="act act-danger">85</span>
							<strong>New registrations</strong>
						</li>
						
					</ul>
				</div>
				-->
			
			</div>
			
		</div>
	</div>

</div>
<script>

	$(".hideme").hide();
	<?php 
	if(isset($AuthUser['menulist']) && count($AuthUser['menulist'])>0){
	foreach($AuthUser['menulist'] as $menu){
		if($menu['access']=="1")
			echo "$(\".mm_" . $menu['action_id'] . "_access\").show();\n";
		if($menu['add']=="1")
			echo "$(\".mm_" . $menu['action_id'] . "_add\").show();\n";

		if($menu['list']=="1")
			echo "$(\".mm_" . $menu['action_id'] . "_list\").show();\n";
		if($menu['edit']=="1")
			echo "$(\".mm_" . $menu['action_id'] . "_edit\").show();\n";
		if($menu['delete']=="1")
			echo "$(\".mm_" . $menu['action_id'] . "_delete\").show();\n";
		if($menu['detail']=="1")
			echo "$(\".mm_" . $menu['action_id'] . "_detail\").show();\n";
			}
}
?>
</script>
<script language='javascript'>
function docTree(organization_type){

		$(".doc_tree_"+organization_type).jstree({ 
			"json_data": {
				"data" : [
					{
						"data" : {
							"title":'ยก.ทบ.',
							'attr':{
								"id":1,
								"href" : "#",
								'level':-1
							  
							}
						},
						"metadata" : { id : 0 },
						"state" : "closed",
						"attr":{
							"id":1,
							'level':1,
							'parent_id':-1
						}
					}

				],
				"ajax": {

					url: function (node) { 
					
						var nodeId = node.attr('id'); 
					//	return "/Units/getData/";
						
						if(node!=-1){
							return "/Units/getData/" + nodeId +'/'+organization_type;
						}
						else{
							return "/Units/getData/";
						}
						
					},
					type: "POST",
					contentType: "application/json;charset=utf-8",
					dataType: "json",
					data: function (n) {
						return { id: n.attr ? n.attr("id") : "0",level:n.attr('level') };
					},
					success: function (data, textstatus, xhr) {
						// alert(data)
					},
					error: function (xhr, textstatus, errorThrown) {
						// alert(textstatus);
					}
				}
			},
			"dnd" : {
				"drop_finish" : function () { 
					alert("DROP"); 
				},
				"drag_check" : function (data) {
					if(data.r.attr("id") == "phtml_1") {
						return false;
					}
					return { 
						after : false, 
						before : false, 
						inside : true 
					};
				},
				"drag_finish" : function (data) { 
					alert("DRAG OK"); 
				}
			},
			"crrm" : { 
				"move" : {
					"check_move" : function (m) { 
						//var p = this._get_parent(m.o);
						//if(!p) return false;
						//p = p == -1 ? this.get_container() : p;
						//if(p === m.np) return true;
						//if(p[0] && m.np[0] && p[0] === m.np[0]) return true;
						//return false;
						return true;
					}
				}
			},
			"core" : {
				 "initially_open" : [ 1 ],
				 strings : { loading : "กำลังดึงข้อมูล ...", new_node : "หน่วยใหม่" }
			},
			"plugins" : [ "themes", "json_data", "ui"]
		})

		.bind(
			"select_node.jstree", function (e, data) { 
				
				//console.log(data);
				id = data.rslt.obj.attr("id");
				location.href="/EDocument/index/"+id+"/?debug=1";
				//viewOrganization(id);
				/*$('#docDetail'+organization_type).load("../../Organizations/detail/"+id+"/"+organization_type,function(data) {
					$('#Detail'+organization_type).html(data);
				});*/

			}
		)
		
		.bind(
			"create.jstree", function (e, data) {
				//alert('create_node');
				//alert(data.rslt.parent.attr("id"));
				//alert(data.rslt.position);
				//alert(data.rslt.name);
				//alert(data.rslt.obj.attr("rel"));
				if(data.rslt.name == 'หน่วยใหม่') {
					$.jstree.rollback(data.rlbk);
					return false;
				}else{
				$.post(
					"create", 
					{ 
						"operation" : "create_node", 
						//"id" : data.rslt.parent.attr("id").replace("node_",""), 
						"parent_id" : data.rslt.parent.attr("id"), 
						"position" : data.rslt.position,
						"short_name" : data.rslt.name,
						"type" : data.rslt.obj.attr("rel"),
						"organization_type" : organization_type
					}, 
					function (r) {
						//alert(r.status);
						//alert(r.organization_id);
						if(r.status) {
							$(data.rslt.obj).attr("id", r.organization_id);
							$('#docDetail'+organization_type).load("../../Organizations/editDetail/"+r.organization_id+"/"+organization_type,function(data) {
								$('#docDetail'+organization_type).html(data);

							});
						}else{
							$.jstree.rollback(data.rlbk);
						}
					},"json"
				);
location.reload();
}
			}
		)
		
		;

	}
	docTree(0);
</script>