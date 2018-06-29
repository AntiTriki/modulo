<?php
session_name('nilds');
session_start();
include_once('bars.php');
include_once('conexion.php');
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
$query = $db->query("SELECT * FROM articulo where id_empresa=".$_SESSION['id_emp']." ");
$data = array();
while ($row = $query->fetch_assoc()) {

    array_push($data, array('label'=> $row['nombre'], 'value' => $row['nombre'], 'id'=>$row['id'], 'precio'=>$row['precio_venta'] ));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Compra</title>
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
        #footer {
            position:absolute;
            left:0px;
            bottom:0px;
            height:30px;
            width:100%;
            background:#999;
        }
        /* IE 6 */
    </style>
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/alertify.min.css">
    <link rel="stylesheet" href="css/default.min.css">
</head>
<body>
<div id="crea_com">
    <form id="static" class="" role="form" method="post" action="notac_crear.php" enctype="multipart/form-data">
        <div class="container-fluid" style="padding-left: 250px">

            <div class="btn-group-horizontal" style="position: inherit;">
               <div id="btnd" style="width: 400px;position: fixed">
                <button type="button" id="nuevo_com" class="btn btn-" ><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></button>
                <button type="button" id="eliminar_com" class="btn btn-"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>

               </div>
                <div id="btnc" style="position: fixed">
                    <button type="button" id="cancelar" class="btn btn-danger" style="height: 30px">Cancelar</button>
                </div>
                <div  style="width: 100px;margin-left: 820px;position: inherit">
                   <button type="button" disabled id="crea" class="btn btn-success " style="height: 30px" >Crear</button>
                </div>
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
                            <input name="idc" type="hidden" class="" id="idc">
                        </div>
                    </div>
                    <div  class="col-sm-2 col-lg-6">
                        <div class="form-group">
                            <label for="tipo_comprobante">Descripcion:</label>
                            <input  disabled type="text" class="form-control" id="glosa" name="glosa" >
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

                        <!--                 <div class="btn-group btn-group-lg pull-right" role="group" aria-label="...">-->
                        <!--                 <button name="" type="button" class="btn btn-default pull-right"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>-->
                        <!---->
                        <!--             </div>-->
                    </div>

                </div>
            </div>
            <div class="btn-group-horizontal" style="position: relative;">
                <button type="button" id="add_deta" disabled class="btn btn-primary" data-toggle="modal" data-target="#add_det"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></button>

            </div>
            <div style="position: relative;   " class="borde">


                <div class="row" style="position: relative; height:40%;overflow: auto;" >
                    <div class='wrapper text-center'>

                    </div>

                    <table id="tabla" class="table table-bordered">
                        <thead>
                        <tr>

                            <th width="120px">Articulo</th>

                            <th width="70px">Cantidad</th>
                            <th width="70px">Precio Compra</th>
                            <th width="70px">SubTotal</th>
                            <th width="90px">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div id ="footer">
                    <div style="margin-left: 560px">
                        TOTAL:
                        <input style="width: 70px"  class ="" id="habtotal" type="text">

                    </div>
                </div>
                <ul id="pagination" class="pagination-sm"></ul>




            </div>

            <div class="modal fade" id="add_det" tabindex="-1" role="dialog" aria-labelledby="myModalLabl">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle Nota</h4>
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
                                    <label class="control-label" for="debe_detalle">Cantidad:</label>

                                    <input onchange="precios()" type="number" step="0.01" name="debe_detalle"  id="debe_detalle" class="form-control" >
                                    <input type="hidden" sname="precioar"  id="precioar" >



                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="haber_detalle">Precio:</label>
                                    <input type="number" step="0.01" name="haber_detalle"  id="haber_detalle" class="form-control" >
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

    $('#add_det').on('hidden.bs.modal', function () {
        $('#cuenta_cod').val('');

        $('#debe_detalle').val('');
        $('#haber_detalle').val('');
        $('#id_cuenta_auto').val('');
    });



    var array_auto =  <?php echo json_encode($data); ?>;
    var array_original = array_auto;
    var array_save =[];
    array_save[0] = array_auto.slice(0);
    var i_detalle = 1;
    var ai=1;
    Array.prototype.removeValue = function(id, value){
        var array = $.map(this, function(v,i){
            return v[id] === value ? null : v;
        });

        this.length = 0; //clear original array
        this.push.apply(this, array); //push all elements except the one we want to delete
    }
    $(function() {
        $('#cuenta_cod').autocomplete({
            source: array_auto,
            change: function (event, ui) {
                $("#id_cuenta_auto").val(ui.item.id);

               // return false;
            } });
    });
    function precios()
    {
        var m1 = document.getElementById("debe_detalle").value;
        var m2 = document.getElementById("precioar").value;
        //document.getElementById('subtotal2').value = m1*m2;
        document.getElementById('haber_detalle').innerHTML = m1 * m2;
    }
    function indexOfId(array, id) {
        for (var i=0; i<array.length; i++) {
            if (array[i].id==id) return i;
        }
        return -1;
    }
    $('#addToTable').click(function() {
        if($('#id_cuenta_auto').val()==''){
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('Debe ingresar un articulo válido');

        }else {
            if($('#glosa_detalle').val()=='') {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error('Debe llenar la glosa correctamente');


            } else
                {
                    if($('#debe_detalle').val()=='' && $('#haber_detalle').val()==''){
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error('Debe ingresar algun monto');

                    }
                    else{
                    var codigo = $('#cuenta_cod').val();
                    var glosa = $('#glosa_detalle').val();
                    var debe = $('#debe_detalle').val();
                    var haber = $('#haber_detalle').val();
                    var id_detallecuenta = $('#id_cuenta_auto').val();
                    var rows = '';

                    array_save[ai] = array_auto.slice(0);



                    array_auto.removeValue('id', id_detallecuenta);

                    rows = rows + '<tr id="' + i_detalle + '">';
                    rows = rows + '<td>' + codigo + '</td>';
                        rows = rows + '<td class= "co"><input type="hidden" id="debe'+i_detalle+'" name="debe'+i_detalle+'" value="'+debe+'">'+debe+'</input></td>';
                        rows = rows + '<td class= "co"><input type="hidden" id="haber'+i_detalle+'" name="haber'+i_detalle+'" value="'+haber+'">'+haber+'</input></td>';
                        rows = rows + '<td class= "colh"><input type="hidden" id="sub'+i_detalle+'" name="sub'+i_detalle+'" value="'+debe*haber+'">'+debe*haber+'</input></td>';

                        rows = rows + '<td id="'+id_detallecuenta+'"><input type="hidden" id="id_detalle'+i_detalle+'" name="id_detalle'+i_detalle+'" value="'+id_detallecuenta+'"></input>';

                        rows = rows + '<button onclick="deleteRow(this)" class="btn btn-danger ">Delete</button>';

                    rows = rows + '</td>';
                    rows = rows + '</tr>';
                    //$("tbody").html(rows);
                    $('table tbody').append(rows);
                    $('#conteo').val(i_detalle);
                    i_detalle++;
                    ai++;
                    $('#add_det').modal('hide');
                    $('#cuenta_cod').val('');


                    $('#debe_detalle').val('');
                    $('#haber_detalle').val('');
                    $('#debe_detalle').prop('disabled', false);
                    ;
                    $('#haber_detalle').prop('disabled', false);
                    ;
                    $('#id_cuenta_auto').val('');
                    suma();
                }
            }
        }
    });
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        ai--;
        i_detalle--;
        array_auto = array_save[ai];

        $('#cuenta_cod').autocomplete("option", { source: array_auto });
        suma();
    }
    var getSum = function () {
        var sum = 0;
        var selector = '.cold' ;
        $('#tabla').find(selector).each(function (index, element) {
            sum += parseFloat($(element).text());
        });
        return Math.round(sum * 1e2) / 1e2  ;
    };
    var getSuma = function () {
        var suma = 0;
        var selector = '.colh' ;
        $('#tabla').find(selector).each(function (index, element) {
            suma += parseFloat($(element).text());
        });
        return Math.round(suma * 1e2) / 1e2  ;
    };
    function suma(){
        $('#debtotal').each(function (index, element) {
            $(this).val(getSum());
        });
        $('#habtotal').each(function (index, element) {
            $(this).val(getSuma());
        });
    }
    function today() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10) {
            dd = '0'+dd
        }
        if(mm<10) {
            mm = '0'+mm
        }
        today = dd + '-' + mm + '-' + yyyy;
        $("#static").find("input[id='fecha']").val(today);
    }


    $(document).ready(function () {



        capturar_com();
        ocultar_div();



        $("#nuevo_com").click( function()
            {
                nuevo();

            }
        );
        $("#eliminar_com").click( function()
            {
                anular();
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
        $("#cancelar").click( function()
            {
                downResult();
                disable();
                array_auto = array_original;
                i_detalle=1;
                ai=1;
                $('#cuenta_cod').autocomplete("option", { source: array_auto });
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
        $("#rep").click( function()
            {
                $.ajax({
                    dataType: 'json',
                    type:'POST',
                    url:  'mayor.php',
                    cache: false
                }).done(function(data){
                    window.open("libro_mayor/index.php", 'mywin',
                        'left=150,top=1000,width=1000,height=600,toolbar=1,resizable=0');
                });
            }
        );
        $("#repd").click( function()
            {
                $.ajax({
                    type: "POST",
                    url: "mayord.php",

                    dataType: "json",
                    cache: false,
                    success: function(e){
                        e.preventDefault(); window.open("libro_mayord/index.php", 'mywin',
                            'left=150,top=1000,width=1000,height=600,toolbar=1,resizable=0');  return false;
                        },
                    error: function(){
                    }
                });
            }
        );
        $("#red").click( function()
            {
                $.ajax({
                    dataType: 'json',
                    type:'POST',
                    url:  'diario.php',
                    cache: false
                }).done(function(data){
                    window.open("libro_diario/index.php", 'mywin',
                        'left=150,top=1000,width=1000,height=600,toolbar=1,resizable=0');
                });
            }
        );
    });
    function ocultar_div(){
        $("#div_tipose").hide();
        $("#div_monedase").hide();
        $("#div_estadose").hide();
        $("#div_cambiose").hide();
        $("#btnc").hide();

    }function mostrar_div(){
        $("#div_tipose").show();
        $("#div_monedase").show();
        $("#div_estadose").show();
        $("#div_cambiose").show();
        $("#btnc").show();
        ocultar_input();
    }
    function mostrar_input(){
        $("#div_tipoin").show();
        $("#div_monedain").show();
        $("#div_estadoin").show();
        $("#div_cambioin").show();
        $("#btnd").show();
    }
    function ocultar_input(){

        $("#div_tipoin").hide();
        $("#btnd").hide();
        $("#div_monedain").hide();
        $("#div_estadoin").hide();
        $("#div_cambioin").hide();
    }

    function disable(){
        $("#static").find("input[id='fecha']").prop('disabled', true);
        $("#static").find("input[id='glosa']").prop('disabled', true);
        $('#crea').prop('disabled', true);
        $('#add_deta').prop('disabled', true);
        $('#first').prop('disabled', false);
        $('#last').prop('disabled', false);
        $('#af').prop('disabled', false);
        $('#be').prop('disabled', false);
        $('#buscar_serie').prop('disabled', false);
        $('#buscar').prop('disabled', false);
        ocultar_div();
        mostrar_input();
    }
    function nuevo(){
        $('#add_deta').prop('disabled', false);
        $('#crea').prop('disabled', false);
        $('#first').prop('disabled', true);
        $('#last').prop('disabled', true);
        $('#af').prop('disabled', true);
        $('#buscar_serie').prop('disabled', true);
        $('#buscar').prop('disabled', true);
        $('#be').prop('disabled', true);
        $("#static").find("input[id='serie']").val("");
        $("#static").find("input[id='fecha']").val("");
        $("#static").find("input[id='glosa']").val("");
        $("#debtotal").val("");
        $("#habtotal").val("");

        mostrar_div();
        $("#static").find("input[id='fecha']").prop('disabled', false);
        $("#static").find("input[id='glosa']").prop('disabled', false);
        array_auto=array_original;
        today();
        $('tbody').empty();
        $.ajax({
            dataType: 'json',
            type:'POST',
            url:  'serienc_get.php',
            cache: false
        }).done(function(data){
            $("#static").find("input[id='serie']").val(data);
        });
    };
    function anular() {
        var ef = parseInt($('#idc').val());

        array_auto = array_original;

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: 'anularn.php',
            cache: false,
            data: 'id=' + ef,
            success: function (){
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('yo');

            },
            error: function () {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success('Nota Anulada');

            }
        });
    };
    function agregar(){


            var datastring = $("#static").serialize();
            var form_action = $("#static").attr("action");
//donde carajo le meto el for each para cada fila


                if ($('#glosa').val() != '') {
                    if (i_detalle > 0) {


                            $.ajax({
                                dataType: 'json',
                                type: 'POST',
                                url: form_action,
                                cache: false,
                                data: datastring,
                            }).done(function (data) {
                                $("#static").find("input[id='serie']").val(data.serie);
                                $("#static").find("input[id='fecha']").val(data.fecha);
                                $("#static").find("input[id='glosa']").val(data.glosa);
                                $("#static").find("input[id='tipo_comprobante']").val(data.tipocom);
                                $("#static").find("input[id='tipo_cambio']").val(data.cambio);
                                $("#static").find("input[id='moneda']").val(data.moneda);
                                $("#static").find("input[id='estado']").val(data.estado);
                                x='';
                                array_auto = array_save[0];
i_detalle=1;
ai=1;
                                $('#cuenta_cod').autocomplete("option", { source: array_auto });
                                upResult();
                                disable();
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.success('Datos ingresados Correctamente');
                            }).fail(function(data){
                                array_auto = array_save[0];
                                i_detalle=1;
                                ai=1;
                                $('#cuenta_cod').autocomplete("option", { source: array_auto });
                                upResult();
                                disable();
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.success('Datos ingresados Correctamente');
                                });

                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error('Ingrese la cantidad suficiente de Articuloa');
                    }
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('Debe llenar la Descripcion');
                }



    };
    function updateResult(){
//             var f = $('#serie').val();
        var f = parseInt($('#serie').val());
        f=f+1;
        if(f>0)
        {
            $.ajax({
                type: "POST",
                url: "notacc.php",
                data: 'dato='+f,
                dataType: "json",
                cache: false,
                success: function(data){
                    $("#serie").val(data['serie']);
                    $("#fecha").val(data['fecha']);
                    $("#glosa").val(data['glosa']);

                    $("#idc").val(data['id']);
                    detalle(data['id']);
                }
            });
        }
    }
    function upResult(){
        var data;
        $.ajax({
            dataType: "json",
            url: 'notabc.php',
            data: data,
            success: function (data) {

                $("#serie").val(data['serie']);
                $("#fecha").val(data['fecha']);
                $("#glosa").val(data['glosa']);
                $("#idc").val(data['id']);
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
                url: "notacc.php",
                data: 'dato='+f,
                dataType: "json",
                cache: false,
                success: function(data){
                    $("#serie").val(data['serie']);
                    $("#fecha").val(data['fecha']);
                    $("#glosa").val(data['glosa']);

                    $("#idc").val(data['id']);
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
            url: 'notaregisterc.php',
            data: data,
            success: function (data) {
                $("#serie").val(data['serie']);
                $("#fecha").val(data['fecha']);
                $("#glosa").val(data['glosa']);
                $("#idc").val(data['id']);
                detalle4(data['id']);
            }
        });
    }
    function detalle(a) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: 'detallenc_get2.php',
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
            url: 'detallenc_get2.php',
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
            url: 'detallenc_get2.php',
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
            url: 'detallenc_get2.php',
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
        var h=0;
        var d=0;
        $.each( data, function( key, value ) {
            rows = rows + '<tr>';
            rows = rows + '<td>'+value.codigo+' </td>';


            rows = rows + '<td>'+value.debe+'</td>';
            rows = rows + '<td>'+value.haber+'</td>';
            rows = rows + '<td class= "colh">'+value.debe*value.haber+'</td>';


            rows = rows + '<td data-id="'+value.id+'">';
            rows = rows + '<button disabled class="btn btn-danger ">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
            h=h+parseFloat(value.haber)*parseFloat(value.debe);
        });
        $("tbody").html(rows);
        $("#habtotal").val(h);
    }
    function manageRow2(data) {
        var	rows = '';
        var h=0;
        var d=0;
        $.each( data, function( key, value ) {
            rows = rows + '<tr>';
            rows = rows + '<td>'+value.codigo+' </td>';


            rows = rows + '<td>'+value.debe+'</td>';
            rows = rows + '<td>'+value.haber+'</td>';
            rows = rows + '<td class= "colh">'+value.debe*value.haber+'</td>';
            rows = rows + '<td data-id="'+value.id+'">';
            rows = rows + '<button disabled class="btn btn-danger ">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
            h=h+parseFloat(value.haber)*parseFloat(value.debe);
        });
        $("tbody").html(rows);
        $("#debtotal").val(d);
        $("#habtotal").val(h);
    }
    function manageRow3(data) {
        var	rows = '';
        var h=0;
        var d=0;
        $.each( data, function( key, value ) {
            rows = rows + '<tr>';
            rows = rows + '<td>'+value.codigo+' </td>';


            rows = rows + '<td>'+value.debe+'</td>';
            rows = rows + '<td>'+value.haber+'</td>';
            rows = rows + '<td class= "colh">'+value.debe*value.haber+'</td>';
            rows = rows + '<td data-id="'+value.id+'">';
            rows = rows + '<button disabled class="btn btn-danger ">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';

            h=h+parseFloat(value.haber)*parseFloat(value.debe);
        });
        $("tbody").html(rows);
        $("#debtotal").val(d);
        $("#habtotal").val(h);
    }
    function manageRow4(data) {
        var	rows = '';
        var h=0;
        var d=0;
        $.each( data, function( key, value ) {
            rows = rows + '<tr>';
            rows = rows + '<td>'+value.codigo+' </td>';


            rows = rows + '<td>'+value.debe+'</td>';
            rows = rows + '<td>'+value.haber+'</td>';
            rows = rows + '<td class= "colh">'+value.debe*value.haber+'</td>';
            rows = rows + '<td data-id="'+value.id+'">';
            rows = rows + '<button disabled class="btn btn-danger ">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
            h=h+parseFloat(value.haber)*parseFloat(value.debe);
        });
        $("tbody").html(rows);
        $("#debtotal").val(d);
        $("#habtotal").val(h);
    }


</script>
<script> //date picker js
    $(document).ready(function() {
        $('.datepicker').datepicker({
            todayHighlight: true,
            "autoclose": true,
            format: 'dd-mm-yyyy'
        }).on('changeDate', function() {

           confirmar_fecha();
        });
    });
    //input puede que funciones

</script>
<script type="text/javascript" src="js/alertify.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
</body>
</html>