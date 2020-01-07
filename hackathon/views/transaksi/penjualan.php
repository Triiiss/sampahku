<?php
include "models/transaksi/m_penjualan.php";
$jual = new Penjualan($connection);

if (@$_GET['act'] == '') {
  // $jual->tambahjual(@$_GET['nik']);
  $tampil = $jual->tampilpj();
  // echo $tampil->id_penjualan;
  while($data = $tampil->fetch_object()) {
    // $tanggal = $data->date;
    if (date('Y-m-d') == $data->tanggal) {
    // if ($data->date = '') {
      echo "bener uyy";
    } else {
      $jual->tambahjual(@$_GET['nik']);
      echo "salah uyy";
    }
  }
 ?>
<div class="row">
  <div class="col-lg-12">
    <h1>Warga <small>Data Warga</small></h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Warga</a></li>
      <li class="active">Data warga</li>
    </ol>
    <table>
      <div class="modal-body">
        <form method="post" target="_blank">
          <tr>
            <td>
              <div class="form-group">Pembelian Tanggal</div>
            </td>
            <td align="center" width="5%">
              <div class="form-group">:</div>
            </td>
            <td>
              <div class="form-group">
                <input type="date" class="form-control" name="tanggal_jual" required>
              </div>
            </td>
            <td align="center" width="5%">
              <div class="form-group"> </div>
            </td>
            <td>
              <div class="form-group">
              <input type="submit" name="cetak_pembelian" class="btn btn-primary btn-sm" value="Cetak">
              </div>
            </td>
          </tr>
        </form>
      </div>
    </table>
  </div>
</div><!-- /.row -->

<div class="row" id="tambah">
  <div class="col-lg-12">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" id="datatables">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama sampah</th>
            <th>Berat</th>
            <th>Harga per KG</th>
            <th>Aksi</th>
            <?php echo date('Y-m-d'); ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampil = $jual->tampil();
          while($data = $tampil->fetch_object()) {
           ?>
           <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $data->nm_sampah; ?></td>
            <td><?php echo $data->berat_pembelian; ?></td>
            <td><?php echo $data->harga_penjualan; ?></td>
            <td align="center">
              <a id="edit_jual" data-toggle="modal" data-target="#edit" data-id_penjualan="<?php echo $data->id_penjualan; ?>" data-id_nm_sampah="<?php echo $data->id_nm_sampah; ?>" data-nm_sampah="<?php echo $data->nm_sampah; ?>" data-berat_pembelian="<?php echo $data->berat_pembelian; ?>" data-harga_pemjualan="<?php echo $datah->harga_pemjualan; ?>">
                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
            </td>
           </tr>
         <?php } ?>
        </tbody>
      </table>
    </div>

    <a class="btn btn-success" type="submit" name="tambah" value="simpan" style="margin-button: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>

  </div>
</div>

<?php
include "transaksi/.modal_jual_add.php";
 ?>

<?php
} else if (@$_GET['act'] == 'show') {

  echo "string";

  if (@$_GET['act'] == 'show') {
    $beli->tambahbeli(@$_GET['nik']);
    $link = (@$_GET['nik']);
    if (@$_GET['nik'] != ''){
      $tampilw = $beli->tampilw(@$_GET['nik']);
      header("location: ?page=view_pembelian&act=show&nik=$link");
    }
  }
} {

}
 ?>
