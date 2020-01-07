
    <!-- UNTUK EDIT BARANG -->
        <div id="edit" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Jenis Sampah</h4>
              </div>
              <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-lable" for="nm_sampah">Nama Sampah</label>
                    <input type="hidden" name="id_pembelian" id="id_pembelian">
                    <input type="hidden" name="id_nm_sampah" id="id_nm_sampah">
                    <input type="hidden" name="nik" id="nik">
                    <input type="text" name="nm_sampah" class="form-control" id="nm_sampah" required>
                  </div>
                  <div class="form-group">
                    <label class="control-lable" for="berat_pembelian">Berat Sampah</label>
                    <input type="text" name="berat_pembelian" class="form-control" id="berat_pembelian" required>
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
        $(document).on("click", "#edit_beli", function(){
          var id_pembelian = $(this).data('id_pembelian');
          var id_nm_sampah = $(this).data('id_nm_sampah');
          var nik = $(this).data('nik');
          var nm_sampah = $(this).data('nm_sampah');
          var berat_pembelian = $(this).data('berat_pembelian');
          $("#modal-edit #id_pembelian").val(id_pembelian);
          $("#modal-edit #id_nm_sampah").val(id_nm_sampah);
          $("#modal-edit #nik").val(nik);
          $("#modal-edit #nm_sampah").val(nm_sampah);
          $("#modal-edit #berat_pembelian").val(berat_pembelian);
        })

        $(document).ready(function(e) {
          $("#form").on("submit", (function(e) {
            e.preventDefault();
            $.ajax({
              url : 'models/transaksi/proses_edit_beli.php',
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
