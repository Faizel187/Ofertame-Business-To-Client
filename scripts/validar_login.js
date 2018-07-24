$(document).ready(function() {
	$("#btn_submit").click(function() {
		
		var email = $('#email').val();
		var password = $('#password').val();


		if ($.trim(email).length > 0 && $.trim(password).length > 0)
		{	
			$.ajax({
				url: "php/validar_login.php",
				method: "POST",
				data:{email:email, password:password},
				cache: "false",
				beforeSend:function() {
					$("#btn_submit").val("Conectando...");
				},
				success:function(data) {
					
					if (data == "1")
					{
						$(location).attr("href","mis-reservas.html");
					}
					else if (data == "2")
					{
						$(location).attr("href","admin.html");
					}
					else
					{
						$("#btn_submit").val("Entrar");
						$("#text_message").html("<div class='alert alert.dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error!</strong> Los datos son incorrectos.</div>");
					}
				}
			});
		};
	});
});