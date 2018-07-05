<?php
session_name('nilds');
session_start();
try{
	$con = mysql_connect("localhost","root","");
	mysql_select_db("modulo", $con);
	if($_GET["accion"] == "listar")	{
		$result = mysql_query("SELECT * FROM paciente;");
		$rows = array();
		while($row = mysql_fetch_array($result)){
		    $rows[] = $row;
		}
        $fila = mysql_fetch_array($result);

		$jTableResult = array();
		$jTableResult['Result'] = "OK";

		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}else if($_GET["accion"] == "crear"){




                $result = mysql_query("INSERT INTO paciente(nombre, direccion,telefono,ci) VALUES(
'" . $_POST["nombre"] . "','" . $_POST["direccion"] . "'," . $_POST["telefono"] . "
,
'" . $_SESSION["ci"] . "')");
                $result = mysql_query("SELECT * FROM paciente WHERE id = LAST_INSERT_ID();");
                $row = mysql_fetch_array($result);
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                $jTableResult['Record'] = $row;
                print json_encode($jTableResult);


	}else if($_GET["accion"] == "actualizar"){



                $result = mysql_query("UPDATE paciente SET nombre='" . $_POST["nombre"] . "',ci ='" . $_POST["ci"] . "', direccion='" . $_POST["direccion"] . "', telefono=" . $_POST["telefono"] . " WHERE id=" . $_POST["id"] . ";");
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                print json_encode($jTableResult);

	}else if($_GET["accion"] == "eliminar"){

		$result = mysql_query("DELETE FROM paciente WHERE id= " . $_POST["id"] . ";");
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