
<?php include 'lib/controles.php';?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Ver Historial2        </title>
    <meta charset="utf-8">
    <meta name="description" content="Sitio Aceite">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/files/img/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700" rel="stylesheet" type="text/css">
    <link href="assets/css/main.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/vendor/jquery-3.1.1.min.js"></script>
    <script src="https://www.google.com/jsapi"></script>
  </head>
  <body>
    <div id="grafico2" align="center">
      <?php $c_parametros = $_COOKIE['Cparametros'];
          $idMotor = $_COOKIE['CidMotor'];
      
          $mysqli = new mysqli('localhost',$DBUSER, $DBPASS, $DATABASE);
          if ($mysqli -> connect_errno) {	die( "Fallo la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error); exit;}
      
          $consulta4 = $mysqli->query ("SELECT idAnalisis, Nombre FROM tbl_analisis WHERE idMotor = '".$idMotor."'");
          $nfilas4 = $consulta4->num_rows;
      
          //$columnas para mysql pivot
          $columnas="";
          for ($i=0; $i<$nfilas4; $i++){
            $columnas=$columnas.', ';
            $fila4 =$consulta4->fetch_assoc();
            $columnas=$columnas.'SUM(valor*(1-ABS(SIGN(analisis-'.$fila4["idAnalisis"].')))) AS A'.$fila4["idAnalisis"];
            $analisis[$i]=$fila4["Nombre"];
          }
      
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
          //echo $consultaSQL;
          // acá va el gráfico
      
          $consulta3 = $mysqli->query($consultaSQL);
          $nfilas3 = $consulta3->num_rows;
          if ($nfilas3>0){
              echo '<script type="text/javascript">';
              echo "google.load('visualization', '1.1', {packages: ['corechart', 'line']});";
              echo 'google.setOnLoadCallback(drawChart);';
              echo 'function drawChart() {';
               echo 'var data = new google.visualization.DataTable();';	
               echo "data.addColumn('string', 'Numero de Analisis');";
              
               for ($i=0; $i<$nfilas3; $i++){
                  $fila3 = $consulta3->fetch_assoc();
      
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
               echo ']);';
      ?>
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
          ?>   
      
    </div>
    <div id="chart_div" style="height: 330px;border:1px gray solid;pading:5px">
      <?php
       mysqli_close($mysqli);	
      ?>
    </div>
    <script src="assets/js/vendor/what-input.js"></script>
    <script src="assets/js/vendor/foundation.min.js"></script>
    <script>$(document).foundation();</script>
    <script src="assets/js/app.js"></script>
  </body>
</html>