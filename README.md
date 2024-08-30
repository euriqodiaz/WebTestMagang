Dashboard Kursus Online

Author : Euriqo Diaz

Ringkasan
Dashboard Kursus Online adalah aplikasi web yang dirancang untuk mengelola kursus online dan materi terkait. Aplikasi ini mencakup fitur untuk menambah, mengedit, dan melihat kursus serta materi yang terhubung. Selain itu, ada halaman publik di mana pengunjung dapat melihat materi kursus tanpa perlu masuk.

Fitur
Dashboard Admin: Melihat, menambah, dan mengelola kursus dan materi.
Manajemen Materi: Menambah dan melihat materi kursus dengan judul, deskripsi, dan link embed.
Penampilan Publik: Mengakses materi di halaman publik tanpa login.
Memulai
Prasyarat
PHP 7.4 atau lebih tinggi
MySQL 5.7 atau lebih tinggi
Server web seperti Apache atau Nginx
Instalasi
Clone Repository

bash
Salin kode
git clone https://github.com/your-repo/online-course-dashboard.git
cd online-course-dashboard
Siapkan Database

Buat database MySQL dan impor skema SQL yang disediakan pada file yang di upload

-- Tambahkan perintah SQL untuk membuat tabel di sini
Konfigurasi Koneksi Database

Perbarui detail koneksi database di skrip PHP Anda jika diperlukan. Pengaturan saat ini menggunakan kredensial default:

php
Salin kode
$conn = new mysqli('localhost', 'root', '', 'online_course');
Instal Font yang Diperlukan

Pastikan file font yang diperlukan tersedia di direktori font/:

Benguiat Bold.ttf
NewYork.otf
La Gagliane.ttf
Penggunaan
Login Admin
Halaman Login

Akses halaman login dengan membuka login.php. Gunakan kredensial berikut untuk login:

Username: adminganteng
Password: kakgem999

atau anda bisa mengganti username dan password anda sesuai yang anda inginkan


Dashboard

Setelah login, Anda akan diarahkan ke dashboard admin (index.php), di mana Anda dapat:

Melihat Kursus: Melihat daftar kursus dengan opsi untuk melihat, mengedit, atau menghapusnya.
Menambah Kursus Baru: Klik tombol "Add New Course" untuk membuat kursus baru.
Melihat Materi: Untuk setiap kursus, klik "View Materials" untuk mengelola materi yang terkait.
Menambah/Mengedit Materi: Gunakan tombol "Add New Material" untuk menambah materi ke kursus yang dipilih.
Catatan: Anda juga dapat logout dari dashboard.

Halaman Materi Publik

Untuk melihat halaman materi publik:

Login: Pastikan Anda sudah login.
Klik Tombol Materi Publik: Di halaman login, klik tombol "View Public Materials" untuk membuka tampilan publik di tab baru.
Penampilan Publik
Halaman Materi Publik: Dapat diakses di public_materials.php, di mana pengguna dapat melihat semua materi tanpa login. Tampilan publik akan menampilkan materi dengan judul, deskripsi, dan link embed untuk melihatnya.
Pemecahan Masalah
Masalah Koneksi: Pastikan server database Anda berjalan dan dapat diakses dengan kredensial yang benar.
File Hilang: Periksa bahwa semua file font yang diperlukan ada di direktori font/.
Kontak
Untuk masalah atau pertanyaan, silakan hubungi euriqo09@gmail.com.
