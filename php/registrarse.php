<?php

	$nombre = $_POST["nombre"];
	$apellidos = $_POST["apellidos"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$role = $_POST["role"];

	// echo $nombre . $apellidos . $email . $password . $role;


	// DATA BASE CONNECTION & QUERY

	$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
	$USUARIO_DB = 'ig';
	$PASS_DB = '';

	try {
		// Conecting with the DB
		$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

		// Checking with role the user is
		if (strcmp($role, "remitentes") == 0) {
			$sql_query = "SELECT email, password FROM remitentes WHERE email LIKE :email";	
			$sql_insert = "INSERT INTO remitentes (nombre, apellidos, email, password) VALUES (:nombre, :apellidos, :email, :password)";
		}
		else {
			$sql_query = "SELECT email, password FROM transportistas WHERE email LIKE :email";
			$sql_insert = "INSERT INTO transportistas (nombre, apellidos, email, password) VALUES (:nombre, :apellidos, :email, :password)";
		}



		// preparing the query 
		$resultado = $db_subastatuenvio->prepare($sql_query);


		$resultado->execute(array(':email'=>$email));

		$numRows = $resultado->rowCount();

		$resultado->closeCursor();

		if ($numRows == 1) {
			// there's a user that already exists
			echo false;
		}
		else {
			$resul_insert = $db_subastatuenvio->prepare($sql_insert);

			$resul_insert->execute(array(':nombre'=>$nombre, ':apellidos'=>$apellidos, ':email'=>$email, ':password'=>$password));

			echo true;
		}

	}
	catch (PDOException $e) {
		die("Error: " .$e);
	}

?>