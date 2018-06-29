<?php
require_once('conexion.php');
$id_category = $_POST['id'];
$cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
$cxn->set_charset("utf8");
$result = $cxn->query("SELECT id , nombre FROM `categoria_producto` WHERE sub_categoria=".$id_category." ORDER BY nombre ASC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
    }
}

echo $html;
$cxn->close();
?>
