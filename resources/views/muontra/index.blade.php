@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- TIÊU ĐỀ --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <i class="bi bi-arrow-left-right"></i> Quản lý mượn sách
        </h4>
        <a href="{{ route('muontra.lichsu') }}" class="btn btn-outline-primary">
            <i class="bi bi-clock-history"></i> Lịch sử mượn trả
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

    {{-- THÔNG BÁO ĐỘNG (JavaScript) --}}
    <div id="thongBaoDong" class="alert alert-dismissible fade" role="alert" style="display: none;">
        <span id="thongBaoDongNoidung"></span>
        <button type="button" class="btn-close" onclick="dongThongBao()"></button>
    </div>

    {{-- FORM MƯỢN SÁCH --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-bookmark-plus"></i> Mượn sách
        </div>

        <div class="card-body">
            <form action="{{ route('muontra.store') }}" method="POST" id="formMuonSach">
                @csrf

                <div class="row g-3">

                    {{-- MÃ SINH VIÊN --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Mã sinh viên</label>
                        <div class="input-group">
                            <input type="text"
                                id="maDocGiaInput"
                                name="MaDocGia"
                                class="form-control @error('MaDocGia') is-invalid @enderror"
                                list="danhSachDocGia"
                                placeholder="Quét mã độc giả"
                                value="{{ old('MaDocGia') }}"
                                style="height: 38px;"
                                required>

                            <button type="button"
                                class="btn btn-outline-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalScanQR"
                                title="Quét mã QR"
                                style="height: 38px;">
                                <i class="bi bi-qr-code-scan"></i>
                            </button>
                        </div>

                        <datalist id="danhSachDocGia">
                            @foreach($docGias as $dg)
                            <option value="{{ $dg->MaDocGia }}"
                                data-ten="{{ $dg->TenDocGia }}"
                                data-khoa="{{ $dg->Khoa }}"
                                data-lop="{{ $dg->Lop }}">
                            </option>
                            @endforeach
                        </datalist>

                        @error('MaDocGia')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- MÃ SÁCH --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Mã sách <span class="text-danger">(tối đa 3 cuốn)</span>
                        </label>

                        <div class="input-group">
                            <input type="text"
                                id="ISBN13Input"
                                class="form-control"
                                list="danhSachSach"
                                placeholder="Quét mã vạch sách"
                                style="height: 38px;">

                            
                        </div>

                        <div id="danhSachSachDaQuet" class="mt-2"></div>
                        <div id="isbnHiddenContainer"></div>

                        <datalist id="danhSachSach">
                            @foreach($sachs as $sach)
                            <option value="{{ $sach->ISBN13 }}"
                                data-ten="{{ $sach->TenSach }}"
                                data-soluong="{{ $sach->SoLuong }}"
                                data-vitri="{{ $sach->MaVT ?? 'Chưa cập nhật' }}">
                            </option>
                            @endforeach
                        </datalist>
                    </div>

                    {{-- HẠN TRẢ --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Hạn trả</label>
                        <input type="date"
                            name="HanTra"
                            class="form-control @error('HanTra') is-invalid @enderror"
                            value="{{ old('HanTra', $hanTraMacDinh) }}"
                            min="{{ date('Y-m-d') }}">

                        @error('HanTra')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- THÔNG TIN ĐỘC GIẢ --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Thông tin độc giả</label>
                        <div id="thongTinDocGia"
                            class="border rounded p-3 bg-light text-muted">
                            Chưa chọn độc giả
                        </div>
                    </div>

                    {{-- THÔNG TIN SÁCH --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Danh sách sách đã quét</label>
                        <div id="thongTinSach"
                            class="border rounded p-3 bg-light text-muted">
                            Chưa quét sách
                        </div>
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button type="submit"
                        id="btnMuon"
                        class="btn btn-success"
                        disabled>
                        <i class="bi bi-check-circle"></i> Xác nhận mượn
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

{{-- MODAL SCAN QR (ĐỘC GIẢ) --}}
@include('thedocgia.modal.scan-qr')

{{-- MODAL CAMERA (SÁCH) --}}
@include('muontra.modal.camera')

{{-- SCRIPT XỬ LÝ --}}
<script>
    const MAX_SACH = 3;
    let danhSachISBN = [];

    const maDocGiaInput = document.getElementById('maDocGiaInput');
    const isbnInput = document.getElementById('ISBN13Input');
    const thongTinDocGiaDiv = document.getElementById('thongTinDocGia');
    const thongTinSachDiv = document.getElementById('thongTinSach');
    const btnMuon = document.getElementById('btnMuon');

    // HÀM HIỂN THỊ THÔNG BÁO
    function hienThiThongBao(noiDung, loai = 'warning') {
        const thongBao = document.getElementById('thongBaoDong');
        const noiDungDiv = document.getElementById('thongBaoDongNoidung');
        
        // Xóa các class cũ
        thongBao.classList.remove('alert-warning', 'alert-danger', 'alert-info');
        
        // Thêm class mới
        thongBao.classList.add('alert-' + loai);
        
        // Thêm icon tương ứng
        let icon = '';
        switch(loai) {
            case 'warning':
                icon = '<i class="bi bi-exclamation-triangle-fill"></i> ';
                break;
            case 'danger':
                icon = '<i class="bi bi-x-circle-fill"></i> ';
                break;
            case 'info':
                icon = '<i class="bi bi-info-circle-fill"></i> ';
                break;
        }
        
        noiDungDiv.innerHTML = icon + noiDung;
        thongBao.style.display = 'block';
        thongBao.classList.add('show');
        
        // Tự động ẩn sau 5 giây
        setTimeout(() => {
            dongThongBao();
        }, 5000);
    }

    function dongThongBao() {
        const thongBao = document.getElementById('thongBaoDong');
        thongBao.classList.remove('show');
        setTimeout(() => {
            thongBao.style.display = 'none';
        }, 150);
    }

    // XỬ LÝ ĐỘC GIẢ
    maDocGiaInput.addEventListener('input', function() {
        updateThongTinDocGia(this.value);
    });

    function updateThongTinDocGia(maDocGia) {
        const options = document.querySelectorAll('#danhSachDocGia option');
        let found = false;

        options.forEach(option => {
            if (option.value === maDocGia) {
                thongTinDocGiaDiv.innerHTML = `
                    <div class="fw-semibold mb-1">${option.dataset.ten}</div>
                    <div>Khoa: <strong>${option.dataset.khoa}</strong></div>
                    <div>Lớp: <strong>${option.dataset.lop}</strong></div>
                `;
                found = true;
            }
        });

        if (!found) {
            thongTinDocGiaDiv.innerHTML = '<span class="text-muted">Không tìm thấy độc giả</span>';
        }

        capNhatNutMuon();
    }

    // XỬ LÝ SÁCH
    ['input', 'change'].forEach(eventName => {
        isbnInput.addEventListener(eventName, function() {
            const isbn = this.value.trim();
            if (!isbn) return;

            themSach(isbn);
            this.value = '';
        });
    });

    function themSach(isbn) {
        // Kiểm tra trùng
        if (danhSachISBN.includes(isbn)) {
            hienThiThongBao('Sách này đã được quét!', 'warning');
            return;
        }

        // Kiểm tra tối đa 3 cuốn
        if (danhSachISBN.length >= MAX_SACH) {
            hienThiThongBao('Chỉ được mượn tối đa 3 cuốn sách!', 'danger');
            return;
        }

        // Tìm thông tin sách
        const option = [...document.querySelectorAll('#danhSachSach option')]
            .find(o => o.value === isbn);

        if (!option) {
            hienThiThongBao('Không tìm thấy sách với mã: ' + isbn, 'danger');
            return;
        }

        const soLuong = parseInt(option.dataset.soluong);
        if (soLuong <= 0) {
            hienThiThongBao('Sách "' + option.dataset.ten + '" đã hết!', 'danger');
            return;
        }

        // Thêm vào danh sách
        danhSachISBN.push(isbn);
        renderDanhSachSach();
    }

    function renderDanhSachSach() {
        thongTinSachDiv.innerHTML = '';
        thongTinSachDiv.classList.remove('text-muted');

        // Xóa hidden inputs cũ
        document.querySelectorAll('.isbn-hidden').forEach(e => e.remove());

        if (danhSachISBN.length === 0) {
            thongTinSachDiv.innerHTML = '<span class="text-muted">Chưa quét sách</span>';
            thongTinSachDiv.classList.add('text-muted');
            capNhatNutMuon();
            return;
        }

        danhSachISBN.forEach((isbn, index) => {
            const option = [...document.querySelectorAll('#danhSachSach option')]
                .find(o => o.value === isbn);

            const item = document.createElement('div');
            item.className = 'border rounded p-2 mb-2 d-flex justify-content-between align-items-center bg-white';

            item.innerHTML = `
                <div>
                    <div class="fw-semibold">${option.dataset.ten}</div>
                    <div><small>ISBN: ${isbn}</small></div>
                    <div><small>Số lượng: ${option.dataset.soluong} | Vị trí: ${option.dataset.vitri}</small></div>
                </div>
                <button type="button" class="btn btn-sm btn-danger">
                    <i class="bi bi-x"></i>
                </button>
            `;

            item.querySelector('button').onclick = () => {
                danhSachISBN.splice(index, 1);
                renderDanhSachSach();
            };

            thongTinSachDiv.appendChild(item);

            // Thêm hidden input
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ISBN13s[]';
            input.value = isbn;
            input.classList.add('isbn-hidden');
            document.getElementById('formMuonSach').appendChild(input);
        });

        capNhatNutMuon();
    }

    function capNhatNutMuon() {
        const coDocGia = maDocGiaInput.value.trim() !== '';
        const coSach = danhSachISBN.length > 0;

        btnMuon.disabled = !(coDocGia && coSach);
    }

    // Xử lý khi modal QR trả về mã độc giả
    window.addEventListener('docGiaSelected', function(e) {
        maDocGiaInput.value = e.detail.maDocGia;
        updateThongTinDocGia(e.detail.maDocGia);
    });

    // Xử lý khi modal camera trả về mã sách
    window.addEventListener('sachScanned', function(e) {
        themSach(e.detail.isbn);
    });
</script>
@endsection