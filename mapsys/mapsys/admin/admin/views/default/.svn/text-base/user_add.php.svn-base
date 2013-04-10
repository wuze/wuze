<?php $this->load->view('header_m'); ?>



<body>
<div class="rgmain">
<div class="rgtit">
<h1>管理中心</h1>
</div>
<div class="mainbox">
<form action="<?php echo site_url(array('c'=>'user','m' =>'create'));?>" method="post" onsubmit="return check();">
<table width="1100" border="0" cellpadding="0" cellspacing="1"
	bgcolor="8dc8e4">
	<caption class="capcenter">添加用户</caption>
	<tr>
		<th>登录名：</th>
		<td class="whtco"><input name="data[username]" id="username" value="<?php echo $user->adminname; ?>" type="text"><i></i></td>
	</tr>
	<tr>
		<th>登录密码：</th>
		<td class="whtco"><input name="data[password]" id="password" value="" type="password"><?php if($user->adminid){?>为空则不修改密码 <?php }?></td>
	</tr>
	<tr>
		<th>用户组：</th>
		<td class="whtco">
			<select id="gid" name="data[gid]">
				<option value="0">请选择</option>
				<?php foreach ($roles as $key => $value) { ?>
				 <option <?php if($user->gid == $value->role_id){ ?> selected <?php }?> value="<?php echo $value->role_id;?>"><?php echo $value->rolename;?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td colspan="2" class="tr_last" >
		<?php if($user->adminid) { ?>
		<input type="hidden" value="data[adminid]" value="<?php echo $user->adminid; ?>">
		<?php } ?>
			<input type="submit" id="" class="sub_btn mr10" value="保存" style="cursor: pointer;"/>
			<input type="reset" id="" class="sub_btn mr10" value="重置" style="cursor: pointer;" />
		</tr>
</table>
</form>
</div>
</div>


<script type="text/javascript">
//检测用户
function check(){

	if(!$("#username").val()){
		alert("登录名不能为空");
		$("#username").focus();
		return false;
	}
	<?php if(!$user->adminid) { ?>
	if(!$("#password").val()){
		alert("登录密码不能为空");
		$("#password").focus();
		return false;
	}
	<?php }?>
	if(!$("#gid").val()){
		alert("请选择组");
		$("#gid").focus();
		return false;
	}
}

<?php if(!$user->adminid) { ?>
$("#username").bind("blur", function(){
	$.post("<?php echo site_url( array( 'c' => 'user', 'm' => 'create') );?>", {checkname: $("#username").val()}, function(data){

				if(data ==  0){
					$("#username").next().empty();
				}
				else{
					$("#username").next().html('此用户已存在，请使用其他用户名');
					$("#username").focus();
				}
			})
});

<?php }?>
</script>


<?php $this->load->view('footer'); ?>