<?php
session_name('nilds');
session_start();

    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("n", $con);
    $_POST['nivele'];
//qu


        $result = mysql_query("SELECT COUNT(*) AS conteo FROM cuenta where
          text='" . $_POST["texte"] . "' and nivel =".$_POST['nivele']." and id_empresa = " . $_SESSION["id_emp"] . ";");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] == 0) {
            $result = mysql_query("UPDATE cuenta set text ='" . $_POST["texte"] . "' where id =".$_POST["ide"]."  ");
            echo '1';
        } else {
            echo 'No debe existir otra cuenta con el mismo nombre para la misma empresa';

        }




?>
