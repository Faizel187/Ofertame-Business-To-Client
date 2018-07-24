<?php
	session_start();

	$email = $_SESSION['email'];

	header ('Content-type: text/html; charset=utf-8');

	$link = mysql_connect('localhost', 'root', 'usbw') or die('Error: ' . mysql_error());
		mysql_select_db('test_proyecto') or die('Error al seleccionar la base de dades');
		mysql_set_charset('utf8', $link);

		$query = "SELECT * FROM usuario WHERE correo= '$email'";
		$result = mysql_query($query) or die('Error: ' . mysql_error());

		$emp = array();

		while($row = mysql_fetch_array($result))
		{
			$inputEmail = $row['correo'];
			$inputPassword = $row['clave'];
			$inputDNI = $row['dni'];
			$inputNombre = $row['nombre'];
			$inputApellido = $row['apellidos'];
			$inputTelefono = $row['telefono'];
			$inputFecha = $row['fecha_nacimiento'];

			$emp[] = array('correo'=> $inputEmail,'clave'=> $inputPassword, 'dni'=> $inputDNI, 'nombre'=> $inputNombre, 'apellidos'=> $inputApellido, 'telefono'=> $inputTelefono, 'fecha_nacimiento'=> $inputFecha);
		}

		$json_string = json_encode($emp);
		echo $json_string;

?>