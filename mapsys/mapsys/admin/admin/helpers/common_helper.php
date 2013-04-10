<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('PWD_STRING',     '*&^)&_!');

/**
 * 验证登录
 */
function needlogin(){
	$this->load->library('session');
	$login_user = $this->session->userdata('login_user');
	if( !$login_user['login_user_id']||!$login_user['login_user_name'] ){
		showmessage("请先登录");
		redirect("/admin/index.php");
	}
}