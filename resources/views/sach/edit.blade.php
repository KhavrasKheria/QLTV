@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-pencil-square text-warning"></i> Sửa thông tin sách
            </h2>
            <p class="text-muted mb-0">Cập nhật thông tin sách trong hệ thống</p>
        </div>
        <a href="{{ route('sach.index') }}" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>

    {{-- ERRORS --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Có lỗi xảy ra!</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('sach.update', $sach->ISBN13) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- CỘT TRÁI --}}
            <div class="col-lg-8">
                
                {{-- THÔNG TIN CƠ BẢN --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-info-circle-fill me-2"></i>Thông tin cơ bản
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            {{-- MÃ SÁCH (LOCKED) --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-lock-fill text-muted me-2"></i>Mã sách (ISBN-13)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-lock-fill text-muted"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control form-control-lg bg-light text-muted"
                                        value="{{ $sach->ISBN13 }}"
                                        disabled
                                        readonly>
                                </div>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle"></i>
                                    Mã sách được khóa, không thể chỉnh sửa
                                </small>
                            </div>

                            {{-- TÊN SÁCH --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-book text-success me-2"></i>Tên sách
                                </label>
                                <input type="text" 
                                    name="TenSach" 
                                    class="form-control form-control-lg"
                                    value="{{ old('TenSach', $sach->TenSach) }}"
                                    placeholder="Nhập tên sách..."
                                    required>
                            </div>

                            {{-- NGƯỜI DỊCH --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-translate text-info me-2"></i>Người dịch
                                </label>
                                <input type="text" 
                                    name="NguoiDich" 
                                    class="form-control"
                                    value="{{ old('NguoiDich', $sach->NguoiDich) }}"
                                    placeholder="Nhập tên người dịch...">
                            </div>

                            {{-- SỐ TRANG --}}
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-file-earmark-text text-warning me-2"></i>Số trang
                                </label>
                                <input type="number" 
                                    name="SoTrang" 
                                    class="form-control"
                                    value="{{ old('SoTrang', $sach->SoTrang) }}"
                                    placeholder="0"
                                    required>
                            </div>

                            {{-- NĂM XUẤT BẢN --}}
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-calendar-event text-danger me-2"></i>Năm XB
                                </label>
                                <input type="number" 
                                    name="NamXuatBang" 
                                    class="form-control"
                                    value="{{ old('NamXuatBang', $sach->NamXuatBang) }}"
                                    placeholder="2024"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TÓM TẮT --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-gradient-info text-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-card-text me-2"></i>Tóm tắt nội dung
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div id="shortSummary" class="alert alert-light border mb-3">
                            <i class="bi bi-file-text me-2"></i>
                            {{ $sach->TomTat ? Str::limit($sach->TomTat, 100) : 'Chưa có tóm tắt nội dung' }}
                        </div>

                        <button type="button"
                            class="btn btn-outline-primary open-summary-modal"
                            data-bs-toggle="modal"
                            data-bs-target="#summaryModal">
                            <i class="bi bi-pencil-square me-2"></i>Nhập tóm tắt
                        </button>

                        <input type="hidden" name="TomTat" id="TomTatHidden" value="{{ old('TomTat', $sach->TomTat) }}">
                    </div>
                </div>

                {{-- TÁC GIẢ & THỂ LOẠI --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-gradient-success text-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-people-fill me-2"></i>Tác giả & Thể loại
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            {{-- TÁC GIẢ --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-person-fill text-primary me-2"></i>Tác giả
                                </label>
                                <div id="currentAuthors" class="alert alert-light border mb-2">
                                    <i class="bi bi-person-check me-2"></i>
                                    {{ $sach->tacGias->pluck('TenTG')->join(', ') ?: 'Chưa chọn tác giả' }}
                                </div>
                                <button type="button"
                                    class="btn btn-outline-primary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#authorsModal">
                                    <i class="bi bi-pencil-square me-2"></i>Chọn tác giả
                                </button>
                            </div>

                            {{-- THỂ LOẠI --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-bookmarks-fill text-warning me-2"></i>Thể loại
                                </label>
                                <div id="currentCategories" class="alert alert-light border mb-2">
                                    <i class="bi bi-bookmark-check me-2"></i>
                                    {{ $sach->theLoais->pluck('TenTheLoai')->join(', ') ?: 'Chưa chọn thể loại' }}
                                </div>
                                <button type="button"
                                    class="btn btn-outline-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#categoriesModal">
                                    <i class="bi bi-pencil-square me-2"></i>Chọn thể loại
                                </button>
                            </div>
                        </div>

                        {{-- HIDDEN INPUTS --}}
                        <div id="hidden-authors">
                            @foreach($sach->tacGias as $tg)
                            <input type="hidden" name="tacGias[]" value="{{ $tg->MaTG }}">
                            @endforeach
                        </div>

                        <div id="hidden-categories">
                            @foreach($sach->theLoais as $tl)
                            <input type="hidden" name="theLoais[]" value="{{ $tl->id }}">
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- NHÀ XUẤT BẢN & VỊ TRÍ --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-gradient-warning text-dark py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-building me-2"></i>Nhà xuất bản & Vị trí
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            {{-- NHÀ XUẤT BẢN --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-building text-danger me-2"></i>Nhà xuất bản
                                </label>
                                <select name="MaNXB" class="form-select form-select-lg">
                                    <option value="">-- Chọn nhà xuất bản --</option>
                                    @foreach($nhaXuatBans as $nxb)
                                    <option value="{{ $nxb->ID }}"
                                        {{ old('MaNXB', $sach->MaNXB) == $nxb->ID ? 'selected' : '' }}>
                                        {{ $nxb->TenNXB }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- MÃ VỊ TRÍ --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-pin-map-fill text-success me-2"></i>Mã vị trí
                                </label>
                                <div class="input-group">
                                    <input type="text"
                                        name="MaVT"
                                        id="MaVT"
                                        class="form-control"
                                        value="{{ old('MaVT', $sach->MaVT ?? '') }}"
                                        placeholder="Ví dụ: A11, B23..."
                                        required>

                                    <button type="button"
                                        class="btn btn-outline-success"
                                        id="openMapPicker"
                                        title="Chọn từ bản đồ">
                                        <i class="bi bi-map"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- CỘT PHẢI --}}
            <div class="col-lg-4">
                
                {{-- ẢNH BÌA --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-gradient-danger text-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-image-fill me-2"></i>Ảnh bìa sách
                        </h5>
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="book-cover-preview mb-3">
                            <img id="imagePreview" 
                                src="{{ asset($sach->Anh ?? 'img_book/default.jpg') }}" 
                                class="img-fluid rounded shadow"
                                style="max-height: 350px; width: auto;">
                        </div>
                        
                        <input type="file" 
                            name="Anh" 
                            id="bookCoverInput"
                            class="form-control"
                            accept="image/*">
                        
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle"></i>
                            Định dạng: JPG, PNG (tối đa 2MB)
                        </small>
                    </div>
                </div>

                {{-- SỐ LƯỢNG --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-gradient-success text-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-123 me-2"></i>Số lượng
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="quantity-selector">
                            @for ($i = 0; $i <= 3; $i++)
                            <input type="radio"
                                class="btn-check"
                                name="SoLuong"
                                id="qty{{ $i }}"
                                value="{{ $i }}"
                                {{ old('SoLuong', $sach->SoLuong) == $i ? 'checked' : '' }}>
                            <label class="btn btn-outline-{{ $i==0?'secondary':'success' }} w-100 mb-2 quantity-btn"
                                for="qty{{ $i }}">
                                <i class="bi bi-{{ $i==0 ? 'x-circle' : 'check-circle' }} me-2"></i>
                                {{ $i==0 ? 'Không có' : $i . ' cuốn' }}
                            </label>
                            @endfor
                        </div>
                    </div>
                </div>

                {{-- TRẠNG THÁI --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-gradient-secondary text-white py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-toggles2 me-2"></i>Trạng thái
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="status-selector">
                            <input type="radio" class="btn-check"
                                name="TrangThai" id="statusCon" value="Con"
                                {{ old('TrangThai', $sach->TrangThai)=='Con'?'checked':'' }}>
                            <label class="btn btn-outline-success w-100 mb-2 status-btn"
                                for="statusCon">
                                <i class="bi bi-check-circle-fill me-2"></i>Còn hàng
                            </label>

                            <input type="radio" class="btn-check"
                                name="TrangThai" id="statusHet" value="Het"
                                {{ old('TrangThai', $sach->TrangThai)=='Het'?'checked':'' }}>
                            <label class="btn btn-outline-danger w-100 mb-2 status-btn"
                                for="statusHet">
                                <i class="bi bi-x-circle-fill me-2"></i>Hết hàng
                            </label>

                            <input type="radio" class="btn-check"
                                name="TrangThai" id="statusThuThu"
                                value="ThuThuDangXuLy"
                                {{ old('TrangThai', $sach->TrangThai)=='ThuThuDangXuLy'?'checked':'' }}>
                            <label class="btn btn-outline-warning w-100 status-btn"
                                for="statusThuThu">
                                <i class="bi bi-hourglass-split me-2"></i>Đang xử lý
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- BUTTONS --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{ route('sach.index') }}" class="btn btn-outline-secondary btn-lg px-5">
                        <i class="bi bi-x-circle me-2"></i>Hủy bỏ
                    </a>
                    <button type="submit" class="btn btn-warning btn-lg px-5 shadow text-white">
                        <i class="bi bi-save me-2"></i>Cập nhật
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

{{-- CUSTOM STYLES --}}
<style>
    /* Gradient Backgrounds */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .bg-gradient-secondary {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
    }

    /* Card Styles */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
    }

    /* Form Controls */
    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .form-control-lg {
        height: 50px;
        font-size: 1.1rem;
    }

    .form-select-lg {
        height: 50px;
        font-size: 1rem;
    }

    /* Book Cover Preview */
    .book-cover-preview {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        padding: 20px;
        border-radius: 12px;
        border: 3px dashed #d1d5db;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .book-cover-preview img {
        transition: transform 0.3s ease;
    }

    .book-cover-preview img:hover {
        transform: scale(1.05);
    }

    /* Quantity Selector */
    .quantity-btn {
        height: 55px;
        font-size: 1.05rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .quantity-btn:hover {
        transform: translateX(5px);
    }

    .btn-check:checked + .quantity-btn {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    /* Status Selector */
    .status-btn {
        height: 55px;
        font-size: 1.05rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .status-btn:hover {
        transform: translateX(5px);
    }

    .btn-check:checked + .status-btn {
        transform: scale(1.05);
    }

    /* Alert Styles */
    .alert-light {
        background-color: #f8f9fa;
        border-left: 4px solid #6c757d;
    }

    /* Button Hover Effects */
    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Input Group */
    .input-group .btn {
        border-color: #ced4da;
    }

    .input-group .btn:hover {
        background-color: #667eea;
        border-color: #667eea;
        color: white;
    }

    /* Labels */
    .form-label {
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    /* Icons in labels */
    .form-label i {
        font-size: 1.1rem;
    }

    /* Card Header Icons */
    .card-header i {
        font-size: 1.2rem;
    }

    /* Locked Input Styling */
    .bg-light.text-muted {
        cursor: not-allowed;
    }
</style>

{{-- IMAGE PREVIEW SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookCoverInput = document.getElementById('bookCoverInput');
        const imagePreview = document.getElementById('imagePreview');

        if (bookCoverInput) {
            bookCoverInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.src = event.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>

{{-- MODALS & SCRIPTS --}}
@include('sach.modals.summary')

@include('sach.modals.authors', [
    'tacGias' => $tacGias,
    'selectedTacGiaIds' => $sach->tacGias->pluck('MaTG')->toArray()
])

@include('sach.modals.categories', [
    'theLoais' => $theLoais,
    'selectedTheLoaiIds' => $sach->theLoais->pluck('id')->toArray()
])

@include('sach.modals.map-picker')
@include('sach.scripts.form')
@include('sach.scripts.map-picker')

@endsection