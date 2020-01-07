<?php
require_once('../../config/koneksi.php');
require_once('../../models/database.php');
include "../transaksi/m_penjualan.php";
$connection = new Database($host, $user, $pass, $database);
$jual = new Penjualan($connection);

$id_penjualan = $connection->conn->real_escape_string($_POST['id_penjualan']);
$id_nm_sampah = $connection->conn->real_escape_string($_POST['id_nm_sampah']);
$berat_penjualan = $connection->conn->real_escape_string($_POST['berat_penjualan']);
$harga_penjualan = $connection->conn->real_escape_string($_POST['harga_penjualan']);
$link = $connection->conn->real_escape_string($_POST['date']);

$jual->edit("UPDATE detil_penjualan SET harga_penjualan = '$harga_penjualan' WHERE id_penjualan = '$id_penjualan' AND id_nm_sampah = '$id_nm_sampah'");
echo "<script>window.location='?page=view_penjualan&act=show&date=$link';</script>";

 ?>
