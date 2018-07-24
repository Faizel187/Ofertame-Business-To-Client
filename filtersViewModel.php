<?php
date_default_timezone_set('Europe/Madrid');
session_start();
include_once("model.php");

$tittle = $_GET["tittle"];
$_SESSION['filter'] =  $tittle;
header("Location: main.html");
?>