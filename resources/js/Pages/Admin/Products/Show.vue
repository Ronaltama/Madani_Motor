<template>
    <NewAdminLayout>
        <div class="py-4">
            <h1 class="text-2xl font-semibold mb-6">Detail Mobil</h1>

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="border-2 border-red-600 rounded-xl p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Info kiri -->
                        <div class="lg:col-span-2">
                            <div class="space-y-4">
                                <div>
                                    <div class="text-sm text-gray-500">Nama Mobil</div>
                                    <div class="text-xl font-semibold">{{ mobil.nama_mobil }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Merek</div>
                                    <div>{{ mobil.merek }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Varian</div>
                                    <div>{{ mobil.varian || '-' }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Kondisi</div>
                                    <span class="px-2 py-1 rounded text-sm" :class="mobil.kondisi==='Baru' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'">{{ mobil.kondisi }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <div class="text-sm text-gray-500">Ditambahkan pada</div>
                                        <div>{{ formatDate(mobil.created_at) }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm text-gray-500">Masa Berlaku</div>
                                        <div>{{ masaBerlaku }}</div>
                                    </div>
                                </div>

                                <div class="flex gap-3 mt-2">
                                    <button @click="goEdit" class="px-4 py-2 rounded bg-yellow-500 hover:bg-yellow-600 text-white">Edit</button>
                                    <button @click="goBack" class="px-4 py-2 rounded bg-gray-500 hover:bg-gray-600 text-white">Kembali</button>
                                </div>
                            </div>
                        </div>

                        <!-- Foto kanan -->
                        <div class="space-y-4">
                            <PhotoCard title="Foto depan" :src="mobil.foto?.foto_depan" />
                            <PhotoCard title="Foto belakang" :src="mobil.foto?.foto_belakang" />
                            <PhotoCard title="Foto samping kiri" :src="mobil.foto?.foto_kiri" />
                            <PhotoCard title="Foto samping kanan" :src="mobil.foto?.foto_kanan" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </NewAdminLayout>
</template>

<script setup>
import NewAdminLayout from '@/Layouts/NewAdminLayout.vue'
import { router } from '@inertiajs/vue3'
import { computed, defineComponent } from 'vue'

const props = defineProps({
    mobil: { type: Object, required: true }
})

const masaBerlaku = computed(() => {
    // contoh +2 tahun dari created_at (placeholder agar mirip desain)
    if (!props.mobil?.created_at) return '-'
    const d = new Date(props.mobil.created_at)
    d.setFullYear(d.getFullYear() + 2)
    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })
})

function formatDate(date) {
    if (!date) return '-'
    return new Date(date).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })
}

function goBack() { history.back() }
function goEdit() {
    router.visit('/admin/products')
}

// Local component to render a photo card reliably within <script setup>
const PhotoCard = defineComponent({
    name: 'PhotoCard',
    props: {
        title: { type: String, required: true },
        src: { type: String, default: '' }
    },
    computed: {
        resolvedSrc() {
            // If backend saved a relative path like "/images/...", use as-is
            // If empty or null, return empty so placeholder shows
            return this.src || ''
        }
    },
    template: `
        <div>
            <div class="text-sm font-semibold mb-1">{{ title }}</div>
            <div class="w-full h-28 bg-gray-100 rounded overflow-hidden flex items-center justify-center border">
                <img v-if="resolvedSrc" :src="resolvedSrc" alt="Foto {{ title }}" class="object-cover w-full h-full" />
                <span v-else class="text-xs text-gray-400">Belum ada foto</span>
            </div>
        </div>
    `
})
</script>