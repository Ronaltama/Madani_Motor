<template>
    <Head title="Detail Mobil" />
    <AdminLayout>
        <div class="max-w-7xl mx-auto p-6">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Detail Mobil</h2>
                <p class="text-gray-600">Informasi lengkap produk mobil</p>
            </div>

            <!-- Action Buttons -->
            <div class="mb-6 flex gap-3">
                <button
                    @click="
                        $inertia.visit(
                            route('admin.products.edit', mobil.id_mobil)
                        )
                    "
                    class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors"
                >
                    Edit
                </button>
                <button
                    @click="confirmDelete"
                    class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition-colors"
                >
                    Hapus
                </button>
                <button
                    @click="$inertia.visit(route('admin.products.index'))"
                    class="px-6 py-2 bg-gray-800 hover:bg-black text-white font-semibold rounded-lg transition-colors"
                >
                    Kembali
                </button>
            </div>

            <!-- Content Container with Scroll -->
            <div
                class="bg-white rounded-lg shadow-lg max-h-screen overflow-y-auto"
            >
                <div class="p-8 space-y-8">
                    <!-- Basic Info Section -->
                    <div class="border-b pb-8">
                        <h3 class="text-xl font-bold mb-6 text-gray-800">
                            Informasi Dasar
                        </h3>
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                        >
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Nama Mobil</label
                                >
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ mobil.nama_mobil }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Merek</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.merek }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Varian</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.varian || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Tipe Penjual</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.tipe_penjual || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Tahun</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.tahun || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Kondisi</label
                                >
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold"
                                    :class="
                                        mobil.kondisi === 'Baru'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-gray-100 text-gray-800'
                                    "
                                >
                                    {{ mobil.kondisi }}
                                </span>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Harga</label
                                >
                                <p class="text-lg font-bold text-red-600">
                                    {{
                                        mobil.harga
                                            ? "Rp " +
                                              Number(
                                                  mobil.harga
                                              ).toLocaleString("id-ID")
                                            : "-"
                                    }}
                                </p>
                            </div>
                        </div>

                        <div v-if="mobil.deskripsi" class="mt-6">
                            <label class="text-sm font-medium text-gray-500"
                                >Deskripsi</label
                            >
                            <p class="text-gray-900 mt-2 leading-relaxed">
                                {{ mobil.deskripsi }}
                            </p>
                        </div>
                    </div>

                    <!-- Spesifikasi Section -->
                    <div v-if="mobil.spesifikasi" class="border-b pb-8">
                        <h3 class="text-xl font-bold mb-6 text-gray-800">
                            Spesifikasi
                        </h3>
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                        >
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Tipe</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.spesifikasi.tipe || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Bahan Bakar</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.spesifikasi.bahan_bakar || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Sistem Penggerak</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{
                                        mobil.spesifikasi.sistem_penggerak ||
                                        "-"
                                    }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Transmisi</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.spesifikasi.transmisi || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Kilometer</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{
                                        mobil.spesifikasi.kilometer
                                            ? mobil.spesifikasi.kilometer +
                                              " km"
                                            : "-"
                                    }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Plat Asal</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.spesifikasi.plat_asal || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Nomor Polisi</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.spesifikasi.nomor_polisi || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Masa Berlaku STNK</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{
                                        mobil.spesifikasi.masa_berlaku
                                            ? formatDate(
                                                  mobil.spesifikasi.masa_berlaku
                                              )
                                            : "-"
                                    }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Spare Key</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.spesifikasi.spare_key || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Toolkit</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.spesifikasi.toolkit || "-" }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Warna</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ mobil.spesifikasi.warna || "-" }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Section -->
                    <div class="border-b pb-8">
                        <h3 class="text-xl font-bold mb-6 text-gray-800">
                            Galeri Foto ({{
                                Object.values(
                                    mobil.foto_formatted || {}
                                ).filter(Boolean).length
                            }}
                            foto)
                        </h3>
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
                        >
                            <!-- Foto Template dengan v-for untuk semua jenis foto -->
                            <template
                                v-for="(fotoInfo, key) in fotoTypes"
                                :key="key"
                            >
                                <div
                                    v-if="
                                        mobil.foto_formatted &&
                                        mobil.foto_formatted[key]
                                    "
                                    class="space-y-3"
                                >
                                    <label
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        {{ fotoInfo.label }}
                                    </label>
                                    <div
                                        class="aspect-video bg-gray-200 rounded-lg overflow-hidden"
                                    >
                                        <img
                                            :src="mobil.foto_formatted[key]"
                                            :alt="fotoInfo.label"
                                            class="w-full h-full object-cover cursor-pointer hover:scale-105 transition-transform"
                                            @click="
                                                openImageModal(
                                                    mobil.foto_formatted[key]
                                                )
                                            "
                                            @error="handleImageError"
                                        />
                                    </div>
                                </div>
                            </template>

                            <!-- No Images Message -->
                            <div
                                v-if="!hasAnyPhoto"
                                class="col-span-full text-center py-8 text-gray-500"
                            >
                                <p>Belum ada foto yang diupload</p>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata Section -->
                    <div class="border-b pb-8">
                        <h3 class="text-xl font-bold mb-6 text-gray-800">
                            Informasi Sistem
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Ditambahkan pada</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ formatDate(mobil.created_at) }}
                                </p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-500"
                                    >Terakhir diupdate</label
                                >
                                <p class="text-lg text-gray-900">
                                    {{ formatDate(mobil.updated_at) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Modal -->
            <div
                v-if="showImageModal"
                @click="closeImageModal"
                class="fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4"
            >
                <div class="max-w-4xl max-h-full">
                    <img
                        :src="selectedImage"
                        class="max-w-full max-h-full object-contain"
                    />
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { Head, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({
    mobil: Object,
});

const showImageModal = ref(false);
const selectedImage = ref("");

// Definisi jenis foto dan labelnya
const fotoTypes = {
    full_body: { label: "Full Body" },
    foto_depan: { label: "Foto Depan" },
    foto_belakang: { label: "Foto Belakang" },
    foto_kiri: { label: "Foto Samping Kiri" },
    foto_kanan: { label: "Foto Samping Kanan" },
    tambahan1: { label: "Foto Tambahan 1" },
    tambahan2: { label: "Foto Tambahan 2" },
    tambahan3: { label: "Foto Tambahan 3" },
    tambahan4: { label: "Foto Tambahan 4" },
};

const hasAnyPhoto = computed(() => {
    if (!props.mobil.foto_formatted) return false;
    const fotoFields = [
        "full_body",
        "foto_depan",
        "foto_belakang",
        "foto_kiri",
        "foto_kanan",
        "tambahan1",
        "tambahan2",
        "tambahan3",
        "tambahan4",
    ];
    return fotoFields.some(
        (field) => props.mobil.foto_formatted[field]
    );
});

function formatDate(date) {
    if (!date) return "-";
    const d = new Date(date);
    return d.toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
}

function openImageModal(imageSrc) {
    selectedImage.value = imageSrc;
    showImageModal.value = true;
}

function closeImageModal() {
    showImageModal.value = false;
    selectedImage.value = "";
}

function handleImageError(event) {
    console.error("Error loading image:", event.target.src);
    event.target.style.display = "none";
}

function confirmDelete() {
    if (
        confirm(
            `Hapus mobil "${props.mobil.nama_mobil}"? Tindakan ini tidak dapat dibatalkan.`
        )
    ) {
        router.delete(route("admin.products.destroy", props.mobil.id_mobil), {
            onSuccess: () => {
                router.visit(route("admin.products.index"));
            },
            onError: (errors) => {
                console.error("Error saat menghapus:", errors);
                alert("Terjadi kesalahan saat menghapus mobil");
            },
        });
    }
}
</script>
