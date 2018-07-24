$(document).ready(function() {

		$(".col-md-4").click(function() {

		var tittle = $(this).find("#tittle").text();
		var offerImage = $(this).find("#offerImage").text();
		var category = $(this).find("#category").text();
		var endDate = $(this).find("#endDate").text();
		var company = $(this).find("#company").text();
		var description = $(this).find("#description").text();
		var reservationID = $(this).find("#reservationID").text();
		var dni = $(this).find("#dni").text();
		var birthday = $(this).find("#birthday").text();
		var username = $(this).find("#username").text();
		var lastname = $(this).find("#lastname").text();
		
		window.location.assign("ticketViewModel.php?tittle="+tittle+
		"&offerImage="+offerImage+
		"&category="+category+
		"&endDate="+endDate+
		"&company="+company+
		"&description="+description+
		"&reservationID="+reservationID+
		"&dni="+dni+
		"&birthday="+birthday+
		"&username="+username+
		"&lastname="+lastname);
	});
});