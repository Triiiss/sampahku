<?php
require_once('../../config/koneksi.php');
require_once('../../models/database.php');
include "../pengurus/m_pengurus.php";
$connection = new Database($host, $user, $pass, $database);
$urus = new Pengurus($connection);

$id_pengurus = $_POST['id_pengurus'];
$username = $connection->conn->real_escape_string($_POST['username']);
$status = $connection->conn->real_escape_string($_POST['status']);
$no_hp = $connection->conn->real_escape_string($_POST['no_hp']);
$email = $connection->conn->real_escape_string($_POST['email']);
$alamat = $connection->conn->real_escape_string($_POST['alamat']);

$urus->edit("UPDATE pengurus SET username = '$username', status = '$status', no_hp = '$no_hp', email = '$email', alamat = '$alamat' WHERE id_pengurus = '$id_pengurus'");
echo "<script>window.location='?page=pengurus';</script>";

 ?>
