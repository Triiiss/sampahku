<!-- <?php
include "../models/sampah/m_sampah.php";
$smp = new Sampah($connection);

if (@$_GET['act'] == '') {
 ?> -->
<!-- UNTUK TAMbAH BARANG -->
    <div id="tambah" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data Sampah</h4>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label class="control-lable" for="id_jn_sampah">Nama Jenis Sampah</label>
                <br>


                <!-- <input list="id_jn_sampah" name="id_jn_sampah">

                <?php
                $no = 1;
                $tampil = $smp->tampiljs();
                while($data = $tampil->fetch_object()) {
                 ?>

                  <datalist id="id_jn_sampah">

                    <option value="<?php echo $data->id_jn_sampah; ?>"><?php echo $data->nm_jn_sampah; ?></option>
                  </datalist>
                <?php } ?> -->

                <select name="id_jn_sampah" id="id_jn_sampah">
                  <option value="">---  Pilih  ---</option>

                  <?php
                  $no = 1;
                  $tampil = $smp->tampiljs();
                  while($data = $tampil->fetch_object()) {
                   ?>
                   <option value="<?php echo $data->id_jn_sampah; ?>"  name="id_jn_sampah" id="id_jn_sampah"><?php echo $data->nm_jn_sampah; ?></option>

                 <?php } ?>
                </select>
                <br>
                <label class="control-lable" for="nm_sampah">Nama Sampah</label>
                <input type="text" name="nm_sampah" class="form-control" id="nm_sampah" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" class="btn btn-success" name="tambah" value="simpan">
            </div>
          </form>
          <?php
          if(@$_POST['tambah']){
            $id_jn_sampah = $connection->conn->real_escape_string($_POST['id_jn_sampah']);
            $nm_sampah = $connection->conn->real_escape_string($_POST['nm_sampah']);
            if($nm_sampah) {
              $smp->tambah($id_jn_sampah, $nm_sampah);
              header("location:?page=sampah");
            } else {
              echo "<script>alert('Upload gagal!')</script>";
            }
          }
           ?>
        </div>
      </div>
    </div>

  <?php } ?>
