<!-- LIST BOOKS -->
<div id="book-list" class="book-grid">
    <!-- JS sẽ render sách vào đây -->
</div>

<!-- CSS riêng cho card sách -->
<style>
    /* Grid hiển thị sách */
    .book-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 30px;
        padding: 20px 40px;
        box-sizing: border-box;
    }

    /* Card sách */
    .book-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    /* Ảnh */
    .book-thumb {
        width: 100%;
        aspect-ratio: 3 / 4;
        overflow: hidden;
        background: #f5f5f5;
    }

    .book-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Nội dung */
    .book-content {
        padding: 14px 12px 16px;
        text-align: center;
    }

    .book-title {
        font-size: 16px;
        font-weight: 600;
        color: #222;
        margin: 0 0 6px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-author {
        font-size: 14px;
        color: #777;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .book-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 992px) {
        .book-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .book-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .book-grid {
            grid-template-columns: 1fr;
            padding: 20px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const params = new URLSearchParams(window.location.search);
        const keyword = params.get('q');

        const apiUrl = keyword ?
            `/api/search?q=${encodeURIComponent(keyword)}` :
            `/api`;

        fetch(apiUrl)
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('book-list');

                if (!Array.isArray(data) || data.length === 0) {
                    container.innerHTML = `
                    <p style="grid-column:1/-1;text-align:center;">
                        ❌ Không tìm thấy sách phù hợp
                    </p>
                `;
                    return;
                }

                container.innerHTML = data.map(book => {
                    const tacGias = Array.isArray(book.TacGias) && book.TacGias.length ?
                        book.TacGias.join(', ') :
                        'Không rõ';

                    return `
                    <div class="book-card"
                         onclick="window.location.href='/sach/${book.ISBN13}'">

                        <div class="book-thumb">
                            <img src="/img_book/${book.ISBN13}.jpg"
                                 alt="${book.TenSach}"
                                 onerror="this.src='/img_book/default.jpg'">
                        </div>

                        <div class="book-content">
                            <h3 class="book-title">${book.TenSach}</h3>
                            <p class="book-author">${tacGias}</p>
                        </div>
                    </div>
                `;
                }).join('');
            })
            .catch(err => {
                console.error('Lỗi tải sách:', err);
            });
    });
</script>