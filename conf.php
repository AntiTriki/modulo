<?php
session_name('nilds');
session_start();
include_once('conexion.php');

$cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
$cxn->set_charset("utf8");
$result = $cxn->query("UPDATE EMPRESA SET 
cf= ".$_POST['cf'].",
df=".$_POST['df'].",
it=".$_POST['it'].",
itxp=".$_POST['itxp'].",
compras=".$_POST['compras'].",
ventas=".$_POST['ventas'].",
caja=".$_POST['caja']." where id=".$_SESSION['id_emp']." ");
$row = $result->fetch_assoc();
print 'ok';

$cxn->close();

?>