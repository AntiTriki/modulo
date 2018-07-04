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
        $result = mysql_query("SELECT COUNT(*) AS conteo FROM empresa where  razon_social='".$_POST["razon_social"]."' and id <> " . $_POST["id"] . " ;");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] < 1) {
            $result = mysql_query("SELECT COUNT(*) AS conteo FROM empresa where  sigla='".$_POST["sigla"]."' and id <> " . $_POST["id"] . " ;");
            $row = mysql_fetch_array($result);
            if ($row['conteo'] < 1) {

                $result = mysql_query("UPDATE empresa SET correo='" . $_POST["correo"] . "', nit='" . $_POST["nit"] . "', razon_social='" . $_POST["razon_social"] . "',
		sigla='" . $_POST["sigla"] . "',direccion='" . $_POST["direccion"] . "', nivel=" . $_POST["nivel"] . " WHERE id=" . $_POST["id"] . ";");
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                print json_encode($jTableResult);

	}else if($_GET["accion"] == "eliminar"){
        $result = mysql_query("SELECT count(*) as cont FROM gestion where id_empresa=".$_POST["id"].";");
        $row = mysql_fetch_array($result);
        if($row['cont'] == 0){
		$result = mysql_query("DELETE FROM empresa WHERE id= " . $_POST["id"] . ";");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
        }else{
            $row = mysql_fetch_array($result);
            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "No puede eliminar teniendo gestiones en la empresa";
            print json_encode($jTableResult);

        }
	}
	mysql_close($con);

}catch(Exception $ex){
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}	
?>