<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Agrega Datos</title>

	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
	<!--<link type="text/css" rel="stylesheet" HREF="css/enor.css">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
</head>

<body class="indigo lighten-5">

<?php 
if (!$_POST) {
	if (isset($_GET['id1']) && $_GET['id1'] != "")  {
		$idAnalisis = $_GET['id1'];

		//Conexión a la base de datos
		include 'lib/controles.php';
		$conexion = mysql_connect ('localhost',$DBUSER, $DBPASS) or die ('No se puede conectar con el servidor');
		mysql_select_db ($DATABASE) or die ('No se puede seleccionar la base de datos');
		
		$consulta = mysql_query ("
			SELECT idItem, Descripcion
			FROM tbl_item
			WHERE idItem NOT IN 
				(SELECT idItem FROM tbl_itemsanalisis WHERE idAnalisis = ".$idAnalisis.")
			ORDER BY Descripcion ASC
		", $conexion) or die ('Fallo en la consulta de control');
		$nfilas = mysql_num_rows ($consulta);
		
		?>
		<div class="row">
			<form class="col s12" action="VerAnalisis.php?id=<?php echo $idAnalisis;?>" method=post>
			<!--<form class="col s12">-->
				<div class="row">
					<div class="col s12">
						<h5 align="center">Seleccione una variable de medición y complete el valor respectivo</h5>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s3 push-s4">
						<select name="Item">
							<option value="" disabled selected>Variable</option>
							<?php
							for ($i=0; $i<$nfilas; $i++)
								{
									$fila = mysql_fetch_array ($consulta);
									echo '<option value="'.$fila["idItem"].'">'.$fila["Descripcion"].'</option>';
								}
							?>
						</select>
						<label>Variable</label>
					</div>
					<div class="input-field col s1 push-s4">
						<input name="Valor" id="valor" type="text" class="validate">
						<label for="valor">Valor</label>
					</div>
				</div>
				<div class="row">
					<div class="col s12">				
						<input type="hidden" name="Analisis" value="<?php echo $idAnalisis;?>" /> 
						<button class="btn waves-effect waves-light" type="submit" name="action">Agregar<i class="material-icons right">send</i>
  </button>
					</div>
				</div>
			</form>	
		</div>
		

<?php		
		mysql_close ($conexion);
	}
	else {
	  echo '<p><em><strong>ERROR: </strong>Esta sección ha sido accesada incorrectamente.</em></p>';
    }
} ?> 

	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="js/materialize.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
		});
		function Confirmar() {
			return confirm("¿Está seguro?")
		}
	</script>
	
	
	</body>
</html>