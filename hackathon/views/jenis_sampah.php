<?php
include "models/sampah/m_jn_sampah.php";
$js = new Jenis_Sampah($connection);

if (@$_GET['act'] == '') {
 ?>
<div class="row">
  <div class="col-lg-12">
    <h1>Jenis Sampah <small>Data Jenis Sampah</small></h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i></a></li>
      <li><a href="">Jenis Sampah</a></li>
      <li class="active">Jenis Data Sampah</li>
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
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampil = $js->tampil();
          while($data = $tampil->fetch_object()) {
           ?>
          <tr>
            <td align="center"><?php echo $no++."."; ?></td>
            <td><?php echo $data->nm_jn_sampah; ?></td>
            <td align="center">
              <a id="edit_js" data-toggle="modal" data-target="#edit" data-id_nm_sampah="<?php echo $data->id_nm_sampah; ?>" data-nm_jn_sampah="<?php echo $data->nm_jn_sampah; ?>" data-id_jn_sampah="<?php echo $data->id_jn_sampah; ?>">
                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <a class="btn btn-success" data-toggle="modal" data-target="#tambah" style="margin-button: 5px;"><i class="fa fa-plus"></i> Tambah Data</a>

    <?php
    include "sampah/.modal_js_add.php";
    include "sampah/.modal_js_edit.php";
     ?>

  </div>
</div>

<?php } ?>
