<?php
session_name('nilds');
session_start();
try{
    $con = mysql_connect("localhost","root","");
    mysql_select_db("n", $con);
    if($_GET["accion"] == "listar")	{
        $result = mysql_query("SELECT * FROM periodo where id_gestion=".$_SESSION['id_ges']." ;");
        $rows = array();
        while($row = mysql_fetch_array($result)){
            $rows[] = $row;
        }
        $jTableResult = array();
        $jTableResult['Result'] = "OK";

        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    }else if($_GET["accion"] == "crear"){
      $finicio = str_replace('/', '-', $_POST["fecha_inicio"]);
       $finicio = date('Y-m-d', strtotime($finicio));
       $ffin = str_replace('/', '-', $_POST["fecha_fin"]);
       $ffin = date('Y-m-d', strtotime($ffin));
       $result = mysql_query("SELECT fecha_inicio,fecha_fin FROM gestion where id=".$_SESSION['id_ges'].";");
       $row = mysql_fetch_array($result);
       $in=$row['fecha_inicio'];
       $in = date('Y-m-d', strtotime($in));
       $fi=$row['fecha_fin'];
       $fi = date('Y-m-d', strtotime($fi));

       if ($finicio>=$in && $ffin<=$fi){
        $result = mysql_query("SELECT COUNT(*) AS conteo FROM periodo where id_gestion=".$_SESSION['id_ges']." and nombre='".$_POST["nombre"]."' ;");
        $row = mysql_fetch_array($result);
          if ($row['conteo'] == 0){
            if($finicio<$ffin){
              $result = mysql_query("SELECT COUNT(*) AS cont FROM periodo where id_gestion=".$_SESSION['id_ges']." and ((fecha_inicio between '".$finicio."' and '".$ffin."') or (fecha_fin between '".$finicio."' and '".$ffin."')) ;");
              $row = mysql_fetch_array($result);
              if($row['cont'] == 0){


              $result = mysql_query("INSERT INTO periodo(nombre, fecha_inicio, fecha_fin,estado,id_gestion,id_empresa) VALUES(
      '".$_POST["nombre"]."','".$finicio."','".$ffin."',1,". $_SESSION["id_ges"].",". $_SESSION["id_emp"].")");
              $result = mysql_query("SELECT * FROM periodo WHERE id = LAST_INSERT_ID() and id_gestion=".$_SESSION['id_ges'].";");
              $row = mysql_fetch_array($result);
              $jTableResult = array();
              $jTableResult['Result'] = "OK";
              $jTableResult['Record'] = $row;
              print json_encode($jTableResult);
            }else{
              $row = mysql_fetch_array($result);
              $jTableResult = array();
              $jTableResult['Result'] = "ERROR";
              $jTableResult['Message'] = "Se solapan las fechas de creacion con otros periodos registrados";
              print json_encode($jTableResult);
            }
            }else{
              $row = mysql_fetch_array($result);
              $jTableResult = array();
              $jTableResult['Result'] = "ERROR";
              $jTableResult['Message'] = "La fecha de inicio debe ser menor que la fecha final";
              print json_encode($jTableResult);
            }

          }else{
            $row = mysql_fetch_array($result);
            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "Ya existe un periodo con el mismo nombre";
            print json_encode($jTableResult);
          }
      }else {
          $row = mysql_fetch_array($result);
          $jTableResult = array();
          $jTableResult['Result'] = "ERROR";
          $jTableResult['Message'] = "No puede tener periodo fuera del rango de gestion";
          print json_encode($jTableResult);
          }
    }else if($_GET["accion"] == "actualizar"){
      $finicio = str_replace('/', '-', $_POST["fecha_inicio"]);
       $finicio = date('Y-m-d', strtotime($finicio));
       $ffin = str_replace('/', '-', $_POST["fecha_fin"]);
       $ffin = date('Y-m-d', strtotime($ffin));
        $result = mysql_query("SELECT COUNT(*) AS conteo FROM periodo where id_gestion=".$_SESSION['id_ges']." and nombre='".$_POST["nombre"]."' and id <> " . $_POST["id"] . " ;");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] < 1){
            if($finicio<$ffin){
                $result = mysql_query("SELECT COUNT(*) AS cont FROM periodo where id_gestion=".$_SESSION['id_ges']." and id <> " . $_POST["id"] . "  and ((fecha_inicio between '".$finicio."' and '".$ffin."') or (fecha_fin between '".$finicio."' and '".$ffin."')) ;");
                $row = mysql_fetch_array($result);
                if($row['cont'] == 0){

                        $result = mysql_query("UPDATE periodo SET nombre='".$_POST["nombre"]."', fecha_inicio='$finicio', fecha_fin='$ffin',
		 estado=".$_POST["estado"]." WHERE id=" . $_POST["id"] . ";");
                        $jTableResult = array();
                        $jTableResult['Result'] = "OK";
                        print json_encode($jTableResult);

                }else{
                    $row = mysql_fetch_array($result);
                    $jTableResult = array();
                    $jTableResult['Result'] = "ERROR";
                    $jTableResult['Message'] = "Se solapan las fechas de creacion con otros periodos registrados";
                    print json_encode($jTableResult);
                }
            }else{
                $row = mysql_fetch_array($result);
                $jTableResult = array();
                $jTableResult['Result'] = "ERROR";
                $jTableResult['Message'] = "La fecha de inicio debe ser menor que la fecha final";
                print json_encode($jTableResult);
            }
        }else{
            $row = mysql_fetch_array($result);
            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "Ya existe un periodo con el mismo nombre";
            print json_encode($jTableResult);
        }





    }else if($_GET["accion"] == "eliminar"){
        $result = mysql_query("DELETE FROM periodo WHERE id= " . $_POST["id"] . ";");
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
