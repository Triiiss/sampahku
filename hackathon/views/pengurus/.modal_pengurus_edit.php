
    <!-- UNTUK EDIT BARANG -->
        <div id="edit" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Pengurus</h4>
              </div>
              <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-lable" for="username">Username</label>
                    <input type="hidden" name="id_pengurus" id="id_pengurus">
                    <input type="text" name="username" class="form-control" id="username" required>
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
                  <input type="submit" class="btn btn-success" name="edit" value="Simpan">
                </div>
              </form>
            </div>
          </div>
        </div>

        <script type="text/javascript">
        $(document).on("click", "#edit_urus", function(){
          var id_pengurus = $(this).data('id_pengurus');
          var username = $(this).data('username');
          var status = $(this).data('status');
          var nohp = $(this).data('no_hp');
          var email = $(this).data('email');
          var alamat = $(this).data('alamat');
          $("#modal-edit #id_pengurus").val(id_pengurus);
          $("#modal-edit #username").val(username);
          $("#modal-edit #status").val(status);
          $("#modal-edit #no_hp").val(nohp);
          $("#modal-edit #email").val(email);
          $("#modal-edit #alamat").val(alamat);
        })

        $(document).ready(function(e) {
          $("#form").on("submit", (function(e) {
            e.preventDefault();
            $.ajax({
              url : 'models/pengurus/proses_edit_pengurus.php',
              type : 'POST',
              data : new FormData(this),
              contentType : false,
              cache : false,
              processData : false,
              success : function(msg) {
                $('.table').html(msg);
              }
            });
           }));
        })
        </script>
