<?php
require_once('../../config/koneksi.php');
require_once('../../models/database.php');
include "../sampah/m_sampah.php";
$connection = new Database($host, $user, $pass, $database);
$smp = new Sampah($connection);

$id_nm_sampah = $_POST['id_nm_sampah'];
$nm_sampah = $connection->conn->real_escape_string($_POST['nm_sampah']);

$smp->edit("UPDATE nama_sampah SET nm_sampah = '$nm_sampah' WHERE id_nm_sampah = '$id_nm_sampah'");
echo "<script>window.location='?page=sampah';</script>";

 ?>
