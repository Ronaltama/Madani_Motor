<template>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Manajemen Produk</h1>
            <button 
                @click="openModal()" 
                class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
            >
                Tambah Mobil
            </button>
        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">MEREK</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">NAMA MOBIL</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">STATUS</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="mobil in mobils.data" :key="mobil.id_mobil">
                        <td class="px-6 py-4">{{ String(mobil.id_mobil).padStart(5, '0') }}</td>
                        <td class="px-6 py-4">{{ mobil.merek }}</td>
                        <td class="px-6 py-4">{{ mobil.nama_mobil }}</td>
                        <td class="px-6 py-4">
                            <span :class="{
                                'px-2 py-1 rounded text-sm': true,
                                'bg-yellow-100 text-yellow-800': mobil.kondisi === 'Bekas',
                                'bg-green-100 text-green-800': mobil.kondisi === 'Baru'
                            }">
                                {{ mobil.kondisi }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <button @click="editMobil(mobil)" class="text-blue-600 hover:text-blue-800 mr-2">
                                Edit
                            </button>
                            <button @click="deleteMobil(mobil.id_mobil)" class="text-red-600 hover:text-red-800">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Form -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">{{ isEdit ? 'Edit Mobil' : 'Tambah Mobil' }}</h2>
                
                <form @submit.prevent="submitForm" class="space-y-4">
                    <div>
                        <label class="block mb-1">Nama Mobil</label>
                        <input v-model="form.nama_mobil" type="text" class="w-full border rounded px-3 py-2">
                        <div v-if="form.errors.nama_mobil" class="text-red-500 text-sm mt-1">
                            {{ form.errors.nama_mobil }}
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1">Merek</label>
                        <input v-model="form.merek" type="text" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Varian</label>
                        <input v-model="form.varian" type="text" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Tipe Penjual</label>
                        <select v-model="form.tipe_penjual" class="w-full border rounded px-3 py-2">
                            <option value="Dealer">Dealer</option>
                            <option value="Pribadi">Pribadi</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1">Tahun</label>
                        <input v-model="form.tahun" type="number" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Kondisi</label>
                        <select v-model="form.kondisi" class="w-full border rounded px-3 py-2">
                            <option value="Baru">Baru</option>
                            <option value="Bekas">Bekas</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1">Deskripsi</label>
                        <textarea v-model="form.deskripsi" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <div>
                        <label class="block mb-1">Harga</label>
                        <input v-model="form.harga" type="number" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeModal" class="px-4 py-2 border rounded">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            {{ isEdit ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { router, useForm } from '@inertiajs/vue3'

const props = defineProps({
    mobils: Object
})

const showModal = ref(false)
const isEdit = ref(false)

const form = useForm({
    mobil: null,   // parameter route harus 'mobil'
    nama_mobil: '',
    merek: '',
    varian: '',
    tipe_penjual: 'Dealer',
    tahun: new Date().getFullYear(),
    kondisi: 'Baru',
    deskripsi: '',
    harga: ''
})

function openModal() {
    showModal.value = true
    isEdit.value = false
    form.reset()
}

function closeModal() {
    showModal.value = false
    form.reset()
}

function submitForm() {
    if (isEdit.value) {
        // update pakai parameter route 'mobil'
        form.put(route('admin.products.update', form.mobil), {
            onSuccess: () => {
                closeModal()
            },
            onError: (errors) => console.error(errors)
        })
    } else {
        form.post(route('admin.products.store'), {
            onSuccess: () => closeModal(),
            onError: (errors) => console.error(errors)
        })
    }
}

function editMobil(mobil) {
    form.mobil = mobil.id_mobil   // sesuaikan dengan route parameter
    form.nama_mobil = mobil.nama_mobil
    form.merek = mobil.merek
    form.varian = mobil.varian
    form.tipe_penjual = mobil.tipe_penjual
    form.tahun = mobil.tahun
    form.kondisi = mobil.kondisi
    form.deskripsi = mobil.deskripsi
    form.harga = mobil.harga
    isEdit.value = true
    showModal.value = true
}

function deleteMobil(id_mobil) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        router.delete(route('admin.products.destroy', id_mobil))
    }
}
</script>
