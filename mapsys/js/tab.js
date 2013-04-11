$(document).ready(function(){
	
	$("a.tab").click(function(){
		
		$(".active").removeClass("active");
		$(this).addClass("active");
		$(".tabContent").slideUp();
		
		var content_show=$(this).attr("title");
		$("#"+content_show).slideDown();
	})
});


function tabSwitch(new_tab, new_content) {
	
	document.getElementById('content_1').style.display = 'none';
	document.getElementById('content_2').style.display = 'none';
	document.getElementById('content_3').style.display = 'none';		
	document.getElementById(new_content).style.display = 'block';	
		
	document.getElementById(new_tab).className = 'active';		

}


function tabSwitch_2(active, number, tab_prefix, content_prefix) {
	
	for (var i=1; i < number+1; i++) {
	  document.getElementById(content_prefix+i).style.display = 'none';
	  document.getElementById(tab_prefix+i).className = '';
	}
	document.getElementById(content_prefix+active).style.display = 'block';
	document.getElementById(tab_prefix+active).className = 'active';	
	
}