
    <!-- UNTUK EDIT BARANG -->
        <div id="edit" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Penjualan Sampah</h4>
              </div>
              <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-lable" for="nm_sampah">Nama Sampah</label>
                    <input type="hidden" name="id_penjualan" id="id_penjualan">
                    <input type="hidden" name="id_nm_sampah" id="id_nm_sampah">
                    <input type="hidden" name="berat_penjualan" id="berat_penjualan">
                    <input type="hidden" name="date" id="date">
                    <input type="text" name="nm_sampah" class="form-control" id="nm_sampah" required>
                  </div>
                  <div class="form-group">
                    <label class="control-lable" for="harga_penjualan">Herga Sampah</label>
                    <input type="text" name="harga_penjualan" class="form-control" id="harga_penjualan" required>
                  </div>
                  <!-- <div class="form-group">
                    <label class="control-lable" for="date">Herga date</label>
                    <input type="text" name="date" class="form-control" id="date" required>
                  </div> -->
                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-success" name="edit" value="Simpan">
                </div>
              </form>
            </div>
          </div>
        </div>

        <script type="text/javascript">
        $(document).on("click", "#edit_jual", function(){
          var id_penjualan = $(this).data('id_penjualan');
          var id_nm_sampah = $(this).data('id_nm_sampah');
          var nm_sampah = $(this).data('nm_sampah');
          var date = $(this).data('date');
          var berat_penjualan = $(this).data('berat_penjualan');
          var harga_penjualan = $(this).data('harga_penjualan');
          $("#modal-edit #id_penjualan").val(id_penjualan);
          $("#modal-edit #id_nm_sampah").val(id_nm_sampah);
          $("#modal-edit #nm_sampah").val(nm_sampah);
          $("#modal-edit #date").val(date);
          $("#modal-edit #berat_penjualan").val(berat_penjualan);
          $("#modal-edit #harga_penjualan").val(harga_penjualan);
        })

        $(document).ready(function(e) {
          $("#form").on("submit", (function(e) {
            e.preventDefault();
            $.ajax({
              url : 'models/transaksi/proses_edit_jual.php',
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
