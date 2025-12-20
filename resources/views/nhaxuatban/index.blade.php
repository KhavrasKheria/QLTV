@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    {{-- Tiêu đề + nút thêm --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">
            📚 Quản lý Nhà Xuất Bản
        </h3>

        <a href="{{ route('nhaxuatban.create') }}" class="btn btn-success">
            ➕ Thêm NXB
        </a>
    </div>

    {{-- Card bảng --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th style="width:80px">ID</th>
                        <th>Tên Nhà Xuất Bản</th>
                        <th style="width:180px">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($dsNXB as $nxb)
                    <tr>
                        <td class="text-center fw-bold">{{ $nxb->ID }}</td>
                        <td>{{ $nxb->TenNXB }}</td>
                        <td class="text-center">

                            <a href="{{ route('nhaxuatban.edit', $nxb->ID) }}"
                               class="btn btn-warning btn-sm me-1">
                                ✏️ Sửa
                            </a>

                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="{{ $nxb->ID }}"
                                data-name="{{ $nxb->TenNXB }}">
                                🗑️ Xóa
                            </button>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            Không có nhà xuất bản nào
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
</div>

{{-- MODAL XÁC NHẬN XÓA --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">⚠️ Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>
                    Bạn có chắc muốn xóa nhà xuất bản:
                    <strong id="deleteName"></strong> ?
                </p>
                <p class="text-muted mb-0">
                    Hành động này không thể hoàn tác.
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    ❌ Hủy
                </button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        🗑️ Xóa
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    const deleteModal = document.getElementById('deleteModal');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');

        document.getElementById('deleteName').innerText = name;

        const form = document.getElementById('deleteForm');
        form.action = `/nhaxuatban/${id}`;
    });
</script>
@endsection
