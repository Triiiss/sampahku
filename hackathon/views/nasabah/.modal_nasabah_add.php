
<!-- UNTUK TAMbAH BARANG -->
    <div id="tambah" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data Nasabah</h4>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label class="control-lable" for="norek">Norek</label>
                <input type="text" name="norek" class="form-control" id="norek" required>
              </div>
              <div class="form-group">
                <label class="control-lable" for="nm_nasabah">Nama Nasabah</label>
                <input type="text" name="nm_nasabah" class="form-control" id="nm_nasabah" required>
              </div>
              <div class="form-group">
                <label class="control-lable" for="no_hp">No Handphone</label>
                <input type="number" name="no_hp" class="form-control" id="no_hp" required>
              </div>
              <div class="form-group">
                <label class="control-lable" for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" required>
              </div>
              <div class="form-group">
                <label class="control-lable" for="rt">RT</label>
                <input type="number" name="rt" class="form-control" id="rt" required>
              </div>
              <div class="form-group">
                <label class="control-lable" for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" id="alamat" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" class="btn btn-success" name="tambah" value="simpan">
            </div>
          </form>
          <?php
          if(@$_POST['tambah']){
            $norek = $connection->conn->real_escape_string($_POST['norek']);
            $nm_nasabah = $connection->conn->real_escape_string($_POST['nm_nasabah']);
            $no_hp = $connection->conn->real_escape_string($_POST['no_hp']);
            $email = $connection->conn->real_escape_string($_POST['email']);
            $rt = $connection->conn->real_escape_string($_POST['rt']);
            $alamat = $connection->conn->real_escape_string($_POST['alamat']);
            if($alamat) {
              $nsb->tambah($norek, $nm_nasabah, $no_hp, $email, $rt, $alamat);
              header("location:?page=nasabah");
            } else {
              echo "<script>alert('Upload gagal!')</script>";
            }
          }
           ?>
        </div>
      </div>
    </div>
