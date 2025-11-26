<template>
    <Head title="Manajemen Produk" />

    <AdminLayout>
        <div class="space-y-4 sm:space-y-6">
            <!-- Header -->
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                    Manajemen Produk
                </h2>
                <p class="text-sm sm:text-base text-gray-600 mt-1">
                    Kelola data mobil yang tersedia
                </p>
            </div>

            <!-- Action Button & Search -->
            <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3 sm:gap-4">
                <div class="flex-1 max-w-full sm:max-w-md">
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Cari mobil..."
                            class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            v-model="search"
                        />
                        <svg
                            class="w-5 h-5 absolute left-3 top-2.5 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                        </svg>
                    </div>
                </div>
                <Link
                    :href="route('admin.products.create')"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors text-sm sm:text-base"
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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>
                    <span>Tambah Produk</span>
                </Link>
            </div>

            <!-- Notifikasi sukses -->
            <div
                v-if="$page.props.flash.success"
                class="text-sm sm:text-base text-green-600 font-medium bg-green-50 p-3 rounded-lg"
            >
                {{ $page.props.flash.success }}
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">MEREK</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">VARIAN</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA MOBIL</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="mobil in mobils.data" :key="mobil.id_mobil" class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 text-sm">{{ String(mobil.id_mobil).padStart(5, "0") }}</td>
                            <td class="py-3 px-4 text-sm">{{ mobil.merek }}</td>
                            <td class="py-3 px-4 text-sm">{{ mobil.varian || "-" }}</td>
                            <td class="py-3 px-4 text-sm">{{ mobil.nama_mobil }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <Link :href="route('admin.products.show', mobil.id_mobil)" class="p-1.5 rounded-full hover:bg-gray-100 transition-colors" title="Detail">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </Link>
                                    <Link :href="route('admin.products.edit', mobil.id_mobil)" class="p-1.5 rounded-full hover:bg-gray-100 transition-colors" title="Edit">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </Link>
                                    <button @click="confirmDelete(mobil)" class="p-1.5 rounded-full hover:bg-gray-100 transition-colors" title="Hapus">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="mobils.data.length === 0">
                            <td colspan="5" class="text-center py-8 text-gray-500">Belum ada data mobil</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden space-y-3">
                <div v-for="mobil in mobils.data" :key="mobil.id_mobil" class="bg-white rounded-lg shadow p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 mb-1">ID: {{ String(mobil.id_mobil).padStart(5, "0") }}</p>
                            <h3 class="font-semibold text-gray-900 text-sm">{{ mobil.nama_mobil }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ mobil.merek }} {{ mobil.varian ? `- ${mobil.varian}` : '' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2 pt-3 border-t">
                        <Link :href="route('admin.products.show', mobil.id_mobil)" class="flex-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg text-center text-sm font-medium hover:bg-blue-100 transition-colors">
                            Detail
                        </Link>
                        <Link :href="route('admin.products.edit', mobil.id_mobil)" class="flex-1 px-3 py-2 bg-gray-50 text-gray-700 rounded-lg text-center text-sm font-medium hover:bg-gray-100 transition-colors">
                            Edit
                        </Link>
                        <button @click="confirmDelete(mobil)" class="flex-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg text-center text-sm font-medium hover:bg-red-100 transition-colors">
                            Hapus
                        </button>
                    </div>
                </div>
                <div v-if="mobils.data.length === 0" class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                    Belum ada data mobil
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="mobils.links.length > 3" class="flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-0">
                <div class="text-xs sm:text-sm text-gray-600">
                    Showing {{ mobils.from }} to {{ mobils.to }} of {{ mobils.total }}
                </div>
                <div class="flex flex-wrap justify-center gap-1">
                    <button
                        v-for="(link, index) in mobils.links"
                        :key="index"
                        @click.prevent="link.url && changePage(link.url)"
                        :disabled="!link.url"
                        class="px-3 py-1.5 text-xs sm:text-sm rounded transition-colors"
                        :class="{
                            'bg-blue-600 text-white': link.active,
                            'text-gray-600 hover:bg-gray-100': !link.active,
                            'text-gray-400 cursor-not-allowed': !link.url,
                        }"
                    >
                        <span v-html="link.label"></span>
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, watch } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    mobils: { type: Object, required: true },
});

const search = ref("");
let searchTimeout = null;

watch(search, (value) => {
    if (searchTimeout) clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(
            route("admin.products.index"),
            { search: value },
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
            }
        );
    }, 300);
});

function changePage(url) {
    if (!url) return;
    router.visit(url);
}

function confirmDelete(mobil) {
    if (!confirm(`Hapus mobil "${mobil.nama_mobil}"?`)) return;
    router.delete(`/admin/products/${mobil.id_mobil}`, {
        onSuccess: () => router.reload({ only: ["mobils"] }),
    });
}
</script>