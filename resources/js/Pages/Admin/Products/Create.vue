<template>
    <Head title="Tambah Produk" />
    <AdminLayout>
        <div class="max-w-4xl mx-auto space-y-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Tambah Produk</h2>
                <p class="text-gray-600 mt-1">
                    Lengkapi form di bawah untuk menambah produk baru
                </p>
            </div>
            <form
                @submit.prevent="submit"
                class="bg-white rounded-lg shadow p-6 space-y-6"
            >
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Judul</label
                        >
                        <input
                            v-model="form.nama_mobil"
                            type="text"
                            placeholder="Masukkan Judul"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Kondisi</label
                        >
                        <div class="flex gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input
                                    v-model="form.kondisi"
                                    type="radio"
                                    value="Baru"
                                    class="w-4 h-4"
                                />
                                <span class="ml-2 text-sm">Baru</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input
                                    v-model="form.kondisi"
                                    type="radio"
                                    value="Bekas"
                                    class="w-4 h-4"
                                />
                                <span class="ml-2 text-sm">Bekas</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Tahun</label
                        >
                        <input
                            v-model="form.tahun"
                            type="number"
                            placeholder="Masukkan Tahun"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Merek</label
                        >
                        <input
                            v-model="form.merek"
                            type="text"
                            placeholder="Masukkan nama merek"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Tipe Registrasi</label
                        >
                        <input
                            v-model="form.tipe"
                            type="text"
                            placeholder="Masukkan tipe registrasi (contoh: Sedan, Hatchback)"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Varian</label
                        >
                        <input
                            v-model="form.varian"
                            type="text"
                            placeholder="Masukkan varian"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Warna</label
                        >
                        <input
                            v-model="form.warna"
                            type="text"
                            placeholder="Masukkan warna"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Kepemilikan</label
                        >
                        <input
                            v-model.number="form.tangan_ke"
                            type="number"
                            min="1"
                            placeholder="Tangan ke-"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Plat Mobil</label
                        >
                        <input
                            v-model="form.plat_asal"
                            type="text"
                            placeholder="Masukkan domisili/plat mobil (contoh: Jakarta)"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Masa Berlaku STNK</label
                        >
                        <input
                            v-model="form.masa_berlaku"
                            type="date"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Kilometer</label
                        >
                        <input
                            v-model="form.kilometer"
                            type="number"
                            placeholder="Masukkan kilometer"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Tipe Penjual</label
                        >
                        <input
                            v-model="form.tipe_penjual"
                            type="text"
                            placeholder="Masukkan tipe penjual"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Transmisi</label
                        >
                        <input
                            v-model="form.transmisi"
                            type="text"
                            placeholder="Masukkan Transmisi"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Harga</label
                        >
                        <input
                            v-model="form.harga"
                            type="number"
                            placeholder="Masukkan harga"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Bahan Bakar</label
                        >
                        <input
                            v-model="form.bahan_bakar"
                            type="text"
                            placeholder="Masukkan bahan bakar"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Sistem Penggerak</label
                        >
                        <input
                            v-model="form.sistem_penggerak"
                            type="text"
                            placeholder="Masukkan sistem penggerak"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Spare Key</label
                        >
                        <input
                            v-model="form.spare_key"
                            type="text"
                            placeholder="Masukkan spare key"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >No Polisi</label
                        >
                        <input
                            v-model="form.nomor_polisi"
                            type="text"
                            placeholder="Masukkan nomor polisi (contoh: B 1234 ABC)"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Toolkit</label
                        >
                        <input
                            v-model="form.toolkit"
                            type="text"
                            placeholder="Masukkan toolkit"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        />
                    </div>
                    <div class="md:col-span-2">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Description</label
                        >
                        <textarea
                            v-model="form.deskripsi"
                            rows="4"
                            placeholder="Write description about your car"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        ></textarea>
                    </div>
                </div>
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">
                        Upload Foto Mobil
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Foto Full Body</label
                            >
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-red-700 text-white rounded-lg cursor-pointer hover:bg-red-800 text-sm justify-center"
                            >
                                <span>📁 Upload foto full body</span>
                                <input
                                    type="file"
                                    @change="
                                        handleFileUpload($event, 'full_body')
                                    "
                                    accept="image/*"
                                    class="hidden"
                                />
                            </label>
                            <p
                                v-if="form.full_body"
                                class="text-xs text-green-600 mt-1"
                            >
                                ✓ {{ form.full_body.name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Foto Depan</label
                            >
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-red-700 text-white rounded-lg cursor-pointer hover:bg-red-800 text-sm justify-center"
                            >
                                <span>📁 Upload foto tampak depan</span>
                                <input
                                    type="file"
                                    @change="
                                        handleFileUpload($event, 'foto_depan')
                                    "
                                    accept="image/*"
                                    class="hidden"
                                />
                            </label>
                            <p
                                v-if="form.foto_depan"
                                class="text-xs text-green-600 mt-1"
                            >
                                ✓ {{ form.foto_depan.name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Foto Belakang</label
                            >
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-red-700 text-white rounded-lg cursor-pointer hover:bg-red-800 text-sm justify-center"
                            >
                                <span>📁 Upload foto tampak belakang</span>
                                <input
                                    type="file"
                                    @change="
                                        handleFileUpload(
                                            $event,
                                            'foto_belakang'
                                        )
                                    "
                                    accept="image/*"
                                    class="hidden"
                                />
                            </label>
                            <p
                                v-if="form.foto_belakang"
                                class="text-xs text-green-600 mt-1"
                            >
                                ✓ {{ form.foto_belakang.name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Foto Samping Kiri</label
                            >
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-red-700 text-white rounded-lg cursor-pointer hover:bg-red-800 text-sm justify-center"
                            >
                                <span>📁 Upload foto tampak kiri</span>
                                <input
                                    type="file"
                                    @change="
                                        handleFileUpload($event, 'foto_kiri')
                                    "
                                    accept="image/*"
                                    class="hidden"
                                />
                            </label>
                            <p
                                v-if="form.foto_kiri"
                                class="text-xs text-green-600 mt-1"
                            >
                                ✓ {{ form.foto_kiri.name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Foto Samping Kanan</label
                            >
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-red-700 text-white rounded-lg cursor-pointer hover:bg-red-800 text-sm justify-center"
                            >
                                <span>📁 Upload foto tampak kanan</span>
                                <input
                                    type="file"
                                    @change="
                                        handleFileUpload($event, 'foto_kanan')
                                    "
                                    accept="image/*"
                                    class="hidden"
                                />
                            </label>
                            <p
                                v-if="form.foto_kanan"
                                class="text-xs text-green-600 mt-1"
                            >
                                ✓ {{ form.foto_kanan.name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Foto Tambahan 1</label
                            >
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-gray-700 text-white rounded-lg cursor-pointer hover:bg-gray-800 text-sm justify-center"
                            >
                                <span>📁 Upload foto tambahan 1</span>
                                <input
                                    type="file"
                                    @change="
                                        handleFileUpload($event, 'tambahan1')
                                    "
                                    accept="image/*"
                                    class="hidden"
                                />
                            </label>
                            <p
                                v-if="form.tambahan1"
                                class="text-xs text-green-600 mt-1"
                            >
                                ✓ {{ form.tambahan1.name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Foto Tambahan 2</label
                            >
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-gray-700 text-white rounded-lg cursor-pointer hover:bg-gray-800 text-sm justify-center"
                            >
                                <span>📁 Upload foto tambahan 2</span>
                                <input
                                    type="file"
                                    @change="
                                        handleFileUpload($event, 'tambahan2')
                                    "
                                    accept="image/*"
                                    class="hidden"
                                />
                            </label>
                            <p
                                v-if="form.tambahan2"
                                class="text-xs text-green-600 mt-1"
                            >
                                ✓ {{ form.tambahan2.name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Foto Tambahan 3</label
                            >
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-gray-700 text-white rounded-lg cursor-pointer hover:bg-gray-800 text-sm justify-center"
                            >
                                <span>📁 Upload foto tambahan 3</span>
                                <input
                                    type="file"
                                    @change="
                                        handleFileUpload($event, 'tambahan3')
                                    "
                                    accept="image/*"
                                    class="hidden"
                                />
                            </label>
                            <p
                                v-if="form.tambahan3"
                                class="text-xs text-green-600 mt-1"
                            >
                                ✓ {{ form.tambahan3.name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Foto Tambahan 4</label
                            >
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-gray-700 text-white rounded-lg cursor-pointer hover:bg-gray-800 text-sm justify-center"
                            >
                                <span>📁 Upload foto tambahan 4</span>
                                <input
                                    type="file"
                                    @change="
                                        handleFileUpload($event, 'tambahan4')
                                    "
                                    accept="image/*"
                                    class="hidden"
                                />
                            </label>
                            <p
                                v-if="form.tambahan4"
                                class="text-xs text-green-600 mt-1"
                            >
                                ✓ {{ form.tambahan4.name }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="border-t pt-6 flex justify-center">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full max-w-md px-6 py-3 bg-red-700 hover:bg-red-800 text-white font-semibold rounded-lg disabled:opacity-50"
                    >
                        {{
                            form.processing ? "Menyimpan..." : "Tambah Product"
                        }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
const form = useForm({
    nama_mobil: "",
    merek: "",
    varian: "",
    tipe: "",
    tipe_penjual: "",
    tahun: "",
    kondisi: "Baru",
    deskripsi: "",
    harga: "",
    warna: "",
    tangan_ke: "",
    plat_asal: "",
    masa_berlaku: "",
    kilometer: "",
    transmisi: "",
    bahan_bakar: "",
    sistem_penggerak: "",
    spare_key: "",
    nomor_polisi: "",
    toolkit: "",
    full_body: null,
    foto_depan: null,
    foto_belakang: null,
    foto_kiri: null,
    foto_kanan: null,
    tambahan1: null,
    tambahan2: null,
    tambahan3: null,
    tambahan4: null,
});
function handleFileUpload(event, field) {
    const file = event.target.files[0];
    if (file) form[field] = file;
}
function submit() {
    form.post(route("admin.products.store"), { forceFormData: true });
}
</script>
