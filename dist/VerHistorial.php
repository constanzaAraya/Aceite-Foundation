
<?php include 'lib/controles.php';?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Ver Historial        </title>
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
    <div id="content" align="center">
      <?php if (isset($_GET['id']) && $_GET['id'] != ""){ 
          $id = $_GET['id'];
          
          $mysqli = new mysqli('localhost',$DBUSER, $DBPASS, $DATABASE);
          if ($mysqli -> connect_errno) {	die( "Fallo la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error); exit;}
      
          $central=$mysqli->query('SELECT descripcion FROM tbl_central WHERE idCentral='.$id);
          $row_central=$central->fetch_assoc();
      ?>
      <header>
        <h3 align="center">Historial de Parámetros por Máquina
          <?php 
              echo $row_central["descripcion"];
          ?>
        </h3>
      </header><br><br>
      <?php              
          $consulta = $mysqli->query ('
                  SELECT Codigo,idMotor
                  FROM tbl_motor
                  WHERE  idCentral="'.$id.'"');                    
          $nfilas = $consulta->num_rows;               
          echo '<div class="menu-centered"><ul class="menu">';
          for ($i=0; $i<$nfilas; $i++){
                  $fila = $consulta->fetch_assoc();
                  echo '<input type="button" class="unselected button btn1" id="'.$fila["idMotor"].'" title="Motor" value="'.$fila["Codigo"].'">';
          }
          echo "</ul></div>";		
      ?>
      <script>
        $idCentral=<?php echo $id;?>
        
      </script>
      <div id="contenedor">
        <div class="hide" id="contenido">
          <div id="lista_parametros" align="center">
            <?php 
                $idMotor = $_COOKIE['CidMotor'];
                if ($idMotor!=0){						
                    setcookie("CidMotor", $idMotor);
                    $mysqli2 = new mysqli('localhost',$DBUSER, $DBPASS, $DATABASE);
                    if ($mysqli2 -> connect_errno) { die( "Fallo la conexión a MySQL: (" . $mysqli2->connect_errno . ") " . $mysqli2->connect_error); exit;}
            
                    $consulta2 = $mysqli2->query ('
                      SELECT idItem, Descripcion AS Item FROM tbl_item WHERE idItem IN
                      (SELECT DISTINCT(idItem) FROM tbl_itemsanalisis WHERE idAnalisis IN
                      (SELECT idAnalisis FROM tbl_analisis WHERE idMotor = '.$idMotor.')) 
                      ORDER BY Item ASC');
                    $nfilas2 = $consulta2->num_rows;
                    if ($nfilas2>0){
                      echo '<p><div align="center"><h5>Seleccione los parámetros a Graficar</h5></div></p>';
                      echo '<div class="small-11 column">';
                      echo '<table class="stack">';
                      $contador = 1; 
                      while($fila2 = $consulta2->fetch_assoc()){
                        if($contador > 4) {
                         echo "</tr><tr>";
                         $contador = 1;
                        }
                        echo '<td><input type="checkbox" class="checkbox" value="'.$fila2["idItem"].'"></td>';
                        echo '<td>'.$fila2["Item"].'</td>';
                        $contador++;
                      } 
                      echo '</table></div>';
                      echo '<div align="center" class="small-12 column"><input class="button" type="button" onclick="Graficar();" id="BGraficar" value="Graficar" />
                      <input type="button" name="select" onclick="selectAll()" class="button" value="Marcar Todo">
                      <input type="button" name="select" onclick="cleanAll()" class="button" value="Limpiar">
                      </div>';
                    } 
                    else{
                        echo '<div>No hay análisis asociados al motor seleccionado!</div>';
                    }
                    mysqli_close($mysqli);
                } 
            ?>
          </div>
        </div>
        <div class="large reveal hide" id="grafico1" data-reveal align="center">
          <iframe frameBorder="0" src="" id="if1" width="80%" height="350px"></iframe>
          <button class="close-button" data-close aria-label="Close modal" type="button"><i class="fa fa-window-close" aria-hidden="true"></i></button>
        </div><br>
        <div class="small-12 column">
          <input class="button" type="button" value="Volver" onclick="window.location='index.php';return true;">
        </div>
      </div>
      <?php 
       }
       else{
           echo "ERROR: INGRESO INCORRECTO";
           echo "<br><br>";
           echo '<input type="button" value="Volver" onclick="window.location=index.php;return true;" />';
       }
      ?>   
    </div>

    <script type="text/javascript">
      var idCentral;
      document.cookie = "CidMotor=0";
      document.cookie = "Cparametros='()'";
      
      $('.unselected').click(function(){
        //des-selecciona div que est� selccionado
        $('.selected').each(function(){
          $(this).addClass('unselected').removeClass('selected');
        });
              
        //guarda valor de Motor seleccionado en cookie
        document.cookie = "CidMotor="+$(this).attr('id');
        //selecciona el div en que se hizo click
        $(this).addClass('selected').removeClass('unselected');
        // muestra el div de contenido
        $('#contenido').removeClass('hide');
        //refresh div de gr�ficos para que se desaparezca
        document.cookie = "Cgraficar=0";
        $('#grafico').load('VerHistorial.php?id='+($idCentral)+' #grafico');
        //refresh div de par�metros
        $('#lista_parametros').load('VerHistorial.php?id='+($idCentral)+' #lista_parametros');
        $('#grafico1').addClass('hide');       		
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
            var popup = new Foundation.Reveal($('#grafico1'));
            popup.open();
          } 
          else {
              alert("Debe seleccionar al menos un parámetro a graficar!");
              $('#grafico1').addClass('hide');
          }				
          return false;
      }	
    </script>
    <script>
     function selectAll(){
       if ($('.selectall').click()) {
            $('.checkbox').each(function(){
                this.checked = true;
            })
        } 
     } 
     function cleanAll(){
       if ($('.cleanAll').click()) {
            $('.checkbox').each(function(){
                this.checked = false;
            })
        }
     }
    </script>
    <script src="assets/js/vendor/what-input.js"></script>
    <script src="assets/js/vendor/foundation.min.js"></script>
    <script>$(document).foundation();</script>
    <script src="assets/js/app.js"></script>
  </body>
</html>