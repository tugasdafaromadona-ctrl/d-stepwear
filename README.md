# D Stepwear — Website UMKM Sepatu (Laravel + Vue 3 + Inertia)

Brand: **D Stepwear** · Nama PT: **PT Derap Langkah Nusantara** (huruf depan "D" sama dengan brand).

Folder ini adalah **overlay**: berisi file yang ditimpa/ditambahkan ke project Laravel baru.

## Langkah instalasi

Prasyarat: PHP 8.2+, Composer, Node.js 18+.

```bash
# 1. Project Laravel baru + Breeze (login admin, Inertia, Vue, Tailwind)
composer create-project laravel/laravel d-stepwear
cd d-stepwear
composer require laravel/breeze --dev
php artisan breeze:install vue        # pilih: tanpa dark mode, tanpa testing

# 2. Salin isi folder overlay ini ke dalam d-stepwear (timpa jika diminta)
#    (public/, app/, database/, resources/, routes/)

# 3. Database (SQLite bawaan), seeder, dan storage
php artisan migrate --seed
php artisan storage:link

# 4. Jalankan (dua terminal)
npm install
npm run dev
php artisan serve
```

Buka http://127.0.0.1:8000

- Login admin: http://127.0.0.1:8000/login
  - Email: `admin@dstepwear.test`
  - Password: `password`
- Untuk MySQL, ubah `DB_CONNECTION` dan kawan-kawan di `.env`, lalu `php artisan migrate:fresh --seed`.
- Ubah `APP_NAME="D Stepwear"` di `.env`.
- Nomor WhatsApp, email, alamat, dan teks deskripsi usaha ada di `resources/js/company.js`.

## Pemenuhan ketentuan

| Ketentuan | Lokasi |
|---|---|
| Project Laravel berjalan (`php artisan serve`) | langkah instalasi di atas |
| 2 tabel berelasi (categories → products) | `database/migrations/*` |
| Model + relasi Eloquent | `app/Models/Category.php`, `Product.php` (hasMany / belongsTo) |
| Data diambil dari controller | `app/Http/Controllers/*` |
| Halaman publik: daftar + detail | `/produk`, `/produk/{slug}` |
| Admin CRUD | `/admin/products`, `/admin/categories` |
| Upload foto (storage/public) | `Admin/ProductController` → `store('products', 'public')` |
| Validasi server ≥ 3 aturan | `app/Http/Requests/ProductRequest.php` (required, max, integer, image, mimes, exists) |
| Responsif | Tailwind CSS (bawaan Breeze) |
| Seeder ≥ 5 data | `database/seeders/DatabaseSeeder.php` (4 kategori, 9 produk, 1 admin) |
| Deskripsi usaha di website | bagian "Tentang" di beranda |
| Logo | `public/images/logo-full.png`, `logo-mark.png`, `favicon.png` |

Catatan: halaman register bawaan Breeze masih aktif. Jika tidak ingin orang lain mendaftar,
hapus route register di `routes/auth.php`.
