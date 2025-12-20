@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- TIÊU ĐỀ + NÚT THÊM --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-0">📚 Danh sách tác giả</h3>
        <a href="{{ route('tacgia.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm tác giả
        </a>
    </div>

    {{-- THÔNG BÁO SAU KHI XÓA --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM TÌM KIẾM --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('tacgia.index') }}" method="GET">
                <div class="input-group">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="🔍 Nhập tên tác giả..."
                           value="{{ request('keyword') }}">
                    <button class="btn btn-primary px-4">Tìm</button>
                </div>
            </form>
        </div>
    </div>

    {{-- BẢNG DANH SÁCH --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0 align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="120">Mã tác giả</th>
                        <th>Tên tác giả</th>
                        <th width="200">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tacgias as $tg)
                        <tr>
                            <td class="text-center">{{ $tg->MaTG }}</td>
                            <td>{{ $tg->TenTG }}</td>
                            <td class="text-center">
                                <a href="{{ route('tacgia.edit', $tg->MaTG) }}"
                                   class="btn btn-warning btn-sm me-1">
                                    ✏️ Sửa
                                </a>

                                <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-action="{{ route('tacgia.destroy', $tg->MaTG) }}">
                                    🗑️ Xóa
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                Không tìm thấy tác giả nào
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
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <p class="mb-1">
                    Bạn có chắc chắn muốn <strong>xóa tác giả này</strong> không?
                </p>
                <small class="text-muted">
                    Hành động này không thể hoàn tác.
                </small>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    ❌ Hủy
                </button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        🗑️ Xóa
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT GÁN ACTION CHO FORM XÓA --}}
<script>
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const action = button.getAttribute('data-action');
        document.getElementById('deleteForm').action = action;
    });
</script>
@endsection
