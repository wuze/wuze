<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
	}

	public function index(){
		
		$sql = " SELECT * FROM ddnews WHERE type='news' ".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT 0,8";
		$ret = $this->db->query( $sql );
		
		foreach( $ret->result_array() as  $row ){
			$news[] = $row;
		}
		
		$data['news_list'] = $news;
		
		$sql = " SELECT * FROM ddnews WHERE type='contact_us'".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT 1";
		$ret = $this->db->query( $sql );
		$ret = $ret->row_array();
		
		$result = unserialize( $ret['content'] );
		
		
		
		$cc = "UPDATE ddnews SET pageview=pageview+1 WHERE id=".$ret['id'];
		$sql = $this->db->query( $cc );
		
		$data['ret'] = $ret;
		$data['contact_us'] =  $result;
		$data['page_title']="联系我们";
		$this->load->view('contact_us',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */