<?php
session_name('nilds');
session_start();
require_once('conexion.php');
$nivel = $_POST['id'];
$nivel =$nivel -1;
$id_empresa = $_SESSION['id_emp'];
$cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
$cxn->set_charset("utf8");
$html ='';
$result = $cxn->query("SELECT * FROM cuenta WHERE nivel=".$nivel." and (id_empresa=".$id_empresa." or id_empresa=0) ORDER BY text ASC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<option value="'.$row['id'].'"> '.$row['codigo'].' - '.$row['text'].'</option>';
    }
}

echo $html;
$cxn->close();
?>
