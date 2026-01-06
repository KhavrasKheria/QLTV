$(document).ready(function() {
    fetch("/api")
        .then(res => res.json())
        .then(data => {
            const $carousel = $('#tg-bestselling_dynamic_slider');

            // Tạo HTML cho từng sách
            const itemsHtml = data.map(book => `
                <div class="item">
                    <div class="tg-postbook" onclick="window.location.href='/sach/${book.ISBN13}'" style="cursor: pointer;">
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
                                <h3><a href="/sach/${book.ISBN13}">${book.TenSach}</a></h3>
                            </div>
                            <span class="tg-bookwriter">By: <a href="#">${book.TacGia}</a></span>
                            
                        </div>
                    </div>
                </div>
            `).join('');
                        // <a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
                        //         <i class="fa fa-book"></i>
                        //         <em>Mượn sách</em>
                        //     </a>
            // Thêm vào carousel
            $carousel.html(itemsHtml);

            // Chờ ảnh load xong mới khởi tạo Owl Carousel
            $carousel.imagesLoaded(function() {
                $carousel.owlCarousel({
                    items: 5,
                    loop: data.length > 5,
                    margin: 10,
                    nav: true,
                    dots: true,
                    navText: [
                        '<i class="fa fa-chevron-left"></i>',
                        '<i class="fa fa-chevron-right"></i>'
                    ],
                    navClass: [
                        'owl-prev tg-btnround tg-btnprev',
                        'owl-next tg-btnround tg-btnnext'
                    ],
                    responsive: {
                        0: { items: 1 },
                        576: { items: 2 },
                        768: { items: 3 },
                        992: { items: 4 },
                        1200: { items: 5 }
                    }
                });
            });
        })
        .catch(err => console.error("Lỗi khi gọi API:", err));
});