<?php
session_name('nilds');
session_start();
try{
    $con = mysql_connect("localhost","root","");
    mysql_select_db("n", $con);
    if($_GET["accion"] == "listar")	{
        $result = mysql_query("SELECT * FROM gestion where id_empresa=".$_SESSION['id_emp'].";");
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
       $result = mysql_query("SELECT COUNT(*) AS con FROM gestion where id_empresa=".$_SESSION['id_emp']." and estado=1 ;");
       $row = mysql_fetch_array($result);
       if ($row['con'] <= 1){
        $result = mysql_query("SELECT COUNT(*) AS conteo FROM gestion where id_empresa=".$_SESSION['id_emp']." and nombre='".$_POST["nombre"]."' ;");
        $row = mysql_fetch_array($result);
          if ($row['conteo'] < 1){
            if($finicio<$ffin){
              $result = mysql_query("SELECT COUNT(*) AS cont FROM gestion where id_empresa=".$_SESSION['id_emp']." and ((fecha_inicio between '".$finicio."' and '".$ffin."') or (fecha_fin between '".$finicio."' and '".$ffin."')) ;");
              $row = mysql_fetch_array($result);
              if($row['cont'] == 0){
              $result = mysql_query("INSERT INTO gestion(nombre, fecha_inicio, fecha_fin,estado,id_empresa) VALUES(
      '".$_POST["nombre"]."','".$finicio."','".$ffin."',1,". $_SESSION["id_emp"].")");
              $result = mysql_query("SELECT * FROM gestion WHERE id = LAST_INSERT_ID() and id_empresa=".$_SESSION['id_emp'].";");
              $row = mysql_fetch_array($result);
              $jTableResult = array();
              $jTableResult['Result'] = "OK";
              $jTableResult['Record'] = $row;
              print json_encode($jTableResult);
            }else{
              $row = mysql_fetch_array($result);
              $jTableResult = array();
              $jTableResult['Result'] = "ERROR";
              $jTableResult['Message'] = "Se solapan las fechas de creacion con otras registradas";
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
            $jTableResult['Message'] = "Ya existe una gestion con el mismo nombre";
            print json_encode($jTableResult);
          }
      }else {
          $row = mysql_fetch_array($result);
          $jTableResult = array();
          $jTableResult['Result'] = "ERROR";
          $jTableResult['Message'] = "No puede tener 3 gestiones abiertas";
          print json_encode($jTableResult);
        }
    }else if($_GET["accion"] == "actualizar"){


       //validaciones tipo crear.... 2 gestiones abiertas mismo nombre dentro de la gestion etc
        //Se podrá modificar (fechas) siempre y cuando no tenga periodos
        //Se podrá eliminar de la BD siempre que no este relacionado
        //No se pueden modificar los datos de una gestión cerrada
        //No pueden existir mas 2 gestion abiertas
        //No pueden Existir 2 gestiones con el mismo nombre para la misma empresa

        $finicio = str_replace('/', '-', $_POST["fecha_inicio"]);
        $finicio = date('Y-m-d', strtotime($finicio));
        $ffin = str_replace('/', '-', $_POST["fecha_fin"]);
        $ffin = date('Y-m-d', strtotime($ffin));
        $result = mysql_query("SELECT COUNT(*) AS conteo FROM gestion where id_empresa=".$_SESSION['id_emp']." and estado=1 ;");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] < 3){
            $result = mysql_query("SELECT COUNT(*) AS conteo FROM gestion where id_empresa=".$_SESSION['id_emp']." and nombre='".$_POST["nombre"]."' and id <> " . $_POST["id"] . " ;");
            $row = mysql_fetch_array($result);
            if ($row['conteo'] < 1){
                if($finicio<$ffin){
                    $result = mysql_query("SELECT COUNT(*) AS cont FROM gestion where id_empresa=".$_SESSION['id_emp']." and id <> " . $_POST["id"] . "  and ((fecha_inicio between '".$finicio."' and '".$ffin."') or (fecha_fin between '".$finicio."' and '".$ffin."')) ;");
                    $row = mysql_fetch_array($result);
                    if($row['cont'] == 0){
                        $result = mysql_query("SELECT COUNT(*) AS cont FROM periodo where id_gestion=".$_POST['id']." ");
                        $row = mysql_fetch_array($result);
                        if($row['cont'] == 0) {
                            $result = mysql_query("UPDATE gestion SET nombre='" . $_POST["nombre"] . "', fecha_inicio='$finicio', fecha_fin='$ffin',
		 estado=" . $_POST["estado"] . " WHERE id=" . $_POST["id"] . ";");
                            $jTableResult = array();
                            $jTableResult['Result'] = "OK";
                            print json_encode($jTableResult);
                        }else{
                            $result = mysql_query("UPDATE gestion SET nombre='" . $_POST["nombre"] . "', 
		 estado=" . $_POST["estado"] . " WHERE id=" . $_POST["id"] . ";");
                            $jTableResult = array();
                            $jTableResult['Result'] = "OK";
                            $jTableResult['Message']="No se pueden editar las fechas porque tiene creados periodos en esta gestion";
                            print json_encode($jTableResult);
                        }
                }else{
                    $row = mysql_fetch_array($result);
                    $jTableResult = array();
                    $jTableResult['Result'] = "ERROR";
                    $jTableResult['Message'] = "Se solapan las fechas de creacion con otras registradas";
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
                $jTableResult['Message'] = "Ya existe una gestion con el mismo nombre";
                print json_encode($jTableResult);
            }
    }else {
        $row = mysql_fetch_array($result);
        $jTableResult = array();
        $jTableResult['Result'] = "ERROR";
        $jTableResult['Message'] = "No puede tener 3 gestiones abiertas";
        print json_encode($jTableResult);
    }

    }else if($_GET["accion"] == "eliminar"){
        $result = mysql_query("SELECT count(*) as cont FROM periodo where id_gestion=".$_POST["id"].";");
        $row = mysql_fetch_array($result);
        if($row['cont'] == 0){
        $result = mysql_query("DELETE FROM gestion WHERE id= " . $_POST["id"] . ";");
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }else{
            $row = mysql_fetch_array($result);
            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "No puede eliminar teniendo periodos en la gestion";
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
