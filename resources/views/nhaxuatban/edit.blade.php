@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    {{-- Tiêu đề --}}
    <div class="mb-4">
        <h3 class="fw-bold text-warning">
            ✏️ Sửa Nhà Xuất Bản
        </h3>
        <p class="text-muted">
            Cập nhật thông tin nhà xuất bản
        </p>
    </div>

    {{-- Card form --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="{{ route('nhaxuatban.update', $nxb->ID) }}">
                @csrf
                @method('PUT')

                {{-- Tên NXB --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Tên Nhà Xuất Bản
                    </label>
                    <input
                        type="text"
                        name="TenNXB"
                        value="{{ $nxb->TenNXB }}"
                        class="form-control"
                        placeholder="Nhập tên nhà xuất bản..."
                        required
                    >
                </div>

                {{-- Nút --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('nhaxuatban.index') }}" class="btn btn-secondary">
                        ⬅ Quay lại
                    </a>
                    <button class="btn btn-warning">
                        🔄 Cập nhật
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
