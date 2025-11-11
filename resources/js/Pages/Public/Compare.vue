<template>
    <Head title="Bandingkan Mobil" />

    <PublicLayout>
        <div class="container mx-auto px-4 py-8">
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

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    Bandingkan Mobil
                </h1>
                <p class="text-gray-600">
                    Pilih hingga 3 mobil untuk dibandingkan
                </p>
            </div>

            <!-- Comparison Slots -->
            <div class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <!-- Comparison Slot -->
                    <div
                        v-for="(slot, index) in comparisonSlots"
                        :key="index"
                        class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 min-h-80 hover:shadow-xl transition-all duration-300"
                    >
                        <!-- If slot is filled -->
                        <div v-if="slot" class="h-full">
                            <div class="relative">
                                <button
                                    @click="removeCar(slot.id)"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm hover:bg-red-600 z-10 shadow-lg"
                                >
                                    ×
                                </button>
                                <img
                                    :src="slot.image"
                                    :alt="slot.name"
                                    class="w-full h-36 object-cover rounded-lg mb-3"
                                />
                            </div>
                            <h3
                                class="font-bold text-lg text-gray-900 mb-1 line-clamp-2"
                            >
                                {{ slot.name }}
                            </h3>
                            <p class="text-red-600 font-bold text-xl mb-2">
                                Rp {{ formatPrice(slot.price) }}
                            </p>
                            <Link
                                :href="route('cars.show', slot.id)"
                                class="inline-block text-xs bg-red-600 text-white px-3 py-1 rounded-full hover:bg-red-700 transition-colors mb-3"
                            >
                                Lihat Detail →
                            </Link>

                            <!-- Car Details -->
                            <div class="space-y-1 text-xs">
                                <div
                                    class="flex justify-between border-b border-gray-100 pb-1"
                                >
                                    <span class="text-gray-500">Tahun:</span>
                                    <span class="font-medium text-gray-700">{{
                                        slot.year || "-"
                                    }}</span>
                                </div>
                                <div
                                    class="flex justify-between border-b border-gray-100 pb-1"
                                >
                                    <span class="text-gray-500">Merek:</span>
                                    <span class="font-medium text-gray-700">{{
                                        slot.merek || "-"
                                    }}</span>
                                </div>
                                <div
                                    class="flex justify-between border-b border-gray-100 pb-1"
                                >
                                    <span class="text-gray-500">Kondisi:</span>
                                    <span
                                        class="font-medium"
                                        :class="
                                            slot.kondisi === 'Baru'
                                                ? 'text-green-600'
                                                : 'text-yellow-600'
                                        "
                                    >
                                        {{ slot.kondisi || "-" }}
                                    </span>
                                </div>
                                <div
                                    class="flex justify-between border-b border-gray-100 pb-1"
                                >
                                    <span class="text-gray-500"
                                        >Transmisi:</span
                                    >
                                    <span class="font-medium text-gray-700">{{
                                        slot.transmission || "-"
                                    }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">KM:</span>
                                    <span class="font-medium text-gray-700">{{
                                        slot.km ? slot.km + " km" : "-"
                                    }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- If slot is empty -->
                        <div
                            v-else
                            class="h-full flex flex-col items-center justify-center text-gray-400 border-2 border-dashed border-gray-300 rounded-lg hover:border-red-300 hover:bg-red-50 transition-all duration-300"
                        >
                            <button
                                @click="showCarSelection = true"
                                class="flex flex-col items-center justify-center w-full h-full p-4"
                            >
                                <div
                                    class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-3 hover:bg-red-200 transition-colors"
                                >
                                    <svg
                                        class="w-6 h-6 text-red-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 4v16m8-8H4"
                                        ></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-600"
                                    >Tambah Mobil</span
                                >
                                <span class="text-xs text-gray-400 mt-1"
                                    >Klik untuk pilih</span
                                >
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Clear All Button -->
                <div v-if="selectedCars.length > 0" class="text-center mb-6">
                    <button
                        @click="clearAllCars"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors"
                    >
                        Hapus Semua Pilihan
                    </button>
                </div>

                <!-- Detailed Comparison Table (only show if 2 or more cars selected) -->
                <div v-if="selectedCars.length > 1" class="mt-8">
                    <h3 class="text-xl font-semibold mb-6 text-center">
                        Perbandingan Detail
                    </h3>
                    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
                        <table
                            class="min-w-full bg-white border border-gray-200 rounded-lg"
                        >
                            <thead class="bg-red-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left font-bold text-gray-900 border-b-2 border-red-200"
                                    >
                                        Spesifikasi
                                    </th>
                                    <th
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center font-bold text-gray-900 border-b-2 border-red-200"
                                    >
                                        <div class="flex flex-col items-center">
                                            <img
                                                :src="car.image"
                                                :alt="car.name"
                                                class="w-16 h-12 object-cover rounded mb-2"
                                            />
                                            <span class="text-sm">{{
                                                car.name
                                            }}</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-bold text-red-600 bg-red-50"
                                    >
                                        Harga
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center font-bold text-red-600"
                                    >
                                        Rp {{ formatPrice(car.price) }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-medium bg-gray-50"
                                    >
                                        Tahun
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center"
                                    >
                                        {{ car.year || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-medium bg-gray-50"
                                    >
                                        Merek
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center"
                                    >
                                        {{ car.merek || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-medium bg-gray-50"
                                    >
                                        Varian
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center"
                                    >
                                        {{ car.varian || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-medium bg-gray-50"
                                    >
                                        Kondisi
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center"
                                    >
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-medium"
                                            :class="
                                                car.kondisi === 'Baru'
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-yellow-100 text-yellow-800'
                                            "
                                        >
                                            {{ car.kondisi || "-" }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-medium bg-gray-50"
                                    >
                                        Transmisi
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center"
                                    >
                                        {{ car.transmission || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-medium bg-gray-50"
                                    >
                                        Bahan Bakar
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center"
                                    >
                                        {{ car.bahanBakar || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-medium bg-gray-50"
                                    >
                                        Kilometer
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center"
                                    >
                                        {{ car.km ? car.km + " km" : "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-medium bg-gray-50"
                                    >
                                        Tipe
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center"
                                    >
                                        {{ car.tipe || "-" }}
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td
                                        class="px-6 py-4 font-medium bg-gray-50"
                                    >
                                        Sistem Penggerak
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-6 py-4 text-center"
                                    >
                                        {{ car.sistemPenggerak || "-" }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Car Selection Modal -->
        <div
            v-if="showCarSelection"
            class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4 backdrop-blur-sm"
            @click.self="showCarSelection = false"
        >
            <div
                class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden transform transition-all"
            >
                <!-- Modal Header -->
                <div
                    class="bg-gradient-to-r from-red-600 to-red-700 text-white p-6"
                >
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold">Pilih Mobil</h2>
                            <p class="text-red-100 mt-1">
                                Pilih mobil yang ingin dibandingkan
                            </p>
                        </div>
                        <button
                            @click="showCarSelection = false"
                            class="text-white hover:bg-red-800 rounded-full p-2 transition-colors"
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
                                    d="M6 18L18 6M6 6l12 12"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div
                    class="p-6 overflow-y-auto max-h-[calc(90vh-140px)] bg-gray-50"
                >
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
                    >
                        <div
                            v-for="car in availableCars"
                            :key="car.id"
                            class="group bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl hover:border-red-300 transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
                            @click="addCar(car)"
                        >
                            <!-- Car Image -->
                            <div class="relative overflow-hidden">
                                <img
                                    :src="car.image"
                                    :alt="car.name"
                                    class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300"
                                />
                                <div class="absolute top-2 right-2">
                                    <span
                                        class="bg-red-600 text-white text-xs px-2 py-1 rounded-full font-medium"
                                    >
                                        {{ car.kondisi }}
                                    </span>
                                </div>
                            </div>

                            <!-- Car Details -->
                            <div class="p-4">
                                <h3
                                    class="font-bold text-lg mb-2 text-gray-900 line-clamp-2 group-hover:text-red-600 transition-colors"
                                >
                                    {{ car.name }}
                                </h3>
                                <div
                                    class="flex justify-between items-center mb-2"
                                >
                                    <span class="text-gray-500 text-sm">{{
                                        car.year
                                    }}</span>
                                    <span
                                        class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full"
                                    >
                                        {{ car.merek }}
                                    </span>
                                </div>
                                <p class="text-red-600 font-bold text-xl mb-3">
                                    Rp {{ formatPrice(car.price) }}
                                </p>

                                <!-- Quick Info -->
                                <div
                                    class="space-y-1 text-xs text-gray-500 mb-4"
                                >
                                    <div class="flex justify-between">
                                        <span>Transmisi:</span>
                                        <span
                                            class="font-medium text-gray-700"
                                            >{{ car.transmission || "-" }}</span
                                        >
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Kilometer:</span>
                                        <span
                                            class="font-medium text-gray-700"
                                            >{{
                                                car.km ? car.km + " km" : "-"
                                            }}</span
                                        >
                                    </div>
                                </div>

                                <!-- Select Button -->
                                <button
                                    class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-2.5 px-4 rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform group-hover:scale-105"
                                >
                                    <span
                                        class="flex items-center justify-center space-x-2"
                                    >
                                        <svg
                                            class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4v16m8-8H4"
                                            ></path>
                                        </svg>
                                        <span>Pilih Mobil Ini</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div
                        v-if="availableCars.length === 0"
                        class="text-center py-16"
                    >
                        <div class="bg-white rounded-xl p-8 shadow-lg">
                            <svg
                                class="w-16 h-16 text-gray-300 mx-auto mb-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                ></path>
                            </svg>
                            <h3 class="text-gray-500 text-lg font-medium mb-2">
                                Tidak Ada Mobil Tersedia
                            </h3>
                            <p class="text-gray-400">
                                Semua mobil sudah dipilih atau belum ada mobil
                                yang tersedia untuk dibandingkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import PublicLayout from "@/Layouts/PublicLayout.vue";

const props = defineProps({
    cars: Array,
    selected: Array, // Array of car IDs from URL parameters
});

const selectedCars = ref([]);
const showCarSelection = ref(false);

// Create 3 comparison slots
const comparisonSlots = computed(() => {
    const slots = [null, null, null];
    selectedCars.value.forEach((car, index) => {
        if (index < 3) {
            slots[index] = car;
        }
    });
    return slots;
});

const availableCars = computed(() => {
    return props.cars.filter((car) => !isSelected(car.id));
});

const addCar = (car) => {
    if (selectedCars.value.length < 3 && !isSelected(car.id)) {
        selectedCars.value.push(car);
        showCarSelection.value = false;
    }
};

const removeCar = (carId) => {
    selectedCars.value = selectedCars.value.filter((car) => car.id !== carId);
};

const isSelected = (carId) => {
    return selectedCars.value.some((car) => car.id === carId);
};

const clearAllCars = () => {
    selectedCars.value = [];
};

const formatPrice = (price) => {
    return new Intl.NumberFormat("id-ID").format(price);
};

const goBack = () => {
    window.history.back();
};

// Auto-select cars from URL parameters
onMounted(() => {
    if (props.selected && props.selected.length > 0) {
        const preSelectedCars = props.cars.filter((car) =>
            props.selected.includes(car.id.toString())
        );
        selectedCars.value = preSelectedCars.slice(0, 3); // Maximum 3 cars
    }
});
</script>
