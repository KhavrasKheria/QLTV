{{-- File: resources/views/sach/modals/map-picker.blade.php --}}

<div class="modal fade" id="mapPickerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-map"></i> Chọn vị trí sách trên bản đồ
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-0">
                <style>
                    .map-picker-container {
                        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                        padding: 30px;
                    }

                    .map-content {
                        background: #fff;
                        border-radius: 12px;
                        padding: 30px;
                        overflow-x: auto;
                    }

                    .horizontal-layout {
                        display: flex;
                        flex-direction: column;
                        gap: 50px;
                        min-width: 900px;
                    }

                    .top-row {
                        display: grid;
                        grid-template-columns: 120px 1fr 1fr 1fr;
                        gap: 40px;
                        align-items: start;
                    }

                    .section-wrapper {
                        position: relative;
                        z-index: 2;
                    }

                    .wc-box {
                        background: linear-gradient(145deg, #6c757d, #5a6268);
                        color: white;
                        padding: 25px 15px;
                        border-radius: 12px;
                        text-align: center;
                        font-weight: bold;
                        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
                        height: 100%;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        gap: 10px;
                    }

                    .wc-icon { font-size: 42px; }

                    .khu-section {
                        background: #fff;
                        border: 2px solid #e9ecef;
                        border-radius: 12px;
                        padding: 20px;
                    }

                    .khu-title {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 12px 20px;
                        border-radius: 8px;
                        text-align: center;
                        font-weight: bold;
                        font-size: 16px;
                        margin-bottom: 20px;
                        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
                    }

                    .day-container {
                        background: #f8f9fa;
                        border-radius: 8px;
                        padding: 15px;
                        margin-bottom: 15px;
                        border: 2px solid #e9ecef;
                    }

                    .day-label {
                        font-weight: 600;
                        color: #495057;
                        margin-bottom: 10px;
                        font-size: 14px;
                    }

                    .day-label::before {
                        content: "📂 ";
                    }

                    .shelf-row {
                        display: flex;
                        gap: 10px;
                    }

                    .shelf-clickable {
                        background: linear-gradient(145deg, #ffffff, #f0f0f0);
                        border: 2px solid #dee2e6;
                        border-radius: 8px;
                        padding: 12px 15px;
                        flex: 1;
                        text-align: center;
                        cursor: pointer;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                        position: relative;
                    }

                    .shelf-clickable:hover {
                        transform: translateY(-3px) scale(1.05);
                        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
                        border-color: #6c757d;
                        background: linear-gradient(145deg, #e3f2fd, #bbdefb);
                    }

                    .shelf-clickable.active {
                        background: linear-gradient(145deg, #ffc107, #ffb300) !important;
                        border-color: #ff9800 !important;
                        color: #000 !important;
                        font-weight: bold;
                        box-shadow: 0 6px 25px rgba(255, 193, 7, 0.5) !important;
                        animation: pulse 1.5s infinite;
                    }

                    @keyframes pulse {
                        0%, 100% { transform: scale(1); }
                        50% { transform: scale(1.08); }
                    }

                    .shelf-code {
                        font-weight: bold;
                        font-size: 15px;
                        color: #212529;
                    }

                    .shelf-clickable.active .shelf-code {
                        color: #000;
                        font-size: 18px;
                    }

                    .shelf-label {
                        font-size: 11px;
                        color: #6c757d;
                        margin-top: 4px;
                    }

                    .reading-area {
                        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
                        border-radius: 12px;
                        padding: 20px;
                        text-align: center;
                        box-shadow: 0 4px 15px rgba(132, 250, 176, 0.3);
                        height: 100%;
                    }

                    .reading-title {
                        font-size: 16px;
                        font-weight: bold;
                        color: #155724;
                        margin-bottom: 15px;
                    }

                    .reading-title::before {
                        content: "🪑 ";
                    }

                    .tables-grid {
                        display: grid;
                        grid-template-columns: repeat(3, 1fr);
                        gap: 10px;
                    }

                    .reading-table {
                        background: #fff;
                        border: 2px solid #28a745;
                        border-radius: 8px;
                        padding: 12px 8px;
                        font-weight: 600;
                        font-size: 13px;
                        color: #155724;
                    }

                    .bottom-row {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 60px;
                        padding-top: 40px;
                        border-top: 3px dashed #dee2e6;
                    }

                    .entrance-box {
                        background: linear-gradient(145deg, #28a745, #20c997);
                        color: white;
                        padding: 30px;
                        border-radius: 12px;
                        text-align: center;
                        font-weight: bold;
                        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
                    }

                    .entrance-icon {
                        font-size: 56px;
                        display: block;
                        margin-bottom: 10px;
                    }

                    .librarian-desk {
                        background: linear-gradient(145deg, #0d6efd, #0b5ed7);
                        color: #fff;
                        border-radius: 12px;
                        padding: 30px;
                        text-align: center;
                        font-weight: bold;
                        font-size: 18px;
                        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
                    }

                    .librarian-desk::before {
                        content: "👨‍💼";
                        font-size: 48px;
                        display: block;
                        margin-bottom: 10px;
                    }

                    .instruction-box {
                        background: #fff3cd;
                        border: 2px solid #ffc107;
                        border-radius: 8px;
                        padding: 15px;
                        margin-bottom: 20px;
                        text-align: center;
                        font-weight: 500;
                        color: #856404;
                    }

                    .instruction-box::before {
                        content: "💡 ";
                        font-size: 20px;
                    }
                </style>

                <div class="map-picker-container">
                    
                    <div class="instruction-box">
                        Click vào kệ sách để chọn vị trí
                    </div>

                    <div class="map-content">
                        <div class="horizontal-layout">

                            {{-- HÀNG TRÊN --}}
                            <div class="top-row">

                                {{-- WC --}}
                                <div class="wc-box section-wrapper">
                                    <span class="wc-icon">🚻</span>
                                    <div style="font-size: 14px;">NHÀ<br>VỆ SINH</div>
                                </div>

                                {{-- KHU A --}}
                                <div class="khu-section section-wrapper">
                                    <div class="khu-title">📚 KHU A</div>

                                    @for($day = 1; $day <= 3; $day++)
                                        <div class="day-container">
                                            <div class="day-label">Dãy {{ $day }}</div>
                                            <div class="shelf-row">
                                                @for($ke = 1; $ke <= 3; $ke++)
                                                    @php $maVT = 'A' . $day . $ke; @endphp
                                                    <div class="shelf-clickable"
                                                         data-mavt="{{ $maVT }}"
                                                         data-khu="Khu A"
                                                         data-day="Dãy {{ $day }}"
                                                         data-ke="Kệ {{ $ke }}">
                                                        <div class="shelf-code">{{ $maVT }}</div>
                                                        <div class="shelf-label">Kệ {{ $ke }}</div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                {{-- BÀN ĐỌC --}}
                                <div class="reading-area section-wrapper">
                                    <div class="reading-title">KHU ĐỌC SÁCH</div>
                                    <div class="tables-grid">
                                        @for($i = 1; $i <= 12; $i++)
                                            <div class="reading-table">Bàn {{ $i }}</div>
                                        @endfor
                                    </div>
                                </div>

                                {{-- KHU B --}}
                                <div class="khu-section section-wrapper">
                                    <div class="khu-title">📚 KHU B</div>

                                    @for($day = 1; $day <= 3; $day++)
                                        <div class="day-container">
                                            <div class="day-label">Dãy {{ $day }}</div>
                                            <div class="shelf-row">
                                                @for($ke = 1; $ke <= 3; $ke++)
                                                    @php $maVT = 'B' . $day . $ke; @endphp
                                                    <div class="shelf-clickable"
                                                         data-mavt="{{ $maVT }}"
                                                         data-khu="Khu B"
                                                         data-day="Dãy {{ $day }}"
                                                         data-ke="Kệ {{ $ke }}">
                                                        <div class="shelf-code">{{ $maVT }}</div>
                                                        <div class="shelf-label">Kệ {{ $ke }}</div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                            </div>

                            {{-- HÀNG DƯỚI --}}
                            <div class="bottom-row">
                                <div class="entrance-box">
                                    <span class="entrance-icon">⬆️</span>
                                    <div style="font-size: 20px;">LỐI VÀO</div>
                                </div>

                                <div class="librarian-desk">
                                    <span>BÀN THỦ THƯ</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div id="selectedLocationDisplay" class="me-auto">
                    <small class="text-muted">Chưa chọn vị trí</small>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Đóng
                </button>
                <button type="button" class="btn btn-primary" id="confirmLocation">
                    <i class="bi bi-check-circle"></i> Xác nhận
                </button>
            </div>
        </div>
    </div>
</div>