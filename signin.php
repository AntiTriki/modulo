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
u.telefono,
u.id_centro,
u.id_lab


FROM
administrador u
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
$_SESSION["pass"] = $row2["contra"];
$_SESSION["correo"]=$row2["correo"];
$_SESSION["nombre"]=utf8_decode($row2["nombre"]);
$_SESSION["apellido"]=utf8_decode($row2["apellido"]);
$_SESSION["d_identidad"]=$row2["ci"];
$_SESSION["logo"]=$row2["logo"];
$_SESSION["fecha_nac"]=$row2["fecha_nac"];
$_SESSION["ciudad"]=utf8_decode($row2["ciudad"]);
$_SESSION["estado_civil"]=utf8_decode($row2["estado_civil"]);
$_SESSION["ocupacion"]=utf8_decode($row2["ocupacion"]);
$_SESSION["activo"]=$row2["activo"];
$_SESSION["telefono"]=$row2["telefono"];
$_SESSION["celular"]=$row2["celular"];
$_SESSION["sexo"]=$row2["sexo"];
$_SESSION["nit"]=$row2["nit"];
$_SESSION["factura_nombre"]=utf8_decode($row2["factura_nombre"]);
$_SESSION["correo_nombre"]=$row2["correo_nombre"];
$_SESSION["telefono_mp"]= $row2["telefono_mp"];
$_SESSION["nombre_mp"]=$row2["nombre_mp"];

$FecHr = date('Y-m-d H:i:s');
$query_ing = sprintf("UPDATE usuario set visita = '".$FecHr."' where id = ".$_SESSION["id_usuario"]."") or die("Error usu:".mysqli_error($link));
$result_ing=mysqli_query($link,$query_ing);
// Free result set
mysqli_free_result($result_user);
mysqli_close($link);

header("Location:index.php");
}else{
$query_empre = sprintf("SELECT
e.id_empresa,
e.contra,
e.nombre,
e.desc_corta,
e.activo,
e.direccion,
e.coordx,
e.coordy,
e.imagen,
e.telefono,
e.id_categoria
from
empresa e
WHERE
e.activo = 1
and e.correo ='$usra'
and e.contra ='$pwda'
");
$result_empre = mysqli_query($link,$query_empre) or die("Error emp:".mysqli_error($link));
$row3 = mysqli_fetch_array($result_empre);
if(mysqli_num_rows($result_empre) > 0) // SI EMPRESA EXISTE
{
$_SESSION['correo']=$correo;
$_SESSION["activo"]=$row3['activo'];
$_SESSION["tipo_usuario"]='empresa';
$_SESSION["nombre_empresa"]= utf8_encode($row3['nombre']);
$_SESSION["desc_corta"]=utf8_encode($row3['desc_corta']);
$_SESSION["id_empresa"]=$row3['id_empresa'];
$_SESSION["logo"]=$row3['imagen'];

//$_SESSION["provincia"]=$row['provincia'];

$_SESSION["telefono"] = $row3['telefono'];
//CONSULTAMOS SI ES NUEVO

$_SESSION["direccion"] = $row3['direccion'];
$_SESSION["coordx"] = $row3['coordx'];
$_SESSION["coordy"] = $row3['coordy'];
/*$_SESSION["c_postal"] = $row3['c_postal'];*/










$FecHr = date('Y-m-d H:i:s');
$query_ing_emp = sprintf("UPDATE empresa set visita = '".$FecHr."' where id_empresa = ".$_SESSION["id_empresa"]."");
$result_ing_emp=mysqli_query($link,$query_ing_emp);

mysqli_free_result($result_empre);
mysqli_close($link);
header("Location:index.php");
} //FIN SI EMRPESA EXISTE



else
{
mysqli_close($link);
die("email y/o contrase&ntilde;a incorrectos<br><br>");

}
}
