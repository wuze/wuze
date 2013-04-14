<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>

<style>
<!--
table{
  	background: none repeat scroll 0 0 #FFFFFF;
    border-collapse: collapse;
    font-size: 12px;
    text-align: left;
}
.atable{
 	background: none repeat scroll 0 0 #FFFFFF;
    border-collapse: collapse;
    margin: 0 0 15px;
    width: inherit;
}

.atable th.h_60 {
}
.atable th {
    background: -moz-linear-gradient(center top , #F7F7F7, #CFCFCF) repeat scroll 0 0 transparent;
    border: 1px solid #C0C0C0;
    font-weight: bold;
    line-height: 14px;
    padding: 8px 0;
    text-align: center;
}
.atable td, .atable th {
    border: 1px solid #DEDEDE;
    color: #333333;
    font-size: 12px;
    line-height: 16px;
    padding: 5px;
}
-->
</style>
<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>
    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	
    	<div id="main"><h4><?php echo $html_title; ?></h4></div>
		<div style="border: 1px solid #C4D5DF; margin: 0 auto 10px; padding: 10px;overflow:hidden;zoom:1px;">
		<table class="atable" >
    	<tbody>
			<tr>
				<th class="h_60" width="150">序号</th>
				<th class="h_60" width="150">分类ID</th>
				<th class="h_60" width="150">分类标题</th>
				<th class="h_60" width="150">是否父级分类</th>
				<th class="h_60" width="150">子分类</th>
				<th class="h_60" width="250">操&nbsp;&nbsp;&nbsp;&nbsp;作</th>
			</tr>
			
			
    	<?php if($list){?>
    		<?php  foreach ( $list as $k=>$v) :?>
    		<tr id="tr_<?php echo $v['id'];?>">
    			<td style="text-align:center;"><?php echo $k+1; ?></td>
    			<td style="text-align:center;"><?php echo $v['id']; ?></td>
    			<td style="text-align:center;"><?php echo $v['catname']; ?></td>
    			<td style="text-align:center;"><?php if($v['parentid']==1){ echo "是";} else { echo "否";} ?></td>
    			<td style="text-align:center;">
    					<a id="a_<?php echo $v['id'];?>" style="cursor:pointer;color:red;" onclick="unpublish(<?php echo $v['id'];?>)">查看所有子分类</a>
    			</td>
    			
    			<td style="text-align:center;">
    			    
    			    <a id="a_<?php echo $v['id'];?>" style="cursor:pointer;color:red;" onclick="unpublish(<?php echo $v['id'];?>)">查看所有点</a>
    	    		<a style="cursor:pointer;" onclick="delItem(<?php echo $v['id'];?>)">删除该分类</a>
    			    <a style="cursor:pointer" href="<?php echo site_url('/baikelist/update_index/'.$v['id']);?>">修改</a>

    			</td>
    		</tr>
    		<?php endforeach;?>
    		<?php }else{?>
		<tr><td colspan="9" style="text-align:center;">没有内容，<a href="<?php echo site_url('slist/edit');?>">去编辑</a></td></tr>
		<?php }?>
		</tbody>
		</table>
		<div ><?php echo $this->pagination->create_links();?></div>
		</div>
    </div>
	<div class="iclear"></div>
</div>

<script type="text/javascript">
<!--
function delItem(id)
{
	art.dialog('简单愉悦的接口，强大的表现力，优雅的内部实现', function(){alert('yes');});
}
//-->
</script>
<!--{include admin_footer}-->