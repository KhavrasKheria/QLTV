<!-- file: list-books.blade.php -->
<div id="book-list" class="book-grid">
    <!-- Sách sẽ được JS chèn vào đây -->
</div>

<style>
    /* Grid hiển thị sách */
    .book-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        /* 5 cột mặc định */
        gap: 30px;
        /* tăng khoảng cách giữa các sách */
        padding: 20px 40px;
        /* padding trên/dưới 20px, 2 bên 40px */
        box-sizing: border-box;
    }

    /* Mỗi cuốn sách */
    .book-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        text-align: center;
        transition: transform 0.2s;
    }

    .book-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Ảnh sách giữ tỉ lệ gốc, không bị cắt */
    .book-item img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Tên sách */
    .book-info {
        padding: 10px;
    }

    .book-info h3 {
        font-size: 16px;
        margin: 10px 0 0 0;
        line-height: 1.2;
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
            /* 2 bên nhỏ hơn trên mobile */
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api')
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('book-list');
                container.innerHTML = data.map(book => {
                    const tacGias = book.TacGias.length ? book.TacGias.join(', ') : 'Không rõ';

                    return `
                    <div class="book-item" onclick="window.location.href='/sach/${book.MaSach}'">
                        <img src="${book.Anh}" alt="${book.TenSach}">

                        <div class="book-info">
                            <h3>${book.TenSach}</h3>
                            <p>${tacGias}</p>
                        </div>
                    </div>
                `;
                }).join('');
            })
            .catch(err => console.error('Lỗi tải dữ liệu sách:', err));
    });
</script>