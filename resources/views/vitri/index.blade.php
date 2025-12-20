@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold text-primary mb-4">
        📚 Sơ đồ vị trí sách trong thư viện
    </h2>

    {{-- Nút lọc --}}
    <div class="mb-4 d-flex gap-3">
        <button class="btn btn-success fw-bold filter-btn" data-filter="has">
            ✅ Đã có sách
        </button>

        <button class="btn btn-secondary fw-bold filter-btn" data-filter="empty">
            ⭕ Chưa có sách
        </button>

        <button class="btn btn-primary fw-bold filter-btn" data-filter="all">
            🔄 Hiển thị tất cả
        </button>
    </div>

    {{-- Lặp qua từng Khu --}}
    @foreach ($vitris->groupBy('Khu') as $khu => $listKhu)

        <div class="card shadow-lg border-0 mb-5">

            {{-- Header Khu --}}
            <div class="card-header text-white fw-bold fs-5 py-3 khu-header">
                🔴 {{ $khu }}
            </div>

            <div class="card-body bg-light">

                {{-- Lặp qua từng Dãy --}}
                @foreach ($listKhu->groupBy('Day') as $day => $listDay)

                    <div class="mb-4">

                        <h5 class="fw-bold text-primary mb-3">
                            📌 {{ $day }}
                        </h5>

                        {{-- Grid hiển thị vị trí --}}
                        <div class="grid-container">

                            @foreach ($listDay as $vt)
                                @php
                                    $hasBooks = !empty($booksByLocation[$vt->MaVT] ?? []);
                                @endphp

                                <div class="card border-0 shadow-sm position-card 
                                    {{ $hasBooks ? 'pos-has-books' : 'pos-empty' }}">
                                    <div class="card-body text-white d-flex align-items-center justify-content-center p-3">
                                        <h5 class="fw-bold mb-0">{{ $vt->MaVT }}</h5>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @endforeach

</div>

{{-- CSS --}}
<style>
    .khu-header {
        background: linear-gradient(90deg, #dc3545, #b02a37);
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 15px;
    }

    .position-card {
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .position-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .pos-has-books {
        background-color: #28a745 !important;
    }

    .pos-empty {
        background-color: #6c757d !important;
    }
</style>

{{-- JS lọc --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.position-card');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter');

                cards.forEach(card => {
                    card.style.display = 'block';

                    if (filter === 'has' && !card.classList.contains('pos-has-books')) {
                        card.style.display = 'none';
                    }

                    if (filter === 'empty' && !card.classList.contains('pos-empty')) {
                        card.style.display = 'none';
                    }

                    if (filter === 'all') {
                        card.style.display = 'block';
                    }
                });
            });
        });
    });
</script>

@endsection
