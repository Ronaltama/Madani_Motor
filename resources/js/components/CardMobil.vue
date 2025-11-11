<template>
    <article
        :class="[
            'bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow cursor-pointer overflow-hidden',
            fullWidth ? 'w-full' : 'w-[279px]',
        ]"
        @click="goToDetail"
    >
        <!-- Gambar mobil dengan placeholder -->
        <div
            class="w-full h-40 bg-gray-100 flex items-center justify-center overflow-hidden"
        >
            <img
                :src="car.image"
                :alt="car.name"
                class="w-full h-full object-cover"
                loading="lazy"
            />
        </div>

        <!-- Konten card -->
        <div class="p-4">
            <h4 class="text-base font-semibold mb-2 line-clamp-2">
                {{ car.name }}
            </h4>
            <p class="text-sm text-gray-500 mb-3">
                {{ car.km }} · {{ car.transmission }}
            </p>

            <!-- Harga dengan warna merah yang sama -->
            <p class="text-[#BB0102] font-bold text-lg mb-4">
                Rp {{ formattedPrice }},-
            </p>

            <!-- Checkbox Bandingkan -->
            <div
                class="flex items-center gap-2 pt-3 border-t border-gray-100"
                @click.stop
            >
                <input
                    :id="'cmp-' + car.id"
                    type="checkbox"
                    :checked="isCompared"
                    @change="toggleCompare(car)"
                    class="w-4 h-4 accent-[#BB0102]"
                />
                <label
                    :for="'cmp-' + car.id"
                    class="text-sm text-gray-600 select-none cursor-pointer"
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
