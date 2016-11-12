<?php

include("config.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$subject = $request->subject;
$id = $request->id;

$args = $request->args;

$decl = $request->decl;
//print $subject;



if($subject == "login"){

	$sql = "SELECT * FROM users WHERE username = '" . $args->username . "' AND password = '" . $args->password . "'";
	$result = $conn->query($sql);

	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}
	    $outp .= '{"id":"'  . $rs["id"] . '",';
	    $outp .= '"username":"'  . $rs["username"] . '",';
	    $outp .= '"password":"'  . $rs["password"] . '",';
	    $outp .= '"status":"'  . $rs["status"] . '",';
	   	$outp .= '"hourrate":"'  . $rs["hourrate"] . '",';
	   	$outp .= '"hourrate_reduced":"'  . $rs["hourrate_reduced"] . '",';
	   	$outp .= '"fname":"'  . $rs["fname"] . '",';
	   	$outp .= '"lname":"'  . $rs["lname"] . '",';
	   	$outp .= '"avatar":"'  . $rs["avatar"] . '",';
	    $outp .= '"role":"'. $rs["role"]    . '"}'; 
	}
	$outp = $outp;
}

if($subject == "users"){

	$sql = "SELECT * FROM users";

	if ($args->user_id){
		$sql .= " WHERE id = '" . $args->user_id ."'";
	}
	$result = $conn->query($sql);

	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}
	    $outp .= '{"id":"'  . $rs["id"] . '",';
	    $outp .= '"username":"'  . $rs["username"] . '",';
	    $outp .= '"password":"'  . $rs["password"] . '",';
	    $outp .= '"status":"'  . $rs["status"] . '",';
	   	$outp .= '"hourrate":"'  . $rs["hourrate"] . '",';
	   	$outp .= '"hourrate_reduced":"'  . $rs["hourrate_reduced"] . '",';
	   	$outp .= '"fname":"'  . $rs["fname"] . '",';
	   	$outp .= '"lname":"'  . $rs["lname"] . '",';
	   	$outp .= '"avatar":"'  . $rs["avatar"] . '",';
	    $outp .= '"role":"'. $rs["role"]    . '"}'; 
	}
	$outp ='{"records":['.$outp.']}';
	//$outp = $sql;
}

if($subject == "customer"){

	$sql = "SELECT * FROM customers WHERE id = '" . $id . "'";
	$result = $conn->query($sql);

	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}
	    $outp .= '{"id":"'  . $rs["id"] . '",';
	    $outp .= '"company":"'  . $rs["company"] . '",';
	    $outp .= '"fname":"'  . $rs["fname"] . '",';
	    $outp .= '"lname":"'  . $rs["lname"] . '",';
	    $outp .= '"tel":"'  . $rs["tel"] . '",';
	    $outp .= '"alt_tel":"'  . $rs["alt_tel"] . '",';
	    $outp .= '"email":"'  . $rs["email"] . '",';
	    $outp .= '"reference":"'  . $rs["reference"] . '",';
	    $outp .= '"address":"'  . $rs["address"] . '",';
	    $outp .= '"zipcode":"'  . $rs["zipcode"] . '",';
	    $outp .= '"city":"'  . $rs["city"] . '",';
	    $outp .= '"cor_address":"'  . $rs["cor_address"] . '",';
	    $outp .= '"cor_zipcode":"'  . $rs["cor_zipcode"] . '",';
	    $outp .= '"cor_city":"'  . $rs["cor_city"] . '",';
	    $outp .= '"branche":"'  . $rs["branche"] . '",';
	    $outp .= '"banknr":"'  . $rs["banknr"] . '",';
	    $outp .= '"kvk":"'  . $rs["kvk"] . '",';
	    $outp .= '"btwnr":"'  . $rs["btwnr"] . '",';
	    $outp .= '"date_add":"'  . $rs["date_add"] . '",';
	    $outp .= '"date_mutation":"'  . $rs["date_mutation"] . '",';
	    $outp .= '"comment":"'. $rs["comment"]    . '"}'; 
	}
	
	$outp = $outp;
}

if($subject == "get_products"){

	$sql = "SELECT * FROM products";
	
	if($id){
		$sql .= " WHERE products.id ='" . $id . "'";	
	}

	$result = $conn->query($sql);

	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}

	    $naam = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:', $rs["artikel_naam"]);
	    $omschrijving = json_encode($rs["omschrijving"]);

	    $outp .= '{"id":"'  . $rs["id"] . '",';
	    $outp .= '"plaats":"'  . $rs["locatie_id"] . '",';
	    $outp .= '"artikelcode":"'  . $rs["artikelcode"] . '",';
	    $outp .= '"artikel_naam":"'  . $rs["artikel_naam"]',';
	    $outp .= '"voorraad":"'  . $rs["voorraad"] . '",';
	    $outp .= '"eenheid":"'  . $rs["eenheid"] . '"}';
	    //$outp .= '"omschrijving":"'  . $omschrijving . '"}';


	    // $outp .= '{"id":"'  . stringify($rs["id"]) . '",';
	    // $outp .= '"plaats":"'  . stringify($rs["locatie_id"]) . '",';
	    // $outp .= '"artikelcode":"'  . stringify($rs["artikelcode"]) . '",';
	    // $outp .= '"artikelnummer":"'  . stringify($rs["artikelnummer"]) . '",';
	    // $outp .= '"artikel_naam":"'  . stringify($rs["artikel_naam"]) . '",';
	   	// $outp .= '"omschrijving":"'  . stringify($rs["omschrijving"]) . '",';
	   	// $outp .= '"voorraad":"'  . stringify($rs["voorraad"]) . '",';
	   	// $outp .= '"inkoopprijs_ex_btw":"'  . stringify($rs["inkoopprijs_ex_btw"]) . '",';
	   	// $outp .= '"verkoopprijs_ex_btw":"'  . stringify($rs["verkoopprijs_ex_btw"]) . '",';
	   	// $outp .= '"btw":"'  . stringify($rs["btw"]) . '",';
	   	// $outp .= '"eenheid":"'  . Jstringify($rs["eenheid"]) . '",';
	    // $outp .= '"datum":"'. stringify($rs["datum"])    . '"}'; 
	}
	//$outp = json_encode($outp);
	$outp ='{"records":['.$outp.']}';
	//$outp = $sql;
}


$conn->close();

echo $outp;