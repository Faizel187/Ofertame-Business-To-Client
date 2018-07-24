<?php
date_default_timezone_set('Europe/Madrid');
session_start();
include_once("model.php");

$category = $_GET["category"];
$action = $_GET["action"];
$email = $_SESSION["email"];

$connect = mysqli_connect("localhost","root","usbw","test_proyecto");

if($action == "like")
{
    $sql = "insert into gusta values ('$email', '$category')";
}
else
{
    $sql = "delete from gusta where correo_usuario = '$email' and nombre_categoria = '$category'";
}

 if (mysqli_query($connect,$sql))
 {	

    header("Location: mis-gustos.html");
 }

 echo $sql;

?>