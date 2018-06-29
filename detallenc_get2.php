<?php
session_name('nilds');
session_start();
include_once('conexion.php');

    $qid=$_POST['dato'];



$date = date('Y-m-d');



$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);


$result = mysql_query("select lo.id as id, c.nombre as codigo,   lo.cantidad as debe, lo.precio_compra as haber
from 
articulo c ,  nota_compra co, lote lo
where
c.id=lo.id_articulo and co.id = lo.id_notac  and co.id=$qid");

$i=1;
while ($row = mysql_fetch_assoc($result)) {
    $json[] = $row;
    $i++;
}
$data['data'] = $json;

print json_encode($data);




































?>
