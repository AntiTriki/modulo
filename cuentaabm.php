<?php
session_name('nilds');
session_start();
if(isset($_POST['nivel'])&&$_POST['text']!=''&&isset($_POST['id_tipocuenta'])) {
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("n", $con);
    $_POST['nivel']=$_POST['nivel']+1;
//que correlativo le toca
    $result = mysql_query("SELECT max(correlativo) AS cor FROM cuenta where nivel = " . $_POST["nivel"] . " and id_tipocuenta = " . $_POST["id_tipocuenta"] . " and id_empresa = " . $_SESSION["id_emp"] . ";") or die(mysql_error());
    $row = mysql_fetch_array($result);
    $cor = $row['cor'];
    $cor = $cor + 1;
    $result = mysql_query("SELECT nivel  FROM empresa where id = " . $_SESSION["id_emp"] . ";");
    $row = mysql_fetch_array($result);
    $nivel_empresa = $row['nivel'];
    if($_POST['nivel']<=$nivel_empresa) {
        if ($_POST['nivel'] == 1) {
            //tamaño codigo
            $cod = '.0.0';

            $i = 3;
            if ($row['nivel'] > 3) {
                while ($i < $row['nivel']) {
                    $cod .= '.0';
                    $i++;
                }
            }
            $codigo = $cor . $cod;
        } else {


            //su predecesor

            $result = mysql_query("SELECT codigo as cod_padre FROM cuenta where
                      id=" . $_POST["id_tipocuenta"] . " and id_empresa = " . $_SESSION["id_emp"] . ";");
            $row = mysql_fetch_array($result);
            $extract = explode('.0', $row['cod_padre']);

            $codigo = $extract[0] . '.' . $cor;
            $nivel = $_POST["nivel"];
            $total0 = $nivel_empresa - $nivel;
            $i = 1;
            if ($total0 != 0) {
                while ($i <= $total0) {
                    $codigo .= '.0';
                    $i++;
                }

            }

        }


        $result = mysql_query("SELECT COUNT(*) AS conteo FROM cuenta where
          text='" . $_POST["text"] . "' and nivel =".$_POST['nivel']." and id_empresa = " . $_SESSION["id_emp"] . ";");
        $row = mysql_fetch_array($result);
        if ($row['conteo'] == 0) {
            $result = mysql_query("INSERT INTO cuenta(text, nivel,id_tipocuenta,id_empresa,codigo,correlativo) VALUES(
      '" . $_POST["text"] . "'," . $_POST["nivel"] . "," . $_POST["id_tipocuenta"] . "," . $_SESSION["id_emp"] . ",'" . $codigo . "'," . $cor . ")");
            echo '1';
        } else {
            echo 'No debe existir otra cuenta con el mismo nombre para la misma empresa';

        }
    }else{echo 'No puede ingresar cuentas fuera del nivel establecido'; }


}else{
    echo 'Debe llenar correctamente el formulario';
}
?>
