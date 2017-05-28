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
	<meta name="description" content="Perfil | SUBASTATUENVÍO"/>
	<title>Perfil | SUBASTATUENVÍO</title>
	

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
						<li class="active"><a href="../index.html">INICIO</a></li>
						<li><a href="../html/como_funciona.html">CÓMO FUNCIONA</a></li>
						<li><a href="subastas.php">SUBASTAS</a></li>
						<li><a href="../html/contacto.html">CONTACTO</a></li>
						<li id="liMenuIniciar"><a href="../html/iniciar_sesion.html">INICIAR SESIÓN</a></li>
						<li id="liMenuRegistro"><a href="../html/registrarse.html">REGISTRO</a></li>
						<li id="liMenuEnviar"><a href="../html/enviar.html">ENVIAR</a></li>
						<li class="active" id="liMenuPerfil"><a href="perfil.php">TU PERFIL</a></li>
					</ul>

				</div>


			</div>
		</nav>
				
	</header>

	<!-- CUERPO -->
	<section class="main container">

		<h2>TU PERFIL</h2>

		<article class="container">
			<?php

				// DATA BASE CONNECTION & QUERY
				if(count($_COOKIE) > 0) {
    
    				if (strcmp(getCookie("role"), "remitentes") == 0) {

    					echo "<h3>Tus Subastas</h3>";

						echo '<div class="table-responsive col-md-8">';
						echo '<table class="table table-striped">';
						echo '<tr>';
						echo '<th>Envío</th>';
						echo '<th>Categoría</th>';
						echo '<th>Puja Actual</th>';
						echo '<th>Origen</th>';
						echo '<th>Destino</th>';
						echo '<th>Finaliza</th>';
						echo '</tr>';


						$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
						$USUARIO_DB = 'ig';
						$PASS_DB = '';


						try {
							// Conecting with the DB
							$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

							
							$sql = "SELECT id_subasta, titulo, imagen, categoria, origen, destino, duracion, fecha_creacion FROM subastas WHERE remitente LIKE :email";

							// preparing the query 
							$resultado = $db_subastatuenvio->prepare($sql);

							$resultado->execute(array(':email' => getCookie("email")));

							$numRows = $resultado->rowCount();


							if ($numRows>=1) {
								// at least there is an auction
								while ($registro = $resultado->fetch()) {

									$horas_restantes = $registro['duracion'] - round((getdate()[0] - $registro['fecha_creacion']) / 60 / 60) . " h.";

									if ($horas_restantes < 0) {
										$horas_restantes = "Finalizada";
									}

									echo "<tr>";

									// TITTLE + IMAGE
									echo "<td>";
									echo '<form action="subasta.php" method="post">';
									echo '<input type="text" id="id_subasta" name="id_subasta" value="' . $registro['id_subasta'] . '" hidden>';
									echo '<input class="btn btn-link" type="submit" value="' . $registro['titulo'] . '">';
									echo '</form>';
									echo '<img class="img-80x80" src="../' . $registro['imagen'] . '" alt="imagen">';
									echo "</td>";

									// CATEGORY
									echo '<td>';
									echo "<p>". $registro['categoria'] ."</p>";
									echo '</td>';

									// BID
									echo "<td>";
									echo "<p>" . getCurrentBid($registro['id_subasta']) . "</p>";
									echo "</td>";

									// FROM
									echo "<td>";
									echo "<p>" . $registro['origen'] . "</p>";
									echo "</td>";

									// TO
									echo "<td>";
									echo "<p>" . $registro['destino'] . "</p>";
									echo "</td>";

									// REAMING TIME
									echo "<td>";
									echo "<p>" . $horas_restantes . "</p>";
									echo "</td>";

									echo "</tr>";
								
								}
							}
							echo "</table>";
							echo "</div>";
						}

						catch (PDOException $e) {
							die("Error: " .$e);
						}

					}

					if (strcmp(getCookie("role"), "transportistas") == 0) {
						echo "<h3>Tus Pujas</h3>";

						echo '<div class="table-responsive col-md-8">';
						echo '<table class="table table-striped">';
						echo '<tr>';
						echo '<th>Envío</th>';
						echo '<th>Puja</th>';
						echo '<th>Origen</th>';
						echo '<th>Destino</th>';
						echo '<th>Finaliza</th>';
						echo '</tr>';


						$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
						$USUARIO_DB = 'ig';
						$PASS_DB = '';


						try {
							// Conecting with the DB
							$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

							
							$sql = "SELECT subastas.id_subasta, imagen, titulo, origen, destino, duracion, fecha_creacion, puja FROM subastas INNER JOIN pujas ON subastas.id_subasta = pujas.subasta WHERE pujas.transportista LIKE :email";

							// preparing the query 
							$resultado = $db_subastatuenvio->prepare($sql);

							$resultado->execute(array(':email' => getCookie("email")));

							$numRows = $resultado->rowCount();


							if ($numRows>=1) {
								// at least there is an auction
								while ($registro = $resultado->fetch()) {

									$horas_restantes = $registro['duracion'] - round((getdate()[0] - $registro['fecha_creacion']) / 60 / 60) . " h.";

									if ($horas_restantes < 0) {
										$horas_restantes = "Finalizada";
									}

									echo "<tr>";

									// TITTLE + IMAGE
									echo "<td>";
									echo '<form action="subasta.php" method="post">';
									echo '<input type="text" id="id_subasta" name="id_subasta" value="' . $registro['id_subasta'] . '" hidden>';
									echo '<input class="btn btn-link" type="submit" value="' . $registro['titulo'] . '">';
									echo '</form>';
									echo '<img class="img-80x80" src="../' . $registro['imagen'] . '" alt="imagen">';
									echo "</td>";


									// BID
									echo "<td>";
									echo "<p>" . $registro['puja'] . "</p>";
									echo "</td>";

									// FROM
									echo "<td>";
									echo "<p>" . $registro['origen'] . "</p>";
									echo "</td>";

									// TO
									echo "<td>";
									echo "<p>" . $registro['destino'] . "</p>";
									echo "</td>";

									// REAMING TIME
									echo "<td>";
									echo "<p>" . $horas_restantes . "</p>";
									echo "</td>";

									echo "</tr>";
								
								}
							}
							echo "</table>";
							echo "</div>";
						}

						catch (PDOException $e) {
							die("Error: " .$e);
						}

					}


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
		?>

		</article>

		<article class="container">
			<button class="btn btn-default" id="btnSalir">CERRAR SESIÓN</button>
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

		
	<script src="../js/roles.js"></script>
	<script src="../js/perfil.js"></script>

	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>

</html>
