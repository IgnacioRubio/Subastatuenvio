<?php

	$email = $_POST["email"];
	$password = $_POST["password"];
	$role = $_POST["role"];


	// DATA BASE CONNECTION & QUERY

	$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
	$USUARIO_DB = 'ig';
	$PASS_DB = '';

	try {
		// Conecting with the DB
		$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

		// Checking with role the user is
		if (strcmp($role, "remitentes") == 0) {
			$sql = "SELECT nombre, apellidos, email, password FROM remitentes WHERE email LIKE :email AND password LIKE :pass";	
		}
		else {
			$sql = "SELECT nombre, apellidos, email, password FROM transportistas WHERE email LIKE :email AND password LIKE :pass";
		}



		// preparing the query 
		$resultado = $db_subastatuenvio->prepare($sql);


		$resultado->execute(array(':email'=>$email, ':pass'=>$password));

		$numRows = $resultado->rowCount();

		$resultado->closeCursor();

		if ($numRows==1) {
			// there's a user with role which email matches and the password is also correct
			echo true;
		}
		else {
			echo false;
		}

	}
	catch (PDOException $e) {
		die("Error: " .$e);
	}




?>