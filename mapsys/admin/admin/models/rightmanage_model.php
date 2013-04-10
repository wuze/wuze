<?
class Rightmanage_model extends CI_Model
{
	function Rightmanage_model(){
		parent::__construct();
		$this->load->database();
		$this->_tablename = 'controller_acts';
		$this->_primarykey = 'act_id';
	}

	function desc()
	{
		$sql = "SHOW FULL COLUMNS FROM {$this->db->dbprefix}{$this->_tablename}";
		$result = $this->db->query($sql);
		$this->field_array = $result->result_array();
		return $this->field_array;
	}

	function result($where = '')
	{
		!empty($where)?$this->db->where($where):'';
		$result = $this->db->get($this->_tablename);
		return $result->result_array();
	}

	function update($data_array, $where = '')
	{
		if(empty($data_array))
			return false;

		if(empty($where))
			return false;

		$result = $this->db->update($this->_tablename, $data_array, $where);
		return $result;
	}

	function del($where = '')
	{
		if(empty($where))
			return false;
		
		$result = $this->db->delete($this->_tablename, $where);
		return $result;
	}

	function add($data_array)
	{
		if(empty($data_array))
			return false;

		$result = $this->db->insert($this->_tablename, $data_array);
		if(!empty($result))
		{
			return $this->db->insert_id();
		}else{
			return '';
		}
	}

	

	function menu_right()
	{

		!defined('ROOTPATH') && define('ROOTPATH', APPPATH);
		!defined('CURPATH') && define('CURPATH', APPPATH.'controllers'.DIRECTORY_SEPARATOR);
		!defined('MENU_FILE_PATH') && define('MENU_FILE_PATH', ROOTPATH.'sitedata'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'admincp'.DIRECTORY_SEPARATOR.'menu.php');



		$this->load->model('menumanage_model', 'menu');

		$sql = "SELECT * FROM {$this->db->dbprefix}{$this->menu->_tablename} m left join {$this->db->dbprefix}{$this->_tablename} ca on m.controller_name=ca.controller_name and m.action_name=ca.action_name WHERE m.id>0 order by path";
		$res = $this->db->query($sql);
		$res = $res->result_array();
		foreach($res as $k => $v)
		{
			$data[$v['id']]['id'] = empty($v['id'])?'':$v['id'];
			$data[$v['id']]['name'] = empty($v['name'])?'':$v['name'];
			$data[$v['id']]['pid'] = empty($v['pid'])?'':$v['pid'];
			$data[$v['id']]['path'] = empty($v['path'])?'':$v['path'];
			$data[$v['id']]['dept'] = empty($v['dept'])?'':$v['dept'];
			$data[$v['id']]['controller_name'] = empty($v['controller_name'])?'':$v['controller_name'];
			$data[$v['id']]['action_name'] = empty($v['action_name'])?'':$v['action_name'];
			$data[$v['id']]['urlpath'] = empty($v['urlpath'])?'':$v['urlpath'];
			
			$role_id = empty($v['role_id'])?'':'r'.$v['role_id'];
			$data[$v['id']]['allow'] = empty($data[$v['id']]['allow'])?$role_id:$data[$v['id']]['allow'].','.$role_id;
		}


			//将权限数组转化为字符串
		$writeString = var_export($data,true);
$writeString = "<?php  
/**
 * 后台菜单列表
 *
 */
 
\$menu = {$writeString};
return \$menu;
?>
";
		
		
		//如果不存在改目录路径，则自动创建多级目录路径，如果存在则跳过。
		$this->_mkdirs(dirname(MENU_FILE_PATH));

		//将权限数组写入文件
		$this->right_write(MENU_FILE_PATH, $writeString);


		//print_r($data);
	}

	/**
	 * 写权限数组到文件，如果文件有改动则先备份
	 *
	 * @param string $right_file 文件名
	 * @param string $content 文件内容
	 *
	 * @return null
	 *
	 */
	protected function right_write($right_file, $content)
	{
		$tmp_access = '';
		if($file_is_exists = file_exists($right_file))
		{
			$tmp_access = @include $right_file;
		}
		if($content != $tmp_access){
			
			//如果原先权限文件已经存在，则拷贝，不存在跳过。
			if(!empty($file_is_exists))
				@copy($right_file, $right_file.'_'.date('YmdHis').'_'.rand(0,60).'.bak');

			$fp = @fopen($right_file,"w+");        
			if (@flock($fp, LOCK_EX)) { // 进行排它型锁定
				@fwrite($fp, $content);
				@flock($fp, LOCK_UN);   // 释放锁定
			}
			fclose($fp);
		}
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

	function parseToAccess($right)
	{
		if(!empty($right) && is_array($right))
		{
			$data = array();
			foreach($right as $k => $v)
			{
				if($v['act'] == 'allow'){
					if(empty($data[$v['controller_name']]['allow']) || !in_array('r'.$v['role_id'], $data[$v['controller_name']]['allow']))
						$data[$v['controller_name']]['allow'][] = 'r'.$v['role_id'];

					if(empty($data[$v['controller_name']]['actions'][$v['action_name']]['allow']) || !in_array('r'.$v['role_id'], $data[$v['controller_name']]['actions'][$v['action_name']]['allow']))
						$data[$v['controller_name']]['actions'][$v['action_name']]['allow'][] = 'r'.$v['role_id'];
				}
				if($v['act'] == 'deny'){
					if(empty($data[$v['controller_name']]['deny']) || !in_array('r'.$v['role_id'], $data[$v['controller_name']]['deny']))
						$data[$v['controller_name']]['deny'][] = 'r'.$v['role_id'];
					
					if(empty($data[$v['controller_name']]['actions'][$v['action_name']]['deny']) || !in_array('r'.$v['role_id'], $data[$v['controller_name']]['actions'][$v['action_name']]['deny']))
						$data[$v['controller_name']]['actions'][$v['action_name']]['deny'][] = 'r'.$v['role_id'];
				}				
			}
			foreach($data as $k => $v)
			{
				$right_res[$k]['allow'] = !empty($v['allow']) && is_array($v['allow'])?implode(',', $v['allow']):'';
				$right_res[$k]['deny'] = !empty($v['deny']) && is_array($v['deny'])?implode(',', $v['deny']):'';
				foreach($v['actions'] as $ak => $av)
				{
					$right_res[$k]['actions'][$ak]['allow'] = !empty($av['allow']) && is_array($av['allow'])?implode(',', $av['allow']):'';

					$right_res[$k]['actions'][$ak]['deny'] = !empty($av['deny']) && is_array($av['deny'])?implode(',', $av['deny']):'';

				}
			}
		}
		unset($right);
		unset($data);
		return $right_res;
	}
}
?>