$(document).ready(function() {
	// LoginForm
	{
		var $Toogle = 0;
		
		$("#LoginForm").slideToggle(0);
		$("#LoginForm").css("opacity", "0");
		
		$("#LoginBarToogle").click(function() {
			
			if($Toogle == 0) {
				$("#LoginForm").slideToggle("slow", function(){
					$(this).fadeTo(500, 1);
				});
			} else {
				$("#LoginForm").fadeTo(200, 0, null, function(){
					$(this).slideToggle("slow");
				});
			}
			
			$Toogle ^= 1;
		});
	}
});