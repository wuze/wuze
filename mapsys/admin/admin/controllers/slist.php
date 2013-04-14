<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 索引类信息
 * @author Administrator
 *
 */
class slist extends MY_Controller {

	var $notice;
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function index()
	{	
		$this->load->library("Pagination");
		$ret = $this->db->get("category");
		$config['base_url'] = base_url()."index.php/slist/index";
		$config['total_rows'] =  $ret->num_rows();
		$config['per_page']   =  1;
		$config['first_link'] =  "首页";
		$config['last_link']  =  "尾页";
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['anchor_class']   = "class='pagea'";
		
		$this->pagination->initialize( $config );
		$query = $this->db->get('category',$config['per_page'],$this->uri->segment(3));
		foreach( $query->result_array() as $row){
			$list[] = $row;
		}
		
		$data['list'] = $list;
		$data['html_title'] = "索引类列表";
		$this->load->view('slist',$data);
	}
	
	
	public function update_index(){
		
		if( $this->session->userdata('notice')){
			$notice = 	 $this->session->userdata('notice');
			$this->session->unset_userdata('notice');
		}
		
		$news_id =  $this->uri->segment(3);
		
		$this->db->select("*");
		$this->db->from("ddnews");
		$this->db->where("id",$news_id);
		$result = $this->db->get();
		
		$ret = $result->row_array();
		
		$data['ret']    = $ret;
		$data['notice'] =  $notice;
		$data['pagetitle'] = "百科列表";
		$this->load->view('baike_update',$data);
	}

	
	/**
	 * 删除一记录
	 * Enter description here ...
	 */
	public function delItem(){
		
		$newsid = strval($_POST['cid']);
		
		if( $newsid )
		{
			$str = " DELETE FROM map_category WHERE id=".$newsid;
			$ret = $this->db->query( $str );
		}
		if( $ret>0 )
		{
			Session::Set("Success","删除成功");
			echo "1";
		}
		else
		{
			Session::Set("Error","删除失败"); 
			echo "0";
		}
	}
}

/* End of file Show.php */
/* Location: ./admin/controllers/Show.php */