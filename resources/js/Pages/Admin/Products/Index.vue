<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 bg-white border-b">
            <div class="flex items-center space-x-2">
                <div class="text-xl font-bold text-red-600">MADANI MOTOR</div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <img src="/indonesia.png" alt="Indonesia" class="w-6 h-4" />
                    <span>Indonesia</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white">
                        AM
                    </div>
                    <div class="text-sm">
                        <div>Admin Madani Motor</div>
                        <div class="text-gray-500">Admin</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar dan Konten -->
        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 min-h-screen bg-white border-r p-4 relative">
                <nav class="space-y-2">
                    <Link href="/admin/dashboard" class="flex items-center space-x-2 p-2 rounded-lg text-gray-700 hover:bg-gray-100">
                        <HomeIcon class="w-5 h-5" />
                        <span>Dashboard</span>
                    </Link>
                    <Link href="/admin/log-aktivitas" class="flex items-center space-x-2 p-2 rounded-lg text-gray-700 hover:bg-gray-100">
                        <UserGroupIcon class="w-5 h-5" />
                        <span>Log Aktivitas</span>
                    </Link>
                    <Link href="/admin/products" class="flex items-center space-x-2 p-2 rounded-lg bg-blue-50 text-blue-600">
                        <CubeIcon class="w-5 h-5" />
                        <span>Manajemen Produk</span>
                    </Link>
                    <Link href="/admin/reviews" class="flex items-center space-x-2 p-2 rounded-lg text-gray-700 hover:bg-gray-100">
                        <StarIcon class="w-5 h-5" />
                        <span>Manajemen Ulasan</span>
                    </Link>
                </nav>

                <!-- Profil dan Logout di bawah -->
                <div class="absolute bottom-0 left-0 w-64 p-4 border-t bg-white">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white">
                            AM
                        </div>
                        <div class="text-sm">
                            <div>Admin Madani Motor</div>
                            <div class="text-gray-500">Admin</div>
                        </div>
                    </div>
                    <button @click="logout" class="flex items-center space-x-2 text-red-600 hover:text-red-700">
                        <ArrowRightOnRectangleIcon class="w-5 h-5" />
                        <span>Logout</span>
                    </button>
                </div>
            </div>

            <!-- Konten Utama -->
            <div class="flex-1 p-8">
                <div class="mb-6 flex justify-between items-center">
                    <h1 class="text-2xl font-semibold">Manajemen Produk</h1>
                    <button
                        @click="showModal = true"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    >
                        Tambah Mobil
                    </button>
                </div>

                <!-- Pencarian -->
                <div class="mb-6">
                    <div class="relative">
                        <MagnifyingGlassIcon class="w-5 h-5 absolute left-3 top-3 text-gray-400" />
                        <input 
                            type="text" 
                            placeholder="Search" 
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            v-model="search"
                        />
                    </div>
                </div>

                <!-- Notifikasi sukses -->
                <div v-if="$page.props.flash.success" class="mb-4 text-green-600 font-medium">
                    {{ $page.props.flash.success }}
                </div>

                <!-- Tabel Data -->
                <table class="min-w-full bg-white rounded-lg shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left">ID</th>
                            <th class="py-2 px-4 text-left">Merek</th>
                            <th class="py-2 px-4 text-left">Nama Mobil</th>
                            <th class="py-2 px-4 text-left">Kondisi</th>
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
                        </tr>

                        <tr v-if="mobils.data.length === 0">
                            <td colspan="4" class="text-center py-3 text-gray-500">
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

                <!-- Modal Tambah Mobil -->
                <div
                    v-if="showModal"
                    class="fixed inset-0 flex justify-center items-center z-50 bg-gray-500/50 backdrop-blur-sm"
                >
                    <div class="bg-white p-6 rounded-lg w-[500px] shadow-xl border">
                        <h2 class="text-xl font-semibold mb-4">Tambah Mobil</h2>

                        <form @submit.prevent="submit">
                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium">Nama Mobil</label>
                                <input v-model="form.nama_mobil" type="text" class="w-full border rounded p-2" placeholder="Contoh: Avanza Veloz" />
                            </div>
                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium">Merek</label>
                                <input v-model="form.merek" type="text" class="w-full border rounded p-2" placeholder="Contoh: Toyota" />
                            </div>
                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium">Tahun</label>
                                <input v-model="form.tahun" type="number" class="w-full border rounded p-2" placeholder="Contoh: 2022" />
                            </div>
                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium">Kondisi</label>
                                <select v-model="form.kondisi" class="w-full border rounded p-2">
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Bekas">Bekas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="block mb-1 text-sm font-medium">Harga</label>
                                <input v-model="form.harga" type="number" class="w-full border rounded p-2" placeholder="Contoh: 250000000" />
                            </div>

                            <div class="flex justify-end space-x-2 mt-4">
                                <button type="button" @click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                                    Batal
                                </button>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" :disabled="form.processing">
                                    {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import { 
    HomeIcon, 
    UserGroupIcon, 
    CubeIcon, 
    StarIcon,
    ArrowRightOnRectangleIcon,
    MagnifyingGlassIcon
} from '@heroicons/vue/24/outline'

const search = ref('')
const showModal = ref(false)

const mobils = ref({
    data: [],
    links: [],
})

const form = ref({
    nama_mobil: '',
    merek: '',
    tahun: '',
    kondisi: '',
    harga: '',
    processing: false,
})

function submit() {
    form.value.processing = true
    setTimeout(() => {
        form.value.processing = false
        showModal.value = false
        alert('Data mobil berhasil disimpan (contoh simulasi)')
    }, 1000)
}

function closeModal() {
    showModal.value = false
}

function changePage(url) {
    if (!url) return
    router.visit(url)
}

function logout() {
    router.post('/logout')
}
</script>
