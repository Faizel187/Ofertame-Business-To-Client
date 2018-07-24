$(document).ready(function() {

	var control_name = true;
	var control_surname = true;
	var control_date = true;
	//var control_email = false;
	var control_dni = true;
	var control_phone = true;
	var control_password = true;

	var fecha = "";
	var nombre = "";
	var apellido = "";
	var email = "";
	var telefono = "";
	var password = "";
	var fecha = "";

	//$("#email_error").hide();
	$("#password_error").hide();
	$("#dni_error").hide();
	$("#phone_error").hide();
	$("#name_error").hide();
	$("#surname_error").hide();

	/*$("#email").focusout(function() {

		chekEmail();

	});*/

	$("#password").focusout(function() {

		chekPassword();

	});

	$("#dni").focusout(function() {

		chekDNI();

	});

	$("#telefono").focusout(function() {

		checkPhone();

	});

	$("#nombre").focusout(function() {

		checkName();

	});

	$("#apellido").focusout(function() {

		checkSurname();

	});

	$("#fecha").focusout(function() {

		checkDate();

	});


	$("#btn_submit").click(function() {

		if (control_name == true && control_surname == true && control_password == true && control_date == true && control_phone == true)
		{	
			nombre = $("#nombre").val();
			apellido = $("#apellido").val();
			telefono = $("#telefono").val();
			password = $("#password").val();
			dni = $("#dni").val();
			email = $("#email").val();
			fecha = $("#fecha").val();

			$.ajax({
				url: "php/modificar_perfil.php",
				method: "POST",
				data:{email:email, password:password, fecha:fecha, nombre:nombre, apellido:apellido, dni:dni, telefono:telefono},
				cache : "false",
				beforeSend:function() {
					$("#btn_submit").val("Modificando...");
				},
				success:function(data) {	
					$("#btn_submit").val("Modificar");
					if (data == "3")
					{	

						$(location).attr("href","perfil.html");
					}

				}

			});
		}
	});


	function checkDate()
	{
		fecha = $("#fecha").val();

		if (fecha != "")
		{
			control_date = true;
		}
		else
		{
			control_date = false;
		}

	}

	function checkName()
	{
		nombre = $("#nombre").val().length;
		if (nombre < 4)
		{	
			control_name = false;
			$("#name_error").html("Mínimo 4 carácteres.");
			$("#name_error").show();
				
		}
		else
		{
			nombre = $("#nombre").val();
			control_name = true;
			$("#name_error").hide();
		}
	}

	function checkSurname()
	{
		apellido = $("#apellido").val().length;

		if (apellido < 4)
		{	
			control_surname = false;
			$("#surname_error").html("Mínimo 4 carácteres.");
			$("#surname_error").show();		
		}
		else
		{
			apellido = $("#apellido").val();
			control_surname = true;	
			$("#surname_error").hide();
		}
	}

	/*function chekEmail()
	{
		var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[+a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$/i);
		email = $("#email").val();
		if (pattern.test(email))
		{	
			$("#email_error").hide();
			control_email = true;
		}
		else
		{
			control_email = false;
			$("#email_error").html("Formato correo incorrecto");
			$("#email_error").show();
			
		}
	}*/

	function chekPassword()
	{

		password = $("#password").val().length;

		if (password < 8)
		{
			$("#password_error").html("Almenos 8 carácteres.");
			$("#password_error").show();
			control_password = false;	
		}
		else
		{
			password = $("#password").val();
			$("#password_error").hide();
			control_password = true;
		}

	}

	function chekDNI()
	{
		dni = $("#dni").val();
	    var expresion_regular_dni;
	 
	    expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
	 
	    if(expresion_regular_dni.test (dni) == true){
	        numero = dni.substr(0,dni.length-1);
	        letr = dni.substr(dni.length-1,1);
	        numero = numero % 23;
	        letra='TRWAGMYFPDXBNJZSQVHLCKET';
	        letra=letra.substring(numero,numero+1);
	 		
			$("#dni_error").hide();
			control_dni = true;
	        if (letra!=letr.toUpperCase()) {
	             
	            $("#dni_error").html("Formato DNI incorrecto.");
				$("#dni_error").show();
				control_dni = false;
	        }
	    }
	    else{
	        $("#dni_error").html("Formato DNI incorrecto.");
			$("#dni_error").show();
			control_dni = false;
	    }

	}

	function checkPhone()
	{
		telefono = $("#telefono").val().length;

		if (telefono != 9)
		{	
			control_phone = false;
			$("#phone_error").html("Formato teléfono inválido.");
			$("#phone_error").show();
		}
		else
		{	
			telefono = $("#telefono").val();
			control_phone = true;
			$("#phone_error").hide();
		}

	}

});