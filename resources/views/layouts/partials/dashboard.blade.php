@extends('layouts.admin') {{-- kế thừa layout admin --}}

@section('content') {{-- Nội dung chính sẽ nhúng vào @yield('content') --}}
<div class="content">
    <h1>Admin</h1>
    <p>Chào mừng đến trang quản trị thư viện. Tại đây bạn có thể quản lý sách, độc giả, mượn trả và các yêu cầu.</p>

    <!-- Example cards -->
    <div class="row g-3 mt-3">
        <!-- Card Sách -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="bi bi-book fs-1 mb-2"></i>
                    <h5 class="card-title">Sách</h5>
                    <p class="card-text">Quản lý danh mục sách.</p>
                </div>
            </div>
        </div>

        <!-- Card Độc giả -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="bi bi-people fs-1 mb-2"></i>
                    <h5 class="card-title">Độc giả</h5>
                    <p class="card-text">Quản lý danh sách độc giả.</p>
                </div>
            </div>
        </div>

        <!-- Card Sách mượn -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="bi bi-journal-arrow-up fs-1 mb-2"></i>
                    <h5 class="card-title">Sách mượn</h5>
                    <p class="card-text">Quản lý các sách đã mượn.</p>
                </div>
            </div>
        </div>

        <!-- Card Hình phạt -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="bi bi-exclamation-triangle fs-1 mb-2"></i>
                    <h5 class="card-title">Hình phạt</h5>
                    <p class="card-text">Quản lý các hình phạt.</p>
                </div>
            </div>
        </div>

        <!-- Card Yêu cầu -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="bi bi-card-checklist fs-1 mb-2"></i>
                    <h5 class="card-title">Yêu cầu</h5>
                    <p class="card-text">Quản lý danh sách yêu cầu.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
