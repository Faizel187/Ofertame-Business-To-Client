<?php
session_start();

$tittle = $_GET["tittle"];
$offerImage = $_GET["offerImage"];
$category = $_GET["category"];
$endDate = $_GET["endDate"];
$company = $_GET["company"];
$description = $_GET["description"];
$reservationID = $_GET["reservationID"];
$dni = $_GET["dni"];
$birthday = $_GET["birthday"];
$username = $_GET["username"];
$lastname = $_GET["lastname"];

$_SESSION['tittle'] =  $tittle;
$_SESSION['offerImage'] =  $offerImage;
$_SESSION['category'] =  $category;
$_SESSION['endDate'] =  $endDate;
$_SESSION['company'] =  $company;
$_SESSION['description'] =  $description;
$_SESSION['reservationID'] =  $reservationID;
$_SESSION['dni'] =  $dni;
$_SESSION['birthday'] =  $birthday;
$_SESSION['username'] =  $username;
$_SESSION['lastname'] =  $lastname;
header("Location: reserva-echa.html");
?>