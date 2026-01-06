@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- Tiêu đề --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <i class="bi bi-card-list"></i> Quản lý thẻ độc giả
        </h4>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalThemDocGia">
            <i class="bi bi-person-plus"></i> Thêm độc giả mới
        </button>
    </div>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Bộ lọc và tìm kiếm --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('thedocgia.index') }}" method="GET" id="formTimKiem">
                <div class="row g-3">
                    
                    {{-- Tìm kiếm --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tìm kiếm</label>
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   id="searchInput" 
                                   class="form-control" 
                                   placeholder="Tìm theo mã hoặc tên độc giả..." 
                                   value="{{ request('search') }}"
                                   style="height: 38px;">
                            <button type="button" 
                                    class="btn btn-outline-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalScanQR"
                                    style="height: 38px;">
                                <i class="bi bi-qr-code-scan"></i> Quét QR
                            </button>
                        </div>
                    </div>

                    {{-- Lọc theo khoa --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Khoa</label>
                        <select name="khoa" class="form-select">
                            <option value="">-- Tất cả --</option>
                            @foreach($danhSachKhoa as $khoa)
                                <option value="{{ $khoa }}" {{ request('khoa') == $khoa ? 'selected' : '' }}>
                                    {{ $khoa }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Lọc theo trạng thái --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select name="trang_thai" class="form-select">
                            <option value="">-- Tất cả --</option>
                            <option value="HoatDong" {{ request('trang_thai') == 'HoatDong' ? 'selected' : '' }}>
                                Hoạt động
                            </option>
                            <option value="Khoa" {{ request('trang_thai') == 'Khoa' ? 'selected' : '' }}>
                                Khóa
                            </option>
                        </select>
                    </div>

                    {{-- Nút lọc --}}
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-filter"></i> Lọc
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Danh sách độc giả --}}
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-people"></i> Danh sách độc giả</span>
            <span class="badge bg-light text-dark">Tổng: {{ $docGias->total() }} độc giả</span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">Mã độc giả</th>
                            <th style="width: 25%;">Tên độc giả</th>
                            <th style="width: 20%;">Khoa</th>
                            <th style="width: 15%;">Lớp</th>
                            <th style="width: 10%;">Trạng thái</th>
                            <th style="width: 10%;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($docGias as $index => $dg)
                            <tr>
                                <td class="text-center">{{ $docGias->firstItem() + $index }}</td>
                                <td><strong>{{ $dg->MaDocGia }}</strong></td>
                                <td>{{ $dg->TenDocGia }}</td>
                                <td>{{ $dg->Khoa ?? '-' }}</td>
                                <td>{{ $dg->Lop ?? '-' }}</td>
                                <td class="text-center">
                                    @if($dg->TrangThai == 'HoatDong')
                                        <span class="badge bg-success">Hoạt động</span>
                                    @else
                                        <span class="badge bg-danger">Khóa</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('thedocgia.destroy', $dg->MaDocGia) }}" 
                                          method="POST" 
                                          class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm" 
                                                title="Xóa"
                                                data-doc-gia-name="{{ $dg->TenDocGia }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    Không tìm thấy độc giả nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Phân trang --}}
            <div class="d-flex justify-content-end mt-3">
                {{ $docGias->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

</div>

{{-- Include Modal --}}
@include('thedocgia.modal.them')
@include('thedocgia.modal.scan-qr')

{{-- Modal xác nhận xóa --}}
<div class="modal fade" id="modalXacNhanXoa" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle"></i> Xác nhận xóa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Bạn có chắc muốn xóa độc giả <strong id="tenDocGiaXoa"></strong>?</p>
                <p class="text-muted small mb-0 mt-2">
                    <i class="bi bi-info-circle"></i> Hành động này không thể hoàn tác!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Hủy
                </button>
                <button type="button" class="btn btn-danger" id="btnXacNhanXoa">
                    <i class="bi bi-trash"></i> Xóa
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý xóa độc giả
    let formToSubmit = null;
    const modalXacNhan = new bootstrap.Modal(document.getElementById('modalXacNhanXoa'));
    
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const tenDocGia = this.querySelector('button').dataset.docGiaName;
            document.getElementById('tenDocGiaXoa').textContent = tenDocGia;
            
            formToSubmit = this;
            modalXacNhan.show();
        });
    });
    
    document.getElementById('btnXacNhanXoa').addEventListener('click', function() {
        if (formToSubmit) {
            formToSubmit.submit();
        }
    });
});
</script>
@endsection