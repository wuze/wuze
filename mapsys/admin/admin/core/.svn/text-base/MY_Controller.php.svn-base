<?php
/**
 * 扩展权限控制入口文件
 *
 * Version: 1.0.0
 * Web: http://www.bkw.cn/
 * Copyright: 2011-2012 (flourish@msn.cn)
 * Last Modified: 20011-11-9 20:56
 *
 */

//后台权限数组文件目录
!defined('ROOTPATH') && define('ROOTPATH', APPPATH);
!defined('ACCESS_FILE_PATH') && define('ACCESS_FILE_PATH',ROOTPATH.'sitedata'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'admincp'.DIRECTORY_SEPARATOR);
!defined('ADMIN_LOG_PATH') && define('ADMIN_LOG_PATH',ROOTPATH.'sitedata'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR);

!defined('MENU_FILE_PATH') && define('MENU_FILE_PATH',ACCESS_FILE_PATH."menu.php");

//echo ACCESS_FILE_PATH;exit();
class MY_Controller extends CI_Controller
{
	var $_classname = '';
	var $_methodname = '';
	var $rbac;
	var $_globmenu;
	var $_roles_id = 'r1,r2';
	function MY_Controller(){
		parent::__construct();
		

		//开启允许QueryString配置
		//$this->config->set_item('enable_query_strings', TRUE);

		header('P3P: CP="CAO PSA OUR"');
		if(!ini_get('session.auto_start')){
			session_start();
		}

		$this->rbac =& load_class('Rbac', 'core');
		$roles = '';$this->rbac->getRoles();
		if(!$roles){
			$this->setrole_id();//设置$this->_roles_id
			$roles = $this->_roles_id;
			$this->rbac->setUser(array(),$roles);
		}

		//获取class名称
		$this->_classname = $this->router->class;

		//获取method名称
		$this->_methodname = $this->router->method;
		
		$roles = explode(",",$roles);
	    
	    if($this->_authorize($roles) === FALSE){
			exit('right error');
	    }

		$this->_menuinit();
		$this->_writeLogs();
	}

	protected function setrole_id()
	{
		$this->load->library('session');
		$gid = $this->session->userdata('gid');
		if(empty($gid))
		{
			$this->_roles_id = '';
			return false;
		}
		$tmp_role = explode(',', $gid);
		if(!empty($tmp_role))
		{
			foreach($tmp_role as $k => $v)
			{
				$role[] = 'r'.$v;
			}
		}
		$this->_roles_id = implode(',', $role);
	}

	/**
	 * 权限控制
	 *
	 * @param array $roles
	 * @param array $params
	 * @return bool
	 */
	protected function _authorize( $roles = array(), $params = array() ) {
		//引入权限文件
	    include(ACCESS_FILE_PATH."access.php");
		
	    $authority = array();
	    
	    //controller级别判断,controller没权限直接拒绝
		if(empty($access[$this->_classname]))
			return true;

	    $authority[$this->_classname] = $this->rbac->prepareACT($access[$this->_classname]);
	    if($this->rbac->check($roles,$authority[$this->_classname],'allow') === FALSE){
	    	return false;
	    }
	    //action级别判断,action没权限直接拒绝
	    $authority[$this->_methodname] = $this->rbac->prepareACT($access[$this->_classname]['actions'][$this->_methodname]);

	    if($this->rbac->check($roles,$authority[$this->_methodname],'allow') === FALSE){
	    	return false;
	    }
	    
	    return true;
	}

	protected function _menuinit()
	{
		if(!file_exists(MENU_FILE_PATH))
		{
			$this->_globmenu = array();
			return false;
		}

		include(MENU_FILE_PATH);
		//print_r($menu);exit();
		$roles = explode(',', $this->_roles_id);
		if(!empty($menu) && is_array($menu))
		{
			foreach($menu as $k => $v)
			{
				foreach($roles as $rk => $rv)
				{

					if(!empty($rv) && in_array($rv, explode(',',$v['allow'])))
					{
						$this->_globmenu[$k] = $v;
					}
				}
			}
		}
	}




	/**
	 * 写入日志访问文件2011/11/21 flourish<flouris@msn.cn>
	 *
	 * @param array $roles
	 * @param array $params
	 * @return bool
	 */
	protected function _writeLogs()
	{
		//初始化数据库字段

		!defined('ROOTPATH') && define('ROOTPATH', APPPATH);
		!defined('ACCESS_FILE_PATH') && define('ACCESS_FILE_PATH',ROOTPATH.'sitedata'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'admincp'.DIRECTORY_SEPARATOR);
		$access = require(ACCESS_FILE_PATH.'./access_list.php');
		
		$controller_action = $access[$this->_classname]['actions'][$this->_methodname];
		
		if(!empty($controller_action['writelog']) && ($controller_action['writelog'] == 'no' || $controller_action['writelog'] == false) ) {
			return '';
		}

		$delimiter = "\t";

		//写入日志：文件保存或者数据库保存。
		$this->load->library('session');
		$add_array['adminid'] = $this->session->userdata('adminid');
		$add_array['adminname'] = $this->session->userdata('adminname');
		$add_array['logip'] = $this->input->ip_address();
		$add_array['logtime'] = time();
		$add_array['url'] = $_SERVER["SERVER_PORT"] == 80?'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]:'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		
		$add_array['controller_name'] = $this->_classname;
		$add_array['action_name'] = $this->_methodname;
		$add_array['summary'] = "GET:".var_export($_GET,true)."\tPOST:".var_export($_POST,true)."\tUSER_AGENT:".var_export($_SERVER['HTTP_USER_AGENT'],true);
		
		if(!empty($controller_action['writelog']) && $controller_action['writelog'] == 'file')
		{
			$add_array['logtime'] = date('Y-m-d H:i:s', $add_array['logtime']);
			//print_r($this->_stripTab($add_array));exit();
			$str = implode($delimiter,$this->_stripTab($add_array))."\n";		
//print_r(str_replace("\n",'',$str));exit();
			$this->writeAdminLog($str);
			return ;
		}

		

		//记录日志到adminlog表中
		$this->load->model('adminlogmanage_model', 'adminlog');
		$this->adminlog->add($add_array);
	}


	/**
	 * 根据不同操作类型区分日志文件
	 * @param string $str 日志内容
	 * @param string $log_type 日志类型
	 */
	protected function _logToFile($str = '',$log_type = 'cplog'){
		//过期日志回收

		!defined('LOG_SAVE_MONTHS') && define('LOG_SAVE_MONTHS', 3);
		if(date('d') == '01'){
			if(($subtract = date('n')-LOG_SAVE_MONTHS-1) > 0 ){
				if(strlen($subtract)==1){
					$ym = date('Y')."0".$subtract;
				}else {
					$ym = date('Y').$subtract;
				}
			}else{
				if(strlen(($subtract + 12))==1){
					$ym = (date('Y')-1)."0".($subtract + 12);
				}else {
					$ym = (date('Y')-1).($subtract + 12);
				}
			}
			
			if(file_exists(ADMIN_LOG_PATH."log_gc.log.php")){
				$t = file_get_contents(ADMIN_LOG_PATH."log_gc.log.php");
				if ((date('Ym',$t)+LOG_SAVE_MONTHS+1) <= date('Ym')) {
					$this->_log_clean($ym);
				}
			}else{
				$this->_log_clean($ym);
			}
		}
		
		switch($log_type){
			case 'cplog': //系统日志
				$filepath = date("Ymd")."_cplog.log.php";
				break;
			case 'illegal': //非法操作日志
				$filepath = date("Ym")."_illegal.log.php";
				break;
			case 'adminlog': //管理员操作日志
				$filepath = date("Ymd")."_adminlog.log.php";
				break;
			default:
				$filepath = date("Ymd")."_cplog.log.php";
				break;
		}
		
		_mkdirs(ADMIN_LOG_PATH);
		$this->_file_write(ADMIN_LOG_PATH.$filepath,$str);	
	}
	
	/**
	 * 写文件操作
	 * @param string $filepath 文件地址
	 * @param string $str 内容
	 * @param string $open_mode 打开文件方式
	 */ 
	protected function _file_write($filepath,$str,$open_mode = FOPEN_WRITE_CREATE){
		if(!file_exists($filepath))
			$str = "<?php exit();?>\n" . $str;
		$fp = @fopen($filepath, $open_mode);
		flock($fp, LOCK_EX);	
		fwrite($fp, $str);
		flock($fp, LOCK_UN);
		fclose($fp);
		@chmod($filepath, FILE_WRITE_MODE); 
	}
	
	/**
	 * 删除过期日志操作
	 * @param int $month 月份
	 */ 
	protected function _log_clean($ym){
		$pattern = "/(\d){6}/i";
		$dh = opendir(ADMIN_LOG_PATH);
		
		while(($file = readdir($dh)) !== false){
			if(preg_match($pattern,$file,$match) && $match[0] <= $ym){
				@unlink(ADMIN_LOG_PATH.$file);
			}
		}
		$this->_file_write(ADMIN_LOG_PATH."log_gc.log",time(),FOPEN_READ_WRITE_CREATE_DESTRUCTIVE);
	}
	
	/**
	 * 转译内容中的换行/制表符
	 *
	 * @param mixed $params
	 * @return mixed
	 */
	protected function _stripTab($params = array()) {
		
		if(is_array($params)){
			foreach($params as $k => $v){
				$tmp[$k] = $this->_stripTab($v);
			}
		}else{
			$tmp = str_replace("\t","   ",$params);
			$tmp = str_replace("\\r\\n","",$tmp);
			$tmp = str_replace("\r","",$tmp);
			$tmp = str_replace("\r\n","",$tmp);
			$tmp = str_replace("\n","",$tmp);
		}
		
		return empty($tmp)?'':$tmp;
	}
	
	/**
	 * 操作日志记录
	 * 格式: 操作人 \t 角色信息 \t 操作时间 \t controller \t action \t GET/POST参数列表 \t 操作内容描述.
	 */
	public function writeAdminLog($msg = ''){
		$this->_logToFile($msg,"adminlog");
	}



}
?>