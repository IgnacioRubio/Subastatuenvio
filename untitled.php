<?php


	// DATA BASE CONNECTION & QUERY

	$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
	$USUARIO_DB = 'ig';
	$PASS_DB = '';

	try {
		// Conecting with the DB
		$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

		
		$sql_remit = "SELECT COUNT(email) FROM remitentes";
		$sql_trans = "SELECT COUNT(email) FROM transportistas";
		$sql_subas = "SELECT COUNT(titulo) FROM subastas";



		// preparing the query 
		$result_remit = $db_subastatuenvio->prepare($sql_remit);
		$result_trans = $db_subastatuenvio->prepare($sql_trans);
		$result_subas = $db_subastatuenvio->prepare($sql_subas);


		$result_remit->execute();
		$result_trans->execute();
		$result_subas->execute();

		$num_remit = $result_remit->fetch()[0];
		$num_trans = $result_trans->fetch()[0];
		$num_subas = $result_subas->fetch()[0];

		echo $num_remit;
		echo "<br>";
		echo $num_trans;
		echo "<br>";
		echo $num_subas;



		// $data = new stdClass();

		// $data->numRemit = mb_convert_encoding($datos['nombre'], 'UTF-8', 'ISO-8859-1');
		// $data->numTrans = mb_convert_encoding($datos['apellidos'], 'UTF-8', 'ISO-8859-1');
		// $data->numSubas =  mb_convert_encoding($datos['direccion'], 'UTF-8', 'ISO-8859-1');
		
		

		// echo json_encode($data);

	}
	catch (PDOException $e) {
		die("Error: " .$e);
	}


?>