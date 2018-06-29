<?php
session_name('nilds');
session_start();
include_once('conexion.php');


$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);
$rot=0;
$result = mysql_query("truncate diario ");
$hab=0;
$deb=0;
$result1 = mysql_query("select * from periodo where id_empresa=".$_SESSION['id_emp']."  order by id asc");
while ($row1 = mysql_fetch_array($result1)) {

$result = mysql_query("select * from detalle_comprobante where id_periodo = ".$row1['id']."  order by id asc");
        while ($row = mysql_fetch_array($result)) {
           $hab= floatval($row['haber']) + $hab;
           $deb= floatval($row['debe']) + $deb;

        }
    $resulti = mysql_query("INSERT INTO diario (haber,debe, id_periodo)
VALUES
('" . $hab . "','" . $deb . "'," . $row1['id'] . ")");
    $hab=0;
    $deb=0;

}

print json_encode('ok');








































