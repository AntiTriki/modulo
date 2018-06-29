<?php 
include "config.php";

$id = $_POST['id'];

// Delete record
$query = "DELETE FROM posts WHERE id=".$id;
mysql_query($query);

echo 1;