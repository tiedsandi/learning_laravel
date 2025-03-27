# Laravel Project

## Install

1. **XAMPP** – Unduh dan instal [XAMPP](https://www.apachefriends.org/download.html)
   untuk menjalankan server lokal.
2. **Composer** – Unduh dan instal [Composer](https://getcomposer.org/download/)
   untuk manajemen dependensi PHP.

## Buat Project Laravel

Instal Laravel secara global menggunakan Composer:

```sh
composer global require laravel/installer
```

Buat proyek Laravel baru dengan perintah berikut:

```sh
laravel new nama-proyek
```

Atau menggunakan Composer tanpa Laravel installer:

```sh
composer create-project --prefer-dist laravel/laravel nama-proyek
```

## Konfigurasi

Masuk ke direktori proyek:

```sh
cd nama-proyek
```

Salin file konfigurasi lingkungan:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

## Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi database:

```sh
php artisan migrate
```

## Menjalankan Server

Jalankan server pengembangan Laravel:

```sh
php artisan serve
```

Akses proyek di browser:

```
http://127.0.0.1:8000
```

## Menjalankan Perintah Artisan Lainnya

Clear cache:

```sh
php artisan cache:clear
```

Clear config cache:

```sh
php artisan config:clear
```

## Menjalankan Laravel di XAMPP

Jika menggunakan XAMPP, pastikan Apache dan MySQL sedang berjalan. Sesuaikan
konfigurasi database di `.env` dengan informasi XAMPP Anda.

---

## buat file

- buat controller

```sh
php artisan make:controller <nama controller(huruf besar)> --resource
```

- buat seeder

```sh
php artisan make:seeder <nama seeder>
```

- buat model

```sh
php artisan make:model <nama model>
```

untuk langsung dibuat migration tambahkan -m

```sh
php artisan make:model <nama model> -m
```

## install file

- php artisan migrate

```sh
php artisan db:seeder
```

- php artisan seeder

```sh
php artisan db:seed -
```

- install

```sh
composer install
rename .env.example jadi .env
php artisan migrate
php artisan db:seed

```

### catatan

- membuat layouts
- memakai Route::resource
- penggunaan yield, extends, section
