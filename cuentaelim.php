<?php
session_name('nilds');
session_start();

    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("n", $con);



        $result = mysql_query("SELECT COUNT(*) AS conteo FROM cuenta where
          id_tipocuenta=" . $_POST["idel"] . ";");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] == 0) {


            $result = mysql_query("DELETE FROM cuenta where id =".$_POST["idel"]."  ");
            echo '1';

} else {
            echo 'No puede eliminar una cuenta relacionada, debe eliminar las dependientes';

        }




?>
