<?php
include_once('conexion.php');
include_once('bar.php');

//El numero del comprobante debe ser correlatido por Empresa
//Cuando se crea el estado es Abierto
//Posibles Estados : "Abierto", "Cerrado" y "Anulado"
//La fecha tiene que pertenecer a un periodo Abierto
//Solo puedo colocar las cuentas de Detalle (las de ultimo nivel)
//Deberia poderse buscar las cuentas a travez de un autocompletar
//Si coloco un monto en el "Debe", no podre colocar otro el el "Haber" para el mismo detalle ni viceversa
//La suma de todos los "Debe" debe ser igual a la suma de todos los "Haber", caso contrario no debe dejar grabar el comprobante.
//Solo puedo insertar una cuenta a la vez en el detalle.
//Se debe validar los datos según los campos de la base de datos.
//Los tipos de comprobantes serán: "Ingreso", "Egreso", "Traspaso", "Apertura" y "Ajuste"
//Solo puede haber un comprobante de apertura en una gestión
date_default_timezone_set('America/La_Paz');

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'n';

//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

//get search term


//get matched data from skills table
$query = $db->query("SELECT * FROM articulo where id_empresa =".$_SESSION['id_emp']." ; ");
$data = array();
while ($row = $query->fetch_assoc()) {

    array_push($data, array('label'=> $row['nombre'], 'value' => $row['nombre'], 'id'=>$row['id']));
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>

        button, input, optgroup, select, textarea {

            color: #000000;
        }


        .borde {
            border: 2px solid #a1a1a1;
            padding: 10px 40px;
            border-radius: 3px;
            width: 80%;

        }
        label{
            margin-bottom: 0px;
        }
        .form-group{
            margin-bottom: 2px;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 0;}
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
        .ui-autocomplete
        {
            z-index: 8000; /
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="css/default.min.css">
</head>
<body>
<div id="crea_com">
    <form id="static" class="" role="form" method="post" action="notav_crear.php" enctype="multipart/form-data">
        <div class="container-fluid" style="margin-left: 250px">

            <div class="btn-group-horizontal" style="position: relative;">
                <button type="button" id="nuevo_com" class="btn btn-" ><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></button>
                <button type="button" class="btn btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                <button type="button" class="btn btn-"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <button type="button" id="crea" class="btn btn-success pull-right" style="margin-right: 220px;height: 30px" >Crear</button>
            </div>

            <div style="position: relative;" class="borde">

                <div class="container">
                    <div class="row row-centered">
                        <div class="col-sm-3 col-lg-3 col-centered">
                            <!-- <div class="form-group">
                    <label for="input6" class="col-md-4 control-label">123456789012:</label>
                    <div class="col-md-8">
                    <input type="text" class="form-control" id="input6" placeholder="input 6">
                  </div>
                </div> -->

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 col-lg-2">
                        <div class="form-group">
                            <label for="serie">Nro:</label>
                            <input  disabled type="text" class="form-control" id="serie">
                            <input name="serie" type="hidden" class="form-control" id="serie">
                        </div>
                    </div>
                    <div  class="col-sm-2 col-lg-6">
                        <div class="form-group">
                            <label for="tipo_comprobante">Descripcion:</label>
                            <input  disabled type="text" class="form-control" id="glosa" >
                        </div>
                    </div>

                    <div class="col-sm-2 col-lg-4">
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input name="fecha" disabled type="text" class="form-control datepicker" id="fecha">
                        </div>
                    </div>
                </div>



                <!-- /.row this actually does not appear to be needed with the form-horizontal -->
                <div class="row">
                    <div class='wrapper text-center'>
                        <div class="btn-group btn-group-lg" role="group" aria-label="...">
                            <button name="first1" id="first" type="button" class="btn btn-default" style="    height: 40px;">
                                <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                            </button>
                            <button name="be" id="be" type="button" class="btn btn-default"> <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></button>
                            <button name="af" id="af" type="button" class="btn btn-default"> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></button>
                            <button name="last" id="last" type="button" class="btn btn-default" style="    height: 40px;">
                                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                            </button>

                        </div>
                        <div class="col-xs-2 pull-right">
                            <div class="input-group">
                                <input type="number" id="buscar_serie" class="form-control" placeholder="Buscar por serie">
                                <span class="input-group-btn">
        <button class="btn btn-default" id="buscar" type="button">Ir</button>
      </span>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <!--                 <div class="btn-group btn-group-lg pull-right" role="group" aria-label="...">-->
                        <!--                 <button name="" type="button" class="btn btn-default pull-right"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>-->
                        <!---->
                        <!--             </div>-->
                    </div>

                </div>



            </div>
            <div class="btn-group-horizontal" style="position: relative;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_det"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></button>

            </div>
            <div style="position: relative;" class="borde">


                <div class="row">
                    <div class='wrapper text-center'>

                    </div>

                    <table class="table table-bordered">
                        <thead>
                        <tr>

                            <th>Articulo</th>
                            <th width="250px">Fecha Vencimiento</th>
                            <th width="70px">Cantidad</th>
                            <th width="70px">Precio Compra</th>
                            <th width="70px">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <ul id="pagination" class="pagination-sm"></ul>
                </div>

            </div>

        </div>

        <div class="modal fade" id="add_det" tabindex="-1" role="dialog" aria-labelledby="myModalLabl">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Detalle Articulo</h4>
                    </div>

                    <div class="modal-body">
                        <div data-toggle="validator" >

                            <div class="form-group">
                                <label class="control-label" for="cuenta_cod">Articulo:</label>
                                <input type="text" name="cuenta_cod" id="cuenta_cod" class="form-control"  />
                                <div class="help-block with-errors"></div>
                                <input type="hidden" name="id_cuenta_auto" id="id_cuenta_auto"></input>


                            </div>

                            <div class="form-group">
                                <label class="control-label" for="glosa_detalle">Cantidad:</label>
                                <input type="text" name="glosa_detalle" id="glosa_detalle" class="form-control" >
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="debe_detalle">Precio Compra:</label>
                                <input type="number" name="debe_detalle"  id="debe_detalle" class="form-control" >
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="haber_detalle">Fecha Vencimiento:</label>
                                <input type="number" name="haber_detalle"  id="haber_detalle" class="form-control" >
                                <div class="help-block with-errors"></div>
                                <input type="hidden" name="conteo" id="conteo">
                            </div>


                            <div class="form-group">
                                <button id="addToTable" type="button" class="btn crud-submit btn-success ">Agregar</button>
                            </div>



                        </div>
                    </div>

                </div>

            </div>
        </div>
    </form>
</div>
<script language="javascript">
    var i_detalle = 1;
    $('#addToTable').click(function() {
        var codigo = $('#cuenta_cod').val();
        var glosa = $('#glosa_detalle').val();
        var debe = $('#debe_detalle').val();
        var haber = $('#haber_detalle').val();
        var id_detallecuenta = $('#id_cuenta_auto').val();

        var	rows = '';

        rows = rows + '<tr id="'+i_detalle+'">';
        rows = rows + '<td>'+codigo+'</td>';

        rows = rows + '<td><input type="hidden" id="glosa'+i_detalle+'" name="glosa'+i_detalle+'" value="'+glosa+'">'+glosa+'</input></td>';
        rows = rows + '<td><input type="hidden" id="debe'+i_detalle+'" name="debe'+i_detalle+'" value="'+debe+'">'+debe+'</input></td>';
        rows = rows + '<td><input type="hidden" id="haber'+i_detalle+'" name="haber'+i_detalle+'" value="'+haber+'">'+haber+'</input></td>';

        rows = rows + '<td id="'+id_detallecuenta+'"><input type="hidden" id="id_detalle'+i_detalle+'" name="id_detalle'+i_detalle+'" value="'+id_detallecuenta+'"></input>';

        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';


        //$("tbody").html(rows);
        $('table tbody').append(rows);
        $('#conteo').val(i_detalle);
        i_detalle++;
        $('#add_det').modal('hide');
        $('#cuenta_cod').val('');
        $('#glosa_detalle').val('');
        $('#debe_detalle').val('');
        $('#haber_detalle').val('');
        $('#id_cuenta_auto').val('');



    });
    var array_auto =  <?php echo json_encode($data); ?>;
    $(document).ready(function () {

        capturar_com();

        ocultar_div();
        $("#buscar").click( function()
            {
                buscar();
            }
        );
        $("#nuevo_com").click( function()
            {
                nuevo();
            }
        );
        $("#af").click( function()
            {
                updateResult();
                disable();
            }
        );
        $("#be").click( function()
            {
                downResult();
                disable();
            }
        );
        $("#first").click( function()
            {
                capturar_com();
                disable();
            }
        ); $("#last").click( function()
            {
                upResult();
                disable();
            }
        );
        $("#crea").click(function(){
            agregar();
        });
    });
    function ocultar_div(){
        $("#div_tipose").hide();
        $("#div_monedase").hide();
        $("#div_estadose").hide();
        $("#div_cambiose").hide();

    }function mostrar_div(){
        $("#div_tipose").show();
        $("#div_monedase").show();
        $("#div_estadose").show();
        $("#div_cambiose").show();
        ocultar_input();

    }
    function mostrar_input(){
        $("#div_tipoin").show();
        $("#div_monedain").show();
        $("#div_estadoin").show();
        $("#div_cambioin").show();

    }
    function ocultar_input(){
        $("#div_tipoin").hide();
        $("#div_monedain").hide();
        $("#div_estadoin").hide();
        $("#div_cambioin").hide();

    }
    function buscar(){
//             var f = $('#serie').val();
        var f = parseInt($('#buscar_serie').val());


        if(f>0)
        {


            $.ajax({
                type: "POST",
                url: "buscar_serie.php",
                data: 'dato='+f,
                dataType: "json",
                cache: false,
                success: function(data){

                    if(data['result']=='1') {
                        $("#serie").val(data['serie']);
                        $("#fecha").val(data['fecha']);
                        $("#glosa").val(data['glosa']);
                        $("#tipo_comprobante").val(data['tipocom']);
                        $("#tipo_cambio").val(data['cambio']);
                        $("#moneda").val(data['moneda']);
                        $("#estado").val(data['estado']);
                        detalle(data['id']);
                    }else
                    {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error('Serie no encontrada');


                    }
                },
                error: function(){

                }
            });
        }else{
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Ingrese un número válido');

        }

    }
    function disable(){
        $("#static").find("input[id='fecha']").prop('disabled', true);
        $("#static").find("input[id='glosa']").prop('disabled', true);

        ocultar_div();
        mostrar_input();

    }
    function nuevo(){
        $("#static").find("input[id='serie']").val("");
        $("#static").find("input[id='fecha']").val("");
        $("#static").find("input[id='glosa']").val("");
        mostrar_div();

        $("#static").find("input[id='fecha']").prop('disabled', false);
        $("#static").find("input[id='glosa']").prop('disabled', false);

        $('tbody').empty();

        $.ajax({
            dataType: 'json',
            type:'POST',
            url:  'serie_get.php',
            cache: false



        }).done(function(data){


            $("#static").find("input[id='serie']").val(data);


        });



    };
    function agregar(){

        var datastring = $("#static").serialize();
        var form_action = $("#static").attr("action");

//donde carajo le meto el for each para cada fila



        $.ajax({
            dataType: 'json',
            type:'POST',
            url:  form_action,
            cache: false,
            data:
            datastring,

        }).done(function(data){


            $("#static").find("input[id='serie']").val(data.serie);
            $("#static").find("input[id='fecha']").val(data.fecha);
            $("#static").find("input[id='glosa']").val(data.glosa);
            $("#static").find("input[id='tipo_comprobante']").val(data.tipocom);
            $("#static").find("input[id='tipo_cambio']").val(data.cambio);
            $("#static").find("input[id='moneda']").val(data.moneda);
            $("#static").find("input[id='estado']").val(data.estado);



            upResult();
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('Datos ingresados Correctamente');

        });


    };

    function updateResult(){
//             var f = $('#serie').val();
        var f = parseInt($('#serie').val());
        f=f+1;

        if(f>0)
        {


            $.ajax({
                type: "POST",
                url: "comproc.php",
                data: 'dato='+f,
                dataType: "json",
                cache: false,
                success: function(data){
                    $("#serie").val(data['serie']);
                    $("#fecha").val(data['fecha']);
                    $("#glosa").val(data['glosa']);
                    $("#tipo_comprobante").val(data['tipocom']);
                    $("#tipo_cambio").val(data['cambio']);
                    $("#moneda").val(data['moneda']);
                    $("#estado").val(data['estado']);
                    detalle(data['id']);

                }
            });
        }
    }

    function upResult(){
        var data;
        $.ajax({
            dataType: "json",
            url: 'comprob.php',
            data: data,
            success: function (data) {

                $("#serie").val(data['serie']);
                $("#fecha").val(data['fecha']);
                $("#glosa").val(data['glosa']);
                $("#tipo_comprobante").val(data['tipocom']);
                $("#tipo_cambio").val(data['cambio']);
                $("#moneda").val(data['moneda']);
                $("#estado").val(data['estado']);

                detalle2(data['id']);

            }
        });
    }
    function downResult(){
//             var f = $('#serie').val();
        var f = parseInt($('#serie').val());
        f=f-1;

        if(f>0)
        {


            $.ajax({
                type: "POST",
                url: "comproc.php",
                data: 'dato='+f,
                dataType: "json",
                cache: false,
                success: function(data){
                    $("#serie").val(data['serie']);
                    $("#fecha").val(data['fecha']);
                    $("#glosa").val(data['glosa']);
                    $("#tipo_comprobante").val(data['tipocom']);
                    $("#tipo_cambio").val(data['cambio']);
                    $("#moneda").val(data['moneda']);
                    $("#estado").val(data['estado']);
                    detalle3(data['id']);

                }
            });
        }
    }



    function capturar_com() {
        var data;
        var yo;
        $.ajax({
            dataType: "json",
            url: 'comprobanteregister.php',
            data: data,
            success: function (data) {


                $("#serie").val(data['serie']);
                $("#fecha").val(data['fecha']);
                $("#glosa").val(data['glosa']);
                $("#tipo_comprobante").val(data['tipocom']);
                $("#tipo_cambio").val(data['cambio']);
                $("#moneda").val(data['moneda']);
                $("#estado").val(data['estado']);

                detalle4(data['id']);


            }
        });


    }
    function detalle(a) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: 'detalle_get.php',
            data: 'dato=' + a,
            cache: false,
            beforeSend: function(){
                jQuery('tbody').html('');

            },
            success: function (yo) {
                manageRow(yo.data);
            }
        });
    }
    function detalle2(a) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: 'detalle_get2.php',
            data: 'dato=' + a,
            cache: false,
            beforeSend: function(){
                jQuery('tbody').html('');

            },
            success: function (yo) {
                manageRow2(yo.data);


            }
        });
    }
    function detalle3(a) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: 'detalle_get3.php',
            data: 'dato=' + a,
            cache: false,
            beforeSend: function(){
                jQuery('tbody').html('');

            },
            success: function (yo) {
                manageRow3(yo.data);


            }
        });
    }
    function detalle4(a) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: 'detalle_get4.php',
            data: 'dato=' + a,
            cache: false,
            beforeSend: function(){
                jQuery('tbody').html('');

            },
            success: function (yo) {
                manageRow4(yo.data);

            }
        });
    }
    function manageRow(data) {
        var	rows = '';
        $.each( data, function( key, value ) {
            rows = rows + '<tr>';
            rows = rows + '<td>'+value.codigo+' - '+value.text+'</td>';

            rows = rows + '<td>'+value.glosa+'</td>';
            rows = rows + '<td>'+value.debe+'</td>';
            rows = rows + '<td>'+value.haber+'</td>';

            rows = rows + '<td data-id="'+value.id+'">';

            rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        });

        $("tbody").html(rows);

    }
    function manageRow2(data) {
        var	rows = '';
        $.each( data, function( key, value ) {
            rows = rows + '<tr>';
            rows = rows + '<td>'+value.codigo+' - '+value.text+'</td>';

            rows = rows + '<td>'+value.glosa+'</td>';
            rows = rows + '<td>'+value.debe+'</td>';
            rows = rows + '<td>'+value.haber+'</td>';

            rows = rows + '<td data-id="'+value.id+'">';

            rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        });

        $("tbody").html(rows);
    }
    function manageRow3(data) {
        var	rows = '';
        $.each( data, function( key, value ) {
            rows = rows + '<tr>';
            rows = rows + '<td>'+value.codigo+' - '+value.text+'</td>';

            rows = rows + '<td>'+value.glosa+'</td>';
            rows = rows + '<td>'+value.debe+'</td>';
            rows = rows + '<td>'+value.haber+'</td>';

            rows = rows + '<td data-id="'+value.id+'">';

            rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        });

        $("tbody").html(rows);

    }
    function manageRow4(data) {
        var	rows = '';
        $.each( data, function( key, value ) {
            rows = rows + '<tr>';
            rows = rows + '<td>'+value.codigo+' - '+value.text+'</td>';

            rows = rows + '<td>'+value.glosa+'</td>';
            rows = rows + '<td>'+value.debe+'</td>';
            rows = rows + '<td>'+value.haber+'</td>';

            rows = rows + '<td data-id="'+value.id+'">';

            rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        });

        $("tbody").html(rows);

    }
    $("body").on("click",".remove-item",function(){
        var id = $(this).parent("td").data('id');
        var c_obj = $(this).parents("tr");

        $.ajax({
            dataType: 'json',
            type:'POST',
            url:  'api/delete.php',
            data:{id:id}
        }).done(function(data){
            c_obj.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            getPageData();
        });

    });
    $(function() {

        $('#cuenta_cod').autocomplete({
            source: array_auto,
            change: function (event, ui) {


                $("#id_cuenta_auto").val(ui.item.id);
                return false;
            } });
    });

</script>

<script> //date picker js
    $(document).ready(function() {
        $('.datepicker').datepicker({
            todayHighlight: true,
            "autoclose": true,
            format: 'dd-mm-yyyy'
        });
    });
    //input puede que funciones

</script>
<script type="text/javascript" src="js/alertify.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>

</body>

</html>
