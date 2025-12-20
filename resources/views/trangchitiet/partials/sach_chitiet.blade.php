<div class="book-detail-container">
    <div class="book-detail">
        <!-- Ảnh sách -->
        <div class="book-image">
            <img src="{{ $sach->Anh ? asset($sach->Anh) : asset('img_book/default.jpg') }}"
                alt="{{ $sach->TenSach }}">
        </div>

        <!-- Thông tin sách -->
        <div class="book-info">
            <h1 class="book-title">{{ $sach->TenSach }}</h1>

            <!-- Tác giả -->
            <p><strong>Tác giả</strong>
                @php $tacGias = collect($tacGias); @endphp
                @if($tacGias->isNotEmpty())
                : {{ $tacGias->join(', ') }}
                @else
                : Không rõ
                @endif
            </p>

            <p><strong>Người dịch:</strong> {{ $sach->NguoiDich ?? 'Không có' }}</p>

            <!-- Nhà xuất bản -->
            <p><strong>Nhà xuất bản:</strong>
                {{ $sach->nhaXuatBan->TenNXB ?? 'Không rõ' }}
            </p>
            <p><strong>Mã vị trí:</strong> {{ $sach->MaVT ?? 'Không rõ' }}</p>
            <!-- Thể loại -->
            <p><strong>Thể loại:</strong>
                @php $theLoais = collect($theLoais); @endphp
                @if($theLoais->isNotEmpty())
                {{ $theLoais->join(', ') }}
                @else
                Không rõ
                @endif
            </p>

            <p><strong>Số trang:</strong> {{ $sach->SoTrang ?? 'Không rõ' }}</p>
            <p><strong>Năm xuất bản:</strong> {{ $sach->NamXuatBang ?? 'Không rõ' }}</p>
            <p><strong>Số lượng:</strong> {{ $sach->SoLuong ?? 'Không rõ' }}</p>

            <!-- TRẠNG THÁI ENUM -->
            @php
            $status = $sach->TrangThai;

            $statusIcon = [
            'Con' => '✅',
            'Het' => '❌',
            'ThuThuDangXuLy' => '⏳'
            ];

            $statusText = [
            'Con' => 'Có thể mượn',
            'Het' => 'Đã hết',
            'ThuThuDangXuLy' => 'Thủ thư đang xử lý'
            ];

            $statusClass = [
            'Con' => 'status-available',
            'Het' => 'status-out',
            'ThuThuDangXuLy' => 'status-processing'
            ];
            @endphp

            <div class="status-row">
                <strong>Trạng thái:</strong>

                <div class="status-box {{ $statusClass[$status] ?? '' }}">
                    {{ $statusIcon[$status] ?? '' }} {{ $statusText[$status] ?? 'Không rõ' }}
                </div>
            </div>





            <!-- KHUNG TÓM TẮT -->

            <div class="summary-box">
                <div class="summary-title">Tóm tắt</div>

                <div class="book-summary" id="summary">
                    <p>{{ $sach->TomTat ?? 'Không có' }}</p>
                </div>

                <button class="toggle-btn" id="toggleBtn">Xem thêm</button>
            </div>

        </div>
    </div>
</div>

<style>
    .book-info p {
        margin: 14px 0;
        font-size: 16px;
    }

    .status-row,
    .status-box {
        margin-top: 40px;
    }


    .status-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 8px 0;
    }

    .book-detail-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
    }

    .book-detail {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .book-image {
        flex: 1 1 300px;
        max-width: 350px;
    }

    .book-image img {
        width: 100%;
        border-radius: 8px;
    }

    .book-info {
        flex: 2 1 500px;
    }

    .book-title {
        font-size: 28px;
        margin-bottom: 15px;
    }

    .book-info p {
        margin: 8px 0;
        font-size: 16px;
    }

    /* TRẠNG THÁI */
    .status-box {
        padding: 8px 14px;
        border-radius: 6px;
        font-weight: bold;
        width: fit-content;
        margin: 10px 0;
        font-size: 15px;
    }

    .status-available {
        background: #d4f8d4;
        color: #1b7a1b;
        border: 1px solid #1b7a1b;
    }

    .status-out {
        background: #ffe0e0;
        color: #b30000;
        border: 1px solid #b30000;
    }

    .status-processing {
        background: #fff7cc;
        color: #b38f00;
        border: 1px solid #b38f00;
    }

    /* KHUNG TÓM TẮT */
    .summary-box {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        background: #fafafa;
        margin-top: 20px;
        text-align: center;
    }

    .summary-title {
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 10px;
    }

    .book-summary {
        line-height: 1.6;
        font-size: 15px;
        color: #555;
        max-height: 120px;
        overflow: hidden;
        position: relative;
        text-align: justify;
    }

    .book-summary::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 40px;
        background: linear-gradient(to bottom, transparent, #fafafa);
    }

    .book-summary.expanded {
        max-height: none;
    }

    .book-summary.expanded::after {
        display: none;
    }

    .toggle-btn {
        margin-top: 10px;
        background: #007bff;
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 5px;
        cursor: pointer;
        margin-left: auto;
        margin-right: auto;
    }

    .toggle-btn:hover {
        background: #0056b3;
    }

    @media (max-width: 768px) {
        .book-detail {
            flex-direction: column;
            align-items: center;
        }

        .book-info {
            text-align: center;
        }
    }
</style>

<script>
    const summary = document.getElementById('summary');
    const btn = document.getElementById('toggleBtn');

    btn.addEventListener('click', () => {
        summary.classList.toggle('expanded');
        btn.textContent = summary.classList.contains('expanded') ?
            'Thu gọn' :
            'Xem thêm';
    });
</script>