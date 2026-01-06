{{-- Modal Thêm Độc Giả --}}
<div class="modal fade" id="modalThemDocGia" tabindex="-1" aria-labelledby="modalThemDocGiaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            {{-- Header --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalThemDocGiaLabel">
                    <i class="bi bi-person-plus"></i> Thêm độc giả mới
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <form action="{{ route('thedocgia.store') }}" method="POST" id="formThemDocGia">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Mã độc giả <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="MaDocGia" class="form-control" 
                               placeholder="VD: DG001" required>
                        <small class="text-muted">Mã độc giả phải là duy nhất</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Tên độc giả <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="TenDocGia" class="form-control" 
                               placeholder="Nhập tên đầy đủ" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Khoa</label>
                        <input type="text" name="Khoa" class="form-control" 
                               placeholder="VD: Công nghệ thông tin">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Lớp</label>
                        <input type="text" name="Lop" class="form-control" 
                               placeholder="VD: CNTT01">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select name="TrangThai" class="form-select">
                            <option value="HoatDong" selected>Hoạt động</option>
                            <option value="Khoa">Khóa</option>
                        </select>
                    </div>

                </form>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Đóng
                </button>
                <button type="submit" form="formThemDocGia" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Thêm độc giả
                </button>
            </div>

        </div>
    </div>
</div>