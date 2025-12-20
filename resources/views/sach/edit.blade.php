@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">✏️ Sửa thông tin sách</h2>
        <a href="{{ route('sach.index') }}" class="btn btn-secondary">⬅ Quay lại</a>
    </div>

    {{-- ERRORS --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('sach.update', $sach->MaSach) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- MÃ SÁCH --}}
        <div class="mb-3">
            <label class="fw-semibold">Mã sách</label>
            <input type="text" class="form-control bg-light" value="{{ $sach->MaSach }}" disabled>
        </div>

        {{-- TÊN SÁCH --}}
        <div class="mb-3">
            <label class="fw-semibold">Tên sách</label>
            <input type="text" name="TenSach" class="form-control"
                   value="{{ old('TenSach', $sach->TenSach) }}" required>
        </div>

        {{-- NGƯỜI DỊCH --}}
        <div class="mb-3">
            <label class="fw-semibold">Người dịch</label>
            <input type="text" name="NguoiDich" class="form-control"
                   value="{{ old('NguoiDich', $sach->NguoiDich) }}">
        </div>

        {{-- SỐ TRANG --}}
        <div class="mb-3">
            <label class="fw-semibold">Số trang</label>
            <input type="number" name="SoTrang" class="form-control"
                   value="{{ old('SoTrang', $sach->SoTrang) }}" required>
        </div>

        {{-- NĂM XUẤT BẢN --}}
        <div class="mb-3">
            <label class="fw-semibold">Năm xuất bản</label>
            <input type="number" name="NamXuatBang" class="form-control"
                   value="{{ old('NamXuatBang', $sach->NamXuatBang) }}" required>
        </div>

        {{-- ẢNH --}}
        <div class="mb-3">
            <label class="fw-semibold">Ảnh bìa</label>
            <div class="mb-2">
                <img src="{{ asset($sach->Anh ?? 'img_book/default.jpg') }}"
                     class="img-thumbnail"
                     style="width:100px;height:140px;">
            </div>
            <input type="file" name="Anh" class="form-control">
        </div>

        {{-- TÓM TẮT --}}
        <div class="mb-3">
            <label class="fw-semibold">Tóm tắt</label>
            <div id="shortSummary" class="border rounded p-2 bg-light text-muted">
                {{ $sach->TomTat ? Str::limit($sach->TomTat, 70) : '(Chưa có tóm tắt)' }}
            </div>
            <button type="button"
                    class="btn btn-outline-primary btn-sm mt-2 open-summary-modal"
                    data-bs-toggle="modal"
                    data-bs-target="#summaryModal">
                ✏️ Nhập tóm tắt
            </button>
            <input type="hidden" name="TomTat" id="TomTatHidden"
                   value="{{ old('TomTat', $sach->TomTat) }}">
        </div>

        {{-- TÁC GIẢ --}}
        <div class="mb-3">
            <label class="fw-semibold">Tác giả</label>
            <div id="currentAuthors" class="border rounded p-2 bg-light mb-2">
                {{ $sach->tacGias->pluck('TenTG')->join(', ') ?: '(Chưa chọn tác giả)' }}
            </div>
            <button type="button"
                    class="btn btn-outline-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#authorsModal">
                ✏️ Chọn tác giả
            </button>
        </div>

        {{-- THỂ LOẠI --}}
        <div class="mb-3">
            <label class="fw-semibold">Thể loại</label>
            <div id="currentCategories" class="border rounded p-2 bg-light mb-2">
                {{ $sach->theLoais->pluck('TenTheLoai')->join(', ') ?: '(Chưa chọn thể loại)' }}
            </div>
            <button type="button"
                    class="btn btn-outline-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#categoriesModal">
                ✏️ Chọn thể loại
            </button>
        </div>

        {{-- HIDDEN INPUT --}}
        <div id="hidden-authors">
            @foreach($sach->tacGias as $tg)
                <input type="hidden" name="tacGias[]" value="{{ $tg->MaTG }}">
            @endforeach
        </div>

        <div id="hidden-categories">
            @foreach($sach->theLoais as $tl)
                <input type="hidden" name="theLoais[]" value="{{ $tl->id }}">
            @endforeach
        </div>

        {{-- NHÀ XUẤT BẢN --}}
        <div class="mb-3">
            <label class="fw-semibold">Nhà xuất bản</label>
            <select name="MaNXB" class="form-select">
                <option value="">-- Chọn --</option>
                @foreach($nhaXuatBans as $nxb)
                    <option value="{{ $nxb->ID }}"
                        {{ old('MaNXB', $sach->MaNXB) == $nxb->ID ? 'selected' : '' }}>
                        {{ $nxb->TenNXB }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- MÃ VỊ TRÍ --}}
        <div class="mb-3">
            <label class="fw-semibold">Mã vị trí</label>
            <input type="text" name="MaVT" class="form-control"
                   value="{{ old('MaVT', $sach->MaVT) }}" required>
        </div>

        {{-- SỐ LƯỢNG --}}
        <div class="mb-3">
            <label class="fw-semibold d-block mb-2">Số lượng</label>
            <div class="d-flex gap-2">
                @for($i=0; $i<=3; $i++)
                    <input type="radio"
                           class="btn-check"
                           name="SoLuong"
                           id="qty{{ $i }}"
                           value="{{ $i }}"
                           {{ old('SoLuong', $sach->SoLuong) == $i ? 'checked' : '' }}>
                    <label class="btn btn-outline-{{ $i==0?'secondary':'primary' }} flex-fill"
                           for="qty{{ $i }}">
                        {{ $i==0?'Không':$i }}
                    </label>
                @endfor
            </div>
        </div>

        {{-- TRẠNG THÁI --}}
        <div class="mb-3">
            <label class="fw-semibold d-block mb-2">Trạng thái</label>
            <div class="d-flex gap-2">
                <input type="radio" class="btn-check" name="TrangThai" id="statusCon"
                       value="Con" {{ old('TrangThai', $sach->TrangThai)=='Con'?'checked':'' }}>
                <label class="btn btn-outline-success flex-fill" for="statusCon">Còn</label>

                <input type="radio" class="btn-check" name="TrangThai" id="statusHet"
                       value="Het" {{ old('TrangThai', $sach->TrangThai)=='Het'?'checked':'' }}>
                <label class="btn btn-outline-danger flex-fill" for="statusHet">Hết</label>

                <input type="radio" class="btn-check" name="TrangThai" id="statusThuThu"
                       value="ThuThuDangXuLy"
                       {{ old('TrangThai', $sach->TrangThai)=='ThuThuDangXuLy'?'checked':'' }}>
                <label class="btn btn-outline-primary flex-fill" for="statusThuThu">
                    Thủ thư đang xử lý
                </label>
            </div>
        </div>

        {{-- SUBMIT --}}
        <button type="submit" class="btn btn-success">💾 Cập nhật</button>
        <a href="{{ route('sach.index') }}" class="btn btn-secondary">Hủy</a>

    </form>
</div>

{{-- ===== MODAL & SCRIPT (GIỮ NGUYÊN – ĐÃ FIX TICK) ===== --}}
@include('sach.modals.summary')

@include('sach.modals.authors', [
    'tacGias' => $tacGias,
    'selectedTacGiaIds' => $sach->tacGias->pluck('MaTG')->toArray()
])

@include('sach.modals.categories', [
    'theLoais' => $theLoais,
    'selectedTheLoaiIds' => $sach->theLoais->pluck('id')->toArray()
])

@include('sach.scripts.form')

@endsection
