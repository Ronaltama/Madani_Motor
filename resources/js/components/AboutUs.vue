<template>
    <!-- About Us Section -->
    <section class="py-8 sm:py-12 lg:py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <!-- Title with underline -->
            <div class="text-center mb-8 sm:mb-10">
                <h2
                    class="text-2xl sm:text-3xl lg:text-4xl font-bold text-black mb-3 tracking-tight"
                >
                    About Us
                </h2>
                <div class="w-20 h-1.5 bg-[#BB0102] mx-auto rounded-3xl"></div>
            </div>

            <!-- Image with Overlay Content -->
            <div
                class="relative w-full rounded-lg overflow-hidden shadow-xl bg-gray-100"
            >
                <!-- Wrapper for proper overlay positioning -->
                <div class="relative">
                    <!-- Background Image - Mobile: auto height, Desktop: fixed height -->
                    <img
                        :src="aboutImageUrl"
                        alt="Madani Motor - Dealer Terpercaya"
                        class="w-full h-auto sm:h-[400px] lg:h-[480px] object-contain sm:object-cover"
                    />

                    <!-- Transparent Overlay Layer -->
                    <div class="absolute inset-0 bg-black/20"></div>

                    <!-- Content on Top of Overlay -->
                    <div
                        class="absolute inset-0 flex items-center justify-center p-3 sm:p-4"
                    >
                        <div
                            class="text-center text-white space-y-1 sm:space-y-2 max-w-xs sm:max-w-sm"
                        >
                            <h3
                                class="text-base sm:text-2xl lg:text-3xl font-bold font-['Montserrat'] leading-tight"
                            >
                                Madani Motor
                            </h3>
                            <p
                                class="text-xs sm:text-lg lg:text-xl font-bold font-['Montserrat'] leading-snug"
                            >
                                Dealer Mobil Bekas Terpercaya
                            </p>
                            <p
                                class="text-[10px] sm:text-sm opacity-90 font-medium hidden sm:block"
                            >
                                Melayani dengan profesional dan terpercaya
                            </p>

                            <!-- Show Products Button -->
                            <a
                                href="/cars"
                                class="mt-2 sm:mt-4 inline-flex items-center gap-1 sm:gap-2 px-3 sm:px-6 py-1.5 sm:py-3 rounded-lg border border-white sm:border-2 text-white text-[10px] sm:text-sm font-semibold font-['Montserrat'] hover:bg-white hover:text-black transition-all duration-300"
                            >
                                <span>Lihat Koleksi Mobil</span>
                                <svg
                                    class="w-2.5 h-2.5 sm:w-4 sm:h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Simple static component
const aboutImageUrl = "/images/about-us-bg.png";
</script>
