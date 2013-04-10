<?php
/**
 * 登录模型
 * 后台登录模型
 * @author fuwei
 * @version 1.0
 * @last 2011-11-7 16:00
 */

class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function login_check(){
    	
    	$this->username = $this->input->post("username");//用户名
    	$this->password = $this->input->post("password");//密码
    	
    	//从数据库中检测用户名密码是否正确
    	
    	$sql = "SELECT * FROM bk_admin WHERE adminname = '$this->username' AND status = 0";
    	$query = $this->db->query($sql);
    	
    	$result = $query->row();
    	
    	//登录是否成功
    	if($result->adminpass == md5($this->password)){
    		return $result;
    	}
    	else{
    		return FALSE;
    	}    	
    }
    
    /**
     * 更新登录的最后次数及时间
     * @author jagy
     */
    function login_update($uid){
    	$now = time();
    	$ip = $this->input->ip_address();
    	if ( ! $this->input->valid_ip($ip)){
    		$ip = '0.0.0.0';
    	}
    	$sql = "UPDATE {$this->db->dbprefix}admin SET logintimes = logintimes + 1, lastlogin = '$now', lastip = '$ip' where adminid = '$uid'";
    	
    	return $this->db->query($sql);
    }
}