<template>
    <PublicLayout>
        <section class="min-h-screen bg-gray-50 py-4 sm:py-6 md:py-8">
            <div v-if="car" class="max-w-7xl mx-auto px-4">
                <!-- Grid Layout: Galeri + Sidebar -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                    <!-- Galeri Foto (2 kolom) -->
                    <div class="lg:col-span-2">
                        <!-- Foto Utama -->
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden mb-3 sm:mb-4"
                        >
                            <div
                                class="relative cursor-pointer"
                                @click="openZoom"
                            >
                                <!-- Back Button -->
                                <button
                                    @click.stop="goBack"
                                    class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-white bg-opacity-95 hover:bg-white rounded-full p-1 sm:p-1.5 shadow-md hover:shadow-lg transition-all duration-200 z-10 group"
                                >
                                    <svg
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-600 group-hover:text-red-600 transition-colors"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2.5"
                                            d="M15 19l-7-7 7-7"
                                        />
                                    </svg>
                                </button>

                                <img
                                    :src="currentImage"
                                    :alt="car.name"
                                    class="w-full h-[250px] sm:h-[300px] md:h-[350px] lg:h-[400px] object-contain bg-gray-100"
                                />
                                <div
                                    class="absolute bottom-2 right-2 sm:bottom-3 sm:right-3 md:bottom-4 md:right-4 bg-black bg-opacity-70 text-white px-2 py-0.5 sm:px-3 sm:py-1 rounded-md text-xs sm:text-sm"
                                >
                                    {{ currentImageIndex + 1 }}/{{
                                        carImages.length
                                    }}
                                </div>
                            </div>
                        </div>

                        <!-- Modal Zoom Foto -->
                        <Teleport to="body">
                            <div
                                v-if="isZoomed"
                                @click="closeZoom"
                                class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4"
                            >
                                <button
                                    @click="closeZoom"
                                    class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors"
                                >
                                    <svg
                                        class="w-6 h-6 sm:w-8 sm:h-8"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                                <img
                                    :src="currentImage"
                                    :alt="car.name"
                                    class="max-w-full max-h-full object-contain"
                                    @click.stop
                                />
                            </div>
                        </Teleport>

                        <!-- Thumbnail Galeri -->
                        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 gap-1.5 sm:gap-2">
                            <div
                                v-for="(img, index) in carImages"
                                :key="index"
                                @click="currentImageIndex = index"
                                class="cursor-pointer rounded-lg overflow-hidden border-2 transition-all"
                                :class="
                                    currentImageIndex === index
                                        ? 'border-[#BB0102]'
                                        : 'border-gray-200 hover:border-gray-400'
                                "
                            >
                                <img
                                    :src="img"
                                    :alt="`${car.name} foto ${index + 1}`"
                                    class="w-full h-12 sm:h-14 md:h-16 object-cover"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Info & CTA (1 kolom) -->
                    <div class="lg:col-span-1">
                        <div
                            class="bg-white rounded-lg shadow-md p-4 sm:p-5 md:p-6 lg:sticky lg:top-4"
                        >
                            <div
                                class="inline-block bg-gradient-to-r from-red-100 to-pink-100 text-[#BB0102] text-[10px] sm:text-xs font-semibold px-2 sm:px-3 py-0.5 sm:py-1 rounded-full mb-2 sm:mb-3"
                            >
                                Madani Motor Certified
                            </div>

                            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-3">
                                {{ car.name }}
                            </h1>

                            <div
                                class="flex items-center text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4"
                            >
                                <span>{{ car.km }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ car.transmission }}</span>
                            </div>

                            <div class="mb-3 sm:mb-4">
                                <p class="text-[#BB0102] font-bold text-2xl sm:text-3xl">
                                    Rp {{ formattedPrice }},-
                                </p>
                            </div>

                            <!-- Lokasi -->
                            <div class="pt-3 sm:pt-4">
                                <div
                                    @click="showLocationModal = true"
                                    class="flex items-start gap-2 text-xs sm:text-sm text-gray-600 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors"
                                >
                                    <svg
                                        class="w-4 h-4 sm:w-5 sm:h-5 mt-0.5 text-gray-400 flex-shrink-0"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                        />
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            Lokasi Mobil
                                        </p>
                                        <p>
                                            Madani Motor, Sukoharjo, Jawa Tengah
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="border-t border-gray-300 mt-3 sm:mt-4 mb-3 sm:mb-4"
                            ></div>

                            <!-- WhatsApp Button -->
                            <a
                                :href="whatsappLink"
                                target="_blank"
                                class="block w-full bg-[#1FAD4F] hover:bg-[#1a9342] text-white font-semibold py-2.5 sm:py-3 px-3 sm:px-4 rounded-lg text-center transition-colors flex items-center justify-center gap-2 text-sm sm:text-base"
                            >
                                <svg
                                    class="w-4 h-4 sm:w-5 sm:h-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"
                                    />
                                </svg>
                                <span class="hidden sm:inline">Beli Sekarang via WhatsApp</span>
                                <span class="sm:hidden">Beli via WhatsApp</span>
                            </a>

                            <!-- Modal Lokasi -->
                            <Teleport to="body">
                                <div
                                    v-if="showLocationModal"
                                    @click="showLocationModal = false"
                                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[rgba(0,0,0,0.15)] transition-opacity"
                                >
                                    <div
                                        @click.stop
                                        class="bg-white rounded-lg shadow-xl max-w-md w-full p-5 sm:p-6 relative"
                                    >
                                        <button
                                            @click="showLocationModal = false"
                                            class="absolute top-3 right-3 sm:top-4 sm:right-4 text-gray-400 hover:text-gray-600"
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
                                                />
                                            </svg>
                                        </button>

                                        <h3 class="text-base sm:text-lg font-bold mb-3 sm:mb-4">
                                            Madani Motor Sukoharjo
                                        </h3>

                                        <div
                                            class="space-y-2 sm:space-y-3 text-xs sm:text-sm text-gray-700"
                                        >
                                            <div class="flex items-start gap-2">
                                                <svg
                                                    class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 mt-0.5 flex-shrink-0"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />
                                                </svg>
                                                <p class="leading-relaxed">
                                                    Jombor Indah RT 002/RW 003,
                                                    Gang V, Desa Jombor,
                                                    Kecamatan Bendosari,
                                                    Kabupaten Sukoharjo, Jawa
                                                    Tengah 57521
                                                </p>
                                            </div>

                                            <div
                                                class="flex items-center gap-2 pt-2 border-t"
                                            >
                                                <svg
                                                    class="w-4 h-4 sm:w-5 sm:h-5 text-[#25D366]"
                                                    fill="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"
                                                    />
                                                </svg>
                                                <p class="font-semibold">
                                                    (+62) 986 1649 8342
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </Teleport>
                        </div>
                    </div>
                </div>

                <!-- Detail & Fitur Tabs -->
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-5 md:p-6 mb-6 sm:mb-8">
                    <div class="mb-4 sm:mb-6">
                        <div class="flex gap-4 sm:gap-6 md:gap-8">
                            <button
                                @click="activeTab = 'detail'"
                                class="pb-2 sm:pb-3 font-semibold transition-colors relative text-sm sm:text-base"
                                :class="
                                    activeTab === 'detail'
                                        ? 'text-[#BB0102]'
                                        : 'text-gray-500 hover:text-gray-700'
                                "
                            >
                                Detail Mobil
                                <div
                                    v-if="activeTab === 'detail'"
                                    class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#BB0102]"
                                ></div>
                            </button>
                            <button
                                @click="activeTab = 'fitur'"
                                class="pb-2 sm:pb-3 font-semibold transition-colors relative text-sm sm:text-base"
                                :class="
                                    activeTab === 'fitur'
                                        ? 'text-[#BB0102]'
                                        : 'text-gray-500 hover:text-gray-700'
                                "
                            >
                                Fitur
                                <div
                                    v-if="activeTab === 'fitur'"
                                    class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#BB0102]"
                                ></div>
                            </button>
                        </div>
                    </div>

                    <!-- Tab Detail Mobil -->
                    <div v-show="activeTab === 'detail'">
                        <div class="text-center mb-4 sm:mb-6">
                            <h2 class="text-xl sm:text-2xl font-bold mb-2">
                                Detail Mobil
                            </h2>
                            <div
                                class="w-20 sm:w-24 h-1 bg-[#BB0102] mx-auto rounded-full mb-2"
                            ></div>
                            <p class="text-gray-500 text-xs sm:text-sm">
                                ID: {{ car.id }}
                            </p>
                        </div>

                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 sm:gap-y-4 gap-x-4 sm:gap-x-8"
                        >
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600"
                                    >Jenis Bahan Bakar</span
                                >
                                <span class="font-semibold text-right">{{
                                    car.bahanBakar
                                }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600">Transmisi</span>
                                <span class="font-semibold text-right">{{
                                    car.transmission
                                }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600">Warna</span>
                                <span class="font-semibold text-right">{{
                                    car.warna
                                }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600">Kepemilikan</span>
                                <span class="font-semibold text-right"
                                    >Tangan ke-{{ car.tanganKe }}</span
                                >
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600"
                                    >Keluaran Tahun</span
                                >
                                <span class="font-semibold text-right">{{
                                    car.year
                                }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600"
                                    >Tipe Registrasi</span
                                >
                                <span class="font-semibold text-right">{{
                                    car.tipe
                                }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600"
                                    >Jarak Tempuh Saat Ini</span
                                >
                                <span class="font-semibold text-right">{{
                                    car.km
                                }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600"
                                    >Masa Berlaku STNK</span
                                >
                                <span class="font-semibold text-right">{{
                                    car.stnkValid
                                }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600"
                                    >Sistem Penggerak</span
                                >
                                <span class="font-semibold text-right">{{
                                    car.sistemPenggerak
                                }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600">No Polisi</span>
                                <span class="font-semibold text-right">{{
                                    car.noPolisi
                                }}</span>
                            </div>
                            <div
                                class="flex justify-between items-center py-2 sm:py-3 border-b border-gray-200 text-xs sm:text-sm"
                            >
                                <span class="text-gray-600">Plat Mobil</span>
                                <span class="font-semibold text-right">{{
                                    car.domisili
                                }}</span>
                            </div>
                        </div>

                        <div class="mt-6 sm:mt-8">
                            <h3 class="font-semibold text-sm sm:text-base mb-2 sm:mb-3">
                                Deskripsi
                            </h3>
                            <p class="text-gray-700 leading-relaxed text-xs sm:text-sm">
                                {{ car.description }}
                            </p>
                        </div>
                    </div>

                    <!-- Tab Fitur -->
                    <div v-show="activeTab === 'fitur'">
                        <div class="text-center mb-4 sm:mb-6">
                            <h2 class="text-xl sm:text-2xl font-bold mb-2">Fitur Mobil</h2>
                            <div
                                class="w-20 sm:w-24 h-1 bg-[#BB0102] mx-auto rounded-full"
                            ></div>
                        </div>
                        <p class="text-gray-600 text-center text-xs sm:text-sm md:text-base">
                            Untuk Penjelasan Fitur Fitur dari mobil ini, Bisa
                            langsung Cek Unit Mobilnya
                        </p>
                    </div>
                </div>

                <!-- Mobil Serupa (Similar Cars) -->
                <div class="mb-8 sm:mb-10 md:mb-12 mt-8 sm:mt-10 md:mt-12">
                    <div class="mb-4 sm:mb-6">
                        <h2
                            class="text-lg sm:text-xl font-bold inline-block relative pb-2"
                        >
                            Pilihan Mobil Lainnya
                        </h2>
                        <div
                            class="w-20 sm:w-24 h-1 bg-[#BB0102] mt-1 rounded-full"
                        ></div>
                    </div>

                    <div class="relative">
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
                            ref="similarCarsScroll"
                            @scroll="handleScroll"
                            class="flex gap-2 sm:gap-3 md:gap-4 overflow-x-auto pb-4 scroll-smooth"
                        >
                            <div
                                v-for="similarCar in similarCars"
                                :key="similarCar.id"
                                class="flex-shrink-0 w-[calc(50%-0.25rem)] min-w-[160px] sm:w-[220px] md:w-[260px] lg:w-[279px]"
                            >
                                <article
                                    class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow cursor-pointer overflow-hidden flex flex-col h-full"
                                    @click="goToCarDetail(similarCar.id)"
                                >
                                    <div class="w-full pb-[57.35%] relative bg-gray-100 overflow-hidden">
                                        <img
                                            :src="similarCar.image"
                                            :alt="similarCar.name"
                                            class="absolute inset-0 w-full h-full object-cover"
                                            loading="lazy"
                                        />
                                    </div>

                                    <div class="p-3 sm:p-4 flex flex-col flex-grow">
                                        <h4
                                            class="text-sm sm:text-base font-semibold mb-1.5 sm:mb-2 line-clamp-2 flex-grow-0"
                                        >
                                            {{ similarCar.name }}
                                        </h4>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-2 sm:mb-3">
                                            {{ similarCar.km }} ·
                                            {{ similarCar.transmission }}
                                        </p>

                                        <div class="flex-grow"></div>

                                        <p class="text-[#BB0102] font-bold text-base sm:text-lg">
                                            Rp
                                            {{
                                                similarCar.price.toLocaleString(
                                                    "id-ID"
                                                )
                                            }},-
                                        </p>
                                    </div>
                                </article>
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
                </div>
            </div>

            <div v-else class="text-center py-12 sm:py-16 md:py-20">
                <p class="text-gray-500 text-base sm:text-lg">Mobil tidak ditemukan.</p>
            </div>
        </section>
        <CompareBox />
    </PublicLayout>
</template>

<script setup>
import { ref, computed, onMounted, nextTick, watch } from "vue";
import { router } from "@inertiajs/vue3";
import PublicLayout from "@/Layouts/PublicLayout.vue";
import CompareBox from "@/components/CompareBox.vue";

const props = defineProps({
    car: Object,
    similarCars: {
        type: Array,
        default: () => [],
    },
});

// State untuk galeri foto
const currentImageIndex = ref(0);
const isZoomed = ref(false);
const showLocationModal = ref(false);

// Mengunci Scroll Body untuk Modal
watch(showLocationModal, (isShowing) => {
    document.body.style.overflow = isShowing ? "hidden" : "";
});

// Mengunci Scroll Body untuk Zoom
watch(isZoomed, (isShowing) => {
    document.body.style.overflow = isShowing ? "hidden" : "";
});

// Fungsi untuk buka dan tutup zoom
const openZoom = () => {
    isZoomed.value = true;
};

const closeZoom = () => {
    isZoomed.value = false;
};

// Array foto mobil (multiple photos dari database)
const carImages = computed(() => {
    if (!props.car || !props.car.photos) return [];
    return props.car.photos.map((photo) => photo.url);
});

const currentImage = computed(() => carImages.value[currentImageIndex.value]);

// State untuk tab
const activeTab = ref("detail");

// Format harga
const formattedPrice = computed(() => {
    if (!props.car) return "0";
    return props.car.price.toLocaleString("id-ID");
});

// Link WhatsApp
const whatsappLink = computed(() => {
    if (!props.car) return "#";
    const phoneNumber = "6281225865661";
    const message = encodeURIComponent(
        `Halo, saya tertarik dengan mobil ${props.car.name}, (Transmisi: ${props.car.transmission}), dengan ID mobil #${props.car.id}, seharga Rp ${formattedPrice.value}. Apakah unit mobil masih tersedia?`
    );
    return `https://wa.me/${phoneNumber}?text=${message}`;
});

// Scroll handling untuk mobil serupa
const similarCarsScroll = ref(null);
const scrollState = ref({
    showLeft: false,
    showRight: false,
});

const handleScroll = () => {
    if (!similarCarsScroll.value) return;

    const container = similarCarsScroll.value;
    scrollState.value.showLeft = container.scrollLeft > 20;
    scrollState.value.showRight =
        container.scrollLeft <
        container.scrollWidth - container.clientWidth - 20;
};

const scrollLeft = () => {
    if (similarCarsScroll.value) {
        similarCarsScroll.value.scrollBy({ left: -300, behavior: "smooth" });
    }
};

const scrollRight = () => {
    if (similarCarsScroll.value) {
        similarCarsScroll.value.scrollBy({ left: 300, behavior: "smooth" });
    }
};

const goToCarDetail = (carId) => {
    router.visit(route("cars.show", carId));
};

const goBack = () => {
    window.history.back();
};

onMounted(() => {
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