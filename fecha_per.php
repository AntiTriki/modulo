<?php
session_name('nilds');
session_start();
include_once('conexion.php');

$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);


$fecha_per = str_replace('-', '-', $_POST["fecha_per"]);
$fecha_per = date('Y-m-d', strtotime($fecha_per));

$result = mysql_query("SELECT * FROM periodo where id_empresa = " . $_SESSION["id_emp"] . " and estado= 1 and '".$fecha_per."' >= fecha_inicio and '".$fecha_per."' <= fecha_fin  ;") or die(mysql_error());
$rows = array();
$cor =0;
while($row = mysql_fetch_array($result)){
   if( $fecha_per >= $row['fecha_inicio'] and $fecha_per <= $row['fecha_fin']  ){
       $cor= 'La fecha pertenece al periodo '.$row['nombre'];
   }

}
print $cor;




































?>
