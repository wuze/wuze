<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mypage {


    function __construct()
    {

    }

    /**
     * 显示分页
     *
     * @param unknown_type $page
     * @param unknown_type $perpage
     * @param unknown_type $baseurl
     */
    public function show($total="", $perpage="20", $baseurl="", $segment="", $urisement=3){
    	$CI =& get_instance();
    	$CI->load->library('pagination');

		$config['base_url'] = $baseurl;
		$config['total_rows'] = $total;
		$config['per_page'] = $perpage;
		$config['page_query_string'] = TRUE;
		if($segment){
			$config['query_string_segment'] = $segment;
		}
		else{
			$config['query_string_segment'] = "pn";
		}
		if($urisegment){
			$config['uri_segment'] = $urisegment;
		}
		else{
			$config['uri_segment'] = 3;
		}

		$config['num_links'] = 5;//数字
		//封装页
		$config['full_tag_open'] = '<div class="list_page">​';



		$config['full_tag_close'] = '</div>';

		//首页
		$config['first_link'] = '首页';
		$config['first_tag_open'] = '<dl class="list_pon">';
		$config['first_tag_close'] = '</dl>';
		//末页
		$config['last_link'] = '末页';
		$config['last_tag_open'] = '<dl class="list_pon">';
		$config['last_tag_close'] = '</dl>';
		//下一页
		$config['next_link'] = '下一页';
		$config['next_tag_open'] = '<dl class="list_pon">';
		$config['next_tag_close'] = '</dl>';
		//上一页
		$config['prev_link'] = '上一页';
		$config['prev_tag_open'] = '<dl class="list_pon">';
		$config['prev_tag_close'] = '</dl>';
		//当前页
		$config['cur_tag_open'] = '<dl class="list_ptwo d00">';
		$config['cur_tag_close'] = '</dl>';
		//数字页
		$config['num_tag_open'] = '<dl class="list_ptwo">';
		$config['num_tag_close'] = '</dl>';


		$CI->pagination->initialize($config);

		return $CI->pagination->create_links();

    }
}

?>