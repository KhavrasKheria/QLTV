@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- TIÊU ĐỀ --}}
    <div class="mb-4">
        <h3 class="fw-bold">✏️ Sửa tác giả</h3>
      
    </div>

    {{-- THÔNG BÁO LỖI --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>⚠️ Lỗi!</strong> Vui lòng kiểm tra lại thông tin.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD FORM --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tacgia.update', $tacgia->MaTG) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- MÃ TÁC GIẢ (KHÓA) --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Mã tác giả
                    </label>
                    <input type="text"
                           class="form-control"
                           value="{{ $tacgia->MaTG }}"
                           disabled>
                </div>

                {{-- TÊN TÁC GIẢ --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Tên tác giả <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="TenTG"
                           class="form-control @error('TenTG') is-invalid @enderror"
                           value="{{ old('TenTG', $tacgia->TenTG) }}"
                           placeholder="Nhập tên tác giả">

                    @error('TenTG')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NÚT --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        🔄 Cập nhật
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
