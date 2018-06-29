<?php
session_name('nilds');
session_start();


//qfalta el ultimo nivel a q empresa pertenece
    //$result = mysql_query("SELECT max(correlativo) AS cor FROM cuenta where nivel = " . $_POST["nivel"] . " and id_tipocuenta = " . $_POST["id_tipocuenta"] . " and id_empresa = " . $_SESSION["id_emp"] . ";") or die(mysql_error());


$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'n';

//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

//get search term
$searchTerm = $_GET['term'];

//get matched data from skills table
$query = $db->query("SELECT * FROM cuenta WHERE text LIKE '%".$searchTerm."%' ");

while ($row = $query->fetch_assoc()) {

    array_push($searchArray, array('label'=> $row['codigo']." - ".$row['text'], 'value' => $row['id'], 'id'=>$row['id']));
}

//return json data
echo json_encode($data);

?>
