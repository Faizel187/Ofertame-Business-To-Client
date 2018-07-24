$(document).ready(function() {

		$(".datosFiltrar").click(function() {

		var tittle = $(this).find("#tittle").text();
		if(tittle == "")
		{
			tittle = $(this).text();
		}

		window.location.assign("filtersViewModel.php?tittle="+tittle);
	});
});