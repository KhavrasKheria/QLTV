@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('sach.index') }}"
            class="text-decoration-none text-dark"
            title="Xem toàn bộ danh sách sách">

            <h3 class="fw-bold mb-0">📚 Danh mục sách</h3>
        </a>

        <a href="{{ route('sach.create') }}" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-plus-circle"></i> Thêm sách
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm">
        {{ session('success') }}
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(!empty($notFound) && $notFound)
    <div class="alert alert-warning shadow-sm">
        ❌ Mã sách <strong>{{ request('isbn') }}</strong> không tồn tại trong hệ thống
    </div>
    @endif

    {{-- SEARCH ISBN --}}
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <form id="isbnSearchForm" method="GET" action="{{ route('sach.index') }}">
                <div class="input-group isbn-search-group">

                    <input type="text"
                        name="isbn"
                        id="isbnInput"
                        value="{{ request('isbn') }}"
                        class="form-control"
                        placeholder="Nhập hoặc quét mã ISBN-13…">

                    <button type="button"
                        class="btn btn-outline-secondary"
                        id="openImageScan"
                        onclick="isbnInput.dataset.scanned='1'">
                        <i class="bi bi-image"></i>
                    </button>

                    <button type="button"
                        class="btn btn-outline-secondary"
                        id="openCameraScan"
                        onclick="isbnInput.dataset.scanned='1'">
                        <i class="bi bi-camera"></i>
                    </button>

                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                <input type="file" id="barcodeImage" accept="image/*" class="d-none">
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 modern-table">
                    <thead>
                        <tr>
                            <th class="ps-4 border-0">Ảnh</th>
                            <th class="border-0">Mã</th>
                            <th class="border-0">Tên sách</th>
                            <th class="border-0">Tóm tắt</th>
                            <th class="border-0">Tác giả</th>
                            <th class="border-0">Thể loại</th>
                            <th class="text-center border-0">SL</th>
                            <th class="text-center border-0">NXB</th>
                            <th class="text-center border-0">Vị trí</th>
                            <th class="text-center border-0">Trạng thái</th>
                            <th class="text-center pe-4 border-0">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($sachs as $s)
                        <tr class="book-row">
                            <td class="ps-4">
                                <div class="book-image-container">
                                    <img src="{{ asset($s->Anh ?? 'img_book/default.jpg') }}"
                                        class="book-thumbnail"
                                        alt="{{ $s->TenSach }}">
                                </div>
                            </td>

                            <td>
                                <span class="book-code">#{{ $s->ISBN13 }}</span>
                            </td>

                            <td>
                                <div class="book-title">{{ $s->TenSach }}</div>
                            </td>

                            <td style="max-width:200px">
                                <span class="text-muted small">
                                    {{ Str::limit($s->TomTat, 50) }}
                                </span>

                                @if(strlen($s->TomTat ?? '') > 50)
                                <button class="btn btn-link btn-sm p-0 text-primary open-summary"
                                    data-summary="{{ $s->TomTat }}">
                                    Xem thêm
                                </button>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($s->tacGias as $tg)
                                    <span class="badge rounded-pill bg-info-subtle text-info border border-info">
                                        <i class="bi bi-person-fill me-1"></i>{{ $tg->TenTG }}
                                    </span>
                                    @endforeach
                                </div>
                            </td>

                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($s->theLoais as $tl)
                                    <span class="badge rounded-pill bg-warning-subtle text-warning border border-warning">
                                        <i class="bi bi-bookmark-fill me-1"></i>{{ $tl->TenTheLoai }}
                                    </span>
                                    @endforeach
                                </div>
                            </td>

                            <td class="text-center">
                                <span class="quantity-badge">
                                    {{ $s->SoLuong }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="info-badge">
                                    {{ $s->nhaXuatBan->TenNXB ?? '-' }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="location-badge">
                                    <i class="bi bi-pin-map-fill"></i> {{ $s->MaVT }}
                                </span>
                            </td>

                            <td class="text-center">
                                @if($s->TrangThai === 'Con')
                                <span class="status-badge status-available">
                                    <i class="bi bi-check-circle-fill"></i> Còn
                                </span>
                                @elseif($s->TrangThai === 'Het')
                                <span class="status-badge status-unavailable">
                                    <i class="bi bi-x-circle-fill"></i> Hết
                                </span>
                                @else
                                <span class="status-badge status-processing">
                                    <i class="bi bi-hourglass-split"></i> Xử lý
                                </span>
                                @endif
                            </td>

                            <td class="text-center pe-4">
                                <div class="action-buttons">
                                    <a href="{{ route('sach.edit', $s->ISBN13) }}"
                                        class="btn btn-sm btn-edit"
                                        title="Chỉnh sửa">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button class="btn btn-sm btn-delete open-delete-modal"
                                        data-id="{{ $s->ISBN13 }}"
                                        title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TÓM TẮT --}}
<div class="modal fade" id="summaryModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">📘 Nội dung tóm tắt</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="summaryContent"></div>
        </div>
    </div>
</div>

{{-- MODAL XOÁ --}}
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">🗑️ Xác nhận xoá sách</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Bạn có chắc chắn muốn xoá sách này không?
            </div>

            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bi bi-trash"></i> Xoá
                    </button>
                </form>

                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Huỷ
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="cameraModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">📷 Quét ISBN bằng Camera</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <video id="cameraPreview"
                    style="width:100%;max-height:400px;"></video>
                <div class="text-muted mt-2">
                    Đưa mã vạch ISBN vào giữa khung hình
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Đóng
                </button>
            </div>
        </div>
    </div>
</div>

{{-- CUSTOM STYLES --}}
<style>
    /* Modern Table Styles */
    .modern-table {
        font-size: 0.95rem;
    }

    .modern-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .modern-table thead th {
        font-weight: 600;
        padding: 1rem 0.75rem;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        vertical-align: middle;
    }

    .modern-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f0f0f0;
    }

    .modern-table tbody tr:hover {
        background-color: #f8f9ff;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
    }

    .modern-table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    /* Book Image */
    .book-image-container {
        width: 50px;
        height: 70px;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .book-row:hover .book-image-container {
        transform: scale(1.1);
    }

    .book-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Book Code */
    .book-code {
        font-weight: 600;
        color: #667eea;
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
        background: linear-gradient(135deg, #667eea15, #764ba215);
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        border-left: 3px solid #667eea;
    }

    /* Book Title */
    .book-title {
        font-weight: 600;
        color: #2d3748;
        line-height: 1.4;
    }

    /* Badges */
    .badge {
        font-size: 0.8rem;
        font-weight: 500;
        padding: 0.4rem 0.7rem;
    }

    /* Quantity Badge */
    .quantity-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    /* Info Badge */
    .info-badge {
        display: inline-block;
        background: #f3f4f6;
        color: #6b7280;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.85rem;
        border: 1px solid #e5e7eb;
    }

    /* Location Badge */
    .location-badge {
        display: inline-block;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        box-shadow: 0 2px 6px rgba(251, 191, 36, 0.3);
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-available {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .status-unavailable {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }

    .status-processing {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-edit {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        color: white;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modern-table {
            font-size: 0.85rem;
        }

        .modern-table thead th {
            padding: 0.75rem 0.5rem;
            font-size: 0.75rem;
        }

        .modern-table tbody td {
            padding: 0.75rem 0.5rem;
        }
    }
</style>

{{-- SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const isbnInput = document.getElementById('isbnInput');
        const form = document.getElementById('isbnSearchForm');

        isbnInput.addEventListener('change', () => {
            if (isbnInput.dataset.scanned === '1') {
                form.submit();
                isbnInput.dataset.scanned = '0';
            }
        });

        document.querySelectorAll('.open-summary').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('summaryContent').textContent = btn.dataset.summary;
                new bootstrap.Modal('#summaryModal').show();
            });
        });

        const deleteModal = new bootstrap.Modal('#deleteModal');
        const deleteForm = document.getElementById('deleteForm');

        document.querySelectorAll('.open-delete-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                deleteForm.action = `/sach/${btn.dataset.id}`;
                deleteModal.show();
            });
        });

    });
</script>

{{-- ISBN IMAGE SCAN --}}
@include('sach.scripts.isbn')

{{-- CAMERA SCAN --}}
@include('sach.scripts.camera')

@endsection