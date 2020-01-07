
    <!-- UNTUK EDIT BARANG -->
        <div id="add" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Penarikan</h4>
              </div>
              <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">
                  <div class="form-group">
                    <label class="control-lable" for="nm_nasabah">Nama Nasabah</label>
                    <input type="hidden" name="norek" id="norek">
                    <input type="text" name="nm_nasabah" class="form-control" id="nm_nasabah" required>
                  </div>
                  <div class="form-group">
                    <label class="control-lable" for="saldo">Saldo</label>
                    <input type="number" name="saldo" class="form-control" id="saldo" required>
                  </div>
                  <div class="form-group">
                    <label class="control-lable" for="saldo_tabungan">Jumlah uang yang ingin ditarik</label>
                    <input type="number" name="saldo_tabungan" class="form-control" id="saldo_tabungan" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-success" name="add" value="Simpan">
                </div>
              </form>
            </div>
          </div>
        </div>

        <script type="text/javascript">
        $(document).on("click", "#tarik", function(){
          var norek = $(this).data('norek');
          var nm_nasabah = $(this).data('nm_nasabah');
          var saldo = $(this).data('saldo');
          var saldo_tabungan = $(this).data('saldo_tabungan');
          $("#modal-edit #norek").val(norek);
          $("#modal-edit #nm_nasabah").val(nm_nasabah);
          $("#modal-edit #saldo").val(saldo);
          $("#modal-edit #saldo_tabungan").val(saldo_tabungan);
        })

        $(document).ready(function(e) {
          $("#form").on("submit", (function(e) {
            e.preventDefault();
            $.ajax({
              url : 'models/transaksi/proses_add_tarik.php',
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
