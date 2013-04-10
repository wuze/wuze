<?php $this->load->view('header_m'); ?>



<body>
<div class="rgmain">
<div class="rgtit">
<h1>Email订阅</h1>
</div>
<div class="mainbox">
<form action="" method="post" onsubmit="return check();">
<table width="1100" border="0" cellpadding="0" cellspacing="1"
	bgcolor="8dc8e4">
	<caption class="capcenter">Email订阅列表</caption>
	<tr>		
		<th>Email</th>
		<th>订阅时间</th>
		<th>订阅IP</th>
		<th>操作</th>
	</tr>
	<?php foreach ($list as $key => $row) { ?>
	<tr>
		<td><?php echo $row->email;?></td>
		<td><?php echo date("Y-m-d H:i:s", $row->dateline);?></td>
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