    $(document).ready(function() {
        $('#agregarDato').click(function() {
            /*$('#modal1').openModal();
            $('.modal-content').load('AgregarDato.php?id1=<?php echo $id;?>');					
            return false;*/
            var popup = new Foundation.Reveal($('#modal1'));
            popup.open($('.modal-content').load('AgregarDato.php?id1=<?php echo $id;?>'));
            return false;
        });
    });

    var idCentral;
    document.cookie = "CidMotor=0";
    document.cookie = "Cparametros='()'";

    $(document).ready(function() {
        $('.unselected').click(function() {
            $('.selected').each(function() {
                $(this).addClass('unselected').removeClass('selected');
            });

            document.cookie = "CidMotor=" + $(this).attr('id');;

            $(this).addClass('selected').removeClass('unselected');

            $('#contenido').removeClass('hide');

            document.cookie = "Cgraficar=0";
            $('#grafico').load('VerHistorial.php?id=' + ($idCentral) + ' #grafico');

            $('#lista_parametros').load('VerHistorial.php?id=' + ($idCentral) + ' #lista_parametros');
            $('#grafico1').addClass('hide');
        });

    });

    function Graficar() {
        var lista_parametros = "(";
        var contador = 0;
        //alert(contador);
        $('.checkbox').each(function() {
            if ($(this).is(':checked')) {
                contador++;
                lista_parametros += $(this).val() + ',';
                //alert($(this).val());
            }
        });
        if (contador > 0) {
            lista_parametros = lista_parametros.substring(0, lista_parametros.length - 1) + ')';
            document.cookie = "Cparametros=" + lista_parametros;

            $('#grafico1').removeClass('hide');
            $('#if1').attr('src', "VerHistorial2.php");

            //$('#grafico1').load('VerHistorial.php?id='+($idCentral)+' #grafico2');

        } else {
            alert("debe seleccional al menos un parámetro a graficar");
            $('#grafico1').addClass('hide');
        }

        return false;
    }