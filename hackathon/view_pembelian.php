<?php
include "models/transaksi/m_pembelian.php";
$beli = new Pembelian($connection);

if (@$_GET['act'] == '') {
 ?>
<div class="row">
  <div class="col-lg-12">
    <h1> <small>Data Warga</small></h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Warga</a></li>
      <li class="active">Data warga</li>
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
            <th>Nama Warga</th>
            <th>RT</th>
            <th>No Handphone</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampil = $beli->tampil();
          while($data = $tampil->fetch_object()) {
           ?>
          <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $data->nm_warga; ?></td>
            <td><?php echo $data->rt; ?></td>
            <td><?php echo $data->no_hp; ?></td>
            <!-- <td><?php echo "Rp. ".number_format($data->harga_brg, 2, ",", "."); ?></td> -->

            <td align="center">
              <a href="?page=transaksi/pembelian.php" data-nik="<?php echo $data->nik; ?>" data-nm_warga="<?php echo $data->nm_warga; ?>" data-no_hp="<?php echo $data->no_hp; ?>" data-email="<?php echo $data->email; ?>" data-rt="<?php echo $data->rt; ?>" data-alamat="<?php echo $data->alamat; ?>">
                <button class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
              <a href="?page=nasabah&act=del&nik=<?php echo $data->nik; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button></a>
              <a href="./report/cetak_barang.php?id=<?=$data->id_brg; ?>" target="_blank"><button class="btn btn-default btn-xs"><i class="fa fa-print"> Cetak</i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <a class="btn btn-success" data-toggle="modal" data-target="#tambah" style="margin-button: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>
    <a class="btn btn-default" data-toggle="modal" data-target="#cetakpdf" style="margin-button: 5px;"><i class="fa fa-print"></i> Cetak PDF</a>

    <?php
    include "warga/.modal_warga_add.php";
    include "warga/.modal_warga_edit.php";
     ?>

  </div>
</div>

<?php
} else if (@$_GET['act'] == 'del') {
  $wrg->hapus($_GET['nik']);
  header("location: ?page=nasabah");
} {

} ?>
