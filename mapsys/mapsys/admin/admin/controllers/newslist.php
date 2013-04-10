<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newslist extends MY_Controller {

	var $notice;
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library("session");
		$this->load->helper("url");
	}
	
	public function index()
	{	
		$this->db->select("*");
		$this->db->where('type','news');
		$this->db->order_by("create_time", "DESC");
		$ret = $this->db->get("ddnews");
		
		foreach( $ret->result_array() as $row){
			$list[] = $row;
		}
		
		if( $this->session->userdata('notice')){
			$notice = 	 $this->session->userdata('notice');
			$this->session->unset_userdata('notice');
		}
		
		$data['notice'] =  $notice;
		$data['list'] = $list;
		$data['pagetitle'] = "新闻列表";
		$this->load->view('news_list',$data);
	}
	
	
	public function news_edit(){
		
		if( $this->session->userdata('notice')){
			$notice = 	 $this->session->userdata('notice');
			$this->session->unset_userdata('notice');
		}
		$data['notice'] =  $notice;
		$data['pagetitle'] = "编辑新闻";
		$this->load->view('news_edit',$data);
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
		$data['pagetitle'] = "新闻列表";
		$this->load->view('news_update',$data);
	}
	/**
	 * 修改新闻
	 * Enter description here ...
	 */
	public function updatenews(){
		
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
		$condition['type']			 = 'news';
		
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
		redirect('newslist');
	}
	
	public function addnews(){
		
		$condition['show_status'] 	= $this->input->post('show_status');
		$condition['create_time'] 	= time();
		$condition['author']		= $this->input->post('author');
		$condition['source']		= $this->input->post('source');
		$condition['writer']		= $this->input->post('writer')?$this->input->post('writer'):'admin';
		$condition['editor']		= $this->input->post('editor')?$this->input->post('editor'):'admin';
		$condition['title']         = $this->input->post('title')?$this->input->post('title'):'admin';
		$condition['content'] 		= $this->input->post('news_content')?$this->input->post('news_content'):'admin';
		$condition['type']			= "news";
		
		$sql_str = $this->db->insert_string('ddnews',$condition);
		$ret = $this->db->query( $sql_str );
		if( $ret>0 ){
			$notice = "<script>alert('成功');</script>";
		}else{
			$notice = "<script>alert('写入失败');</script>";
		}
		
		$this->session->set_userdata('notice',$notice);
		redirect('/newslist/news_edit');
	}
	/**
	 * 显示新闻到前台
	 * Enter description here ...
	 */
	public function updateshow(){
		
		$newsid = intval($_POST['id']);
		$showstate = strval($_POST['show']);
	
		$str = " UPDATE ddnews SET  `show_status`='".$showstate."' WHERE id=".$newsid;
		$ret = $this->db->query( $str );
		
		if( $ret>0 )
			echo "1-SUCCESS";
		else 
			echo "0";
	}
	
	/**
	 * 删除一条新闻
	 * Enter description here ...
	 */
	public function del(){
		
		$newsid = strval($_POST['id']);
		$str = " DELETE FROM ddnews WHERE id=".$newsid;
		$ret = $this->db->query( $str );
		
		if( $ret>0 )
			echo "1-SUCCESS";
		else 
			echo "0";
	}
}

/* End of file Show.php */
/* Location: ./admin/controllers/Show.php */