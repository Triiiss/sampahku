<?php
require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/sampah/m_sampah.php";
$connection = new Database($host, $user, $pass, $database);
$smp = new Sampah($connection);

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
    <span style="font-size:25px;">Data Sampah Bank Sampah Asoka</span>
  </div>

  <div style="padding:20px 0 10px 0; forn-size:15px;">
    Laporan Data Sampah Yang Bisa di Terima
  </div>

  <table border="1px" class="table">
    <tr>
      <th>No.</th>
      <th>Jenis Sampah</th>
      <th>Nama Sampah</th>
    </tr>';
    $no = 1;
    $tampil = $smp->tampil();
    while ($data = $tampil->fetch_object()) {
      $content .='
      <tr>
        <td align="center">'.$no++.'</td>
        <td>'.$data->nm_jn_sampah.'</td>
        <td>'.$data->nm_sampah.'</td>
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
