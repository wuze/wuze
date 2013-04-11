<!--left starts-->
	<div id="left" self="{$_SERVER['PHP_SELF']}">
        
        <div class="top_nav3">
	     <ul><li><a href="<?php echo site_url(''); ?>">回到首页</a></li></ul>
        </div>
        
        <div class=top_nav3>
        	<h2><span>本站首页</span></h2>
            <ul class="last" >
            	<li <?php if($pagetitle=='关于我们'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a  href="<?php echo site_url('about'); ?>">关于我们</a></li>
            	<li <?php if($pagetitle=='公司简介'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a  href="<?php echo site_url('company/com_edit'); ?>">公司简介</a></li>
            </ul>
        </div>
        
        <div class=top_nav3>
        	<h2><span>联系我们</span></h2>
            <ul class="last">
            	<li <?php if($pagetitle=='联系我们'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a href="<?php echo site_url('contactus'); ?>">联系我们</a></li>
            </ul>
        </div>
        
        
        <div class=top_nav3>
        	<h2><span>友情链接</span></h2>
            <ul class="last">
            	<li <?php if($pagetitle=='园林景观'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a href="<?php echo site_url('viewlist'); ?>">友情链接列表</a></li>
        </div>       
        
        <div class=top_nav3>
        	<h2><span>传统类</span></h2>
            <ul class="last">
                <li <?php if($pagetitle=='产品展示'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a href="<?php echo site_url('product'); ?>">传统类列表</a></li>
            	<li <?php if($pagetitle=='上传图片(产品)'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a href="<?php echo site_url('product/upload_index'); ?>">录入传统类信息</a></li>
            </ul>
        </div>
        
        
        <div class=top_nav3>
        	<h2><span>索引类</span></h2>
            <ul class="last">
                <li <?php if($pagetitle=='新闻列表'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a href="<?php echo site_url('newslist'); ?>">索引类列表</a></li>
				<li <?php if($pagetitle=='编辑新闻'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a href="<?php echo site_url('newslist/news_edit'); ?>">录入索引类信息</a></li>
            </ul>
        </div>
        
        <div class=top_nav3>
        	<h2><span>用户管理</span></h2>
            <ul class="last">
                <li <?php if($pagetitle=='增加用户'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a href="<?php echo site_url('addadmin'); ?>">增加用户</a></li>
                <li <?php if($pagetitle=='修改密码'){?>style="background: none repeat scroll 0px 0px rgb(255, 153, 0);"<?php } ?>><a href="<?php echo site_url('password_modify'); ?>">修改密码</a></li>
            </ul>
        </div>
    </div>

