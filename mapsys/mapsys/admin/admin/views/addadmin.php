<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>

<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>
    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	
    	<div id="main">增加用户<br></div>
		<div style="border: 1px solid #C4D5DF; margin: 0 auto 10px; padding: 10px;overflow:hidden;zoom:1px;">
			<form action="<?php echo site_url("/addadmin/newaccount"); ?>" method="POST" name="form">
			<table>
				<tr><td>用户名</td>
				<td><input type="text" maxlength="10" name="username"  id="username" value="<?php echo $_POST['username']; ?>">
					<label id="uname" style="color:red;"></label>
				</td></tr>
				<tr><td>电话</td><td>
				<input type="text" name="mobile" onkeyup="this.value=this.value.replace(/\D/g,'');" value="<?php echo $_POST['mobile']; ?>" id="mobile">
				<label id="umobile"></label>
				</tr>
				<tr><td>性别</td><td><input type="radio" <?php if ($_POST['gender']=='M'){  ?> checked <?php }?> name="gender" value="M"><label>男</label>
					<input type="radio" name="gender" value="F" <?php if ($_POST['gender']=='F'){  ?> checked <?php }?>> <label>女</label>
				</tr>
				<tr><td>设置登录密码:</td><td>
					<input type="text" maxlength="10" id="setpwd" name="setpwd" <?php if($_POST['setpwd']){?>value="<?php echo $_POST['setpwd'];?>"<?php }else{?> value="admin" <?php }?>>
				</tr>
				<tr><td colspan="2"><input type="button" name="submit_form" onclick="post_form();" value="提交"></td></tr>
			</table>
			</form>
		</div>
    </div>
	<div class="iclear"></div>
</div>
<script type="text/javascript">
<!--
function	post_form(){
		var username=$('#username').val();
		var pwd = $('#setpwd').val();
		var mobile=$('#mobile').val();

		if( username==''||username.length>10){
			$('#uname').text("账号为必填项，长度在十个字符之内");
			return;
		}else{
			$('#uname').text("");
		}

		if( mobile==''||mobile.length>11){
			$('#umobile').text("请填写正确的手机号码");
			return;
		}else{
			$('#umobile').text("");
		}

		if( pwd==''||pwd.length>10 ){
			$('#upwd').text("密码在十字符以内");
			return;
		}else{
			$('#upwd').text("");
		}

		$('form[name=form]').submit();
		
}
//-->
</script>
<!--{include admin_footer}-->