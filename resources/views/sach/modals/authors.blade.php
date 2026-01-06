{{-- resources/views/sach/modals/authors.blade.php --}}

{{-- MODAL CHỌN TÁC GIẢ --}}
<div class="modal fade" id="authorsModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            
            {{-- HEADER --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">📚 Chọn tác giả</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">
                <div class="row">
                    
                    {{-- CỘT TRÁI: TÌM KIẾM VÀ DANH SÁCH --}}
                    <div class="col-md-8">
                        
                        {{-- TÌM KIẾM --}}
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text"
                                       id="authorModalSearch"
                                       class="form-control"
                                       placeholder="🔍 Tìm tác giả theo tên hoặc mã..."
                                       autocomplete="off">
                                <button type="button" 
                                        class="btn btn-success" 
                                        id="btnThemTacGiaMoi">
                                    <i class="bi bi-plus-circle"></i> Thêm mới
                                </button>
                            </div>
                        </div>

                        {{-- FORM THÊM MỚI (ẨN) --}}
                        <div id="formThemTacGia" class="card border-success mb-3" style="display: none;">
                            <div class="card-body">
                                <h6 class="card-title text-success">➕ Thêm tác giả mới</h6>
                                <div class="input-group">
                                    <input type="text"
                                           id="tenTacGiaMoi"
                                           class="form-control"
                                           placeholder="Nhập tên tác giả...">
                                    <button type="button" 
                                            class="btn btn-success" 
                                            id="btnLuuTacGiaMoi">
                                        💾 Lưu
                                    </button>
                                    <button type="button" 
                                            class="btn btn-secondary" 
                                            id="btnHuyThemTacGia">
                                        ❌ Hủy
                                    </button>
                                </div>
                                <small class="text-muted">Mã tác giả sẽ được tự động tạo</small>
                            </div>
                        </div>

                        {{-- DANH SÁCH TÁC GIẢ --}}
                        <div id="authorsListContainer" style="max-height: 450px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 0.375rem;">
                            <div class="list-group" id="authorsList">
                                @foreach($tacGias as $tg)
                                <label class="list-group-item list-group-item-action d-flex align-items-center author-item">
                                    <input type="checkbox"
                                           class="form-check-input me-3 author-checkbox"
                                           value="{{ $tg->MaTG }}"
                                           data-name="{{ $tg->TenTG }}">
                                    <div>
                                        <div class="fw-semibold">{{ $tg->TenTG }}</div>
                                        <small class="text-muted">{{ $tg->MaTG }}</small>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- THÔNG BÁO KHÔNG TÌM THẤY --}}
                        <div id="noResultsMessage" class="alert alert-info mt-3" style="display: none;">
                            <i class="bi bi-info-circle"></i> Không tìm thấy tác giả phù hợp. 
                            Bạn có thể thêm mới bằng nút <strong>"Thêm mới"</strong> ở trên.
                        </div>
                    </div>

                    {{-- CỘT PHẢI: ĐÃ CHỌN --}}
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">
                                    Đã chọn (<span id="selectedCount">0</span>)
                                </h6>
                                <div id="selectedAuthorsPreview" style="max-height: 500px; overflow-y: auto;">
                                    <p class="text-muted mb-0">Chưa chọn tác giả nào</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Đóng
                </button>
                <button type="button" class="btn btn-primary" id="btnXacNhanChonTacGia">
                    ✅ Xác nhận (<span id="confirmCount">0</span>)
                </button>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT XỬ LÝ --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('authorsModal');
    const searchInput = document.getElementById('authorModalSearch');
    const authorsList = document.getElementById('authorsList');
    const noResultsMessage = document.getElementById('noResultsMessage');
    const selectedCount = document.getElementById('selectedCount');
    const confirmCount = document.getElementById('confirmCount');
    const selectedPreview = document.getElementById('selectedAuthorsPreview');
    const currentAuthorsDiv = document.getElementById('currentAuthors');
    const hiddenAuthorsDiv = document.getElementById('hidden-authors');
    
    // Form thêm mới
    const btnThemMoi = document.getElementById('btnThemTacGiaMoi');
    const formThem = document.getElementById('formThemTacGia');
    const btnHuyThem = document.getElementById('btnHuyThemTacGia');
    const btnLuuMoi = document.getElementById('btnLuuTacGiaMoi');
    const tenTacGiaMoi = document.getElementById('tenTacGiaMoi');

    // Lưu danh sách đã chọn
    let selectedAuthors = new Map();
    
    // Lưu toàn bộ danh sách tác giả
    let allAuthors = [];

    // Load danh sách tác giả ban đầu
    function loadInitialAuthors() {
        allAuthors = [];
        const items = authorsList.querySelectorAll('.author-item');
        items.forEach(item => {
            const checkbox = item.querySelector('.author-checkbox');
            allAuthors.push({
                MaTG: checkbox.value,
                TenTG: checkbox.dataset.name
            });
        });
    }

    // Tìm kiếm local
    function searchAuthors(keyword) {
        keyword = keyword.toLowerCase().trim();
        
        if (!keyword) {
            renderAuthorsList(allAuthors);
            noResultsMessage.style.display = 'none';
            return;
        }

        const filtered = allAuthors.filter(tg => 
            tg.TenTG.toLowerCase().includes(keyword) || 
            tg.MaTG.toLowerCase().includes(keyword)
        );

        if (filtered.length > 0) {
            renderAuthorsList(filtered);
            noResultsMessage.style.display = 'none';
        } else {
            authorsList.innerHTML = '';
            noResultsMessage.style.display = 'block';
        }
    }

    // Render danh sách tác giả
    function renderAuthorsList(tacgias) {
        authorsList.innerHTML = tacgias.map(tg => {
            const isChecked = selectedAuthors.has(tg.MaTG);
            return `
                <label class="list-group-item list-group-item-action d-flex align-items-center author-item">
                    <input type="checkbox"
                           class="form-check-input me-3 author-checkbox"
                           value="${tg.MaTG}"
                           data-name="${tg.TenTG}"
                           ${isChecked ? 'checked' : ''}>
                    <div>
                        <div class="fw-semibold">${tg.TenTG}</div>
                        <small class="text-muted">${tg.MaTG}</small>
                    </div>
                </label>
            `;
        }).join('');
    }

    // Lắng nghe sự kiện tìm kiếm
    searchInput.addEventListener('input', function(e) {
        searchAuthors(e.target.value);
    });

    // Xử lý checkbox change (event delegation)
    authorsList.addEventListener('change', function(e) {
        if (e.target.classList.contains('author-checkbox')) {
            const checkbox = e.target;
            const maTG = checkbox.value;
            const tenTG = checkbox.dataset.name;

            if (checkbox.checked) {
                selectedAuthors.set(maTG, tenTG);
            } else {
                selectedAuthors.delete(maTG);
            }

            updateSelectedPreview();
        }
    });

    // Cập nhật preview đã chọn
    function updateSelectedPreview() {
        const count = selectedAuthors.size;
        selectedCount.textContent = count;
        confirmCount.textContent = count;

        if (count === 0) {
            selectedPreview.innerHTML = '<p class="text-muted mb-0">Chưa chọn tác giả nào</p>';
        } else {
            const items = Array.from(selectedAuthors.entries()).map(([maTG, tenTG]) => {
                return `
                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-white rounded border">
                        <div>
                            <div class="fw-semibold small">${tenTG}</div>
                            <small class="text-muted">${maTG}</small>
                        </div>
                        <button type="button" 
                                class="btn btn-sm btn-outline-danger remove-author"
                                data-id="${maTG}">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                `;
            }).join('');
            selectedPreview.innerHTML = items;
        }
    }

    // Xóa tác giả đã chọn (event delegation)
    selectedPreview.addEventListener('click', function(e) {
        const btn = e.target.closest('.remove-author');
        if (btn) {
            const maTG = btn.dataset.id;
            selectedAuthors.delete(maTG);
            
            // Bỏ check trong danh sách
            const checkbox = authorsList.querySelector(`input[value="${maTG}"]`);
            if (checkbox) checkbox.checked = false;
            
            updateSelectedPreview();
        }
    });

    // Hiện form thêm mới
    btnThemMoi.addEventListener('click', function() {
        formThem.style.display = 'block';
        tenTacGiaMoi.focus();
    });

    // Hủy thêm mới
    btnHuyThem.addEventListener('click', function() {
        formThem.style.display = 'none';
        tenTacGiaMoi.value = '';
    });

    // Lưu tác giả mới
    btnLuuMoi.addEventListener('click', function() {
        const tenTG = tenTacGiaMoi.value.trim();
        
        if (!tenTG) {
            alert('Vui lòng nhập tên tác giả!');
            return;
        }

        // Disable button
        const originalHtml = btnLuuMoi.innerHTML;
        btnLuuMoi.disabled = true;
        btnLuuMoi.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Đang lưu...';

        // Lấy CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || 
                         document.querySelector('input[name="_token"]')?.value;
        
        if (!csrfToken) {
            alert('❌ Không tìm thấy CSRF token. Vui lòng tải lại trang.');
            btnLuuMoi.disabled = false;
            btnLuuMoi.innerHTML = originalHtml;
            return;
        }

        fetch('{{ route("tacgia.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ TenTG: tenTG })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.message || 'Lỗi khi thêm tác giả');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success && data.tacgia) {
                // Thêm vào danh sách local
                allAuthors.unshift({
                    MaTG: data.tacgia.MaTG,
                    TenTG: data.tacgia.TenTG
                });
                
                // Thêm vào đã chọn
                selectedAuthors.set(data.tacgia.MaTG, data.tacgia.TenTG);
                
                // Reset form
                formThem.style.display = 'none';
                tenTacGiaMoi.value = '';
                searchInput.value = '';
                
                // Render lại danh sách
                renderAuthorsList(allAuthors);
                updateSelectedPreview();
                
                // Thông báo
                showToast('✅ Thêm tác giả thành công!', 'success');
            } else {
                throw new Error(data.message || 'Không thể thêm tác giả');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Có lỗi xảy ra: ' + error.message);
        })
        .finally(() => {
            btnLuuMoi.disabled = false;
            btnLuuMoi.innerHTML = originalHtml;
        });
    });

    // Xác nhận chọn
    document.getElementById('btnXacNhanChonTacGia').addEventListener('click', function() {
        // Cập nhật hiển thị
        if (selectedAuthors.size === 0) {
            currentAuthorsDiv.innerHTML = '<span class="text-muted">(Chưa chọn tác giả)</span>';
        } else {
            const names = Array.from(selectedAuthors.values()).join(', ');
            currentAuthorsDiv.innerHTML = names;
        }

        // Tạo hidden inputs
        hiddenAuthorsDiv.innerHTML = '';
        selectedAuthors.forEach((tenTG, maTG) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'tacGias[]';
            input.value = maTG;
            hiddenAuthorsDiv.appendChild(input);
        });

        // Đóng modal
        const modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
        
        if (selectedAuthors.size > 0) {
            showToast(`✅ Đã chọn ${selectedAuthors.size} tác giả`, 'success');
        }
    });

    // Reset khi mở modal
    modal.addEventListener('show.bs.modal', function() {
        searchInput.value = '';
        formThem.style.display = 'none';
        tenTacGiaMoi.value = '';
        noResultsMessage.style.display = 'none';
        
        // Load danh sách ban đầu
        loadInitialAuthors();
        renderAuthorsList(allAuthors);
    });

    // Toast notification helper
    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toastContainer') || createToastContainer();
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} alert-dismissible fade show`;
        toast.style.cssText = 'margin-bottom: 10px;';
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
        container.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; max-width: 350px;';
        document.body.appendChild(container);
        return container;
    }

    // Khởi tạo
    loadInitialAuthors();
});
</script>

<style>
.author-item {
    cursor: pointer;
    transition: background-color 0.2s;
}

.author-item:hover {
    background-color: #f8f9fa;
}

.author-item input[type="checkbox"]:checked ~ div {
    color: #0d6efd;
    font-weight: 600;
}

#selectedAuthorsPreview .remove-author {
    opacity: 0.7;
    transition: opacity 0.2s;
}

#selectedAuthorsPreview .remove-author:hover {
    opacity: 1;
}
</style>