<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	$login = array("Login" => array('menu' => 'index','show' => 1)
*/
class Logout extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	/**
	 * 退出登录
	 */
	public function index(){
		if( $this->session->userdata('login_user')){
			$this->session->unset_userdata('login_user');
		}
		redirect('');
	}
	
	


}

/* End of file login.php */
/* Location: ./admin/controllers/login.php */