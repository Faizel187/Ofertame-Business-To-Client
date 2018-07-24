<?php
date_default_timezone_set('Europe/Madrid');
session_start();
include_once("model.php");
$userID = $_GET["userID"];

$connect = mysqli_connect("localhost","root","usbw","test_proyecto");

$sql = "update usuario set activo = 0 where correo='$userID'";

 if (mysqli_query($connect,$sql))
 {	
    $sql = "update reserva set activo = 0 where correo_usuario='$userID'";

    if (mysqli_query($connect,$sql))
    {	
        header("Location: admin.html");
    }
 }

?>