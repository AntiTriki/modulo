<?php
include_once('bar.php');


if(isset($_SESSION['id_lot'])) {
    unset($_SESSION['id_lot']);
}
?>
<html>
  <head>
<!--  <link href="css/metro/crimson/jtable.css" rel="stylesheet" type="text/css" />
<link href="css/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/family Exo 100 200 400.css">
<link rel="stylesheet" href="css/family Source Sans Pro 700 400 300.css">
    scripts
<script src="js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
<script src="js/jquery.jtable.js" type="text/javascript"></script>
<script src="js/script.js"></script>
<script src="js/jquery.jtable.es.js" type="text/javascript"></script>
<script src="js/prefixfree.min.js" type="text/javascript"></script>-->

	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="js/jquery.jtable.min.js" type="text/javascript"></script>

	<!--<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>-->


    <script src="localization/jquery.jtable.es.js" type="text/javascript"></script>
	<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
	<link href="css/jtable_jqueryui.min.css" rel="stylesheet" type="text/css" />
<!--	<link href="themes\lightcolor\gray\jtable.min.css" rel="stylesheet" type="text/css" />-->
	<link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/mainp2.css">
      <link rel="stylesheet" href="themes\metro\blue\jtable.min.css">
<!--	<link href="Scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />-->
      <style media="screen">
          .ui-dialog, .ui-corner-all, .ui-widget ,.ui-widget-content, .ui-front ,.ui-dialog-buttons, .ui-draggable, .ui-resizable{
              z-index: 1055;
          }
          .profile-img{
              margin-top: -8px;
              margin-right: 5px;
              float: left;
              background: url('<?php echo $_SESSION["logo"]; ?>') 50% 50% no-repeat;
              background-size: auto 100%;
              width: 35px;
              height: 35px;
          }
          a.dropdown-toggle { width: 250px; }
          .navbar-toggle.navbar-left {
              float: left;
              margin-left: 10px;
          }
          html, body {
              height: 100%;
          }

          .navbar-toggle {
              float: left;
              margin-left: 15px;
          }

          .navmenu {
              z-index: 1;
          }

          .canvas {
              position: relative;
              left: 0;
              z-index: 2;
              min-height: 100%;
              padding:  0 0 0;
              background: #fff;
          }

          @media (min-width: 0) {
              .navbar-toggle {
                  display: block; /* force showing the toggle */
              }
          }

          @media (min-width: 992px) {
              body {

              }
              .navbar {


              }
              .canvas {

              }
          }
          .navmenu-fixed-left{
              position: fixed;

              top: 50px;
              bottom: 0;
              overflow-y: auto;
              border-radius: 0;
          }
          button, input, optgroup, select, textarea {

              color: #000000;
          }
      </style>
<!-- Import Javascript files for validation engine (in Head section of HTML) -->
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-es.js"></script>
      <script src="js/bootstrap.min.js" charset="utf-8"></script>

  </head>
  <body>

  <div class="container" style="padding-top: 100px">
      <!-- Trigger the modal with a button -->

      <div id="Productos" style="width: 60%;margin:auto"></div>
  </div>
  <!-- <script>

  </script> -->
	<script type="text/javascript">
    $(document).ready(function () {
        $('#Productos').jtable({
				title: 'Articulos',
            messages: {
                addNewRecord: 'Nuevo Articulo'
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


                        window.open("articulos/index.php", 'mywin',
                            'left=150,top=1000,width=1000,height=600,toolbar=1,resizable=0'); return false;
                    }
                }]
            },
				defaultSorting: 'id ASC',
				actions: {
            //READ
            listAction: 'articulosabm.php?accion=listar',
					//CREATE
					createAction: 'articulosabm.php?accion=crear',
					//UPDATE
					updateAction: 'articulosabm.php?accion=actualizar',
					//DELETE
					deleteAction: 'articulosabm.php?accion=eliminar'
				},
				fields: {
            id: {
                title: 'Id Producto',
						key: true,
						create: false,
						edit: false,
						list: false
					},
            nombre: {
                title: 'Nombre',
						width: '25%'
					},

            descripcion: {
                        title: 'descripcion',
                        create: true,
                        edit: true,
                        list: false
                    },
            cantidad: {
                        title: 'cantidad',
                        create: false,
                        edit: false,
                        list: true
                    },
            id_categoria: {
                title: 'categoria',
                width: '25%',
                create: true,
                edit: true,
                list: true,
                options:'categorialist.php'
            },

                    ShowDetailColumn: {
                        title: 'Lotes',
                        create: false,
                        edit: false,
                        list: true,
                        display: function (data) {
                            return '<a href="lotes.php?id=' + data.record.id + '"><img style="width:20px" src="22.png" /></a>';
                        },
                        width: '2%'
                    },

        },
            //Initialize validation logic when a form is created
            formCreated: function (event, data) {


                data.form.validationEngine();
                data.form.css('width','300px');

                data.form.closest('.ui-dialog').dialog('option', 'position', 'center');
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
  <script src="js/jasny-bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
