# 📚 Sistem Perpustakaan Laravel

Aplikasi manajemen perpustakaan berbasis Laravel untuk mengelola buku,
anggota, transaksi peminjaman, dan laporan.

![Laravel](https://img.shields.io/badge/Laravel-13-red)
![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple)
![License](https://img.shields.io/badge/License-MIT-green)

## 📖 Deskripsi

Sistem ini dibuat untuk membantu pengelolaan perpustakaan secara digital
mulai dari pendataan buku hingga pengelolaan transaksi peminjaman dan
pengembalian buku.

## ✨ Fitur Utama

- 📚 Manajemen Buku
- 👥 Manajemen Anggota
- 🔄 Peminjaman Buku
- ↩️ Pengembalian Buku
- 💰 Perhitungan Denda Otomatis
- 📊 Dashboard Statistik
- 📄 Laporan PDF
- 🔍 Pencarian Global

## 🖼️ Screenshot

### 🔐 Login
![Login](Screenshot/127.0.0.1_8000_login.png)

### 📊 Dashboard
![Dashboard](Screenshot/127.0.0.1_8000_dashboard.png)

### 📚 Data Buku
![Data Buku](Screenshot/127.0.0.1_8000_buku.png)

### 👥 Data Anggota
![Data Anggota](Screenshot/127.0.0.1_8000_anggota.png)

### 🔄 Data Transaksi
![Data Transaksi](Screenshot/127.0.0.1_8000_transaksi.png)

### ➕ Form Peminjaman Buku
![Form Peminjaman](Screenshot/127.0.0.1_8000_transaksi_create.png)

### 📄 Laporan Transaksi
![Laporan Transaksi](Screenshot/127.0.0.1_8000_transaksi_laporan.png)

### 🔍 Pencarian Data
![Pencarian](Screenshot/127.0.0.1_8000_search_q=Ahmad+Dhani.png)

### 👤 Profil Pengguna
![Profil](Screenshot/127.0.0.1_8000_profile.png)

## ⚙️ Instalasi

Clone repository:

```bash
git clone https://github.com/username/perpustakaan.git
```

Masuk ke folder project:

```bash
cd perpustakaan
```

Install dependency:

```bash
composer install
npm install
```

Copy file environment:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Migrasi database:

```bash
php artisan migrate
```

Jalankan server:

```bash
php artisan serve
```

## 🗄️ Database

| Tabel | Fungsi |
|------|--------|
| buku | Menyimpan data buku |
| anggota | Menyimpan data anggota |
| transaksi | Menyimpan transaksi peminjaman |
| users | Menyimpan data pengguna |

## 📂 Struktur Project

```text
app/
├── Models
├── Http
│   ├── Controllers
│   └── Requests
resources/
├── views
│   ├── buku
│   ├── anggota
│   ├── transaksi
│   └── layouts
routes/
└── web.php
```

## 🛠️ Teknologi

- Laravel 13
- PHP 8.3
- Bootstrap 5
- MySQL
- SweetAlert2
- Chart.js

  ## 👨‍💻 Author

**Zaki Kafila Pamungkas**

- GitHub: https://github.com/11pamungkas
- Email: zaki.kafila24020@mhs.uingusdur.ac.id
