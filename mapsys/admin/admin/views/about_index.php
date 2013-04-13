<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>


<script src="/kindeditor/kindeditor.js" type="text/javascript"></script>
<script>
KE.show({ id:'about_us', imageUploadJson : '/upload_json.php'});
</script>


<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>
    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	<div id="main"><h4><?php echo $html_title; ?></h4></div>
    	
		<div style="border:1px solid #C4D5DF;padding:10px;">
		<form action="<?php echo site_url(array('c'=>'about','m'=>'index')); ?>"   method="POST">
		<div>
		<span style="padding:2px;color:blue;float:left;">编辑关于我们的内容:</span>
		<textarea style="margin-top:2px;" name="about_us" id="about_us" rows="30" cols="100" ><?php echo htmlspecialchars($content); ?></textarea>
		</div>
		<div style="margin-left:80px;margin-top:3px;word-break:break-all;">
		<input  class="submitbtnClass" style="margin-left:80px;"  type="submit" name="submit" value="提交表单">
		</div>
		</form>
		</div>
    </div>
	<div class="iclear"></div>
</div>
<!--{include admin_footer}-->