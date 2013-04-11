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
										<li ><a id="tab_1" href="javascript:tabSwitch('tab_1', 'content_1');"  name="content_1" class="tab active">地名查询</a></li>
										<li ><a id="tab_2" href="javascript:tabSwitch('tab_2', 'content_2');"  name="content_2" class="tab">周边查询</a></li>
										<li ><a id="tab_3" href="javascript:tabSwitch('tab_3', 'content_3');"  name="content_3" class="tab">线路查询</a></li>
									</ul>
									
									<div id="content_1" class="content"  style="width:234px;">
										<table>
										<tr style="width:140px;">
											<td><span class="labelClass" style="margin-top:10px;font-weight:bolder;">名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称:</span></td>
											<td><input type="text" class="inputClass"  style="width:142px;margin-top:10px;" name="addr_name" id="addr_name"/></td>
										</tr>

										<tr>
											<td><span class="labelClass" style="margin-top:10px;font-weight:bolder;" >所属类别:</span></td>
											<td>
												<select class="selectClass" style="width:154px;margin-top:10px;" name="addr_cat" id="addr_cat">
														<option>A</option>
												</select>
											</td>
										</tr>

										<tr>
											<td><span class="labelClass" style="margin-top:10px;font-weight:bolder;" >所属区县:</span></td>
											<td>
												<select  class="selectClass" style="width:154px;margin-top:10px;" id="addr_prov" name="addr_prov">
													<option>B</option>
												</select>
											</td>
										</tr>
										
										<tr >
											<td colspan="2">
												<input type="button" onclick="searchPoint();" class="btnClass" name="query" value="查询" style="float:right;margin-right:10px;margin-top:5px;"/>
											</td>
										</tr>
										</table>
									</div>
									
									
									<div id="content_2" class="content" style="width:234px;">
										<table>
										<tr style="width:140px;">
											<td><span class="labelClass" style="margin-top:10px;font-weight:bolder;">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址:</span></td>
											<td><input type="text" class="inputClass"  style="width:142px;margin-top:10px;" name="area_name" id="area_name"/></td>
										</tr>

										<tr>
											<td><span class="labelClass" style="margin-top:10px;font-weight:bolder;" >所属类别:</span></td>
											<td>
												<select class="selectClass" style="width:154px;margin-top:10px;" name="area_cat" id="area_cat">
														<option>A</option>
												</select>
											</td>
										</tr>

										<tr>
											<td><span class="labelClass" style="margin-top:10px;font-weight:bolder;">距&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;离:</span></td>
											<td>
												<select  class="selectClass" style="width:154px;margin-top:10px;" name="area_dist" id="area_dist">
													<option>B</option>
												</select>
											</td>
										</tr>
										
										<tr >
											<td colspan="2">
												<input type="button" onclick="searchArea();" class="btnClass" name="查询" value="查询" style="float:right;margin-right:10px;margin-top:5px;"/>
											</td>
										</tr>
										</table>
									</div>
									
									<div id="content_3" class="content" style="width:234px;">
										<table>
										<tr style="width:140px;">
											<td><span class="labelClass" style="margin-top:10px;font-weight:bolder;">此处出发:</span></td>
											<td><input type="text" class="inputClass"  style="width:142px;margin-top:10px;" name="path_from" id="path_from"/></td>
										</tr>

										<tr>
											<td><span class="labelClass" style="margin-top:10px;font-weight:bolder;">到达此处:</span></td>
											<td>
												<input type="text" class="inputClass"  style="width:142px;margin-top:10px;" name="path_to" id="path_to"/>
											</td>
										</tr>
										<tr >
											<td colspan="2">
												<input type="button" onclick="searchPath();" class="btnClass" name="查询" value="查询" style="float:right;margin-right:10px;margin-top:5px;"/>
											</td>
										</tr>
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