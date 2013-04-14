<body>
<!--header starts-->
<div id="header">
    <div id="logo">
    	<img src="/admin/images/logo.gif" 	width="100" height="40"/>
    	<img src="/admin/images/title.png" 	width="100" height="40" />
    </div>
    <div style="float:right;margin-right:20px;margin-top:5px; font-size:20px;text-decoration:none;">
    <a href="<?php echo site_url('/logout');?>" >退出</a></div>
</div>
<?php if( $session_error=Session::Get('Error',true)){   ?>

<div class="htip err">
	<?php echo $session_error; ?>
</div>
<?php }?>
<?php if ($session_notice=Session::Get('Success',true) ) { ?>
<div class="htip suc">
	<?php echo $session_notice; ?>
</div>
<?php  }?>
<!--header ends-->
