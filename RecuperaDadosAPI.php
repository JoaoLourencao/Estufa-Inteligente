<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="sistemamonitoramento";

$conn = mysqli_connect($servername, $username, $password, $database);

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == "GET"){

	$sql ="SELECT * FROM SENSORES";
	$res = mysqli_query($conn,$sql);
	$res = mysqli_fetch_all($res);

	echo json_encode($res);
}
?> 