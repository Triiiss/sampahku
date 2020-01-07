<?php
require_once('../../config/koneksi.php');
require_once('../../models/database.php');
include "../sampah/m_jn_sampah.php";
$connection = new Database($host, $user, $pass, $database);
$js = new Jenis_Sampah($connection);

$id_jn_sampah = $_POST['id_jn_sampah'];
$nm_jn_sampah = $connection->conn->real_escape_string($_POST['nm_jn_sampah']);

$js->edit("UPDATE jenis_sampah SET nm_jn_sampah = '$nm_jn_sampah' WHERE id_jn_sampah = '$id_jn_sampah'");
echo "<script>window.location='?page=jenis_sampah';</script>";

 ?>
