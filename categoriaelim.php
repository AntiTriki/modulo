<?php
session_name('nilds');
session_start();

    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("n", $con);



        $result = mysql_query("SELECT COUNT(*) AS conteo FROM categoria where
          id_tipocategoria=" . $_POST["idel"] . ";");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] == 0) {


            $result = mysql_query("DELETE FROM categoria where id =".$_POST["idel"]."  ");
            echo '1';

} else {
            echo 'No puede eliminar una categoria relacionada, debe eliminar las dependientes';

        }




?>
