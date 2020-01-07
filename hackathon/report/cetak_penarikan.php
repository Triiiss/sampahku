<?php
require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/transaksi/m_penarikan.php";
$connection = new Database($host, $user, $pass, $database);
$tarik = new Penarikan($connection);

$tanggal1 = (@$_POST['tgl_a']);
$tanggal2 = (@$_POST['tgl_b']);
$content = '
<style>
.table { border-collapse:collapse; }
.table th { padding:8px 5px; background-color:#f60; color:#fff; }
.table td { padding:3px; }
img { width:70px; }
</style>
';

// $content .='';

$content .= '
<page>
  <div style="padding:4mm; border:1px solid;" align="center">
    <span style="font-size:25px;">Laporan Penarikan</span>
  </div>

  <div style="padding:20px 0 10px 0; forn-size:15px;">
    Laporan Data Pernarikan
  </div>

  <table border="1px" class="table">
    <tr>
      <th>No.</th>
      <th>No.Rek</th>
      <th>Nama</th>
      <th>RT</th>
      <th>No Handphone</th>
      <th>Tanggal</th>
      <th>Saldo Awal</th>
      <th>Total Penarikan</th>
      <th>Saldo Akhir</th>
    </tr>';
    $no = 1;
    if (@$_POST['cetak_penarikan']) {
      $tampilp = $tarik->tampilsaldopembelian_tanggal(@$_POST['tgl_a'], @$_POST['tgl_b']);
    } else {
      $tampilp = $tarik->tampilsaldopembelian();
    }
    while ($datap = $tampilp->fetch_object()) {
      $total_penarikan = 0;
      $norekp = $datap->norek;
      $nm_nasabah = $datap->nm_nasabah;
      $rt = $datap->rt;
      $no_hp = $datap->no_hp;
      $saldo_pembelian = $datap->saldo_pembelian;
      if (@$_POST['cetak_penarikan']) {
        $tampilpn = $tarik->tampilsaldopenarikan_tanggal(@$_POST['tgl_a'], @$_POST['tgl_b']);
      } else {
        $tampilpn = $tarik->tampilsaldopenarikan();
      }
      while ($datapn = $tampilpn->fetch_object()) {
        $norekpn = $datapn->norek;
        $saldo_penarikan = $datapn->saldo_penarikan;
        $date = $datapn->tanggal;
        if ($norekp == $norekpn) {
        $content .='
        <tr>
          <td align="center">'.$no++.'</td>
          <td>'.$norekp.'</td>
          <td>'.$nm_nasabah.'</td>
          <td>'.$rt.'</td>
          <td>'.$no_hp.'</td>
          <td>'.$date.'</td>
          <td>Rp. '.number_format($saldo_pembelian, 2, ",", ".").'</td>
          ';
          $saldo_pembelian = $saldo_pembelian - $saldo_penarikan;
          $content .='
          <td>Rp. '.number_format($saldo_penarikan, 2, ",", ".").'</td>
          <td>Rp. '.number_format($saldo_pembelian, 2, ",", ".").'</td>
        </tr>

        ';
      }
    }
    }

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
