
<?php
	header ('Content-type: text/html; charset=utf-8');
	 
	$customerName=$_POST["customerName"];
	$contactLastName=$_POST["contactLastName"];
	$contactFirstName=$_POST["contactFirstName"];
	$city=$_POST["city"];
	$country=$_POST["country"];	
	$credit=$_POST["credit"];	

	$query = "SELECT * FROM customers";
	$strAndWhere = " WHERE ";

	if($customerName != null) {
		$query = $query. $strAndWhere . "customerName LIKE '%$customerName%'";
		$strAndWhere = " AND ";
	}
	if ($contactLastName != null) {
		$query = $query. $strAndWhere . "contactLastName LIKE '%$contactLastName%'";
		$strAndWhere = " AND ";
	}
	if ($contactFirstName != null) {
		$query = $query. $strAndWhere . "contactFirstName LIKE '%$contactFirstName%'";
		$strAndWhere = " AND ";
	}
	if ($city != null) {
		$query = $query. $strAndWhere . "city LIKE '%$city%'";
		$strAndWhere = " AND ";
	}
	if ($country != null){
		$query = $query. $strAndWhere . "country = '$country'";
		$strAndWhere = " AND ";
	}
	if($credit != null){

	}


	$link = mysql_connect('localhost', 'root', 'usbw') or die('Error: ' . mysql_error());
	mysql_select_db('classicmodels') or die('Error al seleccionar la base de dades');
	mysql_set_charset('utf8', $link);
	$result = mysql_query($query) or die('Error: ' . mysql_error());

	$pob = array();	
		
	while($row = mysql_fetch_array($result)){
		
	$customerName=$row['customerName'];
	$contactLastName=$row['contactLastName'];
	$contactFirstName=$row['contactFirstName'];
	$city=$row['city'];
	$country=$row['country'];	
		
	  $pob[] = array('customerName'=> $customerName, 'contactLastName'=> $contactLastName, 'contactFirstName'=> $contactFirstName, 'city'=> $city, 'country'=> $country);
	  
	}
	
	$json_string = json_encode($pob);
	echo $json_string;
?>