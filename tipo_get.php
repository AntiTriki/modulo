<?php
session_name('nilds');
session_start();
include_once('conexion.php');
$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);
$result = mysql_query("SELECT count(*) AS cont FROM comprobante where id_tipocomprobante=9 and id_estado <> 3 and id_empresa = " . $_SESSION["id_emp"] . ";") or die(mysql_error());
$row = mysql_fetch_array($result);
$cor = $row['cont'];
print $cor;




































?>
