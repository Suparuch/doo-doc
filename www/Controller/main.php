<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ขายบ้านเดี่ยว, ขายทาวน์เฮ้าส์, ขายที่ดินเปล่า โดย บริษัท บริหารสินทรัพย์สุขุมวิท จำกัด<?php //echo Yii::t('Corperate','company_name');?></title>
<meta name="description" content="ขายบ้านเดี่ยว, ขายทาวน์เฮ้าส์, ขายที่ดินเปล่า โดย บริษัท บริหารสินทรัพย์สุขุมวิท จำกัด" />
<meta name="keywords" content="ขายบ้านเดี่ยว, ขายทาวน์เฮ้าส์, ขายที่ดินเปล่า" />
<meta name="robots" content="all,index,follow,noodp,noydir" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/npa_dt.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/basic-jquery-slider.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-latest.js"></script>
<script language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/amazon_scroller.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/slide.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/basic-jquery-slider.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/thickbox.js"></script>
<link href='<?php echo Yii::app()->request->baseUrl; ?>/images/favicon2.ico' rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ddsmoothmenu.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/thickbox.css" type="text/css"  />

<?php
$setting = Setting::model()->findByPk(1);
$bg = CopIndex::model()->find("part='COP' and `group`='3' and is_selected='1'");

?>
<script language="javascript">
      $(document).ready(function() {
        
        $('#banner').bjqs({
          'animation' : 'fade',
          'width' : 940,
		  'height' : 190,
		  'animationDuration': 650,
		  'rotationSpeed': 4000,
		  'showControls': false,
		  'useCaptions': false,
		  'centerMarkers': false
        });
        
      });
	  function setLang(objLang){
		  $.post('<?php echo Yii::app()->request->baseUrl;?>/index.php/site/SetLang/',{lang:objLang},function(data){
																											  location.reload();
																											  });
	  }
    </script>
<style type="text/css">
@media print{
	.noPrint{
		display:none;
	}
	body {font: fit-to-print;padding:0px;}
}

@page  
{ 
    size: auto;   /* auto is the initial value */ 

    /* this affects the margin in the printer settings */ 
    margin: 5mm;  
} 
	<?php
	if(isset($bg->imgsrc)){
	?>
	body{
		padding-top:0px;
	background-image:url('<?php echo Yii::app()->request->baseUrl. '/images/COP/index/' . $bg->imgsrc;?>');
	background-position:top;
	background-repeat:repeat-x;
	}
	<?php
	}?>
	
	

</style>
<script type="text/javascript">
function printPreview() {
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	if(is_chrome){
		window.print();
	}else{
		var windowWidth=1000;
		var windowHeight=550;
		var myleft=(screen.width)?(screen.width-windowWidth)*0.5:100;    
   		var mytop=(screen.height)?(screen.height-windowHeight)*0.5:100;
		var feature='left='+myleft+',top='+eval(mytop-50)+',width='+windowWidth+',height='+windowHeight+',';
		feature+='menubar=yes,status=no,location=no,toolbar=no,scrollbars=yes';
		window.open(window.location+'/?print_preview=1','welcome',feature);
		<?php
		if(isset($_POST['rdshowtype'])){
			$page= (isset($_POST['page'])?$_POST['page']:"1");
			?>
			$("#page").val('<?php echo $page;?>');
			$("#frm_search").attr("target","welcome");
			$("#frm_search").attr("action",window.location+'/?print_preview=1');
			$("#frm_search").submit();
			$("#frm_search").attr("action",window.location);
			$("#frm_search").removeAttr("target");
			<?php
		}
		?>
	}
}
function clear_form_elements(ele) {

    tags = ele.getElementsByTagName('input');
    for(i = 0; i < tags.length; i++) {
        switch(tags[i].type) {
            case 'password':
            case 'text':
                tags[i].value = '';
                break;
        }
    }
   
    tags = ele.getElementsByTagName('select');
    for(i = 0; i < tags.length; i++) {
        if(tags[i].type == 'select-one') {
            tags[i].selectedIndex = 0;
        }
        else {
            for(j = 0; j < tags[i].options.length; j++) {
                tags[i].options[j].selected = false;
            }
        }
    }

    tags = ele.getElementsByTagName('textarea');
    for(i = 0; i < tags.length; i++) {
        tags[i].value = '';
    }
   
}
function getQuerystring(key, default_)
{
  if (default_==null) default_=""; 
  key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
  var qs = regex.exec(window.location.href);
  if(qs == null)
    return default_;
  else
    return qs[1];
}
$(function(){
		   $(".PrintIt").hide();
		   if(getQuerystring('print_preview')=="1"){
		   		$(".noPrint").hide();
				$(".PrintIt").show();
		   }
		   });
</script>
<body>
<?php
$session=new CHttpSession;
$session->open();
$is_accept = $session['accept'];
$refer = "";


if(!isset($_GET['type'])){
if(isset($_SERVER['HTTP_REFERER'])){
	$session['refer'] = $_SERVER['HTTP_REFERER'];

}
/*
if(isset($session['last_page']))
	$session['refer'] = $session['last_page'];
*/

if(isset($session['refer'])){
	$refer_url = $session['refer'];
	$refer =  strpos($refer_url,"/npa/");	
}


if(isset($_GET['print_preview'])&&$_GET['print_preview']=="1")
	$refer = "print_preview";


if (($refer=="" || $refer<=0) && Yii::app()->controller->action->id != "disclaimer" ){
	if(($is_accept == "" && Yii::app()->controller->action->id != "disclaimer") || $refer==""  )
	{
		if(Yii::app()->controller->action->id != "disclaimer")
		{
			$session['last_page'] = $_SERVER['PHP_SELF'];
			$session['refer'] = $session['last_page'];
		}

	//	$session['refer']="/npa/";
		?>
		<script language="javascript">
			window.location.href='<?php echo Yii::app()->request->baseUrl . '/index.php/npa/disclaimer';?>';
		</script>
		<?php
	}
	//$this->redirect(Yii::app()->request->baseUrl . '/index.php/npa/disclaimer');
}
				}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <?php
	if($setting->show_banner_day=="1"){
	$bday = CopIndex::model()->find("part='COP' and `group`>='2001' and `group`<='2100' and is_selected='1'");
		if(count($bday)>0){
		?>
		<tr class="noPrint">
		
		
		<td align="center" ><img  src="<?php echo Yii::app()->request->baseUrl. '/images/COP/index/' . $bday->imgsrc;?>" width="940" height="72" /></td>
		</tr>
		<?php
	}
	}
?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="header"><table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><a href="<?php echo Yii::app()->request->baseUrl;?>/"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" width="154" height="100" /></a></td>
        <td valign="bottom" class="noPrint"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="327" align="right" class="top_panel2 txt_bold">
                <img src="<?php echo Yii::app()->request->baseUrl;?>/images/member.png" alt="" width="16" height="15" /> 
                <?php 
				$session=new CHttpSession;
				$session->open();
				$user = $session['user'];
				if(isset($user)){
					?>
                     ยินดีต้อนรับ คุณ. <?php echo $user->first_name . ' '  . $user->last_name;?> <a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/MemberLogout/">ออกจากระบบ</a>
                    <?php
				}else{
					?>
                    <a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/MemberLogin/"><?php echo Yii::y('member_login');?></a>
                    <?php
				}
				?>
               
                
                &nbsp;&nbsp;</td>
                <td width="78" align="center" class="top_panel2 txt_bold"><?php if($setting->webmail_show=="1"){
					?>
                E-mail :&nbsp;&nbsp; <a href='<?php echo str_replace('http://http://','http://','http://' . $setting->webmail_link);?>' target="_blank"><img src="<?php echo Yii::app()->baseUrl;?>/images/icon-mail.png" /></a>
                <?php
				}?></td>
                <td align="right" width="174" class="top_panel2 txt_bold"><?php echo Yii::y('language');?> : <?php 
				$model = new Lang();
				$setting = Setting::model()->findByPk(1);
				
				$dlang = $model->search()->data;
				foreach($dlang as $row){
				?>
                <a href="javascript:setLang('<?php echo $row->lang_code;?>')">
                <?php
				
				if($setting->lang_use_icon=="1"){
				?>
                <img src="<?php echo Yii::app()->request->baseUrl;?>/images/flag/<?php echo $row->lang_icon;?>" width="16" height="11" /> 
                <?php
				}
				if($setting->lang_use_text=="1")
					echo $row->lang_txt;
				}
				?></a></td>
                <td align="right"  width="200" class="top_panel txt_bold"><form action="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/showsearch/" method="get" target="_blank">

                <input name="keysearch" type="text" id="keysearch" style="width:150px" title="ค้นหาข้อมูลภายในเว็บไซต์" />
                  <input type="image" src="<?php echo Yii::app()->request->baseUrl;?>/images/b_search.png" width="36" height="20" />
                                  </form></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="31"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/menu_left.png" width="31" height="36" /></td>
                    <td class="menu_top">
                    <strong>
          <script type="text/javascript"> 
ddsmoothmenu.init({
mainmenuid: "smoothmenu_main",
orientation: 'h', 
classname: 'ddsmoothmenu', 
contentsource: "markup"
})
          </script>
          </strong>
          <div id="smoothmenu_main" class="ddsmoothmenu">
            <ul>
              <li><strong><a href="<?php echo Yii::app()->request->baseUrl; ?>/"><?php echo Yii::y('home');?></a></strong></li>
              <li class="bor_left"><strong><a href="javascript:;" target="_parent" ><?php echo Yii::y('about_us');?></a></strong>
                <ul>
                  <?php
                  
				  
						$mm = new ContentGroup();
						$part = 'COP';
						$mm->part = $part;
						$mm->parent_id= '1';	
						$data = $mm->searchByPartAndParent()->data;
						foreach($data as $row){
						 echo "<li style='text-align:left;padding-left:15px;'><a target='content' href='"  . Yii::app()->request->baseUrl . "/index.php/site/group/" . $row->id ."' target='_blank'>&#8226;&nbsp;&nbsp;" . Yii::d($row->group_name_en,$row->group_name_th) . "</a></li>\n";
						}
						 ?>
                         <!--
                         <li><a href="<?php echo Yii::app()->request->baseUrl ;?>/index.php/site/detail/42" target='_blank'>โครงสร้างองค์กร</a></li>
                         <li><a href="<?php echo Yii::app()->request->baseUrl ;?>/index.php/site/detail/138" target='_blank'>รายชื่อกรรรมการ/ผู้บริหาร</a></li>
                         <li><a href="<?php echo Yii::app()->request->baseUrl ;?>/index.php/site/detail/85" target='_blank'>เงื่อนไขการใช้บริการ</a></li>
                         <li><a href="<?php echo Yii::app()->request->baseUrl ;?>/index.php/site/detail/38" target='_blank'>ที่มาขององค์กร</a></li>
                         -->
                         
                </ul>
              </li>
              <li class="bor_left"><strong><a target='content' href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/parent/2"><?php echo Yii::y('news');?></a></strong>
                <ul>
                 <?php
						$mm = new ContentGroup();
						$part = 'COP';
						$mm->part = $part;
						$mm->parent_id= '2';	
						$data = $mm->searchByPartAndParent()->data;
						foreach($data as $row){
						 echo "<li style='text-align:left;padding-left:15px;'><a target='content' href='"  . Yii::app()->request->baseUrl . "/index.php/site/group/" . $row->id ."'>&#8226;&nbsp;&nbsp;" . Yii::d($row->group_name_en,$row->group_name_th) . "</a></li>\n";
						}
						 ?>
                         
                         </ul>
              </li>
              <li class="bor_left"><strong><a target='content' href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/parent/3"><?php echo Yii::y('announcement');?></a></strong>
              <ul>
                 <?php
						$mm = new ContentGroup();
						$part = 'COP';
						$mm->part = $part;
						$mm->parent_id= '3';	
						$data = $mm->searchByPartAndParent()->data;
						foreach($data as $row){
						 echo "<li style='text-align:left;padding-left:15px;white-space: nowrap;'><a target='content' href='"  . Yii::app()->request->baseUrl . "/index.php/site/group/" . $row->id ."'>&#8226;&nbsp;&nbsp;" . Yii::d($row->group_name_en,$row->group_name_th) . "</a></li>\n";
						}
						 ?>
                         
                         </ul>
              </li>
              <li class="bor_left"><strong><a target='content' href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/parent/4"><?php echo Yii::y('public_relation');?></a></strong>
               <ul>
                <li style='text-align:left;padding-left:15px;'><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/ebook/" target='content'>&#8226;&nbsp;&nbsp;<?php echo Yii::y('ebook');?></a></li>
                 <?php
						$mm = new ContentGroup();
						$part = 'COP';
						$mm->part = $part;
						$mm->parent_id= '4';	
						$data = $mm->searchByPartAndParent()->data;
						foreach($data as $row){
						 echo "<li style='text-align:left;padding-left:15px;'><a href='"  . Yii::app()->request->baseUrl . "/index.php/site/group/" . $row->id ."' target='content'>&#8226;&nbsp;&nbsp;" . Yii::d($row->group_name_en,$row->group_name_th) . "</a></li>\n";
						}
						 ?>
                        
                         <li style='text-align:left;padding-left:15px;'><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/photoGallery/" target='content'>&#8226;&nbsp;&nbsp;<?php echo Yii::y('image_gallery');?></a></li>
                         <li style='text-align:left;padding-left:15px;'><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/videoGallery/" target='content'>&#8226;&nbsp;&nbsp;<?php echo Yii::y('vdo');?></a></li>
                         </ul>
              </li>
              <li class="bor_left"><strong><a href="javascript:;"><?php echo Yii::y('contact_us');?></a></strong>
              <ul>
               <?php
						$mm = new ContentGroup();
						$part = 'COP';
						$mm->part = $part;
						$mm->parent_id= '6';	
						$data = $mm->searchByPartAndParent()->data;
						foreach($data as $row){
						 echo "<li style='text-align:left;padding-left:15px;'><a href='"  . Yii::app()->request->baseUrl . "/index.php/site/group/" . $row->id ."' target='content'>&#8226;&nbsp;&nbsp;" . Yii::d($row->group_name_en,$row->group_name_th) . "</a></li>\n";
						}
						 ?>
                         <li style='text-align:left;padding-left:15px;'><a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/site/linkexchange/' target='content'>&#8226;&nbsp;&nbsp;<?php echo Yii::y('link_exchange');?></a></li>
                         <li style='text-align:left;padding-left:15px;'><a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/site/joblist/' target='content'>&#8226;&nbsp;&nbsp;<?php echo Yii::y('job_apply');?></a></li>
              </ul>
              </li>
              
            </ul>
          </div>
          </td>
                    <td width="11"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/menu_right.png" width="11" height="36" /></td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
                <td class="npa_bg txt_bold"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/npa/" target="_blank" style="color:white;"><?php echo Yii::y('npa_menu');?></a></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="bg_main">
	<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr> 
        <td class="npamain_content">
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top" class="">
	<?php echo $content; ?>

	<div class="clear"></div>
</td>
            </tr>
            <tr>
            <td align="right">
            <?php
	  $setting = Setting::model()->findByPk(1);
	  if($setting->twitter_show=="1")
	  {
		  $twitter_icon = "twitter_01.jpg";
		  switch($setting->twitter_icon){
			  case "1":$twitter_icon = "twitter_01.jpg";break;
			  case "2":$twitter_icon = "twitter_03.jpg";break;
			  case "3":$twitter_icon = "twitter_05.jpg";break;
			  case "4":$twitter_icon = "twitter_06.jpg";break;
			  case "5":$twitter_icon = "twitter_08.jpg";break;
			  case "6":$twitter_icon = "twitter_11.jpg";break;
			  case "7":$twitter_icon = "twitter_13.jpg";break;
		  }
		  ?>
          <a href='<?php echo str_replace('http://http://','http://','http://' . $setting->twitter_url);?>' target="_blank"><img src="<?php echo Yii::app()->baseUrl;?>/images/<?php echo $twitter_icon;?>" /></a>
          <?php
	  }
	  
	  if($setting->facebook_show=="1")
	  {
		  $facebook_icon = "twitter_01.jpg";
		  switch($setting->facebook_icon){
			  case "1":$facebook_icon = "fb_icon1.jpg";break;
			  case "2":$facebook_icon = "fb_icon2.jpg";break;
			  case "3":$facebook_icon = "fb_icon3.jpg";break;
			  case "4":$facebook_icon = "fb_icon4.jpg";break;
			  case "5":$facebook_icon = "fb_icon5.jpg";break;
			  case "6":$facebook_icon = "fb_icon6.jpg";break;
			  case "7":$facebook_icon = "fb_icon7.jpg";break;
		  }
		  ?>
          <a href='<?php echo str_replace('http://http://','http://','http://' . $setting->facebook_url);?>' target="_blank"><img src="<?php echo Yii::app()->baseUrl;?>/images/<?php echo $facebook_icon;?>" /></a>
          <?php
	  }
	  ?>
            </td>
            </tr>
          </table></td>
      </tr>
      </table>
	 </td>
      </tr>
    </table></td>
  </tr>
  <tr class="noPrint" >
    <td class="footer"><table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="txt_footer"><p class="txt_bold">
        <?php
		$ft = Footer::model()->findByPk(2);
		echo $ft->footer_th;
		?>
        </p>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
<script type="text/javascript">

 

  var _gaq = _gaq || [];

  _gaq.push(['_setAccount', 'UA-30713189-1']);

  _gaq.push(['_trackPageview']);

 

  (function() {

    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

  })();

 

</script>

</body>
</html>

