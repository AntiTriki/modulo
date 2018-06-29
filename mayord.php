<?php
session_name('nilds');
session_start();
include_once('conexion.php');


$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);
$rot=0;
$result = mysql_query("truncate mayor ");

$result1 = mysql_query("select * from periodo where id_empresa=".$_SESSION['id_emp']."  order by id asc");
while ($row1 = mysql_fetch_array($result1)) {

$result = mysql_query("select * from cuenta where id_empresa=".$_SESSION['id_emp']." and nivel = ".$_SESSION['nivel_empresa']."   order by id asc");
        while ($row = mysql_fetch_array($result)) {



                $res = mysql_query("select  c.*, cu.id as id_cuenta,d.id as deta, d.haber_dol,d.debe_dol, d.id as id_d
                                                from
                                        comprobante c inner join detalle_comprobante d on c.id = d.id_comprobante
                                       inner join cuenta cu on d.id_cuenta = cu.id and d.id_periodo= " . $row1['id'] . "  and cu.id= " . $row['id'] . " order by d.id, fecha asc");
                if ($res) {
                    while ($ro = mysql_fetch_array($res)) {
                        $rot = floatval($ro['haber_dol']) - floatval($ro['debe_dol']) + $rot;
                       // echo $ro['deta'] . ' ' . $ro['haber'] . ' ' . $ro['debe'] . ' ' . $rot . '<br>';

                        $resulti = mysql_query("INSERT INTO mayor (total, id_d)
VALUES
('" . $rot . "'," . $ro['id_d'] . ")");


                    }

                } else {
                    echo mysql_errno($con) . ": " . mysql_error($con) . "\n";
                }
                $rot=0;
            }

$rot=0;

        }














































