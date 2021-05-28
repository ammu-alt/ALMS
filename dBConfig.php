<?php

	//Databse Connection
	try{
		$pdo = new PDO('mysql:host=localhost;dbname=alms', 'root', '');
		//set the PDO error mode to exception
		$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//print host information
		//echo "Connect Successfully. Host info: "  .$pdo -> getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));
	} catch(PDOException $e){
		die("ERROR: Could not connect. " . $e -> getMessage());
	}
?>
