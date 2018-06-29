<?php
include_once('bar.php');
include_once('conexion.php');
date_default_timezone_set('America/La_Paz');
$id_lot=$_GET['id'];
$_SESSION['id_lot']=$id_lot;

$link = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);


// $query_user = sprintf("SELECT
//              u.correo,
// 						 u.razon_social,
// 						 u.sigla,
// 						 u.direccion,
// 						 u.nit,
// 						 u.nivel
//
//
//
// 						 FROM
//              empresa u
//  						 WHERE
// 						 u.id=$id_emp
//
//
// 						 ");
// $link->set_charset("utf8");
// $result_user = mysqli_query($link,$query_user) or die("Error usu:".mysqli_error($link));
// $row2 = mysqli_fetch_array($result_user);
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
    </style>
  </head>
  <body>



<div class="container" style="padding-top: 100px">
    <div id="Productos" style="width: 60%;margin:auto"></div>
    <?php echo $_SESSION['id_lot']; ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#Productos').jtable({
            title: 'Lotes',

            actions: {
                //READ
                listAction: 'lotesabm.php?accion=listar'
                //CREATE

            },
            fields: {
                id: {
                    title: 'Id Producto',
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },
                nro_lote: {
                    title: 'Número',
                    width: '20%',
                    create: false,
                    edit: false,
                    list: true
                },
                fecha_ing: {
                    title: 'Fecha de Ingreso',
                    width: '20%',
                    type: 'date',
                    displayFormat: 'dd/mm/yy',
                    create: true,
                    edit: true,
                    list: true

                },
                fecha_ven: {
                    title: 'Fecha de Vencimiento',
                    width: '20%',
                    type: 'date',
                    displayFormat: 'dd/mm/yy',
                    create: true,
                    edit: true,
                    list: true
                },
                cantidad: {
                    title: 'Cantidad',
                    width: '20%',
                    create: true,
                    edit: true,
                    list: true
                },
                precio_compra: {
                    title: 'Precio de Compra',
                    width: '20%',
                    create: true,
                    edit: true,
                    list: true
                },


            },
            //Initialize validation logic when a form is created
            formCreated: function (event, data) {
                data.form.find('input[name="nombre"]').addClass('validate[required]');
                data.form.find('input[name="fecha_inicio"]').addClass('validate[required]');
                data.form.find('input[name="fecha_fin"]').addClass('validate[required]');

                data.form.find('input[name="estado"]').addClass('validate[required]');


                data.form.validationEngine();
                data.form.css('width','300px');


            },
            //Validate form when it is being submitted
            formSubmitting: function (event, data) {
                return data.form.validationEngine('validate');
            },
            //Dispose validation logic when form is closed
            formClosed: function (event, data) {
                data.form.validationEngine('hide');
                data.form.validationEngine('detach');
            }
        });

        //Load person list from server
        $('#Productos').jtable('load');

    });

</script>
</body>
</html>
