@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const openBtn   = document.getElementById('openCameraScan');
    const isbnInput = document.getElementById('isbnInput');
    const modalEl   = document.getElementById('cameraModal');
    const videoEl   = document.getElementById('cameraPreview');

    if (!openBtn || !modalEl || !videoEl) return;

    let reader = null;
    let modalInstance = null;
    let isScanning = false; // 🔴 CỜ CHỐNG SCAN TRÙNG

    // =======================
    // MỞ CAMERA
    // =======================
    openBtn.addEventListener('click', async () => {

        // ⛔ Nếu đang scan thì không cho mở lại
        if (isScanning) return;

        isScanning = true;

        modalInstance = new bootstrap.Modal(modalEl, {
            backdrop: 'static',
            keyboard: false
        });
        modalInstance.show();

        const hints = new Map();
        hints.set(ZXing.DecodeHintType.POSSIBLE_FORMATS, [
            ZXing.BarcodeFormat.EAN_13
        ]);

        reader = new ZXing.BrowserBarcodeReader(hints);

        try {
            const devices = await reader.listVideoInputDevices();

            if (!devices.length) {
                alert('❌ Không tìm thấy camera');
                isScanning = false;
                return;
            }

            // 👉 Ưu tiên camera sau (mobile)
            const backCamera =
                devices.find(d => d.label.toLowerCase().includes('back')) ||
                devices[0];

            reader.decodeFromVideoDevice(
                backCamera.deviceId,
                videoEl,
                (result, err) => {

                    if (result) {
                        isbnInput.value = result.text;
                        isbnInput.dispatchEvent(new Event('input'));
                        isbnInput.dispatchEvent(new Event('change'));

                        // ✅ DỪNG CAMERA
                        reader.reset();
                        modalInstance.hide();
                        isScanning = false;
                    }
                }
            );

        } catch (err) {
            console.error(err);
            alert('❌ Không thể mở camera');
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

        // ✅ FIX aria-hidden warning
        openBtn.focus();
    });

});
</script>
@endpush
