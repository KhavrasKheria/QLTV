## Hướng dẫn chạy dự án QLTV

### Yêu cầu

-   Docker
-   Docker Compose

### Các bước chạy

1. Clone project
2. Copy env
   cp .env.example .env

3. Chỉnh DB trong .env
   DB_HOST=mysql
   DB_DATABASE=qltv
   DB_USERNAME=root
   DB_PASSWORD=root

4. Chạy docker
   docker compose up -d

5. Import database

    - Mở http://localhost:8081
    - Import file qltv.sql

6. Generate key & migrate
   docker compose exec laravel_app php artisan key:generate
   docker compose exec laravel_app php artisan migrate

7. Truy cập web
   http://localhost:8000
