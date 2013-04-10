<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactus extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		session_start();
	}
	
	
	var $notice = "";
	public function index()
	{	
		 $data['pagetitle'] = "联系我们";
		$this->load->database();
		$this->load->view('contact',$data);
		
	}
	
	public function write_contact(){
		
	
		$condition['company'] = strval($_POST['company']);
		$condition['contact'] = strval($_POST['contact']);
		if(is_array($_POST['phone'])){
			foreach ($_POST['phone'] as $k=>$v ){
				$condition['phone'][]   = intval($v);
			}
		}else{
			$condition['phone'] = $_POST['phone'];
		}
		
		$condition['fax'] 	  = strval($_POST['fax']);
		$condition['addr']    = strval($_POST['addr']);
		
		$da['content'] = serialize($condition);
		$da['type']= 'contact_us';
		$da['writer']="0";
		$da['editor']="0";
		$da['create_time']=time();
		$da['pageview']=1;
		$da['author']="admin";
		$da['title']="联系方式";
		
		$select= "SELECT  * FROM ddnews WHERE type='contact_us'";
		$ret = $this->db->query( $select );
		if( $ret->num_rows()>0){
			$where = " type='contact_us' ";
			$str = $this->db->update_string('ddnews',$da,$where);
			$result = $this->db->query( $str );
		}else{
			$str = $this->db->insert_string('ddnews', $da);
			$result=$this->db->query($str);
		}
		if( $result>0){
				$notice="<script>alert('写入完成');</script>";
		}else {
				$notice="<script>alert('写入失败');</script>";
		}	
		
		$data['notice'] = $notice;
		$this->load->helper("url");
		redirect('contactus');
	}
}

/* End of file Contact.php */
/* Location: ./admin/controllers/Contact.php */