<?php $this->load->view('header_m'); ?>



<body>
<div class="rgmain">
<div class="rgtit">
<h1>管理中心</h1>
</div>
<div class="mainbox">
<form action="" method="post" onsubmit="return check();">
<table width="1100" border="0" cellpadding="0" cellspacing="1"
	bgcolor="8dc8e4">
	<caption class="capcenter">添加用户</caption>
	<tr>
		<th>ID</th>
		<th>登录名</th>
		<th>用户组</th>
		<th>上次登录时间</th>
		<th>上次登录IP</th>
		<th>登录次数</th>
		<th>操作</th>
	</tr>
	<?php foreach ($list as $key => $row) { ?>
	<tr>
		<td><?php echo $row->adminid;?></td>
		<td><?php echo $row->adminname;?></td>
		<td><?php echo $row->rolename;?></td>
		<td><?php echo date("Y-m-d H:i:s", $row->lastlogin);?></td>
		<td><?php echo $row->lastip;?></td>
		<td><?php echo $row->logintimes;?></td>
		<td><a href="<?php echo site_url(array('c'=>'user','m'=>'edit', 'adminid'=>$row->adminid))?>">修改</a>   <a href="<?php echo site_url(array('c'=>'user','m'=>'del', 'adminid'=>$row->adminid))?>" onclick="javascript:return confirm('你确定要删除该信息？');">删除</a></td>
	</tr>
	<?php } ?>
</table>
</form>
</div>
</div>


<?php $this->load->view('footer'); ?>