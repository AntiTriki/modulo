<?php
session_name('nilds');
session_start();
include_once('conexion.php');

$correo=$_POST['correo'];
$nit=$_POST['nit'];
$rs=$_POST['razon_social'];
$sigla=$_POST['sigla'];
$direccion=$_POST['direccion'];
$nivel=$_POST['nivel'];
$id=$_SESSION['id_usuario'];

$cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
$cxn->set_charset("utf8");
$query_user = sprintf("SELECT
             u.id


						 FROM
             empresa u
 						 WHERE
						 u.nit='%a'
						 or u.razon_social ='%b'
						 or u.sigla ='%c'

						 ",$nit,$rs,$sigla);

$result_user = mysqli_query($cxn,$query_user) or die("Error usu:".mysqli_error($cxn));
$row2 = mysqli_fetch_array($result_user);

if(mysqli_num_rows($result_user)>0) {
    echo 'fail';
}else {


    $result = $cxn->query("INSERT INTO `empresa`
  (`nit`, `razon_social`, `sigla`, `direccion`, `correo`,  `nivel`,`id_usuario`)
  VALUES(
    '" . $nit . "',
    '" . $rs . "',
    '" . $sigla . "',
    '" . $direccion . "',
    '" . $correo . "',
    '" . $nivel . "',
    '.$id.')") or die("Error usu:" . mysqli_error($cxn));
    $last_id = $cxn->insert_id;
echo $last_id;

}
?>
