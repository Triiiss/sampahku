<?php
require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/transaksi/m_penjualan.php";
$connection = new Database($host, $user, $pass, $database);
$jual = new Penjualan($connection);

$content = '
<style>
.table { border-collapse:collapse; }
.table th { padding:8px 5px; background-color:#f60; color:#fff; }
.table td { padding:3px; }
img { width:70px; }
</style>
';

$tangal = (@$_GET['date']);
$content .= '
<page>
  <div style="padding:4mm; border:1px solid;" align="center">
    <span style="font-size:25px;">Laporan Penjualan</span>
  </div>

  <div style="padding:20px 0 10px 0; forn-size:15px;">
    Laporan Penjualan Tanggal '.date('d F Y', strtotime($tangal)).'
  </div>

  <table border="1px" class="table">
    <tr>
      <th>No.</th>
      <th>Nama Sampah</th>
      <th>Berat Sampah</th>
      <th>Harga per KG</th>
      <th>Harga keseluruhan</th>
    </tr>';
    $berat = 0;
    $total = 0;
    $no = 1;
    if (@$_GET['date'] != '') {
      $date = (@$_GET['date']);
      $tampil = $jual->tampildetailpenjualan();
    } else {
      // if(@$_POST['cetak_barang']) {
      //   $tampil = $brg->tampil_tgl(@$_POST['tgl_a'], @$_POST['tgl_b']);
      // } else {
      //   $tampil = $brg->tampil();
      // }
    }
    while($data = $tampil->fetch_object()) {
      $tanggal = $data->tanggal;
      $nm_sampah = $data->nm_sampah;
      $berat_penjualan = $data->berat_penjualan;
      $harga_penjualan = $data->harga_penjualan;
      $totalharga = $berat_penjualan * $harga_penjualan;

      if ($tanggal == $date) {
        $total = $total + $totalharga;
        $berat = $berat + $berat_penjualan;
      $content .='
      <tr>
        <td align="center">'.$no++.'</td>
        <td>'.$nm_sampah.'</td>
        <td>'.$berat_penjualan.' kg</td>
        <td>Rp. '.number_format($harga_penjualan, 2, ",", ".").'</td>
        <td>Rp. '.number_format($totalharga, 2, ",", ".").'</td>
      </tr>
      ';
    }
  }
$content .= '
<tr>
  <td align="center"></td>
  <td>Berat Samapah Yang dijual</td>
  <td>'.$berat.' kg</td>
  <td>Total uang yang diterima</td>
  <td>Rp. '.number_format($total, 2, ",", ".").'</td>
</tr>

';
$content .= '
  </table>
</page>
';

require '../assets/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html2pdf->writeHTML($content);
$html2pdf->output('laporan_penjualan.pdf');
 ?>

?>
