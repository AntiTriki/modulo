<?php
session_name('nilds');
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "n";

$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);
$result = mysql_query("	SELECT * FROM CATEGORIA WHERE ID =".$_POST['dato']." ");
if ($result) {
    $i = 1;
    while ($row = mysql_fetch_assoc($result)) {
        $array['id'] = $row['id'];
        $array['id_tipocategoria'] = $row['id_tipocategoria'];
        $array['text'] = $row['text'];
        $array['descripcion'] = $row['descripcion'];
       $i++;
        $array['result']=1;
    }

}else
{
    $array['result']='0';
}
print json_encode($array);


?>
