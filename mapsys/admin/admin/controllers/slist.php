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
	 * 修改新闻
	 * Enter description here ...
	 */
	public function updatebaike(){
		
		$news_id = $this->input->post("news_id");
		$condition['show_status'] 	= $this->input->post('show_status');
		$condition['create_time'] 	= time();
		$condition['author']		= $this->input->post('author');
		$condition['source']		= $this->input->post('source');
		$condition['writer']		= $this->input->post('writer')?$this->input->post('writer'):'admin';
		$condition['editor']		= $this->input->post('editor')?$this->input->post('editor'):'admin';
		$condition['title']         = $this->input->post('title')?$this->input->post('title'):'admin';
		$condition['content'] 		= $this->input->post('news_content')?$this->input->post('news_content'):'admin';
		$condition['create_time']   = $this->input->post('create_time')?strtotime($this->input->post('create_time')):time();
		$condition['type']			 = 'tree';
		
		if( $news_id ){
	  		$where = "id=".$news_id;
	  		
			$str = $this->db->update_string('ddnews',$condition,$where);
			$ret = $this->db->query( $str );
			
			if( $ret>0 ){
				$notice = "<script>alert('修改成功');</script>";
			}else{
				$notice = "<script>alert('修改失败');</script>";
			}
			$this->session->set_userdata('notice',$notice);
		}else{
			$notice = "<script>alert('ID为空修改失败');</script>";
			$this->session->set_userdata('notice',$notice);
		}
		redirect('slist');
	}
	


	
	/**
	 * 删除一记录
	 * Enter description here ...
	 */
	public function delItem(){
		
		$newsid = strval($_POST['id']);
		$str = " DELETE FROM category WHERE id=".$newsid;
		$ret = $this->db->query( $str );
		
		echo $this->db->last_query();
		die;
		
		if( $ret>0 )
			echo "1";
		else 
			echo "0";
	}
}

/* End of file Show.php */
/* Location: ./admin/controllers/Show.php */