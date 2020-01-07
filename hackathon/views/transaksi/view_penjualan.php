<?php
include "models/transaksi/m_penjualan.php";
$connection = new Database($host, $user, $pass, $database);
$jual = new Penjualan($connection);

  if (@$_GET['date'] != '') {
    $link = (@$_GET['date']);
    $tampilw = $jual->tampilhistory();
    while ($data = $tampilw->fetch_object()) {
      if ($data->tanggal == $link) {

      ?>
<div class="row">
  <div class="col-lg-12">
    <h1>Penjualan</h1>
    <ol class="breadcrumb">
      <h1><?=date('d F Y', strtotime($link)); ?></h1>
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Transaksi</a></li>
      <li><a href="">Penjualan</a></li>
      <li class="active"><?=date('d F Y', strtotime($link)); ?></li>
    </ol>
  </div>
</div><!-- /.row -->
<?php } } ?>

<div class="row" id="tambah">
  <div class="col-lg-12">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" id="datatables">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama sampah</th>
            <th>Berat Sampah</th>
            <th>Harga per KG</th>
            <th>Total Harga Persampah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total = 0;
          $berat = 0;
          $no = 1;
          $tampil = $jual->tampildetailpenjualan();
          while($data = $tampil->fetch_object()) {
            $tanggal = $data->tanggal;
            $nm_sampah = $data->nm_sampah;
            $berat_penjualan = $data->berat_penjualan;
            $harga_penjualan = $data->harga_penjualan;
            $totalharga = $berat_penjualan * $harga_penjualan;

            if ($tanggal == $link) {
              $total = $total + $totalharga;
              $berat = $berat + $berat_penjualan;
           ?>
           <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $nm_sampah; ?></td>
            <td><?php echo $berat_penjualan; ?> kg</td>
            <td><?php echo "Rp. ".number_format($harga_penjualan, 2, ",", "."); ?></td>
            <td><?php echo "Rp. ".number_format($totalharga, 2, ",", "."); ?></td>
            <td align="center">
              <?php if ($tanggal == date('Y-m-d')) { ?>
              <a id="edit_jual" data-toggle="modal" data-target="#edit" data-id_penjualan="<?php echo $data->id_penjualan; ?>" data-id_nm_sampah="<?php echo $data->id_nm_sampah; ?>" data-nm_sampah="<?php echo $nm_sampah; ?>" data-berat_penjualan="<?php echo $berat_penjualan; ?>" data-harga_penjualan="<?php echo $harga_penjualan; ?>" data-date="<?php echo $tanggal; ?>">
              <?php } ?>
                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
            </td>
           </tr>
         <?php } } ?>
        </tbody>
        <tfoot>
          <tr>
            <td></td>
            <td>Total Berat Sampah Yang Dijual</td>
            <td><?php echo $berat; ?> kg</td>
            <td>Total Uang yang diterima</td>
            <td><?php echo "Rp. ".number_format($total, 2, ",", "."); ?></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <a href="?page=view_penjualan&act=done" class="btn btn-success" type="submit" name="tambah" value="simpan" style="margin-button: 5px;"><i class="fa fa-plus"></i> Selesai</a>
    <?php
    $tampil = $jual->tampilpjakhir();
    while($data = $tampil->fetch_object()) { ?>
    <a href="?page=view_penjualan&act=del&id_penjualan=<?php echo $data->id_penjualan; ?>" onclick="return confirm('Apakah anda yakin ingin membatalkan transaksi ini?')" class="btn btn-danger"  style="margin-button: 5px;"><i class="fa fa-trash-o"></i> Batal Transaksi</a>
  <?php } ?>
    <a href="./report/cetak_penjualan.php?date=<?=$link; ?>" target="_blank"><button class="btn btn-default"><i class="fa fa-print"></i> Cetak PDF </a>


  </div>
</div>

<?php
include ".modal_jual_add.php";
?>

<?php
} else if (@$_GET['act'] == 'done') {
  $tampil = $jual->tampilpjakhir();
  while($data = $tampil->fetch_object()) {
    if ($tanggal != date('Y-m-d')) {
      header("location: ?page=proses_catatan_penjualan");
    }
    $tanggal = $data->tanggal;
    echo $tanggal;
  }
} else if (@$_GET['act'] == 'del') {
  $id_penjualan = (@$_GET['id_penjualan']);
  $tampil = $jual->tampilpctakhir();
  while ($data = $tampil->fetch_object()) {
    $tanggalp = $data->tanggal;
    $id_pembelian = $data->id_pembelian;
    if ($tanggalp == date('Y-m-d')) {
      $jual->hapusct($id_pembelian);
    }
  }
  $tampil = $jual->tampilpjakhir();
  while($data = $tampil->fetch_object()) {
    $tanggal = $data->tanggal;
    if ($tanggal == date('Y-m-d')) {
      $jual->hapusjual($id_penjualan);
      header("location: ?page=penjualan");
    }
  }
} {

}
 ?>
