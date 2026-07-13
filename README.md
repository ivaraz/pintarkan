# 🎓 PintarKan - Learning Management System (LMS) Modern

<p align="center">
  <strong>Platform Pembelajaran Digital yang Efisien, Interaktif, dan Terintegrasi</strong>
</p>

---

## 📌 Deskripsi Proyek

**PintarKan** adalah aplikasi berbasis web *Learning Management System* (LMS) modern yang dirancang untuk mendigitalkan dan memudahkan interaksi akademik antara **Admin**, **Dosen**, dan **Mahasiswa**. 

Aplikasi ini berfokus pada kemudahan penggunaan (*user experience*), pemantauan progres belajar mahasiswa secara real-time, pengunggahan materi terpadu, serta sistem penilaian tugas yang efisien. PintarKan membantu institusi pendidikan mengelola kelas secara transparan dan responsif.

---

## 🚀 Fitur Utama Berdasarkan Akses Pengguna

### 1. 🛡️ Akses Admin (Administrator)
*   **Dashboard Statistik**: Menampilkan metrik data keseluruhan sistem (jumlah total user, dosen, mahasiswa, mata kuliah, pendaftaran terbaru, dan daftar kelas).
*   **Manajemen Pengguna (CRUD)**: Mengelola akun pengguna (Admin, Dosen, Mahasiswa), informasi profil dasar, dan penentuan hak akses.
*   **Manajemen Mata Kuliah (CRUD)**: Membuat, mengedit, melihat, dan menghapus mata kuliah yang ditawarkan dalam sistem.
*   **Manajemen Pendaftaran (Enrollment)**: Mendaftarkan mahasiswa ke mata kuliah secara manual atau menghapus pendaftaran yang tidak sesuai.

### 2. 👨‍🏫 Akses Dosen (Lecturer)
*   **Dashboard Mengajar**: Statistik ringkas mengenai jumlah mata kuliah yang diampu, total mahasiswa unik, jumlah tugas, dan tugas yang belum dinilai (*pending*).
*   **Pengelolaan Kelas Mandiri**: Mengakses kelas yang diajarkan, melihat rekapitulasi nilai, serta menambah/menghapus mahasiswa terdaftar secara langsung.
*   **Manajemen Materi Pembelajaran (CRUD + Multi-file Upload)**: Membuat materi kuliah dengan dukungan unggah banyak file lampiran sekaligus, serta menghapus file tertentu secara dinamis saat memperbarui materi.
*   **Manajemen Tugas & Penilaian**: Membuat tugas baru lengkap dengan tenggat waktu (*due date*) dan file lampiran, serta menilai hasil pengumpulan tugas mahasiswa dengan skor angka dan umpan balik (*note*).
*   **Pusat Penilaian Terpadu (Unified Grades)**: Halaman khusus untuk memfilter dan memberikan nilai ke semua pengumpulan tugas mahasiswa dari seluruh mata kuliah yang diampu dalam satu tempat.
*   **Pemantauan Progres Belajar Mahasiswa**: Memantau progres belajar mahasiswa secara langsung (persentase materi yang dibaca + tugas yang dikumpulkan).
*   **Ekspor Rekap Laporan PDF**: Mengunduh rekapitulasi nilai kelas mahasiswa secara instan ke format PDF yang rapi (menggunakan DomPDF).

### 3. 🎓 Akses Mahasiswa (Student)
*   **Dashboard Akademik**: Menampilkan daftar mata kuliah aktif, total tugas, tugas yang sudah dinilai, nilai rata-rata, serta daftar tugas aktif terdekat berdasarkan tenggat waktu.
*   **Visual Progress Tracker**: Grafik indikator kemajuan belajar (*progress bar*) visual per mata kuliah yang diperbarui secara real-time setelah mahasiswa mengakses materi pembelajaran dan mengirim tugas.
*   **Akses Materi Kuliah**: Membaca materi, mengunduh file pendukung, dan sistem otomatis mencatat status materi telah dibaca setelah diakses.
*   **Pengumpulan Tugas**: Melihat instruksi tugas, mengunduh lampiran soal dari dosen, dan mengunggah berkas jawaban/hasil tugas sebelum batas waktu selesai.

---

## 🛠️ Arsitektur & Teknologi

Proyek ini dibangun menggunakan teknologi modern untuk menjamin performa yang andal dan antarmuka yang dinamis:

*   **Core Framework**: PHP 8.3+ & Laravel 13.x
*   **Frontend Tools**: Tailwind CSS & Vite
*   **Database**: MySQL / SQLite
*   **Library Utama & Dependensi**:
    *   `spatie/laravel-permission` (Role-Based Access Control / RBAC)
    *   `barryvdh/laravel-dompdf` (Render file laporan menjadi PDF)
    *   `laravel/breeze` (Sistem autentikasi dasar yang minimalis)

---

## 🔑 Kredensial Akun Default (Seeder)

Setelah menjalankan seeder database, Anda dapat masuk ke aplikasi menggunakan akun simulasi berikut (semua akun menggunakan password: **`123`**):

| Role | Email | Password | Keterangan |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@unsur.ac.id` | `123` | Hak akses penuh sistem |
| **Dosen** | `dosen1@unsur.ac.id` s.d `dosen5@unsur.ac.id` | `123` | Akun Dosen Pengampu |
| **Mahasiswa** | `mhs1@unsur.ac.id` s.d `mhs10@unsur.ac.id` | `123` | Akun Mahasiswa Kelas |

---

## 💿 Panduan Instalasi dan Penggunaan

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi PintarKan di komputer lokal Anda:

### 1. Persiapan Awal
Pastikan Anda sudah menginstal **PHP 8.3+**, **Composer**, **Node.js**, dan database server seperti **MySQL/MariaDB** (melalui XAMPP/Laragon).

### 2. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan konfigurasikan koneksi basis data Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pintarkan
DB_USERNAME=root
DB_PASSWORD=
```
> [!IMPORTANT]
> Buat database kosong bernama `pintarkan` di database manager Anda (misalnya phpMyAdmin) sebelum melanjutkan ke langkah berikutnya.

### 3. Setup Project
Jalankan perintah berikut untuk menginstal dependensi PHP dan Javascript, membuat key aplikasi, serta menjalankan migrasi awal:
```bash
composer run setup
```

### 4. Seed Database (Mengisi Data Awal)
Jalankan perintah ini untuk mengisi database dengan data dummy awal (admin, dosen, mahasiswa, mata kuliah, materi, tugas, dan nilai):
```bash
php artisan db:seed
```

### 5. Jalankan Aplikasi
Gunakan perintah pintas untuk menjalankan Laravel Development Server dan compiler Vite secara bersamaan:
```bash
composer run dev
```
Setelah itu, buka browser Anda dan akses tautan: [http://127.0.0.1:8000](http://127.0.0.1:8000).

