<?php
require_once('../../config/koneksi.php');
require_once('../../models/database.php');
include "../transaksi/m_penarikan.php";
$connection = new Database($host, $user, $pass, $database);
$tarik = new Penarikan($connection);

$norek = $connection->conn->real_escape_string($_POST['norek']);
$saldo_tabungan = $connection->conn->real_escape_string($_POST['saldo_tabungan']);

$tarik->tambahtarik("INSERT INTO penarikan (tanggal, norek) VALUES (now(), '$norek')");
$tampil = $tarik->tampiltarik();
while ($data = $tampil->fetch_object()) {
  $id_penarikan = $data->id_penarikan;
}
$tarik->tambahct("INSERT INTO catatan_tabungan (saldo_tabungan, status, id_penarikan, id_pembelian) VALUES ($saldo_tabungan, 'penarikan', '$id_penarikan', '0')");
echo "<script>window.location='?page=penarikan';</script>";

 ?>
