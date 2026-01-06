{{-- Modal Quét QR Code --}}
<div class="modal fade" id="modalScanQR" tabindex="-1" aria-labelledby="modalScanQRLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            
            {{-- Header --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalScanQRLabel">
                    <i class="bi bi-qr-code-scan"></i> Quét mã QR độc giả
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <div class="row">
                    
                    {{-- Vùng quét QR --}}
                    <div class="col-md-8 mx-auto">
                        <div class="border rounded p-3 bg-light" style="min-height: 350px;">
                            <div id="qr-reader" style="width: 100%;"></div>
                        </div>
                        
                        {{-- Hướng dẫn --}}
                        <div class="alert alert-info mt-3 mb-0">
                            <h6 class="fw-bold"><i class="bi bi-info-circle"></i> Hướng dẫn:</h6>
                            <ul class="mb-0 small">
                                <li>Đưa mã QR vào khung hình</li>
                                <li>Giữ camera ổn định</li>
                                <li>Đảm bảo đủ ánh sáng</li>
                                <li>Mã QR phải rõ nét</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- Script quét QR --}}
@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
let html5QrCode;
let isScanning = false;

// Khởi tạo scanner khi modal mở
document.getElementById('modalScanQR').addEventListener('shown.bs.modal', function () {
    startScanner();
});

// Dừng scanner khi modal đóng
document.getElementById('modalScanQR').addEventListener('hidden.bs.modal', function () {
    stopScanner();
});

// Bắt đầu quét
function startScanner() {
    if (isScanning) return;
    
    html5QrCode = new Html5Qrcode("qr-reader");
    
    const config = { 
        fps: 10, 
        qrbox: { width: 250, height: 250 } 
    };

    html5QrCode.start(
        { facingMode: "environment" },
        config,
        onScanSuccess,
        onScanError
    ).then(() => {
        isScanning = true;
    }).catch(err => {
        console.error('Không thể khởi động camera:', err);
        alert('Không thể truy cập camera. Vui lòng kiểm tra quyền truy cập.');
        isScanning = false;
    });
}

// Dừng quét
function stopScanner() {
    if (html5QrCode && isScanning) {
        html5QrCode.stop().then(() => {
            html5QrCode.clear();
            isScanning = false;
        }).catch(err => {
            console.error('Lỗi khi dừng scanner:', err);
            isScanning = false;
        });
    }
}

// Xử lý khi quét thành công
function onScanSuccess(decodedText, decodedResult) {
    if (!isScanning) return;
    
    console.log(`Mã QR đã quét: ${decodedText}`);
    
    // Dừng quét
    stopScanner();
    
    // Đóng modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalScanQR'));
    modal.hide();
    
    // Kiểm tra xem đang ở trang nào
    const searchInput = document.getElementById('searchInput');
    const maDocGiaInput = document.getElementById('maDocGiaInput');
    
    if (searchInput) {
        // Trang thedocgia/index - điền vào ô tìm kiếm và submit
        searchInput.value = decodedText;
        const formTimKiem = document.getElementById('formTimKiem');
        if (formTimKiem) {
            formTimKiem.submit();
        }
    } else if (maDocGiaInput) {
        // Trang muontra/index - điền vào ô mã độc giả
        maDocGiaInput.value = decodedText;
        
        // Trigger sự kiện input để cập nhật thông tin độc giả
        const event = new Event('input', { bubbles: true });
        maDocGiaInput.dispatchEvent(event);
        
        // Gọi hàm update nếu có
        if (typeof updateThongTinDocGia === 'function') {
            updateThongTinDocGia(decodedText);
        }
    }
}

// Xử lý lỗi quét (không hiển thị lỗi liên tục)
function onScanError(errorMessage) {
    // Không làm gì
}
</script>
@endpush