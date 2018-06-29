<?php
session_name('nilds');
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "n";

$con = mysql_connect("localhost","root","");
mysql_select_db("n", $con);
$result = mysql_query("	SELECT * FROM cuenta WHERE ID =".$_POST['dato']." ");
if ($result) {
    $i = 1;
    while ($row = mysql_fetch_assoc($result)) {
        $array['id'] = $row['id'];
        $array['id_tipocuenta'] = $row['id'];
        $array['nivel'] = $row['nivel'];
        $array['text'] =$row['codigo'].' - '.$row['text'];
        $array['nombre'] =$row['text'];

       $i++;
        $array['result']=1;
    }

}else
{
    $array['result']='0';
}
print json_encode($array);


?>
