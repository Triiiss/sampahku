<?php
include "models/sampah/m_sampah.php";
$smp = new Sampah($connection);

if (@$_GET['act'] == '') {
 ?>
<div class="row">
  <div class="col-lg-12">
    <h1>Sampah <small>Data Sampah</small></h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Sampah</a></li>
      <li class="active">Data Sampah</li>
    </ol>
  </div>
</div><!-- /.row -->

<div class="row">
  <div class="col-lg-12">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" id="datatables">
        <thead>
          <tr>
            <th>No.</th>
            <th>Jenis Sampah</th>
            <th>Nama Sampah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampil = $smp->tampil();
          while($data = $tampil->fetch_object()) {
           ?>
          <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $data->nm_jn_sampah; ?></td>
            <td><?php echo $data->nm_sampah; ?></td>
            <td align="center">
              <a id="edit_s" data-toggle="modal" data-target="#edit" data-id_nm_sampah="<?php echo $data->id_nm_sampah; ?>" data-nm_jn_sampah="<?php echo $data->nm_jn_sampah; ?>" data-nm_sampah="<?php echo $data->nm_sampah; ?>">
                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <a class="btn btn-success" data-toggle="modal" data-target="#tambah" style="margin-button: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>
    <a class="btn btn-default" data-toggle="modal" target="_blank" href="./report/cetak_sampah.php" style="margin-button: 5px;"><i class="fa fa-print"></i> Cetak PDF</a>

    <?php
    include "sampah/.modal_s_add.php";
     include "sampah/.modal_s_edit.php";
     ?>

  </div>
</div>

<?php
// } else if (@$_GET['act'] == 'del') {
//   $wrg->hapus($_GET['nik']);
//   header("location: ?page=nasabah");
// } {

} ?>
