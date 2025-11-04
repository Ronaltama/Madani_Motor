<template>
    <Head title="Edit Produk" />
    <AdminLayout>
        <div class="max-w-4xl mx-auto space-y-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Produk</h2>
                <p class="text-gray-600 mt-1">Ubah data produk di bawah</p>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-lg shadow p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                        <input v-model="form.nama_mobil" type="text" placeholder="Masukkan Judul" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi</label>
                        <div class="flex gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input v-model="form.kondisi" type="radio" value="Baru" class="w-4 h-4" />
                                <span class="ml-2 text-sm">Baru</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input v-model="form.kondisi" type="radio" value="Bekas" class="w-4 h-4" />
                                <span class="ml-2 text-sm">Bekas</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <input v-model="form.tahun" type="number" placeholder="Masukkan Tahun" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Merek</label>
                        <input v-model="form.merek" type="text" placeholder="Masukkan nama merek" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                        <input v-model="form.tipe" type="text" placeholder="Masukkan nama Model" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Varian</label>
                        <input v-model="form.varian" type="text" placeholder="Masukkan varian" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                        <input v-model="form.warna" type="text" placeholder="Masukkan warna" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <input v-model="form.plat_asal" type="text" placeholder="Masukkan Lokasi" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Masa Berlaku</label>
                        <input v-model="form.masa_berlaku" type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kilometer</label>
                        <input v-model="form.kilometer" type="number" placeholder="Masukkan kilometer" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Penjual</label>
                        <input v-model="form.tipe_penjual" type="text" placeholder="Masukkan tipe penjual" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Transmisi</label>
                        <input v-model="form.transmisi" type="text" placeholder="Masukkan Transmisi" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                        <input v-model="form.harga" type="number" placeholder="Masukkan harga" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bahan Bakar</label>
                        <input v-model="form.bahan_bakar" type="text" placeholder="Masukkan bahan bakar" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sistem Penggerak</label>
                        <input v-model="form.sistem_penggerak" type="text" placeholder="Masukkan sistem penggerak" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Spare Key</label>
                        <input v-model="form.spare_key" type="text" placeholder="Masukkan spare key" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Polisi</label>
                        <input v-model="form.nomor_polisi" type="text" placeholder="Masukkan nomor polisi" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Toolkit</label>
                        <input v-model="form.toolkit" type="text" placeholder="Masukkan toolkit" class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea v-model="form.deskripsi" rows="4" placeholder="Write description about your car" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></textarea>
                    </div>
                </div>
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">Upload Foto Mobil</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Depan</label>
                            <img v-if="mobil.foto && mobil.foto[0]?.foto_depan" :src="`/storage/mobils/${mobil.foto[0].foto_depan}`" class="w-32 h-20 object-cover rounded mb-2" />
                            <label class="flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg cursor-pointer hover:bg-yellow-600 text-sm justify-center">
                                <span> {{ form.foto_depan ? 'Ganti' : 'Upload' }} foto tampak depan</span>
                                <input type="file" @change="handleFileUpload($event, 'foto_depan')" accept="image/*" class="hidden" />
                            </label>
                            <p v-if="form.foto_depan" class="text-xs text-gray-600 mt-1">{{ form.foto_depan.name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Belakang</label>
                            <img v-if="mobil.foto && mobil.foto[0]?.foto_belakang" :src="`/storage/mobils/${mobil.foto[0].foto_belakang}`" class="w-32 h-20 object-cover rounded mb-2" />
                            <label class="flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg cursor-pointer hover:bg-yellow-600 text-sm justify-center">
                                <span> {{ form.foto_belakang ? 'Ganti' : 'Upload' }} foto tampak belakang</span>
                                <input type="file" @change="handleFileUpload($event, 'foto_belakang')" accept="image/*" class="hidden" />
                            </label>
                            <p v-if="form.foto_belakang" class="text-xs text-gray-600 mt-1">{{ form.foto_belakang.name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Samping Kiri</label>
                            <img v-if="mobil.foto && mobil.foto[0]?.foto_kiri" :src="`/storage/mobils/${mobil.foto[0].foto_kiri}`" class="w-32 h-20 object-cover rounded mb-2" />
                            <label class="flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg cursor-pointer hover:bg-yellow-600 text-sm justify-center">
                                <span> {{ form.foto_kiri ? 'Ganti' : 'Upload' }} foto tampak kiri</span>
                                <input type="file" @change="handleFileUpload($event, 'foto_kiri')" accept="image/*" class="hidden" />
                            </label>
                            <p v-if="form.foto_kiri" class="text-xs text-gray-600 mt-1">{{ form.foto_kiri.name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Samping Kanan</label>
                            <img v-if="mobil.foto && mobil.foto[0]?.foto_kanan" :src="`/storage/mobils/${mobil.foto[0].foto_kanan}`" class="w-32 h-20 object-cover rounded mb-2" />
                            <label class="flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg cursor-pointer hover:bg-yellow-600 text-sm justify-center">
                                <span> {{ form.foto_kanan ? 'Ganti' : 'Upload' }} foto tampak kanan</span>
                                <input type="file" @change="handleFileUpload($event, 'foto_kanan')" accept="image/*" class="hidden" />
                            </label>
                            <p v-if="form.foto_kanan" class="text-xs text-gray-600 mt-1">{{ form.foto_kanan.name }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-t pt-6 flex gap-4 justify-center">
                    <button type="button" @click="$inertia.visit(route('admin.products.index'))" class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg">Kembali</button>
                    <button type="submit" :disabled="form.processing" class="px-6 py-3 bg-red-700 hover:bg-red-800 text-white font-semibold rounded-lg disabled:opacity-50">{{ form.processing ? 'Menyimpan...' : 'Update Product' }}</button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
const props = defineProps({ mobil: Object });
const form = useForm({
    nama_mobil: props.mobil.nama_mobil || '', merek: props.mobil.merek || '', varian: props.mobil.varian || '', tipe: props.mobil.spesifikasi?.tipe || '', tipe_penjual: props.mobil.tipe_penjual || '', tahun: props.mobil.tahun || '', kondisi: props.mobil.kondisi || 'Baru', deskripsi: props.mobil.deskripsi || '', harga: props.mobil.harga || '',
    warna: props.mobil.spesifikasi?.warna || '', plat_asal: props.mobil.spesifikasi?.plat_asal || '', masa_berlaku: props.mobil.spesifikasi?.masa_berlaku || '', kilometer: props.mobil.spesifikasi?.kilometer || '', transmisi: props.mobil.spesifikasi?.transmisi || '', bahan_bakar: props.mobil.spesifikasi?.bahan_bakar || '', sistem_penggerak: props.mobil.spesifikasi?.sistem_penggerak || '',
    spare_key: props.mobil.spesifikasi?.spare_key || '', nomor_polisi: props.mobil.spesifikasi?.nomor_polisi || '', toolkit: props.mobil.spesifikasi?.toolkit || '', foto_depan: null, foto_belakang: null, foto_kiri: null, foto_kanan: null,
});
function handleFileUpload(event, field) { const file = event.target.files[0]; if (file) form[field] = file; }
function submit() { form.post(route('admin.products.update', props.mobil.id_mobil), { forceFormData: true, _method: 'PUT' }); }
</script>
