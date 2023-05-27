Massage Booking WEB 

1.Clone Project về từ link git: https://github.com/kimbaoksqp123/Massage_App.git

2.Cd đến thư mục chứa dự án 

    composer install

3.Cấu hình .env file
-Tạo một bản sao của tệp .env.example và đặt tên là .env.
-Mở tệp .env và cấu hình các thông số như cơ sở dữ liệu, cài đặt mail, và các thiết lập khác dựa trên yêu cầu của dự án.

4.Generate Key

    php artisan key:generate

5.Chạy migration 

-Mở XAMPP -> tạo database với tên massage_booking
    
    php artisan migrate

6.Run project
    
    
    php artisan serve




