$(document).ready(function() {

	$(".userID").click(function() {
		
	    userID =  $(this).find("#userIDtext").text();
		window.location.assign("adminViewModel.php?userID="+userID);
	
	});

});