<?php

// Creates the new sending

// 1 - get sender's id
// 2 - create date for creation_date
// 3 - rename upload file: id + remi + microtime function


if(count($_COOKIE) > 0) {
    
    if (strcmp(getCookie("role"), "remitentes") == 0) {

    	$email = getCookie("email");
		$titulo = $_POST['titulo'];
		$imagen = uploadImage();
		$medidas = $_POST['medidas'];
		$peso = $_POST['peso'];
		$origen = $_POST['origen'];
		$destino = $_POST['destino'];
		$duracion = $_POST['duracion'];
		$categoria = $_POST['categoria'];
		$descripcion = $_POST['descripcion'];
		$tiempo_creacion = round(microtime(true));

		if (empty($medidas)) {
			$medidas = '-';
		}

		if (empty($peso)) {
			$peso = '-';
		}

		echo $email . " - " . $titulo . " - " . $medidas . " - " . $peso . " - " . $origen . " - " . $destino  . " - " . $duracion . " - " . $categoria . " - " . $descripcion . " - " . $imagen;

		if (!isset($imagen)) {
			die("ERROR: No se ha podido subir la imagen, consulte al administrador del servidor o al sitio web.");
		}

		// create the auction into the db
		// DATA BASE CONNECTION & QUERY

	$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
	$USUARIO_DB = 'ig';
	$PASS_DB = '';

	try {
		// Conecting with the DB
		$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);


		$sql_insert = "INSERT INTO subastas (titulo, imagen, medida, peso, origen, destino, duracion, descripcion, fecha_creacion, categoria, remitente) VALUES (:titulo, :imagen, :medida, :peso, :origen, :destino, :duracion, :descripcion, :fecha_creacion, :categoria, :remitente)";


		$resul_insert = $db_subastatuenvio->prepare($sql_insert);

		$resul_insert->execute(array(":titulo"=> $titulo, ":imagen"=>$imagen, ":medida"=>$medidas, ":peso"=>$peso, ":origen"=>$origen, ":destino"=>$destino, ":duracion"=>$duracion, ":descripcion"=>$descripcion, ":fecha_creacion"=>$tiempo_creacion, ":categoria"=>$categoria, ":remitente"=>$email));

		header("Location: http://localhost/subastatuenvio/");
		die();

	}
	catch (PDOException $e) {
		die("Error: " .$e);
	}

    }
    else {
    	echo "You shouldn't be here. You are not a sender.";
    }
} 
else {
    echo "You shouldn't be here. You are not a sender.";
}





// FUNCTIONS SUPPORTERS

function getCookie ($cookie_name) {

	if(!isset($_COOKIE[$cookie_name])) {
		return null;
	} 
	else {
	    return $_COOKIE[$cookie_name];
	}
}


function uploadImage () {

	$TARGET_DIR = "../images/subastas/";

	$tempnewname = explode(".", $_FILES["imagen"]["name"]);
	$newfilename = round(microtime(true)) . '.' . end($tempnewname);

	$TARGET_FILE = $TARGET_DIR . $newfilename;
	$imageFileType = pathinfo($TARGET_FILE,PATHINFO_EXTENSION);


	// uploads the image into $TARGET_DIR
	if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $TARGET_FILE)) {
		return "images/subastas/" . $newfilename;
	}
	else {
		return null;
	}

}



?>