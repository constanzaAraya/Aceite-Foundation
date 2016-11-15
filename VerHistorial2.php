<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" TYPE="text/css" HREF="estilo/enor.css">
	<script type="text/javascript" src="lib/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>

</head>

<body>
	<div id="grafico2" align="center">
	<?php
		$c_parametros = $_COOKIE['Cparametros'];
		$idMotor = $_COOKIE['CidMotor'];
		
		//echo $idMotor;
		//echo $c_parametros;

		include 'lib/controles.php';
		$conexion3 = mysql_connect ('localhost',$DBUSER, $DBPASS) or die ('No se puede conectar con el servidor');
		mysql_select_db ($DATABASE) or die ('No se puede seleccionar la base de datos');
		
		$consulta4 = mysql_query ('
			SELECT idAnalisis, Nombre FROM tbl_analisis WHERE idMotor = '.$idMotor
			, $conexion3) or die ('Fallo en la consulta 4');
		$nfilas4 = mysql_num_rows ($consulta4);
		
		
		
		//$columnas para mysql pivot
		$columnas="";
		for ($i=0; $i<$nfilas4; $i++){
			$columnas=$columnas.', ';
			$fila4 = mysql_fetch_array ($consulta4);
			$columnas=$columnas.'SUM(valor*(1-ABS(SIGN(analisis-'.$fila4["idAnalisis"].')))) AS A'.$fila4["idAnalisis"];
			$analisis[$i]=$fila4["Nombre"];
		}
		//echo 'sql: '.$columnas;
		//$consulta3 = mysql_query ('
		
		$consultaSQL='	
			SELECT item '.$columnas.'
			FROM (
				SELECT tbl_item.Descripcion AS item, tbl_itemsanalisis.Valor AS valor, tbl_itemsanalisis.idAnalisis AS analisis
				FROM tbl_item, tbl_itemsanalisis
				WHERE
					tbl_item.idItem = tbl_itemsanalisis.idItem AND
					tbl_item.idItem IN '.$c_parametros.' AND					
					tbl_itemsanalisis.idAnalisis IN 
						(SELECT idAnalisis FROM tbl_analisis WHERE idMotor = '.$idMotor.')) AS prueba
			GROUP BY item';
		echo $consultaSQL;
		// acá va el gráfico

		$consulta3 = mysql_query ($consultaSQL, $conexion3) or die ('Fallo en la consulta 3');
		$nfilas3 = mysql_num_rows ($consulta3);
		if ($nfilas3>0){
			echo '<script type="text/javascript">';
				echo "google.load('visualization', '1.1', {packages: ['corechart', 'line']});";
				echo 'google.setOnLoadCallback(drawChart);';

				echo 'function drawChart() {';

				echo 'var data = new google.visualization.DataTable();';	

				echo "data.addColumn('string', 'Numero de Analisis');";
				
				for ($i=0; $i<$nfilas3; $i++){
					$fila3 = mysql_fetch_array ($consulta3);

					//Columnas para el gráfico
					echo "data.addColumn('number','".$fila3["item"]."');";
					
					for ($j=0; $j<$nfilas4; $j++){ //se sabe que el resultado de SQL tiene tantas columnas como analisis
						
						//Se almacenarán los valores en la consulta SQl de forma traspuesta para luego graficar
						$resultados[$j][$i]= $fila3[$j+1];
					}
				}

				//datos para el gráfico
				echo 'data.addRows([';
				for ($i=0; $i<$nfilas4; $i++){
					//echo '['.($i+1).',';
					echo "['".$analisis[$i]."',";
					for ($j=0; $j<$nfilas3; $j++){
						$valor = number_format($resultados[$i][$j],2,".","");
						echo ($valor!="")? $valor:'0';
						echo ($j+1<$nfilas3) ? "," : "";
					}
					echo ($i+1<$nfilas4) ? "]," : "]";
				}
				echo ']);';?>
			
				var options = {
					legend: { position: 'top' },
			        vAxis: { format:'decimal',minValue:0}
				};


				<?php
				//echo "var chart = new google.charts.Line(document.getElementById('chart_div'));";
				echo "var chart = new google.visualization.LineChart(document.getElementById('chart_div'));";

				echo 'chart.draw(data, options);';
				echo '}';
			echo '</script>';
		}
		mysql_close ($conexion3);								
		//echo $c_parametros;
	?>

		




		<div id="chart_div" style="height: 330px;border:1px gray solid;pading:5px"></div>
			
	</div>

</body>
</html>
