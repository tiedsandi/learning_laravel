# Tutorila CRUD Laravel 12

## 1.Konfigurasi File System

### 1.1 Konfigurasi File .env

pada .env ubah `FILESYTEM_DISK=local` menjad public `FILESYSTEM_DISK=public`

### 1.2 Menjalankan Storage Link

```sh
php artisan storage:link
```

## 2.Membuat Model dan migrate

### 2.1 Konfigurasi koneksi database

pada file `.env` yang sebelumnya:

```sh
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

menjadi

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_laravel_12
DB_USERNAME=root
DB_PASSWORD=
```

untuk memastikan konfigurasi databse diterapkan jalankan perintah ini:

```sh
php artisan config:clear
```

### 2.2 Membuat Model dan Migration

membuat model dan migration sekaligus seperti berikut:

```sh
php artisan make:model Product -m
```

dari perintah di atas:

-   `php artisan make:model Product ` : membuat model dengan nama product
-   `-m` : membuat file migration untuk model tersebut

jika berhasil dijalakan akan terbuat 2 file :

-   app/Models/Product.php
-   databae/migrations/tahun_bulan_tanggal_jam_create_procuts_table.php

### 2.3 Menambahkan field / kolom di migration

membuat tabel untuk database

```sh
public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('image');
        $table->string('title');
        $table->text('description');
        $table->bigInteger('price');
        $table->integer('stock')->default(0);
        $table->timestamps();
    });
}

```

![alt text](image.png)

### 2.4 Konfigurasi Mass Assigment

pada file `app/Models/Product.php` ubah menjadi :

```sh
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'stock',
    ];
}
```

### 2.5 Menjalankan migration

untuk menjalankannya pastikan terminal /CMD berada pada project laravelnya lalu jalankan perintah ini:

```sh
php artisan migrate
```
