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
    	
    	<div id="main" style="">修改新闻内容<br></div>
	
		<div    style=" border: 1px solid #C4D5DF;margin: 0 auto 5px;padding: 5px;">
		<form method="POST" action="<?php echo site_url('/newslist/updatenews');?>" name="form">		
		<input type="hidden" name="news_id" value="<?php echo $ret['id']; ?>">
		<table>
		<tr><td><label>作者</label></td>
		<td><input type="text" name="author" class="input_text" placeholder="必填项"
		value="<?php echo $ret['author'];?>"></td>
		
		</tr>
		
		<tr>
		<td><label>文章类型</label></td>
		<td>
			<select name="source">
				<option <?php if($ret['source']=='create'){?> selected<?php }?> value="create" >原创</option>
				<option <?php if($ret['source']=='link'){?> selected<?php }?> value="link">来自网络</option>
			</select>
		</td>
		</tr>		

		<tr><td>		
			<label>文章录入</label></td>
		<td>
			<input type="text" name="writer" class="input_text" 
			value="<?php echo $ret['writer'];?>">
			</td>
		</tr>
		
		<tr><td>
			<label>责任编辑</label>
		</td>
		<td>
			<input type="text" name="editor" class="input_text" value="<?php echo $ret['editor']; ?>">
		</td>
		</tr>
		
		<tr><td>
			<label>文章发布</label>
		</td><td>
			<select name="show_status">
				<option <?php if($ret['show_status']=='Y'){?> selected<?php }?> value="Y"  >发布</option>
				<option <?php if($ret['show_status']=='N'){?> selected<?php }?> value="N">暂不发布</option>
			</select>
		</td>
		</tr>	
<tr><td>
			<label>新闻标题</label>
			</td><td>			
			<input type="text" name="title" class="input_text" placeholder="必填项"
			value="<?php echo $ret['title'];?>">
<td></tr>

<tr><td>
			<label>发布时间</label>
			</td><td>			
			<input type="text" name="create_time"  
			value="<?php echo date("Y-m-d H:i:s",$ret['create_time']);?>">
<td></tr>


<tr>
<td>
			<label>新闻内容【所见即所得】</label></td>
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
		var title=$('input[name=title]').val();
		if($('input[name=author]').val() && title && title.length<30){
			$('form[name=form]').submit();
		}else if(title.length>30){
			alert("标题过长");
			return;
		}else{
			alert("新闻作者以及文章标题为必填项");
			return;
		}
	});
})
//-->
</script>

<!--{include admin_footer}-->