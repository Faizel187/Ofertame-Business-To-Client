$(document).ready(function() {

		$(".col-md-4").click(function() {

		var offerID = $(this).find("#offerID").text();
		var tittle = $(this).find("#tittle").text();
		var offerImage = $(this).find("#offerImage").text();
		var category = $(this).find("#category").text();
		var remaining = $(this).find("#remaining").text();
		var endDate = $(this).find("#endDate").text();
		var company = $(this).find("#company").text();
		var description = $(this).find("#description").text();

		window.location.assign("offerViewModel.php?tittle="+tittle+
		"&offerImage="+offerImage+
		"&category="+category+
		"&remaining="+ remaining+
		"&endDate="+endDate+
		"&company="+company+
		"&description="+description+
		"&offerID="+offerID);

	});


	$("#btn_submit").click(function() {

		var offerID = $("#offerDiv").find("#offerID").text();
		window.location.assign("reservationsViewModel.php?offerID="+offerID);
	});

	$("#btn_submit_bootstrap").click(function() {

		var offerID = $("#offerDiv").find("#offerID").text();
		window.location.assign("reservationsViewModel.php?offerID="+offerID);
	});
	
});