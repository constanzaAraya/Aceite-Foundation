
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Historial Análisis de Aceite</title>
	<link rel="stylesheet" TYPE="text/css" HREF="estilo/enor.css">
	<script type="text/javascript" src="lib/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		var idCentral;
		document.cookie = "CidMotor=0";
		document.cookie = "Cparametros='()'";
		
		$(document).ready(function() {
			$('.unselected').click(function(){
				//des-selecciona div que está selccionado
				$('.selected').each(function(){
					$(this).addClass('unselected').removeClass('selected');
				});
				
				//guarda valor de Motor seleccionado en cookie
				document.cookie = "CidMotor="+$(this).attr('id');;

				 //selecciona el div en que se hizo click
				$(this).addClass('selected').removeClass('unselected');

				// muestra el div de contenido
				$('#contenido').removeClass('hide');

				//refresh div de gráficos para que se desaparezca
				document.cookie = "Cgraficar=0";
				$('#grafico').load('VerHistorial.php?id='+($idCentral)+' #grafico');
				
				//refresh div de parámetros
				$('#lista_parametros').load('VerHistorial.php?id='+($idCentral)+' #lista_parametros');
				$('#grafico1').addClass('hide');
			});
				
			
		});
		
		function Graficar() {
			var lista_parametros="(";
			var contador=0;
			//alert(contador);
			$('.checkbox').each(function(){
				if ($(this).is(':checked')){
					contador++;
					lista_parametros+=$(this).val()+',';
					//alert($(this).val());
				}
			});
			if (contador>0){
				lista_parametros=lista_parametros.substring(0,lista_parametros.length-1)+')';
				document.cookie = "Cparametros="+lista_parametros;
				
				$('#grafico1').removeClass('hide');
				$('#if1').attr('src', "VerHistorial2.php");
				
				//$('#grafico1').load('VerHistorial.php?id='+($idCentral)+' #grafico2');
				
			} else {
				alert("debe seleccional al menos un parámetro a graficar");
				$('#grafico1').addClass('hide');
			}
			
			
			return false;
		}	

	</script>
</head>

<body class="indigo lighten-5">
	<div align="center">
	<?php
		if (isset($_GET['id']) && $_GET['id'] != "")
		{
			$id = $_GET['id'];
			
			echo '<h2>Historial de Parámetros por Máquina</h2>';

			//Conexión a la base de datos
			include 'lib/controles.php';
			$conexion = mysql_connect ('localhost',$DBUSER, $DBPASS) or die ('No se puede conectar con el servidor');
			mysql_select_db ($DATABASE) or die ('No se puede seleccionar la base de datos');	

			$consulta = mysql_query ('
					SELECT Codigo,idMotor
					FROM tbl_motor
					WHERE  idCentral='.$id, $conexion) or die ('Fallo en la consulta 1');
			$nfilas = mysql_num_rows ($consulta);
			echo '<div id="menu"><ul>';
			for ($i=0; $i<$nfilas; $i++)
				{
					$fila = mysql_fetch_array ($consulta);
					echo '<li><div class="unselected" id="'.$fila["idMotor"].'">'.$fila["Codigo"].'</div></li>';
				}
			echo "</ul></div>";		
			mysql_close ($conexion);
	?>
			<script>$idCentral=<?php echo $id;?></script>
			
			<div id="contenedor">
						
				<div id="contenido" class="hide">
					
					<div id="lista_parametros">
						<?php
							$idMotor = $_COOKIE['CidMotor'];
							if ($idMotor!=0){
								
								setcookie("CidMotor", $idMotor);
								//echo 'idMotor seleccionado: '.$idMotor;
								$conexion2 = mysql_connect ('localhost',$DBUSER, $DBPASS) or die ('No se puede conectar con el servidor');
								mysql_select_db ($DATABASE) or die ('No se puede seleccionar la base de datos');	

								$consulta2 = mysql_query ('
									SELECT idItem, Descripcion AS Item FROM tbl_item WHERE idItem IN
										(SELECT DISTINCT(idItem) FROM tbl_itemsanalisis WHERE idAnalisis IN
											(SELECT idAnalisis FROM tbl_analisis WHERE idMotor = '.$idMotor.')) 
									ORDER BY Item ASC'
									, $conexion2) or die ('Fallo en la consulta 2');
								$nfilas2 = mysql_num_rows ($consulta2);
								if ($nfilas2>0){
									echo '<h3>Seleccione los parámetros a Graficar</h3>';
									echo '<table>';
									for ($i=0; $i<$nfilas2; $i++){
										$fila2 = mysql_fetch_array ($consulta2);
										echo '<tr><td>';
										echo '<input type="checkbox" class="checkbox" value="'.$fila2["idItem"].'">';
										echo '</td><td>'.$fila2["Item"].'</td></tr>';
									}?>
									<tr><td></td></tr>
									<tr><td colspan="2"><input type="button" onclick="Graficar();"id="BGraficar" value="Graficar" /></td></tr>
									</table>
								<?php 
								} else{
									echo '<h3>No hay análisis asociados al motor seleccionado</h3>';
								}
								mysql_close ($conexion2);
							} 
						?>
					</div>

				</div>
				<div id="grafico1" class="hide">
					 <iframe id="if1" frameBorder="0" "src="" width="80%" height="350px"></iframe> 
				</div>
						<br />
				<input type="button" value="Volver" onclick="window.location='index.php';return true;" />
			</div>
	<?php
		}
		else{
	?>
			ERROR: INGRESO INCORRECTO
			<br /><br />
			<input type="button" value="Volver" onclick="window.location='index.php';return true;" />
	<?php } ?>
	</div>
</body>
</html>
