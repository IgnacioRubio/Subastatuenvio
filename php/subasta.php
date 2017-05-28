<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">
	<meta name="keywords" content="HTML, CSS, JAVA, PHP"/>
	<meta name="author" content="Ignacio Rubio"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico"/>
	<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/support.css">
	<meta name="description" content="Subasta | SUBASTATUENVÍO"/>
	<title>Subasta | SUBASTATUENVÍO</title>

</head>


<body>

	<!-- CABECERA -->
	<header>
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-ig">
						<span class="sr-only">Desplegar / Ocultar Menú</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="../index.html" class="navbar-brand"><img src="../images/logo1.png" alt="Logo SUBASTATUENVIO"></a>
				</div>
				<!-- menu -->
				<div class="collapse navbar-collapse" id="navegacion-ig">
					<ul class="nav navbar-nav">
						<li><a href="../index.html">INICIO</a></li>
						<li><a href="../html/como_funciona.html">CÓMO FUNCIONA</a></li>
						<li class="active"><a href="subastas.php">SUBASTAS</a></li>
						<li><a href="../html/contacto.html">CONTACTO</a></li>
						<li id="liMenuIniciar"><a href="../html/iniciar_sesion.html">INICIAR SESIÓN</a></li>
						<li id="liMenuRegistro"><a href="../html/registrarse.html">REGISTRO</a></li>
						<li id="liMenuEnviar"><a href="../html/enviar.html">ENVIAR</a></li>
						<li id="liMenuPerfil"><a href="perfil.php">TU PERFIL</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
	</header>

	<!-- CUERPO -->
	<section class="main">

		<header class="container">

			<h4 class="gap-to-40 border-bottom01 padd-bo-10">INFORMACIÓN DEL ENVÍO</h4>
		</header>
		
		<article class="container">


			<?php

				// DATA BASE CONNECTION & QUERY
				$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
				$USUARIO_DB = 'ig';
				$PASS_DB = '';

				try {
					// Conecting with the DB
					$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

							
					$sql = "SELECT titulo, imagen, origen, destino, duracion, descripcion, medida, peso, fecha_creacion FROM subastas WHERE id_subasta LIKE :id_subasta";

					// preparing the query 
					$resultado = $db_subastatuenvio->prepare($sql);

					$id_subasta = $_POST['id_subasta'];


					$resultado->execute(array(":id_subasta"=>$id_subasta));

					$numRows = $resultado->rowCount();


					if ($numRows>=1) {
						// at least there is an auction
						while ($registro = $resultado->fetch()) {

							echo "<div>";
							echo "<h5>TÍTULO:</h5>";
							echo "<p>" . $registro['titulo'] . "</p>";
							echo "</div>";

							echo "<div>";
							echo "<h5>DESCRIPCIÓN:</h5>";
							echo "<p>" . $registro['descripcion'] . "</p>";
							echo "</div>";


							echo "<div>";
							echo "<h5>MEDIDAS:</h5>";
							echo "<p>" . $registro['medida'] . "</p>";
							echo "</div>";


							echo "<div>";
							echo "<h5>PESO:</h5>";
							echo "<p>" . $registro['peso'] . "</p>";
							echo "</div>";


							echo "<div>";
							echo "<h5>PUJA ACTUAL:</h5>";
							echo "<p>" . getCurrentBid($id_subasta) . "</p>";
							echo "</div>";

							echo "<div>";
							echo "<h5>NÚMERO DE PUJAS:</h5>";
							echo "<p>" . countAuction($id_subasta) . "</p>";
							echo "</div>";

							echo "<div>";
							echo "<h5>ORIGEN:</h5>";
							echo "<p>" . $registro['origen'] . "</p>";
							echo "</div>";

							echo "<div>";
							echo "<h5>DESTINO:</h5>";
							echo "<p>" . $registro['destino'] . "</p>";
							echo "</div>";

							echo '<div class="list-group gallery">';
							echo "<h5>IMAGEN:</h5>";
							echo '<div class="col-sm-4 col-xs-6 col-md-3 col-lg-3">';
							echo '<a class="thumbnail" rel="" href="../'. $registro['imagen'] .'">';
							echo '<img class="img-responsive" alt="" src="../'. $registro['imagen'] .'"/>';
							echo '</a>';
							echo "</div>";
							echo "</div>";
						}
					}			
				}

				catch (PDOException $e) {
					die("Error: " .$e);
				}


				function getCurrentBid ($id_auction) {
					$current_bid = 'Ninguna';

					$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
					$USUARIO_DB = 'ig';
					$PASS_DB = '';


					try {
						// Conecting with the DB
						$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

						$sql1 = "SELECT MAX(puja) FROM pujas WHERE subasta = :subasta";

						$result = $db_subastatuenvio->prepare($sql1);

						$result->execute(array(":subasta" => $id_auction));

						$numRows = $result->rowCount();

						if ($numRows > 0) {
							$current_bid = $result->fetch()[0];
						}
						return $current_bid . " €";
					}
					catch (PDOException $e) {
						die("Error: " .$e);
					}

				}

				function countAuction ($id_auction) {
					$number_bids = '0';

					$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
					$USUARIO_DB = 'ig';
					$PASS_DB = '';


					try {
						// Conecting with the DB
						$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

						$sql1 = "SELECT COUNT(subasta) FROM pujas WHERE subasta = :subasta";

						$result = $db_subastatuenvio->prepare($sql1);

						$result->execute(array(":subasta" => $id_auction));

						$numRows = $result->rowCount();

						if ($numRows > 0) {
							$number_bids = $result->fetch()[0];
						}

						return $number_bids;
					}
					catch (PDOException $e) {
						die("Error: " .$e);
					}

				}
			?>

			<?php

			try {
				// Conecting with the DB
				$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

							
					$sql = "SELECT puja, transportista FROM pujas WHERE subasta = :id_subasta ORDER BY puja ASC";

					// preparing the query 
					$resultado = $db_subastatuenvio->prepare($sql);

					$id_subasta = $_POST['id_subasta'];


					$resultado->execute(array(":id_subasta"=>$id_subasta));

					$numRows = $resultado->rowCount();
					
					echo '<div class="table-responsive col-md-8">';
					echo '<h5>PUJAS:</h5>';
					echo '<table class="table table-striped">';

					echo '<tr>';
					echo '<th>Transportista</th>';
					echo '<th>Puja</th>';
					echo '</tr>';

					if ($numRows>=1) {
						// at least there is a bid
						while ($registro = $resultado->fetch()) {

							echo '<tr>';
							echo '<td>' .$registro['transportista']. '</td>';
							echo '<td>' .$registro['puja']. ' €</td>';
							echo '</tr>';
						}
					}

					echo '</table>';
					echo '</div>';
				
				}

				catch (PDOException $e) {
					die("Error: " .$e);
				}

			?>
			

			<!-- ROLE TRANSPORTISTA -->
			<div>

				<p id="pMess" class="bg-warning padding-15 gap-to-40" hidden></p>
				<p id="pMessSucc" class="bg-success padding-15 gap-to-40" hidden></p>
			</div>

			<div id="divBid" class="col-sm-12">
				<?php

					// DATA BASE CONNECTION & QUERY
					$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
					$USUARIO_DB = 'ig';
					$PASS_DB = '';

					try {
						// Conecting with the DB
						$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

								
						$sql = "SELECT duracion, fecha_creacion FROM subastas WHERE id_subasta LIKE :id_subasta";

						// preparing the query 
						$resultado = $db_subastatuenvio->prepare($sql);

						$id_subasta = $_POST['id_subasta'];


						$resultado->execute(array(":id_subasta"=>$id_subasta));

						$registro = $resultado->fetch();

						$horas_restantes = $registro['duracion'] - round((getdate()[0] - $registro['fecha_creacion']) / 60 / 60);

						if ($horas_restantes >= 0) {

							echo "<form id='form_puja' action='crear_puja.php' method='post'>";
							echo '<div class="form-group"> <label>Puja: <input type="number" placeholder="*Puja en euros" class="form-control" id="puja" name="puja" min="0" step="0.01" required></label> </div>';
							echo '<input type="text" id="id_subasta" name="id_subasta" value="' . $id_subasta . '" hidden>';
							echo "<input class='btn btn-default' type='submit' value='PUJAR'>";
							echo "</form>";


						}

						else {
							echo '<p class="bg-danger padding-15 gap-to-40">Subasta finalizada, ya no se pueden hacer más pujas.</p>';
						}

				
					}

					catch (PDOException $e) {
						die("Error: " .$e);
					}

				?>
			</div>

		</article>

	</section>


	
		

	<!-- PIE DE PAGINA -->
	<footer class="">
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<ul class="list-inline text-right">
						<li><a href="../index.html">INICIO</a></li>
						<li><a href="../html/como_funciona.html">CÓMO FUNCIONA</a></li>
						<li><a href="../html/subastas.html">SUBASTAS</a></li>
						<li><a href="../html/contacto.html">CONTACTO</a></li>
					</ul>
				</div>
				<div class="col-xs-6">
					<span>CopyRight © 2017, Ignacio Rubio. Todos los derechos reservados.</span>
				</div>
			</div>
		</div>
	</footer>

	<script src="../js/crear_puja.js"></script>
	<script src="../js/roles.js"></script>
	<script src="../js/roles_subasta.js"></script>

	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>

</html>

