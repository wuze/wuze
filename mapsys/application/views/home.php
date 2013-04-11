<?php $this->load->view("header"); ?>

<body>
	<div id="site">
		<div id="header">
			<a href="#" class="logo">
				<img src="images/logo.gif"   width="200" height="110" />
			</a>	
			<img src="images/title.png"  width="300" height="110" />						
			<?php $wk = array(1=>"星期一",2=>"星期二",3=>"星期三",4=>"星期四",5=>"星期五",6=>"星期六",0=>"星期天");
				$now = date("w");
			?>
			
			<div id="menu">
				<ul style="float:left;font-weight:bolder;margin-top:12px;margin-left:20px;font-color:#000FFF;"><li ><?php echo "今天是".date("Y-m-d")."  ".$wk[$now]; ?></li></ul>
				<ul style="float:right;font-weight:bolder;margin-top:12px;margin-right:50px;cursor:pointer;">
				<li>关于我们</li>
				<li>|</li>
				<li>帮助</li>
				</ul>
			</div>
		</div>
		
	
		<div id="content">	
			<!-- 左边栏   -->
			<div id="main">
				<div class="current" id="map_canvas" style="border:1px solid #ddd;"></div>
			</div>
			
			<!--  右边栏    -->
			<div id="sidebar">
				<div class="block">
					<div class="news">
					
					
						<!--   搜索条件   -->
						<div id="tabbed_box_1">
							<div class="tabbed_area">
									<ul class="tabs">
										<li><a href="javascript:tabSwitch('tab_1', 'content_1');" title="content_1" class="tab active">地名查询</a></li>
										<li><a href="javascript:tabSwitch('tab_2', 'content_2');" title="content_2" class="tab">周边查询</a></li>
										<li><a href="javascript:tabSwitch('tab_3', 'content_3');" title="content_3" class="tab">线路查询</a></li>
									</ul>
									
									<div id="content_1" class="content">
										<table>
										<tr><td>名称:</td><td><input name="addr_name"/></td></tr>
										<tr>
										<td>所属类别:</td>
										<td>
											<select style="width:154px;">
														<option>A</option>
											</select>
										</td>
										</tr>
										
										<tr><td>所属区县:</td>
										<td><select style="width:154px;"><option>B</option></select></td></tr>
										<tr ><td colspan="2"><input type="button" name="查询" value="查询" style="width:30xp;float:right;"/></td></tr>
										</table>
									</div>
									<div id="content_2" class="content">
										<table>
										<tr><td></td><td></td></tr>
										<tr><td></td><td></td></tr>
										<tr><td></td><td></td></tr>
										</table>
									</div>
									<div id="content_3" class="content">
										<table>
										<tr><td></td><td></td></tr>
										<tr><td></td><td></td></tr>
										<tr><td></td><td></td></tr>
										</table>

									</div>
							</div>
						</div>
					</div>
				</div>
				
				<!---   start  -->
				<div class="sponsors" id="index">
					<a class="orange">文化信息索引类</a>
				</div>
				<div class="sponsors_down">
				</div>
				
				<div class="sponsors" id="tradition">
					<a class="green">文化信息传统类</a>
				</div>
				
				<div class="sponsors_down">
				</div>
				<div class="sponsors" id="wether">
					<a class="red">天气情况</a>
				</div>
				<div class="sponsors_down">
				</div>
				
				<div class="sponsors" id="link">
					<a class="blue">友情链接</a>
				</div>
				<div class="sponsors_down">
				</div>
				<!---   end -->
			</div>
		</div>
	</div>

<script type="text/javascript">
	BmapInit();
</script>

<?php $this->load->view("footer");?>