<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>

<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>
    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	
    	<div id="main">上传景观图片<br></div>
		<div style="border: 1px solid #C4D5DF; margin: 0 auto 10px; padding: 10px;overflow:hidden;zoom:1px;">
		
			<table width="1100" border="0" cellpadding="0" cellspacing="1" bgcolor="8dc8e4">
			<caption class="capcenter">上传景观图片</caption>
			<tr>
				<th>图片：</th>
				<td>
					<form action="<?php echo site_url('/viewlist/upload/');?>" id="image_upload" name="image_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<input type="file" name="userfile" size="20" id="img"/>
						<input type="text" name="alias" placeholder="建议输入文件名称">
						<input type="submit" value="上传" id="submit_img" name="submit_img"/>
					</form>
				</td>
			</tr>
			<tr>
				<th>图片预览：</th>
				<td><div id="avatar-preview" name="avatar-preview">
					<img width="163" height="162" src="<?php echo $upload_view;?>">				
				</div></td>
			</tr>
			</table>
		</div>
    </div>
	<div class="iclear"></div>
</div>

<script type="text/javascript">
<!--

function UPLOAD_CALLBACK(photo) {
		$("#avatar-preview").html('<img width="100" height="100" class="zoom" src="' + photo + '"/>');
		$('#img_path').val(photo);
}

//-->
</script>
<!--{include admin_footer}-->