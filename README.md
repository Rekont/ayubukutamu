# 🌟 AyuBukuTamu - Smart Digital Guest Book System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

**AyuBukuTamu** adalah aplikasi buku tamu digital premium berbasis *QR Code* yang dirancang untuk menggantikan buku tamu fisik pada acara pernikahan, seminar, maupun event perusahaan. Aplikasi ini menawarkan pengalaman tamu yang instan dan elegan, serta memberikan kemudahan bagi panitia dalam memantau kehadiran secara *real-time*.

---

## ✨ Fitur Unggulan (Premium Features)

- 📱 **QR Code Check-in:** Generate QR Code unik untuk setiap event. Mendukung cetak langsung (A4) dan download resolusi tinggi (PNG).
- ✍️ **Digital Signature:** Tamu dapat menggambar tanda tangan langsung dari layar *smartphone* mereka.
- 🚀 **Real-time Dashboard:** Pantau jumlah tamu masuk, grafik tren jam kedatangan, dan tabel kehadiran secara langsung (Live) tanpa perlu *refresh* halaman.
- 💬 **WhatsApp & Email Gateway:** Terintegrasi dengan **Fonnte API**. Otomatis mengirimkan pesan ucapan terima kasih dan *Digital ID Badge* (PDF) ke WhatsApp tamu detik itu juga!
- 📊 **Export to Excel:** Rekapitulasi data kehadiran tamu dalam format `.xlsx` dengan satu klik.
- 🎨 **Premium UI/UX:** Antarmuka yang sangat estetik, responsif di semua perangkat (Desktop/Mobile), dan menggunakan *split-card layout* yang modern.

---


## 🛠️ Persyaratan Sistem (Prerequisites)

Sebelum menginstal aplikasi ini, pastikan server atau komputer Anda sudah terpasang:
- **PHP** >= 8.2
- **Composer** (PHP Package Manager)
- **Node.js & NPM**
- **MySQL** atau MariaDB

---

## 🚀 Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah berikut untuk menjalankan **AyuBukuTamu** di komputer/server lokal Anda:

1. **Clone Repository**
   ```bash
   git clone [https://github.com/Rekont/ayubukutamu.git](https://github.com/Rekont/ayubukutamu.git)
   cd ayubukutamu
2. **Install Dependencies PHP & JavaScript**
   ```bash
   composer install
   npm install
   npm run build
3. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   Buka file .env dan atur koneksi database Anda:
    Cuplikan kode
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
4. **Generate Application Key & Storage Link**
   ```bash
   php artisan key:generate
   php artisan storage:link
5. **Migrasi Databas**
   ```bash
   php artisan migrate
6. **Konfigurasi Notifikasi (WhatsApp & Email)**
    Tambahkan Token Fonnte dan konfigurasi SMTP Gmail Anda di file .env:

    Cuplikan kode
    ```bash
    FONNTE_TOKEN=masukkan_token_fonnte_anda_disini
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=465
    MAIL_USERNAME=email_anda@gmail.com
    MAIL_PASSWORD=sandi_aplikasi_gmail_anda
    MAIL_ENCRYPTION=ssl
    MAIL_FROM_ADDRESS=email_anda@gmail.com
    MAIL_FROM_NAME="AyuBukuTamu"
8. **Jalankan Aplikasi**
   ```bash
   npm run dev
   php artisan serve
   ---
