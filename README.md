# SILKOM - Sistem Informasi Laboratorium Komputer

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-0EA5A4?style=for-the-badge&logo=alpinejs&logoColor=white)
![Chart.js](https://img.shields.io/badge/Chart.js-4.x-FF6384?style=for-the-badge&logo=chartdotjs)

**SILKOM** adalah aplikasi web manajemen laboratorium yang dirancang sebagai Proyek *Project-Based Learning* (PBL) untuk mata kuliah Praktikum Manajemen Sistem Informasi.

Aplikasi ini mengimplementasikan konsep-konsep sistem informasi fundamental, termasuk TPS, OAS, KMS, MIS, dan EIS, untuk mengelola aset, memantau aktivitas, dan menyediakan laporan strategis untuk manajemen laboratorium komputer.

---

## 🏛️ Konsep Sistem
Aplikasi ini dibangun di atas lima pilar sistem informasi:

1.  **TPS (Transaction Processing System):** Mencatat semua transaksi harian, seperti peminjaman aset, pelaporan kerusakan, dan log penggunaan komputer.
2.  **OAS (Office Automation System):** Mengotomatiskan komunikasi, seperti mengirim notifikasi email untuk persetujuan dan membuat alur pengajuan alat baru.
3.  **KMS (Knowledge Management System):** Sebagai pusat pengetahuan, mengelola panduan, prosedur perbaikan, dan dokumentasi teknis.
4.  **MIS (Management Information System):** Menyediakan laporan terfilter untuk manajer (Admin/Staff) guna menganalisis tren, seperti aset yang sering rusak atau pengguna paling aktif.
5.  **EIS (Executive Information System):** Menyediakan *dashboard* visual (grafik) untuk Pimpinan guna memantau KPI strategis, seperti biaya perbaikan, nilai aset, dan utilisasi lab.

---

## ✨ Fitur Utama Berdasarkan Peran

Sistem ini memiliki 5 peran dengan hak akses yang berbeda: Publik, Student, Staff, Admin Lab, dan Pimpinan.

### 🌍 Halaman Publik
* Halaman *Landing Page*.
* Halaman **Katalog Aset** (Read-only untuk melihat aset yang tersedia).
* Halaman **Panduan (KMS)** (Read-only untuk melihat panduan umum).

### 👨‍🎓 Mahasiswa (Student)
* Registrasi akun baru (dengan data NIM, Jurusan, Fakultas).
* Login dan *role-based redirect*.
* **Dashboard Student:** Melihat KPI pribadi (peminjaman pending/aktif) dan pintasan.
* **Manajemen Profil:** Mengedit data pribadi, data akademik (NIM, Jurusan), dan mengganti password.
* **Peminjaman Aset:** Membuat permintaan peminjaman aset (selain komputer) dan membatalkannya jika masih *pending*.
* **Riwayat:** Melihat riwayat peminjaman dan riwayat penggunaan komputer pribadi.

### 👩‍💼 Staff
* Login dan *role-based redirect*.
* **Dashboard Staff:** Melihat KPI kondisi lab (aset tersedia/rusak) dan pintasan aksi.
* **Manajemen Log Komputer (TPS):** Mencatat sesi penggunaan komputer (memilih mahasiswa, komputer, dan waktu mulai).
* **Manajemen Sesi:** Menandai sesi penggunaan komputer sebagai "Selesai" (mengubah status aset kembali ke "Available") dan menghapus log.
* **Pengajuan Alat Baru (OAS):** Membuat, mengedit, dan menghapus pengajuan alat baru yang masih *pending*.
* **Laporan (MIS):** Mengakses halaman laporan untuk menganalisis data.
* **KMS (Read-only):** Mengakses dan membaca dokumen KMS.

### 🛠️ Admin Lab (Admin)
* **Dashboard Admin:** *Dashboard* paling fungsional dengan KPI tugas (pending approval) dan tabel aksi cepat.
* **Manajemen Pengguna (Full CRUD):** Membuat, mengedit, dan menghapus akun Staff dan Mahasiswa, termasuk mengelola data profil mereka.
* **Manajemen Aset (Full CRUD):** Mengelola semua aset laboratorium, termasuk mengunggah gambar dan harga beli (untuk EIS).
* **Manajemen Kerusakan (Full CRUD):** Mencatat laporan kerusakan, mengunggah foto bukti, dan memperbarui status/biaya perbaikan (untuk EIS).
* **Manajemen KMS (Full CRUD):** Membuat, mengedit, dan menghapus dokumen panduan menggunakan *rich text editor* (TinyMCE).
* **Alur Persetujuan Peminjaman:** Menerima, menyetujui, dan menolak permintaan peminjaman dari Mahasiswa (dengan notifikasi email otomatis).
* **Alur Persetujuan Pengajuan Alat:** Menerima, menyetujui, dan menolak pengajuan alat baru dari Staff (dengan notifikasi email otomatis).
* **Laporan (MIS):** Mengakses halaman laporan lengkap.

### 📈 Pimpinan (Lead)
* Login dan *role-based redirect*.
* **Dashboard EIS (Full Visual):**
    * Melihat KPI Finansial (Total Nilai Aset, Total Biaya Perbaikan).
    * Melihat Grafik Donat (Ringkasan Kesehatan Aset: Tersedia, Dipinjam, Rusak).
    * Melihat Grafik Garis Ganda (Tren Biaya Perbaikan vs. Utilisasi Lab 6 bulan terakhir).
    * Melihat Grafik Batang (Top 5 Aset Sering Rusak & Top 5 Aset Sering Dipinjam).
* **Drill-Down:** Kemampuan untuk mengklik elemen *dashboard* dan diarahkan ke Halaman Laporan (MIS) untuk melihat data detailnya.

---

## 🛠️ Tumpukan Teknologi (Tech Stack)

* **Framework:** Laravel 12
* **Frontend:** Blade & Tailwind CSS
* **Database:** MySQL
* **Autentikasi:** Laravel Breeze
* **Manajemen Peran:** `spatie/laravel-permission`
* **Email (OAS):** Laravel Mail dengan driver SMTP Google
* **Editor Teks (KMS):** TinyMCE (Cloud)
* **Visualisasi Data (EIS):** Chart.js
* **Deployment:** XAMPP

---

## 🚀 Panduan Instalasi Lokal

1.  **Clone Repositori**
    ```bash
    git clone https://github.com/RizalHaryaputra/SILKOM.git
    cd silkom
    ```

2.  **Instal Dependensi**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment (.env)**
    * Salin `.env.example` menjadi `.env`:
        ```bash
        cp .env.example .env
        ```
    * Jalankan `php artisan key:generate`.
    * Konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
    * Konfigurasi **SMTP Google** untuk email:
        ```env
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.gmail.com
        MAIL_PORT=587
        MAIL_USERNAME=email-gmail-anda@gmail.com
        MAIL_PASSWORD=password-aplikasi-google-anda
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS="${MAIL_USERNAME}"
        MAIL_FROM_NAME="${APP_NAME}"
        ```

4.  **Migrasi dan Seeding (Sangat Penting)**
    * Jalankan perintah ini untuk membuat semua tabel dan mengisi *role*, *permission*, dan akun admin *default*.
    ```bash
    php artisan migrate:fresh --seed
    ```

5.  **Konfigurasi Lainnya**
    * Buat *link* penyimpanan:
        ```bash
        php artisan storage:link
        ```
    * Daftarkan domain `localhost` di *dashboard* TinyMCE Anda untuk menghapus *warning* API key.

6.  **Jalankan Aplikasi**
    * Jalankan *compiler* Vite:
        ```bash
        npm run dev
        ```
    * Di terminal lain, jalankan server:
        ```bash
        php artisan serve
        ```
    * Aplikasi sekarang berjalan di `http://127.0.0.1:8000`.

---

## 🔑 Akun Default

Semua akun *default* yang dibuat oleh `UserSeeder` menggunakan *password*: **`password`**

* **Pimpinan (Lead):** `pimpinan@lab.com`
* **Admin Lab:** `admin@lab.com`
* **Staff:** `staff@lab.com`
* **Mahasiswa (Student):** (Gunakan akun tim Anda atau buat baru melalui halaman registrasi)
    * `rizal.23051130013@student.uny.ac.id`
    * `nabila.23051130020@student.uny.ac.id`
    * (dan akun tim lainnya...)

---

## 👨‍💻 Tim Pengembang (MSI.pdf)

* **Rizal Haryaputra** (23051130013)
* **Nabila Putri Aulaya Syifa** (23051130020)
* **Rigel Nadimaisy A.** (23051130024)
* **Rajendriya D.** (23051130010)
