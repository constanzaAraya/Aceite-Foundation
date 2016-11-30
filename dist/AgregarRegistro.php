
<?php include 'lib/controles.php';?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Agregar Registro</title>
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
    <?php if (!$_POST){
        if (isset($_GET['id']) && $_GET['id'] != ""){			
            $id = $_GET['id'];
    
            //Conexión a la base de datos
            $mysqli = new mysqli('localhost',$DBUSER, $DBPASS, $DATABASE);
            if ($mysqli -> connect_errno) {	die( "Fallo la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error); exit;}
            
            $central=$mysqli->query('SELECT descripcion FROM tbl_central WHERE idCentral='.$id);
            $row_central=$central->fetch_assoc();
    ?>
    
    <div class="small-9 small-centered columns">
      <div class="row">
        <div>
          <p>
            <h3 align="center">Agregar Nuevo Informe
              <?php
                  echo $row_central['descripcion'];
              ?>
              
            </h3>
          </p>
        </div>
      </div>
      <div class="small-10 small-centered columns" align="center">
        <?php $consulta_motor = $mysqli->query ('
            SELECT Codigo, idMotor, Marca, Modelo
            FROM tbl_motor
            WHERE idCentral ='.$id);		
         $nfilas_motor = $consulta_motor->num_rows;
            
         $consulta_prov = $mysqli->query ('
          SELECT Nombre,idProveedor
          FROM tbl_proveedor
         ');		
         $nfilas_prov = $consulta_prov->num_rows;
        ?>
        
      </div><br><br>
      <form action="AgregarRegistro.php" method="post">
        <div class="row">
          <table align="center">
            <tr>
              <th>Informe</th>
              <td>
                <input type="text" name="Informe" size="30" required>
              </td>
              <th>Proveedor</th>
              <td>
                <select name="Prov" required>
                  <option value="" selected>Selecciona Proveedor
                    <?php for ($i=0; $i<$nfilas_prov; $i++){
                        $fila_prov = $consulta_prov->fetch_assoc();
                        echo '<option value="'.$fila_prov["idProveedor"].'">'.$fila_prov["Nombre"].'</option>';
                    } 
                    ?>
                  </option>
                </select>
              </td>
            </tr>
            <tr>
              <th>Motor</th>
              <td>
                <select name="Motor" required>
                  <option value="" selected>Selecciona Motor
                    <?php for ($i=0; $i<$nfilas_motor; $i++){
                      $fila_motor = $consulta_motor->fetch_assoc();
                      echo '<option value="'.$fila_motor["idMotor"].'">'.$fila_motor["Codigo"].'</option>';
                     }
                    ?>
                  </option>
                </select>
              </td>
              <th>Producto</th>
              <td>
                <input type="text" name="Producto" size="30" required>
              </td>
            </tr>
            <tr>
              <th>Horómetro Máquina</th>
              <td>
                <input type="text" name="Horo1" size="30" required>
              </td>
              <th>Horómetro Producto</th>
              <td>
                <input type="text" name="Horo2" size="30" required>
              </td>
            </tr>
            <tr>
              <th>Fecha Toma de Muestra</th>
              <td>
                <input type="date" name="Fecha1" size="30" required>
              </td>
              <th>Fecha Entrega de Informe</th>
              <td>
                <input type="date" name="Fecha2" size="30" required>
              </td>
            </tr>
          </table><br><br>
          <div class="panel clearfix" align="center"><span class="meter">
              <input class="success button" name="agregar" type="submit" onclick="Test()" value="Agregar">
              <input class="button" type="button" value="Volver" onclick="window.location='index.php';"></span></div>
        </div>
      </form>
    </div>
    <?php mysqli_close($mysqli);
     }
     else{ //ERROR: ingreso erroneo 
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
    
        $mysqli = new mysqli('localhost',$DBUSER, $DBPASS, $DATABASE);
        if ($mysqli -> connect_errno) {	die( "Fallo la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error); exit;}	
    
        $consulta = $mysqli->query('
          INSERT INTO tbl_analisis (Nombre, Producto, FechaAnalisis, FechaMuestra, idMotor, idProveedor, HorometroMaquina, HorometroProducto) 
          VALUES ("'.$nombre.'","'.$prod.'","'.$fecha2.'","'.$fecha1.'",'.$motor.','.$prov.','.$horo1.','.$horo2.')
        ');        		
        
        if ($consulta>0){
            echo '<script>alert("Se ha publicado con éxito.")</script>';
            echo '<script>location.href="index.php"</script>';
        }
        else { 
            echo '<script>alert("ERROR: no se ha podido publicar. vuelva a intentarlo nuevamente"</script>';
        }
        mysqli_close($mysqli);
    ?>
    
    <div align="center">
      <input class="button" type="button" value="Volver" onclick="window.location='index.php';">
    </div><?php } ?>                  
    <script src="assets/js/vendor/what-input.js"></script>
    <script src="assets/js/vendor/foundation.min.js"></script>
    <script>$(document).foundation();</script>
    <script src="assets/js/app.js"></script>
  </body>
</html>