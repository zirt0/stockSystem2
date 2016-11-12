<?php

include("config.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$subject = $request->subject;
$id = $request->id;

$args = $request->args;


//print $subject;
//add_payment
if($subject == "add_product"){

	$sql = "INSERT INTO products (
						locatie_id, 
						artikelcode, 
						artikelnummer, 
						artikel_naam, 
						omschrijving, 
						voorraad, 
						inkoopprijs_ex_btw, 
						verkoopprijs_ex_btw, 
						btw, 
						eenheid
						)
			VALUES ( 	'" . $args->plaats . "', 
						'" . $args->artikelcode . "', 
						'" . $args->artikelnummer . "', 
						'" . $args->artikel_naam . "', 
						'" . $args->omschrijving . "', 
						'" . $args->voorraad . "', 
						'" . $args->inkoopprijs_ex_btw . "', 
						'" . $args->verkoopprijs_ex_btw . "', 
						'" . $args->eenheid . "', 
						'" . $args->btw . "')";

				if ($conn->query($sql) === TRUE) {
				    $result = "New record created successfully";
				} else {
				    $result = "Error: " . $sql . "<br>" . $conn->error;
				}
				
				$outp = $sql;
}

$conn->close();

echo $outp;