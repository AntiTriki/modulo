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
}else {
    $sql = "SELECT * FROM cuenta where id_empresa=" . $_SESSION['id_emp'] . " ";
    $res = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    if ($res->num_rows <= 0) {
        //add condition when result is zero
        echo 'nada';
    } else {
        //iterate on results row and create new index array of data

        while ($row = mysqli_fetch_assoc($res)) {
          $row['id'] = $row['id'] !== NULL ? (int)$row['id'] : '#';


            $result[] = $row;
        }


        // Build array of item references:


        echo json_encode($result);

    }

}
?>
