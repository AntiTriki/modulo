<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<style>
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 30px white inset;

}
</style>
</head>
<body>
  <div class="text-center" style="padding:50px 0">
    <div class="logo">Inicio</div>
    <!-- Main Form -->
    <div class="login-form-1">
      <form id="login-form" class="text-left" action="signin.php" method="POST">
        <div class="login-form-main-message"></div>
        <div class="main-login-form">
          <div class="login-group">
            <div class="form-group">
              <label for="lg_username" class="sr-only">Usuario</label>
              <input type="email" class="form-control" id="lg_username" name="correo" placeholder="username">
            </div>
            <div class="form-group">
              <label for="lg_password" class="sr-only">Contrasena</label>
              <input type="password" class="form-control" id="lg_password" name="contra" placeholder="password">
            </div>
              <div class="etc-login-form">

                  
              </div>
          </div>
          <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
        </div>

      </form>
    </div>
    <!-- end:Main Form -->
  </div>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Registro de Usuario</h4>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal">
                      <div class="form-group">
                          <label class="control-label col-sm-2" for="email">Email:</label>
                          <div class="col-sm-10">
                              <input type="email" name="correo" class="form-control" id="email" placeholder="Ingresar email">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Contrasena:</label>
                          <div class="col-sm-10">
                              <input type="password" name="contra" class="form-control" id="pwd" placeholder="Ingresar Contrasena">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Repetir Contrasena:</label>
                          <div class="col-sm-10">
                              <input type="password" class="form-control" id="pwd" placeholder="Ingresar Contrasena">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Carnet de Identidad:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="pwd" placeholder="Ingresar CI">
                          </div>
                      </div><div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Nombre:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="pwd" placeholder="Ingresar Nombre">
                          </div>
                      </div><div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Apellido:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="pwd" placeholder="Ingresar Apellido">
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-default">Registrar</button>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>

      </div>
  </div>
  <script src="js/jquery.js" charset="utf-8"></script>
  <script src="js/main.js" charset="utf-8"></script>
  <script src="js/bootstrap.min.js" charset="utf-8"></script>
  <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>


</body>
</html>
