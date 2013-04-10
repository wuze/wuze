<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>

<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>
    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	<div id="main">联系我们<br></div>
    	<hr/>
		<div style="margin-top:2px;border:1px solid #C4D5DF;padding:10px;">
		<form action="<?php echo site_url('/contactus/write_contact'); ?>" method="POST" name="form">
			<table name="contact">
			<tr><td width=20%>企业名称:</td><td><input type="text" placeholder="这里填写您公司的全称" name="company"><label id="cp_note" style="color:red;"></label></td></tr>
			<tr><td>联系人：</td><td><input type="text" placeholder="这里填写联系人的全名" name="contact"><label id="pep_note" style="color:red;"></label></td></tr>
			<tr><td>手机:</td><td><input type="text" placeholder="这里填写联系电话" onkeyup="this.value=this.value.replace(/\D/g,'');" name="phone[]">
						<input type="button" name="addphones" value="再填一个手机号" onclick="addnode();" id="addphones"><label id="phone_note" style="color:red;"></label>
			</td></tr>
			<tr><td>电话/传真:</td>
			<td><input type="text" placeholder="电话或者传真"  name="fax"><label id="fax_note" style="color:red;"></label></td>
			</tr>
			
			<tr>
				<td>地址：</td>
				<td><textarea name="addr"></textarea><label id="addr_note" style="color:red;"></label></td>
			</tr>
			<tr>
				<td colspan="2"><input type="button" name="submmit"  onclick="submit_form();" value="提交"></td>
			</tr>
			</table>
		</form>
		</div>
    </div>
	<div class="iclear"></div>
</div>
<script type="text/javascript">
<!--
	function addnode(){
		var str = "<input type=\"text\" placeholder=\"这里填写联系电话\" onkeyup=\"this.value=this.value.replace(/\D/g,'');\" name=\"phone[]\">";
		$('#addphones').before( str );
	}

	function submit_form(){
		if($('input[name=company]').val()==''){
			$('#cp_note').text('企业名称不能为空');
			return ;
		}else{
			$('#cp_note').text('');
		}

		if($('input[name=contact]').val()==''){
			$('#pep_note').text('联系人不能为空');
			return ;
		}else{
			$('#pep_note').text('');
		}

		$flag = 0;
		$('input[name=phone[]]').each(function(){
			if( $(this).val()!='' )
				$flag++;
		});
		if($flag==0){
			$('#phone_note').text('至少要填写一个手机号码');
			return ;
		}else{
			$('#phone_note').text('');
		}
		
		if($('input[name=company]').val()==''){
			$('#addr_note').text('地址信息不为空');
			return ;
		}else{
			$('#addr_note').text('');
		}

		$('form[name=form]').submit();		
	}
//-->

</script>

<!--{include admin_footer}-->