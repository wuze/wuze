<?php $this->load->view('header_m'); ?>



<body>
<div class="rgmain">
<div class="rgtit">
<h1>信息收集</h1>
</div>
<div class="mainbox">
<form action="" method="post" onsubmit="return check();">
<table width="1100" border="0" cellpadding="0" cellspacing="1"
	bgcolor="8dc8e4">
	<caption class="capcenter">信息收集列表</caption>
	<tr>		
		<th>ID</th>
		<th>姓名</th>
		<th>类型</th>
		<th>所在年级</th>
		<th>添加时间</th>
		<th>添加IP</th>
		<th>操作</th>
	</tr>
	<?php foreach ($list as $key => $row) { ?>
	<tr>
		<td><?php echo $row->remindid;?></td>
		<td><?php echo $row->name;?></td>
		<td><?php echo $row->type;?></td>
		<td><?php echo $row->catid;?></td>
		<td><?php echo date("Y-m-d H:i:s", $row->addtime);?></td>
		<td><?php echo $row->addip;?></td>	
		
		<td><a onclick="javascript:return confirm('你确定要删除该信息？');" href="<?php echo site_url(array('c'=>'contact','m'=>'delemail', 'email'=>$row->email))?>">删除</a></td>
	</tr>
	<?php } ?>
</table>
</form>
</div>
<?php echo $page;?>
</div>


<?php $this->load->view('footer'); ?>