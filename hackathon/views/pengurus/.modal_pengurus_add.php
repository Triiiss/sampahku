
<!-- UNTUK TAMbAH BARANG -->
    <div id="tambah" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Data Pengurus</h4>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label class="control-lable" for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
              </div>
              <div class="form-group">
                <label class="control-lable" for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
              </div>
              <div class="form-group">
                <label class="control-lable" for="status">Status</label>
                <br>
                <select name="status" id="status">
                  <option value="bendahara">Bendahara</option>
                  <option value="sekertaris">Sekertaris</option>
                </select>
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
            $username = $connection->conn->real_escape_string($_POST['username']);
            $password = $connection->conn->real_escape_string($_POST['password']);
            $status = $connection->conn->real_escape_string($_POST['status']);
            $no_hp = $connection->conn->real_escape_string($_POST['no_hp']);
            $email = $connection->conn->real_escape_string($_POST['email']);
            $alamat = $connection->conn->real_escape_string($_POST['alamat']);
            if($alamat) {
              $urus->tambah($username, $status, $no_hp, $email, $password, $alamat);
              header("location:?page=pengurus");
            } else {
              echo "<script>alert('Upload gagal!')</script>";
            }
          }
           ?>
        </div>
      </div>
    </div>
