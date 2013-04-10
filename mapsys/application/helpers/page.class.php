<?php
/**
 * PHP分页类 
 * @package Page
 * @author Lancer_He (lancer_he@hotmail.com)
 * @Created 2010-08-03
 * @Modify 2010-12-13
 * @link http://crackedzone.com/blog
 * Example:
 ==========================================================
		$page  = isset($_GET['page']) ? $_GET['page'] : 1;  
		$sql   = 'select * from `project_list`';
		$num   = $db->num_rows($db->query($sql));
		
		$objPage = new Page($page, $num, 3, 5);
		$PageCode = $objPage->output();
		
		$sql .= ' Limit ' . ($page - 1) * $PageSize ", $PageSize";
		
		$query = $db->query($sql);
		while ($rs = $db->fetch_array($query)) {
				echo $rs['id'].'<br />';	
		}
		echo $PageCode;
	 
		CSS Style
		<style type="text/css">
		<!--
		* {font-size:12px;padding:0;margin:0;}

		-->
		</style>
 ===========================================================
 *
 *
 */
class Page{
  
  /**
	* 当前页
	* @var Int
	*/
	private $CurrentPage;
  
  /**
	* 当前URL
	* @var String
	*/
	private $CurrentUrl;
  
  /**
	* 总记录数
	* @var Int
	*/
  
	private $TotalNum;
  
  /**
	* 每页显示数目
	* @var Int
	*/
	private $PageSize;
  
  /**
	* 页面显示数目(长度)
	* @var Int
	*/
	private $PageLen;
  
  /**
	* 所用分页样式类名
	* @var Style
	*/
	private $PageStyle;
  
  /**
	* 分页HTML字符串
	* @var String
	*/
	private $PageCode;
  
  /**
	* 总页数
	* @var Int
	*/
	private $TotalPages;
  
  /**
	* 页数偏移量
	* @var Int
	*/
	private $PageOffset;
	
  /**
	* 是否显示当前页数 / 所有页数
	* @var Boolean
	*/
	public $IsAll    = TRUE;
  
  /**
	* 是否显示选择页面下拉框
	* @var Boolean
	*/
	public $IsSelect = FALSE;
  
  /**
	* 是否显示搜索框
	* @var Boolean
	*/
	public $IsSearch = TRUE;
  
  
  /**
	* 初始化函数
	*
	* @param Int $CurrentPage 当前页数
	* @param Int $TotalNum 总记录数
  * @param Int $PageSize 每页记录数
	* @param Int $PageLen  页码长度
	* @param String $PageStyle 使用CSS类名
	*
	* @return Void Doesn't return anything.
	*/
  public function __construct($CurrentPage, $TotalNum, $PageSize=3, $PageLen=7, $PageStyle='') {
		$this->CurrentPage = intval($CurrentPage);
		$this->TotalNum    = intval($TotalNum);
		$this->PageSize    = $PageSize;
		$this->PageLen     = $PageLen;
		$this->PageStyle   = $PageStyle;
	}
  
	/**
	* 输出分页HTML
	*
	* @return String 分页字符串
	*/ 	
	public function output() {
		//Get Current Page Url, Like: /index.php?mode=job&page= 
    $this->CurrentUrl = $this->getPageUrl(); 
		//init page param
		$this->setPageParam();
		//Create Pagecode Html
		$this->getPageCode();
		return $this->PageCode;
	}
	
  /**
	* 获取去除page部分的当前URL字符串
	*
	* @return String URL字符串
	*/ 
  private function getPageUrl() {
		$CurrentUrl = $_SERVER["REQUEST_URI"];
		$arrUrl     = parse_url($CurrentUrl);
		$urlQuery   = $arrUrl["query"];

		if($urlQuery){
			$urlQuery  = ereg_replace("(^|&)page=" . $this->CurrentPage, "", $urlQuery);
			$CurrentUrl = str_replace($arrUrl["query"], $urlQuery, $CurrentUrl);   
			 
			if($urlQuery) $CurrentUrl.="&page";
			else $CurrentUrl.="page";
			
		} else {
			$CurrentUrl.="?page";
		}
    return $CurrentUrl;
  }
  
  /**
	* 判断参数，如当前页超出总页数，当前不是数字，计算页码左右偏移量
	*
	* @return Void
	*/ 
	private function setPageParam() {
		if (!$this->TotalNum) return array();
		
		$this->TotalPages = ceil($this->TotalNum / $this->PageSize);
		
		$this->CurrentPage < 1 && $this->CurrentPage = 1;
		$this->CurrentPage > $this->TotalPages && $this->CurrentPage = $this->TotalPages;

		//Make sure PageLen is odd number.
		$this->PageLen = $this->PageLen % 2 ? $this->PageLen : $this->PageLen + 1;
		$this->PageOffset = ($this->PageLen - 1) / 2;
	}
  
  /**
	* 获取分页HTML字符串
	*
	* @return Void
	*/ 
	private function getPageCode() {
		$this->PageCode = $this->PageStyle ? '<div class="' . $this->PageStyle . '">' : '<div>';

		$this->setPageCode();
		
		if ($this->IsAll) $this->setAllCode();
		
		if ($this->IsSelect) $this->setSelectCode();

		if ($this->IsSearch) $this->setSearchCode();
		
		$this->PageCode .= '</div>';
	}
  
	/**
	* 设置分页基本需要的HTML字符串
	*
	* @return Void
	*/ 
	private function setPageCode() {
		if($this->CurrentPage != 1) {
			$this->PageCode .= "<a href=\"$this->CurrentUrl=1\">&lt;&lt;</a>";
			//$this->PageCode .= "<a href=\"$this->CurrentUrl=" . ($this->CurrentPage - 1) . "\">&lt;</a>";
		}
		
		//Ensure page offset number
		if($this->TotalPages > $this->PageLen){
			if ($this->CurrentPage <= $this->PageOffset) {
				$PageMin = 1;
				$PageMax = $this->PageLen;
			} else {
				if($this->CurrentPage + $this->PageOffset >= $this->TotalPages + 1){
					$PageMin = $this->TotalPages - $this->PageLen + 1;
					$PageMax = $this->TotalPages;
				} else {
					$PageMin = $this->CurrentPage - $this->PageOffset;
					$PageMax = $this->CurrentPage + $this->PageOffset;
				}
			}
		}

		for($i = $PageMin; $i <= $PageMax; $i++){
			if($i == $this->CurrentPage){
				$this->PageCode .= '<b>'.$i.'</b>';
			} else {
				$this->PageCode .= "<a href=\"{$this->CurrentUrl}={$i}\">$i</a>";
			}
		}

		if($this->CurrentPage != $this->TotalPages){
			//$this->PageCode.="<a href=\"{$this->CurrentUrl}=".($this->CurrentPage+1)."\">&gt;</a>";     //Next Page
			$this->PageCode.="<a href=\"{$this->CurrentUrl}={$this->TotalPages}\">&gt;&gt;</a>";        //Last Page
		}
	}
  
  
	/**
	* 设置显示 如:12/23 分页字符串
	*
	* @return Void
	*/ 
	private function setAllCode() {
		$this->PageCode .= '<span class="pageall">' . $this->CurrentPage . ' / ' . $this->TotalPages . '</span>';
	}
  
	/**
	* 设置显示下拉框字符串
	*
	* @return Void
	*/ 	
	private function setSelectCode() {
		$this->PageCode .= "<select name=\"Topage\" size=\"1\" onchange='window.location=\"$this->CurrentUrl=\"+this.value'>\n";
		for($i = 1; $i <= $this->TotalPages; $i++){
			if($i == $this->CurrentPage)
				$this->PageCode .= "<option value=\"$i\" selected>$i</option>\n";
			else 
				$this->PageCode .= "<option value=\"$i\">$i</option>\n";
		}
		$this->PageCode .= "</select>";
	}
  
	/**
	* 设置显示搜索框字符串
	*
	* @return Void
	*/ 		
	private function setSearchCode() {
		$this->PageCode .= '<span class="pageone">';
		$this->PageCode .= '<input id="pagesearchbox" type="text" size="3">';
		$this->PageCode .= '<button onclick="javascript:location=\'' . $this->CurrentUrl . '=\'+document.getElementById(\'pagesearchbox\').value+\'\'; return false;" type="submit">Go</button></span>';
	}

}
?>