
    <!-- UNTUK EDIT BARANG -->
        <div id="edit" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Nama Sampah</h4>
              </div>
              <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-lable" for="nm_jn_sampah">Nama Jenis Sampah</label>
                    <input type="hidden" name="id_jn_sampah" id="id_jn_sampah">
                    <input type="text" name="nm_jn_sampah" class="form-control" id="nm_jn_sampah" required>
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
        $(document).on("click", "#edit_js", function(){
          var id_jn_sampah = $(this).data('id_jn_sampah');
          var nm_jn_sampah = $(this).data('nm_jn_sampah');
          $("#modal-edit #id_jn_sampah").val(id_jn_sampah);
          $("#modal-edit #nm_jn_sampah").val(nm_jn_sampah);
        })

        $(document).ready(function(e) {
          $("#form").on("submit", (function(e) {
            e.preventDefault();
            $.ajax({
              url : 'models/sampah/proses_edit_js.php',
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
