<template>
    <article
        :class="[
            'bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow cursor-pointer overflow-hidden flex flex-col',
            fullWidth ? 'w-full' : 'w-full max-w-[279px]',
        ]"
        @click="goToDetail"
    >
        <!-- Gambar mobil dengan placeholder dan aspect ratio tetap -->
        <div class="w-full pb-[57.35%] relative bg-gray-100 overflow-hidden">
            <img
                :src="car.image"
                :alt="car.name"
                class="absolute inset-0 w-full h-full object-cover"
                loading="lazy"
            />
        </div>

        <!-- Konten card -->
        <div class="p-3 sm:p-4 flex flex-col h-full">
            <div class="flex-grow flex flex-col">
                <h4 class="text-sm sm:text-base font-semibold mb-1.5 sm:mb-2 line-clamp-2">
                    {{ car.name }}
                </h4>
                <p class="text-xs sm:text-sm text-gray-500 mb-2 sm:mb-3">
                    {{ car.km }} · {{ car.transmission }}
                </p>

                <!-- Spacer untuk mendorong harga ke bawah -->
                <div class="flex-grow"></div>

                <!-- Harga dengan warna merah yang sama - selalu di atas tombol bandingkan -->
                <p class="text-[#BB0102] font-bold text-base sm:text-lg mb-3 sm:mb-4">
                    Rp {{ formattedPrice }},-
                </p>
            </div>

            <!-- Checkbox Bandingkan - selalu di bawah -->
            <div
                class="flex items-center gap-2 pt-2.5 sm:pt-3 border-t border-gray-100"
                @click.stop
            >
                <input
                    :id="'cmp-' + car.id"
                    type="checkbox"
                    :checked="isCompared"
                    @change="toggleCompare(car)"
                    class="w-3.5 h-3.5 sm:w-4 sm:h-4 accent-[#BB0102]"
                />
                <label
                    :for="'cmp-' + car.id"
                    class="text-xs sm:text-sm text-gray-600 select-none cursor-pointer"
                >
                    Bandingkan
                </label>
            </div>
        </div>
    </article>
</template>

<script setup>
import { computed } from "vue";
import { router } from "@inertiajs/vue3";
import { useCompareStore } from "@/stores/compareStore";

const props = defineProps({
    car: {
        type: Object,
        required: true,
    },
    fullWidth: {
        type: Boolean,
        default: false,
    },
});

const compareStore = useCompareStore();

const isCompared = computed(() =>
    compareStore.selectedCars.some((c) => c.id === props.car.id)
);

function toggleCompare(car) {
    compareStore.toggleCompare(car);
}

function goToDetail() {
    router.visit(route("cars.show", props.car.id));
}

const formattedPrice = computed(() => {
    return props.car.price.toLocaleString("id-ID");
});
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>