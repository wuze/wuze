<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
		$this->load->library("session");
	}
	
	public function index()
	{	
		
		$str = " SELECT * FROM ddimages WHERE type='product'";
		$this->db->select("*");
		$this->db->order_by("create_time", "DESC");
		$this->db->where("type","product");
		//$this->db->limit(20,10);//分页
		
		$ret = $this->db->get("ddimages");
		
		foreach( $ret->result_array() as $row){
			$list[] = $row;
		}
		$data['list'] =  $list;
		$data['pagetitle'] = "产品展示";
		$this->load->view('product_list',$data);
	}
	
	
	public function upload_index(){
		
		
		if( $this->session->userdata('upload_product')){
			$data['upload_file'] = 	 $this->session->userdata('upload_product');
			$this->session->unset_userdata('upload_product');
		}
		$data['pagetitle']="上传图片(产品)";
		$this->load->view('product_upload',$data);
	}
	
	
	/**
	 * Enter description here ...
	 */
	public  function upload(){

		
		
		$config['upload_path'] = UPLOAD_IMAGE_PATH_SET;
		$upload_path = UPLOAD_IMAGE_PATH_SET;
		$this->_mkdirs($upload_path);
		$config['file_name'] = date('YmdHis').rand(1000,9999);
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = FILE_UPLOAD_MAX;
  		$config['max_width']  = '1024';
  		$config['max_height']  = '768';
  		$this->load->library('upload', $config);
		$this->upload->do_upload();
		
		$error = array('error' => $this->upload->display_errors());
		
		$alias = $this->input->post('alias')?strval($this->input->post('alias')):"未命名";
		
		$data['callback'] = "UPLOAD_CALLBACK";
		$imgdata = $this->upload->data();
		$uploadfile = '/admin/images/upload/'.$imgdata['file_name'];
		$upload_img_data = "/images/product/".md5($imgdata['raw_name']).$imgdata['file_ext']; 
		$upload_img_dir = "/images/product/"; 
		$this->session->set_userdata('upload_product',$uploadfile);

		//移动文件
		$this->move_pic($_SERVER['DOCUMENT_ROOT'].$uploadfile,$_SERVER['DOCUMENT_ROOT'].$upload_img_dir,md5($imgdata['raw_name']).$imgdata['file_ext']);
				
		$condition = array(
			'type'=>'product',
			'create_time'=>time(),
			'image_path'=>$upload_img_data,
			'image_name'=>$alias
		);
		
		$sql_str = $this->db->insert_string('ddimages',$condition);
		$this->db->query( $sql_str );

		redirect('/product/upload_index');
	}
	

	public function move_pic($src,$des,$filename){
		
		if(!$src||!$des||!filename ) return 0;
					
		$this->_mkdirs($des,"0777");
		$new_handle = fopen($des.$filename, "w+");	
		//echo	substr(sprintf("%o",fileperms($des)),-4);

		$handle = fopen($src, "r");	
		while( !feof($handle)){
			$read = fread($handle, 1024);
			fwrite($new_handle, $read);
		}
		fclose($handle);
		fclose($new_handle);
	}
	
	/**
	 * 这个函数不好用，暂时不用
	 * Add LSW
	 * @param unknown_type $src
	 * @param unknown_type $des
	 */
	public function move_pic1($src,$des){
		if(!$src || !$des ) return 0;
		
		$this->_mkdirs($des);
		
		if(!copy($src, $des)){
			return 0;
		}
		return 1;
	}

	
	public function del(){
		$picid = strval($_POST['id']);
		$str = " DELETE FROM ddimages WHERE id=".$picid;
		$ret = $this->db->query( $str );
		
		if( $ret>0 )
			echo "1-SUCCESS";
		else 
			echo "0";
	}
	

	protected function _mkdirs($dir,$mode = '0777'){
		if(!is_dir($dir)){
			$this->_mkdirs(dirname($dir), $mode);
			mkdir($dir,$mode);
		}else{
			
		}
		return ;
	}
}

/* End of file Contact.php */
/* Location: ./admin/controllers/Contact.php */