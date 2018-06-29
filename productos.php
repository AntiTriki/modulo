<?php
session_name('nilds');
session_start();
try{
	$con = mysql_connect("localhost","root","");
	mysql_select_db("n", $con);
	if($_GET["accion"] == "listar")	{
		$result = mysql_query("SELECT * FROM empresa;");
		$rows = array();
		while($row = mysql_fetch_array($result)){
		    $rows[] = $row;
		}
        $fila = mysql_fetch_array($result);
        $_SESSION['nivel_empresa']=$fila['nivel'];
        $_SESSION["sigla"]=$fila['sigla'];
		$jTableResult = array();
		$jTableResult['Result'] = "OK";

		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}else if($_GET["accion"] == "crear"){
        $result = mysql_query("SELECT COUNT(*) AS conteo FROM empresa where  razon_social='".$_POST["razon_social"]."' ;");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] < 1) {
            $result = mysql_query("SELECT COUNT(*) AS conteo FROM empresa where  sigla='".$_POST["sigla"]."' ;");
            $row = mysql_fetch_array($result);
            if ($row['conteo'] < 1) {

                $result = mysql_query("INSERT INTO empresa(correo, nit, razon_social,sigla,direccion,nivel,id_usuario) VALUES(
'" . $_POST["correo"] . "','" . $_POST["nit"] . "','" . $_POST["razon_social"] . "','" . $_POST["sigla"] . "'
,'" . $_POST["direccion"] . "'," . $_POST["nivel"] . ",
" . $_SESSION["id_usuario"] . ")");
                $result = mysql_query("SELECT * FROM empresa WHERE id = LAST_INSERT_ID();");
                $row = mysql_fetch_array($result);
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                $jTableResult['Record'] = $row;
                print json_encode($jTableResult);
            }else{
                $row = mysql_fetch_array($result);
                $jTableResult = array();
                $jTableResult['Result'] = "ERROR";
                $jTableResult['Message'] = "No debe existir dos empresas con la misma sigla";
                print json_encode($jTableResult);
            }
        }else
        {
            $row = mysql_fetch_array($result);
            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "No debe existir dos empresas con el mismo nombre";
            print json_encode($jTableResult);
        }
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
            }
            else{
                $row = mysql_fetch_array($result);
                $jTableResult = array();
                $jTableResult['Result'] = "ERROR";
                $jTableResult['Message'] = "No debe existir dos empresas con la misma sigla";
                print json_encode($jTableResult);
            }
        }else{

            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "No debe existir dos empresas con el mismo nombre";
            print json_encode($jTableResult);
        }
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