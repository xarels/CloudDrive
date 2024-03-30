<?php

$localhost = "127.0.0.1";
$dbUsername = "root";
$dbPassword = "";
$dbName = "cloud";

//Connection
$connection = new mysqli($localhost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

?>