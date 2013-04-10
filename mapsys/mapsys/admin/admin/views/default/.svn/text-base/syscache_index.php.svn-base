<?php $this->load->view('header_m'); ?>



<body>
<div class="rgmain">
<div class="rgtit">
<h1>系统缓存</h1>
</div>
<div class="mainbox">
<form action="<?php echo site_url(array('c' => 'syscache', 'm' => 'allcache'));?>" method="post" onsubmit="">
<table width="1100" border="0" cellpadding="0" cellspacing="1"
	bgcolor="8dc8e4">
	<caption class="capcenter">生成系统缓存</caption>
	<tr>
		<th><input name="selall" id="selall" type="checkbox" value="1"/>全选</th>
		<th>类型</th>		
		
	</tr>
	<tr style="text-align: center">
		<td><input name="data[course]" type="checkbox" value="1"/></td>
		<td> 科目分类</td>
		
	</tr>
	<tr style="text-align: center">
		<td><input name="data[caetegory]" type="checkbox" value="1"/></td>
		<td> 年级分类</td>
		
	</tr>
	<tr style="text-align: center">
		<td><input name="data[news]" type="checkbox" value="1"/></td>
		<td> 新闻分类</td>
	
	</tr>
	
	<tr>
		<td colspan="3" style="text-align: center"><input name="submit" value="生成" type="submit" /></td>
	</tr>
	</table>
</form>
</div>
</div>

<script type="text/javascript">
	$("#selall").click(function(){
		flag = $("#selall").attr('checked');
		
		if(flag == 'checked'){
			$("input[type=checkbox]").attr('checked','checked');
		}
		else{
			$("input[type=checkbox]").removeAttr('checked');
		}
	})
</script>


<?php $this->load->view('footer'); ?>