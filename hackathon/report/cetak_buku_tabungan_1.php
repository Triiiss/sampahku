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
    $total_uang = 0;
    $total = 0;
    $no = 1;
    $tampiltp = $nsb->a($norek);
    while ($datatp = $tampiltp->fetch_object()) {
      $tanggaltp = $datatp->tanggal;
      $saldotp = $datatp->saldo_tabungan;
      $status = $datatp->status;
      // code...
    $tampilp = $nsb->tampilcetakdetilpembelian($norek);
    while ($datap = $tampilp->fetch_object()) {
      // $statusp = $datap->status;
      $tanggalp = $datap->tangal;
      $nm_sampah = $datap->nm_sampah;
      $nm_nasabah = $datap->nm_nasabah;
      $berat_pembelian = $datap->berat_pembelian;
      $harga_penjualan = $datap->harga_penjualan * 0.85;
      $total_berat = $total_berat + $berat_pembelian;
      $total_pembelian = $berat_pembelian * $harga_penjualan;
      $total_uang = $total_uang + $total_pembelian;
      // $tampilpn = $nsb->tampilcetakpenarikan($norek);
      // while ($datapn = $tampilpn->fetch_object()) {
      //   $tanggalpn = $datapn->tanggal;
      //   $total_penarikan = $datapn->saldo_penarikan;
      //   $total_uang = $total_uang - $total_penarikan;
      //   $statuspn = $datapn->status;
      //   $nm_nasabah = $datap->nm_nasabah;
      //   // if ($statuspn == 'penarikan') {
      //     if ($tanggalp == $tanggalpn) {
      //       // code...
      //       $content .='
      //       <tr>
      //       <td align="center">'.$no++.'</td>
      //       <td>'.$tanggalpn.'</td>
      //       <td>'.$statuspn.'</td>
      //       <td></td>
      //       <td></td>
      //       <td></td>
      //       <td>'.$total_penarikan.'</td>
      //       <td></td>
      //       </tr>
      //       ';
      //       // break;
      //     // }
      //   }

      $content .='
      <tr>
        <td align="center">'.$no++.'</td>
        <td>'.$tanggalp.'</td>
        <td>pembelian</td>
        <td>'.$nm_sampah.'</td>
        <td>'.$berat_pembelian.'</td>
        <td>'.$harga_penjualan.'</td>
        <td>'.$total_pembelian.'</td>
        <td>'.$total_uang.'</td>
      </tr>
      ';
      // break;
    // }
    if ($tanggalp == $tanggaltp) {
      // code...
      $content .='
      <tr>
      <td align="center">'.$no++.'</td>
      <td>'.$tanggalp.'</td>
      <td>'.$status.'</td>
      <td></td>
      <td></td>
      <td></td>
      <th>Saldo</th>
      <td>'.$total_uang.'</td>
      </tr>
      ';
    }

    if ($status == 'penarikan') {
      $tampiltpn = $nsb->pn($norek);
      while ($datatpn = $tampiltpn->fetch_object()) {
      $saldopn = $datapn->saldo_tabungan;
      $tanggalpn = $datapn->tanggal;
      $content .='
      <tr>
      <td align="center">'.$no++.'</td>
      <td>'.$tanggalpn.'</td>
      <td>penarikan</td>
      <td></td>
      <td></td>
      <td></td>
      <th>Saldo</th>
      <td>'.$saldopn.'</td>
      </tr>
      ';

      // code...
    }
    }
  }
  // break;
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
