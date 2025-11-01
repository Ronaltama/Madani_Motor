<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-40">
            <div class="p-6">
                <!-- Logo -->
                <div class="flex items-center mb-8">
                    <div
                        class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center"
                    >
                        <svg
                            class="w-6 h-6 text-white"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"
                            />
                        </svg>
                    </div>
                    <span class="ml-2 text-xl font-bold text-gray-800"
                        >MADANI MOTOR</span
                    >
                </div>

                <!-- Navigation Menu -->
                <nav class="space-y-2">
                    <a
                        href="/admin/dashboard"
                        class="flex items-center px-4 py-3 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            />
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a
                        href="/admin/log-aktivitas"
                        class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100 transition duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M9 8h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                        </svg>
                        <span>Log Aktivitas</span>
                    </a>

                    <a
                        href="/admin/products"
                        class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100 transition duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                            />
                        </svg>
                        <span>Manajemen Produk</span>
                    </a>

                    <a
                        href="/admin/reviews"
                        class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100 transition duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                            />
                        </svg>
                        <span>Manajemen Ulasan</span>
                    </a>
                </nav>
            </div>

            <!-- Profile & Logout at Bottom -->
            <div
                class="absolute bottom-0 left-0 right-0 p-6 border-t border-gray-200"
            >
                <div class="flex items-center mb-4">
                    <div
                        class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center"
                    >
                        <img
                            v-if="user.avatar"
                            :src="user.avatar"
                            alt="Profile"
                            class="h-10 w-10 rounded-full"
                        />
                        <span v-else class="text-white font-semibold">{{
                            user.initials
                        }}</span>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-semibold text-gray-800">
                            {{ user.nama }}
                        </p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                </div>
                <button
                    @click="logout"
                    class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition duration-200"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-3"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                        />
                    </svg>
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="ml-64 min-h-screen">
            <!-- Top Header -->
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between px-8 py-4">
                    <!-- Search Bar -->
                    <div class="flex-1 max-w-xl">
                        <div class="relative">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                            <input
                                type="text"
                                placeholder="Search"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                        </div>
                    </div>

                    <!-- Right Side - Language & Profile -->
                    <div class="flex items-center space-x-4 ml-6">
                        <div
                            class="flex items-center space-x-2 px-3 py-2 border border-gray-300 rounded-lg"
                        >
                            <img
                                src="https://flagcdn.com/w40/id.png"
                                alt="Indonesia"
                                class="h-5 w-7"
                            />
                            <span class="text-sm text-gray-700">Indonesia</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center"
                            >
                                <span class="text-white font-semibold">{{
                                    user.initials
                                }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ user.nama }}
                                </p>
                                <p class="text-xs text-gray-500">Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-8">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
                <p class="text-gray-600 mt-1 mb-6">Selamat datang di panel Madani Motor</p>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-600 text-sm">Total produk</p>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-2xl font-bold">{{ stats.totalProduk }}</p>
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h18v2H3V3zm2 5h14v13H5V8zm4 3v2h6v-2H9z"/></svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Semua produk</p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-600 text-sm">Review</p>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-2xl font-bold">{{ stats.totalReview }}</p>
                            <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Siap direview</p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-600 text-sm">Log aktivitas</p>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-2xl font-bold">{{ stats.totalAktivitas }}</p>
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 7v5l3 3 1.5-1.5-2.5-2.5V7h-2z"/><path d="M12 22C6.48 22 2 17.52 2 12S6.48 2 12 2s10 4.48 10 10-4.48 10-10 10zm0-18C7.59 4 4 7.59 4 12s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8z"/></svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Aktivitas terbaru</p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-4">
                        <p class="text-gray-600 text-sm">Admin</p>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-2xl font-bold">{{ stats.totalAdmin }}</p>
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Admin</p>
                    </div>
                </div>

                <!-- Quick Action -->
                <div class="bg-white rounded-lg shadow p-5 mb-6">
                    <h3 class="font-semibold mb-3">Quick Action</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="/admin/products/create" class="flex items-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 py-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-700 rounded mr-3">+
                            </span>
                            <div>
                                <p class="font-medium">Tambah Produk Baru</p>
                                <p class="text-xs text-blue-100">Input produk baru</p>
                            </div>
                        </a>
                        <a href="/admin/reviews" class="flex items-center bg-amber-500 hover:bg-amber-600 text-white rounded-lg px-4 py-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 bg-amber-600 rounded mr-3">★</span>
                            <div>
                                <p class="font-medium">Kelola review</p>
                                <p class="text-xs text-amber-100">Mengecek review</p>
                            </div>
                        </a>
                        <a href="/admin/log-aktivitas" class="flex items-center bg-green-500 hover:bg-green-600 text-white rounded-lg px-4 py-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 bg-green-600 rounded mr-3">☑</span>
                            <div>
                                <p class="font-medium">Lihat Log Aktivitas</p>
                                <p class="text-xs text-green-100">Melihat aktivitas terbaru</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="bg-white rounded-lg shadow p-5">
                    <h3 class="font-semibold mb-3">Aktivitas terbaru</h3>
                    <div class="space-y-2">
                        <div class="flex items-center bg-blue-50 rounded px-3 py-2">
                            <span class="text-sm">Sistem siap digunakan</span>
                            <span class="ml-auto text-xs text-gray-500">Hari ini</span>
                        </div>
                        <div class="flex items-center bg-blue-50 rounded px-3 py-2">
                            <span class="text-sm">{{ stats.totalProduk }} produk di inventory</span>
                            <span class="ml-auto text-xs text-gray-500">Hari ini</span>
                        </div>
                        <div v-for="item in aktivitasTerbaru" :key="item.id_log" class="flex items-center bg-gray-50 rounded px-3 py-2">
                            <span class="text-sm truncate">{{ item.aktivitas }}</span>
                            <span class="ml-auto text-xs text-gray-500">{{ new Date(item.created_at).toLocaleDateString('id-ID') }}</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    user: { type: Object, required: true },
    stats: { type: Object, required: true },
    aktivitasTerbaru: { type: Array, default: () => [] },
});

const user = computed(() => ({
    ...props.user,
    initials: props.user.nama
        .split(" ")
        .map((n) => n[0])
        .join("")
        .toUpperCase()
        .slice(0, 2),
}));

const logout = () => router.post("/logout");
</script>
