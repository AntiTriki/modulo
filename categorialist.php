<?php
session_name('nilds');
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "n";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$result = mysqli_query($conn, "SELECT * FROM categoria where id_tipocategoria <> '#' and id_empresa = ".$_SESSION['id_emp']." order by id DESC ");
while ($row = mysqli_fetch_array($result)){

    $arra= array();
    $arra['Value']=$row['id'];
    $arra['DisplayText']=$row['text'];
    $rows[] =$arra;

}


$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Options'] = $rows;
print json_encode($jTableResult);


?>
