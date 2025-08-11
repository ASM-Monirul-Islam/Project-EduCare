<?php
$server = "localhost";
$user = "root";
$password = "";

try{
	$conn = new PDO("mysql: host=$server; dbname=edu-care", $user, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "connected";
} catch(PDOException $e) {
	echo "failed to connect ".$e->getMessage();
}
?>