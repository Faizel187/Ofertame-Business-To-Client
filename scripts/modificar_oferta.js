$(document).ready(function() {
	$("#btn_eliminar").click(function() {
		
	    ofertaID =  $(this).find("#ofertaIDtext").text();
	    alert(ofertaID);
		//window.location.assign("modificar_oferta.php?ofertaID="+ofertaID);
	
	});

});