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
            margin-left: 40%;
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
 <div class="modal fade" id="add_det" tabindex="-1" role="dialog" aria-labelledby="myModalLabl">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                 <h4 class="modal-title" id="myModalLabel">Detalle Cuenta</h4>
             </div>

             <div class="modal-body">
                 <div data-toggle="validator" >
                     <div class="container">
                         <form id="static" action="conf.php">
                     <div class="row">
                         <div class="col-sm-3 col-lg-3">
                     <div class="form-group">
                         <label class="control-label" for="cuenta_cod">Caja:</label>
                         <input type="text" name="caja_cod" id="caja_cod" class="form-control"  />
                         <div class="help-block with-errors"></div>
                         <input type="hidden" name="caja" id="caja"></input>


                     </div>
                     </div>
                         <div class="col-sm-3 col-lg-3">
                     <div class="form-group">
                         <label class="control-label" for="cuenta_cod">Credito Fiscal:</label>
                         <input type="text" name="cf_cod" id="cf_cod" class="form-control"  />
                         <div class="help-block with-errors"></div>
                         <input type="hidden" name="cf" id="cf"></input>


                     </div>
                     </div>
                     </div>
                         <div class="row">
                             <div class="col-sm-3 col-lg-3">
                     <div class="form-group">
                         <label class="control-label" for="cuenta_cod">Debito Fiscal:</label>
                         <input type="text" name="df_cod" id="df_cod" class="form-control"  />
                         <div class="help-block with-errors"></div>
                         <input type="hidden" name="df" id="df"></input>


                     </div>
                     </div>
                                 <div class="col-sm-3 col-lg-3">
                     <div class="form-group">
                         <label class="control-label" for="cuenta_cod">Compras:</label>
                         <input type="text" name="compras_cod" id="compras_cod" class="form-control"  />
                         <div class="help-block with-errors"></div>
                         <input type="hidden" name="compras" id="compras"></input>


                     </div>
                     </div>
                     </div>
                             <div class="row">
                                 <div class="col-sm-3 col-lg-3">
                     <div class="form-group">
                         <label class="control-label" for="cuenta_cod">Ventas:</label>
                         <input type="text" name="ventas_cod" id="ventas_cod" class="form-control"  />
                         <div class="help-block with-errors"></div>
                         <input type="hidden" name="ventas" id="ventas"></input>


                     </div>
                     </div>
                                 <div class="col-sm-3 col-lg-3">
                     <div class="form-group">
                         <label class="control-label" for="cuenta_cod">IT:</label>
                         <input type="text" name="it_cod" id="it_cod" class="form-control"  />
                         <div class="help-block with-errors"></div>
                         <input type="hidden" name="it" id="it"></input>


                     </div>
                     </div>
                     </div>
                         <div class="row">
                         <div class="col-sm-5 col-lg-5">
                     <div class="form-group">
                         <label class="control-label" for="cuenta_cod">IT por Pagar:</label>
                         <input type="text" name="itxp_cod" id="itxp_cod" class="form-control"  />
                         <div class="help-block with-errors"></div>
                         <input type="hidden" name="itxp" id="itxp"></input>


                     </div>
                     </div>
                     </div>


                     <div class="form-group">
                         <button id="add" type="button" class="btn crud-submit btn-success ">Agregar</button>
                     </div>



                 </div></form>
             </div>
             </div>

         </div>

     </div>
 </div>
 <script>
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

