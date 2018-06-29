<?php
session_name('nilds');
session_start();
include_once('conexion.php');

    $qid=$_POST['dato'];



$date = date('Y-m-d');



$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);

//$result = mysql_query("SELECT
//c.id,c.serie , ti.tipocom, c.fecha,c.glosa, t.cambio,e.estado,m.moneda
//FROM `comprobante` c,
// (select c.descripcion as estado,com.id as id from concepto c, comprobante com where com.id_estado=c.id) e,
//  (select c.descripcion as tipocom,com.id as id from concepto c, comprobante com where com.id_tipocomprobante=c.id) ti,
//   (select c.descripcion as moneda,com.id as id from concepto c, comprobante com where com.id_moneda=c.id) m,
//    tipo_cambio t where c.id=e.id and ti.id = c.id and m.id = c.id and t.id = c.id_tipocambio ORDER by id ASC");
//
//$i=1;
//while ($row = mysql_fetch_assoc($result)) {
//    $array[$i]['id'] = $row['id'];
//    $array[$i]['serie'] = $row['serie'];
//    $array[$i]['tipocom'] = $row['tipocom'];
//    $array[$i]['fecha'] = $row['fecha'];
//    $array[$i]['glosa'] = $row['glosa'];
//    $array[$i]['cambio'] = $row['cambio'];
//    $array[$i]['estado'] = $row['estado'];
//    $array[$i]['moneda'] = $row['moneda'];
//$i++;
//   }
$result = mysql_query("select d.id as id, c.codigo as codigo, c.text as text, d.glosa as glosa, d.debe as debe, d.haber as haber
from 
cuenta c , detalle_comprobante d, comprobante co
where
c.id=d.id_cuenta and d.id_comprobante=co.id and co.id=$qid");

$i=1;
$row=array();
$row['totald']=0;
$row['totalh']=0;
while ($row = mysql_fetch_assoc($result)) {
    $row['totald']=$row['debe'] +  $row['totald'];
    $row['totalh']=$row['haber'] +  $row['totalh'];
    $json[] = $row;
    $i++;
}
$data['data'] = $json;
$data['totald']= $row['totald'];
$data['totalh']= $row['totalh'];
print json_encode($data);




































?>
