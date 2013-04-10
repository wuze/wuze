<?php $this->load->view('header_m'); ?>
<body>
<div class="rgmain">
<div class="rgtit">
<a href="<?php echo site_url('/teacher/')?>"><h1  class="current">所有教师</h1></a><a href="<?php echo site_url('/teacher/teacher_screening/1')?>"><h1>金牌教师</h1></a><a href="<?php echo site_url('/teacher/teacher_screening/0')?>"><h1>普通教师</h1></a>
</div>
<div class="mainbox">
<form method="post" action="<?php echo site_url('/teacher/teacher_search')?>">
<table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="8dc8e4">
	<caption class="capcenter">搜索教师</caption>
	<tr>
		<th>ID：</th>
		<td><input type="text" name="tid" value="<?php if(!empty($tid)){echo $tid;} ?>"/></td>
	</tr>
	<tr>
		<th>姓名：</th>
		<td><input type="text" name="username" value="<?php if(!empty($name)){ echo $name; }?>"/></td>
	</tr>
	<tr>
		<th>年级：</th>
		<td>
			<select name="grade" id="grade" size="1" class="gold_sapji a">

		     <option value=''>请选择年级</option>

			   	<?php foreach($grade as $key=>$item):

			   	?>
					<option value='<?php  echo $key ?>' <?php if(!empty($grades)){  if ($key == $grades){ echo "selected"; } }?>><?php echo $item['catname'];  ?></option>
			   	<?php  endforeach; ?>

		   </select>
		</td>
	</tr>
	<tr>
		<th>科目：</th>
		<td>
			<select name="subjects" id="subjects" size="1" class="gold_sapji a">

		     <option value=''>请选择科目</option>

			   	<?php foreach($subjects as $item):

			   	?>
					<option value='<?php  echo $item['courseid']; ?>' <?php if(!empty($subjects_sou)){ if ($item['courseid'] == $subjects_sou){ echo "selected"; }} ?>><?php echo $item['coursename'];  ?></option>
			   	<?php  endforeach; ?>

		   </select>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="tr_last">

		<input type="submit" style="cursor:pointer;" class="sub_btn mr10" value="搜索" />

		</td>
	</tr>
	</table>
	</form>
<table width="95%" border="0" cellpadding="0" cellspacing="1"
	bgcolor="8dc8e4">
	<caption class="capcenter">教师列表</caption>
	<tr>
		<th>ID</th>
		<th>老师名字</th>
		<th>头像</th>
		<th>课程</th>
		<th>年级</th>
		<th>是否金牌教师</th>
		<th>增加时间</th>
		<th>是否在首页显示</th>
		<th>操作</th>
	</tr>
	<?php if(!empty($teacher)){ ?>
	<?php foreach($teacher as $item): ?>
	<tr>
		<td><?php echo $item['tid']; ?></td>
		<td><?php echo $item['teachername']; ?></td>
		<td>

		<?php

		if($item['pic']){

			echo '<img width="100" height="100" src="'.$item['pic'].'"/>';

		}

		?>
		</td>
		<td>
		<?php

		if(!empty($subjects)){
				foreach($subjects as $grade_val){

						if($grade_val['courseid'] == $item['catid']){

							echo $grade_val['coursename'];

						}

					}

		}

				 ?>

		</td>
		<td>
		<?php

			if(!empty($grade)){
					foreach($grade as $grade_val){

						if($grade_val['catid'] == $item['schoolid']){

							echo $grade_val['catname'];

						}

					}
			}
		?>
		</td>
		<td><?php if($item['isgold']) {echo '金牌教师';}else{echo '普通教师';}; ?></td>
		<td><?php echo date('Y-m-d',$item['addtime']); ?></td>
		<td>
		<?php
			if($item['recommendid'] ==1){
				echo "<font color='red'>是</font>";
			}else{
				echo "否";
			}
			?>
		</td>
		<td><a href="<?php echo site_url('/teacher/teacher_editor/'.$item['tid'])?>">编辑</a>  <a href="javascript:void(0)" onClick="teacher_delete(<?php echo $item['tid'];?>)">删除</a></td>
	</tr>
	<?php endforeach;?>
	<?php }?>
	<tr>
		<td colspan="10" class="tr_last"><a href="<?php echo site_url('/teacher/teacher_add/');?>"><input type="button" id="" style="cursor:pointer;" class="sub_btn mr10" value="添加教师" /></a></td>
	</tr>
</table>
<?php  if(!empty($page)){echo $page;} ?>
</div>
</div>
<?php $this->load->view('footer'); ?>
<script language="JavaScript" type="text/javascript">

	function teacher_delete(tid){

		$.get('index.php/teacher/teacher_delete/'+tid,function(r){

			alert('删除成功');

			location.reload();

		});

	}

	function SelectAll() {

	 var checkboxs=document.getElementsByName("selID");

		 for (var i=0;i<checkboxs.length;i++) {

		  var e=checkboxs[i];

		  e.checked=!e.checked;

		 }

	}

</script>
