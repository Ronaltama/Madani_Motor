<template>
    <NewAdminLayout>
        <div class="py-4">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Manajemen Produk</h1>
                <button
                    @click="showModal = true"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2"
                >
                    <PlusIcon class="w-5 h-5" />
                    <span>Tambah produk baru</span>
                </button>
            </div>

            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <MagnifyingGlassIcon
                        class="w-5 h-5 absolute left-3 top-3 text-gray-400"
                    />
                    <input
                        type="text"
                        placeholder="Search"
                        class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        v-model="search"
                    />
                </div>
            </div>
        </div> <!-- ✅ ini div yang tadinya hilang -->

        <!-- Konten Utama -->
        <!-- Notifikasi sukses -->
        <div
            v-if="$page.props.flash.success"
            class="mb-4 text-green-600 font-medium"
        >
            {{ $page.props.flash.success }}
        </div>

        <!-- Tabel Data -->
        <table class="min-w-full bg-white rounded-lg shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left">ID</th>
                            <th class="py-2 px-4 text-left">Merek</th>
                    <th class="py-2 px-4 text-left">Varian</th>
                    <th class="py-2 px-4 text-left">Nama Mobil</th>
                            <th class="py-2 px-4 text-left">Kondisi</th>
                    <th class="py-2 px-4 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="mobil in mobils.data"
                            :key="mobil.id_mobil"
                            class="border-t hover:bg-gray-50 transition"
                        >
                            <td class="py-2 px-4">{{ mobil.id_mobil }}</td>
                            <td class="py-2 px-4">{{ mobil.merek }}</td>
                    <td class="py-2 px-4">{{ mobil.varian || '-' }}</td>
                            <td class="py-2 px-4">{{ mobil.nama_mobil }}</td>
                            <td class="py-2 px-4">
                                <span
                                    class="px-2 py-1 rounded text-sm"
                                    :class="mobil.kondisi === 'Baru'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700'"
                                >
                                    {{ mobil.kondisi }}
                                </span>
                            </td>
                    <td class="py-2 px-4">
                        <div class="flex items-center gap-3">
                            <button @click="openInfo(mobil)" class="text-gray-600 hover:text-gray-800" title="Info">
                                <InformationCircleIcon class="w-5 h-5" />
                            </button>
                            <button @click="openEdit(mobil)" class="text-indigo-600 hover:text-indigo-700" title="Edit">
                                <PencilSquareIcon class="w-5 h-5" />
                            </button>
                            <button @click="confirmDelete(mobil)" class="text-red-600 hover:text-red-700" title="Hapus">
                                <TrashIcon class="w-5 h-5" />
                            </button>
                        </div>
                    </td>
                        </tr>

                        <tr v-if="mobils.data.length === 0">
                            <td
                        colspan="6"
                                class="text-center py-3 text-gray-500"
                            >
                                Belum ada data mobil
                            </td>
                        </tr>
                    </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4 flex justify-center space-x-2">
            <button
                v-for="link in mobils.links"
                :key="link.label"
                v-html="link.label"
                @click.prevent="changePage(link.url)"
                :disabled="!link.url"
                class="px-3 py-1 border rounded"
                :class="{
                    'bg-blue-600 text-white': link.active,
                    'text-gray-600 hover:bg-gray-100': !link.active
                }"
            ></button>
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
                    {{ isEdit ? 'Edit Mobil' : 'Tambah Mobil' }}
                </h2>

                <form @submit.prevent="submit">
                    <div class="mb-3 md:col-span-2" v-if="false"></div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="mb-3 md:col-span-2">
                        <label
                            class="block mb-1 text-sm font-medium"
                        >Nama Mobil</label>
                        <input
                            v-model="form.nama_mobil"
                            type="text"
                            class="w-full border rounded p-2"
                            placeholder="Contoh: Avanza Veloz"
                        />
                    </div>

                    <!-- Foto Cards -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-1 md:col-span-2">
                        <div class="border rounded-lg p-3">
                            <div class="text-sm font-medium mb-2">Foto depan</div>
                            <input type="file" accept="image/*" @change="onFileChange($event,'foto_depan')" />
                            <img v-if="previews.foto_depan" :src="previews.foto_depan" class="mt-2 w-full h-28 object-cover rounded" />
                        </div>
                        <div class="border rounded-lg p-3">
                            <div class="text-sm font-medium mb-2">Foto belakang</div>
                            <input type="file" accept="image/*" @change="onFileChange($event,'foto_belakang')" />
                            <img v-if="previews.foto_belakang" :src="previews.foto_belakang" class="mt-2 w-full h-28 object-cover rounded" />
                        </div>
                        <div class="border rounded-lg p-3">
                            <div class="text-sm font-medium mb-2">Foto samping kiri</div>
                            <input type="file" accept="image/*" @change="onFileChange($event,'foto_kiri')" />
                            <img v-if="previews.foto_kiri" :src="previews.foto_kiri" class="mt-2 w-full h-28 object-cover rounded" />
                        </div>
                        <div class="border rounded-lg p-3">
                            <div class="text-sm font-medium mb-2">Foto samping kanan</div>
                            <input type="file" accept="image/*" @change="onFileChange($event,'foto_kanan')" />
                            <img v-if="previews.foto_kanan" :src="previews.foto_kanan" class="mt-2 w-full h-28 object-cover rounded" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label
                            class="block mb-1 text-sm font-medium"
                        >Merek</label>
                        <input
                            v-model="form.merek"
                            type="text"
                            class="w-full border rounded p-2"
                            placeholder="Contoh: Toyota"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            class="block mb-1 text-sm font-medium"
                        >Varian</label>
                        <input
                            v-model="form.varian"
                            type="text"
                            class="w-full border rounded p-2"
                            placeholder="Contoh: Veloz"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            class="block mb-1 text-sm font-medium"
                        >Tipe Penjual</label>
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
                        <label
                            class="block mb-1 text-sm font-medium"
                        >Tahun</label>
                        <input
                            v-model="form.tahun"
                            type="number"
                            class="w-full border rounded p-2"
                            placeholder="Contoh: 2022"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            class="block mb-1 text-sm font-medium"
                        >Kondisi</label>
                        <select
                            v-model="form.kondisi"
                            class="w-full border rounded p-2"
                        >
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="Baru">Baru</option>
                            <option value="Bekas">Bekas</option>
                        </select>
                    </div>

                    <div class="mb-3 md:col-span-2">
                        <label
                            class="block mb-1 text-sm font-medium"
                        >Deskripsi</label>
                        <textarea
                            v-model="form.deskripsi"
                            rows="3"
                            class="w-full border rounded p-2"
                            placeholder="Keterangan tambahan"
                        ></textarea>
                    </div>

                    <div class="mb-3">
                        <label
                            class="block mb-1 text-sm font-medium"
                        >Harga</label>
                        <input
                            v-model="form.harga"
                            type="number"
                            class="w-full border rounded p-2"
                            placeholder="Contoh: 250000000"
                        />
                    </div>
                    </div>

                    <div
                        class="flex justify-end space-x-2 mt-4"
                    >
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
                            {{ form.processing
                                ? 'Menyimpan...'
                                : (isEdit ? 'Update' : 'Simpan') }}
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
                    <div class="flex justify-between"><span class="text-gray-500">ID</span><span>{{ selectedMobil?.id_mobil }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Merek</span><span>{{ selectedMobil?.merek }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Varian</span><span>{{ selectedMobil?.varian || '-' }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Nama Mobil</span><span>{{ selectedMobil?.nama_mobil }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Kondisi</span><span>{{ selectedMobil?.kondisi }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Tahun</span><span>{{ selectedMobil?.tahun }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Harga</span><span>Rp {{ Number(selectedMobil?.harga||0).toLocaleString('id-ID') }}</span></div>
                </div>
                <div class="mt-4 text-right">
                    <button @click="showInfo=false" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Tutup</button>
                </div>
            </div>
        </div>
    </NewAdminLayout>
</template>

<script setup>
import { ref } from 'vue'
import NewAdminLayout from '@/Layouts/NewAdminLayout.vue'
import { router, useForm } from '@inertiajs/vue3'
import {
    MagnifyingGlassIcon,
    PlusIcon,
    InformationCircleIcon,
    PencilSquareIcon,
    TrashIcon
} from '@heroicons/vue/24/outline'

const props = defineProps({
    mobils: { type: Object, required: true }
})

const search = ref('')
const showModal = ref(false)
const isEdit = ref(false)
const showInfo = ref(false)
const selectedMobil = ref(null)

const form = useForm({
    id_mobil: null,
    nama_mobil: '',
    merek: '',
    varian: '',
    tipe_penjual: '',
    tahun: '',
    kondisi: '',
    deskripsi: '',
    harga: '',
    foto_depan: null,
    foto_belakang: null,
    foto_kiri: null,
    foto_kanan: null
})

function submit() {
    if (isEdit.value && form.id_mobil) {
        form.put(`/admin/products/${form.id_mobil}`, {
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => {
                showModal.value = false
                isEdit.value = false
                form.reset()
                router.reload({ only: ['mobils'] })
            }
        })
    } else {
        form.post('/admin/products', {
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => {
                showModal.value = false
                form.reset()
                router.reload({ only: ['mobils'] })
            }
        })
    }
}

function closeModal() {
    showModal.value = false
    isEdit.value = false
    form.reset()
    // Bersihkan preview dan revoke object URLs
    Object.keys(previews.value).forEach((k) => {
        previews.value[k] = null
    })
}

function changePage(url) {
    if (!url) return
    router.visit(url)
}

function openInfo(mobil) {
    router.visit(`/admin/products/${mobil.id_mobil}`)
}

function openEdit(mobil) {
    isEdit.value = true
    form.id_mobil = mobil.id_mobil
    form.nama_mobil = mobil.nama_mobil
    form.merek = mobil.merek
    form.varian = mobil.varian
    form.tipe_penjual = mobil.tipe_penjual
    form.tahun = mobil.tahun
    form.kondisi = mobil.kondisi
    form.deskripsi = mobil.deskripsi
    form.harga = mobil.harga
    showModal.value = true
}

function confirmDelete(mobil) {
    if (!confirm(`Hapus mobil "${mobil.nama_mobil}"?`)) return
    router.delete(`/admin/products/${mobil.id_mobil}` , {
        onSuccess: () => router.reload({ only: ['mobils'] })
    })
}

const previews = ref({ foto_depan: null, foto_belakang: null, foto_kiri: null, foto_kanan: null })
const objectURLs = { foto_depan: null, foto_belakang: null, foto_kiri: null, foto_kanan: null }
function onFileChange(e, field) {
    const file = e.target.files && e.target.files[0] ? e.target.files[0] : null
    form[field] = file
    // revoke url lama kalau ada
    if (objectURLs[field]) {
        URL.revokeObjectURL(objectURLs[field])
        objectURLs[field] = null
    }
    if (file) {
        const url = URL.createObjectURL(file)
        objectURLs[field] = url
        previews.value[field] = url
    } else {
        previews.value[field] = null
    }
}
</script>
