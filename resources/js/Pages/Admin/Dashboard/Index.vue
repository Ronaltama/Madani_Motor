<template>
    <div class="p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl">Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span>Indonesia</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="/admin-avatar.png" alt="AdminT" class="w-8 h-8 rounded-full" />
                    <div class="text-sm">
                        <div>AdminT</div>
                        <div class="text-gray-500">Admin</div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-semibold mb-2">Dashboard Admin</h2>
        <p class="text-gray-600 mb-6">Selamat datang di panel Madani Motor</p>

        <!-- Stats Cards -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-600">Total produk</p>
                        <p class="text-2xl font-bold">{{ stats.totalProduk }}</p>
                        <p class="text-sm text-gray-500">Semua produk</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <DocumentIcon class="w-6 h-6 text-blue-600" />
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-600">Review</p>
                        <p class="text-2xl font-bold">{{ stats.totalReview }}</p>
                        <p class="text-sm text-gray-500">Total direview</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <StarIcon class="w-6 h-6 text-yellow-600" />
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-600">Log aktivitas</p>
                        <p class="text-2xl font-bold">{{ stats.logAktivitas }}</p>
                        <p class="text-sm text-gray-500">Aktivitas terbaru</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <ClockIcon class="w-6 h-6 text-green-600" />
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-600">Admin</p>
                        <p class="text-2xl font-bold">{{ stats.totalAdmin }}</p>
                        <p class="text-sm text-gray-500">Admin</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <UserIcon class="w-6 h-6 text-purple-600" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">Quick Action</h3>
            <div class="grid grid-cols-3 gap-4">
                <button @click="$router.push('/admin/products/create')" 
                    class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700">
                    <PlusIcon class="w-5 h-5" />
                    <div class="text-left">
                        <p class="font-semibold">Tambah Produk Baru</p>
                        <p class="text-sm opacity-90">Input produk baru</p>
                    </div>
                </button>

                <button @click="$router.push('/admin/reviews')"
                    class="flex items-center space-x-2 bg-yellow-500 text-white px-4 py-3 rounded-lg hover:bg-yellow-600">
                    <StarIcon class="w-5 h-5" />
                    <div class="text-left">
                        <p class="font-semibold">Kelola review</p>
                        <p class="text-sm opacity-90">Mengecek review</p>
                    </div>
                </button>

                <button @click="$router.push('/admin/logs')"
                    class="flex items-center space-x-2 bg-green-500 text-white px-4 py-3 rounded-lg hover:bg-green-600">
                    <ClockIcon class="w-5 h-5" />
                    <div class="text-left">
                        <p class="font-semibold">Lihat Log Aktivitas</p>
                        <p class="text-sm opacity-90">Melihat aktivitas terbaru</p>
                    </div>
                </button>
            </div>
        </div>

        <!-- Aktivitas terbaru -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Aktivitas terbaru</h3>
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <div class="flex items-center space-x-2">
                        <CheckCircleIcon class="w-5 h-5 text-green-500" />
                        <p>Sistem siap digunakan</p>
                        <span class="ml-auto text-sm text-gray-500">Hari ini</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center space-x-2">
                        <InformationCircleIcon class="w-5 h-5 text-blue-500" />
                        <p>{{ stats.totalProduk }} produk di inventory</p>
                        <span class="ml-auto text-sm text-gray-500">Hari ini</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { PlusIcon, StarIcon, ClockIcon, UserIcon, DocumentIcon, CheckCircleIcon, InformationCircleIcon } from '@heroicons/vue/24/outline'

defineProps({
    stats: {
        type: Object,
        required: true
    },
    aktivitasTerbaru: {
        type: Array,
        required: true
    }
})
</script>