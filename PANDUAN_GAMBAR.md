# Panduan Penempatan Gambar di Laravel + Vue + Inertia

## 📁 Struktur Folder Gambar

### 1. **Gambar Statis (Hero, Icons, Logo, dll)**

**Lokasi:** `public/images/`

**Contoh:**

```
public/
  images/
    hero-car.png          ← Gambar hero utama
    family.png            ← Gambar keluarga
    logo.png              ← Logo website
    icon-car.svg          ← Icon mobil
```

**Cara Pakai di Vue:**

```vue
<img src="/images/hero-car.png" alt="Hero Car">
```

**Penjelasan:**

-   `/images/hero-car.png` akan langsung mengambil dari `public/images/hero-car.png`
-   Tidak perlu build/compile
-   Bisa langsung diakses via browser: `http://localhost:8000/images/hero-car.png`

---

### 2. **Gambar Upload User (Foto Mobil, Foto Review, dll)**

**Lokasi:** `storage/app/public/`

**Contoh:**

```
storage/
  app/
    public/
      mobils/              ← Foto mobil yang di-upload
        full_body/
        depan/
        belakang/
      reviews/             ← Foto review pelanggan
```

**Setup Awal (WAJIB):**

```bash
php artisan storage:link
```

**Cara Pakai di Vue:**

```vue
<img :src="`/storage/${mobil.foto.full_body}`" alt="Mobil">
```

**Penjelasan:**

-   File di `storage/app/public/` akan di-link ke `public/storage/`
-   Jadi `/storage/mobils/xxx.jpg` = `storage/app/public/mobils/xxx.jpg`
-   Untuk upload user menggunakan Laravel Storage

---

### 3. **Gambar di resources (untuk di-bundle Vite)** ❌ TIDAK RECOMMENDED

**Lokasi:** `resources/images/`

**Cara Pakai:**

```vue
<script setup>
import heroImage from "@/images/hero-car.png";
</script>

<template>
    <img :src="heroImage" alt="Hero" />
</template>
```

**Penjelasan:**

-   Gambar akan di-bundle oleh Vite
-   File size jadi besar
-   Build time lebih lama
-   **TIDAK RECOMMENDED** kecuali untuk component library

---

## ✅ Best Practice Madani Motor

### Gambar Statis Website

**Taruh di:** `public/images/`

**File yang harus ada:**

```
public/images/
  ✅ hero-car.png          (Banner utama homepage)
  ✅ family.png            (Gambar keluarga bahagia)
  ✅ logo.png              (Logo Madani Motor)
  ✅ placeholder-car.jpg   (Placeholder jika mobil belum ada foto)
```

### Gambar Upload Mobil

**Taruh di:** `storage/app/public/mobils/`

**Controller Upload Example:**

```php
use Illuminate\Support\Facades\Storage;

public function store(Request $request)
{
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('mobils/full_body', 'public');
        // $path = 'mobils/full_body/xxx.jpg'

        FotoMobil::create([
            'id_mobil' => $mobilId,
            'full_body' => $path,
        ]);
    }
}
```

**Vue Component:**

```vue
<img :src="`/storage/${mobil.foto.full_body}`">
```

---

## 🚀 Langkah Setup

1. **Buat folder untuk gambar statis:**

```bash
# Sudah dibuat otomatis
public/images/
```

2. **Link storage untuk upload:**

```bash
php artisan storage:link
```

3. **Copy gambar Anda:**

-   Copy `hero-car.png` ke `public/images/hero-car.png`
-   Copy `family.png` ke `public/images/family.png`
-   Copy `logo.png` ke `public/images/logo.png`

4. **Test akses gambar:**

-   Buka browser: `http://localhost:8000/images/hero-car.png`
-   Jika muncul gambar = SUKSES ✅

---

## 🎯 Ringkasan

| Jenis Gambar            | Lokasi                | Path di Vue                          | Contoh                              |
| ----------------------- | --------------------- | ------------------------------------ | ----------------------------------- |
| **Statis (Hero, Logo)** | `public/images/`      | `/images/xxx.png`                    | `<img src="/images/logo.png">`      |
| **Upload User**         | `storage/app/public/` | `/storage/xxx.jpg`                   | `<img :src="\`/storage/${path}\`">` |
| **Asset Build**         | `resources/images/`   | `import img from '@/images/xxx.png'` | ❌ Tidak recommended                |

---

## 📝 Catatan Penting

✅ **DO:**

-   Gunakan `public/images/` untuk semua gambar statis
-   Gunakan `storage/app/public/` untuk upload user
-   Jalankan `php artisan storage:link` sebelum test upload

❌ **DON'T:**

-   Jangan taruh gambar besar di `resources/images/`
-   Jangan hardcode path lengkap seperti `C:/laragon/...`
-   Jangan lupa jalankan storage:link

---

**Status Saat Ini:**

-   ✅ Folder `public/images/` sudah dibuat
-   ⏳ Anda perlu copy file gambar ke folder tersebut
-   ⏳ Jalankan `php artisan storage:link` untuk upload feature
