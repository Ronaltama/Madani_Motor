<template>
    <Head title="Dashboard Admin" />

    <AdminLayout>
        <div class="space-y-6">
            <!-- Welcome Section -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Dashboard Admin
                </h2>
                <p class="text-gray-600 mt-1">
                    Selamat datang di panel Madani Motor
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Produk -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm mb-1">
                                Total produk
                            </p>
                            <p class="text-3xl font-bold text-gray-900">
                                {{ stats.totalProduk }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                Semua produk
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-6 h-6 text-blue-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Review -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm mb-1">Review</p>
                            <p class="text-3xl font-bold text-gray-900">
                                {{ stats.totalReview }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Ulasan</p>
                        </div>
                        <div
                            class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-6 h-6 text-yellow-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Log Aktivitas -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm mb-1">
                                Log aktivitas
                            </p>
                            <p class="text-3xl font-bold text-gray-900">
                                {{ stats.totalAktivitas }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                Aktivitas tercatat
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-6 h-6 text-green-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Admin -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm mb-1">Admin</p>
                            <p class="text-3xl font-bold text-gray-900">
                                {{ stats.totalAdmin }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">Admin</p>
                        </div>
                        <div
                            class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center"
                        >
                            <svg
                                class="w-6 h-6 text-purple-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    Quick Action
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Tambah Produk -->
                    <Link
                        :href="route('admin.products.create')"
                        class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-6 flex items-center gap-4 transition-colors"
                    >
                        <div
                            class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg">Tambah Produk Baru</p>
                            <p class="text-sm text-blue-100">
                                Input produk baru
                            </p>
                        </div>
                    </Link>

                    <!-- Kelola Review -->
                    <Link
                        :href="route('admin.reviews.index')"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-6 flex items-center gap-4 transition-colors"
                    >
                        <div
                            class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                                />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg">Kelola review</p>
                            <p class="text-sm text-yellow-100">
                                Manage reviews
                            </p>
                        </div>
                    </Link>

                    <!-- Lihat Log -->
                    <Link
                        :href="route('admin.log-aktivitas')"
                        class="bg-green-500 hover:bg-green-600 text-white rounded-lg p-6 flex items-center gap-4 transition-colors"
                    >
                        <div
                            class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg">Lihat Log Aktivitas</p>
                            <p class="text-sm text-green-100">
                                Validasi aktivitas terbaru
                            </p>
                        </div>
                    </Link>
                </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    Aktivitas terbaru
                </h3>
                <div
                    v-if="aktivitasTerbaru && aktivitasTerbaru.length > 0"
                    class="space-y-3"
                >
                    <div
                        v-for="log in aktivitasTerbaru"
                        :key="log.id_log"
                        class="bg-blue-50 rounded-lg p-4 flex items-center justify-between"
                    >
                        <div>
                            <p class="text-gray-900 font-medium">
                                {{ log.aktivitas }}
                            </p>
                        </div>
                        <div class="text-sm text-gray-600">
                            {{ formatDate(log.created_at) }}
                        </div>
                    </div>
                </div>
                <div v-else class="text-center py-8 text-gray-500">
                    Belum ada aktivitas tercatat
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineProps({
    user: Object,
    stats: {
        type: Object,
        default: () => ({
            totalProduk: 0,
            totalReview: 0,
            totalAktivitas: 0,
            totalAdmin: 0,
        }),
    },
    aktivitasTerbaru: {
        type: Array,
        default: () => [],
    },
});

const formatDate = (date) => {
    if (!date) return "Hari ini";
    const d = new Date(date);
    const now = new Date();
    const diff = Math.floor((now - d) / (1000 * 60 * 60 * 24));

    if (diff === 0) return "Hari ini";
    if (diff === 1) return "Kemarin";
    if (diff < 7) return `${diff} hari lalu`;

    return d.toLocaleDateString("id-ID", {
        day: "numeric",
        month: "long",
        year: "numeric",
    });
};
</script>
