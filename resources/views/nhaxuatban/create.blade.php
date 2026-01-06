@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- BREADCRUMB --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('nhaxuatban.index') }}">
                    <i class="bi bi-building"></i> Nhà Xuất Bản
                </a>
            </li>
            <li class="breadcrumb-item active">Thêm mới</li>
        </ol>
    </nav>

    {{-- HEADER --}}
    <div class="header-section mb-4">
        <div class="d-flex align-items-center">
            <div class="header-icon me-3">
                <i class="bi bi-plus-circle"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-1">Thêm Nhà Xuất Bản Mới</h2>
                <p class="mb-0">Nhập thông tin chi tiết về nhà xuất bản</p>
            </div>
        </div>
    </div>

    {{-- THÔNG BÁO --}}
    @if(request()->get('from_sach'))
        <div class="alert alert-info alert-custom shadow-sm mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                <div>
                    <strong>Lưu ý:</strong> Sau khi thêm, nhà xuất bản này sẽ được tự động chọn cho sách.
                </div>
            </div>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="card form-card shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('nhaxuatban.store') }}">
                @csrf
                
                @if(request()->get('from_sach'))
                    <input type="hidden" name="from_sach" value="1">
                @endif

                {{-- TÊN NXB --}}
                <div class="form-group-custom mb-4">
                    <label class="form-label">
                        <i class="bi bi-building"></i> Tên Nhà Xuất Bản
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text"
                               name="TenNXB"
                               class="form-control form-control-lg"
                               placeholder="Ví dụ: Nhà Xuất Bản Kim Đồng..."
                               value="{{ old('TenNXB') }}"
                               required
                               autofocus>
                        <i class="bi bi-building input-icon"></i>
                    </div>
                    @error('TenNXB')
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">
                        <i class="bi bi-lightbulb"></i> Nhập tên đầy đủ và chính xác của nhà xuất bản
                    </small>
                </div>

                {{-- NÚT HÀNH ĐỘNG --}}
                <div class="action-buttons">
                    <a href="{{ request()->get('from_sach') ? route('nhaxuatban.index', ['from_sach' => 1]) : route('nhaxuatban.index') }}" 
                       class="btn btn-secondary btn-lg">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-check-circle"></i> Lưu Nhà Xuất Bản
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- HƯỚNG DẪN --}}
    <div class="card info-card mt-4">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-question-circle"></i> Hướng dẫn
            </h6>
            <ul class="mb-0">
                <li>Tên nhà xuất bản là thông tin bắt buộc</li>
                <li>Đảm bảo nhập tên đầy đủ và chính xác</li>
                <li>Kiểm tra kỹ trước khi lưu để tránh trùng lặp</li>
            </ul>
        </div>
    </div>

</div>

{{-- STYLE --}}
<style>
/* Breadcrumb */
.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.breadcrumb-item a {
    color: #6b7280;
    text-decoration: none;
    transition: all 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #10b981;
}

.breadcrumb-item.active {
    color: #374151;
    font-weight: 600;
}

/* Header Section */
.header-section {
    padding: 1.5rem;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 15px;
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.header-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    font-size: 2rem;
}

.header-section h2,
.header-section p {
    color: white;
}

/* Alert Custom */
.alert-custom {
    border: none;
    border-radius: 12px;
    border-left: 4px solid #3b82f6;
    background-color: #dbeafe;
    color: #1e40af;
}

/* Form Card */
.form-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

/* Form Group Custom */
.form-group-custom {
    position: relative;
}

.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.form-label i {
    color: #10b981;
}

/* Input Wrapper */
.input-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 1.2rem;
}

.form-control-lg {
    padding: 0.875rem 3rem 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.form-control-lg::placeholder {
    color: #9ca3af;
}

/* Invalid Feedback */
.invalid-feedback {
    display: block;
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #ef4444;
}

/* Form Text */
.form-text {
    display: block;
    margin-top: 0.5rem;
    font-size: 0.875rem;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 1.5rem;
    border-top: 2px solid #f3f4f6;
    margin-top: 1.5rem;
}

.btn-lg {
    padding: 0.75rem 2rem;
    font-size: 1rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary {
    background: #6b7280;
    border: none;
}

.btn-secondary:hover {
    background: #4b5563;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(107, 114, 128, 0.4);
}

.btn-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

/* Info Card */
.info-card {
    border: 2px dashed #e5e7eb;
    border-radius: 12px;
    background: #f9fafb;
}

.info-card h6 {
    color: #374151;
}

.info-card h6 i {
    color: #10b981;
}

.info-card ul {
    padding-left: 1.25rem;
    color: #6b7280;
}

.info-card li {
    margin-bottom: 0.5rem;
}

.info-card li:last-child {
    margin-bottom: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .header-section {
        padding: 1rem;
    }
    
    .header-section h2 {
        font-size: 1.5rem;
    }
    
    .header-icon {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-card {
    animation: fadeInUp 0.5s ease;
}
</style>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endpush
@endsection