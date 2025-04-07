# Tutorial CRUD Laravel 12

## 1. Konfigurasi File System

### 1.1 Konfigurasi File .env

pada .env ubah `FILESYTEM_DISK=local` menjad public `FILESYSTEM_DISK=public`

### 1.2 Menjalankan Storage Link

```sh
php artisan storage:link
```

## 2. Membuat Model dan migrate

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

```php
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

<<<<<<< HEAD

## 3. Menampilkan Data dari Database

=======

## 3.Menampilkan Data dari Database

> > > > > > > b0a58e8a06b78d2c43ee6deb953c6f8d0329910d

### 3.1 Membuat Controller Product

Controller berfungsi sebagai penghubung antara **Model**(database) dan **View**(tampilan antarmuka pengguna), langkahnya:

1. Buat Controller menggunakan prompt

```sh
php artisan make:controller ProductController
```

2. pada `app/Http/Controllers/ProductController.php` buat kode ini

```php
<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Product;

//import return type View
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $products = Product::latest()->paginate(10);

        //render view with products
        return view('products.index', compact('products'));
    }
}
```

### 3.2 Membuat Route Products

silahkan buka `routes/web.php` lalu ubah kode jadi seperti ini:

```php
<?php

use Illuminate\Support\Facades\Route;

//import product controller
use App\Http\Controllers\ProductController;

//route resource for products
Route::resource('/products', ProductController::class);

Route::get('/', function () {
    return view('welcome');
});
```

hanya dengan 1 baris kode di atas, Laravel akan otomati membuat 7 route bawaan untuk **CRUD** produk. Untuk melihat daftar lengkap route yang dibuat, jalankan perintah ini di terminal/CMD.

```sh
php artisan route:list
```

![alt text](image-1.png)

### 3.3 Membuat View Products Index

buat file pada `resource/views/products/index.blade.php` kemudian masukan kode ini
[index.blade.php](resources/views/products/index.blade.php)

pada kode ada pengulangan menggunakan `@forelse`:

```php
@forelse ($products as $product)

	//tampilkan data product.

@empty

	// data produk belum ada.

@endforelse
```

dan untuk menampilkan pagination, bisa menggunakan `links`

```php
{{ $products->links() }}
```

lalu jalankan dan tampilkan jangan lupa `php artisan serve` harus sudah aktif

## 4. Insert Data ke Dalam Database

### 4.1 Membuat Method `create` dan `store` di Controller

[Controller Product](app/Http/Controllers/ProductController.php) setelah menambahkan method create dan store yang digunakan untuk: <br>
![alt text](image-2.png)

#### Method Create

hanya mereturn sebuah view pada file `resource/views/products/create.blade.php`

#### Method Store

di sini kita menerima inputan ditangkap menggunakan sebuah `Reques: $request`
lalu ditambahkan sebuah validasi input:

```php
//validate form
$request->validate([
    'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
    'title'         => 'required|min:5',
    'description'   => 'required|min:10',
    'price'         => 'required|numeric',
    'stock'         => 'required|numeric'
]);
```

penjelasannya: <br>
![alt text](image-3.png)

untuk melakukan upload gambar menggunakna method `storeAs`, laravel akan:

1. Cek apakah folder storage/app/public/products sudah ada.

2. Kalau belum ada, otomatis bikin foldernya.

3. Simpan file di dalamnya.

```php
//upload image
$image = $request->file('image');
$image->storeAs('products', $image->hashName());
```

setelah gambar sudah diupload, maka selanjutnya adalah proses insert data ke dalam database menggunakan `Model`

```php
//create product
Product::create([
    'image'         => $image->hashName(),
    'title'         => $request->title,
    'description'   => $request->description,
    'price'         => $request->price,
    'stock'         => $request->stock
]);
```

![alt text](image-4.png)

lalu jika sudah berhasil di insert maka tinggal di rederict ke halaman `products.index`, jangan lupa tambahkan sebuah session flash data untuk menampilkan notifikasinya

```php
//redirect to index
return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
```

### 4.2 Membuat Form Tambah Data

setelah membuat `create.blade.php` di `resource/views/products/`
kurang lebih strukturnya seperti ini:

```sh
resources
└── views
    └── products
        ├── index.blade.php
        ├── create.blade.php <-- (File yang akan kita buat)
```

[products.create](resources/views/products/create.blade.php)

pada form yang sudah dibuat :

```php
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
	//...

</form>
```

ada action yang mengarahkan route ke method store, lalu ada enctype untuk inputan file, dan ada @csrf itu sebagai token yang harus ada ketika menginputan suatu request pada form, dan selesai bisa dicoba

## 5. Menampilkan Detail Data By ID

### 5.1 Menambhakan method `show` di Controller

[Controller Product](app/Http/Controllers/ProductController.php) setelah menambahkan method show yang menerima paramater `$id` pada controller:

```php
public function show(string $id): View
{

	//...

}
```

langkah selanjutnya adalah:

1. cari id product menggunakan method `findOrFail`

```php
//get product by ID
$product = Product::findOrFail($id);
```

2. lalu mereturn `$product` ke halaman `products.show`

```php
//render view with product
return view('products.show', compact('product'));
```

### 5.2 Membuat view detail pada product

setelah membuat `show.blade.php` di `resource/views/products/`
kurang lebih strukturnya seperti ini:

```sh
resources
└── views
    └── products
        ├── index.blade.php
        ├── create.blade.php
        ├── show.blade.php  <-- (File yang akan kita buat)
```

[products.show](resources/views/products/show.blade.php)
yang perlu diperhatikan di sini yaitu cara panggil image dan cara panggil atribut dari objek product yang sebelumnya sudah kita kirim dari kontroller cara panggilnya:

1. Menampilkan gambar

```php
<img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded" style="width: 100%">
```

2. Menampilkan atribut

```php
// menampilkan title
{{ $product->title }}

// menampilkan harga
{{ "Rp " . number_format($product->price,2,',','.') }}

// menampilkan description, karena description ada sintak html tambahkan `!!`
{!! $product->description !!}

// menampilkan stock
{{ $product->stock }}

```

dan silahkan coba
