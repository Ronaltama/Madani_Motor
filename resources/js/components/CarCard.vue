<template>
    <div
        class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
    >
        <!-- Image Container -->
        <div class="relative">
            <!-- Badge -->
            <div class="absolute top-3 left-3 z-10">
                <div
                    class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center space-x-1"
                >
                    <svg
                        class="w-4 h-4"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                        />
                    </svg>
                </div>
            </div>

            <!-- Image -->
            <Link :href="`/mobil/${mobil.id_mobil}`">
                <div class="aspect-[4/3] bg-gray-200 relative overflow-hidden">
                    <img
                        v-if="mobil.foto && mobil.foto.full_body"
                        :src="`/storage/${mobil.foto.full_body}`"
                        :alt="mobil.nama_mobil"
                        class="w-full h-full object-cover hover:scale-110 transition-transform duration-300"
                    />
                    <div
                        v-else
                        class="w-full h-full flex items-center justify-center bg-gray-300"
                    >
                        <svg
                            class="w-20 h-20 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                    </div>
                </div>
            </Link>
        </div>

        <!-- Content -->
        <div class="p-4">
            <Link :href="`/mobil/${mobil.id_mobil}`">
                <h3
                    class="font-bold text-lg text-gray-800 mb-2 hover:text-red-600 transition"
                >
                    {{ mobil.nama_mobil }}
                </h3>
            </Link>

            <p class="text-sm text-gray-600 mb-1">
                {{ mobil.merek }} {{ mobil.tahun }}
            </p>

            <p class="text-2xl font-bold text-red-600 mb-4">
                Rp {{ formatPrice(mobil.harga) }},-
            </p>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input
                        type="checkbox"
                        v-model="isComparing"
                        @change="toggleCompare"
                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                    />
                    <span class="text-sm text-gray-600">Bandingkan</span>
                </label>

                <button
                    @click="viewDetails"
                    class="text-blue-600 hover:text-blue-800 transition"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    mobil: {
        type: Object,
        required: true,
    },
});

const isComparing = ref(false);

const formatPrice = (price) => {
    if (!price) return "0";
    return new Intl.NumberFormat("id-ID").format(price);
};

const toggleCompare = () => {
    // Logic untuk menambah/menghapus mobil dari comparison list
    // Bisa menggunakan local storage atau state management
    console.log("Toggle compare:", props.mobil.id_mobil);
};

const viewDetails = () => {
    router.visit(`/mobil/${props.mobil.id_mobil}`);
};
</script>
