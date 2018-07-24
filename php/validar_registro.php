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

	$sql = "SELECT correo FROM usuario WHERE correo='$correo'";

	$result = mysqli_query($connect,$sql);

	$num_row = mysqli_num_rows($result);

	if ($num_row == "0")
	{
		$sql2 = "SELECT dni FROM usuario WHERE dni='$dni'";

		$result = mysqli_query($connect,$sql2);

		$num_row = mysqli_num_rows($result);

		if ($num_row == "0")
		{	
			$pass_hash = hash("md5","$pass");				
			$register_date = date("Y-m-d");

			$sql3 = "insert INTO usuario (correo,clave,dni,nombre,apellidos,telefono,fecha_nacimiento,tipo,fecha_alta,activo) VALUES('$correo', '$pass_hash', '$dni', '$nombre', '$apellido', '$telefono', '$fecha', 'usuario','$register_date',1)";

			if (mysqli_query($connect,$sql3))
			{	
				session_start();
				echo "3";
				$_SESSION["email"] = $correo;
			}
		}
		else
		{
			echo "2";
		}
	}
	else
	{
		echo "1";
	}

?>