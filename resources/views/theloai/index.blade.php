@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    {{-- HEADER --}}
    <div class="header-section mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-bookmarks-fill text-primary"></i> Quản lý Thể loại
                </h2>
                <p class="text-muted mb-0">Tổng cộng: <strong>{{ count($theloais) }}</strong> thể loại</p>
            </div>
            <button class="btn btn-primary btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> Thêm thể loại
            </button>
        </div>
    </div>

    {{-- THÔNG BÁO --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- GRID CARD --}}
    <div class="row g-4">
        @php
            $sortedTheloais = $theloais->sortBy('TenTheLoai', SORT_NATURAL | SORT_FLAG_CASE);
        @endphp
        
        @foreach($sortedTheloais as $tl)
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
            <div class="card theloai-card shadow-sm h-100"
                 data-id="{{ $tl->id }}"
                 data-name="{{ $tl->TenTheLoai }}">

                <div class="card-body text-center py-4">
                    <div class="category-icon mb-3">
                        <i class="bi bi-bookmark-fill"></i>
                    </div>
                    <h6 class="fw-semibold mb-0 category-name">
                        {{ $tl->TenTheLoai }}
                    </h6>
                </div>

                <div class="card-footer bg-transparent border-0 text-center pb-3">
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button"
                                class="btn btn-outline-primary btn-edit"
                                data-id="{{ $tl->id }}"
                                data-name="{{ $tl->TenTheLoai }}"
                                title="Chỉnh sửa">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button"
                                class="btn btn-outline-danger btn-delete"
                                data-id="{{ $tl->id }}"
                                title="Xóa">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ================= MODAL THÊM ================= --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="{{ route('theloai.store') }}">
                @csrf

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle"></i> Thêm thể loại mới
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-bookmark"></i> Tên thể loại
                        </label>
                        <input type="text"
                               name="TenTheLoai"
                               class="form-control form-control-lg"
                               placeholder="Nhập tên thể loại..."
                               required
                               autofocus>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Hủy
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Lưu
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- ================= MODAL SỬA ================= --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" id="editForm">
                @csrf
                @method('PUT')

                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square"></i> Chỉnh sửa thể loại
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-bookmark"></i> Tên thể loại
                        </label>
                        <input type="text"
                               name="TenTheLoai"
                               id="editName"
                               class="form-control form-control-lg"
                               required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Hủy
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i> Cập nhật
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- ================= MODAL XÓA ================= --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" id="deleteForm">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle"></i> Xác nhận xóa
                    </h5>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-trash text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p class="mb-0 fs-5">Bạn có chắc chắn muốn xóa thể loại này?</p>
                    <p class="text-muted small mt-2">Hành động này không thể hoàn tác!</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Hủy
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Xóa
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const editModal   = new bootstrap.Modal(document.getElementById('editModal'));
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

    const editForm  = document.getElementById('editForm');
    const editName  = document.getElementById('editName');
    const deleteForm = document.getElementById('deleteForm');

    // Click nút edit
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            editForm.action = `/theloai/${btn.dataset.id}`;
            editName.value = btn.dataset.name;
            editModal.show();
        });
    });

    // Click nút xóa
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            deleteForm.action = `/theloai/${btn.dataset.id}`;
            deleteModal.show();
        });
    });

    // Click card để xem chi tiết (optional)
    document.querySelectorAll('.theloai-card').forEach(card => {
        const cardBody = card.querySelector('.card-body');
        cardBody.addEventListener('click', () => {
            editForm.action = `/theloai/${card.dataset.id}`;
            editName.value = card.dataset.name;
            editModal.show();
        });
    });

});
</script>

{{-- ================= STYLE ================= --}}
<style>
/* Header Section */
.header-section {
    padding: 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.header-section h2 {
    color: white;
}

.header-section .text-muted {
    color: rgba(255, 255, 255, 0.9) !important;
}

/* Card Styling */
.theloai-card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
    background: white;
    position: relative;
    overflow: hidden;
}

.theloai-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.theloai-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.theloai-card:hover::before {
    transform: scaleX(1);
}

/* Category Icon */
.category-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transition: all 0.3s ease;
}

.category-icon i {
    font-size: 1.8rem;
    color: white;
}

.theloai-card:hover .category-icon {
    transform: rotateY(360deg);
}

/* Category Name */
.category-name {
    color: #2d3748;
    font-size: 0.95rem;
    line-height: 1.4;
    word-break: break-word;
}

/* Buttons */
.btn-group-sm .btn {
    padding: 0.4rem 0.8rem;
    font-size: 0.85rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    transform: translateY(-2px);
}

.btn-outline-danger:hover {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    border-color: #f5576c;
    transform: translateY(-2px);
}

/* Modal Styling */
.modal-content {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

.modal-header {
    border-bottom: none;
    padding: 1.5rem;
}

.modal-body {
    background: #f8f9fa;
}

.form-control-lg {
    border-radius: 10px;
    border: 2px solid #e2e8f0;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Alert */
.alert {
    border: none;
    border-radius: 10px;
    border-left: 4px solid #10b981;
}

/* Responsive */
@media (max-width: 768px) {
    .header-section {
        padding: 1rem;
    }
    
    .header-section h2 {
        font-size: 1.5rem;
    }
    
    .category-icon {
        width: 50px;
        height: 50px;
    }
    
    .category-icon i {
        font-size: 1.5rem;
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

.theloai-card {
    animation: fadeInUp 0.5s ease;
}
</style>

{{-- Link Bootstrap Icons nếu chưa có --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endpush
@endsection