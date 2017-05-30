<?php


	// DATA BASE CONNECTION & QUERY

	$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
	$USUARIO_DB = 'ig';
	$PASS_DB = '';

	try {
		// Conecting with the DB
		$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);


		$sql_subas = "SELECT COUNT(titulo) FROM subastas WHERE categoria LIKE :cat AND (duracion - (:now - fecha_creacion)/60/60) >= 0";

		$arr_categorias = array("Hogar", "Vehiculos", "Carga Parcial", "Carga Completa", "Animales", "Industrial", "Alimentacion", "Otros");

		// preparing the query 
		$result_subas = $db_subastatuenvio->prepare($sql_subas);

		$now = getdate()[0];

		$data = new stdClass();


		$result_subas->execute(array(":cat" =>$arr_categorias[0], ":now" => $now));
		$data->numHogar = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[1], ":now" => $now));
		$data->numVehiculos = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[2], ":now" => $now));
		$data->numParcial = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[3], ":now" => $now));
		$data->numCompleta = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[4], ":now" => $now));
		$data->numAnimales = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[5], ":now" => $now));
		$data->numIndustrial = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[6], ":now" => $now));
		$data->numAlimentacion = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[7], ":now" => $now));
		$data->numOtros = $result_subas->fetch()[0];



		
		echo json_encode($data);

	}
	catch (PDOException $e) {
		die("Error: " .$e);
	}


?>