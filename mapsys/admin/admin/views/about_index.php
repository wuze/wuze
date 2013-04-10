<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>

<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>
    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	<div id="main"><?php echo $pagetitle; ?><br></div>
		<div style="border:1px solid #C4D5DF;padding:10px;">
		<form action="<?php echo site_url(array('c'=>'about','m'=>'get_about')); ?>"   method="POST">
		<div>
		<span style="padding:2px;color:blue;float:left;">编辑关于我们的内容:</span>
		<textarea style="margin-top:2px;" name="about_us" rows="5" cols="100">
		</textarea>
		</div>
		<div style="margin-left:80px;margin-top:3px;word-break:break-all;">
		<input style="margin-left:80px;"  type="submit" name="submit" value="提交表单">
		</div>
		</form>
		</div>
		
    </div>
	<div class="iclear"></div>
</div>
<!--{include admin_footer}-->