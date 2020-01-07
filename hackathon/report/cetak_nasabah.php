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


$content .= '
<page>
  <div style="padding:4mm; border:1px solid;" align="center">
    <span style="font-size:25px;">Data Nasabah Bank Sampah Asoka</span>
  </div>

  <div style="padding:20px 0 10px 0; forn-size:15px;">
    Laporan Data Barang
  </div>

  <table border="1px" class="table">
    <tr>
      <th>No.</th>
      <th>No.Rekening</th>
      <th>Nama Nasabah</th>
      <th>RT</th>
      <th>Alamat</th>
      <th>No Handphone</th>
      <th>Email</th>
    </tr>';
    $no = 1;
    $tampil = $nsb->tampil();
    while ($data = $tampil->fetch_object()) {
      $content .='
      <tr>
        <td align="center">'.$no++.'</td>
        <td>'.$data->norek.'</td>
        <td>'.$data->nm_nasabah.'</td>
        <td>'.$data->rt.'</td>
        <td>'.$data->alamat.'</td>
        <td>'.$data->no_hp.'</td>
        <td>'.$data->email.'</td>
      </tr>
      ';
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
