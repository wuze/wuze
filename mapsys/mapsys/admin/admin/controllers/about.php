<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library("session");
		$this->load->helper("url");
	}

	public function index()
	{	
		$data['pagetitle'] = "关于我们";
		$this->load->view('about_index',$data);
	}
	
	public function get_about()
	{
		$content = 	$this->input->post('about_us');
		if( $content ){
			$this->load->database();
			$data = array('title'=>'关于我们',
						  'author'=>'admin',
						  'pageview'=>0,
						  'create_time'=>time(),
						  'source'=>'create',
						  'content'=>$content,
						  'writer'=>0,
						  'editor'=>0,
						  'type'=>'other');
			
			if ($this->db->insert('ddnews', $data)){
				$notice = "<script>alert('写入成功')</script>";
			}else{
				$notice = "<script>alert('写入失败')</script>";
			}
		}
		
		$data['notice']=$notice;
		$data['pagetitle']="关于我们";
		redirect('about');
	}
	

	
	


	

}
















/* End of file Show.php */
/* Location: ./admin/controllers/Show.php */