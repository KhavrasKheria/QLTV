$(document).ready(function() {
    fetch("/api")
        .then(res => res.json())
        .then(data => {
            const $grid = $('#tg-bestselling_grid');

            // Tạo HTML cho từng sách
            const itemsHtml = data.map(book => `
                <div class="book-item">
                    <div class="tg-postbook">
                        <figure class="tg-featureimg">
                            <div class="tg-bookimg">
                                <div class="tg-frontcover">
                                    <img src="${book.Anh}" alt="${book.TenSach}">
                                </div>
                                <div class="tg-backcover">
                                    <img src="${book.Anh}" alt="${book.TenSach}">
                                </div>
                            </div>
                            <a class="tg-btnaddtowishlist" href="javascript:void(0);">
                                <i class="icon-heart"></i>
                                <span>add to wishlist</span>
                            </a>
                        </figure>
                        <div class="tg-postbookcontent">
                            <div class="tg-booktitle">
                                <h3><a href="#">${book.TenSach}</a></h3>
                            </div>
                            <span class="tg-bookwriter">By: <a href="#">${book.TacGia}</a></span>
                        </div>
                    </div>
                </div>
            `).join('');

            $grid.html(itemsHtml);

            // Khởi tạo grid responsive
            initResponsiveGrid("#tg-bestselling_grid");
        })
        .catch(err => console.error("Lỗi khi gọi API:", err));
});
