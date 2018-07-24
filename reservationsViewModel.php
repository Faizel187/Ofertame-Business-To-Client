<?php
date_default_timezone_set('Europe/Madrid');
session_start();
include_once("model.php");
$offerID = $_GET["offerID"];
$email = $_SESSION['email'];
$today = date("Y-m-d");

$connect = mysqli_connect("localhost","root","usbw","test_proyecto");

$sql = "insert into reserva values ($offerID, '$email',null, '$today',1)";


 if (mysqli_query($connect,$sql))
 {	

    $sql2 = "update oferta set unidades = unidades - 1 where id_oferta = $offerID";

    if (mysqli_query($connect,$sql2))
    {	
        header("Location: main.html");
    }
    else
    {
        echo $sql2;
    }
 }
 else
 {
     echo $sql;
 }
 

?>