
<?php include 'lib/controles.php';?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Resultado Análisis de Aceite</title>
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
    <?php $mysqli = new mysqli('localhost',$DBUSER, $DBPASS, $DATABASE);
         if ($mysqli -> connect_errno) {	die( "Fallo la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error); exit;}
    
         if ($_POST){ 
            $Item = $_POST["Item"];
            $Valor = $_POST["Valor"];
            $Analisis = $_POST["Analisis"];			
            //echo $Item." - ".$Valor." - ".$Analisis;		
            if($Item!='' and $Valor!='' and $Analisis!=''){	
              $consultaInsert = $mysqli->query ("
               INSERT INTO tbl_itemsanalisis (idAnalisis, idItem, Valor) 
               VALUES (".$Analisis.", ".$Item.", ".$Valor.")");
              if($consultaInsert>0){ echo "<script>var ingreso=$consultaInsert;</script>"; }
            }  
         }
    
         //siempre se carga la página
         if (isset($_GET['id']) && $_GET['id'] != ""){
            $id = $_GET['id'];//print $id;
            $consulta =  $mysqli->query('
                    SELECT tbl_analisis.Nombre as Nombre, tbl_analisis.Producto as Prod, DATE_FORMAT(tbl_analisis.FechaAnalisis,"%d-%m-%Y") as Fecha1, DATE_FORMAT(tbl_analisis.FechaMuestra,"%d-%m-%Y") as Fecha2, tbl_motor.Codigo as Motor, tbl_motor.Marca as Marca, tbl_motor.Modelo as Modelo, tbl_proveedor.Nombre as Proveedor,	tbl_analisis.HorometroMaquina as Horometro1, tbl_analisis.HorometroProducto as Horometro2, tbl_central.Descripcion as Central, tbl_central.Ubicacion as Lugar 
                    FROM tbl_analisis, tbl_motor, tbl_proveedor, tbl_central 
                    WHERE tbl_analisis.idMotor = tbl_motor.idMotor AND tbl_analisis.idProveedor = tbl_proveedor.idProveedor AND tbl_motor.idCentral = tbl_central.idCentral AND  tbl_analisis.IdAnalisis='.$id.'');
            
            $fila=$consulta->fetch_assoc();
    ?>
    <div id="content">
      <header>
        <h2 align="center">Análisis de Aceite</h2>
        <div align="center">Realizado por
          <?php echo "<strong>".$fila["Proveedor"]."</strong> el ".$fila["Fecha1"]; ?>
          
        </div>
      </header>
      <div class="row" align="center">
        <table class="hover t1">
          <tr>
            <th>Motor</th>
            <td><?php echo $fila["Motor"]; ?></td>
            <th>Producto</th>
            <td><?php echo $fila["Prod"]; ?></td>
          </tr>
          <tr>
            <th>Marca / Modelo</th>
            <td><?php echo $fila["Marca"].' / '.$fila["Modelo"];?></td>
            <th>Horómetro Producto</th>
            <td><?php echo $fila["Horometro2"]; ?> hrs.</td>
          </tr>
          <tr>
            <th>Central</th>
            <td><?php echo $fila["Central"]." / ".$fila["Lugar"]; ?></td>
            <th>Fecha Muestra</th>
            <td><?php echo $fila["Fecha2"]; ?></td>
          </tr>
          <tr>
            <th>Horómetro Motor</th>
            <td><?php echo number_format($fila["Horometro1"],0,'','.'); ?> hrs.</td>
            <th>Detalle Informe</th>
            <td>
              <?php echo ' '.$fila["Nombre"]; ?>
              
            </td>
          </tr><br>
        </table>
        <?php $consulta2 = $mysqli->query ('
            SELECT tbl_item.Descripcion as Item, tbl_itemsanalisis.Valor as Valor
            FROM tbl_itemsanalisis, tbl_item, tbl_analisis
            WHERE tbl_itemsanalisis.idAnalisis = tbl_analisis.idAnalisis AND tbl_item.idItem = tbl_itemsanalisis.idItem AND tbl_analisis.IdAnalisis='.$id.'
            ORDER BY Item
          ');
          $nfilas2 = $consulta2->num_rows;
        ?><br>
        <table class="stack" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <?php $contador = 1; 
               while($fila2 = $consulta2->fetch_assoc()){ 
                  if($contador > 4) { 
                     echo "</tr><tr>"; 
                     $contador = 1; 
                  } 
                  $valor = number_format($fila2["Valor"],2,",",'.');
                  $valor = (substr($valor, -3)!=",00")?$valor:substr($valor, 0,-3);
                  //echo ($valor=="")?'0':$valor; 
                  $val=($valor=="")?'0':$valor;
                  echo '<td><li>'.$fila2["Item"].' '.$val.'</li></td>';                             
                  $contador++;
                }
            ?>
          </tr>
        </table><br><br><br><br>
        <p align="center"><a class="button button-radius" href="index.php"><i class="fa fa-arrow-left" aria-hidden="true">Volver</i></a>
          <?php 
           $cant_items=$mysqli->query('
            SELECT count(*) as items
            FROM tbl_item
            WHERE idItem NOT IN 
             (SELECT idItem FROM tbl_itemsanalisis WHERE idAnalisis = "'.$id.'")');
           $row_cantItem=$cant_items->fetch_assoc();
           //echo $row_cantItem['items'];
           if($row_cantItem['items']>0){
              echo '<a class="button button-radius agregarDato" href="#" id="'.$id.'">Agregar Datos<i class="fa fa-plus-square-o" aria-hidden="true"></i></a>';
           }
          ?>        
          
        </p>
      </div>
      <?php }
       else{
          if($consultaInsert>0){
            // echo "<script>$('#modal1').foundation('reveal', 'close');</script>";
             echo "<script>location.href='VerAnalisis.php?id=$id'</script>";
          }else{
            echo '<div class="row"><div><h3>ERROR: INGRESO INCORRECTO</h3></div></div>';
          }
       }
      
       //cerrar sesión en BD
       mysqli_close($mysqli);
      ?>
      
      <div class="reveal pop" id="modal1" data-reveal>
        <iframe class="frm" name="ifrm" id="ifrm" src="#" frameborder="0" scrolling="no"></iframe>
        <button class="close-button" data-close aria-label="Close modal" type="button"><i class="fa fa-window-close" aria-hidden="true"></i></button>
        <script>
          $('.agregarDato').click(function(){
              $id = $(this).attr('id');
              $pagina='AgregarDato.php?id1=';
              console.log($pagina + $id);
              $url=$pagina+$id;
              var popup = new Foundation.Reveal($('#modal1'));
              popup.open();
              $('#ifrm').attr('src', $url);
          });
          var ingreso; 
          if(ingreso){console.log('cerrar reveal');
          $('.close-button').click();
          //var popups = new Foundation.Reveal($('#modal1'));
          //popups.close();
          //$('#modal1').trigger('reveal:close');
          }
        </script>
      </div>
    </div>
    <script src="assets/js/vendor/what-input.js"></script>
    <script src="assets/js/vendor/foundation.min.js"></script>
    <script>$(document).foundation();</script>
    <script src="assets/js/app.js"></script>
  </body>
</html>