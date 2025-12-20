@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- TIÊU ĐỀ --}}
    <div class="mb-4">
        <h3 class="fw-bold">➕ Thêm tác giả</h3>
        <p class="text-muted mb-0">Nhập thông tin tác giả mới vào hệ thống</p>
    </div>

    {{-- THÔNG BÁO LỖI CHUNG --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>⚠️ Lỗi!</strong> Vui lòng kiểm tra lại thông tin bên dưới.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tacgia.store') }}" method="POST">
                @csrf

                {{-- MÃ TÁC GIẢ --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Mã tác giả <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="MaTG"
                           class="form-control @error('MaTG') is-invalid @enderror"
                           value="{{ old('MaTG') }}"
                           placeholder="Ví dụ: TG001">

                    @error('MaTG')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TÊN TÁC GIẢ --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Tên tác giả <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="TenTG"
                           class="form-control @error('TenTG') is-invalid @enderror"
                           value="{{ old('TenTG') }}"
                           placeholder="Ví dụ: Nguyễn Nhật Ánh">

                    @error('TenTG')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NÚT --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">
                        💾 Lưu
                    </button>

                    <a href="{{ route('tacgia.index') }}"
                       class="btn btn-outline-secondary px-4">
                        ↩️ Quay lại
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
