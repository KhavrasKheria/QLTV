@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- TIÊU ĐỀ --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <i class="bi bi-file-text"></i> Chi tiết phiếu mượn #{{ $phieuMuon->MaMuon }}
        </h4>
        <div>
            <a href="{{ route('muontra.lichsu') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    {{-- THÔNG BÁO --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        {{-- THÔNG TIN PHIẾU MƯỢN --}}
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="bi bi-info-circle"></i> Thông tin phiếu mượn
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="fw-semibold" width="150">Mã phiếu:</td>
                            <td><span class="badge bg-primary">{{ $phieuMuon->MaMuon }}</span></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Trạng thái:</td>
                            <td>
                                @if($phieuMuon->TrangThai == 'DangMuon')
                                <span class="badge bg-warning text-dark">Đang mượn</span>
                                @else
                                <span class="badge bg-success">Đã trả</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Ngày mượn:</td>
                            <td>{{ \Carbon\Carbon::parse($phieuMuon->NgayMuon)->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Hạn trả:</td>
                            <td>
                                @php
                                    $hanTra = \Carbon\Carbon::parse($phieuMuon->HanTra);
                                    $now = \Carbon\Carbon::now();
                                    $isQuaHan = $phieuMuon->TrangThai == 'DangMuon' && $hanTra->lt($now);
                                @endphp
                                <span class="{{ $isQuaHan ? 'text-danger fw-bold' : '' }}">
                                    {{ $hanTra->format('d/m/Y') }}
                                </span>
                                @if($isQuaHan)
                                <span class="badge bg-danger ms-2">Quá hạn {{ $now->diffInDays($hanTra) }} ngày</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Ngày trả:</td>
                            <td>
                                @if($phieuMuon->NgayTra)
                                {{ \Carbon\Carbon::parse($phieuMuon->NgayTra)->format('d/m/Y H:i') }}
                                @else
                                <span class="text-muted">Chưa trả</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Thủ thư:</td>
                            <td>{{ $phieuMuon->user->name ?? '---' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- THÔNG TIN ĐỘC GIẢ --}}
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-person"></i> Thông tin độc giả
                </div>
                <div class="card-body">
                    @if($phieuMuon->docGia)
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="fw-semibold" width="150">Mã độc giả:</td>
                            <td>{{ $phieuMuon->docGia->MaDocGia }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Họ tên:</td>
                            <td>{{ $phieuMuon->docGia->TenDocGia }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Khoa:</td>
                            <td>{{ $phieuMuon->docGia->Khoa ?? '---' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Lớp:</td>
                            <td>{{ $phieuMuon->docGia->Lop ?? '---' }}</td>
                        </tr>
                    </table>
                    @else
                    <p class="text-muted">Không có thông tin độc giả</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- DANH SÁCH SÁCH --}}
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-book"></i> Danh sách sách mượn</span>
            <span class="badge bg-light text-dark">{{ $phieuMuon->chiTiet->count() }} cuốn</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50" class="text-center">#</th>
                            <th width="100" class="text-center">Hình ảnh</th>
                            <th width="150">ISBN13</th>
                            <th>Tên sách</th>
                            <th width="120" class="text-center">Vị trí</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($phieuMuon->chiTiet as $i => $ct)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="text-center">
                                @if($ct->sach && $ct->sach->Anh)
                                    @php
                                        $anhPath = str_starts_with($ct->sach->Anh, 'http') 
                                            ? $ct->sach->Anh 
                                            : asset($ct->sach->Anh);
                                    @endphp
                                    <img src="{{ $anhPath }}" 
                                        alt="{{ $ct->sach->TenSach }}"
                                        class="img-thumbnail"
                                        style="width: 60px; height: 80px; object-fit: cover;"
                                        onerror="this.onerror=null; this.src='{{ asset('img_book/default.jpg') }}';">
                                @else
                                    <img src="{{ asset('img_book/default.jpg') }}" 
                                        alt="Ảnh mặc định"
                                        class="img-thumbnail"
                                        style="width: 60px; height: 80px; object-fit: cover;">
                                @endif
                            </td>
                            <td><code>{{ $ct->ISBN13 }}</code></td>
                            <td>
                                @if($ct->sach)
                                <div class="fw-semibold">{{ $ct->sach->TenSach }}</div>
                                @else
                                <span class="text-muted">Không tìm thấy sách</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($ct->sach && $ct->sach->MaVT)
                                <span class="badge bg-secondary">{{ $ct->sach->MaVT }}</span>
                                @else
                                <span class="text-muted">---</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Không có sách trong phiếu mượn</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- THAO TÁC --}}
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    @if($phieuMuon->TrangThai == 'DangMuon')
                    <button type="button" 
                        class="btn btn-warning"
                        data-bs-toggle="modal" 
                        data-bs-target="#modalGiaHan">
                        <i class="bi bi-calendar-plus"></i> Gia hạn phiếu mượn
                    </button>
                    @endif
                </div>
                
                <div>
                    @if($phieuMuon->TrangThai == 'DangMuon')
                    <form method="POST" 
                        action="{{ route('muontra.tra', $phieuMuon->MaMuon) }}"
                        class="d-inline"
                        onsubmit="return confirm('Xác nhận trả toàn bộ {{ $phieuMuon->chiTiet->count() }} cuốn sách trong phiếu này?')">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-arrow-return-left"></i> Trả toàn bộ sách
                        </button>
                    </form>
                    @else
                    <button class="btn btn-secondary" disabled>
                        <i class="bi bi-check-circle"></i> Đã trả sách
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

{{-- MODAL GIA HẠN --}}
<div class="modal fade" id="modalGiaHan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">
                    <i class="bi bi-calendar-plus"></i> Gia hạn phiếu mượn
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('muontra.gia-han', $phieuMuon->MaMuon) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hạn trả hiện tại:</label>
                        <input type="text" 
                            class="form-control" 
                            value="{{ \Carbon\Carbon::parse($phieuMuon->HanTra)->format('d/m/Y') }}" 
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hạn trả mới: <span class="text-danger">*</span></label>
                        <input type="date" 
                            name="HanTraMoi" 
                            class="form-control"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i> Xác nhận gia hạn
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection