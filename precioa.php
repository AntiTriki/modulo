<?php
$cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
$cxn->set_charset("utf8");
$result = $cxn->query("SELECT
                                                                                               precio_venta
                                                                                              FROM articulo c
                                                                                              WHERE c.id=". $_POST["id"]." ");
$row = $result->fetch_assoc();
print json_encode($row['precio_venta']);

$cxn->close();

?>