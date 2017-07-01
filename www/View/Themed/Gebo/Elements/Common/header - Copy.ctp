			<?php
				$currentUser = $this->Session->read('AuthUser');

				$user_avatar = $currentUser['UserProfile']['image_key'];
				$user_name = $currentUser['UserProfile']['name'] . ' ' . $currentUser['UserProfile']['surname'];
				$user_position = '';
				if(!empty($currentUser['AuthUserOrganizationPosition'][0]['AuthOrganizationPosition']['AuthPosition']['position_name'])){
					$user_position  .= mb_substr(strip_tags($currentUser['AuthUserOrganizationPosition'][0]['AuthOrganizationPosition']['AuthPosition']['position_name']),0, 23);
				    if (mb_strlen(strip_tags($currentUser['AuthUserOrganizationPosition'][0]['AuthOrganizationPosition']['AuthPosition']['position_name'])) > 23) {
					$user_position .='...';
				    }
				}
				
				$user_status = $currentUser['UserProfile']['name'] . ' ' . $currentUser['UserProfile']['surname'];

			?>	
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<header>
				<?php echo $this->element('Common/modal'); ?>
				<div class="navbar navbar-fixed-top">
					<div class="navbar-inner">

						<div class="container-fluid">
							<a class="brand" href="<?php echo $this->Html->url(array("controller" => "/"));?>"><i class="icon-home icon-white"></i> <?php echo Configure::read('Application.Name');?> <span class="sml_t"></span></a>
							<ul class="nav user_menu pull-right">
								<!--
								<li class="hidden-phone hidden-tablet">
									<div class="nb_boxes clearfix">
										<a data-toggle="modal" data-backdrop="static" href="#myMail" class="label ttip_b" title="New messages">25 <i class="splashy-mail_light"></i></a>
										<a data-toggle="modal" data-backdrop="static" href="#myTasks" class="label ttip_b" title="New tasks">10 <i class="splashy-calendar_week"></i></a>
									</div>
								</li>
								<li class="divider-vertical hidden-phone hidden-tablet"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle nav_condensed" data-toggle="dropdown"><i class="flag-gb"></i> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="javascript:void(0)"><i class="flag-de"></i> Deutsch</a></li>
										<li><a href="javascript:void(0)"><i class="flag-fr"></i> Français</a></li>
										<li><a href="javascript:void(0)"><i class="flag-es"></i> Español</a></li>
										<li><a href="javascript:void(0)"><i class="flag-ru"></i> Pусский</a></li>
									</ul>
								</li>
								-->
								<li class="divider-vertical hidden-phone hidden-tablet"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<!--<img src="<?php echo $this->Html->url('/FileProviders/index/', true);?><?php echo $user_avatar;?>" alt="" class="user_avatar"/>-->
									<?php echo $user_name;?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#myModal2" onclick="editProfile()" data-toggle="modal">ข้อมูลส่วนตัว</a></li>
										<li class="divider"></li>
										<li><?php echo $this->Html->link('ออกจากระบบ',array('controller'=>'Logouts'));?></li>
									</ul>
								</li>
							</ul>
							<!--
							<ul class="nav" id="mobile-nav">
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-list-alt icon-white"></i> Forms <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="form_elements.html">Form elements</a></li>
										<li><a href="form_extended.html">Extended form elements</a></li>
										<li><a href="form_validation.html">Form Validation</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th icon-white"></i> Components <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="alerts_btns.html">Alerts & Buttons</a></li>
										<li><a href="icons.html">Icons</a></li>
										<li><a href="notifications.html">Notifications</a></li>
										<li><a href="tables.html">Tables</a></li>
										<li><a href="tables_more.html">Tables (more examples)</a></li>
										<li><a href="tabs_accordion.html">Tabs & Accordion</a></li>
										<li><a href="tooltips.html">Tooltips, Popovers</a></li>
										<li><a href="typography.html">Typography</a></li>
										<li><a href="widgets.html">Widget boxes</a></li>
										<li class="dropdown">
											<a href="#">Sub menu <b class="caret-right"></b></a>
											<ul class="dropdown-menu">
												<li><a href="#">Sub menu 1.1</a></li>
												<li><a href="#">Sub menu 1.2</a></li>
												<li><a href="#">Sub menu 1.3</a></li>
												<li>
													<a href="#">Sub menu 1.4 <b class="caret-right"></b></a>
													<ul class="dropdown-menu">
														<li><a href="#">Sub menu 1.4.1</a></li>
														<li><a href="#">Sub menu 1.4.2</a></li>
														<li><a href="#">Sub menu 1.4.3</a></li>
													</ul>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-wrench icon-white"></i> Plugins <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="charts.html">Charts</a></li>
										<li><a href="calendar.html">Calendar</a></li>
										<li><a href="datatable.html">Datatable</a></li>
										<li><a href="dynamic_tree.html">Dynamic tree</a></li>
										<li><a href="editable_elements.html">Editable elements</a></li>
										<li><a href="file_manager.html">File Manager</a></li>
										<li><a href="floating_header.html">Floating List Header</a></li>
										<li><a href="google_maps.html">Google Maps</a></li>
										<li><a href="gallery.html">Gallery Grid</a></li>
										<li><a href="wizard.html">Wizard</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-file icon-white"></i> Pages <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="blog_page.html"> Blog Page</a></li>
										<li><a href="chat.html"> Chat</a></li>
										<li><a href="error_404.html"> Error 404</a></li>
										<li><a href="invoice.html"> Invoice</a></li>
										<li><a href="mailbox.html">Mailbox</a></li>
										<li><a href="search_page.html">Search page</a></li>
										<li><a href="user_profile.html">User profile</a></li>
										<li><a href="user_static.html">User profile (static)</a></li>
									</ul>
								</li>
								<li>
								</li>
							</ul>
							-->
						</div>
					</div>
				</div>
			</header>    

			<script type="text/javascript">
			     
			    function editProfile(){
				  
				  screenModalDefault();
				  $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลส่วนบุคคล');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Profiles",function(data) {
						$('#customModal2').html(data);
				  });
				  

			    }                

			</script>