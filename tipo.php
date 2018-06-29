<?php
if (isset($_SESSION['id_empresa']))
{$_SESSION["name"] = $_SESSION["nombre_empresa"];
$ruta_img = $_SESSION['logo'];
}
elseif (isset($_SESSION['id_usuario']))
{$_SESSION ["name"]= $_SESSION["nombre"];}


$ruta_img = "images/user.jpg";

$_SESSION["logo"] = $ruta_img ;



?>
