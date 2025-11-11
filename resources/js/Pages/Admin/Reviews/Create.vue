<template>
    <Head title="Tambah Ulasan" />

    <AdminLayout>
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    Tambah Ulasan
                </h2>

                <form @submit.prevent="submit">
                    <!-- Pilih Mobil -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Mobil <span class="text-red-600">*</span>
                        </label>
                        <select
                            v-model.number="form.id_mobil"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            required
                        >
                            <option value="">Pilih Mobil</option>
                            <option
                                v-for="mobil in mobils"
                                :key="mobil.id_mobil"
                                :value="mobil.id_mobil"
                            >
                                {{ mobil.nama_mobil }} - {{ mobil.merek }}
                                {{ mobil.varian }}
                            </option>
                        </select>
                    </div>

                    <!-- Nama Pelanggan -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Nama Pelanggan <span class="text-red-600">*</span>
                        </label>
                        <input
                            v-model="form.nama_pelanggan"
                            type="text"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            required
                        />
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Tanggal
                        </label>
                        <input
                            v-model="form.tanggal"
                            type="date"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        />
                    </div>

                    <!-- Rating -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Rating <span class="text-red-600">*</span>
                        </label>
                        <select
                            v-model.number="form.rating"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            required
                        >
                            <option value="">Pilih Rating</option>
                            <option :value="1">⭐ 1</option>
                            <option :value="2">⭐ 2</option>
                            <option :value="3">⭐ 3</option>
                            <option :value="4">⭐ 4</option>
                            <option :value="5">⭐ 5</option>
                        </select>
                    </div>

                    <!-- Isi Review -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Isi Ulasan <span class="text-red-600">*</span>
                        </label>
                        <textarea
                            v-model="form.isi_review"
                            rows="5"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            required
                        ></textarea>
                    </div>

                    <!-- Foto (Optional) -->
                    <div class="mb-6">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Foto Pelanggan (Opsional)
                        </label>
                        <div class="flex items-center gap-3">
                            <input
                                type="file"
                                @change="handleFileUpload"
                                accept="image/*"
                                class="hidden"
                                ref="fileInput"
                            />
                            <button
                                type="button"
                                @click="$refs.fileInput.click()"
                                class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg transition-colors"
                            >
                                Upload Foto
                            </button>
                            <span
                                v-if="form.foto_url"
                                class="text-green-600 flex items-center gap-1"
                            >
                                <svg
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                {{ form.foto_url.name }}
                            </span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <Link
                            :href="route('admin.reviews.index')"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors"
                        >
                            Batal
                        </Link>
                        <button
                            type="submit"
                            class="px-6 py-2 bg-red-700 hover:bg-red-800 text-white rounded-lg transition-colors"
                            :disabled="form.processing"
                        >
                            {{ form.processing ? "Menyimpan..." : "Simpan" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref } from "vue";

const props = defineProps({
    mobils: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    id_mobil: "",
    nama_pelanggan: "",
    tanggal: "",
    rating: "",
    isi_review: "",
    foto_url: null,
});

const fileInput = ref(null);

function handleFileUpload(event) {
    form.foto_url = event.target.files[0];
}

function submit() {
    form.post(route("admin.reviews.store"), {
        forceFormData: true,
        preserveScroll: true,
    });
}
</script>
