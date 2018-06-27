<?php
session_name('nilds');
session_start();
include_once('conexion.php');
date_default_timezone_set('America/La_Paz');
$correo=$_POST['correo'];
$contra=$_POST['contra'];
$link = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
$usra = mysqli_real_escape_string($link, $correo);
						$pwda = mysqli_real_escape_string($link, $contra);
            $query_user = sprintf("SELECT u.id,
						 u.correo,
						 u.contra,
						 u.nombre,
						 u.apellido,
						 u.logo,
						 u.ci


						 FROM
             usuario u
 						 WHERE
						 u.correo='$usra'
						 AND u.contra ='$pwda'

						 ");
             $link->set_charset("utf8");
						$result_user = mysqli_query($link,$query_user) or die("Error usu:".mysqli_error($link));
						$row2 = mysqli_fetch_array($result_user);

            if(mysqli_num_rows($result_user)>0)
						{
								$_SESSION["id_usuario"] = $row2["id"];
								$_SESSION["pass"] = $row2["contra"];
								$_SESSION["correo"]=$row2["correo"];
								$_SESSION["nombre"]=utf8_decode($row2["nombre"]);
								$_SESSION["apellido"]=utf8_decode($row2["apellido"]);
								$_SESSION["d_identidad"]=$row2["ci"];
								$_SESSION["logo"]=$row2["logo"];


								$FecHr = date('Y-m-d H:i:s');
								$query_ing = sprintf("UPDATE usuario set visita = '".$FecHr."' where id = ".$_SESSION["id_usuario"]."") or die("Error usu:".mysqli_error($link));
								$result_ing=mysqli_query($link,$query_ing);
    							// Free result set
								mysqli_free_result($result_user);
								mysqli_close($link);

								header("Location:empresas.php");
							}else{
                header("Location:index.php");
							}

?>
