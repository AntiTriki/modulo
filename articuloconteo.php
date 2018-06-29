<?php
$cxn = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
$cxn->set_charset("utf8");
$result = $cxn->query("SELECT
                                                                                               cantidad AS nivel
                                                                                              FROM articulo c
                                                                                              WHERE c.id=". $_POST["id"]." ");
$row = $result->fetch_assoc();

$i=1;
for ($i;$i<=$row['nivel'];$i++) {

    echo '<option value="'.$i.'">'.$i.'</option>';

}
$cxn->close();

?>