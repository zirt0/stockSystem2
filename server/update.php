<?php

include("config.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$subject = $request->subject;
$id = $request->id;

$args = $request->args;

//print $subject;


if($subject == "update_product"){

	$sql = "UPDATE products 
			SET 
			locatie_id = '" . $args->plaats . "',
			artikelcode = '" . $args->artikelcode . "',
			artikel_naam = '" . $args->artikel_naam . "',
			omschrijving = '" . $args->omschrijving . "',
			voorraad = '" . $args->voorraad . "',
			inkoopprijs_ex_btw = '" . $args->inkoopprijs_ex_btw . "',
			verkoopprijs_ex_btw = '" . $args->verkoopprijs_ex_btw . "',
			btw = '" . $args->btw . "',
			eenheid = '" . $args->eenheid . "'

			WHERE id='" . $args->id . "'";

				if ($conn->query($sql) === TRUE) {
				    $result = "New record created successfully";
				} else {
				    $result = "Error: " . $sql . "<br>" . $conn->error;
				}
				$outp = $result;
				$outp = $sql;
}



$conn->close();

echo $outp;