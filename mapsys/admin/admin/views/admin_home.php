<?php $this->load->view('admin_html_header'); ?>
<?php $this->load->view('admin_header'); ?>

<!--content starts-->
<div id="content">
	<?php $this->load->view('admin_left'); ?>

    <div id="right">
    	<?php $this->load->view('admin_notice'); ?>
    	<?php $this->load->view('admin_main'); ?>
    </div>
	<!--rigth ends-->
	<div class="iclear"></div>
</div>
<!--{include admin_footer}-->