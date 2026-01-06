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
            <p><strong>Tác giả:</strong>
                @php $tacGias = collect($tacGias); @endphp
                @if($tacGias->isNotEmpty())
                {{ $tacGias->join(', ') }}
                @else
                Không rõ
                @endif
            </p>

            <p><strong>Người dịch:</strong> {{ $sach->NguoiDich ?? 'Không có' }}</p>

            <!-- Nhà xuất bản -->
            <p><strong>Nhà xuất bản:</strong>
                {{ $sach->nhaXuatBan->TenNXB ?? 'Không rõ' }}
            </p>

            <!-- MÃ VỊ TRÍ - CÓ THỂ CLICK -->
            <p class="status-row">
                <strong>Mã vị trí:</strong>

                @if($sach->MaVT)
                <span class="status-box status-location"
                    style="cursor: pointer;"
                    onclick="openLocationMap('{{ $sach->MaVT }}')">
                    📍 {{ $sach->MaVT }}
                </span>
                @else
                <span class="status-box status-unknown">
                    Không rõ
                </span>
                @endif
            </p>

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

            <p class="status-row">
                <strong>Trạng thái:</strong>

                <span class="status-box {{ $statusClass[$status] ?? '' }}">
                    {{ $statusIcon[$status] ?? '' }} {{ $statusText[$status] ?? 'Không rõ' }}
                </span>
            </p>

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

{{-- MODAL BẢN ĐỒ VỊ TRÍ --}}
<div class="location-modal" id="locationModal">
    <div class="location-modal-content">
        <div class="location-modal-header">
            <h3>🗺️ Vị Trí Sách Trên Bản Đồ</h3>
            <button class="close-btn" onclick="closeLocationMap()">✕</button>
        </div>

        <div class="location-modal-body">
            <div class="location-info-box" id="locationInfo">
                <!-- Thông tin vị trí sẽ được hiển thị ở đây -->
            </div>

            <div class="library-map-mini">
                <div class="map-container-mini">
                    <div class="horizontal-layout-mini">

                        {{-- HÀNG TRÊN --}}
                        <div class="top-row-mini">
                            {{-- WC --}}
                            <div class="wc-box-mini">
                                <span class="wc-icon-mini">🚻</span>
                                <div>WC</div>
                            </div>

                            {{-- KHU A --}}
                            <div class="khu-section-mini">
                                <div class="khu-title-mini">📚 KHU A</div>
                                @for($day = 1; $day <= 3; $day++)
                                    <div class="day-container-mini">
                                    <div class="day-label-mini">Dãy {{ $day }}</div>
                                    <div class="shelf-row-mini">
                                        @for($ke = 1; $ke <= 3; $ke++)
                                            @php
                                            $maVT='A' . $day . $ke;
                                            $hasBooks=\App\Models\Sach::where('MaVT', $maVT)->exists();
                                            @endphp
                                            <div class="shelf-mini {{ $hasBooks ? 'has-books' : '' }}"
                                                data-mavt="{{ $maVT }}">
                                                <div class="shelf-code-mini">{{ $maVT }}</div>
                                            </div>
                                            @endfor
                                    </div>
                            </div>
                            @endfor
                        </div>

                        {{-- BÀN ĐỌC --}}
                        <div class="reading-area-mini">
                            <div class="reading-title-mini">🪑 ĐỌC SÁCH</div>
                            <div class="tables-grid-mini">
                                @for($i = 1; $i <= 12; $i++)
                                    <div class="reading-table-mini">{{ $i }}</div>
                            @endfor
                        </div>
                    </div>

                    {{-- KHU B --}}
                    <div class="khu-section-mini">
                        <div class="khu-title-mini">📚 KHU B</div>
                        @for($day = 1; $day <= 3; $day++)
                            <div class="day-container-mini">
                            <div class="day-label-mini">Dãy {{ $day }}</div>
                            <div class="shelf-row-mini">
                                @for($ke = 1; $ke <= 3; $ke++)
                                    @php
                                    $maVT='B' . $day . $ke;
                                    $hasBooks=\App\Models\Sach::where('MaVT', $maVT)->exists();
                                    @endphp
                                    <div class="shelf-mini {{ $hasBooks ? 'has-books' : '' }}"
                                        data-mavt="{{ $maVT }}">
                                        <div class="shelf-code-mini">{{ $maVT }}</div>
                                    </div>
                                    @endfor
                            </div>
                    </div>
                    @endfor
                </div>
            </div>

            {{-- HÀNG DƯỚI --}}
            <div class="bottom-row-mini">
                <div class="entrance-box-mini">
                    <span>⬆️</span>
                    <div>LỐI VÀO</div>
                </div>
                <div class="librarian-desk-mini">
                    <span>👨‍💼</span>
                    <div>BÀN THỦ THƯ</div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="legend-mini">
    <div class="legend-item-mini">
        <div class="legend-color-mini has-books"></div>
        <span>Có sách</span>
    </div>
    <div class="legend-item-mini">
        <div class="legend-color-mini active"></div>
        <span>Vị trí này</span>
    </div>
    <div class="legend-item-mini">
        <div class="legend-color-mini empty"></div>
        <span>Trống</span>
    </div>
</div>
</div>
</div>
</div>

<style>
    /* Style cho mã vị trí */
    .status-location {
        background: #cfe2ff;
        color: #084298;
        border: 1px solid #084298;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .status-location:hover {
        background: #b6d4fe;
        color: #052c65;
        border-color: #052c65;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(8, 66, 152, 0.2);
    }

    .status-location:active {
        transform: translateY(0);
    }

    /* Style cho trường hợp không rõ */
    .status-unknown {
        background: #e9ecef;
        color: #6c757d;
        border: 1px solid #dee2e6;
        display: inline-block;
    }

    .book-info p {
        margin: 14px 0;
        font-size: 16px;
    }

    .status-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 14px 0;
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

    /* TRẠNG THÁI */
    .status-box {
        padding: 8px 14px;
        border-radius: 6px;
        font-weight: bold;
        width: fit-content;
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

    /* =============== MODAL BẢN ĐỒ =============== */
    .location-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        animation: fadeIn 0.3s ease;
        align-items: center;
        justify-content: center;
    }

    .location-modal.show {
        display: flex;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .location-modal-content {

        background: white;
        border-radius: 16px;
        width: 100%;
        overflow-y: auto;
        box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .location-modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 30px;
        border-radius: 16px 16px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .location-modal-header h3 {
        margin: 0;
        font-size: 24px;
    }

    .close-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid white;
        color: white;
        font-size: 28px;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-weight: bold;
        line-height: 1;
    }

    .close-btn:hover {
        background: white;
        color: #667eea;
        transform: rotate(90deg);
    }

    .location-modal-body {
        padding: 30px;
    }

    .location-info-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    /* BẢN ĐỒ THƯ VIỆN MINI */
    .library-map-mini {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .map-container-mini {
        background: white;
        border-radius: 12px;
        padding: 20px;
        overflow-x: auto;
    }

    .horizontal-layout-mini {
        display: flex;
        flex-direction: column;
        gap: 30px;
        min-width: 800px;
    }

    .top-row-mini {
        display: grid;
        grid-template-columns: 100px 1fr 1fr 1fr;
        gap: 20px;
        align-items: start;
    }

    .wc-box-mini {
        background: linear-gradient(145deg, #6c757d, #5a6268);
        color: white;
        padding: 15px 10px;
        border-radius: 8px;
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .wc-icon-mini {
        font-size: 28px;
        display: block;
        margin-bottom: 5px;
    }

    .khu-section-mini {
        background: #fff;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
    }

    .khu-title-mini {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        text-align: center;
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .day-container-mini {
        margin-bottom: 10px;
    }

    .day-label-mini {
        font-weight: 600;
        font-size: 12px;
        margin-bottom: 6px;
        color: #495057;
    }

    .day-label-mini::before {
        content: "📂 ";
    }

    .shelf-row-mini {
        display: flex;
        gap: 8px;
    }

    .shelf-mini {
        background: linear-gradient(145deg, #ffffff, #f0f0f0);
        border: 2px solid #dee2e6;
        border-radius: 6px;
        padding: 10px 8px;
        flex: 1;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .shelf-mini.has-books {
        background: linear-gradient(145deg, #d4edda, #c3e6cb);
        border-color: #28a745;
    }

    .shelf-mini.has-books::after {
        content: "📚";
        position: absolute;
        top: 3px;
        right: 3px;
        font-size: 10px;
    }

    .shelf-mini.active {
        background: linear-gradient(145deg, #ffc107, #ffb300);
        border-color: #ff9800;
        font-weight: bold;
        box-shadow: 0 4px 20px rgba(255, 193, 7, 0.6);
        animation: pulse-mini 1.5s infinite;
    }

    .shelf-mini.active::after {
        content: "📍";
    }

    @keyframes pulse-mini {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    .shelf-code-mini {
        font-weight: bold;
        font-size: 13px;
        color: #212529;
    }

    .shelf-mini.active .shelf-code-mini {
        color: #000;
    }

    .reading-area-mini {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        border-radius: 8px;
        padding: 15px;
        text-align: center;
    }

    .reading-title-mini {
        font-weight: bold;
        color: #155724;
        font-size: 13px;
        margin-bottom: 10px;
    }

    .tables-grid-mini {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 6px;
    }

    .reading-table-mini {
        background: white;
        border: 2px solid #28a745;
        border-radius: 4px;
        padding: 8px 4px;
        font-size: 11px;
        font-weight: 600;
        color: #155724;
    }

    .bottom-row-mini {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        padding-top: 20px;
        border-top: 2px dashed #dee2e6;
    }

    .entrance-box-mini {
        background: linear-gradient(145deg, #28a745, #20c997);
        color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        font-weight: bold;
        font-size: 14px;
    }

    .entrance-box-mini span {
        font-size: 36px;
        display: block;
        margin-bottom: 8px;
    }

    .librarian-desk-mini {
        background: linear-gradient(145deg, #0d6efd, #0b5ed7);
        color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        font-weight: bold;
        font-size: 14px;
    }

    .librarian-desk-mini span {
        font-size: 36px;
        display: block;
        margin-bottom: 8px;
    }

    /* CHÚ THÍCH MINI */
    .legend-mini {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .legend-item-mini {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .legend-color-mini {
        width: 30px;
        height: 30px;
        border-radius: 6px;
        border: 2px solid;
    }

    .legend-color-mini.has-books {
        background: linear-gradient(145deg, #d4edda, #c3e6cb);
        border-color: #28a745;
    }

    .legend-color-mini.active {
        background: linear-gradient(145deg, #ffc107, #ffb300);
        border-color: #ff9800;
    }

    .legend-color-mini.empty {
        background: linear-gradient(145deg, #ffffff, #f0f0f0);
        border-color: #dee2e6;
    }

    @media (max-width: 768px) {
        .book-detail {
            flex-direction: column;
            align-items: center;
        }

        .book-info {
            text-align: center;
        }

        .location-modal-content {
            width: 95%;
        }

        .top-row-mini {
            grid-template-columns: 1fr;
        }

        .bottom-row-mini {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    // Toggle tóm tắt
    const summary = document.getElementById('summary');
    const btn = document.getElementById('toggleBtn');

    btn.addEventListener('click', () => {
        summary.classList.toggle('expanded');
        btn.textContent = summary.classList.contains('expanded') ?
            'Thu gọn' :
            'Xem thêm';
    });

    // Mở modal bản đồ vị trí
    function openLocationMap(maVT) {
        const modal = document.getElementById('locationModal');
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';

        // Xóa active cũ
        document.querySelectorAll('.shelf-mini').forEach(shelf => {
            shelf.classList.remove('active');
        });

        // Thêm active cho vị trí được chọn
        const targetShelf = document.querySelector(`.shelf-mini[data-mavt="${maVT}"]`);
        if (targetShelf) {
            targetShelf.classList.add('active');

            // Hiển thị thông tin vị trí
            const khu = maVT.charAt(0) === 'A' ? 'Khu A' : 'Khu B';
            const day = 'Dãy ' + maVT.charAt(1);
            const ke = 'Kệ ' + maVT.charAt(2);

            document.getElementById('locationInfo').innerHTML = `
                📍 VỊ TRÍ SÁCH: <span style="font-size: 22px;">${khu} • ${day} • ${ke}</span>
                <div style="margin-top: 8px; font-size: 16px; opacity: 0.9;">Mã vị trí: ${maVT}</div>
            `;

            // Scroll đến vị trí
            setTimeout(() => {
                targetShelf.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }, 300);
        }
    }

    // Đóng modal
    function closeLocationMap() {
        const modal = document.getElementById('locationModal');
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    // Đóng modal khi click bên ngoài
    document.getElementById('locationModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLocationMap();
        }
    });

    // Đóng modal khi nhấn ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLocationMap();
        }
    });
</script>