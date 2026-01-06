@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const btn = document.getElementById('openImageScan');
    const inputFile = document.getElementById('barcodeImage');
    const isbnInput = document.getElementById('isbnInput');

    btn.addEventListener('click', () => {
        inputFile.value = '';
        inputFile.click();
    });

    async function decodeWithRetry(reader, url, retry = 1) {
        try {
            return await reader.decodeFromImageUrl(url, { tryHarder: true });
        } catch (err) {
            // Nếu là NotFoundException (lỗi N) và còn retry
            if (retry > 0) {
                await new Promise(r => setTimeout(r, 200)); // ⏱ delay 200ms
                return decodeWithRetry(reader, url, retry - 1);
            }
            throw err;
        }
    }

    inputFile.addEventListener('change', async (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const url = URL.createObjectURL(file);

        const hints = new Map();
        hints.set(ZXing.DecodeHintType.POSSIBLE_FORMATS, [
            ZXing.BarcodeFormat.EAN_13
        ]);

        const reader = new ZXing.BrowserBarcodeReader(hints);

        try {
            const result = await decodeWithRetry(reader, url, 2);

            if (!/^\d{13}$/.test(result.text)) {
                throw new Error('Không phải ISBN-13');
            }

            isbnInput.value = result.text;
            isbnInput.dispatchEvent(new Event('input'));
            isbnInput.dispatchEvent(new Event('change'));

        } catch (err) {
            console.warn('ZXing decode fail (sau retry):', err);
            alert('❌ Không nhận diện được mã ISBN trong ảnh');
        } finally {
            reader.reset();
            URL.revokeObjectURL(url);
        }
    });

});
</script>
@endpush
