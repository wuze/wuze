<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		session_start();
	}
	
	public function index()
	{
		$ses =  $this->session->userdata('login_user');
		if($ses['login_user_id']&&$ses['login_user_name']){
			$data['pagetitle']="后台管理";
			$this->load->view("admin_home",$data);
		}else{
			$data['pagetitle']="登录";
			$this->load->view('login',$data);
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */