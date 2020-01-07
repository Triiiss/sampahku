<?php
require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/transaksi/m_pembelian.php";
$connection = new Database($host, $user, $pass, $database);
$beli = new Pembelian($connection);

$content = '
<style>
.table { border-collapse:collapse; }
.table th { padding:8px 5px; background-color:#f60; color:#fff; }
.table td { padding:3px; }
img { width:70px; }
</style>
';


$content .= '
<page>
  <div style="padding:4mm; border:1px solid;" align="center">
    <span style="font-size:25px;">Laporan Pembelian</span>
  </div>

  <div style="padding:20px 0 10px 0; forn-size:15px;">
    Laporan Data Pembelian
  </div>

  <table border="1px" class="table">
    <tr>
      <th>No.</th>
      <th>Nama Nasabah</th>
      <th>RT</th>
      <th>Tanggal</th>
      <th>Nama Sampah</th>
      <th>Berat Sampah</th>
      <th>Harga Sampah/kg</th>
      <th>Subnominal</th>
    </tr>';
    $total_berat = 0;
    $total_uang = 0;
    $total = 0;
    $no = 1;
    if (@$_POST['cetak_pembelian']) {
      $tampil = $beli->tampilcetakpembelian_tanggal(@$_POST['tgl_a'], @$_POST['tgl_b']);
    } else {
      $tampil = $beli->tampilcetakpembelian();
    }
    while ($data = $tampil->fetch_object()) {
      $nm_nasabah = $data->nm_nasabah;
      $berat_pembelian = $data->berat_pembelian;
      $harga_penjualan = $data->harga_penjualan;
      $total = $berat_pembelian * $harga_penjualan * 0.85;
      $total_berat = $total_berat + $berat_pembelian;
      $total_uang = $total_uang + $total;
      $content .='
      <tr>
        <td align="center">'.$no++.'</td>
        <td>'.$nm_nasabah.'</td>
        <td>'.$data->rt.'</td>
        <td>'.date('d F Y', strtotime($data->tanggal)).'</td>
        <td>'.$data->nm_sampah.'</td>
        <td>'.$data->berat_pembelian.' kg</td>
        <td>Rp. '.number_format($data->harga_penjualan, 2, ",", ".").'</td>
        <td>Rp. '.number_format($total, 2, ",", ".").'</td>
      </tr>
      ';
    }

$content .='
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td>Berat Total</td>
  <td>'.$total_berat.' kg</td>
  <td>Subtotal</td>
  <td>Rp. '.number_format($total_uang, 2, ",", ".").'</td>
</tr>
<tr></tr>

';

if (@$_POST['cetak_pembelian']) {
  $tampil = $beli->tampildetailpembelianberatsampah_tanggal(@$_POST['tgl_a'], @$_POST['tgl_b']);
} else {
  $tampil = $beli->tampildetailpembelianberatsampah();
}
while ($data = $tampil->fetch_object()) {
  $nm_sampah = $data->nm_sampah;
  $berat_pembelian = $data->berat_pembelian;
$content .='
<tr>
<td></td>
<td>'.$nm_sampah.'</td>
<td>'.$berat_pembelian.' kg</td>
</tr>
';
}



    // $no = 1;
    // if (@$_GET['id'] != '') {
    //   $tampil = $brg->tampil(@$_GET['id']);
    // } else {
    //   if(@$_POST['cetak_barang']) {
    //     $tampil = $brg->tampil_tgl(@$_POST['tgl_a'], @$_POST['tgl_b']);
    //   } else {
    //     $tampil = $brg->tampil();
    //   }
    // }
    // while ($data = $tampil->fetch_object()) {
    //   $content .='
    //   <tr>
    //     <td align="center">'.$no++.'</td>
    //     <td>'.$data->nama_brg.'</td>
    //     <td>Rp. '.number_format($data->harga_brg, 2, ",", ".").'</td>
    //     <td>'.$data->stok_brg.'</td>
    //     <td><img src="../assets/img/barang/'.$data->gbr_brg.'"></td>
    //   </tr>
    //   ';
    // }
$content .= '
  </table>
</page>
';

require '../assets/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html2pdf->writeHTML($content);
$html2pdf->output('laporan_barang.pdf');
 ?>
