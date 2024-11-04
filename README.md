
# Mini Project Laravel "Sistem Penilaian Siswa"

Berikut ini dokumentasi pengerjaan pembuatan proyek "Sistem Penilaian Siswa" menggunakan Laravel

### 1. Pembuatan Kerangka Kerja Proyek Dengan Laravel
#### Membuat kerangka kerja Laravel
Menjalankan perintah di terminal dengan menggunakan composer

```bash
  composer create-project laravel/laravel sistem-penilaian-siswa
```

### 2. Pembuatan Database MySql Baru penilaian_siswa

#### Membuka Database MySql dari Terminal

```bash
  mysql -u root -p -P 3306 -h 127.0.0.1
```

#### Membuat Database Baru penilaian_siswa
```bash
CREATE DATABASE penilaian_siswa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
#### Edit Environment Development Laravel
Memberitahu Laravel bahwa kita menggunakan database MySql, nama database, username, dan password di MySql

Direktori:
sistem-penilaian-siswa/.env

```javascript
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=penilaian_siswa
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migrasi Database

#### Migrasi Database melalui Terminal
```bash
php artisan migrate
```
Akan muncul 9 tabel baru hasil migrasi database
```bash
+---------------------------+
| Tables_in_penilaian_siswa |
+---------------------------+
| cache                     |
| cache_locks               |
| failed_jobs               |
| job_batches               |
| jobs                      |
| migrations                |
| password_reset_tokens     |
| sessions                  |
| users                     |
+---------------------------+
9 rows in set (0.00 sec)
```

![Screenshot (24)](https://github.com/user-attachments/assets/3cf312db-5ec8-4d81-8e58-cb1f1f3044fc)
