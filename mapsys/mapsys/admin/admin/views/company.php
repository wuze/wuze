<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>
<script src="/kindeditor/kindeditor.js" type="text/javascript"></script>
<script>
	KE.show({ id:'notice_1', imageUploadJson : '/upload_json.php'});
	KE.show({ id:'lottery_notice', imageUploadJson : '/upload_json.php'});
</script>
<style>
<!--
.formbutton {
    font-size: 14pt;
    font-weight: bolder;
    padding: 2px;
}
-->
</style>
<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>
    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	
    	<div id="main" style="">
	    	<?php if($op_type=='create'){?>
	    	编辑公司简介
	    	<?php }else{ ?>
	    	修改公司简介
	    	<?php }?>
    	</div>

		<div    style=" border: 1px solid #C4D5DF;margin: 0 auto 5px;padding: 5px;">
		<form method="POST" action="<?php echo site_url('/company/com_edit');?>" name="form">		
		<input type="hidden" name="op_type" value="<?php echo $op_type; ?>" />
		<input type="hidden" name="text_id" value="<?php echo $ret['id']; ?>" />
		<table>
		<tr><td>		
			<label>文章录入</label></td>
		<td>
			<input type="text" name="writer" class="input_text" value="<?php echo $ret['writer']; ?>">
			</td>
		</tr>
		
		<tr><td>
			<label>责任编辑</label>
		</td>
		<td>
			<input type="text" name="editor" class="input_text" value="<?php echo $ret['editor']; ?>">
		</td>
		</tr>
		
		<tr>
			<td><label>新闻标题</label></td>
			<td><input type="text" readonly name="title" class="input_text" value="公司简介"></td>
		</tr>
		<tr>
			<td>
				<label>新闻内容【所见即所得】</label>
			</td>
			<td>
				<div style="float:left;">
				<textarea cols="50" rows="5" name="news_content" id="notice_1" style="width:800px;height:400px;">
				<?php echo htmlspecialchars($ret['content']); ?></textarea></div>
				<div class="iclear"></div>
				</td>
			</tr>

			<tr><td colspan="2">
				<div class="field" style="">
				<input id="isubmit" class="formbutton" type="button"  value="确定">
				<div class="iclear"></div>
				</div>
			</td>
			</tr>
			
		</table>
		</form>
		</div>
    </div>
	<div class="iclear"></div>
</div>

<script type="text/javascript">
<!--
$(function(){
	$('#isubmit').click(function(){
		if( $('input[name=writer]').val()){
			$('form[name=form]').submit();
		}else{
			alert("文章录入和编辑不能为空");
		}
	});
})
//-->
</script>

<!--{include admin_footer}-->