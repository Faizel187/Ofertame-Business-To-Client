<?php

	date_default_timezone_set('Europe/Madrid');
	$connect = mysqli_connect("localhost","root","usbw","test_proyecto");

	$correo = $_POST["email"];
	$pass = $_POST["password"];
	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];
	$fecha = $_POST["fecha"];
	$dni = $_POST["dni"];
	$telefono = $_POST["telefono"];

	
	$pass_hash = hash("md5","$pass");

	$sql = "UPDATE usuario SET clave='$pass_hash',dni='$dni',nombre='$nombre',apellidos='$apellido',telefono='$telefono',fecha_nacimiento='$fecha' where correo='$correo'";

	if (mysqli_query($connect,$sql))
	{	
		echo "3";

	}
	
?>