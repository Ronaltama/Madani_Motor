<template>
    <PublicLayout>
        <section class="max-w-[1600px] mx-auto px-6 md:px-8 lg:px-12 py-16">
            <!-- Back Button -->
            <div class="mb-4">
                <button
                    @click="goBack"
                    class="inline-flex items-center gap-1.5 text-gray-600 hover:text-red-600 transition-colors text-sm group"
                >
                    <svg
                        class="w-4 h-4 transition-colors"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                    <span class="font-medium">Kembali</span>
                </button>
            </div>

            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold mb-3">Daftar Mobil Tersedia</h1>
                <div class="w-24 h-1 bg-[#BB0102] mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[250px_1fr] gap-4">
                <!-- Sidebar Filter & Sort -->
                <aside class="lg:col-span-1">
                    <div
                        class="sticky top-28 bg-white p-5 rounded-lg shadow-md"
                    >
                        <!-- Judul Filter Pencarian -->
                        <div class="mb-6">
                            <h2
                                class="text-lg font-bold inline-block relative pb-2"
                            >
                                Filter Pencarian
                            </h2>
                            <div
                                class="w-20 h-1 bg-[#BB0102] mt-1 rounded-full"
                            ></div>
                        </div>

                        <!-- Urutkan Section -->
                        <h3
                            class="text-sm font-semibold mb-3 border-b border-gray-300 pb-2"
                        >
                            Urutkan
                        </h3>
                        <div class="space-y-2 mb-5">
                            <div class="flex items-center">
                                <input
                                    type="radio"
                                    id="sort-default"
                                    value="default"
                                    v-model="sortByTemp"
                                    class="h-4 w-4 text-[#BB0102] focus:ring-[#BB0102] accent-[#BB0102]"
                                />
                                <label
                                    for="sort-default"
                                    class="ml-2 block text-xs text-gray-700 cursor-pointer"
                                    >Default</label
                                >
                            </div>
                            <div class="flex items-center">
                                <input
                                    type="radio"
                                    id="sort-price-asc"
                                    value="priceAsc"
                                    v-model="sortByTemp"
                                    class="h-4 w-4 text-[#BB0102] focus:ring-[#BB0102] accent-[#BB0102]"
                                />
                                <label
                                    for="sort-price-asc"
                                    class="ml-2 block text-xs text-gray-700 cursor-pointer"
                                    >Harga Termurah</label
                                >
                            </div>
                            <div class="flex items-center">
                                <input
                                    type="radio"
                                    id="sort-year-desc"
                                    value="yearDesc"
                                    v-model="sortByTemp"
                                    class="h-4 w-4 text-[#BB0102] focus:ring-[#BB0102] accent-[#BB0102]"
                                />
                                <label
                                    for="sort-year-desc"
                                    class="ml-2 block text-xs text-gray-700 cursor-pointer"
                                    >Tahun Terbaru</label
                                >
                            </div>
                            <div class="flex items-center">
                                <input
                                    type="radio"
                                    id="sort-km-asc"
                                    value="kmAsc"
                                    v-model="sortByTemp"
                                    class="h-4 w-4 text-[#BB0102] focus:ring-[#BB0102] accent-[#BB0102]"
                                />
                                <label
                                    for="sort-km-asc"
                                    class="ml-2 block text-xs text-gray-700 cursor-pointer"
                                    >Km Terendah</label
                                >
                            </div>
                        </div>

                        <!-- Transmisi Section -->
                        <h3
                            class="text-sm font-semibold mb-3 border-b border-gray-300 pb-2"
                        >
                            Transmisi
                        </h3>
                        <div class="space-y-2 mb-5">
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="trans-manual"
                                    value="Manual"
                                    v-model="transmissionTemp"
                                    class="h-4 w-4 text-[#BB0102] focus:ring-[#BB0102] accent-[#BB0102] rounded"
                                />
                                <label
                                    for="trans-manual"
                                    class="ml-2 block text-xs text-gray-700 cursor-pointer"
                                    >Manual</label
                                >
                            </div>
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="trans-automatic"
                                    value="Automatic"
                                    v-model="transmissionTemp"
                                    class="h-4 w-4 text-[#BB0102] focus:ring-[#BB0102] accent-[#BB0102] rounded"
                                />
                                <label
                                    for="trans-automatic"
                                    class="ml-2 block text-xs text-gray-700 cursor-pointer"
                                    >Automatic</label
                                >
                            </div>
                        </div>

                        <!-- Filter Harga Section -->
                        <h3
                            class="text-sm font-semibold mb-3 border-b border-gray-300 pb-2"
                        >
                            Harga
                        </h3>
                        <div class="mb-5">
                            <p class="text-xs text-gray-600 mb-3">
                                Rentang harga dipilih
                            </p>

                            <!-- Range Slider -->
                            <div class="relative pt-1 px-1 mb-8">
                                <!-- Track Background -->
                                <div
                                    class="relative h-2 bg-gray-200 rounded-full"
                                >
                                    <!-- Colored Track -->
                                    <div
                                        class="absolute h-full bg-[#BB0102] rounded-full"
                                        :style="{
                                            left:
                                                ((minPriceTemp - 25000000) /
                                                    (2000000000 - 25000000)) *
                                                    100 +
                                                '%',
                                            right:
                                                100 -
                                                ((maxPriceTemp - 25000000) /
                                                    (2000000000 - 25000000)) *
                                                    100 +
                                                '%',
                                        }"
                                    ></div>
                                </div>

                                <!-- Min Range Slider -->
                                <input
                                    type="range"
                                    :min="25000000"
                                    :max="2000000000"
                                    :step="5000000"
                                    v-model.number="minPriceTemp"
                                    @input="handleMinPriceChange"
                                    class="range-slider-min"
                                />

                                <!-- Max Range Slider -->
                                <input
                                    type="range"
                                    :min="25000000"
                                    :max="2000000000"
                                    :step="5000000"
                                    v-model.number="maxPriceTemp"
                                    @input="handleMaxPriceChange"
                                    class="range-slider-max"
                                />
                            </div>

                            <!-- Display Selected Price Range -->
                            <div
                                class="flex justify-between mt-4 text-xs font-medium text-gray-700"
                            >
                                <span>Rp {{ formatPrice(minPriceTemp) }}</span>
                                <span>Rp {{ formatPrice(maxPriceTemp) }}</span>
                            </div>
                        </div>

                        <!-- Tombol Reset Filter -->
                        <button
                            @click="resetFilters"
                            class="w-full mb-3 px-4 py-2 bg-white text-[#BB0102] border-2 border-[#BB0102] rounded-md hover:bg-red-50 text-sm font-semibold transition-colors"
                        >
                            Reset Filter
                        </button>

                        <!-- Tombol Terapkan Filter -->
                        <button
                            @click="applyFilters"
                            class="w-full px-4 py-2 bg-[#BB0102] text-white rounded-md hover:bg-red-700 text-sm font-semibold transition-colors"
                        >
                            Terapkan Filter
                        </button>
                    </div>
                </aside>

                <!-- Main Content - Grid Mobil -->
                <main>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
                    >
                        <CardMobil
                            v-for="car in filteredAndSortedCars"
                            :key="car.id"
                            :car="car"
                            class="w-full"
                        />
                    </div>

                    <!-- Empty State -->
                    <div
                        v-if="filteredAndSortedCars.length === 0"
                        class="text-center text-gray-500 py-20"
                    >
                        <p class="text-xl font-semibold">
                            Mobil tidak ditemukan
                        </p>
                        <p class="text-sm mt-2">
                            Silakan coba ubah atau reset filter Anda.
                        </p>
                    </div>
                </main>
            </div>
        </section>
        <CompareBox />
    </PublicLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import PublicLayout from "@/Layouts/PublicLayout.vue";
import CardMobil from "@/components/CardMobil.vue";
import CompareBox from "@/components/CompareBox.vue";

const props = defineProps({
    cars: {
        type: Array,
        default: () => [],
    },
});

const sortByTemp = ref("default");
const minPriceTemp = ref(25000000);
const maxPriceTemp = ref(2000000000);
const transmissionTemp = ref([]);

const sortBy = ref("default");
const minPrice = ref(25000000);
const maxPrice = ref(2000000000);
const transmission = ref([]);

// Fungsi untuk konversi km string ke number
const parseKm = (kmString) => {
    if (!kmString) return 0;
    return parseInt(kmString.replace(/\D/g, "")) || 0;
};

// Fungsi untuk format harga
const formatPrice = (price) => {
    if (price >= 1000000000) {
        return (price / 1000000000).toFixed(1).replace(".0", "") + " Miliar";
    } else if (price >= 1000000) {
        return (price / 1000000).toFixed(0) + " Juta";
    }
    return price.toString();
};

const goBack = () => {
    window.history.back();
};

// Handle perubahan min price agar tidak melebihi max
const handleMinPriceChange = () => {
    if (minPriceTemp.value > maxPriceTemp.value) {
        minPriceTemp.value = maxPriceTemp.value;
    }
};

// Handle perubahan max price agar tidak kurang dari min
const handleMaxPriceChange = () => {
    if (maxPriceTemp.value < minPriceTemp.value) {
        maxPriceTemp.value = minPriceTemp.value;
    }
};

// Computed property untuk menampilkan mobil
const filteredAndSortedCars = computed(() => {
    let filtered = [...props.cars];

    // 1. Proses Filter Harga
    filtered = filtered.filter(
        (car) => car.price >= minPrice.value && car.price <= maxPrice.value
    );

    // 2. Proses Filter Transmisi
    if (transmission.value.length > 0) {
        filtered = filtered.filter((car) =>
            transmission.value.includes(car.transmission)
        );
    }

    // 3. Proses Sorting
    switch (sortBy.value) {
        case "priceAsc":
            filtered.sort((a, b) => a.price - b.price);
            break;
        case "yearDesc":
            filtered.sort((a, b) => b.year - a.year);
            break;
        case "kmAsc":
            filtered.sort((a, b) => parseKm(a.km) - parseKm(b.km));
            break;
        case "default":
        default:
            filtered.sort((a, b) => a.id - b.id);
            break;
    }

    return filtered;
});

// Fungsi untuk menerapkan filter
const applyFilters = () => {
    sortBy.value = sortByTemp.value;
    minPrice.value = minPriceTemp.value;
    maxPrice.value = maxPriceTemp.value;
    transmission.value = [...transmissionTemp.value];
};

// Fungsi untuk reset filter
const resetFilters = () => {
    // Reset temporary state
    sortByTemp.value = "default";
    minPriceTemp.value = 25000000;
    maxPriceTemp.value = 2000000000;
    transmissionTemp.value = [];

    // Reset active state
    sortBy.value = "default";
    minPrice.value = 25000000;
    maxPrice.value = 2000000000;
    transmission.value = [];
};
</script>

<style scoped>
/* Menghilangkan panah atas/bawah di input number */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
    appearance: textfield;
}

/* Styling untuk range slider */
.range-slider-min,
.range-slider-max {
    position: absolute;
    width: 100%;
    height: 2px;
    top: 4px;
    left: 0;
    background: transparent;
    pointer-events: none;
    -webkit-appearance: none;
    appearance: none;
}

/* Thumb styling untuk Chrome/Safari */
.range-slider-min::-webkit-slider-thumb,
.range-slider-max::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #bb0102;
    cursor: pointer;
    border: 3px solid white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    pointer-events: all;
    position: relative;
    z-index: 10;
}

/* Thumb styling untuk Firefox */
.range-slider-min::-moz-range-thumb,
.range-slider-max::-moz-range-thumb {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #bb0102;
    cursor: pointer;
    border: 3px solid white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    pointer-events: all;
}

/* Max slider thumb lebih tinggi z-index agar bisa overlap min thumb */
.range-slider-max::-webkit-slider-thumb {
    z-index: 20;
}

/* Hover effect */
.range-slider-min::-webkit-slider-thumb:hover,
.range-slider-max::-webkit-slider-thumb:hover {
    background: #990000;
    transform: scale(1.1);
}

.range-slider-min::-moz-range-thumb:hover,
.range-slider-max::-moz-range-thumb:hover {
    background: #990000;
    transform: scale(1.1);
}

/* Track styling untuk Firefox */
.range-slider-min::-moz-range-track,
.range-slider-max::-moz-range-track {
    background: transparent;
    border: none;
}
</style>
