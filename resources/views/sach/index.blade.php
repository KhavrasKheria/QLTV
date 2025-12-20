@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">📚 Danh mục sách</h3>
            <span class="text-muted">Quản lý danh sách sách trong hệ thống</span>
        </div>

        <a href="{{ route('sach.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle"></i> Thêm sách
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Ảnh</th>
                            <th>Mã</th>
                            <th>Tên sách</th>
                            <th>Tóm tắt</th>
                            <th>Tác giả</th>
                            <th>Thể loại</th>
                            <th class="text-center">SL</th>
                            <th class="text-center">NXB</th>
                            <th class="text-center">Vị trí</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center pe-4">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($sachs as $s)
                        <tr>
                            {{-- ẢNH BÌA --}}
                            <td class="ps-4">
                                <img src="{{ asset($s->Anh ?? 'img_book/default.jpg') }}" 
                                     alt="{{ $s->TenSach }}" 
                                     class="img-thumbnail" style="width:50px; height:70px;">
                            </td>

                            <td class="fw-semibold text-primary">#{{ $s->MaSach }}</td>
                            <td class="fw-semibold">{{ $s->TenSach }}</td>

                            {{-- TÓM TẮT --}}
                            <td style="max-width: 200px;">
                                <span class="text-muted">{{ Str::limit($s->TomTat, 50) }}</span>
                                @if(strlen($s->TomTat ?? '') > 50)
                                    <button class="btn btn-link btn-sm p-0 open-summary" data-summary="{{ $s->TomTat }}">Xem thêm</button>
                                @endif
                            </td>

                            {{-- TÁC GIẢ --}}
                            <td>
                                @foreach($s->tacGias as $tg)
                                    <span class="badge bg-info text-dark me-1">{{ $tg->TenTG }}</span>
                                @endforeach
                            </td>

                            {{-- THỂ LOẠI --}}
                            <td>
                                @foreach($s->theLoais as $tl)
                                    <span class="badge bg-warning text-dark me-1">{{ $tl->TenTheLoai }}</span>
                                @endforeach
                            </td>

                            {{-- SỐ LƯỢNG --}}
                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success px-3 py-2">{{ $s->SoLuong }}</span>
                            </td>

                            {{-- NXB --}}
                            <td class="text-center">
                                <span class="badge bg-secondary-subtle text-secondary px-3 py-2">{{ $s->nhaXuatBan->TenNXB ?? '-' }}</span>
                            </td>

                            {{-- VỊ TRÍ --}}
                            <td class="text-center">
                                <span class="badge bg-secondary-subtle text-secondary px-3 py-2">{{ $s->MaVT }}</span>
                            </td>

                            {{-- TRẠNG THÁI --}}
                            <td class="text-center">
                                @if($s->TrangThai == 'Con')
                                    <span class="badge bg-success">Còn</span>
                                @elseif($s->TrangThai == 'Het')
                                    <span class="badge bg-danger">Hết</span>
                                @else
                                    <span class="badge bg-warning text-dark">Thủ thư đang xử lý</span>
                                @endif
                            </td>

                            {{-- ACTION --}}
                            <td class="text-center pe-4">
                                <a href="{{ route('sach.edit', $s->MaSach) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger open-delete-modal" data-id="{{ $s->MaSach }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TÓM TẮT --}}
<div class="modal fade" id="summaryModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title">📘 Nội dung tóm tắt</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body fs-5" id="summaryContent"></div>
        </div>
    </div>
</div>

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Xác nhận xóa</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Bạn chắc chắn muốn xóa sách này?
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Xem tóm tắt
    document.querySelectorAll(".open-summary").forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById("summaryContent").textContent = btn.dataset.summary;
            new bootstrap.Modal(document.getElementById('summaryModal')).show();
        });
    });

    // Xóa sách
    document.querySelectorAll(".open-delete-modal").forEach(btn => {
        btn.addEventListener("click", () => {
            document.getElementById('deleteForm').action = "/sach/" + btn.dataset.id;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });
});
</script>
@endsection
