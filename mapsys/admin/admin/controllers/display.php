<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Display extends MY_Controller {

	public function index()
	{	
		$data['pagetitle'] = "展示页";
		$this->load->view('about_index',$data);
	}
}

/* End of file Show.php */
/* Location: ./admin/controllers/Show.php */