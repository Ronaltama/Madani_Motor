<template>
    <section class="py-4">
        <div class="max-w-[1600px] mx-auto px-12 md:px-16 lg:px-24">
            <!-- Title -->
            <div class="text-center mb-4">
                <h1 class="text-3xl font-bold mb-3">Mobil Pilihan</h1>
                <div class="w-24 h-1 bg-[#BB0102] mx-auto rounded-full"></div>
            </div>

            <!-- Rekomendasi -->
            <div class="mb-12">
                <div class="mb-6">
                    <h2 class="text-xl font-bold inline-block relative pb-2">
                        Rekomendasi
                    </h2>
                    <div class="w-24 h-1 bg-[#BB0102] mt-1 rounded-full"></div>
                </div>
                <div class="relative">
                    <button
                        v-show="scrollStates.rekomendasi.showLeft"
                        @click="scrollLeft('rekomendasi')"
                        class="absolute -left-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center hover:opacity-70 transition-all"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-9 h-9 text-black"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M15 18l-6-6 6-6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>

                    <div
                        ref="rekomendasiScroll"
                        @scroll="handleScroll('rekomendasi')"
                        class="flex gap-4 overflow-x-auto pb-4 scroll-smooth pr-2 -ml-2 pl-2"
                    >
                        <CardMobil
                            v-for="car in rekomendasi"
                            :key="car.id"
                            :car="car"
                            class="flex-shrink-0"
                        />
                    </div>

                    <button
                        v-show="scrollStates.rekomendasi.showRight"
                        @click="scrollRight('rekomendasi')"
                        class="absolute -right-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center hover:opacity-70 transition-all"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-9 h-9 text-black"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M9 18l6-6-6-6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Tahun Terbaru -->
            <div class="mb-12">
                <div class="mb-6">
                    <h2 class="text-xl font-bold inline-block relative pb-2">
                        Tahun Terbaru
                    </h2>
                    <div class="w-24 h-1 bg-[#BB0102] mt-1 rounded-full"></div>
                </div>
                <div class="relative">
                    <button
                        v-show="scrollStates.tahunTerbaru.showLeft"
                        @click="scrollLeft('tahunTerbaru')"
                        class="absolute -left-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center hover:opacity-70 transition-all"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 text-black"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M15 18l-6-6 6-6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>

                    <div
                        ref="tahunTerbaruScroll"
                        @scroll="handleScroll('tahunTerbaru')"
                        class="flex gap-4 overflow-x-auto pb-4 scroll-smooth pr-2 -ml-2 pl-2"
                    >
                        <CardMobil
                            v-for="car in tahunTerbaru"
                            :key="car.id"
                            :car="car"
                            class="flex-shrink-0"
                        />
                    </div>

                    <button
                        v-show="scrollStates.tahunTerbaru.showRight"
                        @click="scrollRight('tahunTerbaru')"
                        class="absolute -right-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center hover:opacity-70 transition-all"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 text-black"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M9 18l6-6-6-6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Harga Termurah -->
            <div class="mb-12">
                <div class="mb-6">
                    <h2 class="text-xl font-bold inline-block relative pb-2">
                        Harga Termurah
                    </h2>
                    <div class="w-24 h-1 bg-[#BB0102] mt-1 rounded-full"></div>
                </div>
                <div class="relative">
                    <button
                        v-show="scrollStates.hargaTermurah.showLeft"
                        @click="scrollLeft('hargaTermurah')"
                        class="absolute -left-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center hover:opacity-70 transition-all"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 text-black"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M15 18l-6-6 6-6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>

                    <div
                        ref="hargaTermurahScroll"
                        @scroll="handleScroll('hargaTermurah')"
                        class="flex gap-4 overflow-x-auto pb-4 scroll-smooth pr-2 -ml-2 pl-2"
                    >
                        <CardMobil
                            v-for="car in hargaTermurah"
                            :key="car.id"
                            :car="car"
                            class="flex-shrink-0"
                        />
                    </div>

                    <button
                        v-show="scrollStates.hargaTermurah.showRight"
                        @click="scrollRight('hargaTermurah')"
                        class="absolute -right-12 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center hover:opacity-70 transition-all"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 text-black"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M9 18l6-6-6-6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Button -->
            <div class="text-center mt-10 mb-8">
                <Link
                    :href="route('cars.index')"
                    class="inline-block px-10 py-3 bg-[#BB0102] text-white rounded-full hover:bg-[#990101] active:scale-95 transition-all duration-300 font-bold text-base shadow-lg hover:shadow-xl"
                >
                    Lihat Daftar Mobil
                </Link>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, reactive, onMounted, nextTick } from "vue";
import { Link } from "@inertiajs/vue3";
import CardMobil from "@/components/CardMobil.vue";

const props = defineProps({
    cars: {
        type: Array,
        default: () => [],
    },
});

// Scroll Refs
const rekomendasiScroll = ref(null);
const tahunTerbaruScroll = ref(null);
const hargaTermurahScroll = ref(null);

// Scroll State
const scrollStates = reactive({
    rekomendasi: { showLeft: false, showRight: true },
    tahunTerbaru: { showLeft: false, showRight: true },
    hargaTermurah: { showLeft: false, showRight: true },
});

// Sorting logic
const hargaTermurah = computed(() =>
    [...props.cars].sort((a, b) => a.price - b.price)
);

const tahunTerbaru = computed(() =>
    [...props.cars].sort((a, b) => b.year - a.year)
);

const rekomendasi = computed(() =>
    [...props.cars].sort((a, b) => {
        if (b.year !== a.year) return b.year - a.year;
        return a.price - b.price;
    })
);

// Map untuk kontrol scroll
const refMap = {
    rekomendasi: rekomendasiScroll,
    tahunTerbaru: tahunTerbaruScroll,
    hargaTermurah: hargaTermurahScroll,
};

function handleScroll(section) {
    const el = refMap[section].value;
    if (!el) return;

    const scrollLeft = el.scrollLeft;
    const scrollWidth = el.scrollWidth;
    const clientWidth = el.clientWidth;

    scrollStates[section].showLeft = scrollLeft > 5;
    scrollStates[section].showRight =
        scrollLeft < scrollWidth - clientWidth - 5;
}

function scrollLeft(section) {
    const el = refMap[section].value;
    el?.scrollBy({ left: -300, behavior: "smooth" });
}

function scrollRight(section) {
    const el = refMap[section].value;
    el?.scrollBy({ left: 300, behavior: "smooth" });
}

onMounted(() => {
    nextTick(() => {
        handleScroll("rekomendasi");
        handleScroll("tahunTerbaru");
        handleScroll("hargaTermurah");
    });
});
</script>

<style scoped>
.overflow-x-auto::-webkit-scrollbar {
    height: 4px;
}
.overflow-x-auto::-webkit-scrollbar-track {
    background: linear-gradient(to right, #f5f5f5, #e5e5e5);
    border-radius: 10px;
}
.overflow-x-auto::-webkit-scrollbar-thumb {
    background: rgba(190, 188, 189, 0.4);
    border-radius: 10px;
    transition: all 0.3s ease;
}
.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: rgba(190, 188, 189, 1);
}
.overflow-x-auto:hover::-webkit-scrollbar {
    height: 8px;
}
.overflow-x-auto::-webkit-scrollbar-thumb:active {
    background: rgba(190, 188, 189, 1);
    height: 8px;
}
</style>
