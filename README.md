<div align="center">

# 🤖 Sistem Diagnosa HP Menggunakan Metode Forward Chaining

<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
<img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5">
<img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">

**Sistem Aplikasi Web Berbasis Kecerdasan Buatan**

[Demo](#demo) • [Fitur](#fitur) • [Instalasi](#instalasi) • [Penggunaan](#penggunaan) 

</div>
---

## 🎯 Tentang Proyek

Proyek ini merupakan implementasi aplikasi web berbasis kecerdasan buatan yang dikembangkan menggunakan PHP dan HTML. Aplikasi ini dirancang untuk memberikan solusi cerdas dengan antarmuka yang user-friendly dan responsif, mendukung tema gelap dan terang.

### ✨ Tujuan Proyek

- Mengimplementasikan konsep kecerdasan buatan dalam aplikasi web
- Menyediakan sistem yang mudah digunakan dan intuitif
- Menampilkan hasil analisis dengan visualisasi yang menarik
- Menyimpan riwayat aktivitas untuk tracking dan evaluasi

---

## 🚀 Fitur Utama

### 🎨 Interface & Design
- ✅ **Dual Theme Support** - Mode gelap dan terang untuk kenyamanan mata
- ✅ **Responsive Design** - Tampilan optimal di berbagai perangkat
- ✅ **Modern UI** - Antarmuka yang bersih dan modern

### 💾 Functionality
- ✅ **Sistem Hasil** - Menampilkan dan mengolah hasil analisis
- ✅ **Riwayat Data** - Menyimpan dan mengelola history aktivitas
- ✅ **Manajemen Data** - Fitur hapus untuk pengelolaan data
- ✅ **Database Integration** - Koneksi database yang aman dan efisien

### 🔧 Technical Features
- ✅ **PHP Backend** - Server-side processing yang handal
- ✅ **MySQL Database** - Penyimpanan data yang terstruktur
- ✅ **Modular Architecture** - Struktur kode yang mudah dikembangkan

---

## 🛠️ Teknologi

Proyek ini dibangun dengan teknologi-teknologi berikut:

| Teknologi | Deskripsi | Versi |
|-----------|-----------|-------|
| ![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white) | Backend Server | 7.4+ |
| ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white) | Markup Language | 5 |
| ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white) | Database | 5.7+ |
| ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white) | Styling | 3 |

---

## 📁 Struktur Proyek

```
Sistem-Diagnosa-HP-Menggunakan-Metode-Forward-Chaining/
│
├── 📄 index.html          # Halaman utama aplikasi
├── 📄 config.php          # Konfigurasi database dan sistem
├── 📄 hasil.php           # Halaman menampilkan hasil
├── 📄 riwayat.php         # Halaman riwayat aktivitas
├── 📄 hapus.php           # Script hapus data
│
├── 🖼️ darkbg.jpg          # Background tema gelap
├── 🖼️ lightbg.jpg         # Background tema terang
│
└── 📁 icons/              # Direktori ikon aplikasi
    └── ...
```

---

## 💻 Instalasi

### Prasyarat

Pastikan Anda telah menginstal:
- **PHP** versi 7.4 atau lebih tinggi
- **MySQL** atau **MariaDB**
- **Web Server** (Apache/Nginx)
- **Browser** modern (Chrome, Firefox, Edge)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/cesyaaulia/Proyek-Kecerdasan-Buatan.git
   cd Proyek-Kecerdasan-Buatan
   ```

2. **Setup Database**
   ```sql
   -- Buat database baru
   CREATE DATABASE db_ai_project;
   
   -- Import struktur database (sesuaikan dengan kebutuhan)
   USE db_ai_project;
   ```

3. **Konfigurasi File**
   
   Edit file `config.php` sesuai dengan environment Anda:
   ```php
   <?php
   // Database Configuration
   $host = "localhost";
   $username = "your_username";
   $password = "your_password";
   $database = "db_ai_project";
   ?>
   ```

4. **Deploy ke Web Server**
   
   - Salin semua file ke direktori web server (htdocs/www)
   - Atau jalankan PHP built-in server:
     ```bash
     php -S localhost:8000
     ```

5. **Akses Aplikasi**
   
   Buka browser dan akses:
   ```
   http://localhost:8000/index.html
   ```
   atau sesuai dengan konfigurasi web server Anda.

---

## ⚙️ Konfigurasi

### File `config.php`

File ini berisi konfigurasi penting untuk aplikasi:

```php
<?php
// Database Settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_ai_project');

// Application Settings
define('APP_NAME', 'AI Project');
define('APP_VERSION', '1.0.0');

// Other configurations...
?>
```

### Environment Variables

Untuk keamanan yang lebih baik, gunakan environment variables untuk konfigurasi sensitif.

---

## 📖 Penggunaan

### 1. Halaman Utama (`index.html`)
- Landing page dengan interface yang menarik
- Akses ke semua fitur utama aplikasi
- Toggle tema gelap/terang

### 2. Halaman Hasil (`hasil.php`)
- Menampilkan output dari proses AI
- Visualisasi data hasil analisis
- Export hasil ke berbagai format

### 3. Riwayat (`riwayat.php`)
- Melihat history aktivitas sebelumnya
- Filter dan pencarian data
- Detail informasi setiap aktivitas

### 4. Manajemen Data (`hapus.php`)
- Hapus data yang tidak diperlukan
- Konfirmasi sebelum penghapusan
- Log aktivitas penghapusan

---

## 📸 Screenshot

<div align="center">

### 🌙 Dark Theme
![Dark Theme Preview] <img width="3580" height="3268" alt="Image" src="https://github.com/user-attachments/assets/011aff42-6cf0-4658-b7ff-43dda0fabe86" />

### ☀️ Light Theme
![Light Theme Preview] <img width="3580" height="3268" alt="Image" src="https://github.com/user-attachments/assets/b7196e99-c100-4c03-bd81-2a8abea23f66" />

</div>

---
