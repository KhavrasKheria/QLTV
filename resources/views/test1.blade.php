{{-- resources/views/test.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Thu nhỏ card */
        .book-card {
            width: 150px;
        }
        .book-card img {
            height: 200px;
            object-fit: cover;
        }
        /* Scroll ngang nếu quá nhiều sách */
        #books-container {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding-bottom: 10px;
        }
        #books-container::-webkit-scrollbar {
            height: 8px;
        }
        #books-container::-webkit-scrollbar-thumb {
            background-color: rgba(0,0,0,0.2);
            border-radius: 4px;
        }
    </style>
   
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Danh sách sách từ API</h2>
    <div id="books-container">
        {{-- Card sách sẽ được render ở đây --}}
    </div>
</div>

<script>
// Gọi API và render danh sách sách
fetch("/api")
    .then(res => res.json())
    .then(data => {
        const container = document.getElementById("books-container");
        data.forEach(book => {
            const card = document.createElement("div");
            card.className = "card book-card flex-shrink-0";
            card.innerHTML = `
                <img src="${book.Anh}" class="card-img-top" alt="${book.TenSach}">
                <div class="card-body p-2">
                    <h6 class="card-title">${book.TenSach}</h6>
                    <p class="card-text text-truncate" title="${book.TomTat}">${book.TomTat}</p>
                    <p class="text-muted mb-0" style="font-size:0.8rem;">Mã vị trí: ${book.MaVT}</p>
                    <p class="text-success mb-1" style="font-size:0.8rem;">Số lượng: ${book.SoLuong}</p>
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary w-100">Mượn sách</a>
                </div>
            `;
            container.appendChild(card);
        });
    })
    .catch(err => console.error("Lỗi API:", err));
</script>

</body>
</html>
