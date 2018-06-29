<?php
session_name('nilds');
session_start();
include_once('tipo.php');
?>


    <link href="custom/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="css/jtable_jqueryui.min.css" rel="stylesheet" type="text/css" />
    <!--	<link href="themes\lightcolor\gray\jtable.min.css" rel="stylesheet" type="text/css" />-->
    <link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jasny-bootstrap.min.css">
<link rel="stylesheet" href="css/modern-business.css">
    <!-- <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js" charset="utf-8"></script> -->
    <link rel="stylesheet" href="themes\metro\blue\jtable.min.css">
    <link rel="stylesheet" href="css/mainp2.css">
    <style media="screen">
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
  </style>


<body>
    <div id="navbar-auto-hidden" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">



              <?php

              if (isset($_SESSION['nombreemp'])){ ?>
                <a href="empresas.php" class="navbar-brand"><?php echo $_SESSION['nombreemp'] ;?></a>
                <?php
              } else if(isset($row2['sigla'])) { ?>
                      <a href="index.php" class="navbar-brand"><?php echo $row2['sigla'] ;?></a>
      <?php }else{ ?>

                <a href="index.php" class="navbar-brand">ERP</a>
      <?php } ?>



            </div>
            <div class="collapse navbar-collapse" id="nav-collapse">

                <?php
if (isset($_SESSION['name'])){
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="img-thumbnail profile-img"></div>


                            <strong ><?php echo $_SESSION["name"] ; ?></strong>
<!--20 caracteres de nombre en el a href -->
                            <span class="glyphicon glyphicon-chevron-down pull-right"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="text-center">
                                                <div class="img-thumbnail profile-img" ></div>
                                            </p>
                                        </div>
                                        <div class="col-lg-8">
                                            <p class="text-left"><strong></strong></p>
                                            <p class="text-left small"><?php echo $_SESSION["correo"]; ?></p>
                                            <p class="text-left">
                                                <a href="#" class="btn btn-primary btn-block btn-sm">Profile</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider navbar-login-session-bg"></li>
                            <li><a href="#">Configuracion de Cuenta <span class="glyphicon glyphicon-cog pull-right"></span></a></li>

                            <li class="divider"></li>
                            <li><a href="logout.php?logout">Salir <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                        </ul>
                    </li>
                </ul>
              <?php }?>
            </div>
        </div>
    </div>
     <?php
if (isset($_SESSION['name'])){
    ?>
    <div class="navmenu navmenu-default navmenu-fixed-left" style="width:200px">

      <ul class="nav navmenu-nav">
        <li class="visible-xs">
            <a >
                <!-- The Profile picture inserted via div class below, with shaping provided by Bootstrap -->
                <div class="img-rounded profile-img"></div>
                <?php echo  $_SESSION['name'];?>
            </a>



        </li>
        <li class="visible-xs">
            <a href="#">Settings</a>
        </li>
        <li role="separator" class="divider visible-xs"></li>

          <li>
              <a href="empresas.php" >Empresas</a>
          </li>
        <li>
            <a href="cuenta.php" >Plan de Cuentas</a>
        </li>
        <li>
            <a href="ambiente.php" >Gestiones</a>
        </li> <li>
            <a href="comprobante.php" >Comprobante</a>
        </li><li>
              <a href="nota_compra.php" >Nota Compra</a>
          </li><li>
              <a href="nota_venta.php" >Nota Venta</a>
          </li><li>
            <a href="categorias.php" >Categoria</a>
        </li><li>
            <a href="articulos.php" >Articulo</a>
        </li>
        <li>
            <a href="../reportico" >Reporte</a>
        </li>

        <li class="visible-xs">
            <a href="logout.php?logout">Salir</a>
        </li>

      </ul>

    </div>


    <?php
  }?>
    <!-- <script src="js/jquery.js" charset="utf-8"></script> -->

    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>
   <script src="js/jquery.jtable.min.js" type="text/javascript"></script>

    <!--<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>-->


    <script src="localization/jquery.jtable.es.js" type="text/javascript"></script>

    <script type="text/javascript" src="js/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="js/jquery.validationEngine-es.js"></script>
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <script src="js/bootstrap-select.min.js" charset="utf-8"></script>


</body>


</html>
