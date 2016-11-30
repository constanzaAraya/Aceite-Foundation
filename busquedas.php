
<?php include 'lib/controles.php';?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Plantilla</title>
    <meta charset="utf-8">
    <meta name="author" content="Eduardo Anabalón">
    <meta name="description" content="My Description">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/files/img/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700" rel="stylesheet" type="text/css">
    <link href="assets/css/main.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/vendor/jquery-3.1.1.min.js"></script>
    <script src="https://www.google.com/jsapi"></script>
  </head>
  <body>
    <p>
      <div class="small-11 small-centered columns">
        <div class="row">
          <form action="plantilla.php" method="post">
            <input type="text" name="sql" placeholder="Escribe consulta SQL">
            <input type="submit" value="Ver">
          </form>
        </div>
      </div>
    </p>
    <?php
     function displayTable($sql){
        //Creamos la conexión
        $server = "localhost";
        $user = "prueba";
        $pass = "123";
        $BD = "ec_aceite";
        $conexion = mysqli_connect($server,$user,$pass,$BD);
        //generamos la consulta
        if(!$result = mysqli_query($conexion, $sql)) die();
    
        $rawdata = array();
        //guardamos en un array multidimensional todos los datos de la consulta
        $i=0;
    
        while($row = mysqli_fetch_array($result)){
          $rawdata[$i] = $row;//almacena las filas de la consulta
          $i++;
        }
        $close = mysqli_close($conexion);
    
        //DIBUJAMOS LA TABLA
        echo '<p><table width="99%" class="stack" border="1" style="text-align:center;">';
        $columnas = count($rawdata[0])/2;
        //echo $columnas;
        $filas = count($rawdata);
        //echo "<br>".$filas."<br>";
    
        //Añadimos los titulos
        for($i=1;$i<count($rawdata[0]);$i=$i+2){
            next($rawdata[0]);
            echo "<th><b>".key($rawdata[0])."</b></th>";
            next($rawdata[0]);
        }
    
        for($i=0;$i<$filas;$i++){
            echo "<tr>";
            for($j=0;$j<$columnas;$j++){
                echo "<td>".$rawdata[$i][$j]."</td>";
            }
            echo "</tr>";
        }
        echo '</table></p>';
      }
      if(empty($_POST) || $_POST["sql"] == ""){
        DIE("");
      }
      $sql = $_POST["sql"];
      echo "<p><div class='row'>".$sql."</div></p>";
      displayTable($sql);       		
    ?>
    <script src="assets/js/vendor/what-input.js"></script>
    <script src="assets/js/vendor/foundation.min.js"></script>
    <script>$(document).foundation();</script>
    <script src="assets/js/app.js"></script>
  </body>
</html>