<template>
    <NewAdminLayout>
        <div class="py-4">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold">Manajemen Ulasan</h1>
                <button
                    @click="showModal = true"
                    class="px-6 py-2 rounded-lg bg-red-700 hover:bg-red-800 text-white font-semibold"
                >
                    Tambahkan Ulasan
                </button>
            </div>

            <!-- Grid kolom per merek -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <div v-for="group in groups" :key="group.merek" class="bg-white rounded-xl shadow-sm p-4 border">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                            <div class="font-semibold">Merek {{ group.merek }}</div>
                        </div>
                    </div>
                    <div class="space-y-3 max-h-[68vh] overflow-auto pr-1">
                        <!-- Tampilkan setiap mobil di merek ini, meskipun belum ada ulasan -->
                        <div
                            v-for="m in group.mobils"
                            :key="m.id_mobil"
                            class="p-3 rounded-lg border bg-white shadow-sm"
                        >
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1">
                                    <div class="text-sm font-semibold">{{ m.nama_mobil }}</div>
                                    <div v-if="m.reviews && m.reviews.length > 0" class="mt-1 space-y-1">
                                        <div
                                            v-for="rv in m.reviews"
                                            :key="rv.id_review"
                                            class="text-xs text-gray-600"
                                        >
                                            <span class="text-yellow-600">⭐ {{ rv.rating }}</span>
                                            <span class="ml-1">{{ rv.isi_review }}</span>
                                        </div>
                                    </div>
                                    <div v-else class="text-xs text-gray-500">Belum ada ulasan.</div>
                                </div>
                                <div class="flex-shrink-0">
                                    <button
                                        class="text-xs px-3 py-1 rounded bg-red-700 hover:bg-red-800 text-white"
                                        @click="openModalFor(m.id_mobil)"
                                    >Tambah</button>
                                </div>
                            </div>
                        </div>

                        <div v-if="group.mobils.length === 0" class="text-sm text-gray-500">Belum ada mobil untuk merek ini.</div>
                    </div>
                </div>
            </div>

            <div class="text-xs text-gray-500 mt-3">Showing 1-01 of {{ total }}</div>
        </div>

        <!-- Modal Tambah Ulasan -->
        <div
            v-if="showModal"
            class="fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-sm z-50"
        >
            <div class="bg-white w-[520px] rounded-lg shadow-xl p-6">
                <h2 class="text-lg font-semibold mb-4">Tambah Ulasan</h2>
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <label class="block text-sm mb-1">Mobil</label>
                            <select v-model="form.id_mobil" class="w-full border rounded p-2">
                                <option value="">-- Pilih Mobil --</option>
                                <option v-for="m in mobils" :key="m.id_mobil" :value="m.id_mobil">{{ m.merek }} - {{ m.nama_mobil }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm mb-1">Nama Pelanggan</label>
                            <input v-model="form.nama_pelanggan" type="text" class="w-full border rounded p-2" />
                        </div>
                        <div>
                            <label class="block text-sm mb-1">Tanggal</label>
                            <input v-model="form.tanggal" type="date" class="w-full border rounded p-2" />
                        </div>
                        <div>
                            <label class="block text-sm mb-1">Rating</label>
                            <select v-model="form.rating" class="w-full border rounded p-2">
                                <option value="">-- Pilih Rating --</option>
                                <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm mb-1">Isi Ulasan</label>
                            <textarea v-model="form.isi_review" rows="4" class="w-full border rounded p-2"></textarea>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-2">
                        <button type="button" @click="closeModal" class="px-4 py-2 rounded bg-gray-400 hover:bg-gray-500 text-white">Batal</button>
                        <button type="submit" :disabled="form.processing" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">
                            {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </NewAdminLayout>
</template>

<script setup>
import NewAdminLayout from '@/Layouts/NewAdminLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { ref, defineComponent } from 'vue'

const props = defineProps({
    total: { type: Number, default: 0 },
    groups: { type: Array, default: () => [] },
    mobils: { type: Array, default: () => [] },
})

const showModal = ref(false)
const form = useForm({
    id_mobil: '',
    nama_pelanggan: '',
    tanggal: '',
    isi_review: '',
    rating: ''
})

function submit() {
    form.post('/admin/reviews', {
        onSuccess: () => {
            showModal.value = false
            form.reset()
        }
    })
}

function closeModal() {
    showModal.value = false
}

function openModalFor(idMobil) {
    form.id_mobil = idMobil
    showModal.value = true
}

// Komponen kartu ulasan sederhana
// Komponen kartu per-review tidak digunakan lagi untuk tampilan baru per mobil
</script>
