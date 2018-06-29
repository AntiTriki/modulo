<?php
session_name('nilds');
session_start();
try{
	$con = mysql_connect("localhost","root","");
	mysql_select_db("n", $con);
	if($_GET["accion"] == "listar")	{
		//$result = mysql_query("SELECT a.id as id, a.nombre as nombre ,c.text as categoria, a.descripcion as descripcion , a.cantidad as cantidad, a.precio_venta as precio_venta FROM articulo a, categoria c where a.id_categoria=c.id and a.id_empresa=".$_SESSION["id_emp"]." ");
		$result = mysql_query("SELECT * FROM articulo where id_empresa=".$_SESSION["id_emp"]." ");

		$rows = array();
		while($row = mysql_fetch_array($result)){
		    $rows[] = $row;
		}
        $fila = mysql_fetch_array($result);
        $_SESSION['cantidad_articulo']=$fila['cantidad'];
        $_SESSION["sigla"]=$fila['sigla'];
		$jTableResult = array();
		$jTableResult['Result'] = "OK";

		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}else if($_GET["accion"] == "crear"){
        $result = mysql_query("SELECT COUNT(*) AS conteo FROM articulo where  nombre='".$_POST["nombre"]."' ;");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] < 1) {
           

                $result = mysql_query("INSERT INTO articulo(descripcion, nombre,id_empresa,id_categoria) VALUES(
'" . $_POST["descripcion"] . "','" . $_POST["nombre"] . "'," . $_SESSION["id_emp"] . "," . $_POST['id_categoria'] . ")");
                $result = mysql_query("SELECT * FROM articulo WHERE id = LAST_INSERT_ID();");
                $row = mysql_fetch_array($result);
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                $jTableResult['Record'] = $row;
                print json_encode($jTableResult);
            
        }else
        {
            $row = mysql_fetch_array($result);
            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "No debe existir dos articulos con el mismo nombre";
            print json_encode($jTableResult);
        }
	}else if($_GET["accion"] == "actualizar"){
        $result = mysql_query("SELECT COUNT(*) AS conteo FROM articulo where  nombre='".$_POST["nombre"]."' and id <> " . $_POST["id"] . " ;");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] < 1) {


                $result = mysql_query("UPDATE articulo SET descripcion='" . $_POST["descripcion"] . "', id_categoria=" . $_POST["id_categoria"] . ", nombre='" . $_POST["nombre"] . "'
		  WHERE id=" . $_POST["id"] . ";");
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                print json_encode($jTableResult);

        }else{

            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "No debe existir dos articulos con el mismo nombre";
            print json_encode($jTableResult);
        }
	}else if($_GET["accion"] == "eliminar"){
		$result = mysql_query("DELETE FROM articulo WHERE id= " . $_POST["id"] . ";");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	mysql_close($con);

}catch(Exception $ex){
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}	
?>