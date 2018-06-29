<?php
session_name('nilds');
session_start();
include_once('conexion.php');







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
$result = mysql_query("SELECT max(serie) AS cor FROM comprobante where id_empresa = " . $_SESSION["id_emp"] . ";") or die(mysql_error());
$row = mysql_fetch_array($result);
$cor = $row['cor'];
$cor = $cor + 1;


print $cor;




































?>
