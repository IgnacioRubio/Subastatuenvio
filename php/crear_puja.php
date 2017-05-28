<?php

	$email = $_POST["email"];
	$puja = $_POST["puja"];
	$id_subasta = $_POST["id_subasta"];


	// DATA BASE CONNECTION & QUERY

	$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
	$USUARIO_DB = 'ig';
	$PASS_DB = '';

	try {
		// Conecting with the DB
		$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);


		// INSERT BID
		$sql_query = "SELECT * FROM pujas WHERE subasta LIKE :id_subasta AND transportista LIKE :email AND puja = :puja";
		$sql_insert = "INSERT INTO pujas (subasta, transportista, puja) VALUES (:id_subasta, :email, :puja)";
		

		// preparing the query 
		$resultado = $db_subastatuenvio->prepare($sql_query);


		$resultado->execute(array(':id_subasta'=>$id_subasta, ':email'=>$email, ':puja'=>$puja));

		$numRows = $resultado->rowCount();


		if ($numRows == 1) {
			// bid repeat
			echo false;
		}
		else {
			$resul_insert = $db_subastatuenvio->prepare($sql_insert);

			$resul_insert->execute(array(':id_subasta'=>$id_subasta, ':email'=>$email, ':puja'=>$puja));

			echo true;
		}

	}
	catch (PDOException $e) {
		die("Error: " .$e);
	}

?>