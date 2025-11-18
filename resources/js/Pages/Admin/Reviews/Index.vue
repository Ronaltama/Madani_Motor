<template>
    <Head title="Manajemen Ulasan" />

    <AdminLayout>
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        Manajemen Ulasan
                    </h2>
                    <p class="text-gray-600 mt-1">
                        Kelola ulasan dan testimoni pelanggan
                    </p>
                </div>
                <Link
                    :href="route('admin.reviews.create')"
                    class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors"
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
                    <span>Tambah Ulasan</span>
                </Link>
            </div>

            <!-- Table Reviews -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Mobil
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Pelanggan
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Rating
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Ulasan
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Foto
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Tanggal
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-if="reviews.length === 0">
                            <td
                                colspan="7"
                                class="px-6 py-8 text-center text-gray-500"
                            >
                                Belum ada ulasan. Klik "Tambah Ulasan" untuk
                                menambahkan ulasan pertama.
                            </td>
                        </tr>
                        <tr
                            v-for="review in reviews"
                            :key="review.id_review"
                            class="hover:bg-gray-50"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ review.nama_mobil || "-" }}
                                </div>
                                <div class="text-xs text-gray-500">-</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ review.nama_pelanggan }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1">
                                    <span
                                        v-for="i in 5"
                                        :key="i"
                                        class="text-yellow-400"
                                    >
                                        {{ i <= review.rating ? "★" : "☆" }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div
                                    class="text-sm text-gray-900 max-w-md truncate"
                                >
                                    {{ review.isi_review }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    v-if="review.foto_url"
                                    class="w-16 h-16 rounded overflow-hidden"
                                >
                                    <img
                                        :src="review.foto_url"
                                        alt="Foto"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <span v-else class="text-gray-400 text-xs"
                                    >-</span
                                >
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                            >
                                {{
                                    formatDate(
                                        review.tanggal || review.created_at
                                    )
                                }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                            >
                                <div class="flex items-center gap-2">
                                    <Link
                                        :href="
                                            route(
                                                'admin.reviews.edit',
                                                review.id_review
                                            )
                                        "
                                        class="text-blue-600 hover:text-blue-900"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="deleteReview(review)"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-sm text-gray-500">
                Total: {{ reviews.length }} ulasan
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    reviews: {
        type: Array,
        default: () => [],
    },
});

function formatDate(date) {
    if (!date) return "-";
    return new Date(date).toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
    });
}

function deleteReview(review) {
    if (
        confirm(`Yakin ingin menghapus ulasan dari "${review.nama_pelanggan}"?`)
    ) {
        router.delete(route("admin.reviews.destroy", review.id_review), {
            preserveScroll: true,
        });
    }
}
</script>
