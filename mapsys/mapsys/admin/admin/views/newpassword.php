<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>

<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>
    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	<div id="main">修改密码<br></div>
		<div style="border:1px solid #C4D5DF;padding:10px;">
		<form method="post" action="<?php echo site_url('/password_modify/setpwd');?>" name="form">
		<table name="update_pwd" style="border:0px;">
		
		<tr>
			<td style="width:20%;"><label>登录账号：</label></td>
			<td><?php echo $login_username; ?></td>
		</tr>
		<tr>
			<td style="width:20%;"><label>原密码：</label></td>
			<td><input type="password" name="old_pwd"></td>
		</tr>
		<tr>
			<td><label>新密码：</label></td>
			<td><input type="password" name="new_pwd"></td>
		</tr>
		<tr>
			<td><label>再次输入新密码：</label></td>
			<td><input type="password" name="new_pwd_a"></td>
		</tr>
		<tr>
			<td colspan="2"><input  style="margin-left:100px;" type="button" name="submit_form" value="提交修改" onclick="check_data();"></td>
		</tr>
		</table>
		</form>		
		</div>
    </div>
	<div class="iclear"></div>
</div>
<script type="text/javascript">
<!--
 function check_data(){
	
	var  old_pwd = $('input[name=old_pwd]').val();
	var  newpwd  = $('input[name=new_pwd]').val();
	var  newpwd_a= $('input[name=new_pwd_a]').val();

	if(old_pwd==''){
		alert("请输入旧密码!");
		return;
	}else if( !newpwd||!newpwd_a || newpwd.length>10 || newpwd_a.length>10){
		alert("请输入新密码,长度在十个字符之内");
		return;
	}else if( newpwd!=newpwd_a ){
		alert("两次新密码输入结果不同， 请重新输入");
		return;
	}
	$('form[name=form]').submit();
}
//-->
</script>
<!--{include admin_footer}-->
