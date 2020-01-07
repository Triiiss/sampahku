<?php
include "models/pengurus/m_pengurus.php";
$urus = new Pengurus($connection);

if (@$_GET['act'] == '') {
 ?>
<div class="row">
  <div class="col-lg-12">
    <h1>Pengurus </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Pengurus</a></li>
      <li class="active">Data pengurus</li>
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
            <th>Username</th>
            <th>Status</th>
            <th>Alamat</th>
            <th>No Handphone</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampil = $urus->tampil();
          while($data = $tampil->fetch_object()) {
           ?>
          <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $data->username; ?></td>
            <td><?php echo $data->status; ?></td>
            <td><?php echo $data->alamat; ?></td>
            <td><?php echo $data->no_hp; ?></td>
            <td><?php echo $data->email; ?></td>

            <td align="center">
              <a id="edit_urus" data-toggle="modal" data-target="#edit" data-id_pengurus="<?php echo $data->id_pengurus; ?>" data-username="<?php echo $data->username; ?>" data-status="<?php echo $data->status; ?>" data-no_hp="<?php echo $data->no_hp; ?>" data-email="<?php echo $data->email; ?>" data-alamat="<?php echo $data->alamat; ?>">
                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <a class="btn btn-success" data-toggle="modal" data-target="#tambah" style="margin-button: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>

    <?php
    include "pengurus/.modal_pengurus_add.php";
    include "pengurus/.modal_pengurus_edit.php";
     ?>

  </div>
</div>

<?php
} else if (@$_GET['act'] == 'del') {
  $wrg->hapus($_GET['nik']);
  header("location: ?page=nasabah");
} {

} ?>
