<?php
include_once('bar.php');

include_once('conexion.php');
date_default_timezone_set('America/La_Paz');
$id_ges=$_GET['id'];
$link = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);


$query_user = sprintf("SELECT
             u.*



						 FROM
             gestion u
 						 WHERE
						 u.id=$id_ges


						 ");
$link->set_charset("utf8");
$result_user = mysqli_query($link,$query_user) or die("Error usu:".mysqli_error($link));
$row2 = mysqli_fetch_array($result_user);


$_SESSION['id_ges']=$id_ges;
$finicio = str_replace('-', '/', $row2["fecha_inicio"]);
$row2["fecha_inicio"] = date('d/m/Y', strtotime($finicio));
$finicio = str_replace('-', '/', $row2["fecha_fin"]);
$row2["fecha_fin"] = date('d/m/Y', strtotime($finicio));


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
//Validar tamaño y tipo de dato según la BD
//No pueden Existir 2 periodos con el mismo nombre para la misma gestion
//Fecha Inicio debe ser menor a la fecha Fin
//Las fechas tienen que estar dentro del rango de fechas de la gestion a la que pertenece
//Validar solapamiento de Periodos. Las fechas no se deben superponer.
//Al crear el estado se crea abierto.
//No se pueden modificar los datos de un periodo cerrado
//Se podrá eliminar de la BD siempre que no este relacionado
//Solo debería ver los periodos de la gestión seleccionada.

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


<div  style ="height: 100px;margin:auto; margin-left:150px">
    <p class="text-center " style="margin-top: 20px;"><font size="6"> <?php echo $row2['nombre'].' del '.$row2['fecha_inicio'].' al '.$row2['fecha_fin'];
            ?></font> </p>
</div>
<div  style="margin-left:150px">

    <div id="Productos" style="width: 60%;margin:auto"></div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#Productos').jtable({
            title: 'Periodos',
            messages: {
                addNewRecord: 'Nuevo Periodo'
            },
            toolbar: {
                hoverAnimation: true,
                hoverAnimationDuration: 60,
                hoverAnimationEasing: undefined,
                items: [{
                    icon: 'css/s.png',
                    tooltip: 'Imprimir',
                    text: 'Reportes',
                    click: function () {
                        window.open("periodos/index.php", 'mywin',
                            'left=150,top=1000,width=1000,height=600,toolbar=1,resizable=0'); return false;
                    }
                }]
            },
            actions: {
                //READ
                listAction: 'periodos.php?accion=listar',
                //CREATE
                createAction: 'periodos.php?accion=crear',
                //UPDATE
                updateAction: 'periodos.php?accion=actualizar',
                //DELETE
                deleteAction: 'periodos.php?accion=eliminar'
            },
            fields: {
                id: {
                    title: 'Id Periodo',
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },
                nombre: {
                    title: 'Nombre',
                    width: '20%',
                    create: true,
                    edit: true,
                    list: true
                },
                fecha_inicio: {
                    title: 'Fecha de Inicio',
                    width: '20%',
                    type: 'date',
                    displayFormat: 'dd/mm/yy',
                    create: true,
                    edit: true,
                    list: true

                },
                fecha_fin: {
                    title: 'Fecha de Fin',
                    width: '20%',
                    type: 'date',
                    displayFormat: 'dd/mm/yy',
                    create: true,
                    edit: true,
                    list: true
                },
                estado: {
                    title: 'Estado',
                    width: '20%',
                    create: false,
                    edit: false,
                    list: true,
                    options: { 0: 'Cerrado', 1: 'Abierto' }
                },



            },
            //Initialize validation logic when a form is created
            formCreated: function (event, data) {
                data.form.find('input[name="nombre"]').addClass('validate[required] yo');
                data.form.find('input[name="fecha_inicio"]').addClass('validate[required] yo');
                data.form.find('input[name="fecha_fin"]').addClass('validate[required] yo');

                data.form.find('input[name="estado"]').addClass('validate[required] yo');


                data.form.validationEngine();
                data.form.css('width','300px');
                data.form.parent().dialog("option", "resizable", false);
                data.form.parent().dialog("option", "modal", true);
                data.form.parent().dialog("option", "draggable", false);

            },
            //Validate form when it is being submitted
            formSubmitting: function (event, data) {
                return data.form.validationEngine('validate');
            },
            rowInserted: function(event, data){
                if (data.record.estado == 0){
                    data.row.find('.jtable-edit-command-button').hide();
                    //data.row.find('.jtable-delete-command-button').hide();
                }

            },
            rowUpdated: function(event, data){
                if (data.record.estado == 0){
                    data.row.find('.jtable-edit-command-button').hide();
                    //data.row.find('.jtable-delete-command-button').hide();
                }
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
