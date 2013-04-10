<?php
class MY_Exceptions extends CI_Exceptions
{
	function MY_Exceptions()
	{
		parent::__construct();
	}
	/**
	 * show system message
	 * 
	 * @param string message title
	 * @param mixed message accept array or string
	 * @param string url address 
	 */
	function show_message($heading ='',$message,$url_forward = '', $html_ext = ''){
		
		$heading = $heading ? $heading : "System Message :";
		
		if(!empty($html_ext))
		{
			$extrahead = $html_ext;
		}else{
			if(!$url_forward){
				$extrahead = '<script LANGUAGE="JavaScript">function go(){history.go(-1);}setTimeout(go,3000);</script>';
			}elseif($url_forward == 1){
				$extrahead = '';
			}else{
				$extrahead = $url_forward ? '<meta http-equiv="refresh" content="3;url='.$url_forward.'">' : '';
			}
		}

		$message = '<p>'.implode('</p><p>', ( ! is_array($message)) ? array($message) : $message).'</p>';

		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();	
		}
		ob_start();
		include(APPPATH.'errors/system_message.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}
?>