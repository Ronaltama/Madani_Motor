# 🚀 MADANI MOTOR - FILE-FILE YANG SUDAH DIBUAT & DIPERBAIKI

## ✅ YANG SUDAH SELESAI

### 1. Backend (100% SELESAI)

✅ **Migration** - Semua benar, TIDAK PERLU UBAH
✅ **Models** - ReviewTestimoni diperbaiki (tanpa id_mobil)
✅ **Controllers** - Semua CRUD lengkap:

-   DashboardController ✅
-   ProductController ✅
-   ReviewController ✅ (diperbaiki tanpa id_mobil)
-   LogAktivitasController ✅
-   AuthController ✅
-   HomeController ✅

✅ **Routes** - Lengkap untuk Admin & Guest

### 2. Frontend yang Sudah Dibuat/Diperbaiki

✅ `resources/js/app.js` - Updated dengan progress color #BB0102
✅ `resources/js/Layouts/AdminLayout.vue` - **BARU! Sesuai desain**
✅ `resources/js/Pages/Admin/Dashboard/Index.vue` - **DIPERBAIKI! Koneksi database + styling**
✅ `resources/js/Pages/Auth/Login.vue` - Sudah ada

---

## 📝 FILE YANG PERLU DIBUAT MANUAL

Karena terlalu banyak file Vue yang harus dibuat (20+ files), berikut daftar lengkapnya dengan template kode:

### A. LAYOUTS

#### 1. PublicLayout.vue

Lokasi: `resources/js/Layouts/PublicLayout.vue`

```vue
<template>
    <div class="min-h-screen bg-white">
        <Navbar />
        <main class="mt-20">
            <slot />
        </main>
        <Footer />
    </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";
</script>
```

---

### B. ADMIN PAGES

#### 2. Products/Index.vue

Lokasi: `resources/js/Pages/Admin/Products/Index.vue`

**Fitur:** Tabel produk, button Tambah, Edit, Hapus, Detail

```vue
<template>
    <Head title="Manajemen Produk" />

    <AdminLayout>
        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold">Manajemen Produk</h2>
                <Link
                    :href="route('admin.products.create')"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg"
                >
                    Tambah produk baru
                </Link>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                            >
                                ID
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                            >
                                MEREK
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                            >
                                VARIAN
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                            >
                                NAMA MOBIL
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                            >
                                MASA BERLAKU
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"
                            >
                                ACTION
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="mobil in mobils.data" :key="mobil.id_mobil">
                            <td class="px-6 py-4">
                                {{ String(mobil.id_mobil).padStart(5, "0") }}
                            </td>
                            <td class="px-6 py-4">{{ mobil.merek }}</td>
                            <td class="px-6 py-4">{{ mobil.varian }}</td>
                            <td class="px-6 py-4">{{ mobil.nama_mobil }}</td>
                            <td class="px-6 py-4">{{ mobil.tahun }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <Link
                                    :href="
                                        route(
                                            'admin.products.show',
                                            mobil.id_mobil
                                        )
                                    "
                                    class="text-blue-600 hover:text-blue-800"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                        />
                                    </svg>
                                </Link>
                                <Link
                                    :href="
                                        route(
                                            'admin.products.edit',
                                            mobil.id_mobil
                                        )
                                    "
                                    class="text-yellow-600 hover:text-yellow-800"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                        />
                                    </svg>
                                </Link>
                                <button
                                    @click="deleteMobil(mobil.id_mobil)"
                                    class="text-red-600 hover:text-red-800"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div
                    class="px-6 py-4 border-t flex justify-between items-center"
                >
                    <div class="text-sm text-gray-700">
                        Showing {{ mobils.from }} to {{ mobils.to }} of
                        {{ mobils.total }}
                    </div>
                    <div class="flex gap-2">
                        <Link
                            v-for="link in mobils.links"
                            :key="link.label"
                            :href="link.url"
                            :class="
                                link.active
                                    ? 'bg-blue-500 text-white'
                                    : 'bg-white text-gray-700'
                            "
                            class="px-3 py-1 rounded border"
                            v-html="link.label"
                        >
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineProps({
    mobils: Object,
});

const deleteMobil = (id) => {
    if (confirm("Yakin ingin menghapus mobil ini?")) {
        router.delete(route("admin.products.destroy", id));
    }
};
</script>
```

#### 3. Reviews/Index.vue

Similar dengan Products/Index tapi untuk review

#### 4. LogAktivitas/Index.vue

Similar dengan tabel products tapi untuk log aktivitas

---

### C. PUBLIC PAGES (dari madani-motor-frontend)

Langkah copy manual:

1. **Copy komponen dari `madani-motor-frontend/src/components`:**

    - CardMobil.vue → `resources/js/components/CardMobil.vue`
    - CompareBox.vue → `resources/js/components/CompareBox.vue`
    - ImageSlider.vue → `resources/js/components/ImageSlider.vue`
    - MobilPilihan.vue → `resources/js/components/MobilPilihan.vue`

2. **Copy store:**

    - compareStore.js → `resources/js/stores/compareStore.js`

3. **Ubah semua:**
    - `router-link` → `<Link :href="route(...)">`
    - `@router.push` → `router.visit(route(...))`
    - Import dari Vue Router → Import dari Inertia
    - Data dummy → Data dari props

---

## 🎯 CARA TERCEPAT MENYELESAIKAN

### Opsi 1: Saya Buatkan Bertahap (RECOMMENDED)

Beri tahu file mana yang ingin saya buatkan lebih dulu:

1. Admin CRUD Pages (Products, Reviews, Log)
2. Public Pages (Home, Cars, Detail, Compare)
3. Components pendukung

### Opsi 2: Anda Copy Manual

Gunakan template di atas dan PANDUAN_SETUP_LENGKAP.md

---

## 🔑 YANG PALING PENTING SEKARANG

**Untuk test apakah sudah jalan:**

1. Setup database & migration

```bash
php artisan migrate:fresh
php artisan tinker
>>> User::create(['nama' => 'AdminT', 'email' => 'admin@madani.com', 'password' => bcrypt('password123')])
```

2. Test Login Admin

```
URL: http://localhost:8000/login
Email: admin@madani.com
Password: password123
```

3. Jika berhasil login → akan redirect ke `/admin/dashboard`
4. Dashboard akan tampil dengan data dari database ✅

**File mana yang ingin saya buatkan terlebih dahulu?**
A. Admin CRUD (Products Index/Create/Edit, Reviews, Log)
B. Public Pages (Home, Cars List, Detail, Compare)
C. Components (CardMobil, ImageSlider, dll)

Atau langsung semua sekaligus dalam batch besar?
