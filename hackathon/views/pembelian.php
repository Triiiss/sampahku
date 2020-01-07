<?php
include "models/transaksi/m_pembelian.php";
// include "models/transaksi/m_penjualan.php";
$beli = new Pembelian($connection);
// $jual = new Penjualan($connection);

if (@$_GET['act'] == '') {
 ?>
<div class="row">
  <div class="col-lg-12">
    <h1>Pembelian</h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Transaksi</a></li>
      <li class="active">Pembelian</li>
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
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampilnasabah = $beli->tampilnasabah();
          while($data = $tampilnasabah->fetch_object()) {
           ?>
          <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $data->nm_nasabah; ?></td>
            <td><?php echo $data->rt; ?></td>
            <td><?php echo $data->no_hp; ?></td>

            <td align="center">
              <a href="?page=pembelian&act=show&norek=<?php echo $data->norek; ?>"><button class="btn btn-success btn-xs" type="submit" name="tambah" value="simpan"><i class="fa fa-edit"></i> Pembelian</button></a>
            </td>
          </tr>

          <?php } ?>
        </tbody>
      </table>
    </div>

    <a class="btn btn-default" data-toggle="modal" data-target="#cetakpdf" style="margin-button: 5px;"><i class="fa fa-print"></i> Cetak PDF</a>

    <?php
    include "transaksi/.modal_cetak_pembelian.php";
     ?>

  </div>
</div>

<?php
} else if (@$_GET['act'] == 'show') {
  $beli->tambahbeli(@$_GET['norek']);
  // $jual->tambahjual(@$_GET['norek']);
  $link = (@$_GET['norek']);
  if (@$_GET['norek'] != ''){
    $tampilnasabah = $beli->tampilnasabah(@$_GET['norek']);
    header("location: ?page=view_pembelian&act=show&norek=$link");
  }
} {

}
 ?>
