<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>jQuery EasyUI</title>
<link rel="stylesheet" type="text/css" href="<?=IMAGES_URL?>manage/js/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="<?=IMAGES_URL?>manage/js/themes/icon.css" />
<script type="text/javascript" src="<?=IMAGES_URL?>manage/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?=IMAGES_URL?>manage/js/jquery.easyui.min.1.2.2.js"></script>
<script type="text/javascript" src="<?=IMAGES_URL?>manage/js/windowControl2.3.js"></script>
<script type="text/javascript" src="<?=IMAGES_URL?>manage/js/lhgdialog/lhgcore.min.js"></script>
<script type="text/javascript" src="<?=IMAGES_URL?>manage/js/lhgdialog/lhgdialog.min.js?t=self"></script>
<script>
		$(function(){
			$('#test').datagrid({
				title:'<?=$title?>',
				iconCls:'icon-ok',
				fitCloumns: true,
				rownumbers: false,
				nowrap: true,
				animate:true,
				loadMsg:'数据加载中请稍后……',
				striped: true,
				url:'<?=site_url(array($this->config->config['controller_trigger'] => $this->router->class, $this->config->config['function_trigger'] => $this->router->method, 'datatype' => 'json'))?>',
				sortName: 'logid',
				sortOrder: 'desc',
				idField:'logid',
				frozenColumns:<?=$fozencolumns?>,/***/
				columns:<?=$columns?>,
				pagination:true,
				rownumbers:true,
				singleSelect:<?echo empty($singleSelect)?'false':$singleSelect;?>,
				toolbar:<?=$toolbar?>,
					pageList:[10,15,20,30,50],
					loading:true,
					showPageList:true
			});

			$("#test").datagrid('getPager').pagination({
				//pageNumber:1,
				//queryParams:{pageNumber:5},//传入参数：书籍类别 
				//showPageList: false,
				//showRefresh: false,
				<?if(!empty($total)) {echo 'total:'.$total.',';}?>
				<?if(!empty($pageSize)) {echo 'pageSize:'.$pageSize.',';}?>
				<?if(!empty($pageno)) {echo 'pageNumber:'.$pageno.',';}?>
				beforePageText: "第",
				afterPageText: "页 <a href='javascript:void(0)' onclick='GoEnterPage()'>go</a>，共{pages}页",
				displayMsg: '当前{from}到{to}条，总共{total}条',
				onBeforeRefresh:function(){
				},
				//callback: pageselectCallback,
				onChangePage:function(pageNumber, pageSize){
					pageselectCallback(pageNumber, pageSize);
				},
				onSelectPage:function(pageNumber, pageSize){
					pageselectCallback(pageNumber, pageSize);
				}
			});



		});
		function pageselectCallback(pageNumber, pageSize){
			var queryParams = $('#test').datagrid('options').queryParams;
			queryParams.pageNumber = pageNumber;
			queryParams.pageSize = pageSize;
			$("#test").datagrid('reload'); 
		}

		function GoEnterPage() {
			var e = jQuery.Event("keydown");
			e.keyCode = 13;
			$("input.pagination-num").trigger(e);
		}
		function resize(){
			$('#test').datagrid({
				title: 'New Title',
				striped: true,
				width: 650,
				queryParams:{
					p:'param test',
					name:'My Name'
				}
			});
		}


		

		function getSelected(){
			var selected = $('#test').datagrid('getSelected');
			if (selected){
				alert(selected.code+":"+selected.name+":"+selected.addr+":"+selected.col4);
			}
		}
		function getSelections(){
			$.messager.confirm('信息提示','确定要删除该信息', function(r){
				if(r)
				{
					var ids = [];
					var rows = $('#test').datagrid('getSelections');
					for(var i=0;i<rows.length;i++){
						ids.push(rows[i].logid);
					}
					ids_str = ids.join(':');
					$.ajax({
						type: 'POST',
						url: "<?=site_url(array($this->config->config['controller_trigger'] => 'adminlogmanage', $this->config->config['function_trigger'] => 'del'))?>",
						data: "logid="+ids_str,
						dataType: 'json',
						success:function(data) {
							$.messager.confirm('信息提示', data.msg, function(rr){
								if(rr){
									$("#test").datagrid('reload'); 
								}
							});

						}
					});
					
				}
			});
		}

		/**function getSelected(){
			var selected = $('#test').datagrid('getSelected');
			alert(selected.code+":"+selected.name);
		}
		function getSelections(){
			var ids = [];
			var rows = $('#test').datagrid('getSelections');
			for(var i=0;i<rows.length;i++){
				ids.push(rows[i].code);
			}
			alert(ids.join(':'))
		}**/

		

		function clearSelections(){
			$('#test').datagrid('clearSelections');
			//取消选择DataGrid中的全选
			$("input[type='checkbox']").eq(0).attr("checked", false);
		}
		function selectRow(){
			$('#test').datagrid('selectRow',2);
		}
		function selectRecord(){
			$('#test').datagrid('selectRecord','002');
		}
		function unselectRow(){
			$('#test').datagrid('unselectRow',2);
		}

		function dialog_open(url,scroll)
		{//autoPos:{left:'center',top:'center'}, 

		//var dg = new J.dialog({page:url, lockScroll:true,cover:true, bgcolor:'#000', opacity:0.2, rang:true, width:800, height:600,});
		var dg = new J.dialog({title:'页面', page:url, lockScroll:true,cover:true, bgcolor:'#000', opacity:0.2,rang:true,  width:800, height:400});
		dg.ShowDialog();
	return ;
/**
normal({url:url,title:'提示'});return;
			var path = url;

			
var confing = {
	url : path,
	title : "标题",
	width : 800,
	height : 400,
	maximizable : true,
	minimizable : true,
	buttons : [{
			text : '继续>>',
			handler : function() {
				fun(GETWIN(this));
			}
	}]
};
var curDialogId = $.createWin(confing);

return '';
url='http://www.bkw121.local/admin/';
*/			scroll = scroll || 'hidden';
			$('#openXXXIframe')[0].src=url;
			
			$('#openRoleDiv').window('open');
			if(scroll == 'auto')
			{
				$('#openXXXIframe').css({overflow:'auto',scrolling:'auto'});
				$('#openRoleDiv').css({overflow:'hidden',scrolling:'auto'});
			}else{
				$('#openRoleDiv').css({overflow:'hidden',scrolling:'no'});
			}
		}
		function dialog_close()
		{
			$('#openXXXIframe')[0].src='';
			$('#openRoleDiv').dialog('close');
			location.reload();
		}

function normal(options){
	$.createWin({
		title:options.title,
		url:options.url,
		height:options.height,
		width:options.width,
		
		onClose:function(){
			
		},
		onMove:function(){
		
		},
		tools:[{iconCls:"icon-add"}],
		toolbar:[{text:'嘿嘿',iconCls:"icon-add"}]
	});
}
	</script>
</head>
<body>

<table id="test"></table>
<div id="openRoleDiv" class="easyui-window" closed="true" modal="true" title="标题" style="width:500px;height:350px;">
    <iframe scrolling="auto" id='openXXXIframe' frameborder="0" src="" style="width:100%;height:100%;"></iframe>
</div> 
</body>
</html>
