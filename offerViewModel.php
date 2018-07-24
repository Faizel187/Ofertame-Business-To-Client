<?php
session_start();

$offerID = $_GET["offerID"];
$tittle = $_GET["tittle"];
$offerImage = $_GET["offerImage"];
$category = $_GET["category"];
$remaining = $_GET["remaining"];
$endDate = $_GET["endDate"];
$company = $_GET["company"];
$description = $_GET["description"];

$_SESSION['offerID'] =  $offerID;
$_SESSION['tittle'] =  $tittle;
$_SESSION['offerImage'] =  $offerImage;
$_SESSION['category'] =  $category;
$_SESSION['remaining'] =  $remaining;
$_SESSION['endDate'] =  $endDate;
$_SESSION['company'] =  $company;
$_SESSION['description'] =  $description;

header("Location: ofertas.html");
?>