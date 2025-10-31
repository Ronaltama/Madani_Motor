<template>
    <NewAdminLayout>
        <div>
            <h1 class="text-2xl font-semibold mb-2">Dashboard Admin</h1>
            <p class="text-gray-600 mb-8">Selamat datang di panel Madani Motor</p>

            <!-- Stats Cards -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500">Total produk</h3>
                            <p class="text-2xl font-bold">{{ stats.totalProduk }}</p>
                            <p class="text-sm text-gray-500">Semua produk</p>
                        </div>
                        <div class="flex justify-center items-center w-12 h-12 bg-blue-100 rounded-lg">
                            <DocumentTextIcon class="w-6 h-6 text-blue-600" />
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500">Review</h3>
                            <p class="text-2xl font-bold">{{ stats.totalReview }}</p>
                            <p class="text-sm text-gray-500">Total direview</p>
                        </div>
                        <div class="flex justify-center items-center w-12 h-12 bg-yellow-100 rounded-lg">
                            <StarIcon class="w-6 h-6 text-yellow-500" />
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500">Log aktivitas</h3>
                            <p class="text-2xl font-bold">{{ stats.totalAktivitas }}</p>
                            <p class="text-sm text-gray-500">Aktivitas terbaru</p>
                        </div>
                        <div class="flex justify-center items-center w-12 h-12 bg-green-100 rounded-lg">
                            <DocumentCheckIcon class="w-6 h-6 text-green-600" />
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500">Admin</h3>
                            <p class="text-2xl font-bold">{{ stats.totalAdmin }}</p>
                            <p class="text-sm text-gray-500">Admin</p>
                        </div>
                        <div class="flex justify-center items-center w-12 h-12 bg-purple-100 rounded-lg">
                            <UserGroupIcon class="w-6 h-6 text-purple-600" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <h3 class="text-lg font-semibold mb-4">Quick Action</h3>
            <div class="grid grid-cols-3 gap-4 mb-8">
                <Link href="/admin/products/create"
                    class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-4 flex items-center"
                >
                    <div class="flex items-center justify-center w-8 h-8 bg-blue-600 rounded-lg mr-3">
                        <PlusIcon class="w-5 h-5" />
                    </div>
                    <div>
                        <h4 class="font-medium">Tambah Produk Baru</h4>
                        <p class="text-sm text-blue-100">Input produk baru</p>
                    </div>
                </Link>

                <Link href="/admin/reviews"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-4 flex items-center"
                >
                    <div class="flex items-center justify-center w-8 h-8 bg-yellow-600 rounded-lg mr-3">
                        <StarIcon class="w-5 h-5" />
                    </div>
                    <div>
                        <h4 class="font-medium">Kelola review</h4>
                        <p class="text-sm text-yellow-100">Mengecek review</p>
                    </div>
                </Link>

                <Link href="/admin/logs"
                    class="bg-green-500 hover:bg-green-600 text-white rounded-lg p-4 flex items-center"
                >
                    <div class="flex items-center justify-center w-8 h-8 bg-green-600 rounded-lg mr-3">
                        <DocumentCheckIcon class="w-5 h-5" />
                    </div>
                    <div>
                        <h4 class="font-medium">Lihat Log Aktivitas</h4>
                        <p class="text-sm text-green-100">Melihat aktivitas terbaru</p>
                    </div>
                </Link>
            </div>

            <!-- Aktivitas terbaru -->
            <h3 class="text-lg font-semibold mb-4">Aktivitas terbaru</h3>
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-4 border-b">
                    <div class="flex items-center space-x-2">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <CheckCircleIcon class="w-5 h-5 text-green-600" />
                        </div>
                        <span>Sistem siap digunakan</span>
                        <span class="ml-auto text-sm text-gray-500">Hari ini</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center space-x-2">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <InformationCircleIcon class="w-5 h-5 text-blue-600" />
                        </div>
                        <span>0 produk di inventory</span>
                        <span class="ml-auto text-sm text-gray-500">Hari ini</span>
                    </div>
                </div>
            </div>
        </div>
    </NewAdminLayout>
</template>

<script setup>
import NewAdminLayout from '@/Layouts/NewAdminLayout.vue'
import { Link } from '@inertiajs/vue3'
import {
    DocumentTextIcon,
    StarIcon,
    DocumentCheckIcon,
    UserGroupIcon,
    PlusIcon,
    CheckCircleIcon,
    InformationCircleIcon
} from '@heroicons/vue/24/outline'

defineProps({
    stats: {
        type: Object,
        required: true,
        default: () => ({
            totalProduk: 4,
            totalReview: 1,
            totalAktivitas: 2,
            totalAdmin: 1
        })
    }
})
</script>