$(document).ready(function(){
	$('.sponsors').click(function(e){
	
		if( $(this).next(".sponsors_down").css('display') !='none' )
		{
			$(this).next(".sponsors_down").slideUp(1500);
			$(this).next(".sponsors_down").css('display','none');
		}
		else
		{
			$(this).next(".sponsors_down").slideDown('slow');
			$(this).next(".sponsors_down").css('display','block');
		}
	})
});