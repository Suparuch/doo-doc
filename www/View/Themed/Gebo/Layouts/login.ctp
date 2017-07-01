<!DOCTYPE html>
<html lang="en" class="login_page">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo Configure::read('Application.Name');?> : Login</title>

	<!-- favicon -->
        <link rel="shortcut icon" href="favicon.ico" />
    
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<?php
        //Bootstrap framework
        echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->css('bootstrap-responsive.min.css');
        //theme color-->
        echo $this->Html->css('blue.css');
        //tooltip    
        echo $this->Html->css('lib/qtip2/jquery.qtip.min.css');
        //main styles
        echo $this->Html->css('style.css');

	echo $this->fetch('css');

	//----------------------------------------------------------------------------------------------------------
	?>
    
        <!--[if lt IE 9]>
	<?php
        echo $this->Html->script('ie/html5');
        echo $this->Html->script('ie/respond.min');
	?>
        <![endif]-->
	
    </head>
    <body>
		
	<?php echo $this->fetch('content'); ?>

	<?php	 
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('jquery.actual.min');
        echo $this->Html->script('lib/validation/jquery.validate');
        echo $this->Html->script('bootstrap.min');

	echo $this->fetch('script');

	?>
        <script>
            $(document).ready(function(){
                
				//* boxes animation
				form_wrapper = $('.login_box');
				function boxHeight() {
					form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24 - 180)},300);	
				};
				form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24 - 180) });
				$('.linkform a,.link_reg a').on('click',function(e){
							var target	= $(this).attr('href'),
								target_height = $(target).actual('height');
							$(form_wrapper).css({
								'height'		: form_wrapper.height()
							});	
							$(form_wrapper.find('form:visible')).fadeOut(400,function(){
								form_wrapper.stop().animate({
					    height	 : target_height,
									marginTop: ( - (target_height/2) - 24 - 180)
					},500,function(){
					    $(target).fadeIn(400);
					    $('.links_btm .linkform').toggle();
									$(form_wrapper).css({
										'height'		: ''
									});	
					});
							});
							e.preventDefault();
						});
						
						//* validation
						$('#login_form').validate({
							onkeyup: false,
							errorClass: 'error',
							validClass: 'valid',
							rules: {
								username: { required: true, minlength: 3 },
								password: { required: true, minlength: 3 }
							},
							highlight: function(element) {
								$(element).closest('div').addClass("f_error");
								setTimeout(function() {
									boxHeight()
								}, 200)
							},
							unhighlight: function(element) {
								$(element).closest('div').removeClass("f_error");
								setTimeout(function() {
									boxHeight()
								}, 200)
							},
							errorPlacement: function(error, element) {
								$(element).closest('div').append(error);
							}
						});
            });
        </script>
	
    </body>

</html>
