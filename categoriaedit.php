<?php
session_name('nilds');
session_start();

    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("n", $con);




        $result = mysql_query("SELECT COUNT(*) AS conteo FROM categoria where
          text='" . $_POST["texte"] . "'  and id_empresa = " . $_SESSION["id_emp"] . ";");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] == 0) {
            $result = mysql_query("UPDATE categoria set descripcion='".$_POST["nivele"]."', text ='" . $_POST["texte"] . "' where id =".$_POST["ide"]."  ");
            echo '1';
        } else {
            echo 'No debe existir otra categoria con el mismo nombre para la misma empresa';

        }




?>
