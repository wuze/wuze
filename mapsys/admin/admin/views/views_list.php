<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>

<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>
    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	
    	<div id="main">产品展示<br></div>
		<div style="border: 1px solid #C4D5DF; margin: 0 auto 10px; padding: 10px;overflow:hidden;zoom:1px;">
		
		
		<?php if($list){?>
			<?php foreach ( $list as $k=>$v){ ?>
				<div style="border:1px solid #C4D5DF;float:left;padding:5px;margin:2px;" id="img_<?php echo $v['id'];?>">
				<p><img width="163" height="162" src="<?php echo $v['image_path']; ?>"  alt="<?php echo $v['image_name'];?>"></p>
				<p><label>图片名称:<?php if($v[image_name]){ echo $v['image_name']; }else{ echo "缺省"; }?></label>
				<p><a style="float:right;" href="javascript:void(0);" onclick="delpic(<?php echo $v['id'];?>,'<?php echo $v['image_name'];?>')">删除</a></p>
				</div>
			<?php } ?>
		<?php } else { ?>
				您还没有上传图片，去<a href="<?php echo site_url('/viewlist/upload_index');?>">上传图片</a>
		<?php }?>
		</div>
    </div>
	<div class="iclear"></div>
</div>

<script type="text/javascript">
<!--
function delpic(id,name){
	if(!id||!name) return;

	if( confirm("确定删除图片:"+name)){

		$.post('/admin/index.php/viewlist/del',{id:id},function(r){
			if( r.substr(0,1)== 1){
				$('#img_'+id).hide();
			}else{
				alert("删除失败");
			}
		});
	}
}
//-->
</script>
<!--{include admin_footer}-->