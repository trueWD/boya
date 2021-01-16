<form id="YeniTahsilatForm">
    <!-- Basic modal -->
    <div id="YeniTahsilatModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sx">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Tahsilat Girişi</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Ödenen Tutar:</label>
                      <div class="col-lg-9">
                      <input type="text" name="tutar" class="form-control" id="tutar" placeholder="0,00" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Ödeme Tipi:</label>
                      <div class="col-lg-9">
                        <select name="odemetipi" class="form-control">
                          <option value="NAKIT">NAKIT</option>
                          <option value="KART">KART</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Açıklama:</label>
                      <div class="col-lg-9">
                      <textarea class="form-control" name="aciklama" placeholder="Açıklama"></textarea>
                      </div>
                    </div>
                  
                  </div>
                <div class="modal-footer">
                    <input type="hidden" class="cariid_yakala" id="cariid_yakala" name="id">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary YeniTahsilatSubmit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
</form>
<script type="text/javascript">
  new AutoNumeric('#YeniTahsilatForm #tutar', {
      decimalCharacter : ',',
      digitGroupSeparator : '.',
      modifyValueOnWheel	: false,
  });
</script>
