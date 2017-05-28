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
	<meta name="description" content="Subastas | SUBASTATUENVÍO"/>
	<title>Subastas | SUBASTATUENVÍO</title>
	

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
	<section class="main gap-to-20">
		

		<article class="container">

			<div class="row">
				<div class="col-md-4">
					
					<form class="" action="" method="post">
						<div class="form-group">
							<h4>CATEGORÍAS</h4>

							<div class="radio"> 
								<label><input value="Hogar" id="cat" name="cat" type="radio"> Hogar (41)</label>
							</div>

							<div class="radio"> 
								<label><input value="Vehiculos" id="cat" name="cat" type="radio"> Vehículos (42)</label>
							</div>

							<div class="radio"> 
								<label><input value="Carga Parcial" id="cat" name="cat" type="radio"> Carga parcial (75)</label>
							</div>

							<div class="radio"> 
								<label><input value="Carga Completa" id="cat" name="cat" type="radio"> Carga completa (30)</label>
							</div>

							<div class="radio"> 
								<label><input value="Animales" id="cat" name="cat" type="radio"> Animales (19)</label>
							</div>

							<div class="radio"> 
								<label><input value="Industrial" id="cat" name="cat" type="radio"> Industrial y empresarial (14)</label>
							</div>

							<div class="radio"> 
								<label><input value="Alimentacion" id="cat" name="cat" type="radio"> Alimentación (20)</label>
							</div>

							<div class="radio"> 
								<label><input value="Otros" id="cat" name="cat" type="radio"> Otros (0)</label>
							</div>

						</div>

						<div class="form-group">
							
							<h4>ORIGEN</h4>

							<input id="origen" name="origen"type="text" placeholder="Localidad">
							p. ej.: Avilés
						</div>

						<div class="form-group">
							
							<h4>DESTINO</h4>

							<input id="destino" name="destino" type="text" placeholder="Localidad">
							p. ej.: Alicante
						</div>			
						

						<div class="form-group">
							<input class="btn btn-default" type="submit" value="Filtrar">
							<input class="btn btn-default" type="reset" value="Restablecer">
						</div>
					</form>

				</div>
				
				<div class="table-responsive col-md-8">
				  <table class="table table-striped">
					<tr>
						<th>Envío</th>
						<th>Categoría</th>
						<th>Puja Actual</th>
						<th>Origen</th>
						<th>Destino</th>
						<th>Finaliza</th>

					</tr>

					<?php

						// DATA BASE CONNECTION & QUERY

						$CONEXION_DB = 'mysql:host=127.0.0.1; dbname=subastatuenvio';
						$USUARIO_DB = 'ig';
						$PASS_DB = '';


						try {
							// Conecting with the DB
							$db_subastatuenvio = new PDO($CONEXION_DB, $USUARIO_DB, $PASS_DB);

							
							$sql = "SELECT id_subasta, titulo, imagen, categoria, origen, destino, duracion, fecha_creacion FROM subastas WHERE UPPER(categoria) LIKE :cat AND UPPER(origen) LIKE :orig AND UPPER(destino) LIKE :dest ";

							// preparing the query 
							$resultado = $db_subastatuenvio->prepare($sql);

							$cat = '%';
							$orig = '%';
							$dest = '%';



							$resultado->execute(array(':cat' => strtoupper($cat), ':orig' => strtoupper($orig), ':dest' => strtoupper($dest)));

							$numRows = $resultado->rowCount();


							if ($numRows>=1) {
								// at least there is an auction
								while ($registro = $resultado->fetch()) {

									$horas_restantes = $registro['duracion'] - round((getdate()[0] - $registro['fecha_creacion']) / 60 / 60);

									//if ($horas_restantes >= 0) {
									if (true) {

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
										echo "<p>" . $horas_restantes . " h.</p>";
										echo "</td>";

										echo "</tr>";
									}
								}

							}
							else {
								echo "No hay datos";
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
					?>

				  </table>
				</div>
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

	<script src="../js/roles.js"></script>


	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>

</body>

</html>