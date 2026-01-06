{{-- SCRIPT XỬ LÝ NHÀ XUẤT BẢN --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const publisherModal = document.getElementById('publisherModal');
    const currentPublisherDiv = document.getElementById('currentPublisher');
    const hiddenPublisherInput = document.getElementById('hidden-publisher');
    const publisherSearch = document.getElementById('publisherSearch');
    const publishersList = document.getElementById('publishersList');
    const savePublisherBtn = document.getElementById('savePublisherBtn');
    const addPublisherForm = document.getElementById('addPublisherForm');
    const noPublisherResults = document.getElementById('noPublisherResults');

    // Hiển thị nhà xuất bản đã chọn từ old() nếu có
    if (hiddenPublisherInput && hiddenPublisherInput.value) {
        const selectedItem = document.querySelector(`.publisher-item[data-id="${hiddenPublisherInput.value}"]`);
        if (selectedItem) {
            const publisherName = selectedItem.querySelector('.publisher-name').textContent;
            updateCurrentPublisher(hiddenPublisherInput.value, publisherName);
            
            // Check radio button
            const radio = selectedItem.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
        }
    }

    // Tìm kiếm nhà xuất bản
    if (publisherSearch) {
        publisherSearch.addEventListener('input', function(e) {
            const keyword = e.target.value.toLowerCase().trim();
            const items = document.querySelectorAll('.publisher-item');
            let visibleCount = 0;

            items.forEach(item => {
                const name = item.dataset.name || '';
                const code = item.dataset.code || '';
                
                if (name.includes(keyword) || code.includes(keyword)) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Hiển thị thông báo không tìm thấy
            if (publishersList && noPublisherResults) {
                if (visibleCount === 0) {
                    publishersList.style.display = 'none';
                    noPublisherResults.style.display = 'block';
                } else {
                    publishersList.style.display = 'block';
                    noPublisherResults.style.display = 'none';
                }
            }
        });
    }

    // Lưu nhà xuất bản đã chọn
    if (savePublisherBtn) {
        savePublisherBtn.addEventListener('click', function() {
            const selectedRadio = document.querySelector('input[name="selected_publisher"]:checked');
            
            if (!selectedRadio) {
                showToast('⚠️ Vui lòng chọn một nhà xuất bản', 'warning');
                return;
            }

            const publisherId = selectedRadio.value;
            const publisherItem = selectedRadio.closest('.publisher-item');
            const publisherName = publisherItem.querySelector('.publisher-name').textContent.trim();

            // Cập nhật hiển thị và hidden input
            updateCurrentPublisher(publisherId, publisherName);
            hiddenPublisherInput.value = publisherId;

            // Đóng modal
            bootstrap.Modal.getInstance(publisherModal).hide();

            showToast('✅ Đã chọn nhà xuất bản: ' + publisherName, 'success');
        });
    }

    // Xử lý thêm nhà xuất bản mới
    if (addPublisherForm) {
        addPublisherForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(addPublisherForm);
            const submitBtn = addPublisherForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            try {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Đang thêm...';

                const response = await fetch(addPublisherForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Thêm nhà xuất bản mới vào danh sách
                    addPublisherToList(result.data);

                    // Tự động chọn nhà xuất bản vừa thêm
                    updateCurrentPublisher(result.data.MaNXB, result.data.TenNXB);
                    hiddenPublisherInput.value = result.data.MaNXB;

                    // Reset form
                    addPublisherForm.reset();

                    // Chuyển về tab tìm kiếm
                    const searchTab = document.getElementById('search-tab');
                    if (searchTab) searchTab.click();

                    // Đóng modal
                    bootstrap.Modal.getInstance(publisherModal).hide();

                    showToast('✅ Đã thêm nhà xuất bản mới: ' + result.data.TenNXB, 'success');
                } else {
                    showToast('❌ ' + (result.message || 'Có lỗi xảy ra'), 'danger');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('❌ Không thể kết nối đến server', 'danger');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }

    // Cập nhật hiển thị nhà xuất bản đã chọn
    function updateCurrentPublisher(id, name) {
        if (currentPublisherDiv) {
            currentPublisherDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="bi bi-building text-primary me-2"></i>
                    <strong>${name}</strong>
                    <span class="badge bg-secondary ms-2">Mã: ${id}</span>
                </div>
            `;
        }
    }

    // Thêm nhà xuất bản mới vào danh sách
    function addPublisherToList(publisher) {
        if (!publishersList) return;

        const newItem = document.createElement('div');
        newItem.className = 'publisher-item';
        newItem.dataset.id = publisher.MaNXB;
        newItem.dataset.name = publisher.TenNXB.toLowerCase();
        newItem.dataset.code = publisher.MaNXB.toString().toLowerCase();

        newItem.innerHTML = `
            <input class="form-check-input publisher-radio"
                   type="radio"
                   name="selected_publisher"
                   value="${publisher.MaNXB}"
                   id="pub${publisher.MaNXB}"
                   checked>
            <label class="publisher-label" for="pub${publisher.MaNXB}">
                <div class="publisher-info">
                    <div class="publisher-name">${publisher.TenNXB}</div>
                    <div class="publisher-details">
                        <span class="badge bg-secondary">Mã: ${publisher.MaNXB}</span>
                    </div>
                </div>
            </label>
        `;

        publishersList.insertBefore(newItem, publishersList.firstChild);
    }

    // Reset khi đóng modal
    if (publisherModal) {
        publisherModal.addEventListener('hidden.bs.modal', function() {
            // Reset search
            if (publisherSearch) {
                publisherSearch.value = '';
                document.querySelectorAll('.publisher-item').forEach(item => {
                    item.style.display = '';
                });
            }

            // Hiển thị lại danh sách
            if (publishersList) publishersList.style.display = 'block';
            if (noPublisherResults) noPublisherResults.style.display = 'none';

            // Chuyển về tab tìm kiếm
            const searchTab = document.getElementById('search-tab');
            if (searchTab) searchTab.click();
        });
    }

    // Toast notification
    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toastContainer') || createToastContainer();
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} alert-dismissible fade show`;
        toast.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        toastContainer.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toastContainer';
        container.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999;';
        document.body.appendChild(container);
        return container;
    }
});
</script>