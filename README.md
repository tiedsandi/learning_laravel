<!-- # Laravel Project

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
- penggunaan yield, extends, section -->

<!-- # Laravel Project

## Persyaratan

Sebelum memulai proyek Laravel, pastikan Anda telah menginstal beberapa alat berikut:

1. **XAMPP** – Unduh dan instal [XAMPP](https://www.apachefriends.org/download.html)
   untuk menjalankan server lokal.
2. **Composer** – Unduh dan instal [Composer](https://getcomposer.org/download/)
   untuk manajemen dependensi PHP.
3. **Node.js & NPM (Opsional)** – Digunakan jika proyek membutuhkan frontend dengan
   Laravel Mix.

## Instalasi Laravel

Laravel dapat diinstal menggunakan Composer dengan dua cara:

1. **Menggunakan Laravel Installer**

   ```sh
   composer global require laravel/installer
   laravel new nama-proyek
   ```

2. **Menggunakan Composer tanpa Laravel Installer**
   ```sh
   composer create-project --prefer-dist laravel/laravel nama-proyek
   ```

## Konfigurasi

Masuk ke direktori proyek dan lakukan beberapa konfigurasi dasar:

```sh
cd nama-proyek
cp .env.example .env
php artisan key:generate
```

### Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
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

## Struktur Folder dan Konfigurasi `.env`

- **app/** → Berisi kode utama aplikasi (Controllers, Models, Middleware, dll.)
- **routes/** → Berisi definisi rute aplikasi (web.php, api.php, console.php)
- **database/** → Berisi migrasi, seeders, dan factories
- **resources/views/** → Berisi file tampilan (blade templates)
- **config/** → Berisi konfigurasi aplikasi (database, cache, dll.)

## Alur Pembuatan Fitur Baru

### 1. Membuat Database & Konfigurasi .env

Laravel menggunakan database migrations untuk mengelola struktur database. Setelah
mengatur koneksi database di `.env`, jalankan:

```sh
php artisan migrate
```

Jika berhasil, maka Laravel akan membuat tabel default di database seperti
`migrations`, `users`, dll.

### 2. Membuat Model & Migration

Buat model dan migration sekaligus dengan perintah:

```sh
php artisan make:model NamaModel -m
```

Contoh:

```sh
php artisan make:model Post -m
```

Edit file migration di
`database/migrations/xxxx_xx_xx_xxxxxx_create_posts_table.php`:

```php
public function up()
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->timestamps();
    });
}
```

Jalankan migration:

```sh
php artisan migrate
```

### 3. Membuat Controller (dengan Resource Controller)

```sh
php artisan make:controller NamaController --resource
```

Contoh:

```sh
php artisan make:controller PostController --resource
```

Controller ini akan otomatis berada di `app/Http/Controllers/PostController.php`.

### 4. Menentukan Route di `routes/web.php`

Tambahkan route resource:

```php
use App\Http\Controllers\PostController;
Route::resource('posts', PostController::class);
```

Dengan ini, Laravel akan otomatis membuat route seperti berikut:

| HTTP Method | URL              | Method di Controller |
| ----------- | ---------------- | -------------------- |
| GET         | /posts           | index()              |
| GET         | /posts/create    | create()             |
| POST        | /posts           | store()              |
| GET         | /posts/{id}      | show()               |
| GET         | /posts/{id}/edit | edit()               |
| PUT/PATCH   | /posts/{id}      | update()             |
| DELETE      | /posts/{id}      | destroy()            |

### 5. Implementasi Controller

Edit `app/Http/Controllers/PostController.php`:

```php
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        Post::create($request->validate([
            'title' => 'required',
            'content' => 'required',
        ]));

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->validate([
            'title' => 'required',
            'content' => 'required',
        ]));

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
```

### 6. Membuat Blade Template untuk View

Buat folder `resources/views/posts` lalu tambahkan file `index.blade.php`:

```blade
@extends('layouts.app')

@section('content')
    <h1>Daftar Post</h1>
    <a href="{{ route('posts.create') }}">Buat Post</a>
    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
```

### 7. Menjalankan Laravel

Jalankan server pengembangan:

```sh
php artisan serve
```

Akses proyek di browser:

```arduino
http://127.0.0.1:8000/posts
``` -->

# README Laravel

## 1. Instalasi Laravel

Sebelum menginstall Laravel, pastikan sudah menginstall:

- PHP (>= 8.0)
- Composer
- MySQL (atau database lain sesuai kebutuhan)

### 1.1 Instalasi Laravel via Composer

Laravel dapat diinstal dengan dua cara:

#### a) Instalasi Laravel secara global

1. **Install Laravel secara global menggunakan Composer:**
   ```sh
   composer global require laravel/installer
   ```
2. **Buat proyek Laravel baru dengan perintah berikut:**
   ```sh
   laravel new nama_proyek
   ```

#### b) Instalasi Laravel tanpa installer global

1. **Install Laravel via Composer:**
   ```sh
   composer create-project --prefer-dist laravel/laravel nama_proyek
   ```
2. **Masuk ke folder proyek:**
   ```sh
   cd nama_proyek
   ```
3. **Jalankan server development:**
   ```sh
   php artisan serve
   ```
   Laravel akan berjalan di `http://127.0.0.1:8000`.

---

## 2. Struktur Folder di Laravel

Setelah instalasi, berikut adalah struktur folder utama Laravel:

- **app/** → Berisi kode utama aplikasi seperti model, controller, middleware, dan
  lainnya.
- **bootstrap/** → Berisi file untuk bootstrap aplikasi, termasuk `cache/` untuk
  meningkatkan performa.
- **config/** → Berisi file konfigurasi aplikasi.
- **database/** → Menyimpan file migration, seeder, dan factory.
- **public/** → Folder untuk file statis seperti gambar, CSS, JS, serta `index.php`
  sebagai entry point.
- **resources/** → Berisi file view (Blade template), assets, dan bahasa.
- **routes/** → Menyimpan file rute aplikasi (`web.php`, `api.php`, dll).
- **storage/** → Berisi cache, log, dan file yang diunggah.
- **tests/** → Folder untuk pengujian unit dan fitur.
- **vendor/** → Berisi dependensi yang diinstal melalui Composer.

```
laravel_project/
│── app/
│   ├── Http/
│   │   ├── Controllers/    # Berisi controller aplikasi
│   │   ├── Middleware/     # Middleware untuk request
│   │   ├── Requests/       # Request validation kustom
│   ├── Models/             # Model database ada di sini
│── bootstrap/              # Bootstrap framework Laravel
│── config/                 # Konfigurasi aplikasi
│── database/
│   ├── migrations/         # File migrasi database
│   ├── seeders/            # Seeder untuk mengisi database awal
│── public/                 # Folder untuk file publik
│── resources/
│   ├── views/              # Semua tampilan (Blade template) ada di sini
│── routes/
│   ├── web.php             # Routing aplikasi web
│   ├── api.php             # Routing API
│── storage/                # Penyimpanan log, cache, dll.
│── .env                    # Konfigurasi lingkungan
│── artisan                 # CLI Laravel
│── composer.json           # Daftar dependensi Laravel
```

---

## 3. Konfigurasi File `.env`

File `.env` digunakan untuk menyimpan konfigurasi seperti database, mail, dan
lainnya. Contoh konfigurasi:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:xxxxxxxxxxxxxxxxxxx=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Setelah mengubah `.env`, jalankan perintah:

```sh
php artisan config:cache
```

agar perubahan diterapkan.

---

## 4. Membuat File dengan Artisan CLI

Laravel menyediakan perintah Artisan untuk membuat berbagai file secara otomatis:

### 4.1. Membuat Model

```sh
php artisan make:model NamaModel
```

Contoh:

```sh
php artisan make:model Product
```

### 4.2. Membuat Controller

```sh
php artisan make:controller NamaController
```

Contoh:

```sh
php artisan make:controller ProductController
```

### 4.3. Membuat Migration

```sh
php artisan make:migration create_nama_table
```

Contoh:

```sh
php artisan make:migration create_products_table
```

### 4.4. Membuat Resource Controller

```sh
php artisan make:controller NamaController --resource
```

Contoh:

```sh
php artisan make:controller ProductController --resource
```

Resource Controller sudah otomatis memiliki fungsi CRUD.

### 4.5. Membuat Model + Migration + Factory + Seeder sekaligus

```sh
php artisan make:model NamaModel -mfs
```

Contoh:

```sh
php artisan make:model Product -mfs
```

Keterangan opsi:

- `-m` → Sekaligus membuat migration.
- `-f` → Sekaligus membuat factory.
- `-s` → Sekaligus membuat seeder.

---

### 4.6. Membuat Seeder

```sh
php artisan make:seeder NamaSeeder
```

Contoh:

```sh
php artisan make:seeder ProductSeeder
```

### 4.7. Membuat Middleware

```sh
php artisan make:middleware NamaMiddleware
```

Contoh:

```sh
php artisan make:middleware CheckRole
```

---

### 5. Mengatasi Folder yang Hilang Setelah Clone dari GitHub

Ketika proyek Laravel diunggah ke GitHub, beberapa folder seperti `vendor/` dan
`node_modules/` tidak akan ikut terupload karena ada di `.gitignore`. Setelah
meng-clone proyek, jalankan perintah berikut untuk mengunduh dependensi yang hilang:

1. **Jalankan Composer install** (untuk mendapatkan dependensi PHP Laravel):

   ```sh
   composer install
   ```

2. **Ubah nama file `.env.example` menjadi `.env`**:

   ```sh
   mv .env.example .env
   ```

3. **Generate application key**:

   ```sh
   php artisan key:generate
   ```

4. **Jalankan migrasi database**:

   ```sh
   php artisan migrate
   ```

5. **Jalankan seeder untuk mengisi database awal**:
   ```sh
   php artisan db:seed
   ```
