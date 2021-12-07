<?php
	$host = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "Spider";

	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Nooooooooo!" . $conn->connect_error);
	}
?>
