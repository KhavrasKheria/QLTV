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
            <li class="breadcrumb-item active">Chỉnh sửa</li>
        </ol>
    </nav>

    {{-- HEADER --}}
    <div class="header-section mb-4">
        <div class="d-flex align-items-center">
            <div class="header-icon me-3">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-1">Chỉnh Sửa Nhà Xuất Bản</h2>
                <p class="mb-0">Cập nhật thông tin nhà xuất bản</p>
            </div>
        </div>
    </div>

    {{-- THÔNG TIN HIỆN TẠI --}}
    <div class="card info-current-card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="current-icon me-3">
                    <i class="bi bi-info-circle"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Đang chỉnh sửa</small>
                    <strong class="fs-5">{{ $nxb->TenNXB }}</strong>
                    <span class="badge bg-light text-dark ms-2">ID: {{ $nxb->ID }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="card form-card shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('nhaxuatban.update', $nxb->ID) }}">
                @csrf
                @method('PUT')

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
                               placeholder="Nhập tên nhà xuất bản..."
                               value="{{ old('TenNXB', $nxb->TenNXB) }}"
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
                        <i class="bi bi-lightbulb"></i> Cập nhật tên nhà xuất bản một cách chính xác
                    </small>
                </div>

                {{-- THÔNG TIN THÊM --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="stat-box">
                            <i class="bi bi-calendar-check"></i>
                            <div class="ms-3">
                                <small class="text-muted d-block">Ngày tạo</small>
                                <strong>{{ $nxb->created_at ? $nxb->created_at->format('d/m/Y H:i') : 'Không có' }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-box">
                            <i class="bi bi-clock-history"></i>
                            <div class="ms-3">
                                <small class="text-muted d-block">Cập nhật lần cuối</small>
                                <strong>{{ $nxb->updated_at ? $nxb->updated_at->format('d/m/Y H:i') : 'Không có' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- NÚT HÀNH ĐỘNG --}}
                <div class="action-buttons">
                    <a href="{{ route('nhaxuatban.index') }}" 
                       class="btn btn-secondary btn-lg">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="bi bi-check-circle"></i> Cập Nhật
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- HƯỚNG DẪN --}}
    <div class="card info-card mt-4">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-lightbulb"></i> Lưu ý khi chỉnh sửa
            </h6>
            <ul class="mb-0">
                <li>Kiểm tra kỹ tên nhà xuất bản trước khi lưu</li>
                <li>Thay đổi sẽ ảnh hưởng đến tất cả sách liên quan</li>
                <li>Không nên thay đổi quá nhiều so với tên gốc</li>
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
    color: #f59e0b;
}

.breadcrumb-item.active {
    color: #374151;
    font-weight: 600;
}

/* Header Section */
.header-section {
    padding: 1.5rem;
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    border-radius: 15px;
    color: white;
    box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
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

/* Info Current Card */
.info-current-card {
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    border-left: 4px solid #3b82f6;
}

.current-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 12px;
    color: #3b82f6;
    font-size: 1.5rem;
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
    color: #f59e0b;
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
    border-color: #f59e0b;
    box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
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

/* Stat Box */
.stat-box {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f9fafb;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
}

.stat-box i {
    font-size: 1.5rem;
    color: #f59e0b;
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
    border: none;
}

.btn-secondary {
    background: #6b7280;
}

.btn-secondary:hover {
    background: #4b5563;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(107, 114, 128, 0.4);
}

.btn-warning {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
}

/* Info Card */
.info-card {
    border: 2px dashed #e5e7eb;
    border-radius: 12px;
    background: #fffbeb;
    border-color: #fcd34d;
}

.info-card h6 {
    color: #374151;
}

.info-card h6 i {
    color: #f59e0b;
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

/* Badge */
.badge {
    padding: 0.35rem 0.65rem;
    font-weight: 600;
    font-size: 0.8rem;
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
    
    .stat-box {
        margin-bottom: 1rem;
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

.form-card,
.info-current-card {
    animation: fadeInUp 0.5s ease;
}
</style>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endpush
@endsection