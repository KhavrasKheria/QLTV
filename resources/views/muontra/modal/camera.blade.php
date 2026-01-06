{{-- ================= MODAL CAMERA QUÉT MÃ VẠCH SÁCH ================= --}}
<div class="modal fade" id="cameraModalISBN" tabindex="-1" aria-labelledby="cameraModalISBNLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="cameraModalISBNLabel">
                    <i class="bi bi-camera-video"></i> Quét mã vạch sách
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Hướng camera vào mã vạch trên sách (EAN-13)
                </div>
                <video id="cameraPreviewISBN" width="100%" style="max-width: 640px; border-radius: 8px;"></video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Đóng
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/@zxing/library@latest"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const isbnInput = document.getElementById('ISBN13Input');
    const modalEl = document.getElementById('cameraModalISBN');
    const videoEl = document.getElementById('cameraPreviewISBN');
    
    if (!isbnInput || !modalEl || !videoEl) return;
    
    let reader = null;
    let modalInstance = null;
    let isScanning = false;
    
    // =======================
    // THÊM NÚT QUÉT VÀO INPUT
    // =======================
    const scanButton = document.createElement('button');
    scanButton.type = 'button';
    scanButton.className = 'btn btn-outline-primary';
    scanButton.title = 'Quét mã vạch';
    scanButton.innerHTML = '<i class="bi bi-upc-scan"></i>';
    
    // Wrap input vào input-group nếu chưa có
    if (!isbnInput.parentElement.classList.contains('input-group')) {
        const wrapper = document.createElement('div');
        wrapper.className = 'input-group';
        isbnInput.parentNode.insertBefore(wrapper, isbnInput);
        wrapper.appendChild(isbnInput);
        wrapper.appendChild(scanButton);
    } else {
        isbnInput.parentElement.appendChild(scanButton);
    }
    
    // =======================
    // MỞ CAMERA KHI CLICK NÚT
    // =======================
    scanButton.addEventListener('click', async () => {
        if (isScanning) return;
        
        isScanning = true;
        
        modalInstance = new bootstrap.Modal(modalEl, {
            backdrop: 'static',
            keyboard: false
        });
        modalInstance.show();
        
        const hints = new Map();
        hints.set(ZXing.DecodeHintType.POSSIBLE_FORMATS, [
            ZXing.BarcodeFormat.EAN_13,
            ZXing.BarcodeFormat.EAN_8,
            ZXing.BarcodeFormat.CODE_128,
            ZXing.BarcodeFormat.CODE_39
        ]);
        
        reader = new ZXing.BrowserBarcodeReader(hints);
        
        try {
            const devices = await reader.listVideoInputDevices();
            
            if (!devices.length) {
                alert('❌ Không tìm thấy camera');
                modalInstance.hide();
                isScanning = false;
                return;
            }
            
            // Ưu tiên camera sau (mobile)
            const backCamera = devices.find(d => d.label.toLowerCase().includes('back')) || devices[0];
            
            reader.decodeFromVideoDevice(
                backCamera.deviceId,
                videoEl,
                (result, err) => {
                    if (result) {
                        // ✅ Gán giá trị vào input
                        isbnInput.value = result.text;
                        
                        // ✅ Trigger sự kiện để cập nhật thông tin sách
                        isbnInput.dispatchEvent(new Event('input', { bubbles: true }));
                        isbnInput.dispatchEvent(new Event('change', { bubbles: true }));
                        
                        // ✅ Hiển thị thông báo
                        const toast = document.createElement('div');
                        toast.className = 'position-fixed top-0 start-50 translate-middle-x mt-3 alert alert-success alert-dismissible fade show';
                        toast.style.zIndex = '9999';
                        toast.innerHTML = `
                            <i class="bi bi-check-circle"></i> Đã quét mã: <strong>${result.text}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        `;
                        document.body.appendChild(toast);
                        setTimeout(() => toast.remove(), 3000);
                        
                        // ✅ DỪNG CAMERA VÀ ĐÓNG MODAL
                        if (reader) {
                            reader.reset();
                            reader = null;
                        }
                        modalInstance.hide();
                        isScanning = false;
                    }
                }
            );
        } catch (err) {
            console.error('Lỗi camera:', err);
            alert('❌ Không thể mở camera: ' + err.message);
            modalInstance.hide();
            isScanning = false;
        }
    });
    
    // =======================
    // KHI ĐÓNG MODAL
    // =======================
    modalEl.addEventListener('hidden.bs.modal', () => {
        if (reader) {
            reader.reset();
            reader = null;
        }
        isScanning = false;
        scanButton.focus();
    });
});
</script>
@endpush