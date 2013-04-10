<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Ajaxfile extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url");
	}
	public function index(){

		$callback = $this->input->post('callback');
		
		$uploadinfo = $this->input->post('uploadinfo');

		if($callback && isset($uploadinfo)){
			//后期应该加入对uploadinfo中域名的判断，增强安全性
			echo "<script type=\"text/javascript\">parent.".$callback."('".$uploadinfo."')</script>";
		}
		else{
			echo "<script type=\"text/javascript\">alert('".$uploadinfo."')</script>";
		}
	}

	/**
	 * 上传页面处理文件	 *
	 */
	public function do_upload(){

		$pathname = $this->input->post('pathname');
		$pathname = preg_replace('/[^0-9a-z]/i', '', $pathname);

		$upload_path = UPLOAD_IMAGE_PATH_SET. $pathname .'/';

	
		$this->_mkdirs($upload_path);

		$config['upload_path'] = $upload_path;

		$config['file_name'] = date('YmdHis').rand(1000,9999);

		$config['allowed_types'] = 'gif|jpg|png';

		$config['max_size'] = FILE_UPLOAD_MAX;

		$this->load->library('upload', $config);

		$this->upload->do_upload();

		$error = array('error' => $this->upload->display_errors());

		//如果有错
		if($error['error']){
			$data['filename'] = $error['error'];
		}
		else{
			$data['callback'] = "UPLOAD_CALLBACK";
			$imgdata = $this->upload->data();
			$data['filename'] = '/upload/'.$pathname.'/'.$imgdata['file_name'];
		}

		$this->load->view('upload_cross',$data);
	}

	/**
	 * 建立多级目录
	 *
	 * @param string $dir 目录路径
	 * @param string $mode 目录权限
	 *
	 * @return null
	 *
	 */
	protected function _mkdirs($dir,$mode = '0777'){
		if(!is_dir($dir)){
			$this->_mkdirs(dirname($dir), $mode);
			mkdir($dir,$mode);
		}
		return ;
	}
}

?>