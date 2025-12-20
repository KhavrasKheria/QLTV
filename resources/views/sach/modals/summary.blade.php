{{-- MODAL NHẬP TÓM TẮT --}}
<div class="modal fade" id="summaryModal" tabindex="-1">
  <div class="modal-dialog modal-summary-large modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">📘 Nhập tóm tắt</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <textarea id="SummaryEditor" class="form-control" rows="15"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="saveSummaryBtn">Lưu</button>
      </div>
    </div>
  </div>
</div>

{{-- CSS riêng cho modal summary --}}
<style>
.modal-summary-large { max-width: 75% !important; }
</style>
