<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password_modify extends MY_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper("url");
		$this->load->helper('common');
	}
	
	
	public function index()
	{	
		$this->load->database();
		
		$login_user = $this->session->userdata('login_user');
		$data['login_username'] = $login_user['login_user_name'];
		$data['pagetitle'] = "修改密码";
		$this->load->view('newpassword',$data);
	}
	
	public function setpwd(){
		$oldpwd 	= strval($_POST['old_pwd']);
		$newpwd 	= strval($_POST['new_pwd']);
		$newpwd_a 	= strval($_POST['new_pwd_a']);
		$login_user = $this->session->userdata('login_user');
		
		if( $oldpwd && $newpwd && $newpwd_a && $newpwd_a==$newpwd ){
			    
   			
	  		$pwd_str =  PWD_STRING;
	  		$enpwd = md5($pwd_str.$newpwd);
	  		$condition = array('adminpass'=>$enpwd);
	  		$where = "id=".$login_user['login_user_id'];
	  		
			$str = $this->db->update_string('ddadmin',$condition,$where);
			$result = $this->db->query( $str );

			if( $result>0){
				$notice="<script>alert('已经修改完成');</script>";
			}else {
				$notice="<script>alert('已经修改失败');</script>";
			}
			$data['notice']=$notice;
		}
		redirect('');
	}
	
	

}

/* End of file Contact.php */
/* Location: ./admin/controllers/Contact.php */