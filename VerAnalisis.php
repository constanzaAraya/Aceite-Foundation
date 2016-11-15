<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Resultado Análisis de Aceite</title>

	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
	<!--<link type="text/css" rel="stylesheet" HREF="css/enor.css">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body class="indigo lighten-5">
	<div class="container blue lighten-5">

	<?php
		//Conexión a la base de datos dewsde el comienzo
		include 'lib/controles.php';
		$conexion = mysql_connect ('localhost',$DBUSER, $DBPASS) or die ('No se puede conectar con el servidor');
		mysql_select_db ($DATABASE) or die ('No se puede seleccionar la base de datos');


		//si se completa el formulario del modal y se reenvía la página se agregan los datos
		if ($_POST) 
		{
			$Item = $_POST["Item"];
			$Valor = $_POST["Valor"];
			$Analisis = $_POST["Analisis"];
			
			//echo $Item." - ".$Valor." - ".$Analisis;
			
			$consultaInsert = mysql_query ("
						INSERT INTO tbl_itemsanalisis (idAnalisis, idItem, Valor) 
						VALUES (".$Analisis.", ".$Item.", ".$Valor.")", $conexion);
		}

		//siempre se carga la página
		if (isset($_GET['id']) && $_GET['id'] != "")
		{
			$id = $_GET['id'];
			//print $id;

			$consulta = mysql_query ('
					SELECT tbl_analisis.Nombre as Nombre, tbl_analisis.Producto as Prod, DATE_FORMAT(tbl_analisis.FechaAnalisis,"%d-%m-%Y") as Fecha1, DATE_FORMAT(tbl_analisis.FechaMuestra,"%d-%m-%Y") as Fecha2, tbl_motor.Codigo as Motor, tbl_motor.Marca as Marca, tbl_motor.Modelo as Modelo, tbl_proveedor.Nombre as Proveedor,	tbl_analisis.HorometroMaquina as Horometro1, tbl_analisis.HorometroProducto as Horometro2, tbl_central.Descripcion as Central, tbl_central.Ubicacion as Lugar 
					FROM tbl_analisis, tbl_motor, tbl_proveedor, tbl_central 
					WHERE tbl_analisis.idMotor = tbl_motor.idMotor AND tbl_analisis.idProveedor = tbl_proveedor.idProveedor AND tbl_motor.idCentral = tbl_central.idCentral AND  tbl_analisis.IdAnalisis='.$id, $conexion) or die ('Fallo en la consulta 1');
			$fila = mysql_fetch_array ($consulta);
			?>

			<div class="row">
				<div class="col s12">
					<h3 align="center">Análisis de Aceite</h3>

					<h5 align="center">Detalle Informe <strong><?php echo $fila["Nombre"] ?></strong><br/>
					<?php 
						echo "Realizado por <em><strong>".$fila["Proveedor"]."</strong></em> el ".$fila["Fecha1"]; 
						//echo "Realizado por ".$fila["Proveedor"]." el ".date('d-m-Y',$fila["Fecha1"]); 
					?></h5>
				</div>
			</div>
				
			<div class="row">
				<div class="col s5 push-s1 blue lighten-4">
					<br />
					<table class="striped centered responsive-table espaciado">
						<tr>
							<th>Motor</th>
							<td><strong><?php echo $fila["Motor"]; ?></strong></td>
						</tr>
						<tr>
							<th>Marca / Modelo</th>
							<td><?php echo $fila["Marca"].' / '.$fila["Modelo"];?></td>
						</tr>
						<tr>
							<th>Central</th>
							<td><?php echo $fila["Central"]." / ".$fila["Lugar"]; ?></td>
						</tr>
						<tr>
							<th>Horómetro Motor</th>
							<td><?php echo number_format($fila["Horometro1"],0,'','.'); ?> hrs.</td>
						</tr>
						<tr>
							<th>Producto</th>
							<td><?php echo $fila["Prod"]; ?></td>
						</tr>
						<tr>
							<th>Horómetro Producto</th>
							<td><?php echo $fila["Horometro2"]; ?> hrs.</td>
						</tr>
						<tr>
							<th>Fecha Muestra</th>
							<td><?php echo $fila["Fecha2"]; ?></td>
						</tr>
					</table>
					<br />
					<p align="center">
						<a class="waves-effect waves-light btn" href="index.php"><i class="material-icons left">skip_previous</i>Volver</a>
						<a class="waves-effect waves-light btn" href="#" id="agregarDato"><i class="material-icons right">input</i>Agregar Datos</a>
						
					</p>				</div>
				
				<div class="col s3 push-s2 blue lighten-4">
					<br />
					<table class="striped centered">
						<?php
							$consulta2 = mysql_query ('
								SELECT tbl_item.Descripcion as Item, tbl_itemsanalisis.Valor as Valor
								FROM tbl_itemsanalisis, tbl_item, tbl_analisis
								WHERE tbl_itemsanalisis.idAnalisis = tbl_analisis.idAnalisis AND tbl_item.idItem = tbl_itemsanalisis.idItem AND tbl_analisis.IdAnalisis='.$id.'
								ORDER BY Item
								', $conexion) or die ('Fallo en la consulta 2');
							$nfilas2 = mysql_num_rows ($consulta2);

							for ($i=0; $i<$nfilas2; $i++)
							{
								$fila2 = mysql_fetch_array ($consulta2);
						?>
						
							<tr>
								<th><?php echo $fila2["Item"]; ?></th>
								<td>
								<?php 
									$valor = number_format($fila2["Valor"],2,",",'.');
									$valor = (substr($valor, -3)!=",00")?$valor:substr($valor, 0,-3);
									echo ($valor=="")?'0':$valor; 
									?></td>
							</tr>
							
						<?php } ?>		
					</table>
					<br />
				</div>
			</div>
			<br />

		<?php 
		}
		else
			echo '<div class="row"><div class="col s12"><h3>ERROR: INGRESO INCORRECTO</h3></div></div>';
		

		//cerrar sesión en BD
		mysql_close ($conexion);	
	?>
	
	</div>
	
	
	<div id="modal1" class="modal">
		<div class="modal-content">
		</div>
	</div>		
	
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="js/materialize.min.js"></script>
	
	<script language="javascript">
	$(document).ready(function(){
			
			$('#agregarDato').click(function(){
				//alert("hola");
				//my_window = window.open("AgregarDato.php?id1=<?php echo $id;?>", "AgregarDatos", "width=500, height=220, scrollbars=yes, top=80, left=80, resizable=yes, toolbar=no, location=yes, directories=yes, status=yes");
				$('#modal1').openModal();
				$('.modal-content').load('AgregarDato.php?id1=<?php echo $id;?>');					
				return false;
			});

		});
	
	</script>	
	
</body>
</html>
