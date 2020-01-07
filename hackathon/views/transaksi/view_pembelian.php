<?php
// require_once('config/koneksi.php');
// require_once('models/database.php');
include "models/transaksi/m_pembelian.php";
$connection = new Database($host, $user, $pass, $database);
$beli = new Pembelian($connection);

  if (@$_GET['norek'] != '') {
    $tampilnasabah = $beli->tampilnasabah(@$_GET['norek']);

    while ($data = $tampilnasabah->fetch_object()) { ?>
<div class="row">
  <div class="col-lg-12">
    <h1><?php echo $data->nm_nasabah; ?> <small>Pembelian</small></h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Transaksi</a></li>
      <li><a href="">Pembelian</a></li>
      <li class="active"><?php echo $data->norek; ?></li>
    </ol>
  </div>
</div><!-- /.row -->
<?php } ?>

<div class="row">
  <div class="col-lg-12">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" id="datatables">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Sampah</th>
            <th>Berat Sampah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampil = $beli->tampildp();
          while($data = $tampil->fetch_object()) {
           ?>
           <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $data->nm_sampah; ?></td>
            <td><?php echo $data->berat_pembelian; ?> kg</td>
            <td align="center">
              <a id="edit_beli" data-toggle="modal" data-target="#edit" data-id_pembelian="<?php echo $data->id_pembelian; ?>" data-id_nm_sampah="<?php echo $data->id_nm_sampah; ?>" data-norek="<?php echo $data->norek; ?>" data-nm_sampah="<?php echo $data->nm_sampah; ?>" data-berat_pembelian="<?php echo $data->berat_pembelian; ?>">
                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

    <a class="btn btn-success" data-toggle="modal" data-target="#tambah" style="margin-button: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>
    <?php
    $tampil = $beli->tampil();
    while($data = $tampil->fetch_object()) { ?>
    <a href="?page=view_pembelian&act=del&id_pembelian=<?php echo $data->id_pembelian; ?>" onclick="return confirm('Apakah anda yakin ingin membatalkan transaksi ini?')" class="btn btn-danger"  style="margin-button: 5px;"><i class="fa fa-trash-o"></i> Batal Transaksi</a>
  <?php } ?>
    <a href="?page=pembelian" class="btn btn-info" data-toggle="modal" style="margin-button: 5px;"><i class="fa fa-plus"></i> Selesai Transaksi</a>

    <?php
    include ".modal_beli_add.php";
    include ".modal_beli_edit.php";
     ?>

  </div>
</div>

<?php
} else if (@$_GET['act'] == 'del') {
  $beli->hapus($_GET['id_pembelian']);
  $link = (@$_GET['norek']);
  // header("location: ?page=view_pembelian&act=show&norek=$link");
  header("location: ?page=pembelian");
} {

}
?>
