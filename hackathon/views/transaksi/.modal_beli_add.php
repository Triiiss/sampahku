
<!-- Load librari/plugin jquery nya -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>

<!-- Load File javascript config.js -->
<script src="assets/js/beli_loadsampah.js" type="text/javascript"></script>

<!-- UNTUK TAMbAH BARANG -->
    <div id="tambah" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data Pembelian Sampah</h4>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <div class="col-md-4">
                  <label class="control-lable" for="nm_sampah">Jenis Sampah</label>

                  <select name="id_jn_sampah" id="id_jn_sampah">

                    <option value="">---  Pilih  ---</option>
                    <?php
                    $no = 1;
                    $tampil = $beli->tampiljs();
                    while($data = $tampil->fetch_object()) {
                     ?>
                     <option value="<?php echo $data->id_jn_sampah; ?>"><?php echo $data->nm_jn_sampah; ?></option>
                   <?php } ?>

                  </select>
                </div>
                <div class="col-md-4">
                  <label class="control-lable" for="nm_sampah">Nama Sampah</label>

                  <select name="id_nm_sampah" id="id_nm_sampah" style="width: 200px;">
                    <option value="">--- Pilih ---</option>
                  </select>

                </div>
                <div class="col-md-4">
                  <label class="control-lable" for="berat_pembelian">Berat Sampah</label>
                  <input type="text" name="berat_pembelian" class="form-control" id="berat_pembelian" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" class="btn btn-success" name="tambah" value="simpan">
            </div>
          </form>


          <?php
          if(@$_POST['tambah']){
            $tampil = $beli->tampil();
            while($data = $tampil->fetch_object()) {
            $id_pembelian = $data->id_pembelian;
          }
            $id_nm_sampah = $connection->conn->real_escape_string($_POST['id_nm_sampah']);
            $berat_pembelian = $connection->conn->real_escape_string($_POST['berat_pembelian']);
            if($berat_pembelian) {
              $beli->tambahdetailbeli($id_pembelian, $id_nm_sampah, $berat_pembelian);
              $link = (@$_GET['norek']);
              header("location: ?page=view_pembelian&act=show&norek=$link");
            } else {
              echo "<script>alert('Upload gagal!')</script>";
            }
          }
           ?>
        </div>
      </div>
    </div>
