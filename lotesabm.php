<?php
session_name('nilds');
session_start();


try{
	$con = mysql_connect("localhost","root","");
	mysql_select_db("n", $con);
	if($_GET["accion"] == "listar")	{
		$result = mysql_query("SELECT * FROM lote where id_articulo=" . $_SESSION["id_lot"] . ";");
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
        $finicio = str_replace('/', '-', $_POST["fecha_ing"]);
        $finicio = date('Y-m-d', strtotime($finicio));
        $ffin = str_replace('/', '-', $_POST["fecha_ven"]);
        $ffin = date('Y-m-d', strtotime($ffin));
        if($finicio<$ffin) {
            $result = mysql_query("SELECT * FROM `lote` where id_articulo=" . $_SESSION['id_lot'] . " order by nro_lote desc limit 1");
            $row = mysql_fetch_array($result);
            $row['nro_lote'] = $row['nro_lote'] + 1;


            $result = mysql_query("INSERT INTO lote(nro_lote, precio_compra, fecha_ing,fecha_ven,cantidad,id_articulo) VALUES(" . $row["nro_lote"] . ",'" . $_POST["precio_compra"] . "','" . $finicio . "','" . $ffin . "'," . $_POST["cantidad"] . "," . $_SESSION["id_lot"] . ")");
            $result = mysql_query("SELECT * FROM lote WHERE id = LAST_INSERT_ID();");
            $row = mysql_fetch_array($result);
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            $jTableResult['Record'] = $row;
            print json_encode($jTableResult);
        }else{
            $row = mysql_fetch_array($result);
            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "La fecha de ingreso debe ser menor que la fecha de vencimiento";
            print json_encode($jTableResult);

        }

	}else if($_GET["accion"] == "actualizar"){
        $finicio = str_replace('/', '-', $_POST["fecha_ing"]);
        $finicio = date('Y-m-d', strtotime($finicio));
        $ffin = str_replace('/', '-', $_POST["fecha_ven"]);
        $ffin = date('Y-m-d', strtotime($ffin));
        if($finicio<$ffin) {

            $result = mysql_query("UPDATE lote SET fecha_ing='" . $finicio . "', precio_compra='" . $_POST["precio_compra"] . "', fecha_ven='" . $ffin . "',
		 cantidad=" . $_POST["cantidad"] . ",nro_lote=" . $_POST["nro_lote"] . " WHERE id=" . $_POST["id"] . ";");
            $jTableResult = array();
            $jTableResult['Result'] = "OK";
            print json_encode($jTableResult);
        }else{
            $row = mysql_fetch_array($result);
            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "La fecha de ingreso debe ser menor que la fecha de vencimiento";
            print json_encode($jTableResult);

        }


	}else if($_GET["accion"] == "eliminar"){
		$result = mysql_query("DELETE FROM lote WHERE id= " . $_POST["id"] . ";");
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