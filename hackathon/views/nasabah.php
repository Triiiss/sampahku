<?php
include "models/nasabah/m_nasabah.php";
$nsb = new Nasabah($connection);

if (@$_GET['act'] == '') {
 ?>
<div class="row">
  <div class="col-lg-12">
    <h1>Nasabah </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Nasabah</a></li>
      <li class="active">Data Nasabah</li>
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
            <th>No.Rekening</th>
            <th>Nama Nasabah</th>
            <th>RT</th>
            <th>Alamat</th>
            <th>No Handphone</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampil = $nsb->tampil();
          while($data = $tampil->fetch_object()) {
           ?>
          <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $data->norek; ?></td>
            <td><?php echo $data->nm_nasabah; ?></td>
            <td><?php echo $data->rt; ?></td>
            <td><?php echo $data->alamat; ?></td>
            <td><?php echo $data->no_hp; ?></td>
            <td><?php echo $data->email; ?></td>
            <!-- <td><?php echo "Rp. ".number_format($data->harga_brg, 2, ",", "."); ?></td> -->

            <td align="center">
              <a id="edit_nsb" data-toggle="modal" data-target="#edit" data-norek="<?php echo $data->norek; ?>" data-nm_nasabah="<?php echo $data->nm_nasabah; ?>" data-no_hp="<?php echo $data->no_hp; ?>" data-email="<?php echo $data->email; ?>" data-rt="<?php echo $data->rt; ?>" data-alamat="<?php echo $data->alamat; ?>">
                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
              <a href="./report/cetak_buku_tabungan.php?norek=<?=$data->norek; ?>" target="_blank"><button class="btn btn-default btn-xs"><i class="fa fa-print"> Cetak Buku Tabungan</i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <a class="btn btn-success" data-toggle="modal" data-target="#tambah" style="margin-button: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>
    <a class="btn btn-default" data-toggle="modal" target="_blank" href="./report/cetak_nasabah.php" style="margin-button: 5px;"><i class="fa fa-print"></i> Cetak PDF</a>

    <?php
    include "nasabah/.modal_nasabah_add.php";
    include "nasabah/.modal_nasabah_edit.php";
     ?>

  </div>
</div>

<?php
} else if (@$_GET['act'] == 'del') {
  $wrg->hapus($_GET['norek']);
  header("location: ?page=nasabah");
} {

} ?>
