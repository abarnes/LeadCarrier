<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/fonts/ptsans/stylesheet.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/fluid.css" media="screen" />

<link rel="stylesheet" type="text/css" href="/css/mws.style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/icons/icons.css" media="screen" />

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/css/mws.theme.css" media="screen" />

<!-- JavaScript Plugins -->

<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>

<script type="text/javascript" src="/plugins/placeholder/jquery.placeholder-min.js"></script>

<title>Lead Carrier - Login</title>

</head>

<body>
<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->

	<div id="mws-login-bg">
        <div id="mws-login-wrapper">
            <div id="mws-login">
                <h1>Reset Password</h1>
                <div class="mws-login-lock"><img src="/css/icons/24/locked-2.png" alt="" /></div>
                <div id="mws-login-form">
                    <!--<form class="mws-form" action="dashboard.html" method="post">-->
		    <?php echo $this->Form->create('User', array('action' => 'newpassword','class'=>'mws-form')); ?>
                        <div id="mws-login-error" class="mws-form-message error">
				
                        </div>
                        <div class="mws-form-row">
                            <div class="mws-form-item large">
			    <?php echo $this->Session->flash(); ?>
				<?php echo $this->Form->input('password', array( 'label' => '','placeholder'=>'password','class'=>'mws-login-password mws-textinput')); ?>
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <div class="mws-form-item large">
				<?php echo $this->Form->input('password_confirm', array('label'=>'','type'=>'password','placeholder'=>'confirm password','class'=>'mws-login-password mws-textinput')); ?>
                            </div>
                        </div>
                        <div class="mws-form-row">
			<?php echo $this->Form->input('hash',array('type'=>'hidden','value'=>$hash)); ?>
			<?php echo $this->Form->end(array('label'=>'Reset Password','class'=>'mws-button green mws-login-button')); ?>
                        </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>