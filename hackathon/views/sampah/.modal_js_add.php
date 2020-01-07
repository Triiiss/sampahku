
<!-- UNTUK TAMbAH BARANG -->
    <div id="tambah" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data Jenis Sampah</h4>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label class="control-lable" for="nm_jn_sampah">Nama Jenis Sampah</label>
                <input type="text" name="nm_jn_sampah" class="form-control" id="nm_jn_sampah" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" class="btn btn-success" name="tambah" value="simpan">
            </div>
          </form>
          <?php
          if(@$_POST['tambah']){
            $nm_jn_sampah = $connection->conn->real_escape_string($_POST['nm_jn_sampah']);
            if($nm_jn_sampah) {
              $js->tambah($nm_jn_sampah);
              header("location:?page=jenis_sampah");
            } else {
              echo "<script>alert('Upload gagal!')</script>";
            }
          }
           ?>
        </div>
      </div>
    </div>
