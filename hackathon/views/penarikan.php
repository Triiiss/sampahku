<?php
include "models/transaksi/m_penarikan.php";
$tarik = new Penarikan($connection);

if (@$_GET['act'] == '') {
 ?>
<div class="row">
  <div class="col-lg-12">
    <h1>Penarikan</h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Transaksi</a></li>
      <li class="active">Penarikan</li>
    </ol>
  </div>
</div><!-- /.row -->

<div class="row" id="tambah">
  <div class="col-lg-12">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" id="datatables">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Nasabah</th>
            <th>RT</th>
            <th>No Handphone</th>
            <th>Saldo</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampilpenabungan = $tarik->tampilpenabungan();
          while ($datapenabungan = $tampilpenabungan->fetch_object()) {
            $nm_nasabah = $datapenabungan->nm_nasabah;
            $norekp = $datapenabungan->norek;
            $rt = $datapenabungan->rt;
            $no_hp = $datapenabungan->no_hp;
            $saldo_penabungan = $datapenabungan->saldo_penabungan;
            $saldo = $saldo_penabungan;
          $tampilpenarikan = $tarik->tampilpenarikan();
          while ($datapenarikan = $tampilpenarikan->fetch_object()) {
            $norekpn = $datapenarikan->norek;
            $saldo_penarikan = $datapenarikan->saldo_penarikan;
            if ($norekp == $norekpn) {
              $saldo = $saldo_penabungan - $saldo_penarikan;
              break;
            } else {
              $saldo = $saldo_penabungan;
            }
          }
           ?>
          <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $nm_nasabah; ?></td>
            <td><?php echo $rt; ?></td>
            <td><?php echo $no_hp; ?></td>
            <td><?php echo "Rp. ".number_format($saldo, 2, ",", "."); ?></td>

            <td align="center">
              <a id="tarik" data-toggle="modal" data-target="#add" data-norek="<?php echo $norekp; ?>" data-nm_nasabah="<?php echo $nm_nasabah; ?>" data-saldo="<?php echo $saldo; ?>">
                <button class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Penarikan</button></a>
            </td>
          </tr>

          <?php }  ?>
        </tbody>
      </table>
    </div>

    <a class="btn btn-default" data-toggle="modal" data-target="#cetakpdf" style="margin-button: 5px;"><i class="fa fa-print"></i> Cetak PDF</a>

    <?php
    include "transaksi/.modal_tarik_add.php";
    include "transaksi/.modal_cetak_penarikan.php";
     ?>

  </div>
</div>

<?php
// } else if (@$_GET['act'] == 'show') {
//   $beli->tambahbeli(@$_GET['norek']);
//   // $jual->tambahjual(@$_GET['norek']);
//   $link = (@$_GET['norek']);
//   if (@$_GET['norek'] != ''){
//     $tampilw = $beli->tampilw(@$_GET['norek']);
//     header("location: ?page=view_pembelian&act=show&norek=$link");
//   }
} {

}
 ?>
