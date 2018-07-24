<?php
	
	$connect = mysqli_connect("localhost","root","usbw","test_proyecto");

	if(isset($_POST["email"]) && isset($_POST["password"]))
	{

		$correo = $_POST["email"];
		$pass = $_POST["password"];

		$pass_hash = hash("md5","$pass");

		$sql = "SELECT correo FROM usuario WHERE correo='$correo' AND clave='$pass_hash' AND activo = 1";

		$result = mysqli_query($connect,$sql);

		$num_row = mysqli_num_rows($result);

		if($num_row == "1")
		{	
			if ($correo == 'admin@admin.com')
			{
				session_start();
				$data = mysqli_fetch_array($result);
				$_SESSION["email"] = $data["correo"];
				echo "2";		
			}
			else
			{
				session_start();
				$data = mysqli_fetch_array($result);
				echo "1";
				$_SESSION["email"] = $data["correo"];
			}
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "error";
	}

?>