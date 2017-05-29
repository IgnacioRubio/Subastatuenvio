<?php


	// DATA BASE CONNECTION & QUERY

	$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
	$USUARIO_DB = 'ig';
	$PASS_DB = '';

	try {
		// Conecting with the DB
		$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

		
		$sql_subas = "SELECT COUNT(titulo) FROM subastas WHERE categoria LIKE :cat";

		$arr_categorias = array("Hogar", "Vehiculos", "Carga Parcial", "Carga Completa", "Animales", "Industrial", "Alimentacion", "Otros");

		// preparing the query 
		$result_subas = $db_subastatuenvio->prepare($sql_subas);


		$data = new stdClass();


		$result_subas->execute(array(":cat" =>$arr_categorias[0]));
		$data->numHogar = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[1]));
		$data->numVehiculos = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[2]));
		$data->numParcial = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[3]));
		$data->numCompleta = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[4]));
		$data->numAnimales = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[5]));
		$data->numIndustrial = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[6]));
		$data->numAlimentacion = $result_subas->fetch()[0];

		$result_subas->execute(array(":cat" =>$arr_categorias[7]));
		$data->numOtros = $result_subas->fetch()[0];



		
		echo json_encode($data);

	}
	catch (PDOException $e) {
		die("Error: " .$e);
	}


?>