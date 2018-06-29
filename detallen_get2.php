<?php
session_name('nilds');
session_start();
include_once('conexion.php');

    $qid=$_POST['dato'];



$date = date('Y-m-d');



$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);


$result = mysql_query("select d.id as id, c.nombre as codigo,   d.cantidad as debe, d.precio_venta as haber
from 
articulo c , detalle_nota d, nota_venta co
where
c.id=d.id_articulo and d.id_notav=co.id and co.id=$qid");

$i=1;
while ($row = mysql_fetch_assoc($result)) {
    $json[] = $row;
    $i++;
}
$data['data'] = $json;

print json_encode($data);




































?>
