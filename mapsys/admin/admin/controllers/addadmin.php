<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addadmin extends MY_Controller {

	var $notice='';
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
	    $this->load->helper('common');
	    $this->load->library('session');
		$this->login_user = $this->session->userdata('login_user');
	}
	public function index(){
		$data['pagetitle'] = "增加用户";
		if(!$this->login_user){
			$data['pagetitle']="登录";
			$this->load->view('login',$data);
		}
		$this->load->view('addadmin',$data);
	}

	public function newaccount(){

		$username 	= strval($_POST['username']);
		$mobile 	= strval($_POST['mobile'])?strval($_POST['mobile']):0;
		$gender 	= strval($_POST['gender']);
		$setpwd		= $this->input->post('setpwd');
		
		$condition = array('adminname'=>$username);
		$str = "select adminname from ddadmin where adminname = '".$username."' LIMIT 0,1";
		$result = $this->db->query( $str );
		
		$ret = $result->num_rows();
		
		if(!$ret){
	  		$pwd_str =  PWD_STRING;
	  		$setpwd = md5($pwd_str.$setpwd);

			$insert_data = array('adminname'=>$username,'adminpass'=>$setpwd,'gender'=>$gender,'create_time'=>time(),'phone'=>$phone);
			$insert_str = $this->db->insert_string("ddadmin",$insert_data);
			$insert_id = $this->db->query( $insert_str );
			
			if($insert_id){
					$notice="<script>alert('恭喜，新管理员添加成功');</script>";
			}
			
		}else{
					$notice="<script>alert('该用户名已存在，请换个用户名');</script>";
		}
		
		$data['notice']=$notice;
		$data['pagetitle'] = "增加用户";
		$this->load->view('addadmin',$data);
	}
}



/* End of file Contact.php */
/* Location: ./admin/controllers/Contact.php */