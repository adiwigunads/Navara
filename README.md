# Navara Karangasem

Instalasi dan setup proyek Laravel ini.

## Persyaratan Sistem

- PHP ^8.3
- Composer
- Node.js dan npm
- MySQL atau database yang kompatibel dengan Laravel

## Setup Lokal

1. Clone repositori:

```bash
git clone <repo-url> navara
cd navara
```

2. Instal dependensi PHP:

```bash
composer install
```

3. Salin file environment dan atur konfigurasi database:

```bash
cp .env.example .env
```

Edit `.env` sesuai lingkungan lokal Anda. Contoh konfigurasi default database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=navara
DB_USERNAME=root
DB_PASSWORD=
```

4. Buat kunci aplikasi:

```bash
php artisan key:generate
```

5. Jalankan migrasi database:

```bash
php artisan migrate
```

6. Instal dependensi frontend dan bangun aset:

```bash
npm install
npm run build
```

## Menjalankan Aplikasi

Untuk menjalankan server pengembangan:

```bash
php artisan serve
```

Jika Anda ingin melihat perubahan frontend secara otomatis:

```bash
npm run dev
```

Project juga memiliki skrip `dev` untuk menjalankan server Laravel, queue listener, dan Vite secara bersamaan:

```bash
npm run dev
```

## Skrip Composer

- `composer run setup` — instal dependensi, siapkan `.env`, hasilkan kunci aplikasi, migrasi database, dan bangun aset.
- `composer run test` — jalankan test suite.

## Testing

Jalankan test dengan:

```bash
php artisan test
```

## Catatan Tambahan

- Proyek ini menggunakan Laravel Boost sebagai dependency pengembangan.
- Jika Anda mengalami masalah saat melihat perubahan frontend, jalankan `npm run build` atau `npm run dev`.
- Pastikan `APP_URL` di `.env` disesuaikan dengan alamat lokal Anda.
