📚 HỆ THỐNG QUẢN LÝ THƯ VIỆN

Library Management System – Laravel

1. Giới thiệu đề tài

    Tên đề tài: Hệ thống quản lý thư viện

    Môn học: Đồ án chuyên ngành

    Mục tiêu:
    Xây dựng hệ thống quản lý thư viện hỗ trợ thủ thư trong việc quản lý sách, độc giả, mượn – trả sách và hỗ trợ người dùng tra cứu thông tin sách một cách trực quan, dễ sử dụng.

2. Công nghệ sử dụng

    Backend: Laravel (PHP)

    Frontend: Blade Template, HTML, CSS, JavaScript, Bootstrap

    Cơ sở dữ liệu: MySQL

    Công cụ khác:

    Composer

    Git & GitHub

    Docker (tùy chọn)

3. Chức năng chính

👤 Người dùng (Client)

    Xem danh sách sách

    Xem chi tiết sách

    Xem vị trí sách trong thư viện (bản đồ trực quan)

    Tìm kiếm sách theo tên, bằng giọng nói.

👨‍💼 Thủ thư / Admin

    Quản lý sách

    Quản lý tác giả

    Quản lý thể loại

    Quản lý nhà xuất bản

    Quản lý độc giả

    Quản lý mượn – trả sách

    Gia hạn, trả sách

    Xem lịch sử mượn – trả

4. Yêu cầu môi trường

    PHP >= 8.1

    Composer

    MySQL

    Git

5. Hướng dẫn cài đặt

🔹 Bước 1: Clone project từ GitHub

        git clone https://github.com/KhavrasKheria/QLTV.git
        cd QLTV

🔹 Bước 2: Cài đặt thư viện PHP (Composer)

        composer install

🔹 Bước 3: Tạo file môi trường .env

        cp .env.example .env

        Cấu hình database trong file .env:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=qltv
        DB_USERNAME=root
        DB_PASSWORD=

🔹 Bước 4: Tạo key cho ứng dụng

        php artisan key:generate

🔹 Bước 5: Import cơ sở dữ liệu

        Project đã cung cấp sẵn file database trong repository.

        📁 Vị trí file database:

        database/sql/qltv.sql

        Import bằng phpMyAdmin

        Tạo database tên qltv

        Mở phpMyAdmin

        Chọn database qltv

        Chọn tab Import

        Upload file database/sql/qltv.sql

        Nhấn Go

🔹 Bước 6: Chạy project

        php artisan serve

        Truy cập hệ thống ở local:

        http://127.0.0.1:8000

        Truy cập hệ thống ở host:

        https://ba-libra.id.vn

6. Tài khoản demo

    Hệ thống đã có sẵn dữ liệu mẫu.

    Vai trò: Thủ thư(Admin)
    Email: kieta123123@gmail.com
    Mật khẩu: @nhKiet3823

7. Hướng dẫn sử dụng

    🏠 Trang chủ

        Hiển thị danh sách sách

        Click vào sách để xem chi tiết

        📖 Trang chi tiết sách

        Xem thông tin sách

        Xem tóm tắt nội dung

        Xem vị trí sách trong thư viện bằng bản đồ trực quan

    🧑‍💼 Trang quản trị

    Đăng nhập tại:

        /login

    Truy cập dashboard:

        /admin
        
    Quản lý sách, độc giả, mượn – trả

    Thủ tục liên quan đến ảnh QR Code và Barcode

    Hệ thống có sử dụng ảnh QR Code và Barcode phục vụ cho các chức năng như:

        Quét mã độc giả (QR Code)

        Quét ISBN sách (Barcode)
    
    Vị trí lưu trữ ảnh test

        Anh_test/QR: chứa ảnh QR Code của độc giả

        Anh_test/Barcode: chứa ảnh mã vạch (ISBN) của sách

9. Thông tin nhóm 6

    Họ và tên: Nguyễn Lê Anh Kiệt – MSSV: DH52111178

    Họ và tên: Trần Khánh Duy – MSSV: DH52200588
