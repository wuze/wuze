<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intro extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
	}
	
	public function index()
	{
		
		$sql = " SELECT * FROM ddnews WHERE type='news' ".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT 0,8";
		$ret = $this->db->query( $sql );
		
		foreach( $ret->result_array() as  $row ){
			$news[] = $row;
		}
		
		$data['news_list'] = $news;
		
		
		$sql = " SELECT * FROM ddnews WHERE type='other'".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT 1";
		$ret = $this->db->query( $sql );
		$ret = $ret->row_array();
		
		
		$cc = "UPDATE ddnews SET pageview=pageview+1 WHERE id=".$ret['id'];
		$sql = $this->db->query( $cc );
		
		
		$data['ret'] =  $ret;
		$data['page_title']="公司介绍";
		$this->load->view('company_intro',$data);
	}
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */