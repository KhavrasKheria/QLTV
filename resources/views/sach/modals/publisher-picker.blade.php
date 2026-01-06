{{-- MODAL CHỌN NHÀ XUẤT BẢN --}}
<div class="modal fade" id="publisherModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            {{-- HEADER --}}
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-building"></i> Chọn Nhà Xuất Bản
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">
                
                {{-- TABS --}}
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" 
                                id="search-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#search-panel" 
                                type="button">
                            <i class="bi bi-search"></i> Tìm kiếm
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" 
                                id="add-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#add-panel" 
                                type="button">
                            <i class="bi bi-plus-circle"></i> Thêm mới
                        </button>
                    </li>
                </ul>

                {{-- TAB CONTENT --}}
                <div class="tab-content">
                    
                    {{-- TAB TÌM KIẾM --}}
                    <div class="tab-pane fade show active" id="search-panel">
                        
                        {{-- Ô tìm kiếm --}}
                        <div class="mb-3">
                            <input type="text" 
                                   class="form-control" 
                                   id="publisherSearch" 
                                   placeholder="🔍 Tìm theo tên hoặc mã...">
                        </div>

                        {{-- Danh sách nhà xuất bản --}}
                        <div id="publishersList" 
                             class="publisher-list" 
                             style="max-height: 400px; overflow-y: auto;">
                            
                            @forelse($nhaXuatBans as $nxb)
                            <div class="publisher-item" 
                                 data-id="{{ $nxb->ID }}"
                                 data-name="{{ strtolower($nxb->TenNXB) }}"
                                 data-code="{{ strtolower($nxb->ID) }}">
                                
                                <input class="form-check-input publisher-radio" 
                                       type="radio" 
                                       name="selected_publisher" 
                                       value="{{ $nxb->ID }}" 
                                       id="pub{{ $nxb->ID }}">
                                
                                <label class="publisher-label" for="pub{{ $nxb->ID }}">
                                    <div class="publisher-info">
                                        <div class="publisher-name">{{ $nxb->TenNXB }}</div>
                                        <div class="publisher-details">
                                            <span class="badge bg-secondary">Mã: {{ $nxb->ID }}</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @empty
                            <div class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                <p class="mt-2">Chưa có nhà xuất bản nào</p>
                            </div>
                            @endforelse
                        </div>

                        {{-- Thông báo không tìm thấy --}}
                        <div id="noPublisherResults" 
                             class="text-center text-muted py-4" 
                             style="display: none;">
                            <i class="bi bi-search" style="font-size: 3rem;"></i>
                            <p class="mt-2">Không tìm thấy nhà xuất bản phù hợp</p>
                        </div>

                    </div>

                    {{-- TAB THÊM MỚI --}}
                    <div class="tab-pane fade" id="add-panel">
                        <form id="addPublisherForm" action="{{ route('nhaxuatban.store') }}">
                            @csrf

                            {{-- Tên NXB --}}
                            <div class="mb-3">
                                <label class="fw-semibold">
                                    Tên nhà xuất bản <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="TenNXB" 
                                       class="form-control" 
                                       placeholder="Ví dụ: Nhà Xuất Bản Trẻ" 
                                       required>
                                <small class="text-muted">Mã sẽ tự động tạo khi lưu</small>
                            </div>

                            {{-- Submit --}}
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Thêm nhà xuất bản
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Hủy
                </button>
                <button type="button" class="btn btn-primary" id="savePublisherBtn">
                    <i class="bi bi-check-circle"></i> Xác nhận chọn
                </button>
            </div>

        </div>
    </div>
</div>

{{-- CSS TÙY CHỈNH --}}
<style>
.publisher-item {
    display: flex;
    align-items: center;
    padding: 12px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    margin-bottom: 8px;
    transition: all 0.2s;
    cursor: pointer;
}

.publisher-item:hover {
    background-color: #f8f9fa;
    border-color: #0d6efd;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.1);
}

.publisher-radio {
    margin-right: 12px;
    cursor: pointer;
}

.publisher-label {
    flex: 1;
    cursor: pointer;
    margin: 0;
}

.publisher-info {
    display: flex;
    flex-direction: column;
}

.publisher-name {
    font-weight: 600;
    color: #212529;
    margin-bottom: 4px;
}

.publisher-details {
    font-size: 0.875rem;
    color: #6c757d;
}

.publisher-item input[type="radio"]:checked ~ .publisher-label {
    color: #0d6efd;
}

.publisher-item input[type="radio"]:checked ~ .publisher-label .publisher-name {
    color: #0d6efd;
}
</style>