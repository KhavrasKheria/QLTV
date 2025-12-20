@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">📚 Thể loại</h3>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            ➕ Thêm thể loại
        </button>
    </div>

    {{-- THÔNG BÁO --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- GRID CARD --}}
    <div class="row g-3">
        @foreach($theloais as $tl)
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm h-100 theloai-card"
                 data-id="{{ $tl->id }}"
                 data-name="{{ $tl->TenTheLoai }}">

                <div class="card-body d-flex justify-content-center align-items-center">
                    <h5 class="fw-semibold text-center mb-0">
                        {{ $tl->TenTheLoai }}
                    </h5>
                </div>

                <div class="card-footer bg-white border-0 text-center">
                    <button type="button"
                            class="btn btn-sm btn-outline-danger btn-delete"
                            data-id="{{ $tl->id }}">
                        🗑️ Xóa
                    </button>
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

                <div class="modal-header">
                    <h5 class="modal-title">➕ Thêm thể loại</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Tên thể loại</label>
                    <input type="text"
                           name="TenTheLoai"
                           class="form-control"
                           required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Lưu
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

                <div class="modal-header">
                    <h5 class="modal-title">✏️ Sửa thể loại</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Tên thể loại</label>
                    <input type="text"
                           name="TenTheLoai"
                           id="editName"
                           class="form-control"
                           required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-warning">
                        Cập nhật
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
                    <h5 class="modal-title">⚠️ Xác nhận xóa</h5>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa thể loại này?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Xóa
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

    // Click card => sửa
    document.querySelectorAll('.theloai-card').forEach(card => {
        card.addEventListener('click', () => {
            editForm.action = `/theloai/${card.dataset.id}`;
            editName.value = card.dataset.name;
            editModal.show();
        });
    });

    // Click nút xóa
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation(); // không mở modal sửa
            deleteForm.action = `/theloai/${btn.dataset.id}`;
            deleteModal.show();
        });
    });

});
</script>

{{-- ================= STYLE ================= --}}
<style>
.theloai-card {
    cursor: pointer;
    transition: 0.2s;
}
.theloai-card:hover {
    transform: scale(1.05);
    background-color: #f8f9fa;
}
</style>
@endsection
