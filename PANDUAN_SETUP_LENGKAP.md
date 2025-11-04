# PANDUAN SETUP LENGKAP MADANI MOTOR

## ✅ YANG SUDAH BENAR

### 1. **Database & Migration** ✓

Semua migration sudah benar:

-   `users` (id_admin, nama, email, password)
-   `mobils` (data mobil lengkap)
-   `spesifikasi_mobils` (spesifikasi detail mobil)
-   `foto_mobils` (foto mobil berbagai sudut)
-   `review_testimonis` (review pelanggan - TANPA id_mobil)
-   `log_aktivitas` (log aktivitas admin)

### 2. **Models** ✓

Semua model sudah benar dengan relasi yang tepat

### 3. **Controllers** ✓

-   `DashboardController` - Dashboard admin dengan stats
-   `ProductController` - CRUD produk mobil
-   `ReviewController` - CRUD review (diperbaiki tanpa id_mobil)
-   `LogAktivitasController` - Tampilkan log
-   `AuthController` - Login/Logout admin
-   `HomeController` - Public pages untuk guest

### 4. **Routes** ✓

```php
// PUBLIC (Guest - no login)
/ - Home
/cars - Daftar mobil
/cars/{id} - Detail mobil
/compare - Bandingkan mobil
/reviews - Lihat reviews

// ADMIN (Must login)
/login - Login page
/admin/dashboard - Dashboard
/admin/products - CRUD Produk
/admin/reviews - CRUD Review
/admin/log-aktivitas - Log
/admin/profile - Profile
```

## 🔧 YANG PERLU DIBUAT

### LANGKAH 1: Update app.js

File: `resources/js/app.js`
Pastikan sudah ada route helper:

```javascript
import ".//../css/app.css";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

createInertiaApp({
    title: (title) => `${title} - Madani Motor`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: "#BB0102",
    },
});
```

### LANGKAH 2: Copy Frontend Vue ke resources/js

**Dari `madani-motor-frontend/src` ke `resources/js`:**

1. **Components** (copy semua):

    - `components/CardMobil.vue`
    - `components/CompareBox.vue`
    - `components/Footer.vue`
    - `components/ImageSlider.vue`
    - `components/MobilPilihan.vue`
    - `components/Navbar.vue`

2. **Stores** (copy):

    - `stores/compareStore.js`

3. **Assets** (copy images ke public/images)

### LANGKAH 3: Buat Admin Layout

File: `resources/js/Layouts/AdminLayout.vue`

```vue
<template>
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg fixed h-full overflow-y-auto">
            <div class="p-6 border-b">
                <img
                    src="/images/logo_asli.png"
                    alt="Madani Motor"
                    class="h-10"
                />
            </div>

            <nav class="p-4 space-y-2">
                <Link
                    :href="route('admin.dashboard')"
                    :class="
                        isActive('admin.dashboard')
                            ? 'bg-blue-500 text-white'
                            : 'text-gray-700 hover:bg-gray-100'
                    "
                    class="flex items-center gap-3 px-4 py-3 rounded-lg"
                >
                    <span>🏠</span>
                    <span>Dashboard</span>
                </Link>

                <Link
                    :href="route('admin.log-aktivitas')"
                    :class="
                        isActive('admin.log-aktivitas')
                            ? 'bg-blue-500 text-white'
                            : 'text-gray-700 hover:bg-gray-100'
                    "
                    class="flex items-center gap-3 px-4 py-3 rounded-lg"
                >
                    <span>📋</span>
                    <span>Log Aktivitas</span>
                </Link>

                <Link
                    :href="route('admin.products.index')"
                    :class="
                        isActive('admin.products')
                            ? 'bg-blue-500 text-white'
                            : 'text-gray-700 hover:bg-gray-100'
                    "
                    class="flex items-center gap-3 px-4 py-3 rounded-lg"
                >
                    <span>🚗</span>
                    <span>Manajemen Produk</span>
                </Link>

                <Link
                    :href="route('admin.reviews.index')"
                    :class="
                        isActive('admin.reviews')
                            ? 'bg-blue-500 text-white'
                            : 'text-gray-700 hover:bg-gray-100'
                    "
                    class="flex items-center gap-3 px-4 py-3 rounded-lg"
                >
                    <span>⭐</span>
                    <span>Manajemen Ulasan</span>
                </Link>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 border-t bg-white p-4">
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg"
                >
                    <span>🚪</span>
                    <span>Logout</span>
                </Link>
            </div>
        </aside>

        <div class="flex-1 ml-64">
            <header class="bg-white shadow-sm px-8 py-4">
                <h1 class="text-2xl font-bold">Dashboard</h1>
            </header>
            <main class="p-8">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const isActive = (name) => {
    return route().current(name + ".*") || route().current(name);
};
</script>
```

### LANGKAH 4: Buat Public Layout

File: `resources/js/Layouts/PublicLayout.vue`

```vue
<template>
    <div class="min-h-screen bg-white">
        <Navbar />
        <main>
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

### LANGKAH 5: Buat Halaman Admin

#### Dashboard (`resources/js/Pages/Admin/Dashboard/Index.vue`)

-   Stats cards (Total Produk, Review, Log, Admin)
-   Quick Actions (Tambah Produk, Kelola Review, Lihat Log)
-   Aktivitas Terbaru

#### Manajemen Produk (`resources/js/Pages/Admin/Products/Index.vue`)

-   Tabel produk dengan pagination
-   Button Tambah Produk
-   Actions: Detail, Edit, Hapus

#### Manajemen Review (`resources/js/Pages/Admin/Reviews/Index.vue`)

-   Tabel review dengan pagination
-   Button Tambah Review
-   Actions: Edit, Hapus

#### Log Aktivitas (`resources/js/Pages/Admin/LogAktivitas/Index.vue`)

-   Tabel log dengan pagination
-   Tampilkan admin, aktivitas, tanggal

### LANGKAH 6: Buat Halaman Public (Guest)

#### Home (`resources/js/Pages/Public/Home.vue`)

-   ImageSlider
-   MobilPilihan (dari database)
-   Reviews (dari database)

#### Cars List (`resources/js/Pages/Public/CarsList.vue`)

-   Filter sidebar (harga, transmisi, sort)
-   Grid mobil (dari database)
-   CardMobil component

#### Detail Mobil (`resources/js/Pages/Public/DetailMobil.vue`)

-   Foto mobil
-   Spesifikasi lengkap
-   Button WhatsApp
-   Button Compare

#### Compare (`resources/js/Pages/Public/Compare.vue`)

-   Compare box (max 3 mobil)
-   Side by side comparison

### LANGKAH 7: Buat Auth Page

#### Login (`resources/js/Pages/Auth/Login.vue`)

```vue
<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Login Admin</h2>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="w-full px-4 py-2 border rounded-lg"
                        required
                    />
                    <div
                        v-if="form.errors.email"
                        class="text-red-600 text-sm mt-1"
                    >
                        {{ form.errors.email }}
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="w-full px-4 py-2 border rounded-lg"
                        required
                    />
                    <div
                        v-if="form.errors.password"
                        class="text-red-600 text-sm mt-1"
                    >
                        {{ form.errors.password }}
                    </div>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700"
                >
                    {{ form.processing ? "Loading..." : "Login" }}
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"));
};
</script>
```

## 🚀 CARA MENJALANKAN

1. **Install Dependencies**

```bash
composer install
npm install
```

2. **Setup .env**

```
DB_DATABASE=madani_motor
DB_USERNAME=root
DB_PASSWORD=
```

3. **Migration**

```bash
php artisan migrate:fresh
```

4. **Buat Admin User (Seeder)**

```bash
php artisan tinker
User::create(['nama' => 'AdminT', 'email' => 'admin@madani.com', 'password' => bcrypt('password123')]);
```

5. **Build Assets**

```bash
npm run dev
```

6. **Run Server**

```bash
php artisan serve
```

## 🎯 TESTING

### Guest (Public)

-   Akses: http://localhost:8000
-   Bisa lihat katalog mobil
-   Bisa lihat detail mobil
-   Bisa compare mobil
-   Bisa lihat reviews
-   TIDAK PERLU LOGIN

### Admin

-   Login: http://localhost:8000/login
-   Email: admin@madani.com
-   Password: password123
-   Dashboard: http://localhost:8000/admin/dashboard
-   Bisa CRUD produk
-   Bisa CRUD review
-   Bisa lihat log aktivitas

## 📝 CATATAN PENTING

1. **Review TIDAK ada kolom id_mobil** - Review adalah testimoni umum, bukan review per mobil
2. **Guest tidak perlu login** - Hanya browse dan lihat
3. **Admin harus login** - Untuk CRUD
4. **Logo ada di public/images/logo_asli.png**
5. **Foto mobil upload ke public/images/mobils/**
6. **Foto review upload ke public/images/reviews/**

## ✨ FITUR LENGKAP

### Guest:

-   ✅ Lihat katalog mobil
-   ✅ Filter & sort mobil
-   ✅ Detail mobil lengkap
-   ✅ Compare mobil (max 3)
-   ✅ Lihat reviews
-   ✅ Contact WhatsApp

### Admin:

-   ✅ Dashboard dengan stats
-   ✅ CRUD Produk Mobil
-   ✅ CRUD Review/Testimoni
-   ✅ Log Aktivitas
-   ✅ Profile
-   ✅ Login/Logout

Semua sudah siap! Tinggal copy file-file Vue dan jalankan!
