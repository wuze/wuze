<?php $this->load->view("header"); ?>

<body>
	<div id="site">
		<div id="header">
			<a href="#" class="logo">
			<img src="images/logo.gif"  width="190" height="100" /></a>																																				
			<img src="images/logo.gif"  width="190" height="100" />
			
			<div id="menu">
				<ul>
					<li><a href="#" class="but1 active"><img src="images/spacer.gif" alt="" width="106" height="42" /></a></li>
					<li><a href="#" class="but2"><img src="images/spacer.gif" alt="" width="118" height="42" /></a></li>
					<li><a href="#" class="but3"><img src="images/spacer.gif" alt="" width="106" height="42" /></a></li>
					<li><a href="#" class="but4"><img src="images/spacer.gif" alt="" width="99"  height="42" /></a></li>
					<li><a href="#" class="but5"><img src="images/spacer.gif" alt="" width="154" height="42" /></a></li>
					<li><a href="#" class="but6"><img src="images/spacer.gif" alt="" width="129" height="42" /></a></li>
				</ul>
				<form action="#">
					<input type="text" value="Search" />
				</form>
			</div>
		</div>
		
		<!-- 左边栏   -->
		<div id="content">	
			<div id="main">
				<div class="current" id="map_canvas" style="border:1px solid #ddd;"></div>
			</div>
			
			<!--  右边栏    -->
			<div id="sidebar">
				<div class="block">
					<div class="news">
					
					<div id="tabbed_box_1">
						<div class="tabbed_area">
						        <ul class="tabs">
						            <li id="tab_1"><a href="javascript:tabSwitch('tab_1', 'content_1');" title="content_1" class="tab active">地名查询</a></li>
						            <li id="tab_2"><a href="javascript:tabSwitch('tab_2', 'content_2');" title="content_2" class="tab">周边查询</a></li>
						            <li id="tab_3"><a href="javascript:tabSwitch('tab_3', 'content_3');" title="content_3" class="tab">线路查询</a></li>
						        </ul>
						        
						        <!--    -->
						        <div id="content_1" class="content">
						        	<table>
						        	<tr><td>名称:</td><td><input name="addr_name" id="keyword"/></td></tr>
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
									<tr ><td colspan="2"><input type="button" id="search_button" name="查询" value="查询" style="width:30xp;float:right;"/></td></tr>
									</table>
						        </div>
						        <!-- -     -->
						        <div id="content_2" class="content">
						<table>
						        	<tr><td>地点:</td><td><input name="addr_name"/></td></tr>
									<tr>
									<td>所属类别:</td>
									<td>
										<select style="width:154px;">
													<option>A</option>
										</select>
									</td>
									</tr>
									
									<tr><td>距离:</td>
									<td><select style="width:154px;"><option>B</option></select></td></tr>
									<tr ><td colspan="2"><input type="button" name="查询" value="查询" style="width:30xp;float:right;"/></td></tr>
									</table>
						        </div>
						        
						        <!--  -->
						        <div id="content_3" class="content">
									<table>
						        	<tr><td>此处出发:</td><td><input name="addr_name"/></td></tr>
									<tr><td>到达此处:</td><td><input name="addr_name"/></td></tr>
									<tr ><td colspan="2"><input type="button" name="查询" value="查询" style="width:30xp;float:right;"/></td></tr>
									</table>
						        </div>
						        <!--    -->
    						</div>
							</div>
						</div>
		
				</div>
				<!--    右下角的    -->
				<div class="sponsors">
					<img src="images/title1.gif" alt="" width="260" height="37" />
				</div>
				
				<div class="sponsors">
					<img src="images/title2.gif" alt="" width="260" height="37" />
				</div>
				<div class="sponsors">
					<img src="images/title2.gif" alt="" width="260" height="37" />
				</div>
				<div class="sponsors">
					<img src="images/title2.gif" alt="" width="260" height="37" />
				</div>
				
				<div>
				</div>
				
			</div>
		</div>
	</div>

<script type="text/javascript">
	BmapInit();
</script>

<?php $this->load->view("footer");?>