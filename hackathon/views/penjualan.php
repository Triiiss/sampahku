<?php
include "models/transaksi/m_penjualan.php";
$jual = new Penjualan($connection);

if (@$_GET['act'] == '') {
 ?>
<div class="row">
  <div class="col-lg-12">
    <h1>Penjualan</h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Transaksi</a></li>
      <li class="active">Penjualan</li>
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
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampiltanggal = $jual->tampiltanggal();
          while($data = $tampiltanggal->fetch_object()) {
           ?>
           <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?=date('d F Y', strtotime($data->tanggal)); ?></td>
            <td align="center">
              <a href="?page=penjualan&act=show&date=<?php echo $data->tanggal; ?>"><button class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Tampil</button></a>
            </td>
           </tr>
         <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<?php
} else if (@$_GET['act'] == 'show') {

  $link = (@$_GET['date']);
  $tampil = $jual->tampilpakhir();
  while($data = $tampil->fetch_object()) {
    $tanggalpakhir = $data->tanggal;
  }

  $tampil = $jual->tampilpjakhir();
  while($data = $tampil->fetch_object()) {
    $tanggalpjakhir = $data->tanggal;
    $id_penjualan = $data->id_penjualan;
  }

  $a = 0;
  $tampil = $jual->tampilsemua();
  while ($data = $tampil->fetch_object()) {
    $tanggalpjsemua = $data->tanggal;
    if ($tanggalpjsemua == $link) {
      header("location: ?page=view_penjualan&date=$link");
      echo "benar";
    }
  }
  if ($tanggalpakhir == date('Y-m-d')) {
    if ($tanggalpjakhir != $tanggalpakhir) {
      $jual->tambahjual(@$_GET['date']);
      header("location: ?page=penjualan");
      $a=1;
      }
    }

    $tampilkey = $jual->tampilpjakhir();
    while($data = $tampilkey->fetch_object()) {
      $id_penjualan = $data->id_penjualan;
    }

    if ($a == 1) {
      $tampiljp = $jual->tampiljp();
      while ($data = $tampiljp->fetch_object()) {
        $id_nm_sampah = $data->id_nm_sampah;
        $nm_sampah = $data->nm_sampah;
        $berat_penjualan = $data->berat_penjualan;
        $jual->tambahdjp($id_penjualan, $id_nm_sampah, $berat_penjualan);
      }
      $a=0;
    }
  }
 {
}
 ?>
