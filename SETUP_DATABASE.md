# 🚀 PANDUAN SETUP DATABASE MADANI MOTOR - DARI AWAL

## ✅ LANGKAH 1: BUAT DATABASE

**Buka MySQL di Laragon:**
1. Klik kanan icon Laragon di system tray
2. Pilih **MySQL** → **Open**
3. Atau buka browser ke: `http://localhost/phpmyadmin`

**Buat Database Baru:**
```sql
CREATE DATABASE madani_motor_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**ATAU via Command Line:**
```bash
# Buka terminal di Laragon
mysql -u root

# Jalankan query:
CREATE DATABASE madani_motor_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

---

## ✅ LANGKAH 2: CEK .ENV FILE

Pastikan file `.env` sudah benar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=madani_motor_management
DB_USERNAME=root
DB_PASSWORD=
```

**PENTING:** 
- `DB_PASSWORD=` (kosong, karena Laragon default passwordnya kosong)
- `DB_DATABASE=madani_motor_management` (sesuai nama database)

---

## ✅ LANGKAH 3: JALANKAN MIGRATION

**Buka terminal di folder project**, lalu jalankan:

```bash
# Jalankan migration (buat semua tabel)
php artisan migrate

# Atau kalau mau fresh (hapus semua tabel lama dulu):
php artisan migrate:fresh
```

**Output yang benar:**
```
Migration table created successfully.
Migrating: 0001_01_01_000000_create_users_table
Migrated:  0001_01_01_000000_create_users_table
Migrating: 0001_01_01_000001_create_cache_table
Migrated:  0001_01_01_000001_create_cache_table
Migrating: 0001_01_01_000002_create_jobs_table
Migrated:  0001_01_01_000002_create_jobs_table
Migrating: 2025_10_21_034236_create_mobils_table
Migrated:  2025_10_21_034236_create_mobils_table
Migrating: 2025_10_21_034242_create_spesifikasi_mobils_table
Migrated:  2025_10_21_034242_create_spesifikasi_mobils_table
Migrating: 2025_10_21_034249_create_foto_mobils_table
Migrated:  2025_10_21_034249_create_foto_mobils_table
Migrating: 2025_10_21_034256_create_review_testimonis_table
Migrated:  2025_10_21_034256_create_review_testimonis_table
Migrating: 2025_10_21_034305_create_log_aktivitas_table
Migrated:  2025_10_21_034305_create_log_aktivitas_table
```

---

## ✅ LANGKAH 4: ISI DATA DUMMY (SEEDER)

**Kalau ada seeder**, jalankan:

```bash
php artisan db:seed
```

**ATAU gabung dengan migrate (fresh + seed):**

```bash
php artisan migrate:fresh --seed
```

---

## ✅ LANGKAH 5: BUAT ADMIN USER

**Manual via Tinker:**

```bash
php artisan tinker
```

Lalu ketik:

```php
\App\Models\User::create([
    'name' => 'Admin Madani',
    'email' => 'admin@madani.com',
    'password' => bcrypt('password123'),
    'role' => 'admin'
]);
```

Tekan **Ctrl+C** untuk keluar dari tinker.

---

## ✅ LANGKAH 6: INSTALL DEPENDENCIES

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Install Pinia & Swiper (untuk frontend)
npm install pinia swiper
```

---

## ✅ LANGKAH 7: JALANKAN APLIKASI

**Terminal 1 - Laravel:**
```bash
php artisan serve
```

**Terminal 2 - Vite (Frontend):**
```bash
npm run dev
```

**Buka browser:**
- Frontend: `http://localhost:8000`
- Admin Login: `http://localhost:8000/login`

**Login Admin:**
- Email: `admin@madani.com`
- Password: `password123`

---

## 🔥 TROUBLESHOOTING

### ❌ ERROR: "Access denied for user 'root'@'localhost'"

**Solusi:**
1. Pastikan Laragon MySQL sudah running
2. Cek password di `.env` (harusnya kosong)
3. Test koneksi:
```bash
php artisan db:show
```

### ❌ ERROR: "Base table or view not found"

**Solusi:**
```bash
# Hapus dan buat ulang semua tabel
php artisan migrate:fresh

# Atau dengan seeder:
php artisan migrate:fresh --seed
```

### ❌ ERROR: "SQLSTATE[HY000] [1049] Unknown database"

**Solusi:**
Database belum dibuat! Ulangi **LANGKAH 1**.

### ❌ MIGRATION MERAH DI VSCODE

**Penyebab:** Hanya warning dari PHP Intelephense, bukan error!

**Solusi:** Abaikan saja atau disable Intelephense warnings:
1. File → Preferences → Settings
2. Cari: `intelephense.diagnostics`
3. Uncheck `Undefined types`

---

## 📝 STRUKTUR DATABASE YANG AKAN DIBUAT

```
madani_motor_management
├── users (admin & user)
├── cache (Laravel cache)
├── jobs (Laravel queue)
├── mobils (data mobil: merk, model, tahun, harga)
├── spesifikasi_mobils (detail: transmisi, km, warna, dll)
├── foto_mobils (galeri foto mobil)
├── review_testimonis (testimoni pelanggan)
└── log_aktivitas (log aktivitas admin)
```

---

## ✅ SETELAH SETUP SELESAI

1. Upload gambar slider ke `public/images/sliders/`
2. Upload foto mobil ke `public/images/mobils/`
3. Login ke admin panel
4. Tambah data mobil
5. Test halaman public

---

**DONE! Database siap dipakai! 🎉**
