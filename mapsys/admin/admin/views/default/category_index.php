<?php $this->load->view('header_m'); ?>
<style  type="text/css">
.bdrcontent{
	border:1px solid #FF8E00;
	padding:1em;
}
</style>

<body>
<div class="rgmain">
<div class="rgtit">
<h1>年级列表</h1>
</div>
<div class="mainbox">
<div >
<form method="post" action="<?php echo site_url(array('c'=>'category', 'm' => 'add'));?>">
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="8dc8e4">
	<caption class="capcenter">添加年级分类</caption>
	<tr>
		<th>添加分类名：</th>
		<td><input type="text" name="newscates"/>
		<input type="submit" style="cursor:pointer;" class="sub_btn mr10" value="添加" />
		</td>
	</tr>
	</table>
	</form>
</div>

<div style="margin-top:10px;">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="8dc8e4">
		<caption class="capcenter">当前已有年级分类</caption>
		<tbody>
			<tr>				
				<th >分类ID</th>
				<th >分类名</th>
				<th>管理</th>
			</tr>
		</tbody>
		
	<?php if(is_array($list)):  foreach ($list as $key=>$value): ?>
	
	<tr style="text-align:center;" id="tr_<?php echo $value->catid;?>">
		
		<td><?php echo $value->catid; ?></td>
		<td style="text-align:left;"><?php echo $value->name_suff .  $value->catname ?></td>
		<td> <a href="<?php echo site_url(array('c'=>'category', 'm' => 'edit', 'catid' => $value->catid ));?>"  >修改</a> <a href="<?php echo site_url(array('c'=>'category', 'm' => 'add', 'parentid' => $value->catid ));?>"  >增加下级</a> <a href="<?php echo site_url(array('c'=>'category', 'm' => 'del', 'catid' => $value->catid ));?>"  >删除</a></td>
	<?php endforeach;  endif;?>
	</table>
</div>
</div>
</div>

<?php $this->load->view('footer'); ?>