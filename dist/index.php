
<?php include 'lib/controles.php';?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Inicio</title>
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
    <?php
        $mysqli = new mysqli('localhost',$DBUSER, $DBPASS, $DATABASE);
        if ($mysqli -> connect_errno) {	die( "Fallo la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error); exit;}
    
        $resultado=$mysqli->query("SELECT idCentral, Descripcion FROM tbl_central");
        $nfilasCentral = $resultado->num_rows;		
    ?>
    
    <div class="small-9 small-centered columns">
      <div class="row">
        <div class="col s12">
          <p>
            <h3 align="center">INFORMES ANÁLISIS DE ACEITE</h3>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="small-5 small-centered columns">
          <p align="center">
            <ul class="button-group round"><a class="button button-radius btnOpcion" href="#modal1" data-reveal-id="modal1" id="AgregarRegistro">Nuevo Informe<i class="fa fa-plus-square-o" aria-hidden="true"></i></a><a class="button button-radius btnOpcion" href="#modal1" data-reveal-id="modal1" id="VerHistorial">Ver Historial<i class="fa fa-bar-chart" aria-hidden="true"> </i></a></ul>
          </p>
        </div>
      </div><br>
      <p>
        <div class="row">
          <div class="small-12 columns">
            <table class="stack">
              <thead>
                <tr>
                  <th style{text-align: center; background-color: #4CAF50; color: white;}>Fecha de Informe</th>
                  <th>Código de Informe</th>
                  <th>Producto</th>
                  <th>Máquina</th>
                  <th>Horómetro</th>
                  <th>Proveedor</th>
                  <th></th>
                </tr>
              </thead>
              <?php $consulta=$mysqli->query('
                  SELECT tbl_analisis.idAnalisis as Id, tbl_analisis.Nombre as Nombre, tbl_analisis.Producto as Prod, 
                  DATE_FORMAT(tbl_analisis.FechaAnalisis,"%d-%m-%Y") as Fecha, tbl_motor.Codigo as Motor, tbl_proveedor.Nombre as Proveedor, 
                  tbl_analisis.HorometroMaquina as HorometroMaquina 
                  FROM tbl_analisis, tbl_motor, tbl_proveedor 
                  WHERE tbl_analisis.idMotor = tbl_motor.idMotor AND tbl_analisis.idProveedor = tbl_proveedor.idProveedor
                  ORDER BY tbl_analisis.FechaAnalisis DESC
                  ');
              
                  while($fila=$consulta->fetch_assoc()){ ?>
              <tbody>
                <tr>
                  <td><?php echo $fila['Fecha']; ?></td>
                  <td><?php echo $fila['Nombre']; ?></td>
                  <td><?php echo $fila['Prod']; ?></td>
                  <td><?php echo $fila['Motor']; ?></td>
                  <td><?php echo number_format($fila["HorometroMaquina"],0,'','.'); ?> hrs.</td>
                  <td><?php echo $fila['Proveedor']; ?></td>
                  <td>
                    <div class="btnVer" title="Ver" id="<?php echo $fila['Id'];?>"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                  </td>
                </tr>
              </tbody>
              <?php } ?>                    
              
            </table>
          </div>
        </div>
      </p>
    </div>
    <div class="small reveal" id="modal1" data-reveal>       
      <table>
        <thead>
          <tr>
            <th>
              <h4>Seleccione una Central</h4>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i=0; $i<$nfilasCentral; $i++){
           $filaCentral = $resultado->fetch_assoc(); 
           echo '<tr><td class="collection-item" width="90%">
             <a href="#!" data-toggle="secondary-content">
               <div class="selOpcion" name="id_ce" id="'.$filaCentral["idCentral"].'">'.strtoupper($filaCentral["Descripcion"]).'
               </div>
             </a>
            </td>
            <td><a href="#!" data-toggle="secondary-content">
               <div class="selOpcion" name="id_ce" id="'.$filaCentral["idCentral"].'">
                <i class="fa fa-arrow-right" aria-hidden="true" align="right"></i>
               </div>
            </td></tr>';
          } ?>            
           
        </tbody>
      </table>
      <button class="close-button" data-close aria-label="Close modal" type="button"><i class="fa fa-window-close" aria-hidden="true"></i></button>
    </div>
    <?php mysqli_close($mysqli); /*div.full.reveal#secondary-content(data-reveal)  p Abrir pagina*/ ?>                
    
    <script>
      $('.btnOpcion').click(function() {
          $pagina = $(this).attr('id');
          console.log($pagina);
          var popup = new Foundation.Reveal($('#modal1'));
          popup.open();
      });
      
      $('.selOpcion').click(function() {
          $central = $(this).attr('id');
          $('#modal1').foundation('close');
          window.location = $pagina + ".php?id=" + $central;
      });
      
      $('.btnVer').click(function() {
          window.location = "VerAnalisis.php?id=" + $(this).attr('id');
      });
    </script>
    <script src="assets/js/vendor/what-input.js"></script>
    <script src="assets/js/vendor/foundation.min.js"></script>
    <script>$(document).foundation();</script>
    <script src="assets/js/app.js"></script>
  </body>
</html>