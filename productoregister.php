<?php
session_name('nilds');
session_start();
include_once('conexion.php');
include_once('getExtension.php');
$nombre=$_POST['nombre'];
$stock=$_POST['stock'];
$descripcion=$_POST['descripcion'];
$precio=$_POST['precio'];
$subcategoria=$_POST['subcategoria'];
$id_empresa=$_SESSION['id_empresa'];
date_default_timezone_set('America/La_Paz');
$date = date('Y-m-d');
$name = $_FILES['imagen']['name'];



$target_dir = "images/";
$ext=getExtension($name);
$target_file = $target_dir.$_SESSION['id_empresa']."_".date("HisdmY").rand(1000,9999).".".$ext;
$uploadOk = 1;
$imageFileType = pathinfo($name,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {

        $uploadOk = 1;
    } else {

        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {

    $uploadOk = 0;
}
// Check file size
if ($_FILES["imagen"]["size"] > 500000) {

    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {

    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
      $cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
      $cxn->set_charset("utf8");
      $result = $cxn->query("INSERT INTO `producto`
        (`nombre`, `descripcion`, `stock`, `stock_inicial`, `precio_inicial`, `precio`, `id_categoria`, `id_empresa`, `imagen`, `fecha_publicacion`)
        VALUES(
          '".$nombre."',
          '".$descripcion."',
          $stock,
          $stock,
          $precio,
          $precio,
          $subcategoria,
          $id_empresa,
          '".$target_file."',
          '".$date."')") or die("Error usu:".mysqli_error($cxn));
header("Location:index.php");
$cxn->close();

    } else {

    }
}
?>
