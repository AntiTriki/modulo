<?php
// Conectando, seleccionando la base de datos
$mysql_host='localhost';
$mysql_user='root';
$mysql_password='';
$my_database='modulo';

$cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
if ($cxn->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{


}

// Cerrar la conexión
$cxn->close();
?>
