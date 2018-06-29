<?php
session_name('nilds');
session_start();
if(isset($_POST['descripcion'])&&isset($_POST['text'])&&isset($_POST['id_tipocategoria'])) {
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("n", $con);

//que correlativo le toca

$result = mysql_query("SELECT COUNT(*) AS conteo FROM categoria where
          text='" . $_POST["text"] . "' and id_empresa = " . $_SESSION["id_emp"] . ";");
$row = mysql_fetch_array($result);
if ($row['conteo'] == 0) {

    $result = mysql_query("INSERT INTO categoria(text, descripcion,id_tipocategoria,id_empresa) VALUES(
      '" . $_POST["text"] . "','" . $_POST["descripcion"] . "','" . $_POST["id_tipocategoria"] . "'," . $_SESSION["id_emp"] . ")");
    echo '1';

}
else{
        echo 'No debe existir otra cuenta con el mismo nombre para la misma empresa';
    }
}else{
    echo 'Debe llenar correctamente el formulario';
}
?>
