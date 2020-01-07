<?php
require_once('../../config/koneksi.php');
require_once('../../models/database.php');
include "../transaksi/m_pembelian.php";
$connection = new Database($host, $user, $pass, $database);
$beli = new Pembelian($connection);

$id_pembelian = $_POST['id_pembelian'];
$id_nm_sampah = $_POST['id_nm_sampah'];
$berat_pembelian = $connection->conn->real_escape_string($_POST['berat_pembelian']);
$nik = $_POST['nik'];

$beli->edit("UPDATE detail_pembelian SET berat_pembelian = '$berat_pembelian' WHERE id_pembelian = '$id_pembelian' AND id_nm_sampah = '$id_nm_sampah'");
// $link = (@$_GET['nik']);
// header("location: ?page=view_pembelian&act=show&nik=$link");
echo "<script>window.location='?page=view_pembelian&act=show&nik=$nik';</script>";

 ?>
