function limpiarTabla(elemento) {
    $('#' + elemento).find('tbody tr').remove();
}

function solicitudAjax(solicitudUrl, onSuccess, data, tipoDato, tipo) {
    var tipoSolicitud = tipo ? 'POST' : 'GET',
        datatype = tipoDato ? 'text' : 'json';
    $.ajax({
        type: tipoSolicitud,
        datatype: datatype,
        traditional: false,
        url: solicitudUrl,
        data: data,
        success: function (responseText) {
            if (onSuccess)
                onSuccess(responseText);
        },
        error: function (exception) {
        }
    });
}

function AccionColumna(evento, classIcono) {
    return $('<a>').addClass(classIcono).click(function (e) {
        e.preventDefault();
        evento(e);
    });
}

function adicionarOpcionesCombo(elemento, items, evento, prop, eliminar) {
    prop = prop || { id: 'id', value: 'value' };
    eliminar = eliminar ? true : false;
    if (eliminar)
        $(elemento).find('option').remove();
    $.each(items, function (index, item) {
        $(elemento).append($('<option>').val(item[prop.id]).text(item[prop.value]));
    });
    if (evento)
        $(elemento).change(function (e) { evento(e, $(elemento).val()); });
}

function crearControlFecha(element, cambiarFecha) {
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

    if (cambiarFecha) {
        $(element).datepicker({
            changeMonth: true,
            changeYear: true

        });
    } else {
        $(element).datepicker({});
    }
}
