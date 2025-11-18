<template>
    <Head title="Bandingkan Mobil" />

    <PublicLayout>
        <div class="container mx-auto px-4 py-8">
            <div class="mb-4">
                <button
                    @click="goBack"
                    class="inline-flex items-center gap-1.5 text-gray-600 hover:text-[#BB0102] transition-colors text-sm group"
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

            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3">
                    Bandingkan Mobil
                </h1>
                <div class="w-20 sm:w-24 h-1 bg-[#BB0102] mx-auto rounded-full mb-2"></div>
                <p class="text-sm sm:text-base text-gray-600">
                    Pilih hingga 3 mobil untuk dibandingkan
                </p>
            </div>

            <div class="mb-8">
                <!-- Comparison Slots with Horizontal Scroll -->
                <div class="relative mb-6 sm:mb-8">
                    <button
                        v-show="scrollState.showLeft"
                        @click="scrollLeft"
                        class="absolute -left-4 sm:-left-6 md:-left-8 lg:-left-12 top-1/2 -translate-y-1/2 z-10 w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center hover:opacity-70 transition-all bg-white rounded-full shadow-md"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-black"
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
                        ref="slotsScroll"
                        @scroll="handleScroll"
                        class="flex gap-3 sm:gap-4 lg:gap-6 overflow-x-auto pb-4 scroll-smooth lg:justify-center items-stretch"
                    >
                        <div
                            v-for="(slot, index) in comparisonSlots"
                            :key="index"
                            class="flex-shrink-0 w-[calc(50%-0.375rem)] min-w-[160px] sm:w-[240px] md:w-[260px] lg:w-[300px]"
                        >
                            <div
                                class="group bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer overflow-hidden flex flex-col h-full"
                            >
                                <div v-if="slot" class="flex flex-col h-full">
                                    <div class="w-full pb-[57.35%] relative bg-gray-100 overflow-hidden">
                                        <button
                                            @click="removeCar(slot.id)"
                                            class="absolute top-2 right-2 bg-[#BB0102] text-white rounded-full w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center text-sm hover:bg-[#9A0101] z-10 shadow-lg"
                                        >
                                            ×
                                        </button>
                                        <img
                                            :src="slot.image"
                                            :alt="slot.name"
                                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        />
                                    </div>

                                    <div class="py-3 sm:py-4 md:py-5 px-2 sm:px-3 md:px-4 flex flex-col flex-grow">
                                        <h4 class="text-xs sm:text-sm md:text-base font-semibold mb-1 sm:mb-2 line-clamp-2 group-hover:text-[#BB0102] transition-colors">
                                            {{ slot.name }}
                                        </h4>

                                        <p class="text-[#BB0102] font-bold text-sm sm:text-base md:text-lg mb-2 sm:mb-3">
                                            Rp {{ formatPrice(slot.price) }}
                                        </p>

                                        <div class="space-y-0.5 sm:space-y-1 text-[9px] sm:text-[10px] md:text-xs text-gray-500 mb-2 sm:mb-3 md:mb-4">
                                            <div class="flex justify-between">
                                                <span>Transmisi:</span>
                                                <span class="font-medium text-gray-700">{{ slot.transmission || "-" }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Kilometer:</span>
                                                <span class="font-medium text-gray-700">{{ slot.km ? slot.km + " km" : "-" }}</span>
                                            </div>
                                        </div>

                                        <div class="flex-grow"></div>

                                        <div class="pt-2 sm:pt-3 border-t border-gray-100">
                                            <Link
                                                :href="route('cars.show', slot.id)"
                                                class="w-full block text-center bg-gradient-to-r from-[#BB0102] to-[#9A0101] text-white py-1.5 sm:py-2 md:py-2.5 px-2 sm:px-3 md:px-4 rounded-lg hover:from-[#9A0101] hover:to-[#7A0101] transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform group-hover:scale-105 text-[10px] sm:text-xs md:text-sm"
                                            >
                                                <span class="flex items-center justify-center space-x-1">
                                                    <span>Lihat Detail</span>
                                                    <span>→</span>
                                                </span>
                                            </Link>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    v-else
                                    @click="showCarSelection = true"
                                    class="h-full flex flex-col cursor-pointer hover:shadow-2xl transition-all duration-300"
                                >
                                    <div class="w-full pb-[57.35%] relative bg-gray-100 overflow-hidden">
                                        <div class="absolute inset-0 flex items-center justify-center bg-gray-50 group-hover:bg-[#FFF5F5] transition-colors">
                                            <svg
                                                class="w-12 h-12 sm:w-16 sm:h-16 text-gray-300 group-hover:text-[#BB0102] transition-colors"
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
                                        </div>
                                    </div>

                                    <div class="py-3 sm:py-4 md:py-5 px-2 sm:px-3 md:px-4 flex flex-col flex-grow">
                                        <h4 class="text-xs sm:text-sm md:text-base font-semibold mb-1 sm:mb-2 text-gray-400 group-hover:text-[#BB0102] text-center transition-colors">
                                            Slot Kosong
                                        </h4>

                                        <p class="text-gray-400 group-hover:text-[#BB0102] font-bold text-sm sm:text-base md:text-lg mb-2 sm:mb-3 text-center transition-colors">
                                            Rp -
                                        </p>

                                        <div class="space-y-0.5 sm:space-y-1 text-[9px] sm:text-[10px] md:text-xs text-gray-400 mb-2 sm:mb-3 md:mb-4">
                                            <div class="flex justify-between">
                                                <span>Transmisi:</span>
                                                <span class="font-medium">-</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Kilometer:</span>
                                                <span class="font-medium">-</span>
                                            </div>
                                        </div>

                                        <div class="flex-grow"></div>

                                        <div class="pt-2 sm:pt-3 border-t border-gray-100">
                                            <button
                                                @click="showCarSelection = true"
                                                class="w-full bg-gradient-to-r from-[#BB0102] to-[#9A0101] text-white py-1.5 sm:py-2 md:py-2.5 px-2 sm:px-3 md:px-4 rounded-lg hover:from-[#9A0101] hover:to-[#7A0101] transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:scale-105 text-[10px] sm:text-xs md:text-sm"
                                            >
                                                <span class="flex items-center justify-center space-x-1">
                                                    <svg
                                                        class="w-3 h-3 sm:w-3.5 sm:h-3.5 md:w-4 md:h-4"
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
                                                    <span>Tambahkan Mobil</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button
                        v-show="scrollState.showRight"
                        @click="scrollRight"
                        class="absolute -right-4 sm:-right-6 md:-right-8 lg:-right-12 top-1/2 -translate-y-1/2 z-10 w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center hover:opacity-70 transition-all bg-white rounded-full shadow-md"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-black"
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

                <!-- Clear All Button -->
                <div v-if="selectedCars.length > 0" class="text-center mb-6 mt-6 sm:mt-8">
                    <button
                        @click="clearAllCars"
                        class="bg-[#BB0102] hover:bg-[#9A0101] text-white px-5 sm:px-6 py-2 sm:py-2.5 rounded-lg transition-colors text-sm sm:text-base font-medium"
                    >
                        Hapus Semua Pilihan
                    </button>
                </div>

                <!-- Detailed Comparison Table - Always Table Format -->
                <div v-if="selectedCars.length > 1" class="mt-6 sm:mt-8">
                    <h3 class="text-lg sm:text-xl font-semibold mb-4 sm:mb-6 text-center">
                        Perbandingan Detail
                    </h3>
                    
                    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
                        <table
                            class="min-w-full bg-white border border-gray-200 rounded-lg"
                        >
                            <thead class="bg-[#FFF5F5]">
                                <tr>
                                    <th
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-left font-bold text-gray-900 border-b-2 border-[#BB0102] text-xs sm:text-sm md:text-base sticky left-0 bg-[#FFF5F5] z-10"
                                    >
                                        Spesifikasi
                                    </th>
                                    <th
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center font-bold text-gray-900 border-b-2 border-[#BB0102] min-w-[140px] sm:min-w-[160px] md:min-w-[180px]"
                                    >
                                        <div class="flex flex-col items-center">
                                            <img
                                                :src="car.image"
                                                :alt="car.name"
                                                class="w-12 h-9 sm:w-14 sm:h-10 md:w-16 md:h-12 object-cover rounded mb-2"
                                            />
                                            <span class="text-[10px] sm:text-xs md:text-sm">{{
                                                car.name
                                            }}</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-bold text-[#BB0102] bg-[#FFF5F5] text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Harga
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center font-bold text-[#BB0102] text-xs sm:text-sm md:text-base"
                                    >
                                        Rp {{ formatPrice(car.price) }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-medium bg-gray-50 text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Tahun
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm md:text-base"
                                    >
                                        {{ car.year || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-medium bg-gray-50 text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Merek
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm md:text-base"
                                    >
                                        {{ car.merek || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-medium bg-gray-50 text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Varian
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm md:text-base"
                                    >
                                        {{ car.varian || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-medium bg-gray-50 text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Kondisi
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center"
                                    >
                                        <span
                                            class="px-2 sm:px-3 py-1 rounded-full text-[10px] sm:text-xs md:text-sm font-medium inline-block"
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
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-medium bg-gray-50 text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Transmisi
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm md:text-base"
                                    >
                                        {{ car.transmission || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-medium bg-gray-50 text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Bahan Bakar
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm md:text-base"
                                    >
                                        {{ car.bahanBakar || "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-medium bg-gray-50 text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Kilometer
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm md:text-base"
                                    >
                                        {{ car.km ? car.km + " km" : "-" }}
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-medium bg-gray-50 text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Tipe
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm md:text-base"
                                    >
                                        {{ car.tipe || "-" }}
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 font-medium bg-gray-50 text-xs sm:text-sm md:text-base sticky left-0 z-10"
                                    >
                                        Sistem Penggerak
                                    </td>
                                    <td
                                        v-for="car in selectedCars"
                                        :key="car.id"
                                        class="px-3 sm:px-4 md:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm md:text-base"
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
            class="fixed inset-0 flex items-center justify-center z-50 p-2 sm:p-4"
            style="background-color: rgba(0, 0, 0, 0.15);"
            @click.self="showCarSelection = false"
        >
            <div
                class="bg-white rounded-2xl sm:rounded-3xl shadow-2xl w-full max-w-7xl max-h-[95vh] sm:max-h-[98vh] transform transition-all flex flex-col"
            >
                <div
                    class="bg-gradient-to-r from-[#BB0102] to-[#9A0101] text-white p-4 sm:p-6 flex-shrink-0 rounded-t-2xl sm:rounded-t-3xl"
                >
                    <div class="flex justify-between items-start">
                        <div class="flex-1 text-center">
                            <h2 class="text-xl sm:text-2xl font-bold mb-2">Pilih Mobil</h2>
                            <div class="w-16 sm:w-24 h-1 bg-white mx-auto rounded-full mb-2 sm:mb-3"></div>
                            <p class="text-red-100 text-sm sm:text-base">
                                Pilih mobil yang ingin dibandingkan
                            </p>
                        </div>
                        <button
                            @click="showCarSelection = false"
                            class="text-white hover:bg-[#9A0101] rounded-full p-1.5 sm:p-2 transition-colors flex-shrink-0"
                        >
                            <svg
                                class="w-5 h-5 sm:w-6 sm:h-6"
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

                <div
                    class="p-3 sm:p-4 md:p-6 overflow-y-auto bg-gray-50 flex-grow"
                >
                    <!-- 2 kolom di semua layar -->
                    <div
                        class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 sm:gap-3 md:gap-4"
                    >
                        <div
                            v-for="car in availableCars"
                            :key="car.id"
                            class="group bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer overflow-hidden flex flex-col"
                            @click="addCar(car)"
                        >
                            <div
                                class="w-full pb-[57.35%] relative bg-gray-100 overflow-hidden"
                            >
                                <img
                                    :src="car.image"
                                    :alt="car.name"
                                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    loading="lazy"
                                />
                            </div>

                            <div class="py-3 sm:py-4 md:py-5 px-2 sm:px-3 md:px-4 flex flex-col flex-grow">
                                <h4
                                    class="text-xs sm:text-sm md:text-base font-semibold mb-1 sm:mb-2 line-clamp-2 group-hover:text-[#BB0102] transition-colors"
                                >
                                    {{ car.name }}
                                </h4>

                                <div
                                    class="flex justify-between items-center mb-1 sm:mb-2"
                                >
                                    <span class="text-gray-500 text-[10px] sm:text-xs md:text-sm">{{
                                        car.year
                                    }}</span>
                                    <span
                                        class="bg-gray-100 text-gray-600 text-[9px] sm:text-[10px] md:text-xs px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full"
                                    >
                                        {{ car.merek }}
                                    </span>
                                </div>

                                <p class="text-[#BB0102] font-bold text-sm sm:text-base md:text-lg mb-2 sm:mb-3">
                                    Rp {{ formatPrice(car.price) }}
                                </p>

                                <div
                                    class="space-y-0.5 sm:space-y-1 text-[9px] sm:text-[10px] md:text-xs text-gray-500 mb-2 sm:mb-3 md:mb-4"
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

                                <div class="flex-grow"></div>

                                <div class="pt-2 sm:pt-3 border-t border-gray-100">
                                    <button
                                        class="w-full bg-gradient-to-r from-[#BB0102] to-[#9A0101] text-white py-1.5 sm:py-2 md:py-2.5 px-2 sm:px-3 md:px-4 rounded-lg hover:from-[#9A0101] hover:to-[#7A0101] transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform group-hover:scale-105 text-[10px] sm:text-xs md:text-sm"
                                    >
                                        <span
                                            class="flex items-center justify-center space-x-1"
                                        >
                                            <svg
                                                class="w-3 h-3 sm:w-3.5 sm:h-3.5 md:w-4 md:h-4"
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
                                            <span>Tambahkan Mobil</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        v-if="availableCars.length === 0"
                        class="text-center py-12 sm:py-16"
                    >
                        <div class="bg-white rounded-xl p-6 sm:p-8 shadow-lg">
                            <svg
                                class="w-12 h-12 sm:w-16 sm:h-16 text-gray-300 mx-auto mb-3 sm:mb-4"
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
                            <h3 class="text-gray-500 text-base sm:text-lg font-medium mb-2">
                                Tidak Ada Mobil Tersedia
                            </h3>
                            <p class="text-gray-400 text-sm sm:text-base">
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
import { ref, computed, onMounted, watch, nextTick } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import PublicLayout from "@/Layouts/PublicLayout.vue";

const props = defineProps({
    cars: Array,
    selected: Array,
});

const selectedCars = ref([]);
const showCarSelection = ref(false);
const slotsScroll = ref(null);
const scrollState = ref({ showLeft: false, showRight: true });

// Lock body scroll when modal is open
watch(showCarSelection, (isShowing) => {
    document.body.style.overflow = isShowing ? "hidden" : "";
});

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

// Scroll handlers
const handleScroll = () => {
    const el = slotsScroll.value;
    if (!el) return;

    const scrollLeft = el.scrollLeft;
    const scrollWidth = el.scrollWidth;
    const clientWidth = el.clientWidth;

    scrollState.value.showLeft = scrollLeft > 5;
    scrollState.value.showRight = scrollLeft < scrollWidth - clientWidth - 5;
};

const scrollLeft = () => {
    const el = slotsScroll.value;
    el?.scrollBy({ left: -300, behavior: "smooth" });
};

const scrollRight = () => {
    const el = slotsScroll.value;
    el?.scrollBy({ left: 300, behavior: "smooth" });
};

// Auto-select cars from URL parameters
onMounted(() => {
    if (props.selected && props.selected.length > 0) {
        const preSelectedCars = props.cars.filter((car) =>
            props.selected.includes(car.id.toString())
        );
        selectedCars.value = preSelectedCars.slice(0, 3);
    }
    
    nextTick(() => {
        handleScroll();
    });
});
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Scrollbar styling */
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
</style>