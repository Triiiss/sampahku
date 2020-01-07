
    <!-- UNTUK EDIT BARANG -->
        <div id="edit" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Nasabah</h4>
              </div>
              <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-lable" for="nm_nasabah">Nama Nasabah</label>
                    <input type="hidden" name="norek" id="norek">
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
                  <input type="submit" class="btn btn-success" name="edit" value="Simpan">
                </div>
              </form>
            </div>
          </div>
        </div>

        <script type="text/javascript">
        $(document).on("click", "#edit_nsb", function(){
          var norek = $(this).data('norek');
          var nmnasabah = $(this).data('nm_nasabah');
          var nohp = $(this).data('no_hp');
          var email = $(this).data('email');
          var rt = $(this).data('rt');
          var alamat = $(this).data('alamat');
          $("#modal-edit #norek").val(norek);
          $("#modal-edit #nm_nasabah").val(nmnasabah);
          $("#modal-edit #no_hp").val(nohp);
          $("#modal-edit #email").val(email);
          $("#modal-edit #rt").val(rt);
          $("#modal-edit #alamat").val(alamat);
        })

        $(document).ready(function(e) {
          $("#form").on("submit", (function(e) {
            e.preventDefault();
            $.ajax({
              url : 'models/nasabah/proses_edit_nasabah.php',
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
