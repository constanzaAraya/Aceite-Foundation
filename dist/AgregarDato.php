
<?php include 'lib/controles.php';?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Agregar Dato</title>
    <meta charset="utf-8">
    <meta name="description" content="Sitio Aceite">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/files/img/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700" rel="stylesheet" type="text/css">
    <link href="assets/css/main.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/vendor/jquery-3.1.1.min.js"></script>
  </head>
  <body>
    <header>
      <h1 align="center">Ingresa datos </h1>
    </header><br>
    <?php
     if (!$_POST) {
       if (isset($_GET['id1']) && $_GET['id1'] != ""){
         $idAnalisis = $_GET['id1'];
         
         //Conexión a la base de datos
         $mysqli = new mysqli('localhost',$DBUSER, $DBPASS, $DATABASE);
         if ($mysqli -> connect_errno) 
            { die( "Fallo la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error); exit;}
    
         $consulta = $mysqli->query("
          SELECT idItem, Descripcion
          FROM tbl_item
          WHERE idItem NOT IN 
          (SELECT idItem FROM tbl_itemsanalisis WHERE idAnalisis ='".$idAnalisis."')
          ORDER BY Descripcion ASC
         ");
         $nfilas=$consulta->num_rows;
    ?>
    
    <form id="content" action="VerAnalisis.php?id=<?php echo $idAnalisis;?>" method="post">
      <div class="row" align="center">
        <select name="Item" required>
          <option value="" selected>Selecciona Variable
            <?php for($i=0; $i<$nfilas; $i++){
                $fila = $consulta->fetch_assoc();
                echo '<option value="'.$fila["idItem"].'">'.$fila["Descripcion"].'</option>';
            } ?>
          </option>
        </select>
        <input class="validate" name="Valor" id="valor" type="text" placeholder="Ingresa Valor" required>
        <input type="hidden" name="Analisis" value="<?php echo $idAnalisis;?>">
        <input class="success button" type="submit" name="agregar" value="Agregar">
      </div>
    </form>
    <?php 
        mysqli_close($mysqli);
      }
      else {
        echo '<p><em><strong>ERROR: </strong>Esta sección ha sido accesada incorrectamente.</em></p>';
      }
     }         
    ?>
    <script src="assets/js/vendor/what-input.js"></script>
    <script src="assets/js/vendor/foundation.min.js"></script>
    <script>$(document).foundation();</script>
    <script src="assets/js/app.js"></script>
  </body>
</html>