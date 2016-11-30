(function () {
    'use strict';

    $(document).ready(function () {
        $('#agregarDato').click(function () {
            /*$('#modal1').openModal();
            $('.modal-content').load('AgregarDato.php?id1=<?php echo $id;?>');					
            return false;*/
            var popup = new Foundation.Reveal($('#modal1'));
            popup.open($('.modal-content').load('AgregarDato.php?id1=<?php echo $id;?>'));
            return false;
        });
    });

    document.cookie = "CidMotor=0";
    document.cookie = "Cparametros='()'";

    $(document).ready(function () {
        $('.unselected').click(function () {
            $('.selected').each(function () {
                $(this).addClass('unselected').removeClass('selected');
            });

            document.cookie = "CidMotor=" + $(this).attr('id');;

            $(this).addClass('selected').removeClass('unselected');

            $('#contenido').removeClass('hide');

            document.cookie = "Cgraficar=0";
            $('#grafico').load('VerHistorial.php?id=' + $idCentral + ' #grafico');

            $('#lista_parametros').load('VerHistorial.php?id=' + $idCentral + ' #lista_parametros');
            $('#grafico1').addClass('hide');
        });
    });

}());
//# sourceMappingURL=app.js.map