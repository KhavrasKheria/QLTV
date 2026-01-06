

<script>
document.addEventListener('DOMContentLoaded', function() {
    const maVTInput = document.querySelector('input[name="MaVT"]');
    const openMapBtn = document.getElementById('openMapPicker');
    const mapModal = new bootstrap.Modal(document.getElementById('mapPickerModal'));
    const selectedLocationDisplay = document.getElementById('selectedLocationDisplay');

    // Mở modal bản đồ
    if (openMapBtn) {
        openMapBtn.addEventListener('click', function() {
            mapModal.show();
        });
    }

    // Xử lý click vào các kệ sách
    document.querySelectorAll('.shelf-clickable').forEach(shelf => {
        shelf.addEventListener('click', function() {
            const maVT = this.dataset.mavt;
            const khu = this.dataset.khu;
            const day = this.dataset.day;
            const ke = this.dataset.ke;

            // Xóa trạng thái active cũ
            document.querySelectorAll('.shelf-clickable').forEach(s => {
                s.classList.remove('active');
            });

            // Thêm active cho kệ được chọn
            this.classList.add('active');

            // Cập nhật input
            maVTInput.value = maVT;

            // Cập nhật hiển thị
            if (selectedLocationDisplay) {
                selectedLocationDisplay.innerHTML = `
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary">${khu}</span>
                        <span class="badge bg-info">${day}</span>
                        <span class="badge bg-success">${ke}</span>
                        <span class="fw-bold text-primary">→ ${maVT}</span>
                    </div>
                `;
            }

            // Đóng modal sau 500ms
            setTimeout(() => {
                mapModal.hide();
            }, 500);
        });
    });

    // Nút xác nhận chọn vị trí
    const confirmLocationBtn = document.getElementById('confirmLocation');
    if (confirmLocationBtn) {
        confirmLocationBtn.addEventListener('click', function() {
            if (maVTInput.value) {
                mapModal.hide();
            } else {
                alert('Vui lòng chọn một vị trí trên bản đồ');
            }
        });
    }

    // Highlight vị trí đã chọn khi mở modal
    mapModal._element.addEventListener('show.bs.modal', function() {
        const currentMaVT = maVTInput.value;
        if (currentMaVT) {
            document.querySelectorAll('.shelf-clickable').forEach(shelf => {
                if (shelf.dataset.mavt === currentMaVT) {
                    shelf.classList.add('active');
                }
            });
        }
    });
});
</script>