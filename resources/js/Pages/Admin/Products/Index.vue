<template>
    <Head title="Manajemen Produk" />

    <AdminLayout>
        <div class="space-y-6">
            <!-- Header -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Manajemen Produk
                </h2>
                <p class="text-gray-600 mt-1">
                    Kelola data mobil yang tersedia
                </p>
            </div>

            <!-- Action Button & Search -->
            <div class="flex justify-between items-center gap-4">
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Cari mobil (nama, merek, varian, ID)..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
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
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors"
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

            <!-- Konten Utama -->
            <!-- Notifikasi sukses -->
            <div
                v-if="$page.props.flash.success"
                class="mb-4 text-green-600 font-medium"
            >
                {{ $page.props.flash.success }}
            </div>

            <!-- Tabel Data -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                ID
                            </th>
                            <th
                                class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                MEREK
                            </th>
                            <th
                                class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                VARIAN
                            </th>
                            <th
                                class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                NAMA MOBIL
                            </th>
                            <th
                                class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                ACTION
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr
                            v-for="mobil in mobils.data"
                            :key="mobil.id_mobil"
                            class="hover:bg-gray-50 transition"
                        >
                            <td class="py-3 px-4 text-sm">
                                {{ String(mobil.id_mobil).padStart(5, "0") }}
                            </td>
                            <td class="py-3 px-4 text-sm">{{ mobil.merek }}</td>
                            <td class="py-3 px-4 text-sm">
                                {{ mobil.varian || "-" }}
                            </td>
                            <td class="py-3 px-4 text-sm">
                                {{ mobil.nama_mobil }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <!-- Detail Button -->
                                    <Link
                                        :href="
                                            route(
                                                'admin.products.show',
                                                mobil.id_mobil
                                            )
                                        "
                                        class="p-1.5 rounded-full hover:bg-gray-100 transition-colors"
                                        title="Detail"
                                    >
                                        <svg
                                            class="w-5 h-5 text-blue-600"
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

                                    <!-- Edit Button -->
                                    <Link
                                        :href="
                                            route(
                                                'admin.products.edit',
                                                mobil.id_mobil
                                            )
                                        "
                                        class="p-1.5 rounded-full hover:bg-gray-100 transition-colors"
                                        title="Edit"
                                    >
                                        <svg
                                            class="w-5 h-5 text-gray-600"
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

                                    <!-- Delete Button -->
                                    <button
                                        @click="confirmDelete(mobil)"
                                        class="p-1.5 rounded-full hover:bg-gray-100 transition-colors"
                                        title="Hapus"
                                    >
                                        <svg
                                            class="w-5 h-5 text-red-600"
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
                                </div>
                            </td>
                        </tr>

                        <tr v-if="mobils.data.length === 0">
                            <td
                                colspan="5"
                                class="text-center py-8 text-gray-500"
                            >
                                Belum ada data mobil
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div
                v-if="mobils.links.length > 3"
                class="mt-6 flex justify-between items-center"
            >
                <div class="text-sm text-gray-600">
                    Showing {{ mobils.from }} to {{ mobils.to }} of
                    {{ mobils.total }}
                </div>
                <div class="flex gap-1">
                    <button
                        v-for="(link, index) in mobils.links"
                        :key="index"
                        @click.prevent="link.url && changePage(link.url)"
                        :disabled="!link.url"
                        class="px-3 py-1.5 text-sm rounded transition-colors"
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

            <!-- Modal Tambah/Edit Mobil -->
            <div
                v-if="showModal"
                class="fixed inset-0 flex justify-center items-center z-50 bg-gray-500/50 backdrop-blur-sm"
            >
                <div
                    class="bg-white p-6 rounded-lg w-[900px] max-w-[95vw] shadow-xl border max-h-[85vh] overflow-y-auto"
                >
                    <h2 class="text-xl font-semibold mb-4">
                        {{ isEdit ? "Edit Mobil" : "Tambah Mobil" }}
                    </h2>

                    <form @submit.prevent="submit">
                        <div class="mb-3 md:col-span-2" v-if="false"></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="mb-3 md:col-span-2">
                                <label class="block mb-1 text-sm font-medium"
                                    >Nama Mobil</label
                                >
                                <input
                                    v-model="form.nama_mobil"
                                    type="text"
                                    class="w-full border rounded p-2"
                                    placeholder="Contoh: Avanza Veloz"
                                />
                            </div>

                            <!-- Foto Cards -->
                            <div
                                class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-1 md:col-span-2"
                            >
                                <div class="border rounded-lg p-3">
                                    <div class="text-sm font-medium mb-2">
                                        Foto depan
                                    </div>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        @change="
                                            onFileChange($event, 'foto_depan')
                                        "
                                    />
                                    <img
                                        v-if="previews.foto_depan"
                                        :src="previews.foto_depan"
                                        class="mt-2 w-full h-28 object-cover rounded"
                                    />
                                </div>
                                <div class="border rounded-lg p-3">
                                    <div class="text-sm font-medium mb-2">
                                        Foto belakang
                                    </div>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        @change="
                                            onFileChange(
                                                $event,
                                                'foto_belakang'
                                            )
                                        "
                                    />
                                    <img
                                        v-if="previews.foto_belakang"
                                        :src="previews.foto_belakang"
                                        class="mt-2 w-full h-28 object-cover rounded"
                                    />
                                </div>
                                <div class="border rounded-lg p-3">
                                    <div class="text-sm font-medium mb-2">
                                        Foto samping kiri
                                    </div>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        @change="
                                            onFileChange($event, 'foto_kiri')
                                        "
                                    />
                                    <img
                                        v-if="previews.foto_kiri"
                                        :src="previews.foto_kiri"
                                        class="mt-2 w-full h-28 object-cover rounded"
                                    />
                                </div>
                                <div class="border rounded-lg p-3">
                                    <div class="text-sm font-medium mb-2">
                                        Foto samping kanan
                                    </div>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        @change="
                                            onFileChange($event, 'foto_kanan')
                                        "
                                    />
                                    <img
                                        v-if="previews.foto_kanan"
                                        :src="previews.foto_kanan"
                                        class="mt-2 w-full h-28 object-cover rounded"
                                    />
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium"
                                    >Merek</label
                                >
                                <input
                                    v-model="form.merek"
                                    type="text"
                                    class="w-full border rounded p-2"
                                    placeholder="Contoh: Toyota"
                                />
                            </div>

                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium"
                                    >Varian</label
                                >
                                <input
                                    v-model="form.varian"
                                    type="text"
                                    class="w-full border rounded p-2"
                                    placeholder="Contoh: Veloz"
                                />
                            </div>

                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium"
                                    >Tipe Penjual</label
                                >
                                <select
                                    v-model="form.tipe_penjual"
                                    class="w-full border rounded p-2"
                                >
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="Dealer">Dealer</option>
                                    <option value="Individu">Individu</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium"
                                    >Tahun</label
                                >
                                <input
                                    v-model="form.tahun"
                                    type="number"
                                    class="w-full border rounded p-2"
                                    placeholder="Contoh: 2022"
                                />
                            </div>

                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium"
                                    >Kondisi</label
                                >
                                <select
                                    v-model="form.kondisi"
                                    class="w-full border rounded p-2"
                                >
                                    <option value="">
                                        -- Pilih Kondisi --
                                    </option>
                                    <option value="Baru">Baru</option>
                                    <option value="Bekas">Bekas</option>
                                </select>
                            </div>

                            <div class="mb-3 md:col-span-2">
                                <label class="block mb-1 text-sm font-medium"
                                    >Deskripsi</label
                                >
                                <textarea
                                    v-model="form.deskripsi"
                                    rows="3"
                                    class="w-full border rounded p-2"
                                    placeholder="Keterangan tambahan"
                                ></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium"
                                    >Harga</label
                                >
                                <input
                                    v-model="form.harga"
                                    type="number"
                                    class="w-full border rounded p-2"
                                    placeholder="Contoh: 250000000"
                                />
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2 mt-4">
                            <button
                                type="button"
                                @click="closeModal"
                                class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                                :disabled="form.processing"
                            >
                                {{
                                    form.processing
                                        ? "Menyimpan..."
                                        : isEdit
                                        ? "Update"
                                        : "Simpan"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Info -->
            <div
                v-if="showInfo"
                class="fixed inset-0 flex justify-center items-center z-50 bg-gray-500/50 backdrop-blur-sm"
            >
                <div class="bg-white p-6 rounded-lg w-[480px] shadow-xl border">
                    <h2 class="text-lg font-semibold mb-3">Detail Mobil</h2>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">ID</span
                            ><span>{{ selectedMobil?.id_mobil }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Merek</span
                            ><span>{{ selectedMobil?.merek }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Varian</span
                            ><span>{{ selectedMobil?.varian || "-" }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Nama Mobil</span
                            ><span>{{ selectedMobil?.nama_mobil }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Kondisi</span
                            ><span>{{ selectedMobil?.kondisi }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tahun</span
                            ><span>{{ selectedMobil?.tahun }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Harga</span
                            ><span
                                >Rp
                                {{
                                    Number(
                                        selectedMobil?.harga || 0
                                    ).toLocaleString("id-ID")
                                }}</span
                            >
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button
                            @click="showInfo = false"
                            class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, watch } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router, useForm } from "@inertiajs/vue3";

const props = defineProps({
    mobils: { type: Object, required: true },
});

const search = ref("");
let searchTimeout = null;

// Watch untuk pencarian dengan debounce
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
    }, 300); // Delay 300ms
});

const showModal = ref(false);
const isEdit = ref(false);
const showInfo = ref(false);
const selectedMobil = ref(null);

const form = useForm({
    id_mobil: null,
    nama_mobil: "",
    merek: "",
    varian: "",
    tipe_penjual: "",
    tahun: "",
    kondisi: "",
    deskripsi: "",
    harga: "",
    foto_depan: null,
    foto_belakang: null,
    foto_kiri: null,
    foto_kanan: null,
});

function submit() {
    if (isEdit.value && form.id_mobil) {
        form.put(`/admin/products/${form.id_mobil}`, {
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => {
                showModal.value = false;
                isEdit.value = false;
                form.reset();
                router.reload({ only: ["mobils"] });
            },
        });
    } else {
        form.post("/admin/products", {
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => {
                showModal.value = false;
                form.reset();
                router.reload({ only: ["mobils"] });
            },
        });
    }
}

function closeModal() {
    showModal.value = false;
    isEdit.value = false;
    form.reset();
    // Bersihkan preview dan revoke object URLs
    Object.keys(previews.value).forEach((k) => {
        previews.value[k] = null;
    });
}

function changePage(url) {
    if (!url) return;
    router.visit(url);
}

function openInfo(mobil) {
    router.visit(`/admin/products/${mobil.id_mobil}`);
}

function openEdit(mobil) {
    isEdit.value = true;
    form.id_mobil = mobil.id_mobil;
    form.nama_mobil = mobil.nama_mobil;
    form.merek = mobil.merek;
    form.varian = mobil.varian;
    form.tipe_penjual = mobil.tipe_penjual;
    form.tahun = mobil.tahun;
    form.kondisi = mobil.kondisi;
    form.deskripsi = mobil.deskripsi;
    form.harga = mobil.harga;
    showModal.value = true;
}

function confirmDelete(mobil) {
    if (!confirm(`Hapus mobil "${mobil.nama_mobil}"?`)) return;
    router.delete(`/admin/products/${mobil.id_mobil}`, {
        onSuccess: () => router.reload({ only: ["mobils"] }),
    });
}

const previews = ref({
    foto_depan: null,
    foto_belakang: null,
    foto_kiri: null,
    foto_kanan: null,
});
const objectURLs = {
    foto_depan: null,
    foto_belakang: null,
    foto_kiri: null,
    foto_kanan: null,
};
function onFileChange(e, field) {
    const file = e.target.files && e.target.files[0] ? e.target.files[0] : null;
    form[field] = file;
    // revoke url lama kalau ada
    if (objectURLs[field]) {
        URL.revokeObjectURL(objectURLs[field]);
        objectURLs[field] = null;
    }
    if (file) {
        const url = URL.createObjectURL(file);
        objectURLs[field] = url;
        previews.value[field] = url;
    } else {
        previews.value[field] = null;
    }
}
</script>
