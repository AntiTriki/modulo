<?php
session_name('nilds');
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->

<!--    <link rel="stylesheet" href="css/modern-business.css">-->
    <!-- <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js" charset="utf-8"></script> -->

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
.carousel.slide.canvas{
  min-height: auto;
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
</head>

<body>
    <div id="navbar-auto-hidden" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
              <?php if (isset($_SESSION['name'])){ ?>

        <?php } ?>


                <a href="index.php" class="navbar-brand">ERP</a>



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





<!-- <script src="js/jquery-3.0.0.js" charset="utf-8"></script>-->
<!--    <script src="js/bootstrap.min.js" charset="utf-8"></script>-->
<!--    <script src="js/bootstrap-select.min.js" charset="utf-8"></script>-->
    <!-- <script src="js/autohidingnavbar.min.js" charset="utf-8"></script>
    <script src="js/main.js" charset="utf-8"></script>


    <script src="js/jasny-bootstrap.min.js" charset="utf-8"></script>  -->
    <!-- <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script> -->


</body>


</html>
