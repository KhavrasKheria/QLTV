@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="header-section mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-building"></i> Quản lý Nhà Xuất Bản
                </h2>
                <p class="text-muted mb-0">
                    Tổng cộng: <strong>{{ $dsNXB->count() }}</strong> nhà xuất bản
                </p>
            </div>
            <a href="{{ route('nhaxuatban.create') }}" class="btn btn-success btn-lg shadow-sm">
                <i class="bi bi-plus-circle"></i> Thêm mới
            </a>
        </div>
    </div>

    {{-- THÔNG BÁO --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM TÌM KIẾM --}}
    <div class="card search-card shadow-sm mb-4">
        <div class="card-body">
            <form id="searchForm" action="{{ route('nhaxuatban.index') }}" method="GET">
                <div class="search-wrapper">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text"
                           id="searchInput"
                           name="keyword"
                           class="form-control search-input"
                           placeholder="Tìm kiếm nhà xuất bản..."
                           value="{{ request('keyword') }}">
                    <button type="submit" class="btn btn-primary search-btn">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- BẢNG DANH SÁCH --}}
    <div class="card table-card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th width="100" class="text-center">
                                <i class="bi bi-hash"></i> ID
                            </th>
                            <th>
                                <i class="bi bi-building"></i> Tên Nhà Xuất Bản
                            </th>
                            <th width="220" class="text-center">
                                <i class="bi bi-gear"></i> Thao Tác
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse ($dsNXB as $nxb)
                            <tr class="table-row">
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">{{ $nxb->ID }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="publisher-icon me-2">
                                            <i class="bi bi-building-fill"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $nxb->TenNXB }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('nhaxuatban.edit', $nxb->ID) }}"
                                           class="btn btn-warning"
                                           title="Chỉnh sửa">
                                            <i class="bi bi-pencil-square"></i> Sửa
                                        </a>
                                        <button class="btn btn-danger delete-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-action="{{ route('nhaxuatban.destroy', $nxb->ID) }}"
                                                title="Xóa">
                                            <i class="bi bi-trash"></i> Xóa
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <p class="mb-0">Không tìm thấy nhà xuất bản nào</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- MODAL XÁC NHẬN XÓA --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle"></i> Xác nhận xóa
                </h5>
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-trash text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="mb-0 fs-5">
                    Bạn có chắc chắn muốn xóa nhà xuất bản này?
                </p>
                <p class="text-muted small mt-2">
                    Hành động này không thể hoàn tác!
                </p>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Hủy
                </button>

                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Xóa
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Hàm tìm kiếm AJAX
    function searchPublishers(keyword) {
        fetch(`{{ route('nhaxuatban.index') }}?keyword=${encodeURIComponent(keyword)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('tableBody');
            
            if (data.nhaxuatbans && data.nhaxuatbans.length > 0) {
                tableBody.innerHTML = data.nhaxuatbans.map(nxb => `
                    <tr class="table-row">
                        <td class="text-center">
                            <span class="badge bg-light text-dark">${nxb.ID}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="publisher-icon me-2">
                                    <i class="bi bi-building-fill"></i>
                                </div>
                                <span class="fw-semibold">${nxb.TenNXB}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('nhaxuatban.index') }}/${nxb.ID}/edit"
                                   class="btn btn-warning"
                                   title="Chỉnh sửa">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <button class="btn btn-danger delete-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-action="{{ route('nhaxuatban.index') }}/${nxb.ID}"
                                        title="Xóa">
                                    <i class="bi bi-trash"></i> Xóa
                                </button>
                            </div>
                        </td>
                    </tr>
                `).join('');
            } else {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p class="mb-0">Không tìm thấy nhà xuất bản nào</p>
                            </div>
                        </td>
                    </tr>
                `;
            }
        })
        .catch(error => {
            console.error('Lỗi tìm kiếm:', error);
        });
    }

    // Debounced search
    const debouncedSearch = debounce(searchPublishers, 500);

    // Lắng nghe sự kiện input
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const keyword = e.target.value.trim();
        debouncedSearch(keyword);
    });

    // Xử lý modal xóa
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const action = button.getAttribute('data-action');
        document.getElementById('deleteForm').action = action;
    });

    // Event delegation cho nút xóa
    document.getElementById('tableBody').addEventListener('click', function(e) {
        const deleteBtn = e.target.closest('.delete-btn');
        if (deleteBtn) {
            const action = deleteBtn.getAttribute('data-action');
            document.getElementById('deleteForm').action = action;
        }
    });
</script>

{{-- STYLE --}}
<style>
/* Header Section */
.header-section {
    padding: 1.5rem;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 15px;
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.header-section h2,
.header-section .text-muted {
    color: white !important;
}

/* Search Card */
.search-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-icon {
    position: absolute;
    left: 15px;
    color: #6b7280;
    font-size: 1.1rem;
    z-index: 1;
}

.search-input {
    padding-left: 45px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    height: 45px;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.search-btn {
    height: 45px;
    padding: 0 1.5rem;
    border-radius: 10px;
    white-space: nowrap;
}

/* Table Card */
.table-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

.table thead {
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    color: white;
}

.table thead th {
    padding: 1rem;
    font-weight: 600;
    border: none;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table tbody td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f3f4f6;
}

.table-row {
    transition: all 0.3s ease;
}

.table-row:hover {
    background-color: #f9fafb;
    transform: scale(1.01);
}

/* Publisher Icon */
.publisher-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 10px;
    color: white;
    font-size: 1.2rem;
}

/* Buttons */
.btn-group-sm .btn {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: none;
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

.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
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

/* Empty State */
.empty-state {
    color: #9ca3af;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

/* Badge */
.badge {
    padding: 0.5rem 0.75rem;
    font-weight: 600;
    font-size: 0.875rem;
}

/* Alert */
.alert {
    border: none;
    border-radius: 10px;
    border-left: 4px solid;
}

.alert-success {
    background-color: #d1fae5;
    color: #065f46;
    border-left-color: #10b981;
}

.alert-danger {
    background-color: #fee2e2;
    color: #991b1b;
    border-left-color: #ef4444;
}

/* Modal */
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
    background: #f9fafb;
}

/* Responsive */
@media (max-width: 768px) {
    .header-section {
        padding: 1rem;
    }
    
    .header-section h2 {
        font-size: 1.5rem;
    }
    
    .search-wrapper {
        flex-direction: column;
    }
    
    .search-btn {
        width: 100%;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        border-radius: 8px !important;
    }
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-row {
    animation: fadeIn 0.3s ease;
}
</style>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endpush
@endsection