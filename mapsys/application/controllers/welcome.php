<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Welcome extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper("div");
	}
	
	
	public function index()
	{
		$data['page_title']="首页";
		$this->load->view('home');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */