<?php
include "m_c_penabungan.php";
$cj = new C_Jual($connection);
$totaluang = 0;
$a = 1;

if (@$_GET['act'] == '') {
  $tampilidpembelian = $cj->tampilidpembelian();
  while ($dataidpembelian = $tampilidpembelian->fetch_object()) {
    $id_pembelianp = $dataidpembelian->id_pembelian;
    $tampil =  $cj->tampilsemuadata();
        $hasilakhir = 0;
      while ($data = $tampil->fetch_object()) {
        $id_pembelian = $data->id_pembelian;
        $nm_sampah = $data->nm_sampah;
        $berat_pembelian = $data->berat_pembelian;
        $harga_penjualan = $data->harga_penjualan;
        $id_penjualan = $data->id_penjualan;
        if ($id_pembelianp == $id_pembelian) {
          if ($id_pembelianp != $id_pembelian) {
          }
          $hasil = $berat_pembelian * $harga_penjualan * 0.85;
          $hasilakhir = $hasilakhir + $hasil;
          $totaluang = $totaluang + $hasil;
        }
      }
    $cj->tambahct($id_pembelianp, $hasilakhir);
  }
  $cj->tambahcp($id_penjualan, $totaluang);
}
echo "<script>window.location='?page=penjualan';</script>";

 ?>
