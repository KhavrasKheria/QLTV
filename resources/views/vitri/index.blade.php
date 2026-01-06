@extends('layouts.admin')

@section('title', 'Bản đồ vị trí sách')

@section('content')
<style>
    .library-map {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }

    .map-container {
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        position: relative;
        overflow-x: auto;
    }

    /* LAYOUT NGANG */
    .horizontal-layout {
        display: flex;
        flex-direction: column;
        gap: 50px;
        min-width: 1000px;
    }

    /* HÀNG TRÊN: WC - KHU A - BÀN ĐỌC - KHU B */
    .top-row {
        display: grid;
        grid-template-columns: 120px 1fr 1fr 1fr;
        gap: 40px;
        align-items: start;
        position: relative;
    }

    /* WRAPPER ĐỂ NÂNG CÁC PHẦN TỬ LÊN TRÊN LỐI ĐI */
    .section-wrapper {
        position: relative;
        z-index: 2;
    }

    /* HÀNG DƯỚI: LỐI VÀO - BÀN THỦ THƯ */
    .bottom-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        padding-top: 40px;
        border-top: 3px dashed #dee2e6;
        position: relative;
    }

    /* WC */
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

    .wc-icon {
        font-size: 42px;
    }

    /* KHU SECTION */
    .khu-section {
        background: #fff;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 20px;
        height: 100%;
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

    /* DÃY KỆ - HIỂN THỊ NGANG */
    .day-container {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .day-container:hover {
        transform: translateX(3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .day-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 10px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .day-label::before {
        content: "📂";
        font-size: 16px;
    }

    /* KỆ SÁCH - NGANG */
    .shelf-row {
        display: flex;
        gap: 10px;
        flex-wrap: nowrap;
    }

    .shelf {
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
        overflow: hidden;
    }

    .shelf::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .shelf:hover::before {
        left: 100%;
    }

    .shelf:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        border-color: #6c757d;
    }

    /* VỊ TRÍ CÓ SÁCH - MÀU XANH LÁ */
    .shelf.has-books {
        background: linear-gradient(145deg, #d4edda, #c3e6cb);
        border-color: #28a745;
    }

    .shelf.has-books:hover {
        background: linear-gradient(145deg, #b8dabc, #a8d5a4);
        border-color: #1e7e34;
    }

    .shelf.has-books .shelf-code {
        color: #155724;
        font-weight: bold;
    }

    .shelf.has-books::after {
        content: "📚";
        position: absolute;
        top: 5px;
        right: 5px;
        font-size: 12px;
    }

    .shelf.active {
        background: linear-gradient(145deg, #ffc107, #ffb300);
        border-color: #ff9800;
        color: #000;
        font-weight: bold;
        box-shadow: 0 6px 25px rgba(255, 193, 7, 0.5);
        animation: pulse 2s infinite;
    }

    .shelf.active::after {
        content: "📍";
    }

    @keyframes pulse {
        0%, 100% { 
            transform: scale(1); 
            box-shadow: 0 6px 25px rgba(255, 193, 7, 0.5);
        }
        50% { 
            transform: scale(1.05); 
            box-shadow: 0 8px 30px rgba(255, 193, 7, 0.7);
        }
    }

    .shelf-code {
        font-weight: bold;
        font-size: 15px;
        color: #212529;
    }

    .shelf.active .shelf-code {
        color: #000;
        font-size: 17px;
    }

    .shelf-label {
        font-size: 11px;
        color: #6c757d;
        margin-top: 4px;
    }

    /* BÀN ĐỌC SÁCH */
    .reading-area {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(132, 250, 176, 0.3);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .reading-title {
        font-size: 16px;
        font-weight: bold;
        color: #155724;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .reading-title::before {
        content: "🪑";
        font-size: 24px;
    }

    .tables-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        flex: 1;
    }

    .reading-table {
        background: #fff;
        border: 2px solid #28a745;
        border-radius: 8px;
        padding: 12px 8px;
        font-weight: 600;
        font-size: 13px;
        color: #155724;
        transition: all 0.3s ease;
        cursor: default;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .reading-table:hover {
        background: #d4edda;
        transform: scale(1.05);
    }

    /* BÀN THỦ THƯ */
    .librarian-desk {
        background: linear-gradient(145deg, #0d6efd, #0b5ed7);
        color: #fff;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        font-weight: bold;
        font-size: 18px;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 10px;
    }

    .librarian-desk::before {
        content: "👨‍💼";
        font-size: 48px;
    }

    /* LỐI VÀO */
    .entrance-box {
        background: linear-gradient(145deg, #28a745, #20c997);
        color: white;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 10px;
    }

    .entrance-icon {
        font-size: 56px;
        animation: bounce 1.5s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* THÔNG TIN VỊ TRÍ */
    .location-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .location-info strong {
        font-size: 18px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    }

    /* HEADER */
    .map-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .map-header h4 {
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .map-header h4::before {
        content: "🗺️ ";
    }

    /* CHÚ THÍCH */
    .legend-box {
        background: #fff;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .legend-title {
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 15px;
        color: #495057;
    }

    .legend-title::before {
        content: "ℹ️ ";
    }

    .legend-items {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .legend-color {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* RESPONSIVE */
    @media (max-width: 1200px) {
        .top-row {
            grid-template-columns: 100px 1fr;
            gap: 15px;
        }
        
        .khu-section {
            grid-column: span 1;
        }
        
        .tables-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .horizontal-layout {
            min-width: auto;
        }
        
        .top-row {
            grid-template-columns: 1fr;
        }
        
        .bottom-row {
            grid-template-columns: 1fr;
        }
        
        .shelf-row {
            flex-wrap: wrap;
        }
    }
</style>

<div class="container-fluid">

    <div class="map-header">
        <h4>BẢN ĐỒ THƯ VIỆN</h4>
    </div>

    {{-- CHÚ THÍCH --}}
    <div class="legend-box">
        <div class="legend-title">Chú thích</div>
        <div class="legend-items">
            <div class="legend-item">
                <div class="legend-color" style="background: linear-gradient(145deg, #d4edda, #c3e6cb); border: 2px solid #28a745;"></div>
                <span><strong>Có sách 📚</strong> - Vị trí đã có sách</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: linear-gradient(145deg, #ffffff, #f0f0f0); border: 2px solid #dee2e6;"></div>
                <span><strong>Trống</strong> - Vị trí chưa có sách</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: linear-gradient(145deg, #ffc107, #ffb300); border: 2px solid #ff9800;"></div>
                <span><strong>Đang chọn 📍</strong> - Vị trí được chọn</span>
            </div>
        </div>
    </div>

    {{-- THÔNG TIN VỊ TRÍ ĐANG CHỌN --}}
    @if(isset($selected) && $selected)
        <div class="location-info">
            <div style="font-size: 20px; margin-bottom: 8px;">📍 VỊ TRÍ SÁCH</div>
            <strong>
                {{ $selected->Khu }} • {{ $selected->Day }} • {{ $selected->Ke }}
            </strong>
            <div style="margin-top: 5px; opacity: 0.9;">Mã vị trí: {{ $selected->MaVT }}</div>
        </div>
    @endif

    <div class="library-map">
        <div class="map-container">

            <div class="horizontal-layout">

                {{-- ================= HÀNG TRÊN: WC - KHU A - BÀN ĐỌC - KHU B ================= --}}
                <div class="top-row">

                    {{-- WC --}}
                    <div class="wc-box section-wrapper">
                        <span class="wc-icon">🚻</span>
                        <div style="font-size: 14px;">NHÀ<br>VỆ SINH</div>
                    </div>

                    {{-- KHU A --}}
                    <div class="khu-section section-wrapper">
                        <div class="khu-title">
                            📚 KHU A 
                        </div>

                        @for($day = 1; $day <= 3; $day++)
                            <div class="day-container">
                                <div class="day-label">Dãy {{ $day }}</div>
                                <div class="shelf-row">
                                    @for($ke = 1; $ke <= 3; $ke++)
                                        @php
                                            $maVT = 'A' . $day . $ke;
                                            $hasBooks = \App\Models\Sach::where('MaVT', $maVT)->exists();
                                            $isActive = (isset($selected) && $selected && $selected->MaVT == $maVT);
                                        @endphp
                                        <div class="shelf {{ $hasBooks ? 'has-books' : '' }} {{ $isActive ? 'active' : '' }}">
                                            <div class="shelf-code">{{ $maVT }}</div>
                                            <div class="shelf-label">Kệ {{ $ke }}</div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endfor
                    </div>

                    {{-- BÀN ĐỌC SÁCH --}}
                    <div class="reading-area section-wrapper">
                        <div class="reading-title">
                            KHU ĐỌC SÁCH
                        </div>
                        <div class="tables-grid">
                            @for($i = 1; $i <= 12; $i++)
                                <div class="reading-table">
                                    Bàn {{ $i }}
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- KHU B --}}
                    <div class="khu-section section-wrapper">
                        <div class="khu-title">
                            📚 KHU B 
                        </div>

                        @for($day = 1; $day <= 3; $day++)
                            <div class="day-container">
                                <div class="day-label">Dãy {{ $day }}</div>
                                <div class="shelf-row">
                                    @for($ke = 1; $ke <= 3; $ke++)
                                        @php
                                            $maVT = 'B' . $day . $ke;
                                            $hasBooks = \App\Models\Sach::where('MaVT', $maVT)->exists();
                                            $isActive = (isset($selected) && $selected && $selected->MaVT == $maVT);
                                        @endphp
                                        <div class="shelf {{ $hasBooks ? 'has-books' : '' }} {{ $isActive ? 'active' : '' }}">
                                            <div class="shelf-code">{{ $maVT }}</div>
                                            <div class="shelf-label">Kệ {{ $ke }}</div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endfor
                    </div>

                </div>

                {{-- ================= HÀNG DƯỚI: LỐI VÀO - BÀN THỦ THƯ ================= --}}
                <div class="bottom-row">

                    <div class="entrance-box">
                        <span class="entrance-icon">⬆️</span>
                        <div style="font-size: 20px;">LỐI VÀO</div>
                        <small style="opacity: 0.9;">Cổng chính thư viện</small>
                    </div>

                    <div class="librarian-desk">
                        <span>BÀN THỦ THƯ</span>
                        <small style="opacity: 0.9; font-size: 14px;">Hỗ trợ & Tư vấn sách</small>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection