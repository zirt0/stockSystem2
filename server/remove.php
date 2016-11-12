<?php

include("config.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$subject = $request->subject;
$id = $request->id;

$args = $request->args;

//print $subject;


if($subject == "remove_product"){

	$sql = "DELETE FROM products
			WHERE id='" . $args->id . "';";

				if ($conn->query($sql) === TRUE) {
				    
				    $result = "Removed";
				    
				} else {
				    $result = "Error: " . $sql . "<br>" . $conn->error;
				    //$result = "false";
				}
				$outp = $result;
				//$outp = $sql;
}



$conn->close();

echo $outp;