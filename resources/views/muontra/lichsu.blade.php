@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- TIÊU ĐỀ --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <i class="bi bi-clock-history"></i> Lịch sử mượn – trả sách
        </h4>
        <a href="{{ route('muontra.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-plus-circle"></i> Mượn sách mới
        </a>
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

    {{-- BỘ LỌC --}}
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-3">
            <select name="trangthai" class="form-select">
                <option value="">-- Tất cả trạng thái --</option>
                <option value="DangMuon" {{ request('trangthai')=='DangMuon'?'selected':'' }}>
                    Đang mượn
                </option>
                <option value="DaTra" {{ request('trangthai')=='DaTra'?'selected':'' }}>
                    Đã trả
                </option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="sapxep" class="form-select">
                <option value="desc" {{ request('sapxep','desc')=='desc'?'selected':'' }}>
                    Ngày mượn ↓ mới nhất
                </option>
                <option value="asc" {{ request('sapxep')=='asc'?'selected':'' }}>
                    Ngày mượn ↑ cũ nhất
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-funnel"></i> Lọc
            </button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('muontra.lichsu') }}" class="btn btn-secondary w-100">
                <i class="bi bi-arrow-clockwise"></i> Đặt lại
            </a>
        </div>
    </form>

    {{-- BẢNG DANH SÁCH --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th width="50">#</th>
                        <th>Mã phiếu</th>
                        <th>Độc giả</th>
                        <th>Số sách</th>
                        <th>Ngày mượn</th>
                        <th>Hạn trả</th>
                        <th>Ngày trả</th>
                        <th>Thủ thư</th>
                        <th>Trạng thái</th>
                        <th width="200">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($muonTras as $i => $mt)
                    <tr class="{{ $mt->TrangThai=='DaTra' ? 'table-secondary' : '' }}">
                        <td class="text-center">{{ $i+1 }}</td>

                        <td class="text-center">
                            <strong>{{ $mt->MaMuon }}</strong>
                        </td>

                        <td>
                            <div class="fw-semibold">{{ $mt->docGia->TenDocGia ?? '---' }}</div>
                            <small class="text-muted">{{ $mt->MaDocGia }}</small>
                        </td>

                        <td class="text-center">
                            <span class="badge bg-info">{{ $mt->chiTiet->count() }} cuốn</span>
                        </td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($mt->NgayMuon)->format('d/m/Y H:i') }}
                        </td>

                        <td class="text-center">
                            @php
                                $hanTra = \Carbon\Carbon::parse($mt->HanTra);
                                $now = \Carbon\Carbon::now();
                                $isQuaHan = $mt->TrangThai == 'DangMuon' && $hanTra->lt($now);
                            @endphp
                            <span class="{{ $isQuaHan ? 'text-danger fw-bold' : '' }}">
                                {{ $hanTra->format('d/m/Y') }}
                            </span>
                            @if($isQuaHan)
                            <br><small class="badge bg-danger">Quá hạn</small>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($mt->NgayTra)
                            {{ \Carbon\Carbon::parse($mt->NgayTra)->format('d/m/Y H:i') }}
                            @else
                            <span class="text-muted">Chưa trả</span>
                            @endif
                        </td>

                        <td>{{ $mt->user->name ?? '---' }}</td>

                        <td class="text-center">
                            @if($mt->TrangThai=='DaTra')
                            <span class="badge bg-success">Đã trả</span>
                            @else
                            <span class="badge bg-warning text-dark">Đang mượn</span>
                            @endif
                        </td>

                        {{-- THAO TÁC --}}
                        <td class="text-center">
                            <a href="{{ route('muontra.chi-tiet', $mt->MaMuon) }}"
                                class="btn btn-sm btn-info"
                                title="Xem chi tiết">
                                <i class="bi bi-eye"></i> Chi tiết
                            </a>

                            @if($mt->TrangThai=='DangMuon')
                            <form method="POST"
                                action="{{ route('muontra.tra', $mt->MaMuon) }}"
                                class="d-inline"
                                onsubmit="return confirm('Xác nhận trả toàn bộ sách trong phiếu này?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" title="Trả sách">
                                    <i class="bi bi-arrow-return-left"></i> Trả sách
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Không có dữ liệu
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- THỐNG KÊ NHANH --}}
    @if($muonTras->count() > 0)
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Tổng phiếu</h5>
                    <h2>{{ $muonTras->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Đang mượn</h5>
                    <h2>{{ $muonTras->where('TrangThai', 'DangMuon')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Đã trả</h5>
                    <h2>{{ $muonTras->where('TrangThai', 'DaTra')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Quá hạn</h5>
                    <h2>
                        {{ $muonTras->where('TrangThai', 'DangMuon')
                            ->filter(fn($mt) => \Carbon\Carbon::parse($mt->HanTra)->lt(\Carbon\Carbon::now()))
                            ->count() }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection