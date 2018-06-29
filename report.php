<?php
require_once __DIR__ . "/vendor/autoload.php";
 
use Jaspersoft\Client\Client;
 
$c = new Client(
				"http://localhost:8080/jasperserver/login.html",
				"jasperadmin",
				"jasperadmin",
				"organization_1"
			);



// Let the client wait one whole minute before timing out
$c->setRequestTimeout(60);            
$info = $c->serverInfo();
 
print_r($info);  




?>