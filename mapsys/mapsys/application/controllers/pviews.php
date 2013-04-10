<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pViews extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
		$this->load->library("mypage_class");
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
		
		$page_config['url']='/pviews/showlist';//url
		$page_config['perpage']=12;   //每页条数
		$page_config['part']=2;//当前页前后链接数量
		$page_config['seg']=3;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		$page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		$this->load->library('mypage_class');

		$sql = " SELECT COUNT(1) as cnt FROM ddimages WHERE type='views' ";
		
		$rows = $this->db->query( $sql );
		$row_data = $rows->row();
		$row_num = $rows->row_array();
		$page_config['total']=$row_num['cnt'];
		$this->mypage_class->initialize($page_config);
		
		$offset = ($page_config['nowindex']-1)*$page_config['perpage'];
		
		$sql = " SELECT * FROM ddimages WHERE type='views' LIMIT ".$offset.",".$page_config['perpage'];
		$ret = $this->db->query( $sql );
		foreach( $ret->result_array() as  $row ){
			$views[] = $row;
		}
		
		if( $views )
			$data['views_list'] = $views;
		else
			$data['views_list'] = '';
		
		
		$data['total'] = $page_config['total'];
		$data['page_title']="园林景观";
		$this->load->view('plant_views',$data);
	}
	
	
	public function ajaximg(){
		ini_set('error_reporting',0);
		$action = $_POST['action'];
		$id     = $_POST['id'];
		if($action=='prev'){
			$sql = "SELECT * FROM ddimages WHERE create_time<(SELECT create_time FROM ddimages WHERE id=$id) LIMIT 0,1";
		}else{
			$sql = "SELECT * FROM ddimages WHERE create_time>(SELECT create_time FROM ddimages WHERE id=$id) LIMIT 0,1";
		}
			$ret = $this->db->query( $sql );
			$result = $ret->row_array( $ret );
		
		
		$m = json_encode($result,true);
		echo json_encode($result);
		die;
	}
	
	
	public function showimg(){
		
		$id = $this->uri->segment(3);
		if( $id ){
		
			$sql = "SELECT * FROM ddimages WHERE id=".$id;
			$ret = $this->db->query( $sql );
			$ret = $ret->row_array();

			
			$s = " UPDATE ddimages SET pageviews=pageviews+1 WHERE id=".$id;
			$sql = $this->db->query( $s );
		}
		

		if( $ret )
			$data['ret']=  $ret;
		else
			$data['ret'] = '';
			
		$data['hidden_id'] = $id;
		$data['page_title']="园林景观";
		$this->load->view('view_read',$data);
	}
	
	
	
	public function showlist(){
		
		$sql = " SELECT * FROM ddnews WHERE type='news' ".
			   " AND show_status='Y' ORDER BY create_time DESC LIMIT 0,8";
		$ret = $this->db->query( $sql );
		foreach( $ret->result_array() as  $row ){
			$news[] = $row;
		}
		$data['news_list'] = $news;
		
		$page_config['url']='/pviews/showlist';//url
		$page_config['perpage']=12;   //每页条数
		$page_config['part']=2;//当前页前后链接数量
		$page_config['seg']=3;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
		$page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
		$this->load->library('mypage_class');

		$sql = " SELECT COUNT(1) as cnt FROM ddimages WHERE type='views' ";
		
		$rows = $this->db->query( $sql );
		$row_data = $rows->row();
		$row_num = $rows->row_array();
		$page_config['total']=$row_num['cnt'];
		$this->mypage_class->initialize($page_config);
		
		$offset = ($page_config['nowindex']-1)*$page_config['perpage'];
		
		$sql = " SELECT * FROM ddimages WHERE type='views' LIMIT ".$offset.",".$page_config['perpage'];
		$ret = $this->db->query( $sql );
		foreach( $ret->result_array() as  $row ){
			$views[] = $row;
		}
		
		if( $views )
			$data['views_list'] = $views;
		else
			$data['views_list'] = '';
		
		
		$data['total'] = $page_config['total'];
		$data['page_title']="园林景观";
		$this->load->view('plant_views',$data);
	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */