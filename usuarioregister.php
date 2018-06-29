<?php
include_once('conexion.php');
include_once('getExtension.php');
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$correo=$_POST['correo'];
$contra=$_POST['password'];


      $cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
      $cxn->set_charset("utf8");
      $result = $cxn->query("INSERT INTO `usuario`
        (`nombre`, `apellido`, `correo`,  `contra`)
        VALUES(
          '".$nombre."',
          '".$apellido."',
          '".$correo."',
          '".$contra."')") or die("Error usu:".mysqli_error($cxn));
header("Location:index.php");
$cxn->close();


?>
