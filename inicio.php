<?php
session_name('nilds');
session_start();

include_once('conexion.php');



if(isset($_SESSION['id_ges']))
{
    unset($_SESSION['id_ges']);
}
$link = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);



$link->set_charset("utf8");


include_once('bars.php');

date_default_timezone_set('America/La_Paz');



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
      <link rel="stylesheet" href="css/alertify.min.css">
    <style>
        .ui-autocomplete
        {
            z-index: 8000; /
        }
        button, input, optgroup, select, textarea {

            color: #000000;
        }
        #background{
            position:absolute;
            z-index:0;
            background:white;
            display:block;
            min-height:50%;
            min-width:50%;
            color:yellow;
            margin-left: 30%;
            margin-top: 10%;
        }

        #content{
            position:absolute;
            z-index:1;
        }

        #bg-text
        {
            color:lightgrey;
            font-size:120px;
            transform:rotate(300deg);
            -webkit-transform:rotate(300deg);
        }
    </style>
  </head>
 <body>
 <div id="background">
     <p id="bg-text"><?php echo "Bienvenido"; ?></p>
 </div>
 <div class="container">
     <div id="Productos" style="width: 50%;margin:auto"></div>



 </div>
 <script>
     $(document).ready(function () {
         $('#Productos').jtable({
             title: 'Tabla Pacientes',
             paging: false,
             pageSize:5,
             sorting: false,
             defaultSorting: 'id ASC',
             actions: {
                 //READ
                 listAction: 'productos.php?accion=listar',
                 //CREATE
                 createAction: 'productos.php?accion=crear',
                 //UPDATE
                 updateAction: 'productos.php?accion=actualizar',
                 //DELETE
                 deleteAction: 'productos.php?accion=eliminar'
             },
             fields: {
                 id: {
                     title: 'Id ',
                     key: true,
                     create: false,
                     edit: false,
                     list: true
                 },
                 nombre: {
                     title: 'Nombre',
                     width: '25%'
                 },
                 ci: {
                     title: 'ci',
                     width: '25%'
                 },
                 telefono: {
                     title: 'Telefono',
                     width: '25%'

                 },
                 direccion: {
                     title: 'Direccion',

                     create: true,
                     edit: true,
                     list: true
                 },

             }
         });

         //Load person list from server
         $('#Productos').jtable('load');

     });

     function agregar(){


         var datastring = $("#static").serialize();
         var form_action = $("#static").attr("action");
//donde carajo le meto el for each para cada fila



                             $.ajax({
                                 dataType: 'json',
                                 type: 'POST',
                                 url: form_action,
                                 cache: false,
                                 data: datastring,
                             }).done(function (data) {
                                 $('#add_det').modal('hide');

                                 array_auto = array_save[0];
                                 i_detalle=1;
                                 ai=1;

                                 alertify.set('notifier', 'position', 'top-right');
                                 alertify.success('Datos ingresados Correctamente');
                             }).fail(function(data){
                                 array_auto = array_save[0];
                                 i_detalle=1;
                                 ai=1;
                                 $('#cuenta_cod').autocomplete("option", { source: array_auto });

                                 alertify.set('notifier', 'position', 'top-right');
                                 alertify.success('Datos ingresados Correctamente');
                             });



     };



 
     //date picker js
     $(document).ready(function() {
         $('.datepicker').datepicker({
             todayHighlight: true,
             "autoclose": true,
             format: 'dd-mm-yyyy'
         }).on('changeDate', function() {

             confirmar_fecha();
         });
     });
 </script>
 <script type="text/javascript" src="js/alertify.min.js"></script>
 </body>
</html>

