<?php
session_name('nilds');
session_start();
include_once('conexion.php');
$id=$_POST['id'];
$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);
$result = mysql_query("UPDATE comprobante SET id_estado=3 where id=".$id." ;") or die(mysql_error());
$row = mysql_fetch_array($result);
print json_encode('ok');




































?>
