<?php
session_name('nilds');
session_start();
include_once('conexion.php');
date_default_timezone_set('America/La_Paz');
$correo=$_POST['correo'];
$contra=$_POST['contra'];
$link = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
$usra = mysqli_real_escape_string($link, $correo);
$pwda = mysqli_real_escape_string($link, $contra);
$query_user = sprintf("SELECT
u.id,
u.usuario,
u.password,
u.nombre,
u.direccion,
u.telefono



FROM
medico u
WHERE
u.usuario='$usra'
AND u.password ='$pwda'
AND u.activo = 1
");
$link->set_charset("utf8");
$result_user = mysqli_query($link,$query_user) or die("Error usu:".mysqli_error($link));
$row2 = mysqli_fetch_array($result_user);

if(mysqli_num_rows($result_user)>0)
{
$_SESSION["id_usuario"] = $row2["id"];
$_SESSION["pass"] = $row2["password"];
$_SESSION["correo"]=$row2["usuario"];
$_SESSION["nombre"]=utf8_decode($row2["nombre"]);

$_SESSION["direccion"]=$row2["direccion"];


$FecHr = date('Y-m-d H:i:s');

mysqli_free_result($result_user);
mysqli_close($link);

header("Location:inicio.php");
}else{
$query_empre = sprintf("SELECT
e.id,
e.password,
e.nombre,
e.usuario,

e.direccion





from
administrador e
WHERE
 e.usuario ='$usra'
and e.password ='$pwda'
");
$result_empre = mysqli_query($link,$query_empre) or die("Error emp:".mysqli_error($link));
$row3 = mysqli_fetch_array($result_empre);
if(mysqli_num_rows($result_empre) > 0) // SI EMPRESA EXISTE
{
    $_SESSION["id_usuario"] = $row2["id"];
    $_SESSION["pass"] = $row2["password"];
    $_SESSION["correo"]=$row2["usuario"];
    $_SESSION["nombre"]=utf8_decode($row2["nombre"]);


/*$_SESSION["c_postal"] = $row3['c_postal'];*/










$FecHr = date('Y-m-d H:i:s');


mysqli_free_result($result_empre);
mysqli_close($link);
    header("Location:inicio.php");
} //FIN SI EMRPESA EXISTE



else
{
mysqli_close($link);
    header("Location:index.php");

}
}
