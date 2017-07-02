	<style type='text/css'>
	.top_head{
		min-width:120px;
		max-width:inherit;
	}
	</style>		
			<?php
			
				$currentUser = $this->Session->read('AuthUser');
				//print_r($currentUser);
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

                            <img src="../img/bg_header.png"  class='top_head'>

						</div>
					</div>
				</div>

			</header>
            
            <div class="new-tab-row">
                <div class="new-tab-row-box">
                <a class="brand" href="<?php echo $this->Html->url(array("controller" => "/"));?>"><i class="icon-home icon-white"></i> <?php 
				//echo $currentUser['Unit']['short_name'];
				?>รับ - ส่ง กรมยุทธการทหารบก <span class="sml_t"></span></a>
                
                <ul class="nav user_menu pull-right">
								<li class="divider-vertical hidden-phone hidden-tablet"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" >
									<!--<img src="<?php echo $this->Html->url('/FileProviders/index/', true);?><?php echo $user_avatar;?>" alt="" class="user_avatar"/>-->
									<?php echo $user_name;?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#myModal2" onclick="editProfile()" data-toggle="modal">ข้อมูลส่วนตัว</a></li>
										<li class="divider"></li>
										<li><?php echo $this->Html->link('ออกจากระบบ',array('controller'=>'Logouts'));?></li>
									</ul>
								</li>
							</ul>
                            
                </div>
                </div>  

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