<?php
session_name('nilds');
session_start();
include_once('conexion.php');


$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);
$rot=0;
$result = mysql_query("truncate inicial ");
$hab=0;
$deb=0;
for ($i = $_SESSION['nivel_empresa']; $i > 0; $i--) {
    $result1 = mysql_query("select c.* from cuenta c, detalle_comprobante d where c.id = d.id_cuenta and c.nivel=".$i."  and c.id_empresa=".$_SESSION['id_emp']."  order by id asc");
    while ($row1 = mysql_fetch_array($result1)) {
        $resulti = mysql_query("INSERT INTO inicial (haber,debe, id_cuenta)
VALUES
('" . $hab . "','" . $deb . "'," . $row1['id'] . ")");
    }

}
$result1 = mysql_query("select * from periodo where id_empresa=".$_SESSION['id_emp']."  order by id asc");
while ($row1 = mysql_fetch_array($result1)) {

}

//$result = mysql_query("select * from detalle_comprobante where id_periodo = ".$row1['id']."  order by id asc");
//        while ($row = mysql_fetch_array($result)) {
//           $hab= floatval($row['haber']) + $hab;
//           $deb= floatval($row['debe']) + $deb;
//
//        }
//    $resulti = mysql_query("INSERT INTO diario (haber,debe, id_periodo)
//VALUES
//('" . $hab . "','" . $deb . "'," . $row1['id'] . ")");
//    $hab=0;
//    $deb=0;
//
//}


//$result = mysql_query("select * from cuenta where id_empresa=".$_SESSION['id_emp']." and nivel = ".$_SESSION['nivel_empresa']."   order by id asc");
//        while ($row = mysql_fetch_array($result)) {
//
//
//
//                $res = mysql_query("select  c.*, cu.id as id_cuenta,d.id as deta, d.haber,d.debe, d.id as id_d
//                                                from
//                                        comprobante c inner join detalle_comprobante d on c.id = d.id_comprobante
//                                       inner join cuenta cu on d.id_cuenta = cu.id and d.id_periodo= " . $row1['id'] . "  and cu.id= " . $row['id'] . " order by d.id, fecha asc");
//                if ($res) {
//                    while ($ro = mysql_fetch_array($res)) {
//                        $rot = floatval($ro['haber']) - floatval($ro['debe']) + $rot;
//                       // echo $ro['deta'] . ' ' . $ro['haber'] . ' ' . $ro['debe'] . ' ' . $rot . '<br>';
//
//                        $resulti = mysql_query("INSERT INTO mayor (total, id_d)
//VALUES
//('" . $rot . "'," . $ro['id_d'] . ")");
//
//
//                    }
//
//                } else {
//                    echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
//                }
//                $rot=0;
//            }
//
//$rot=0;
//
//        }
//        print json_encode('ok');
//
//
//
//









































