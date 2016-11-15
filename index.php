<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Reporte de Aceite</title> 

	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<!--<link type="text/css" rel="stylesheet" HREF="css/enor.css">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>


</head>
<body class="indigo lighten-5">
	<?php
		//Conexi�n a la base de datos
		include 'lib/controles.php';
		//$conexion = mysql_connect ('localhost',$DBUSER, $DBPASS) or die ('No se puede conectar con el servidor');
		//mysql_select_db ($DATABASE) or die ('No se puede seleccionar la base de datos');	
		$mysqli = new mysqli('localhost',$DBUSER, $DBPASS, $DATABASE);
		if ($mysqli -> connect_errno) {	die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno() . ") " . $mysqli -> mysqli_connect_error()); }
		//else echo "Conexión exitosa!";
		//$mysqli -> mysqli_close();

		/*$consultaCentrales = mysql_query ('
					SELECT idCentral, Descripcion
					FROM tbl_central
					', $conexion) or die ('Fallo en la consulta');
			
		$nfilasCentral = mysql_num_rows ($consultaCentrales);*/
		/**/if ($mysqli->query("
					SELECT idCentral, Descripcion
					FROM tbl_central
					") == TRUE) { printf(//$mysqli->affected_rows." Filas afectadas"); 
					//$nfilasCentral = $mysqli->affected_rows;
					}
		else echo "Error al ejecutar el comando:".$mysqli->error;
        
	?>

	<div class="container blue lighten-5">
		<div class="row">
			<div class="col s12">
				<h3 align="center">INFORMES ANÁLISIS DE ACEITE</h3>
			</div>
		</div>
		
		<div class="row">
			<div class="col s12">
				<p align="center">
					<a class="waves-effect waves-light btn btnOpcion" href="#modal1" id="AgregarRegistro"><i class="material-icons right">assignment</i>Nuevo Informe</a>
					<a class="waves-effect waves-light btn btnOpcion" href="#modal1" id="VerHistorial"><i class="material-icons right">assessment</i>Ver Historial</a>
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col s10 push-s1 blue lighten-4">
				<table class="centered striped">
				  <thead>
					<tr>
						<th>Fecha de Informe</th>
						<th>Código de Informe</th>
						<th>Producto</th>
						<th>M�quina</th>
						<th>Hor�metro</th>
						<th>Proveedor</th>
						<th></th>
					</tr>
				  </thead>
				  <tbody>
					<?php
						$consulta = mysql_query ('
							SELECT tbl_analisis.idAnalisis as Id, tbl_analisis.Nombre as Nombre, tbl_analisis.Producto as Prod, DATE_FORMAT(tbl_analisis.FechaAnalisis,"%d-%m-%Y") as Fecha, tbl_motor.Codigo as Motor, tbl_proveedor.Nombre as Proveedor, tbl_analisis.HorometroMaquina as HorometroMaquina
							FROM tbl_analisis, tbl_motor, tbl_proveedor 
							WHERE tbl_analisis.idMotor = tbl_motor.idMotor AND tbl_analisis.idProveedor = tbl_proveedor.idProveedor
							ORDER BY tbl_analisis.FechaAnalisis DESC', $conexion) or die ('Fallo en la consulta');
					
						$nfilas = mysql_num_rows ($consulta); 
						for ($i=0; $i<$nfilas; $i++)
						{
							$fila = mysql_fetch_array ($consulta);
							?>
							<tr>
								<td>
									<?php
										echo $fila['Fecha'];
									?>						</td>
								<td>
									<?php
										echo $fila['Nombre'];
									?>						</td>
								<td>
									<?php
										echo $fila['Prod'];
									?>						</td>
								<td>
									<?php
										echo $fila['Motor'];
									?>						</td>
								<td>
									<?php
										echo number_format($fila["HorometroMaquina"],0,'','.');
									?>	hrs.					</td>
								<td>
									<?php
										echo $fila['Proveedor'];
									?>						</td>
								
								<td>
									<div class="btnVer" id="<?php print $fila['Id'];?>"><i class="small material-icons">description</i></div>
								</td>
							</tr>
						<?php } ?>
				  </tbody>
				</table>
				<br />
			</div>
		</div>
		<div class="row">
			<div class="col s12">
			</div>
		</div>
	</div>
	
	<div id="modal1" class="modal">
		<div class="modal-content">
			<ul class="collection with-header">
				<li class="collection-header"><h5>Seleccione una Central</h5></li>
				<?php
					for ($i=0; $i<$nfilasCentral; $i++){
						$filaCentral = mysql_fetch_array ($consultaCentrales);
						echo '<li class="collection-item"><div class="selOpcion" id="'.$filaCentral["idCentral"].'">'.strtoupper($filaCentral["Descripcion"]).'<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div></li>';
					}				
				?>
			</ul>
		</div>
	</div>	
	
	<?php
		//cerrar sesi�n en BD
		mysql_close ($conexion);
	?>	
	

	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="js/materialize.min.js"></script>	
	
	<script type="text/javascript">

		var pagina;
		var central;

		$(document).ready(function(){
			
			$('.btnOpcion').click(function(){
				$pagina = $(this).attr('id');
				//alert($pagina);
				$('#modal1').openModal();
			});
			
			$('.selOpcion').click(function(){
				$central = $(this).attr('id');
				//alert($central);
				$('#modal1').closeModal();
				window.location=$pagina+".php?id="+$central;
			});

			$('.btnVer').click(function(){
				//alert($(this).attr('id'));
				window.location="VerAnalisis.php?id="+$(this).attr('id');
			});
			
		});
	</script>

	
</body>
</html>













































