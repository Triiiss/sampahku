<?php
require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/nasabah/m_nasabah.php";
$connection = new Database($host, $user, $pass, $database);
$nsb = new Nasabah($connection);

$content = '
<style>
.table { border-collapse:collapse; }
.table th { padding:8px 5px; background-color:#f60; color:#fff; }
.table td { padding:3px; }
img { width:70px; }
</style>
';

$norek = (@$_GET['norek']);
$tampil = $nsb->tampil($norek);
while ($data = $tampil->fetch_object()) {

$content .= '
<page>
  <div style="padding:4mm; border:1px solid;" align="center">
    <span style="font-size:25px;">Buku Tabungan</span>
  </div>

  <div style="padding:20px 0 10px 0; forn-size:15px;">
    Norek : '.$norek.'
  </div>
  <div style="padding:20px 0 10px 0; forn-size:15px;">
    Nama Nasabah : '.$data->nm_nasabah.'
  </div>
  <div style="padding:20px 0 10px 0; forn-size:15px;">
    RT : '.$data->rt.'
  </div>
  <div style="padding:20px 0 10px 0; forn-size:15px;">
    Alamat : '.$data->alamat.'
  </div>
  <div style="padding:20px 0 10px 0; forn-size:15px;">
    No Handphone : '.$data->no_hp.'
  </div>
  <div style="padding:20px 0 10px 0; forn-size:15px;">
    Email : '.$data->email.'
  </div>

  <table border="1px" class="table">
    <tr>
      <th>No.</th>
      <th>Tanggal</th>
      <th>Status</th>
      <th>Nama Sampah</th>
      <th>Berat Sampah</th>
      <th>Harga Sampah/KG</th>
      <th>Subnominal</th>
      <th>Subtotal</th>
    </tr>';
  }
    $total_berat = 0;
    $saldotpp = 0;
    $total_uang = 0;
    $total = 0;
    $no = 1;
    $tampiltp = $nsb->a($norek);
    while ($datatp = $tampiltp->fetch_object()) {
      $subtotal = 0;
      $tanggaltp = $datatp->tanggal;
      $saldotp = $datatp->saldo_tabungan;
      $status = $datatp->status;
      $id_pembeliantp = $datatp->id_pembelian;

      if ($status == 'penabungan') {
        $tampildp = $nsb->tampilcetakdetilpembelian($norek);
        while ($datadp = $tampildp->fetch_object()) {
          $subnominal = 0;
          $nm_sampah = $datadp->nm_sampah;
          $id_pembelian = $datadp->id_pembelian;
          $berat_pembelian = $datadp->berat_pembelian;
          $tanggaldp = $datadp->tanggal;
          $harga_penjualan = $datadp->harga_penjualan * 0.85;
          $subnominal = $berat_pembelian * $harga_penjualan;
          $subtotal = $subtotal + $subnominal;
          $total_uang = $subtotal;
          if ($id_pembeliantp == $id_pembelian) {
            $content .='
            <tr>
            <td></td>
            <td>'.$tanggaldp.'</td>
            <td>'.$status.'</td>
            <td>'.$nm_sampah.'</td>
            <td>'.$berat_pembelian.' kg</td>
            <td>Rp. '.number_format($harga_penjualan, 2, ",", ".").'</td>
            <td>Rp. '.number_format($subnominal, 2, ",", ".").'</td>
            <td>Rp. '.number_format($subtotal, 2, ",", ".").'</td>
            </tr>
            ';
          }
        }
        $content .='
        <tr>
          <td>'.$no++.'</td>
          <td></td>
          <td>'.$status.'</td>
          <td></td>
          <td></td>
          <td></td>
          <th>Rp. '.number_format($saldotp, 2, ",", ".").'</th>
          <td></td>
        </tr>
        ';
      } else if ($status == 'penarikan') {
        $saldotpp = $saldotpp + $saldotp;
        $subtotal = $total_uang - $saldotpp;
        $content .='
        <tr>
          <td>'.$no++.'</td>
          <td>'.$tanggaltp.'</td>
          <td>'.$status.'</td>
          <td></td>
          <td></td>
          <td></td>
          <th>Rp. '.number_format($saldotp, 2, ",", ".").'</th>
          <td>Rp. '.number_format($subtotal, 2, ",", ".").'</td>
        </tr>
        ';
      }
    }
      $content .='
      <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <th>Rp. '.number_format($subtotal, 2, ",", ".").'</th>
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
$html2pdf->output('laporan_barang.pdf');
 ?>
