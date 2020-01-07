<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "hackathon";

$koneksi = mysqli_connect("localhost","root","","hackathon");

// Koneksi ke MySQL dengan PDO
$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $user, $pass);

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 ?>
