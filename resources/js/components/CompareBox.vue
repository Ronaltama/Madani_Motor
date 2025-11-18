<template>
    <Transition name="slide-up">
        <div
            v-if="compareStore.selectedCars.length > 0"
            class="fixed bottom-0 left-0 right-0 bg-white shadow-2xl border-t-2 border-[#BB0102] z-50"
        >
            <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 py-3 sm:py-4">
                <!-- Desktop Layout -->
                <div class="hidden md:flex items-center justify-between gap-4">
                    <!-- Left: Selected Cars -->
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <h3 class="font-bold text-gray-800 whitespace-nowrap flex-shrink-0">
                            Bandingkan ({{
                                compareStore.selectedCars.length
                            }}/3)
                        </h3>
                        <div class="flex gap-3 flex-1 overflow-x-auto min-w-0">
                            <div
                                v-for="car in compareStore.selectedCars"
                                :key="car.id"
                                class="flex items-center gap-2 bg-gray-100 rounded-lg px-3 py-2 flex-shrink-0 min-w-[200px]"
                            >
                                <img
                                    :src="car.image"
                                    :alt="car.name"
                                    class="w-12 h-12 object-cover rounded flex-shrink-0"
                                />
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-sm font-semibold text-gray-800 truncate"
                                    >
                                        {{ car.name }}
                                    </p>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ car.year }}
                                    </p>
                                </div>
                                <button
                                    @click="compareStore.toggleCompare(car)"
                                    class="text-red-600 hover:text-red-800 transition-colors flex-shrink-0"
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
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <button
                            @click="compareStore.clearCompare"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 font-semibold transition-colors whitespace-nowrap"
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
                            class="px-6 py-2 bg-[#BB0102] text-white rounded-full hover:bg-[#990101] font-bold transition-all shadow-lg hover:shadow-xl whitespace-nowrap flex-shrink-0"
                        >
                            Bandingkan Sekarang
                        </Link>
                    </div>
                </div>

                <!-- Mobile & Tablet Layout -->
                <div class="md:hidden">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-gray-800 text-sm sm:text-base">
                            Bandingkan ({{
                                compareStore.selectedCars.length
                            }}/3)
                        </h3>
                        <button
                            @click="compareStore.clearCompare"
                            class="text-xs sm:text-sm text-gray-600 hover:text-gray-800 font-semibold transition-colors whitespace-nowrap"
                        >
                            Clear All
                        </button>
                    </div>

                    <!-- Selected Cars (Horizontal Scroll) -->
                    <div class="flex gap-2 overflow-x-auto mb-3 pb-2">
                        <div
                            v-for="car in compareStore.selectedCars"
                            :key="car.id"
                            class="flex items-center gap-2 bg-gray-100 rounded-lg p-2 flex-shrink-0 min-w-[160px] sm:min-w-[180px]"
                        >
                            <img
                                :src="car.image"
                                :alt="car.name"
                                class="w-10 h-10 sm:w-12 sm:h-12 object-cover rounded flex-shrink-0"
                            />
                            <div class="flex-1 min-w-0 max-w-[120px] sm:max-w-[150px]">
                                <p
                                    class="text-xs sm:text-sm font-semibold text-gray-800 truncate"
                                >
                                    {{ car.name }}
                                </p>
                                <p class="text-[10px] sm:text-xs text-gray-500 truncate">
                                    {{ car.year }}
                                </p>
                            </div>
                            <button
                                @click="compareStore.toggleCompare(car)"
                                class="text-red-600 hover:text-red-800 transition-colors flex-shrink-0"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 sm:h-5 sm:w-5"
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

                    <!-- Compare Button -->
                    <Link
                        :href="
                            route('compare', {
                                cars: compareStore.selectedCars
                                    .map((car) => car.id)
                                    .join(','),
                            })
                        "
                        class="block w-full text-center px-4 py-2.5 sm:py-3 bg-[#BB0102] text-white rounded-full hover:bg-[#990101] font-bold transition-all shadow-lg hover:shadow-xl text-sm sm:text-base"
                    >
                        Bandingkan Sekarang
                    </Link>
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

/* Hide scrollbar for mobile selected cars */
.overflow-x-auto::-webkit-scrollbar {
    height: 4px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: transparent;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: rgba(190, 188, 189, 0.3);
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: rgba(190, 188, 189, 0.5);
}
</style>