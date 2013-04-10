<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plant extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
		$this->load->library("mypage_class");
	}
	
	
	
	public function index()
	{
		$page_config['url']='/plant/showlist';//url
		$page_config['perpage']=8;   //每页条数
		$page_config['part']=2;//当前页前后链接数量
		$page_config['seg']=3;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		$page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		$this->load->library('mypage_class');
		
		$sql = " SELECT COUNT(1) as cnt FROM ddnews WHERE type='tree' ".
			   " AND show_status='Y' ORDER BY create_time  ";
		
		$rows = $this->db->query( $sql );
		$row_data = $rows->row();
		$row_num = $rows->row_array();
		
		$page_config['total']=$row_num['cnt'];
		$this->mypage_class->initialize($page_config);
		
		$offset = ($page_config['nowindex']-1)*$page_config['perpage'];
		
		$sql = " SELECT * FROM ddnews WHERE type='tree' ".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT ".$offset.",".$page_config['perpage'];
		
	
		$ret = $this->db->query( $sql );
		
		$news = array();
		foreach( $ret->result_array() as  $row ){
			$news[] = $row;
		}
		
		if( $news ) $data['plant_list'] = $news;
		else $data['plant_list']='';
		
		$sql = " SELECT * FROM ddnews WHERE type='news' ".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT 0, 8";
		$ret = $this->db->query( $sql );
		foreach( $ret->result_array() as $b ){
			$bb[] = $b;
		}
		$data['total'] = $page_config['total'];
		$data['news_part'] = $bb;
		$data['page_title']="苗木百科";
		$this->load->view('plant_show',$data);
	}
	
	
	
	public function showplant(){
		
		$id = $this->uri->segment(3);
		if( $id ){
			$sql = "SELECT * FROM ddnews WHERE id=".intval($id);
			$result = $this->db->query($sql);
			$ret = $result->row_array();
			$data['ret'] = $ret;
		}
		
		$sql = " SELECT * FROM ddnews WHERE type='news' ".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT 0, 8";
		$ret = $this->db->query( $sql );
		foreach( $ret->result_array() as $b ){
			$bb[] = $b;
		}
		
		
		$cc = "UPDATE ddnews SET pageview=pageview+1 WHERE id=".$id;
		$sql = $this->db->query( $cc );

		$data['news_part'] = $bb;
		$data['page_title']="苗木百科";
		$this->load->view('baike_read',$data);
	}
	public  function showlist(){
		
		$page_config['url']='/plant/showlist';//url
		$page_config['perpage']=8;   //每页条数
		$page_config['part']=2;//当前页前后链接数量
		$page_config['seg']=3;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		$page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		$this->load->library('mypage_class');
		
		$sql = " SELECT COUNT(1) as cnt FROM ddnews WHERE type='tree' ".
			   " AND show_status='Y' ORDER BY create_time  ";
		
		$rows = $this->db->query( $sql );
		$row_data = $rows->row();
		$row_num = $rows->row_array();
		
		$page_config['total']=$row_num['cnt'];
		$this->mypage_class->initialize($page_config);
		
		$offset = ($page_config['nowindex']-1)*$page_config['perpage'];
		
		$sql = " SELECT * FROM ddnews WHERE type='tree' ".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT ".$offset.",".$page_config['perpage'];
		
	
		$ret = $this->db->query( $sql );
		
		$news = array();
		foreach( $ret->result_array() as  $row ){
			$news[] = $row;
		}
		
		if( $news ) $data['plant_list'] = $news;
		else $data['plant_list']='';
		
		$sql = " SELECT * FROM ddnews WHERE type='news' ".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT 0, 8";
		$ret = $this->db->query( $sql );
		foreach( $ret->result_array() as $b ){
			$bb[] = $b;
		}
		$data['total'] = $page_config['total'];
		$data['news_part'] = $bb;
		$data['page_title']="苗木百科";
		$this->load->view('plant_show',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */