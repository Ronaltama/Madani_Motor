<template>
    <Transition name="slide-up">
        <div
            v-if="compareStore.selectedCars.length > 0"
            class="fixed bottom-0 left-0 right-0 bg-white shadow-2xl border-t-2 border-[#BB0102] z-50"
        >
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between gap-4">
                    <!-- Left: Selected Cars -->
                    <div class="flex items-center gap-4 flex-1">
                        <h3 class="font-bold text-gray-800 whitespace-nowrap">
                            Bandingkan ({{
                                compareStore.selectedCars.length
                            }}/3)
                        </h3>
                        <div class="flex gap-3 flex-1 overflow-x-auto">
                            <div
                                v-for="car in compareStore.selectedCars"
                                :key="car.id"
                                class="flex items-center gap-2 bg-gray-100 rounded-lg px-3 py-2 min-w-fit"
                            >
                                <img
                                    :src="car.image"
                                    :alt="car.name"
                                    class="w-12 h-12 object-cover rounded"
                                />
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-sm font-semibold text-gray-800 truncate"
                                    >
                                        {{ car.name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ car.year }}
                                    </p>
                                </div>
                                <button
                                    @click="compareStore.toggleCompare(car)"
                                    class="text-red-600 hover:text-red-800 transition-colors"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Actions -->
                    <div class="flex items-center gap-3">
                        <button
                            @click="compareStore.clearCompare"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 font-semibold transition-colors"
                        >
                            Clear All
                        </button>
                        <Link
                            :href="
                                route('compare', {
                                    cars: compareStore.selectedCars
                                        .map((car) => car.id)
                                        .join(','),
                                })
                            "
                            class="px-6 py-2 bg-[#BB0102] text-white rounded-full hover:bg-[#990101] font-bold transition-all shadow-lg hover:shadow-xl"
                        >
                            Bandingkan Sekarang
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { useCompareStore } from "@/stores/compareStore";

const compareStore = useCompareStore();
</script>

<style scoped>
.slide-up-enter-active,
.slide-up-leave-active {
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.slide-up-enter-from,
.slide-up-leave-to {
    transform: translateY(100%);
    opacity: 0;
}
</style>
