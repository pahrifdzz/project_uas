# PahriStore - Aplikasi E-Commerce Sepatu

PahriStore adalah aplikasi web e-commerce yang dibangun menggunakan Laravel, dirancang khusus untuk penjualan sepatu. Aplikasi ini memiliki antarmuka yang bersih untuk pelanggan dan panel administrasi yang kuat untuk manajemen toko.

## Tentang Proyek

Aplikasi ini terdiri dari dua bagian utama:

1.  **Frontend**: Halaman yang dapat diakses oleh pelanggan, menampilkan katalog produk, detail sepatu, dan alur pemesanan multi-langkah dari pemilihan ukuran hingga pembayaran.
2.  **Backend (Admin Panel)**: Dibangun menggunakan Filament, panel ini memungkinkan administrator untuk mengelola seluruh aspek toko, termasuk produk, merek, kategori, ukuran, stok, dan memvalidasi transaksi yang masuk.

---

## Tech Stack

-   **Framework**: [Laravel 11](https://laravel.com/)
-   **Admin Panel**: [Filament 3](https://filamentphp.com/)
-   **UI/UX Interaktif**: [Livewire 3](https://livewire.laravel.com/)
-   **Styling**: [Tailwind CSS](https://tailwindcss.com/)
-   **Database**: MySQL

---

## Fitur Utama

-   **Manajemen Produk**: CRUD untuk Sepatu, Merek, Kategori, Foto, dan Ukuran.
-   **Katalog Publik**: Tampilan produk berdasarkan kategori dan pencarian.
-   **Alur Pemesanan**:
    -   Halaman detail produk.
    -   Form pemesanan interaktif (pemilihan ukuran, kuantitas).
    -   Aplikasi kode promo secara real-time.
    -   Pengisian data pelanggan.
    -   Halaman review dan konfirmasi pembayaran.
-   **Manajemen Transaksi**: Admin dapat melihat dan menyetujui transaksi yang masuk.
-   **Manajemen Pengguna**: Pembuatan akun admin melalui command line.

---

## Tutorial Instalasi dan Setup

Berikut adalah panduan untuk menjalankan proyek ini di lingkungan pengembangan lokal.

### Prasyarat

-   Server lokal (misalnya: Laragon, XAMPP, Herd)
-   PHP 8.2 atau lebih tinggi
-   Composer
-   Node.js & NPM

### Langkah-langkah Instalasi

1.  **Clone Repository**

    ```bash
    git clone https://github.com/username/project_uas.git
    cd project_uas
    ```

2.  **Install Dependensi**

    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**

    -   Salin file `.env.example` menjadi `.env`.
        ```bash
        copy .env.example .env
        ```
    -   Buka file `.env` dan sesuaikan konfigurasi database:
        ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=sepatu_pahri
        DB_USERNAME=root
        DB_PASSWORD=
        ```
    -   Pastikan `APP_URL` sesuai dengan server lokal Anda.
        ```
        APP_URL=http://127.0.0.1:8000
        ```

4.  **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi Database**
    Perintah ini akan membuat semua tabel yang dibutuhkan di dalam database Anda.

    ```bash
    php artisan migrate
    ```

6.  **Buat Symbolic Link untuk Storage**
    Ini sangat penting agar file yang diunggah (seperti logo merek dan bukti pembayaran) dapat diakses dari web.

    ```bash
    php artisan storage:link
    ```

7.  **Build Aset Frontend**
    Perintah ini akan meng-compile file Tailwind CSS Anda.

    ```bash
    npm run dev
    ```

8.  **Buat Akun Admin**
    Jalankan perintah berikut dan ikuti instruksi di terminal untuk membuat pengguna admin pertama Anda.

    ```bash
    php artisan make:filament-user
    ```

9.  **Jalankan Server Pengembangan**
    ```bash
    php artisan serve
    ```

---

## Akses Aplikasi

-   **Halaman Depan (Frontend)**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
-   **Panel Admin (Backend)**: [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)

---

## Struktur Proyek

Berikut adalah beberapa direktori penting dalam proyek ini:

-   `app/Filament/Resources`: Berisi semua logika untuk panel admin (tabel, form, wizard).
-   `app/Http/Controllers`: Mengatur logika HTTP request dasar.
-   `app/Http/Requests`: Berisi kelas-kelas validasi untuk form.
-   `app/Livewire`: Berisi komponen interaktif yang digunakan di frontend, seperti form pemesanan.
-   `app/Models`: Definisi Eloquent ORM untuk setiap tabel.
-   `app/Repositories`: Pola Repository untuk memisahkan logika query database.
-   `app/Services`: Berisi logika bisnis yang lebih kompleks, seperti proses pemesanan.
-   `database/migrations`: Skema struktur database.
-   `resources/views`: Berisi semua file Blade template, termasuk untuk `livewire` dan halaman `order`.
-   `routes/web.php`: Mendefinisikan semua rute web untuk aplikasi.

---

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
