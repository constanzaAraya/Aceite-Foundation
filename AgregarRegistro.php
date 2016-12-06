<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Agregar Informe</title> 
	<link rel="stylesheet" TYPE="text/css" HREF="estilo/enor.css">
</head>
<body>
<?php
	include 'lib/controles.php';
	
	if (!$_POST)
	{

		if (isset($_GET['id']) && $_GET['id'] != "")
		{
			
			$id = $_GET['id'];
			//print $id;

			//Conexión a la base de datos
			$conexion = mysql_connect ('localhost',$DBUSER, $DBPASS) or die ('No se puede conectar con el servidor');
			mysql_select_db ($DATABASE) or die ('No se puede seleccionar la base de datos');	

			?>

		<h2 align="center">Agregar Nuevo Informe</h2>
		
		<div align="center">
			<?php
			$consulta_motor = mysql_query ('
				SELECT Codigo, idMotor, Marca, Modelo
				FROM tbl_motor
				WHERE idCentral ='.$id, $conexion) or die ('Fallo en la consulta 1');
		
			$nfilas_motor = mysql_num_rows ($consulta_motor);
			
			$consulta_prov = mysql_query ('
				SELECT Nombre,idProveedor
				FROM tbl_proveedor
				', $conexion) or die ('Fallo en la consulta 2');
		
			$nfilas_prov = mysql_num_rows ($consulta_prov);
			
			?>

			<br/><br/>
			<form action="AgregarRegistro.php" method=post>
				<table align="center">
					<tr>
						<th>Informe</th>
						<td>
							 <input type="text" name="Informe" size="30" />
						</td>	
						<th> Proveedor</th>
						<td>
							<select name="Prov">
								<?php
								for ($i=0; $i<$nfilas_prov; $i++)
									{
										$fila_prov = mysql_fetch_array ($consulta_prov);
										echo '<option value="'.$fila_prov["idProveedor"].'">'.$fila_prov["Nombre"].'</option>';
									}
								?>
							</select> 
						</td>
					</tr>
					<tr>
						<th> Motor</th>
						<td>
							<select name="Motor">
								<?php
								for ($i=0; $i<$nfilas_motor; $i++)
									{
										$fila_motor = mysql_fetch_array ($consulta_motor);
										echo '<option value="'.$fila_motor["idMotor"].'">'.$fila_motor["Codigo"].'</option>';
									}
								?>
							</select> 
						</td>
						<th>Producto</th>
						<td>
							 <input type="text" name="Producto" size="30" />
						</td>	
					</tr>
					<tr>
						<th>Horómetro Máquina</th>
						<td>
							 <input type="text" name="Horo1" size="30">
						</td>	
						<th>Horómetro Producto</th>
						<td>
							 <input type="text" name="Horo2" size="30" />
						</td>	
					</tr>
					<tr>
						<th>Fecha Toma de Muestra</th>
						<td>
							 <input type="text" name="Fecha1" size="30" />
						</td>	
						<th>Fecha Entrega de Informe</th>
						<td>
							 <input type="text" name="Fecha2" size="30" />
						</td>	
					</tr>
				</table>
				<br/><br/>

				<input name="agregar" type="submit" onclick="Test();" value="Agregar" />
				<input type="button" value="Volver" onclick="window.location='index.php';" />
			</form>

		</div>
		
		<?php
			//cerrar sesión en BD
			mysql_close ($conexion);
		}
		else{
			//ERROR: ingreso erroneo 
			header("Location: index.php");
			die();
		}
	}
	else{
		//HACER ALGO
		$nombre = $_POST["Informe"];
		$fecha1 = $_POST["Fecha1"];
		$fecha2 = $_POST["Fecha2"];
		$motor = $_POST["Motor"];
		$prod = $_POST["Producto"];
		$prov = $_POST["Prov"];
		$horo1 = $_POST["Horo1"];
		$horo2 = $_POST["Horo2"];
		
		$conexion = mysql_connect ('localhost',$DBUSER, $DBPASS) or die ('No se puede conectar con el servidor');
		mysql_select_db ($DATABASE) or die ('No se puede seleccionar la base de datos');
			
		$consulta = mysql_query ('
			INSERT INTO tbl_analisis (Nombre, Producto, FechaAnalisis, FechaMuestra, idMotor, idProveedor, HorometroMaquina, HorometroProducto) 
			VALUES ("'.$nombre.'","'.$prod.'","'.$fecha2.'","'.$fecha1.'",'.$motor.','.$prov.','.$horo1.','.$horo2.')
			', $conexion) or die ('no se ha podido actualizar su información por favor inténtelo después');
		
		echo '<p align="center">';
		
		if ($consulta ==1){
			echo '<br /><br /><br />Se ha publicado con éxito.<br />';
		}
		else {
			echo '<br /><br /><br />ERROR: no se ha podido publicar.<br />(vuelva a intentarlo nuevamente)<br />';
		}
		
		echo '<br /><input type="button" value="Cerrar"  onclick="window.opener.location.reload(); window.close();"/></p>';
		mysql_close ($conexion);
		
		
		?>
		<div align="center">
			<input type="button" value="Volver" onclick="window.location='index.php';" />
		</div>
		<?php
	}
		
	?>	
</body>
</html>









































