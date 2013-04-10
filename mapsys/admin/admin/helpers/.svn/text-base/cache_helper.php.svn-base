<?php
/**
 *  载入缓存写入缓存辅助文件
 *  @author jagy
 *  @version 1.0
 *  @package cache_helper
 *  @last 2011-11-22 14:41
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * eg: 
 		$this->load->helper('cache');
		$cagegory= cache_include('classcategory.php');
 */
if( ! function_exists('cache_include')){
	/**
	 * $cagegory
	 * @author jagy
	 * 
	 * @param string $file 文件名，可以带路径
	 */
	function cache_include($file){
		$CI =& get_instance();
		$file = str_replace("..", "", $file);
		$data_path = $CI->config->item('cache_data');
		$path = $data_path . $file;
		if(file_exists($path)){
			return include($path);						
		}
		else{
			return FALSE;
		}
	}
}
