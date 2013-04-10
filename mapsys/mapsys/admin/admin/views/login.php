<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站管理员登陆</title>
<script src="/admin/js/jquery.1.4.js" type="text/javascript"></script>



<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #016aa9;
	overflow:hidden;
}
.STYLE1 {
	color: #000000;
	font-size: 12px;
}
-->
</style>


</head>
<?php 
	$this->load->helper('url');
?>

<body>
<form action="<?php echo site_url(array('c'=>'','method'=>'login')); ?>" method="post" name="form">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="235" background="/admin/images/login_03.gif">&nbsp;</td>
      </tr>
      <tr>
        <td height="53"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="394" height="53" background="/admin/images/login_05.gif">&nbsp;</td>
            <td width="206" background="/admin/images/login_06.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" height="25"><div align="right"><span class="STYLE1">用户</span></div></td>
                <td width="57%" height="25"><div align="center">
                  <input type="text" name="admin_id" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                </div></td>
                <td width="27%" height="25">&nbsp;</td>
              </tr>
              <tr>
                <td height="25"><div align="right">
                <span class="STYLE1">密码</span></div></td>
                <td height="25"><div align="center">
                  <input type="password" name="admin_pwd" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                </div></td>
                <td height="25"><div align="left">
                <input type="button" id="submit_btn"   style="width:52px;height:23px;cursor:pointer;background:url(/admin/images/dl.gif)">
                </div>
                </td>
              </tr>
            </table></td>
            <td width="362" background="images/login_07.gif">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr> 
        <td height="213" background="/admin/images/login_08.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>

<script type="text/javascript">
$(function(){
	$('#submit_btn').click(function(){
		var username=$('input[name=admin_id]').val();
		var pwd = $('input[name=admin_pwd]').val();
		if(!username || !pwd || username.length>15||pwd.length>10 ){
			alert("账户或密码格式不对,请请检查");
			return;
		}
		$('form[name=form]').submit();
	});
});


</script>
</html>